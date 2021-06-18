<?php

//OTHER'S NAMESPACE
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ProjetosRequest;
use Auth;

//MODELS
use App\Models\Projeto;
use App\Models\Localidade;
use App\Models\Proponente;
use App\Models\ModalidadeApoio;
use App\Models\TipoProjeto;
use App\Models\Setor;
use App\Models\User;
use App\Models\ProjetoAtividade;
use App\Models\ElementoDespesa;
use App\Models\FonteRecurso;
use App\Models\Lote;

class ProjetosController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projeto = new Projeto;
        $localidade = new Localidade;
        $proponente = new Proponente;   
        $modApoio = new ModalidadeApoio;
        $tipoProjeto = new TipoProjeto;
        $setor = new Setor;
        $user = new User;
        $projetoAtividade = new ProjetoAtividade;
        $elementoDespsa = new ElementoDespesa;
        $fonteRecurso = new FonteRecurso;
        $lote = new Lote;

        $optionsProponentes = $proponente
                    ->where('ativo', 'S')
                    ->pluck('nome_proponente', 'id')
                    ->toArray();

        $optionsLocalidades = $localidade 
                    ->where('ativo', 'S')
                    ->pluck('localidade', 'id')
                    ->toArray();

        $optionsModApoio = $modApoio
                    ->where('ativo', 'S')
                    ->pluck('modalidade_apoio', 'id')
                    ->toArray();

        $optionsTipoProjeto = $tipoProjeto
                    ->where('ativo','S')
                    ->pluck('nome_tipo', 'id')
                    ->toArray();

        $optionsSetorOrigem = $setor
                    ->where('ativo', 'S')
                    ->pluck('descsetor', 'id')
                    ->toArray();

        $optionsUsers = $user   
                    ->pluck('name', 'id')
                    ->toArray();

        $optionsProjetoAtividade = $projetoAtividade 
                    ->where('ativo', 'S')  
                    ->pluck('desc_projeto_ativi', 'id')
                    ->toArray();

        $optionsElemDespesa = $elementoDespsa
                    ->where('ativo', 'S')
                    ->pluck('desc_elemento', 'id')
                    ->toArray();
                    
        $optionsFonteRecurso = $fonteRecurso
                    ->where('ativo', 'S')
                    ->pluck('desc_fonte', 'id')
                    ->toArray();

        $optionsLotes = $lote
                    ->where('ativo', 'S')
                    ->pluck('nome', 'id')
                    ->toArray();

        $view = view('projetos.index')
            ->with('dataProjetos', $projeto->getProjetos($request->all()))
            ->with('optionsProponentes', $optionsProponentes)
            ->with('optionsLocalidades', $optionsLocalidades)
            ->with('optionsModApoio', $optionsModApoio)
            ->with('optionsTipoProjeto', $optionsTipoProjeto)
            ->with('optionsSetorOrigem', $optionsSetorOrigem)
            ->with('optionsUsers', $optionsUsers)
            ->with('optionsProjetoAtividade', $optionsProjetoAtividade)
            ->with('optionsElemDespesa', $optionsElemDespesa)
            ->with('optionsFonteRecurso', $optionsFonteRecurso)
            ->with('optionsLotes', $optionsLotes);

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $tipoProjeto = new TipoProjeto;
        $proponente = new Proponente;
        $setor = new Setor;
        $modApoio = new ModalidadeApoio;
        $localidade = new Localidade;

        $optionsSetorOrigem = $setor 
                ->where('ativo', 'S')
                ->pluck('descsetor', 'id')
                ->toArray();

        $optionsProponente = $proponente 
                ->where('ativo', 'S')
                ->pluck('nome_proponente', 'id')
                ->toArray();

        $optionsTipoProjeto = $tipoProjeto
                ->where('ativo', 'S')
                ->pluck('nome_tipo', 'id')
                ->toArray();

        $optionsModApoio = $modApoio
                ->where('ativo', 'S') 
                ->pluck('modalidade_apoio', 'id')
                ->toArray();

        $optionsLocalidade = $localidade        
                ->where('ativo', 'S')
                ->pluck('localidade', 'id')
                ->toArray();
            
        return view('projetos.create')
            ->with('optionsSetorOrigem', $optionsSetorOrigem)
            ->with('optionsProponente', $optionsProponente)
            ->with('optionsTipoProjeto', $optionsTipoProjeto)
            ->with('optionsModApoio', $optionsModApoio)
            ->with('optionsLocalidade', $optionsLocalidade);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjetosRequest $request)
    {
        $projeto = new Projeto; 
        $user = Auth::user();
    
        $data = $projeto->saveProjeto($request->all(), $user);
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {       
        $tipoProjeto = new TipoProjeto;
        $proponente = new Proponente;
        $setor = new Setor;
        $modApoio = new ModalidadeApoio;
        $localidade = new Localidade;
        $projeto = new Projeto;

        $optionsSetorOrigem = $setor 
                ->where('ativo', 'S')
                ->pluck('descsetor', 'id')
                ->toArray();

        $optionsProponente = $proponente 
                ->where('ativo', 'S')
                ->pluck('nome_proponente', 'id')
                ->toArray();

        $optionsTipoProjeto = $tipoProjeto
                ->where('ativo', 'S')
                ->pluck('nome_tipo', 'id')
                ->toArray();

        $optionsModApoio = $modApoio
                ->where('ativo', 'S') 
                ->pluck('modalidade_apoio', 'id')
                ->toArray();

        $optionsLocalidade = $localidade        
                ->where('ativo', 'S')
                ->pluck('localidade', 'id')
                ->toArray();

        return view('projetos.edit')
            ->with('optionsSetorOrigem', $optionsSetorOrigem)
            ->with('optionsProponente', $optionsProponente)
            ->with('optionsTipoProjeto', $optionsTipoProjeto)
            ->with('optionsModApoio', $optionsModApoio)
            ->with('optionsLocalidade', $optionsLocalidade)
            ->with('projeto', $projeto->getProjetoById($id));
    }

     /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjetosRequest $request, $id)
    {
        $projeto = new Projeto;
        $user = Auth::user();

        $data = $projeto->updateProjeto($id, $request->all(), $user);       
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projeto = new Projeto;

        return view('projetos.view')
            ->with('projeto', $projeto->getProjetoById($id));
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
