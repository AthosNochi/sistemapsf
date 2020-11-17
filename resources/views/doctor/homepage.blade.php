@extends('templates.homepage-master')

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
                <a class="nav-link" id="calendarioDoctor" href="<?= url('/homepage-medico/agendamentos'); ?>">Calendário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="anamneseDoctor" href="<?= url('/homepage-medico'); ?>">Anamneses</a>
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
            
        </ul>
        <li class="nav-item">
            <button class="btn btn-primary" href="#altocontraste" id="altocontraste" accesskey="3" onclick="window.toggleContrast()" onkeydown="window.toggleContrast()">Auto contraste</button>
        </li>
    </nav>

    <div class="panel">
        <table class="table" align="center">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Genero</td>
                
                <th>Idade</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anamneses as $anamnese)
            <tr>
                <td>{{ $patient_list[$anamnese->name] }}</td>
                <td>{{ $anamnese->gender }}</td>
                
                <td>{{ $anamnese->age }}</td>
  
                <td>
                  {!! Form::open(['route' => ['anamnese.destroy', $anamnese->id], 'method' => 'DELETE']) !!}
                  <input class="btn btn-primary" type="submit" name="submit" value="Remover">
                  {!! Form::close() !!}
                </td>
                <td>
                <a href="{{ route('anamnese.edit', $anamnese->id) }}"> Editar</a>
                </td>
                <td>
                  <a href="{{ route('anamnese.show', $anamnese->id) }}"> Detalhes</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    <a class="btn btn-primary" href="/homepage-medico/nova-anamnese">Nova Anamnese</a>
    <input type="button" class="btn btn-primary" value="Atualizar" onClick="document.location.reload(true)">
  
    @endsection

    <!-- salvar na anamnese quem preencheu os dados,
    e indicar se precisa de retorno da consulta ou receituário -->