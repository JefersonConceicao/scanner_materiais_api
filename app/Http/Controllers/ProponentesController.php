<?php

//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ProponentesRequest;

//MODELS
use App\Models\Proponente;
use App\Models\Localidade;

class ProponentesController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proponente = new Proponente;

        $view = view('proponentes.index')->with('dataProponentes', $proponente->getProponentes($request->all()));

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        $localidade = new Localidade;
             
        $optionsLocalidade = $localidade
                            ->where('ativo', '=', 'S')
                            ->pluck('localidade', 'id')
                            ->toArray();
    
        return view('proponentes.create')
            ->with('optionsLocalidade', $optionsLocalidade);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProponentesRequest $request)
    {
        $proponente = new Proponente;

        $data = $proponente->saveProponente($request->all());
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }

    public function getCNPJProponenteReceita($cnpj){
        $data = getReceitaWSCNPJ($cnpj);

        return response()->json($data);
    }
}
