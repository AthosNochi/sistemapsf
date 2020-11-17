<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='{{asset('assets/fullcalendar/lib/main.css')}}' rel='stylesheet' />
<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href= "{{ asset('site/style.css') }}">

<script src='{{asset('assets/fullcalendar/lib/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/lib/locales-all.js')}}'></script>~

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Home</a>
  <button class="navbar-toggler" id="botao1" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> 
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link"  href="">Meus Agendamentos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="">Agendar</a>
    </li>
  </ul>
  <li class="nav-item">
    <button class="btn btn-primary" id="botaoDoctor" type="button" id="botao2" onclick="mudaCorDeFundo()">Auto contraste</button> 
</nav>

</head>
<body>

  

</body>
</html>