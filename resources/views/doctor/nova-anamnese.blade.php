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
      <a class="navbar-brand" href="/homepage-medico">Home</a>
      <button class="navbar-toggler" id="botao1" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> 

      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" id="" href="/homepage-medico/agendamentos" >Calendário</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="" href="/homepage-medico">Anameneses</a>
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

    {!! Form::open(['route' => 'anamnese.store', 'method' => 'post', 'class' => 'text-center border border-light p-5']) !!}
    
    <div class="form-group row">
      <label for="name" class="col-sm-4 col-form-label">* Paciente:</label>
      <div class="col-sm-8">
        @include('templates.formulario.select', ['select' => 'id_patient', 'data' => $patient_list, 'attributes' => ['placeholder' => "Paciente", 'class' => 'form-control', 'required' => 'required']])
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-4 col-form-label">Genero:</label>
      <div class="col-sm-8">
      <select name="gender" id="gender" class="form-control">
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
        <option value="Outros">Outros</option>
      </select>
      </div>
    </div>

    <div class="form-group row">
        <label for="age" id="age" class="col-sm-4 col-form-label"> Idade: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="age" placeholder="Insira sua idade" >
        </div>
    </div>

    <div class="form-group row">
      <label for="corEtnia" class="col-sm-4 col-form-label">Cor/Etnia:</label>
      <div class="col-sm-8">
      <select name="corEtnia" id="corEtnia" class = "form-control">
        <option value="Negro">Negro(a)</option>
        <option value="Branco">Branco(a)</option>
        <option value="Pardo">Pardo(a)</option>
        <option value="Outros">Outros</option>
      </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="estadoCivil" class="col-sm-4 col-form-label">Estado civil:</label>
      <div class="col-sm-8">
      <select name="estadoCivil" id="estadoCivil" class = "form-control">
        <option value="Solteiro(a)">Solteiro(a)</option>
        <option value="Casado(a)">Casado(a)</option>
        <option value="Outros">Outros</option>
      </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="profissao" id="profissao" class="col-sm-4 col-form-label"> Profissão: </label>
      <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="profissao" placeholder="Insira sua profissão" >
      </div>
    </div>
    <div class="form-group row">
      <label for="naturalidade" id="naturalidade" class="col-sm-4 col-form-label"> Naturalidade: </label>
      <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="naturalidade" placeholder="Insira sua naturalidade" >
      </div>
    </div>
    <div class="form-group row">
      <label for="address" id="address" class="col-sm-4 col-form-label"> Endereço: </label>
      <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="address" placeholder="Insira seu endereço completo" >
      </div>
    </div>
    <div class="form-group row">
      <label for="nomeMae" id="nomeMae" class="col-sm-4 col-form-label"> Nome da mãe: </label>
      <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="nomeMae" placeholder="Insira o nome da sua mãe" >
      </div>
    </div>
    <div class="form-group row">
      <label for="religiao" class="col-sm-4 col-form-label">Religião:</label>
      <div class="col-sm-8">
      <select name="religiao" id="religiao" class = "form-control">
        <option value="catolica">Católica</option>
        <option value="testemunhas">Testemunhas de jeová</option>
        <option value="Outros">Outros</option>
      </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="alergias" id="alergias" class="col-sm-4 col-form-label"> Algum tipo de alergia? Qual?</label>
      <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="alergias" placeholder="Caso tenha, insira suas alergias" >
      </div>
    </div>
    <div class="form-group row">
      <label for="queixaPrincipal" id="queixaPrincipal" class="col-sm-4 col-form-label"> Principais sintomas: </label>
      <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="queixaPrincipal" placeholder="Insira os principais sintomas" >
      </div>
    </div>
    <div class="form-group row">
      <label for="historicoDoenca" id="historicoDoenca" class="col-sm-4 col-form-label"> Histórico de Doenças: </label>
      <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="historicoDoenca" placeholder="Insira seu histórico de doenças" >
      </div>
    </div>
    <div class="form-group row">
      <label for="sintomas" id="sintomas" class="col-sm-4 col-form-label"> Interrogatório Sintomatológico: </label>
      <div class="col-sm-8">
          <input type="text" class="form-control" rows="10" cols="30" style="width:600px; height:300px;" maxlength="255" name="sintomas" placeholder="Insira o interrogatório" >
      </div>
    </div>
    
    @if (Auth::guard('doctor')->check())
    <input type="hidden" name="id_doctor" value="{{Auth::guard('doctor')->user()->id}}">

    @else

    <input type="hidden" name="id_doctor" value="">

    @endif

    <div class="modal-footer d-flex justify-content-center">
        <input class="btn btn-primary " id="mudabotao1" type="submit" name="submit" value="Enviar">
    </div>
    {!! Form::close() !!}

    <div class="modal-footer d-flex justify-content-center">
      <a class="btn btn-primary" type="button"  href="/homepage-medico">Voltar</a>
    </div>
  @endsection