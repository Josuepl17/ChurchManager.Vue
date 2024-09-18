<?php
// Arquivo Documentado em "OfertasController.php"
namespace App\Http\Controllers;


use App\Models\caixas;
use App\Models\Descricao_despesas;
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
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Else_;

class DespesasController extends Controller
{

    //......................................................Parte 1................................................//
    public function filter_page()
    {
        $dataini = Session()->get('dataini');
        $datafi = Session()->get('datafi');
        $empresa_id = Auth::user()->empresa_id;

        // Inicializando a consulta para Descricao_despesas
        $queryDescricao = Descricao_despesas::where('empresa_id', $empresa_id)->orderBy('id', 'desc')->take(10);

        // Inicializando a consulta para Despesas
        $queryDespesas = despesas::where('empresa_id', $empresa_id);

        // Adicionando o filtro de datas somente se ambas as datas forem definidas
        if ($dataini && $datafi) {
            $queryDespesas->whereBetween('datereg', [$dataini, $datafi]);
        }

        // Executando as consultas e formatando os dados
        $dados = [
            'descricao' => $queryDescricao->get(),
            'despesas' => $queryDespesas->get()
                ->map(function ($despesa) {
                    // Formatar a data 'datereg' para 'd/m/Y'
                    $despesa->datereg = \Carbon\Carbon::parse($despesa->datereg)->format('d/m/Y');
                    return $despesa;
                }),
            'totaldespesas' => $queryDespesas->clone()->sum('valor'), // Usando clone para evitar modificar a consulta original
            'datanow' => \Carbon\Carbon::now()->format(('Y-m-d')), // Formatando a data atual como 'd/m/Y'
            'razao_empresa' => \App\Models\Empresas::where('id', $empresa_id)->value('razao')
        ];


        return Inertia::render('Despesas', compact('dados', 'dataini', 'datafi'));
    }



    //......................................................Parte 2................................................//

    public function filtro(Request $request)
    {

        Session()->flash('dataini', $request->dataini);
        Session()->flash('datafi', $request->datafi);
        return redirect('/despesas');
    }
    public function botao_registrar_despesas(request $request)
    {

        if (Descricao_despesas::where('descricao_despesas', $request->descricao)->first() == null) {
            $descricao = new Descricao_despesas();
            $descricao->empresa_id =  Auth::user()->empresa_id;
            $descricao->descricao_despesas = $request->descricao;
            $descricao->save();
        }

        if (MeuServico::Verificar($request->datereg) == true) {
            $dados = $request->all();
            $dados['user_id'] = Auth::id(); //acessa o ID do usuario Autenticado
            $dados['empresa_id'] = Auth::user()->empresa_id; // acessa o dado da coluna do usuario conectado
            $dados['valor'] = str_replace(',', '.', $dados['valor']);
            despesas::create($dados);

            Session()->flash('sucesso', 'Item criado com Sucesso');
        } else {
            Session()->flash('falha',  'Falha ao criar item, Caixa Fechado');
        }

        Session()->flash('dataini', $request->dataini);
        Session()->flash('datafi', $request->datafi);

        return redirect('/despesas');
    }

    //......................................................Parte 3................................................//

    public function botao_excluir_despesas(request $request)
    {
        $data = despesas::find($request->id);
        if (MeuServico::Verificar($data->datereg)) {
            $destroy = $request->id;

            despesas::destroy($destroy);
            Session()->flash('sucesso',  'Item Apagado com Sucesso');
        } else {
            Session()->flash('falha',  'Falha ao apagar item, Caixa Fechado');
        }
        Session()->flash('dataini', $request->dataini);
        Session()->flash('datafi', $request->datafi);
        return redirect('/despesas');
    }
}
