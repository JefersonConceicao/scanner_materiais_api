<?php

namespace App\Http\Controllers;

//OTHER'S NAMESPACES
use Illuminate\Http\Request;
use App\Http\Requests\TipoInfraestruturaRequest;

//MODELS
use App\Models\TipoInfraestrutura;

class TiposInfraestruturasController extends Controller
{
    public function index(Request $request)
    {   
       $tiposIE = new TipoInfraEstrutura;

       $view = view('tipos_infraestruturas.index')
            ->with('dataTiposIE', $tiposIE->getTiposIE($request->all()));

       return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create()
    {
        return view('tipos_infraestruturas.create');
    }

    public function store(TipoInfraestruturaRequest $request)
    {
        $tiposIE = new TipoInfraEstrutura;

        $data = $tiposIE->saveTiposIE($request->all());
        return response()->json($data);
    }

    public function edit($id)
    {
        $tiposIE = new TipoInfraEstrutura;
        return view('tipos_infraestruturas.edit')
            ->with('tiposIE',$tiposIE->getTiposIEByID($id));
    }

    public function update($id, TipoInfraestruturaRequest $request)
    {   
        $tiposIE = new TipoInfraEstrutura;

        $data = $tiposIE->updateTiposIE($id, $request->all());
        return response()->json($data);
    }

    public function delete($id)
    {
        $tiposIE = new TipoInfraEstrutura;

        $data = $tiposIE->deleteTiposIE($id);
        return response()->json($data);
    }

    public function deleteAll(Request $request){
        $tiposIE = new TipoInfraEstrutura;

        $data = $tiposIE->deleteRowsTiposIE($request->all());
        return response()->json($data);
    }
}
