<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Anuncios Clasificados</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../files_login/login-register.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../css/icomoon.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="about.html">Inicio</a>
            </li>                              
          </ul>
        </div>
      </div>
    </nav>
    <!-- contenido... -->    
    <br>
    <div class="container jumbotron">       
     <div class="">
       <form method="post" action="/login" accept-charset="UTF-8">
       <div class="row justify-content-center">
          <div class="col-sm-6">
            
            <div class="form-group">
              <label for="usu"><i class="icon-user2"></i> Usuario:</label>
              <input id="usu" class="form-control" type="text" placeholder="Ingrese su usuario..." name="Usuario">
            </div>
            <div class="form-group">
              <label for="usu"><i class="icon-key"></i> Contraseña:</label>
              <input id="password" class="form-control" type="password" placeholder="Ingrese su password..." name="password">
            </div>
            <div class="checkbox">              
              <input type="checkbox" name="remember"> Recordar Password.
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="submit" value="Ingresar" onclick="loginAjax()">                  
            </div>
          </div>
        </div>       
      </form>       
     </div>                                       
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../files_login/login-register.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
