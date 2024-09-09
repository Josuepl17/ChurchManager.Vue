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
       

        
        // Obtendo as datas e outros parâmetros da sessão
        $dataini = Session()->get('dataini_d');
        $datafi = Session()->get('datafi_d');
        $empresa_id = Auth::user()->empresa_id;
        $membro_id = Session()->get('membro_id');
        $nome = Session()->get('nome');
        
        // Definindo a consulta base
        $query = dizimos::where('empresa_id', $empresa_id)
                        ->where('membro_id', $membro_id);
        
        // Adicionando o filtro de datas somente se ambas as datas forem definidas
        if ($dataini && $datafi) {
            $query->whereBetween('datereg', [$dataini, $datafi]);
        }
        
        // Executando a consulta e formatando os dados
        $dados = [
            'dizimos' => $query->get()
                               ->map(function ($dizimo) {
                                   // Formatar a data 'datereg' para 'd/m/Y'
                                   $dizimo->datereg = Carbon::parse($dizimo->datereg)->format('d/m/Y');
                                   return $dizimo;
                               }),
        
            'totaldizimos' => $query->clone()->get()->sum('valor'), // Usando clone para evitar modificar a consulta original
            'datanow' => Carbon::now()->format('d-m-Y'),
            'razao_empresa' => empresas::where('id', $empresa_id)->value('razao')
        ];
        
      
            return Inertia::render('Dizimos', compact('dados', 'dataini', 'datafi', 'membro_id', 'nome'));
    }

//......................................................Parte 2................................................//

        public function filtro(Request $request){
          //  dd($request->all());
            Session()->put('dataini_d', $request->dataini);
            Session()->put('datafi_d', $request->datafi);
            Session()->put('membro_id', $request->membro_id);
            Session()->put('nome', $request->nome);
            return redirect('/tela/dizimos');
        }



    public function botao_registrar_dizimo(request $request)
    {
       
        if (MeuServico::Verificar($request->datereg) == true) {
           // dd($request->all());
            $dados = $request->only('id', 'datereg', 'valor', 'membro_id');
            $dados['user_id'] = Auth::id();
            $dados['empresa_id'] = Auth::user()->empresa_id;
            $dados['valor'] = str_replace(',', '.', $dados['valor']);
            dizimos::create($dados);
            Session()->flash('sucesso', 'Item criado com Sucesso');

        } else {
            Session()->flash('falha',  'Falha ao criar item, Caixa Fechado');
        }

            return redirect('/tela/dizimos');
        }

//......................................................Parte 3................................................//

    public function botao_excluir_dizimo(request $request) {
            $data = dizimos::find($request->id);
            
        if (MeuServico::Verificar($data->datereg)) {
            $destroy = $request->id;
            dizimos::destroy($destroy);
            Session()->flash('sucesso',  'Item Apagado com Sucesso');
        } else {
            Session()->flash('falha',  'Falha ao apagar item, Caixa Fechado');
        }
           
            return redirect('/tela/dizimos');
    }


}


