@extends('templates.homepage-master')


@section('css-view')
@endsection

@section('js-conteudo-view')
@endsection

@section('conteudo-view')

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/homepage-Secretaria">Home</a>
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
        <li class="nav-item">
          <a class="nav-link" id="" href="/homepage-Secretaria/novo-agendamento">Novo Agendamento</a>
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
              <th>Legenda</th>
              <th>Descrição</th>
              <th>Data/Hora</th>
              <th>Paciente</th>
              
             
              <th>Opções</th>
          </tr>
      </thead>
      <tbody>
          @foreach($agendamentos as $agendamento)
          <tr>
              <td>{{ $agendamento->legenda}}</td>
              <td>{{ $agendamento->descricao }}</td>
              <td>{{ date("d/m/Y H:i:s", strtotime($agendamento->datahora)) }}</td>
              <td>{{ $patient_list[$agendamento->id_patient] }}</td>
                <td>
                    {!! Form::open(['route' => ['agendamentos.destroy', $agendamento->id], 'method' => 'DELETE']) !!}
                    <input class="btn btn-primary" type="submit" name="submit" value="Remover">
                    {!! Form::close() !!}
                </td>  
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  @endsection