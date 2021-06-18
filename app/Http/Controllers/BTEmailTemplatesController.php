<?php

//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;

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

    public function store(){

    } 

    public function edit(){
        
    }

    public function update(){

    }

    public function delete(){

    }
}
