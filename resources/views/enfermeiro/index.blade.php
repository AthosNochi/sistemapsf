@extends('templates.master')


@section('css-view')
@endsection

@section('js-conteudo-view')
@endsection

@section('conteudo-view')
    @if (session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    {!! Form::open(['route' => 'enfermeiro.store', 'method' => 'post', 'class' => 'text-center border border-light p-5']) !!}
    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">* Nome:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="name" placeholder="Insira seu nome completo" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">* E-mail:</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" maxlength="255" name="email" placeholder="exemplo@email.com" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-4 col-form-label"> Senha:</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" maxlength="255" name="password" placeholder="Escolha uma senha" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="cpf" class="col-sm-4 col-form-label">* CPF:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" maxlength="11" name="cpf" placeholder="000.000.000-00" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-4 col-form-label">* Telefone:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" maxlength="10" name="phone" placeholder="(99)9999-9999" required>
        </div>
    </div>
    <div>
        <input type="hidden" name="tipo" value="enfermeiro">
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <input class="btn btn-primary" type="submit" name="submit" value="Enviar">
    </div>
    {!! Form::close() !!}

    <div class="panel">
        <table class="table" align="center">
        <thead>
            <tr>
                <td>CPF</td>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Email</td>
                <td>Menu</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($enfermeiros as $enfermeiro)
            <tr>
                <td>{{ $enfermeiro->cpf }}</td>
                <td>{{ $enfermeiro->name }}</td>
                <td>{{ $enfermeiro->phone }}</td>
                <td>{{ $enfermeiro->email }}</td>
                <td>
                    {!! Form::open(['route' => ['enfermeiro.destroy', $enfermeiro->id], 'method' => 'DELETE']) !!}
                    <input class="btn btn-primary" type="submit" name="submit" value="Remover">
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@endsection