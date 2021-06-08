<?php

//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CheckListEstruturaRequest;

//MODELS
use App\Models\CheckListEstrutura;
use App\Models\CheckListModelo;
use App\Models\CheckListItem;

class CheckListEstruturasController extends Controller
{
    public function index(Request $request)
    {      
        $checkListModelo = new CheckListModelo;
        $checkListEstrutura = new CheckListEstrutura;

        $view = view('checklist_estruturas.index')
                ->with('optionsModelo', $checkListModelo->pluck('modelo', 'id')->toArray())
                ->with('dataModeloEstruturas', $checkListEstrutura->getModelosEstrutura($request->all()));

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create()
    {       
        $checkListModelo = new CheckListModelo;
        $checkListItem = new CheckListItem;

        $optionsModelos = $checkListModelo
                    ->getModelosWithoutRelations()
                    ->pluck('modelo', 'id')
                    ->toArray();

        $optionsItens = $checkListItem->pluck('descricao_item', 'id')->toArray();

        return view('checklist_estruturas.create')
            ->with('optionsModelo', $optionsModelos)    
            ->with('optionsItens', $optionsItens);
    }

    public function store(CheckListEstruturaRequest $request)
    {
        $chkEstrutura = new CheckListEstrutura;

        $data = $chkEstrutura->saveCheckListEstrutura($request->all()); 
        return response()->json($data);
    }

    public function edit($id)
    {   
        $checkListItem = new CheckListItem;
        $checkListModelo = new CheckListModelo;
        $checkListEstrutura = new CheckListEstrutura;

        $optionsModelos = $checkListModelo
            ->pluck('modelo', 'id')
            ->toArray();

        $optionsItens = $checkListItem->pluck('descricao_item', 'id')->toArray();

        $itensSelected = $checkListEstrutura
            ->getItensByModelo($id)
            ->pluck('itens_id')
            ->toArray();
        
        return view('checklist_estruturas.edit')
            ->with('modeloSelected', $id)
            ->with('itensSelected', $itensSelected)
            ->with('optionsItens', $optionsItens)
            ->with('optionsModelo', $optionsModelos);
    }

    public function update(CheckListEstruturaRequest $request, $id)
    {
        $checkListEstrutura = new CheckListEstrutura;

        $data = $checkListEstrutura->updateCheckListEstrutura($id, $request->all());
        return response()->json($data);
    }

    public function delete($id)
    {
        $checkListEstrutura = new CheckListEstrutura;

        $data = $checkListEstrutura->deleteByModelo($id);
        return response()->json($data);
    }
}
