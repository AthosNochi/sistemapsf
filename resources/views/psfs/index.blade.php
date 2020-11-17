@extends('templates.master')

@section('css-view')
@endsection

@section('js-conteudo-view')
@endsection

@section('conteudo-view')
    @if (session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

{!! Form::open(['route' => 'psf.store', 'method' => 'post', 'class' => 'text-center border border-light p-5']) !!}
    <div class="form-group row">
        <label for="name" id="name" class="col-sm-4 col-form-label"> Nome:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="name" placeholder="Seu nome" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="endereco" id="endereco" class="col-sm-4 col-form-label"> Endereço:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="endereco" placeholder="Endereço" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-4 col-form-label"> Telefone:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" maxlength="10" name="phone" placeholder="(99)9999-9999" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="regiao" class="col-sm-4 col-form-label"> Região:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="regiao" placeholder="Exemplo: Norte, Sul, Leste, Oeste" required>
        </div>
    </div>
    
    <div class="modal-footer d-flex justify-content-center">
        <input class="btn btn-primary" type="submit" name="submit" value="Enviar">
    </div>

    {!! Form::close() !!}

    <div class="panel">
        <table class="table" align="center">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Região</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($psfs as $psf)
            <tr>
                <td>{{ $psf->name }}</td>
                <td>{{ $psf->endereco }}</td>
                <td>{{ $psf->phone }}</td>
                <td>{{ $psf->regiao }}</td>
                <td>
                    {!! Form::open(['route' => ['psf.destroy', $psf->id], 'method' => 'DELETE']) !!}
                    <input class="btn btn-primary" type="submit" name="submit" value="Remover">
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection