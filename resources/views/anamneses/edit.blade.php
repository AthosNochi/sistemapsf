@extends('templates.homepage-master')


@section('css-view')
@endsection

@section('js-conteudo-view')
@endsection

@section('conteudo-view')
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Home</a>
      <button class="navbar-toggler" id="botao1" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> 

      <ul class="navbar-nav">
          
          <li>
              <a class="nav-link" id="anamneseEnfermeiro" href="/homepage-Secretaria">Voltar</a>
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

{{ Form::open([ 'route' => ['anamnese.update', $anamnese->id], 'method' => 'PUT', 'class' => '']) }}

    {{-- @method('PUT') --}}
    @csrf

    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">* Paciente:</label>
        <div class="col-sm-8">
          <td>{{ $patient_list[$anamnese->name] }}</td>
        </div>
    </div>
  
      <div class="form-group row">
        <label for="gender" class="col-sm-4 col-form-label">Genero:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="gender" value="{{$anamnese->gender}}">
        </div>
      </div>
  
      <div class="form-group row">
          <label for="age" id="age" class="col-sm-4 col-form-label"> Idade: </label>
          <div class="col-sm-8">
              <input type="text" class="form-control" maxlength="255" name="age" placeholder="Insira sua idade" value="{{$anamnese->age}}">
          </div>
      </div>
  
      <div class="form-group row">
        <label for="corEtnia" class="col-sm-4 col-form-label">Cor/Etnia:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="corEtnia" value="{{$anamnese->corEtnia}}">
        </div>
      </div>
  
      <div class="form-group row">
        <label for="estadoCivil" class="col-sm-4 col-form-label">Estado civil:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="estadoCivil"  value="{{$anamnese->estadoCivil}}">
        </div>
      </div>
  
      <div class="form-group row">
        <label for="profissao" id="profissao" class="col-sm-4 col-form-label"> Profissão: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="profissao"  value="{{$anamnese->profissão}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="naturalidade" id="naturalidade" class="col-sm-4 col-form-label"> Naturalidade: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="naturalidade" value="{{$anamnese->naturalidade}}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="address" id="address" class="col-sm-4 col-form-label"> Endereço: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="address" value="{{$anamnese->address}}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="nomeMae" id="nomeMae" class="col-sm-4 col-form-label"> Nome da mãe: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="nomeMae" value="{{$anamnese->nomeMae}}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="religiao" class="col-sm-4 col-form-label">Religião:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="religiao" value="{{$anamnese->religiao}}">
        </div>
      </div>
      <div class="form-group row">
        <label for="alergias" id="alergias" class="col-sm-4 col-form-label"> Algum tipo de alergia? Qual?</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="alergias" value="{{$anamnese->alergias}}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="queixaPrincipal" id="queixaPrincipal" class="col-sm-4 col-form-label"> Principais sintomas: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="queixaPrincipal" value="{{$anamnese->queixaPrincipal}}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="historicoDoenca" id="historicoDoenca" class="col-sm-4 col-form-label"> Histórico de Doenças: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="historicoDoenca" value="{{$anamnese->historicoDoenca}}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="sintomas" id="sintomas" class="col-sm-4 col-form-label"> Interrogatório Sintomatológico: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="sintomas" value="{{$anamnese->sintomas}}" >
        </div>
      </div>
      <div class="form-group row">
        <label for="resultado" class="col-sm-4 col-form-label">Resultado:</label>
        <div class="col-sm-8">
          <input type="checkbox" name="resultado" id="resultado"  value="Preescrever receituario">
          <label for="resultado"> Preescrever receituário</label><br>

          <input type="checkbox" name="resultado" id="resultado"  value="Marcar retorno">
          <label for="resultado"> Marcar retorno</label><br>
        </div>
      </div>


      @if (Auth::guard('secretaria')->check())
      <input type="hidden" name="secretaria_id" value="{{Auth::guard('secretaria')->user()->id}}">
  
      @else
  
    <input type="hidden" name="secretaria_id" value="{{$anamnese->secretaria_id}}">
  
      @endif

    <div class="modal-footer d-flex justify-content-center">
      <input class="btn btn-primary" type="submit" name="submit" value="Enviar">
    </div> 
    
    <div class="modal-footer d-flex justify-content-center">
      <a class="btn btn-primary" type="button"  onclick="JavaScript: history.go(-1);">Voltar</a>
    </div>


  {{ Form::close() }}


@endsection