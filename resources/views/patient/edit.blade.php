@extends('templates.homepage-master')


@section('css-view')
@endsection

@section('js-conteudo-view')
@endsection

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
              <a class="nav-link" id="" href="/homepage-Secretaria/agendamentos" >Calendário</a>
          </li>
          <li>
              <a class="nav-link" id="" href="/homepage-Secretaria/pacientes">Pacientes</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" id="" href="/homepage-Secretaria">Anameneses</a>
          </li>
          </li>
          <li class="nav-item" id="mudanav">
            <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
  
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>

          <li>
          
          </li>

          <li class="nav-item">
            <button class="btn btn-primary" href="#altocontraste" id="altocontraste" accesskey="3" onclick="window.toggleContrast()" onkeydown="window.toggleContrast()">Auto contraste</button>
          </li>
          <li class="nav-item">
            <button class="btn btn-primary" name="increase-font" id="increase-font" title="Aumentar fonte">A +</button>
          </li>
          <li class="nav-item">
            <button class="btn btn-primary" name="decrease-font" id="decrease-font" title="Diminuir fonte">A -</button>
          </li>
      </ul>
    </nav>
@if (session('success'))
    <h3>{{ session('success')['messages'] }}</h3>
@endif
@if($errors->any())
  {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
@if (\Session::has('message'))
<div class="alert alert-message">
    {!! \Session::get('message') !!}
</div>
@endif

{{ Form::open([ 'route' => ['patient.update', $patient->id], 'method' => 'PUT', 'class' => '']) }}

    {{-- @method('PUT') --}}
    @csrf

    <div class="form-group row">
        <label for="cpf" class="col-sm-4 col-form-label">* CPF:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="gender" value="{{$patient->cpf}}">
        </div>
    </div>
  
      <div class="form-group row">
        <label for="rg" class="col-sm-4 col-form-label">RG:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="rg" value="{{$patient->rg}}">
        </div>
      </div>
  
      <div class="form-group row">
          <label for="name" id="age" class="col-sm-4 col-form-label"> Nome: </label>
          <div class="col-sm-8">
              <input type="text" class="form-control" maxlength="255" name="name"  value="{{$patient->name}}">
          </div>
      </div>
  
      <div class="form-group row">
        <label for="phone" class="col-sm-4 col-form-label">Telefone:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="phone" value="{{$patient->phone}}">       
      
        </div>
      </div>
  
      <div class="form-group row">
        <label for="birth" class="col-sm-4 col-form-label">Nascimento:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="birth" value="{{$patient->birth}}">    
        </div>  
      </div>  
  
      <div class="form-group row">
        <label for="gender" id="gender" class="col-sm-4 col-form-label"> Genero: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="gender" value="{{$patient->gender}}">        
        </div>
      </div>

      <div class="form-group row">
        <label for="notes" id="notes" class="col-sm-4 col-form-label"> Notas: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="notes" value="{{$patient->notes}}">
        </div>
      </div>

      <div class="form-group row">
        <label for="sus" id="sus" class="col-sm-4 col-form-label"> SUS: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="notes" value="{{$patient->sus}}">
        </div>
      </div>


      <div class="form-group row">
        <label for="address" id="address" class="col-sm-4 col-form-label"> Endereço: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="notes" value="{{$patient->address}}">        
        </div>
      </div>
   
    <div class="modal-footer d-flex justify-content-center">
      <input class="btn btn-primary" type="submit" name="submit" value="Enviar">
    </div>    

    <div class="modal-footer d-flex justify-content-center">
        <a class="btn btn-primary" type="button"  onclick="JavaScript: history.go(-1);">Voltar</a>
    </div>


  {{ Form::close() }}


@endsection