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

    

    <div class="panel">
        <table id="customers" class="table" align="center">
        <thead>
            <tr>
                <th>Id do Paciente</th>
                <th>Genero</td>
                
                <th>Idade</th>
                <th>Cor/Etnia</th>
                <th>Estado civil</th>
                <th>Profissao</th>
                <th>Naturalidade</th>
                <th>Endereço</th>
                <th>Nome da mãe</th>
                <th>Religiao</th>
                <th>Alergias</th>
                <th>Queixa Principal</th>
                <th>Historico de doenças</th>
                <th>Sintomas</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anamneses as $anamnese)
            <tr>
                <td>{{ $patient_list[$anamnese->name] }}</td>
                <td>{{ $anamnese->gender }}</td>
                
                <td>{{ $anamnese->age }}</td>
                <td>{{ $anamnese->corEtnia }}</td>
                <td>{{ $anamnese->estadoCivil }}</td>
                <td>{{ $anamnese->profissao }}</td>
                <td>{{ $anamnese->naturalidade }}</td>
                <td>{{ $anamnese->address }}</td>
                <td>{{ $anamnese->nomeMae }}</td>
                <td>{{ $anamnese->religiao }}</td>
                <td>{{ $anamnese->alergias }}</td>
                <td>{{ $anamnese->queixaPrincipal }}</td>
                <td>{{ $anamnese->historicoDoenca }}</td>
                <td>{{ $anamnese->sintomas }}</td>
  
                <td>
                  {!! Form::open(['route' => ['anamnese.destroy', $anamnese->id], 'method' => 'DELETE']) !!}
                  <input class="btn btn-primary" type="submit" name="submit" value="Remover">
                  {!! Form::close() !!}
                </td>
                <td>
                <a href="{{ route('anamnese.edit', $anamnese->id) }}"> Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        <input type="button" class="btn btn-primary" value="Atualizar" onClick="document.location.reload(true)">
        <div class="modal-footer d-flex justify-content-center">
          <a class="btn btn-primary" type="button"  onclick="JavaScript: history.go(-1);">Voltar</a>
        </div>
    </div>
  @endsection