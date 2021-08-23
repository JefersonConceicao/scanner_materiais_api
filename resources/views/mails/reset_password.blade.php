@extends('adminlte::master')
<div class="text-center"> 
    <h2> 
        <h1> Olá {{ $user->name }} </h1>
    </h2>

    <p> Estamos enviando este e-mail para recuperação da sua senha, caso você não tenha solicitado ignore este e-mail. </p> 
    <a href={{ config('app.url')."/users/recoveryNewPass/$token" }}> 
        Clique aqui para confirmar a conta
    </a>
</div> 