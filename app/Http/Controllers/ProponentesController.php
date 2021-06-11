<?php

//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ProponentesRequest;
use Auth;

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
        $user = Auth::user();
        $proponente = new Proponente;

        $data = $proponente->saveProponente($request->all(), $user);
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proponente = new Proponente;
        $localidade = new Localidade;

        $optionsLocalidade = $localidade    
                            ->where('ativo', '=', 'S')
                            ->pluck('localidade', 'id')
                            ->toArray();

        return view('proponentes.edit')
            ->with('optionsLocalidade', $optionsLocalidade)
            ->with('proponente', $proponente->find($id));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProponentesRequest $request, $id)
    {
        $user = Auth::user();
        $proponente = new Proponente;

        $data = $proponente->updateProponente($id, $request->all(), $user);
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {   
        $proponente = new Proponente;

        $data = $proponente->deleteProponente($id);
        return response()->json($data);
    }

    public function getCNPJProponenteReceita($cnpj){
        $data = getReceitaWSCNPJ($cnpj);

        return response()->json($data);
    }
}
