<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BTConfiguracoesController extends Controller
{
    public function index(){
        $view = view('bt_configuracoes.index');

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }   
}
