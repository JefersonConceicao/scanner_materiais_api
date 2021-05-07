<?php

namespace App\Http\Controllers;

//OTHERS NAMESPÁCES 
use App\Http\Requests\PermissaoRequest;
use Illuminate\Http\Request;
use Auth;
use Session;
//MODELS 
use App\Models\Permission;
use App\Models\Modulo;
use App\Models\Funcionalidade; 
use App\Models\User;

class PermissoesController extends Controller
{
    public function index(){
        $permissao = new Permission;
        $modulo = new Modulo;
        $funcionalidades = new Funcionalidade;
        
        $view = view('permissoes.index')
            ->with('moduloWithFuncionalidades', $modulo->getModulosWithFuncionalidades())
            ->with('moduloNoRelations', count($modulo->modulosNoRelations()))
            ->with('permissionsVinculadas', $funcionalidades->permissoesVinculadas())
            ->with('permissionsSemVinculo', count($permissao->permissionsNoRelations()))
            ->with('dataFuncionalidades', $funcionalidades->getFuncionalidades()->get())
            ->with('totalModulos', $modulo->count())
            ->with('modulosAtivos', count($modulo->getModulosAtivos()))
            ->with('modulosInativos', count($modulo->getModulosInativos()))
            ->with('permAdicionar', count($permissao->permissionsAdded()))
            ->with('permRemover', count($permissao->permissionsRemoved()))
            ->with('total', $permissao->count())
            ->with('lastLogin', Auth::user()->last_login);
                
        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create(){
        $permissao = new Permission;     
        $permissoes = $permissao->savePermissions();

        return view('permissoes.create')
                ->with('permAdicionadas', $permissoes['permissionsAdded'])
                ->with('permRemoved', $permissoes['permissionsRemoved']);
    }

    public function renderViewSessionRevalid(){
        return view('permissoes.session_reload')
            ->with('user', Auth::user());
    }

    public function reloadSession(PermissaoRequest $request){
        $user = new User; 

        $response = [
            'msg' => 'Credenciais incorretas!',
            'error' => true,
        ];

        $credentials = [ 
            'email' => Auth::user()->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            $response['msg'] = "Sessão revalidada com sucesso!";
            $response['error'] = false;
        } 
        
        return response()->json($response);
    }

    public function renderNotAllowed(){
        return view('permissoes.nao_permitido');
    }
}
