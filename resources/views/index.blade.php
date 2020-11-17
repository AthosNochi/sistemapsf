<!DOCTYPE html>
<html lang="pt-br">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de agendamento de consultas">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sistema de Agendamento em PSF</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom fonts for this template -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    
  <link rel="stylesheet" href= "{{ asset('site/style.css') }}">
  <link rel="stylesheet" href= "{{ asset('site/auto-contraste-backgrounds.css') }}">
  <link rel="stylesheet" href= "{{ asset('site/auto-contraste-texts.css') }}">
  <link rel="stylesheet" href= "{{ asset('site/auto-contraste-actions.css') }}">
  <link rel="stylesheet" href= "{{ asset('site/auto-contraste-images.css') }}">
  <link rel="stylesheet" href= "{{ asset('site/auto-contraste-forms.css') }}">
  </head>

  <body>

  <script src="{{ asset('site/jquery.js') }}"></script>
  <script src="{{ asset('site/bootstrap.js') }}"></script>
  <script src="{{ asset('site/contrast.class.js') }}"></script>
  <script src="{{ asset('site/fonte.js') }}"></script>

  <div id="id01" class="modal">
    {!! Form::open(['route' => 'login', 'method' => 'post', 'class' => 'modal-content animate']) !!}
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <img src="icone.jpg" alt="Avatar" class="avatar">
      </div>
  
      <div class="container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
  
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
          
        <button type="submit">Login</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>
  
      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <span class="password">Forgot <a href="#">password?</a></span>
      </div>
      {!! Form::close() !!}
    
  </div>
  
  <script>
  // Get the modal
  var modal = document.getElementById('id01');
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
  </script>
 <!-- nesse ponto você acha o diretório site onde esta o jquery e o bootstrap
 
  <!-- Navigation -->
  <div class="topnav">
    <nav class="navbar navbar-dark bg-dark static-top">
      <div class="container">
      <a class="navbar-brand" href="#">PSF</a>
        <button class="btn btn-primary" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
      <ul id="mudanav" class="navbar-nav">
        <li class="nav-item">
          <button class="btn btn-primary" href="#altocontraste" id="altocontraste" accesskey="3" onclick="window.toggleContrast()" onkeydown="window.toggleContrast()" style="width:auto;">Auto contraste</button>
        </li>
        <li class="nav-item">
          <button class="btn btn-primary" name="increase-font" id="increase-font" title="Aumentar fonte" style="width:auto;">A +</button>
        </li>
        <li class="nav-item">
          <button class="btn btn-primary" name="decrease-font" id="decrease-font" title="Diminuir fonte" style="width:auto;">A -</button>
        </li>
      </ul>
    </nav>
  </div>
    
    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center">
      <div class="container">
        <div class="row">
          <div id="mudacor1" class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-screen-desktop m-auto text-primary"></i>
              </div>
              <h3 id="muda1"> Multiplataforma</h3>
              <p id="muda2" class="lead mb-0">Layout responsivo, adapta a qualquer tamanho de tela!</p>
            </div>
          </div>
          <div id="mudacor2" class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-layers m-auto text-primary"></i>
              </div>
              <h3 id="muda3">Acessível</h3>
              <p id="muda4" class="lead mb-0">Sistema acessível para todos </p>
            </div>
          </div>
          <div id="mudacor3" class="col-lg-4">
            <div class="features-icons-item mx-auto mb-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-check m-auto text-primary"></i>
              </div>
              <h3 id="muda5">Intuitivo</h3>
              <p id="muda6" class="lead mb-0">Sistema intuitivo de fácil utilização, não requer nenhum treinamento</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>

</html>