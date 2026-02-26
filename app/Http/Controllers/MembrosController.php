<?php

namespace App\Http\Controllers;

use App\Models\caixas;
use App\Models\despesas;
use App\Models\ofertas;
use App\Models\membros;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\dizimos;
use App\Models\empresas;
use App\Models\Eventos;
use App\Models\Eventos_presencas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\Object_;

class MembrosController extends Controller
{
    /*membros*/

    public function Atualizar(Request $request)
    {
        User::where('id', Auth::id())->update(['empresa_id' => $request->id]);
        return redirect('/');
    }

    public function index(Request $request)
    {
        $empresas_id = Auth::user()->empresa_id;
        $dados = $request->pesquisa;
        $membros = membros::whereRaw('LOWER(nome) LIKE ?', ["%" . strtolower($dados) . "%"])->where('empresa_id', $empresas_id)->get();
        $qtdEventos = count(Eventos::all());
        return Inertia::render('index', compact('membros', 'qtdEventos', 'dados'));
    }

    public function cadastro_membro()
    {
        $empresas_id = Auth::user()->empresa_id;
        $razao_empresa = empresas::where('id', $empresas_id)->value('razao');

        return Inertia::render('FormMembro', compact('razao_empresa'));
    }

    public function botao_inserir_membro(request $request)
    {
        $dados = $request->all();
        $dados['user_id'] = Auth::id();
        $dados['empresa_id'] = Auth::user()->empresa_id;
        $dados = array_map('strtoupper', array_map('strval', $dados));
        membros::create($dados);
        return redirect('/');
    }


    public function excluir_membro(request $request)
    {
        $destroy = $request->id;
        membros::destroy($destroy); //banco de dados com apagar cascade, todos os dizimos desses usuarios vão ter apagados tambem
        return redirect('/');
    }


    public function eventos()
    {
        $empresa_id = Auth::user();
        $razao_empresa = $empresa_id->empresas->first();
        $razao_empresa = $razao_empresa->razao;
        $eventos = Eventos::where('empresa_id', Auth::user()->empresa_id)->get()
            ->map(function ($eventos) {
                // Formatar a data 'data_evento' para 'd/m/Y'
                $eventos->datereg = Carbon::parse($eventos->datereg)->format('d/m/Y');
                return $eventos;
            });
        $membros = membros::where('empresa_id', Auth::user()->empresa_id)->get();
        return Inertia::render('Eventos', compact('eventos', 'membros'));
    }

    public function presença_evento()
    {
        $membros = membros::all();
        $empresa_id = Auth::user();
        $razao_empresa = $empresa_id->empresas->first();
        $razao_empresa = $razao_empresa->razao;
        return Inertia::render('Presenca', compact('membros'));
    }

    public function regitrar_presenca(Request $request)
    {
        //dd($request->all());
        $membros = membros::where('empresa_id', Auth::user()->empresa_id)->count();
        $presentes = $request->input('presenca');
        $presentes = count($presentes);
        $faltantes = $membros - $presentes;


        $evento = Eventos::create([
            'user_id' => Auth::id(),
            'empresa_id' => Auth::user()->empresa_id,
            'evento' => $request->input('evento'),
            'datereg' => $request->input('datereg'),
            'presentes' => $presentes,
            'faltantes' => $faltantes
        ]);


        foreach ($request->input('presenca') as $presente) {
            $presenca = new Eventos_presencas();
            $presenca->evento_id = $evento->id;
            $presenca->membro_id = $presente;
            $presenca->save();
            $membros = membros::find($presente);
            $membros->presenca += 1;
            $membros->save();
        }

        return redirect('/eventos');
    }
}
