<?php
//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ChecklistItemRequest;

//MODELS
use App\Models\CheckListItem;


class CheckListItensController extends Controller
{
    public function index(Request $request)
    {
        $checkListItem = new CheckListItem;

        $view = view('checklist_itens.index')->with(
            'dataCheckListItem', $checkListItem->getCheckListItem($request->all())
        );
        
        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }   

    public function create()
    {
        return view('checklist_itens.create');
    }

    public function store(ChecklistItemRequest $request)
    {
        $checkListItem = new CheckListItem;

        $data = $checkListItem->saveCheckListItem($request->all());
        return response()->json($data);
    }

    public function edit($id)
    {
       $checkListItem = new CheckListItem;
        return view('checklist_itens.edit')->with('dataCheckListItem', $checkListItem->find($id));
    }

    public function update(Request $request, $id)
    {
        $checkListItem = new CheckListItem;

        $data = $checkListItem->updateCheckListItem($id, $request->all());
        return response()->json($data);
    }

    public function delete($id)
    {
        $checkListItem = new CheckListItem;

        $data = $checkListItem->deleteCheckListItem($id);
        return response()->json($data);
    }
}
