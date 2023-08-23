<?php
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- jQuery -->
    <script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <!-- Bootbox -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Bootstrap js -->
    <script lenguage="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <!-- Mio css -->
    <link rel="stylesheet" href="../css/background.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crete+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="shortcut icon" href="https://lucalaspina.netsons.org/image/icon.png"/>

    <title>JobFinder</title>

    <script>
      function Search(){

        Titolo = document.forms["SearchForm"]["Titolo"].value;
        Provincia = document.forms["SearchForm"]["Provincia"].value;

        $.ajax({
          type: "POST",
          url: "search.php",
          data: {
                  "Titolo" : Titolo,
                  "Provincia" : Provincia
              },
          dataType: "json",

          success: function(response){
            // creare una risposta in ajax che funzioni con la ricerca
            //console.log(response[5]["Salario"]);
            console.log(response);
            CreateCard(response);
          },
          error: function(xhr, ajaxOptions, thrownError, response) {
            console.log(response);
            alert(response);
            alert(xhr.status);
            alert(thrownError);
          }
        });
      }

      function CreateCard(Card){
        $(".card").remove();
        $(".br").remove();
        for (var i = 0; i < Card.length; i++) {
					DrawCard(Card[i]);
				}
      }
      function DrawCard(Card){
        var row = $("<div />");

        row.append($("<div class='card text-center'> <div class='card-header'> Nome azienda: " + Card.NomeAzienda + "</div> <div class='card-body'> <h5 class='card-title'>" + Card.Titolo + "</h5> <p class='card-text text-break'>" + Card.DescrizioneInserzione + "</p> <button class='btn btn-warning' onclick='Favourite(" + Card.IDInserzione + ");'> Aggiungi o togli dai preferiti </button> </div> <div class='card-footer text-muted'> Contattaci: " + Card.EmailAzienda + "</div> </div> <br class='br'>"));
       
        $("#insertion").append(row);
      }

      function Favourite(IDInserzione){
        <?php
          if(isset($_SESSION["ID"])){
            ?>
            //Codice JavaScript
            var IDUtente = <?php echo json_encode($_SESSION["ID"]); ?>;
            var Table = <?php echo json_encode($_SESSION["Table"]); ?>;

            //Controllo dell'account loggato
            if(Table == "Utenti"){
              //Chiamata ajax per controllare se l'inserzione è tra i preferiti o meno
              var CheckResult = Check(IDInserzione, IDUtente);
              console.log("CheckResult: " + CheckResult);

              if(jQuery.isEmptyObject(CheckResult) == true){
                //Inserimento dell'inserzione tra i preferiti

                //Chiamata ajax per l'inserimento dell'inserzione tra i preferiti
                //Ritorna true o false
                var CheckInsert = Insert(IDInserzione, IDUtente);
                console.log("CheckInsert: " + CheckInsert);

                if(CheckInsert == true){
                  bootbox.alert("Inserzione aggiunta ai preferiti correttamente.");
                }else{
                  bootbox.alert("Errore, Errore nell'inserimento dell'inserzione tra i preferiti.");
                }

              }else{
                //Cancellazione dell'inserzione tra i preferiti

                //Chiamata ajax per la cancellazione dell'inserzione tra i preferiti
                //Ritorna true o false
                var CheckDelete = Delete(IDInserzione, IDUtente);
                console.log("CheckDelete: " + CheckDelete);

                if(CheckDelete == true){
                  bootbox.alert("Inserzione rimossa dai preferiti correttamente.");
                }else{
                  bootbox.alert("Errore, Errore nalla cancellazione dell'inserzione tra i preferiti.");
                }
              }
            }else{
              bootbox.alert("Errore, non puoi aggiungere delle inserzioni ai preferiti con un account aziendale.");
            }

            <?php
          }else{
            ?>
            //Codice JavaScript
            bootbox.alert("Errore, per poter aggiungere l'inserzione ai preferiti devi loggarti con un account utente.");
            <?php
          }
        ?>
      }

      function Check(IDInserzione, IDUtente){
        $.ajax({
          type: "POST",
          url: "check.php",
          data: {
                  "IDInserzione" : IDInserzione,
                  "IDUtente" : IDUtente
              },
          dataType: "json",
          async: false,

          success: function(response){
            // creare una risposta in ajax che funzioni con il controllo dell'inserzione
            ReturnResponse = response;
          },
          error: function(xhr, ajaxOptions, thrownError, response) {
            console.log(response);
            alert(response);
            alert(xhr.status);
            alert(thrownError);
          }
        });

        return ReturnResponse;
      }

      function Insert(IDInserzione, IDUtente){
        $.ajax({
          type: "POST",
          url: "insert.php",
          data: {
                  "IDInserzione" : IDInserzione,
                  "IDUtente" : IDUtente
              },
          dataType: "json",
          async: false,

          success: function(response){
            // creare una risposta in ajax che funzioni con il controllo dell'inserzione
            ReturnResponse = response;
          },
          error: function(xhr, ajaxOptions, thrownError, response) {
            console.log(response);
            alert(response);
            alert(xhr.status);
            alert(thrownError);
          }
        });

        return ReturnResponse;
      }

      function Delete(IDInserzione, IDUtente){
        $.ajax({
          type: "POST",
          url: "delete.php",
          data: {
                  "IDInserzione" : IDInserzione,
                  "IDUtente" : IDUtente
              },
          dataType: "json",
          async: false,

          success: function(response){
            // creare una risposta in ajax che funzioni con il controllo dell'inserzione
            ReturnResponse = response;
          },
          error: function(xhr, ajaxOptions, thrownError, response) {
            console.log(response);
            alert(response);
            alert(xhr.status);
            alert(thrownError);
          }
        });

        return ReturnResponse;
      }
    </script>
  </head>
  <body>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-family: 'Roboto Slab', serif;">
      <div class="container">
      <?php
        if(isset($_SESSION["ID"])){
          echo '<a class="navbar-brand" href="https://lucalaspina.netsons.org/JobFinder/index.php" style="color: #9AFF0D">JobFinder</a>';
        }else{
          echo '<a class="navbar-brand" href="https://lucalaspina.netsons.org/JobFinder/index.html" style="color: #9AFF0D">JobFinder</a>';
        }
      ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <?php
                if(isset($_SESSION["ID"])){
                  echo '<a class="nav-link" href="https://lucalaspina.netsons.org/JobFinder/index.php">Home</a>';
                }else{
                  echo '<a class="nav-link" href="https://lucalaspina.netsons.org/JobFinder/index.html">Home</a>';
                }
              ?>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../search/index.php">Cerca lavoro</a>
            </li>
            <li class="nav-item">
              <?php
                if(isset($_SESSION["ID"])){
                  echo '<a class="nav-link" href="https://lucalaspina.netsons.org/JobFinder/priv/profile.php">Il mio profilo</a>';
                }else{
                  echo '<a class="nav-link" data-bs-toggle="modal" data-bs-target="#ModalError" href="#">Il mio profilo</a>';
                }
              ?>
            </li>
          </ul>
          <?php
            if(isset($_SESSION["ID"])){
              echo '<ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../aut/logout.php">Logout</a>
                      </li>
                    </ul>';
            }
          ?>
        </div>
      </div>
    </nav>

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
    </div>

    <!-- Form di ricerca -->
    <div class="container d-flex justify-content-center">
      <form class="row" method="POST" name="SearchForm">
        <div class="col-6">
          <input type="text" class="form-control" placeholder="Inserisci il lavoro" name="Titolo">
        </div>
        <div class="col-6">
          <input type="text" class="form-control" placeholder="Inserisci la provincia" name="Provincia">
        </div>
        <div class="col-2 d-grid p-2 mx-auto">
          <button type="button" class="btn btn-outline-dark" onclick="Search();">Cerca</button>
        </div>
      </form>
    </div>

    <div class="container">
      <hr>
    </div>

    <div class="container">
      <div class="row">
        <div class="col" id="insertion">
            <!-- Card dinamiche -->
          </div>
      </div>
    </div>

    <!-- ModalError -->
    <div class="modal fade" id="ModalError" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Attenzione!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Per poter utilizzare questa funzione devi prima effettuare l'accesso al sito!
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Okay!</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
