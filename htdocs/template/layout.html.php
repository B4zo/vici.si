<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="template/css/slog.css">
    <script src="template/js/moment.min.js"></script>
    <script type="text/javascript" src="template/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="template/css/bootstrap-datetimepicker.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>
    <title>Moja spletna stran</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img src='../img/vici.si.png'></img></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                  <li class="nav-item"><a class="nav-link" href="index.php?stran=vici">Vici</a></li>
                  <li class="nav-item"><a class="nav-link" href="index.php?stran=registracija">Registracija</a></li>
                  <li class="nav-item"><a class="nav-link" href="index.php?stran=prijava">Prijava</a></li>
              </ul>
          </div>
      </div>
    </nav>
    <div class="container">
<?php
  echo $content;
 ?>
 </div>
  </body>
</html>
