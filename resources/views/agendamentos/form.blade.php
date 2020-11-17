@extends('templates.master')

@section('conteudo-view')

  {!! Form::open(['route' => 'agendamentos.store', 'method' => 'post', 'class' => 'text-center border border-light p-5']) !!}
  <div class="form-group row">
      <label for="descricao" class="col-sm-4 col-form-label"> Descrição:</label>
      <div class="col-sm-8">
          <input type="text" class="form-control" maxlength="255" name="descricao" placeholder="Descrição" required>
      </div>
  </div>
  <div class="form-group row">
    <label for="legenda" class="col-sm-4 col-form-label"> Legenda:</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" maxlength="255" name="legenda" placeholder="Legenda" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="id_patient" class="col-sm-4 col-form-label">* Paciente:</label>
    <div class="col-sm-8">
      @include('templates.formulario.select', ['select' => 'id_patient', 'data' => $patient_list, 'attributes' => ['placeholder' => "Paciente", 'class' => 'form-control', 'required' => 'required']])
    </div>
  </div>
  <div class="form-group row">
    <label for="id_doctor" class="col-sm-4 col-form-label">* Médico:</label>
    <div class="col-sm-8">
      @include('templates.formulario.select', ['select' => 'id_doctor', 'data' => $doctor_list, 'attributes' => ['placeholder' => "Medico", 'class' => 'form-control', 'id' => 'id_doctor', 'onchange' => 'dateSelected()', 'required' => 'required' ]])
    </div>
	</div> 
  <div class="form-group row">
    <label for="datahora" class="col-sm-4 col-form-label">* Data:</label>
    <div class="col-sm-8">
        <input class="form-control" maxlength="255" name="dataf" id="datepicker" onchange="dateSelected()">
        <input type="hidden" class="form-control" maxlength="255" name="data" required id="datefield" >
    </div>
  </div>
  <div class="form-group row">
    <label for="datahora" class="col-sm-4 col-form-label">* Hora:</label>
    <div class="col-sm-8"> 
	@include('templates.formulario.select', ['select' => 'hora', 'data' => [], 'attributes' => ['placeholder' => "Selecione um Médico e uma Data", 'class' => 'form-control', 'id' => 'hora' ]])
    </div>
  </div> 
                            
  <div class="modal-footer d-flex justify-content-center">
    <input class="btn btn-primary" type="submit" name="submit" value="Enviar">
  </div>
  @csrf
  {!! Form::close() !!}


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
  
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script>
	$(function() {
	$( "#datepicker" ).datepicker({
		dateFormat: 'dd/mm/yy',
		altField: "#datefield",
		altFormat: 'yy-mm-dd',
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		nextText: 'Próximo',
		prevText: 'Anterior',
		minDate:new Date(),
		maxDate: '+2m'});
	});
	</script>
	<script>
		function dateSelected() {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				'processing': true, 
				'serverSide': false,
				  type: "POST",
				  data: { 
					  _token:'{{ csrf_token() }}',
					  dia_escolhido: $("#datefield").val(),
					  id_medico: $("#id_doctor").val()
				  },
				  url: "{{ route('availability.ajaxcall') }}",
				  success: function(s) {
					// alert(JSON.stringify(s));
					$('#hora').empty();
					
					$.each(s, function(index, element){
						if (element == true) {
							$('#hora').append($('<option></option>').text(index).val(index));
						}
					});
					
				  },
				  error: function(e) {
					  
					$('#hora').empty();
					$('#hora').append($('<option></option>').text("Selecione um Médico e uma Data").val(""));
				  }
			})
		}
		
		dateSelected();
	</script>
@endsection


