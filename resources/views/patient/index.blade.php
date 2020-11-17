@extends('templates.master')

@section('conteudo-view')
    @if (session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif
    {!! Form::open(['route' => 'patient.store', 'method' => 'post', 'class' => 'text-center border border-light p-5']) !!}
    <div class="form-group row">
        <label for="name" id="name" class="col-sm-4 col-form-label">* Nome:</label>
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
        <label for="rg" class="col-sm-4 col-form-label">* RG:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" maxlength="9" name="rg" placeholder="00.000.000-0" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="birth" class="col-sm-4 col-form-label"> Nascimento:</label>
        <div class="col-sm-8">
            <input type="date" class="form-control" maxlength="8" name="birth" placeholder="data de nascimento" required>
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
        <label for="phone" class="col-sm-4 col-form-label">* Telefone:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" maxlength="10" name="phone" placeholder="(99)9999-9999" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-4 col-form-label"> Endereço:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="address" placeholder="Endereço" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="sus" class="col-sm-4 col-form-label"> N° SUS:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="sus" placeholder="N° Cartão do SUS" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="notes" class="col-sm-4 col-form-label"> Observações:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" maxlength="255" name="notes" placeholder="Diabetes, pressão alta, etc..." required>
        </div>
    </div>
    <div>
        <input type="hidden" name="tipo" value="paciente">
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
                <td>RG</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Telefone</td>
                <td>Nascimento</td>
                <td>Genero</td>
                <td>Notas</td>
                <td>Cartão do SUS</td>
                <td>Endereço</td>
                
                <td>Menu</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
            <tr>
                <td>{{ $patient->cpf }}</td>
                <td>{{ $patient->rg }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->email }}</td>
                <td>{{ $patient->phone }}</td>
                <td>{{ $patient->birth }}</td>
                <td>{{ $patient->gender }}</td>
                <td>{{ $patient->notes }}</td>
                <td>{{ $patient->sus }}</td>
                <td>{{ $patient->address }}</td>
                <td>
                    {!! Form::open(['route' => ['patient.destroy', $patient->id], 'method' => 'DELETE']) !!}
                    <input class="btn btn-primary" type="submit" name="submit" value="Remover">
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@endsection