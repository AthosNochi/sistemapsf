@extends('templates.homepage-master')


@section('css-view')
@endsection

@section('js-conteudo-view')
@endsection

@section('conteudo-view')
    @if (session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    <head>
        
    </head>

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

    
<div class="panel">
    <table class="table" align="center">
    <thead>
        <tr>
            <th>CPF</th>
            <th>RG</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Menu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
        <tr>
            <td>{{ $patient->cpf }}</td>
            <td>{{ $patient->rg }}</td>
            <td>{{ $patient->name }}</td>
            <td>{{ $patient->email }}</td>
            <td>
                {!! Form::open(['route' => ['patient.destroy', $patient->id], 'method' => 'DELETE']) !!}
                <input class="btn btn-primary" type="submit" name="submit" value="Remover">
                {!! Form::close() !!}

                <td>
                    <a href="{{ route('patient.edit', $patient->id) }}"> Editar</a>
                </td>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    
    <a class="btn btn-primary" href="/homepage-Secretaria/novo-paciente">CadastrarNovo</a> 
    
    <input type="button" class="btn btn-primary" value="Atualizar" onClick="document.location.reload(true)">


</div>