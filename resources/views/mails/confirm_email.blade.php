@extends('adminlte::master')
<div class="text-center"> 
    <h2> 
        <h1> Olá {{ $user->name }} </h1>
    </h2>

    <p> Estamos enviando este e-mail para confirmação de sua conta, clique no botão abaixo para efetuar a confirmação. </p> 
    <a href={{ config('app.url')."/confirmMail/$token" }}> 
        Clique aqui para confirmar a conta
    </a>
</div> 