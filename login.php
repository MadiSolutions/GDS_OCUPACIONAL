<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Grupo del Sur</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <style>

    body {
      background-image: url('images/fondo5.png');
      background-size: cover;
      background-repeat: no-repeat;
    }

    .card-header img {
      max-width: 120px;
      margin-bottom: 10px;
      border-radius: 50%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-15px);
      }
    }
  </style>


</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="images/logo1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"><br>
      <a class="h1" style="color:#00b3ba"><b>GDS App Ocupacional</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg" style="color:#00b3ba">Inicio de Sesion</p>

        <div class="input-group mb-3">
          <input type="number" name=usuario id="usuario" class="form-control" placeholder="Usuario">
        </div>
        <div class="input-group mb-3">
          <input type="password" name=contrasena id="contrasena" class="form-control" placeholder="Contraseña">
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" style="background-color:#00b3ba;" onmouseover="this.style.backgroundColor='#007bff';" onmouseout="this.style.backgroundColor='#00b3ba';" class="btn btn-primary btn-block" onclick="loguear()">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>

    document.getElementById('usuario').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
      event.preventDefault(); // Previene el comportamiento predeterminado del Enter
      loguear();
    }
  });

  document.getElementById('contrasena').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
      event.preventDefault(); // Previene el comportamiento predeterminado del Enter
      loguear();
    }
  });



  function loguear(){
    usuario=document.getElementById('usuario').value;
    contrasena=document.getElementById('contrasena').value;
    $.ajax({
          method: "POST",
          url: 'loguear.php',
          data: {
              "usuario": usuario,
              "contrasena": contrasena
            }
      })
      .done(function( retorno ) {
          if(retorno=='ok'){
            location.href="panel.php?modulo=inicio";
          }else{
            alert('Datos Incorrectos');
            location.href="login.php";
          }
      });  

  }
</script>

</body>
</html>
