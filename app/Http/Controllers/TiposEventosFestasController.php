<?php

//OTHER'S NAMESPACE
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\TiposEventosFestaRequest;

//MODELS
use App\Models\TiposEventosFesta;


class TiposEventosFestasController extends Controller
{
    public function index(Request $request)
    {
        $tef = new TiposEventosFesta;

        $view = view('tipos_eventos_festas.index')
                ->with('dataTEF', $tef->getEventoFesta($request->all()));

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create()
    {
        return view('tipos_eventos_festas.create');
    }

    public function store(TiposEventosFestaRequest $request)
    {
        $tef = new TiposEventosFesta;

        $data = $tef->saveEventoFesta($request->all());
        return response()->json($data);
    }

    public function edit($id)
    {
        $tef = new TiposEventosFesta;
        return view('tipos_eventos_festas.edit')
            ->with('tef', $tef->getEventosFestaById($id));
    }

    public function update(Request $request, $id)
    {
        $tef = new TiposEventosFesta;

        $data = $tef->updateEventoFesta($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $tef = new TiposEventosFesta;

        $data = $tef->deleteEventoFesta($request->all());
        return response()->json($data);
    }
}
