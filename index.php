<?php
  session_start();

  if(isset($_SESSION["ID"])){

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- jQuery -->
    <script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Mio css -->
    <link rel="stylesheet" href="css/background.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crete+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="shortcut icon" href="https://jobfinder.netsons.org/image/icon.png"/>

    <title>JobFinder</title>

  </head>
  <body>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-family: 'Roboto Slab', serif;">
      <div class="container">
        <a class="navbar-brand" href="https://jobfinder.netsons.org/index.php" style="color: #9AFF0D">JobFinder</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./search/index.php">Cerca lavoro</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://jobfinder.netsons.org/priv/profile.php">Il mio profilo</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="aut/logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <br><br>
    <br><br>

    <!-- Body del sito -->
    <div class="container">
        <div class="display-1 text-center" style="font-family: 'Pacifico', coursive;">
          JobFinder
        </div>
        <br>
        <div class="h4 text-center" style="font-family: 'Crete Round', serif;">
          Cerca il tuo prossimo lavoro con noi, non te ne pentirai!
        </div>
        <hr>
        <br>

      <!-- Carosello -->
      <div id="carouselExampleIndicators" class="carousel slide shadow-lg d-sm-block" data-bs-ride="carousel">
        <ol class="carousel-indicators">
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner shadow-lg">
          <div class="carousel-item active">
            <img src="../image/1.png" class="d-block w-100 rounded shadow-lg" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../image/2.gif" class="d-block w-100 rounded shadow-lg" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../image/3.png" class="d-block w-100 rounded shadow-lg" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>
    </div>
  </body>
</html>

<?php
  }else{
    echo "Non hai effettuato il login, di conseguenza ti è stato negato l'accesso. Se non hai un account createne uno.";
  }
?>
