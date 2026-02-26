<?php
// Arquivo Documentado em "OfertasController.php"
namespace App\Http\Controllers;

use App\Events\FilaEmail;
use App\Jobs\EnvioEmail as JobsEnvioEmail;
use App\Mail\EnvioEmail;
use App\Models\caixas;
use App\Models\despesas;
use App\Models\ofertas;
use App\Models\membros;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\dizimos;
use App\Models\empresas;
use App\Models\Jobs;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class DizimosController extends Controller
{
    /*Dizimos Por Usuario*/

    //......................................................Parte 1................................................//


    public function filter_page()
    {
        $empresa_id = Auth::user()->empresa_id;

        // Buscando todos os dízimos da empresa
        $dizimos = dizimos::with('membros')
            ->where('empresa_id', $empresa_id)
            ->orderBy('datereg', 'desc')
            ->get()
            ->map(function ($dizimo) {
                // Formatar a data 'datereg' para 'd/m/Y'
                $dizimo->datereg_formatada = Carbon::parse($dizimo->datereg)->format('d/m/Y');
                return $dizimo;
            });

        $dados = [
            'dizimos' => $dizimos,
            'datanow' => Carbon::now()->format('Y-m-d'),
            'razao_empresa' => empresas::where('id', $empresa_id)->value('razao')
        ];

        $membros = membros::where('empresa_id', $empresa_id)
            ->orderBy('nome', 'asc')
            ->get();

        return Inertia::render('Dizimos', compact('dados', 'membros'));
    }

    //......................................................Parte 2................................................//



    public function botao_registrar_dizimo(request $request)
    {

        if (MeuServico::Verificar($request->datereg) == true) {
            // dd($request->all());
            $dados = $request->only('id', 'datereg', 'valor', 'membro_id');

            // Buscar o nome do membro para salvar redundância
            $membro = membros::find($request->membro_id);
            $dados['nome'] = $membro ? $membro->nome . ' ' . $membro->sobrenome : 'Membro não encontrado';

            $dados['user_id'] = Auth::id();
            $dados['empresa_id'] = Auth::user()->empresa_id;
            $dados['valor'] = str_replace(',', '.', $dados['valor']);
            dizimos::create($dados);
            Session()->flash('sucesso', 'Item criado com Sucesso');

        } else {
            Session()->flash('falha', 'Falha ao criar item, Caixa Fechado');
        }

        return redirect('/tela/dizimos');
    }

    //......................................................Parte 3................................................//

    public function botao_excluir_dizimo(request $request)
    {
        $data = dizimos::find($request->id);

        if (MeuServico::Verificar($data->datereg)) {
            $destroy = $request->id;
            dizimos::destroy($destroy);
            Session()->flash('sucesso', 'Item Apagado com Sucesso');
        } else {
            Session()->flash('falha', 'Falha ao apagar item, Caixa Fechado');
        }

        return redirect('/tela/dizimos');
    }


}


