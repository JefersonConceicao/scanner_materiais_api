@extends('adminlte::master')
<div class="text-center"> 
    <h2> 
        <h1> Olá {{ $user->name }} </h1>
    </h2>

    <p> Para efetuar a confirmação de sua conta, clique no link abaixo. </p> 
    <a href={{ config('app.url')."/confirmMail/$token" }}> 
        Clique aqui para confirmar a conta
    </a>
</div> 