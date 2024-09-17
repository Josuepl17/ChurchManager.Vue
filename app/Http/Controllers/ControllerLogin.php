<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormFilial;
use App\Http\Requests\FormFilialUsers;
use App\Jobs\EnvioEmail;
use App\Mail\EnvioEmail as MailEnvioEmail;
use App\Models\caixas;
use App\Models\despesas;
use App\Models\ofertas;
use App\Models\membros;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\dizimos;
use App\Models\empresa;
use App\Models\empresas;
use App\Models\Relacionamento;
use App\Models\Relacionamentos;
use App\Models\user_empresas as ModelsRelacionamentos;
use App\Models\user_empresas;
use App\Models\User;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\Object_;
use PhpParser\Node\Expr\FuncCall;

class ControllerLogin extends Controller
{

    //......................................................LOGIN E AUTH................................................//

    public function login()
    {
        return Inertia::render('Login');
    }

    public function formulario_usuario_empresa()
    {
        return Inertia::render('Cadastro-Filial-Users');
    }

    public function cadastro_usuario_empresa(FormFilialUsers $request)
    {
        if (MeuServico::verificar_login($request)) {
            return back()->withInput()->withErrors(['email' => 'Esse Email Já Está Cadastrado']);
        }

        if (MeuServico::verificar_empresa($request)) {
            return back()->withInput()->withErrors(['email' => 'Esse CNPJ Já Está Cadastrado']);
        }

        $empresa = empresas::create([
            'razao' => $request->razao,
            'cnpj' => $request->cnpj
        ]);

        $user = new User();
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->empresa_id = $empresa->id;
        $user->nivel = 'admin';
        $user->save();

        $user_empresas = new user_empresas();
        $user_empresas->user_id = $user->id;
        $user_empresas->empresa_id = $empresa->id;
        $user_empresas->save();
        return redirect('/login');
    }


    public function autenticar_usuario(FormFilialUsers $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]) || Auth::attempt(['email' => strtoupper($credentials['email']), 'password' => $credentials['password']])) {
            return redirect('/selecionar/filial');
        } else{
            if(MeuServico::verificar_login($request)){
                return back()->withInput()->withErrors(['login' => 'Login Incorreto.']);
            } else{
                return back()->withInput()->withErrors(['login' => 'Usuario Não Existe..']);
            }
        }
       
        return redirect('/login');
    }


    //......................................................Usuario................................................//

    public function tela_usuarios()
    {
        $user_id = Auth::user()->id;
        $relacionamentos = user_empresas::where('user_id', $user_id)->pluck('empresa_id'); // peguei as empresas relacionadas ao meu usuario.
        $empresas = user_empresas::whereIn('empresa_id', $relacionamentos)->pluck('user_id'); // peguei todos os usuarios relacionados as empresas
        $users = User::whereIn('id', $empresas)
            ->where('id', '!=', Auth::user()->id)
            ->get(); // busquei

        //$razao_empresa = empresas::where('id', auth()->user()->empresa_id)->value('razao');
        return Inertia::render('Tela-Users', compact('users'));
    }

    public function formulario_adicionar_usuario()
    {
        $user_id = Auth::user()->id;
        $dados = user_empresas::where('user_id', $user_id)->pluck('empresa_id');
        $empresas = empresas::whereIn('id', $dados)->get();
        return Inertia::render('Adicionar-Users', compact('empresas'));
    }

    public function adicionar_usuario(FormFilialUsers $request)
    {
        
        if (MeuServico::verificar_login($request)) {

            return back()->withInput()->withErrors(['email' => 'Esse Email Já Está Cadastrado']);
        }
        $user = new User();
        $user->nome = $request->user;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->empresa_id = Auth::user()->empresa_id;;
        $user->save();


        if ($empresasMarcadas = $request->input('empresas')) {
            foreach ($empresasMarcadas as $emp) {
                $user_empresas = new user_empresas();
                $user_empresas->user_id = $user->id;
                $user_empresas->empresa_id = $emp;
                $user_empresas->save();
            }
        }

        return redirect('/user/profile');
    }




    public function formulario_editar_usuario(Request $request)
    {
        $user_id = Auth::user()->id;
        $dados = user_empresas::where('user_id', $user_id)->pluck('empresa_id');
        $empresas = empresas::whereIn('id', $dados)->get();
        $user_editar = User::find($request->user_id);
        $empresasSelecionadas = user_empresas::where('user_id', $user_editar->id)->pluck('empresa_id')->toArray();
        return Inertia::render('Editar-User', compact('empresas', 'user_editar', 'empresasSelecionadas'));
    }

    public function editar_usuario(FormFilialUsers $request)
    {
        $empresasMarcadas = $request->empresas;
        

        $user = User::find($request->user_id);

        if ($user->email != $request->email) {

            
    
                    if (MeuServico::verificar_login($request)) {
                        return back()->withInput()->withErrors(['email' => 'Esse Novo Email Já Está Cadastrado']);

                    } else {
                        if( count($empresasMarcadas) == 0){
                            dd("deve ter pelo menos 1");
                             
                         } else{
                             user_empresas::where('user_id', $request->user_id)->delete();
             
                         }
            
                        $user->nome = $request->nome;
                        $user->email = $request->email;
                        $user->save();
            
                        if ($empresasMarcadas = $request->empresas) {
                            foreach ($empresasMarcadas as $emp) {
                                $user_empresas = new user_empresas();
                                $user_empresas->user_id = $user->id;
                                $user_empresas->empresa_id = $emp;
                                $user_empresas->save();
                            }
                        }
                    }
        } else {
            // Se o email é igual, apenas atualiza os outros dados
            if( count($empresasMarcadas) == 0){
               dd("deve ter pelo menos 1");
                
            } else{
                user_empresas::where('user_id', $request->user_id)->delete();

            }
           
            $user->nome = $request->nome;
            $user->save();
    
            if ($empresasMarcadas = $request->empresas) {
                foreach ($empresasMarcadas as $emp) {
                    $user_empresas = new user_empresas();
                    $user_empresas->user_id = $user->id;
                    $user_empresas->empresa_id = $emp;
                    $user_empresas->save();
                }
            }
        }
    
        return redirect('/user/profile');
    }


    //......................................................EMPRESAS................................................//

    public function selecionar_filial()
    {
        $user_id = Auth::user()->id;
        $relacionamentos = user_empresas::where('user_id', $user_id)->pluck('empresa_id');
        $empresas = empresas::whereIn('id', $relacionamentos)->get();
        return Inertia::render('Selecionar-Filial', compact('empresas'));
    }


    public function formulario_adicionar_empresa()
    {
        $user_id = Auth::user()->id;
        $relacionamentos = user_empresas::where('user_id', $user_id)->pluck('empresa_id'); // peguei as empresas relacionadas ao meu usuario.
        $users_id = user_empresas::whereIn('empresa_id', $relacionamentos)->pluck('user_id'); // peguei todos os usuarios relacionados as empresas
        $users = User::whereIn('id', $users_id)
            ->where('id', '!=', Auth::user()->empresa_id)
            ->get(); // busquei

        

        return Inertia::render('Adicionar-Filial', compact('users'));
    }

    public function adicionar_empresa(FormFilialUsers $request)
    {
        //dd($request->all());
        if (MeuServico::verificar_empresa($request)) {
            return back()->withInput()->withErrors(['cnpj' => 'Esse CNPJ Já Está Cadastrado']);
        }

        $empresa = empresas::create([
            'razao' => $request->razao,
            'cnpj' => $request->cnpj
        ]);

        if ($usuariosMarcados = $request->input('user')) { // se existir dados
            foreach ($usuariosMarcados as $user) {
                $user_empresas = new user_empresas();
                $user_empresas->user_id = $user;
                $user_empresas->empresa_id = $empresa->id;
                $user_empresas->save();
            }
        }

        //relacionando usuario ADM
        $user_empresas = new user_empresas();
        $user_empresas->user_id = Auth::user()->id;
        $user_empresas->empresa_id = $empresa->id;
        $user_empresas->save();

        return redirect('/selecionar/filial');
    }

    //......................................................RECUPERA................................................//


    public function esqueci_senha(){

        return Inertia::render('Recupere-Senha');
    }

    public function gera_codigo(FormFilialUsers $request)
    {
       
        //$usuario = User::where('email', $request->email)->first();
        

        if (MeuServico::verificar_login($request)) {
            $user_id = User::where('email', $request->email)->first();
            $codigo = rand(100000, 999999);
            Session()->put('codigo', $codigo);
            Session()->put('user_id', $user_id );
            Mail::send(new MailEnvioEmail($codigo, $request->email));
            return redirect('/recebe/codigo');
        } else {
            return back()->withInput()->withErrors(['email' => 'Esse email Não Está Cadastrado']);
        }
    }

    public function recebe_codigo(){

        return Inertia::render('Recebe-Codigo');
    }

    public function confirma_codigo(FormFilialUsers $request)
    {
    

        if ($request->codigo == Session()->get('codigo')) {
            session()->forget('codigo');
            return redirect('/form/atualiza/usuario');
        } else {
            return back()->withInput()->withErrors(['codigo' => 'Codigo Incorreto!']);
        }
    }

    public function form_atualiza_usuario(){

        $user = User::find(Session()->get('user_id'))->first();
        return Inertia::render('Atualizar-Usuarios', compact('user'));
    }



    public function atualizar_usuario(FormFilialUsers $request)
    {
        $user = User::find(Session()->get('user_id'))->first();
        if ($user->email != $request->email){
            if ( User::where('email',  $request->email)->first()){
                return back()->withInput()->withErrors(['email' => 'Novo email Já Cadastrado']);
            }     
        }

        Session()->flush();
        
            $user->nome = $request->user;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/login');

    }

    //......................................................LOGIN................................................//

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    

    
}
