@extends('templates.homepage-master')

@section('conteudo-view')

    @if (session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="homepage-paciente">Home</a>
      <button class="navbar-toggler" id="botao1" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> 

      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" id="anamneseEnfermeiro" href="/homepage-paciente/meus-dados">Meus dados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="anamneseEnfermeiro" href="">Meus Agendamentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="anamneseEnfermeiro" href="">Novo Agendamento</a>
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
        <input type="hidden" class="form-control" maxlength="255" name="id_patient" required id="id_patient" >
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
  <div>
    <input type="hidden" name="id_patient" value="{{Auth::guard('patient')->user()->id}}">
  </div>                     
  <div class="modal-footer d-flex justify-content-center">
    <input class="btn btn-primary" type="submit" name="submit" value="Enviar">
  </div>
  @csrf
  {!! Form::close() !!}

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
	