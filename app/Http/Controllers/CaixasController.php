<?php
// Arquivo Documentado em "OfertasController.php"
namespace App\Http\Controllers;


use App\Models\caixas;
use App\Models\despesas;
use App\Models\ofertas;
use App\Models\membros;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\dizimos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use App\Http\Controllers\ControllerIgreja;
use App\Models\empresas;
use App\Services\MeuServico;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mailer\Transport\Dsn;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CaixasController extends Controller
{
    /*Caixa*/

//......................................................Parte 1................................................//
    public function filter_page(Request $request)
    {
        $dataini = $request->dataini ?? '1000-01-01';
        $datafi = $request->datafi ?? '5000-01-01';
        $empresa_id = Auth::user()->empresa_id;

         $dados = [
            'totalofertas' => ofertas::where('empresa_id', $empresa_id)->whereBetween('datereg', [$dataini, $datafi])->sum('valor'),
            'totaldespesas' => despesas::where('empresa_id', $empresa_id)->whereBetween('datereg', [$dataini, $datafi])->sum('valor'),
            'totaldizimos' => dizimos::where('empresa_id', $empresa_id)->whereBetween('datereg', [$dataini, $datafi])->sum('valor'),
            'datanow' => Carbon::now()->format('Y-m-d'),
            'qtymembros' => membros::where('empresa_id', $empresa_id)->count(),
            'dataini' => $request->dataini,
            'datafi' => $request->datafi,
            'razao_empresa' => empresas::where('id', $empresa_id)->value('razao'),

        ];

        $saldo = $dados['totalofertas'] + $dados['totaldizimos'] - $dados['totaldespesas'];

        if ($dataini == '1900-01-01' && $datafi == '5000-01-01') {
            unset($dados['dataini'], $dados['datafi']);
           
            return Inertia::render('Resumo', compact('dados', 'saldo'));
        }
        return Inertia::render('Resumo', compact('dados', 'saldo'));
    }
//......................................................Parte 2................................................//

    public function gerar(Request $request)
    {
        $dataIni = $request->dataini ?? '1900-01-01';
        $dataFi = $request->datafi ?? '5000-01-01';
        $empresa_id = Auth::user()->empresa_id;

        $dados = [
            'ofertas' => ofertas::where('empresa_id', $empresa_id)->whereBetween('datereg', [$dataIni, $dataFi])->get(),
            'despesas' => despesas::where('empresa_id', $empresa_id)->whereBetween('datereg', [$dataIni, $dataFi])->get(),
            'dizimos' => dizimos::where('empresa_id', $empresa_id)->whereBetween('datereg', [$dataIni, $dataFi])->get(),
            'totalofertas' => ofertas::where('empresa_id', $empresa_id)->whereBetween('datereg', [$dataIni, $dataFi])->sum('valor'),
            'totaldespesas' => despesas::where('empresa_id', $empresa_id)->whereBetween('datereg', [$dataIni, $dataFi])->sum('valor'),
            'totaldizimos' => dizimos::where('empresa_id', $empresa_id)->whereBetween('datereg', [$dataIni, $dataFi])->sum('valor'),
        ];

        $pdf = pdf::loadView('relatorios-pdf.relatorioPDF', $dados); /*Carrega os Dados do PDF*/
        return $pdf->stream('Relatorio.pdf'); /*Gera o PDF*/
    }


//......................................................Parte 3................................................//

    public function fechar_caixa(Request $request)
    {
        dd($request->all());

        if (MeuServico::Verificar($request->dataini) & MeuServico::Verificar($request->datafi)) {
            $dados = $request->except('_token');
            $dados['user_id'] = Auth::id(); //acessa o ID do usuario Autenticado
            $dados['empresa_id'] = Auth::user()->empresa_id; // acessa o dado da coluna do usuario conectado QUE SE ALTERA TODA VEZ QUE ENTRA 
            caixas::create($dados);
            session()->flash('alert', 'Caixa Fechado Com Sucesso');
            return redirect('/relatorio');
        } else {
            session()->flash('alert', 'Atenção!! Falha ao Fechar Caixa');
            return redirect('/relatorio');
        }

    
    }


//......................................................Parte 4................................................//
    public function indexcaixa()
    {
        $empresa_id = Auth::user()->empresa_id;
        $dados = caixas::where('empresa_id', $empresa_id)->get();
        $razao_empresa = empresas::where('id', $empresa_id)->value('razao');
        $saldo = caixas::where('empresa_id', $empresa_id)->sum('saldo');;
        return view('paginas.caixa', compact('dados', 'saldo', 'razao_empresa'));
    }

    public function destroy_caixa(Request $request)
    {
        $destroy = $request->id;
        caixas::destroy($destroy);
        return redirect()->back();
    }






































}
