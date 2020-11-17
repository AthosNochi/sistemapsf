@extends('templates.homepage-master')

@section('conteudo-view')
    @if (session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Home</a>
        <button class="navbar-toggler" id="botao1" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> 
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" id="anamneseDoctor" href="<?= url('/homepage-medico'); ?>">Anamneses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="anamneseDoctor" href="<?= url('/homepage-medico'); ?>">Calendário</a>
            </li>
            
        </ul>
        <li class="nav-item">
            <button class="btn btn-primary" href="#altocontraste" id="altocontraste" accesskey="3" onclick="window.toggleContrast()" onkeydown="window.toggleContrast()">Auto contraste</button>
        </li>
    </nav>

    {!! Form::open(['route' => 'anamnese.store', 'method' => 'post', 'class' => 'text-center border border-light p-5']) !!}
    
    <div class="form-group row">
        <label for="queixaPrincipal" id="queixaPrincipal" class="col-sm-4 col-form-label"> Queixa Principal: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="queixaPrincipal" placeholder="Insira sua cor/etnia" >
        </div>
    </div>

    <div class="form-group row">
        <label for="historicoDoenca" id="historicoDoenca" class="col-sm-4 col-form-label"> Histórico de doenças:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="historicoDoenca" placeholder="Insira seu historico de doenças" >
        </div>
    </div>

    <div class="form-group row">
        <label for="sintomas" id="sintomas" class="col-sm-4 col-form-label"> Sintomas:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="sintomas" placeholder="Insira seus sintomas" >
        </div>
    </div>

    <input type="hidden" name="id_doctor" value="{{\Session::get('id')}}">
    
    <div class="modal-footer d-flex justify-content-center">
        <input class="btn btn-primary" id="botaoDoctor2" type="submit" name="submit" value="Enviar">
    </div>
    {!! Form::close() !!}
    @endsection

    <!-- salvar na anamnese quem preencheu os dados,
    e indicar se precisa de retorno da consulta ou receituário -->