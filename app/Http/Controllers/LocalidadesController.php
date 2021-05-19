<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalidadesController extends Controller
{
    public function index()
    {
        $view = view('localidades.index');
        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
