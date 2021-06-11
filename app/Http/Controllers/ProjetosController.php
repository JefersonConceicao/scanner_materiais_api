<?php

//OTHER'S NAMESPACE
namespace App\Http\Controllers;
use Illuminate\Http\Request;

//MODELS
use App\Models\Projeto;
use App\Models\Localidade;
use App\Models\Proponente;
use App\Models\ModalidadeApoio;

class ProjetosController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projeto = new Projeto;
        $localidade = new Localidade;
        $proponente = new Proponente;   
        $modApoio = new ModalidadeApoio;

        
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

        $view = view('projetos.index')
            ->with('dataProjetos', $projeto->getProjetos())
            ->with('optionsProponentes', $optionsProponentes)
            ->with('optionsLocalidades', $optionsLocalidades)
            ->with('optionsModApoio', $optionsModApoio);

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
