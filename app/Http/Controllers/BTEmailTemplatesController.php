<?php

//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\BTEmailTemplatesRequest;

//MODELS
use App\Models\BTEmailTemplate;

class BTEmailTemplatesController extends Controller
{
    public function index(Request $request){
        $mailTemplate = new BTEmailTemplate;


        $view = view('bt_email_templates.index')
                ->with('dataBTEmailTemplate', $mailTemplate->getBTEmailTemplate($request->all()));

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create(){
        return view('bt_email_templates.create');
    }   

    public function store(BTEmailTemplatesRequest $request){
        $mailTemplate = new BTEmailTemplate;

        $data = $mailTemplate->saveBTEmailTemplate($request->all());
        return response()->json($data);
    } 

    public function edit($id){
        $mailTemplate = new BTEmailTemplate;

        return view('bt_email_templates.edit')->with('emailTemplate', $mailTemplate->find($id));
    }

    public function update($id, BTEmailTemplatesRequest $request){
        $mailTemplate = new BTEmailTemplate; 

        $data = $mailTemplate->updateBTEmailTemplate($id, $request->all());
        return response()->json($data);
    }   

    public function delete($id){
        $mailTemplate = new BTEmailTemplate;

        $data = $mailTemplate->deleteBTEmailTemplate($id);
        return response()->json($data);
    }
}
