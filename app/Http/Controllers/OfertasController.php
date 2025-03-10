<?php

namespace App\Http\Controllers;


use App\Models\caixas;
use App\Models\despesas;
use App\Models\ofertas;
use App\Models\membros;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\dizimos;
use App\Models\empresas;
use App\Models\User;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OfertasController extends Controller
{
    /*Ofertas*/
    //......................................................Parte 1................................................//
    public function filter_page()
    {

        $dataini = Session()->get('dataini'); // Se tem requisção ele usa e não tem o padrão é 1900-01-01 
        $datafi = Session()->get('datafi'); // Se tem requisção ele usa e não tem o padrão é 5000-01-01 
        $empresa_id = Auth::user()->empresa_id; // acessa o dado da coluna do usuario conectado


        $queryOfertas = ofertas::where('empresa_id', $empresa_id);

        // Adicionando o filtro de datas somente se ambas as datas forem definidas
        if ($dataini && $datafi) {
            $queryOfertas->whereBetween('datereg', [$dataini, $datafi]);
        }

        // Executando as consultas e formatando os dados
        $dados = [
            'ofertas' => $queryOfertas->get()
                ->map(function ($oferta) {
                    // Formatar a data 'datereg' para 'd/m/Y'
                    $oferta->datereg = \Carbon\Carbon::parse($oferta->datereg)->format('d/m/Y');
                    return $oferta;
                }),
            'totalofertas' => $queryOfertas->clone()->sum('valor'), // Usando clone para evitar modificar a consulta original
            'datanow' => \Carbon\Carbon::now()->format('Y-m-d'), // Formatando a data atual como 'd/m/Y'
            'razao_empresa' => \App\Models\Empresas::where('id', $empresa_id)->value('razao')
        ];

        return Inertia::render('Ofertas', compact('dados', 'dataini', 'datafi'));
    }



    //......................................................Parte 2................................................//

    public function filtro(Request $request)
    {
        Session()->flash('dataini', $request->dataini);
        Session()->flash('datafi', $request->datafi);
        return redirect('/oferta');
    }

    public function registrar_oferta(request $request) // get pelo flash mensage
    {
        if (MeuServico::Verificar($request->datereg)) { // verifica se as data esta entre as duas datas do caixa
            $dados = $request->all();
            $dados['user_id'] = Auth::id(); // acessa o ID do usuario Autenticado e inseri na variavel dados
            $dados['empresa_id'] = Auth::user()->empresa_id; // acessa o dado da coluna do usuario conectado e inseri na variavel dados
            $dados['valor'] = str_replace(',', '.', $dados['valor']); // Troca virgula por Ponto e Inseri na Variavel Dados 
            ofertas::create($dados); // Cria o Registro da Nova Oferta
            Session()->flash('sucesso',  'Item Criado Com Sucesso');
        } else {
            Session()->flash('falha',  'Falha ao apagar item, Caixa Fechado');
        }


        return redirect('/oferta');
    }

    //......................................................Parte 3................................................//

    public function botao_excluir_oferta(request $request)
    {
        $data = ofertas::find($request->id);
        if (MeuServico::Verificar($data->datereg)) { //verifica se as data esta entre as duas datas do caixa
            $destroy = $request->id;
            ofertas::destroy($destroy); // apaga o registro que tenha esse ID
            Session()->flash('sucesso',  'Item Apagado com Sucesso');
        } else {
            Session()->flash('falha',  'Falha ao apagar item, Caixa Fechado');
        }

        Session()->flash('dataini', $request->dataini);
        Session()->flash('datafi', $request->datafi);
        return redirect('/oferta');
    }
}
