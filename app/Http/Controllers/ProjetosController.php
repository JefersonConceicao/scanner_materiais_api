<?php

//OTHER'S NAMESPACE
namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
