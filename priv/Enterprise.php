<?php
    include("../.gitignore/config.php");

    session_start();

    //Controllo se la sessione è attiva
    if(isset($_SESSION["ID"])){
        try {
            $db = new PDO($cnn , "$db_user", "$db_psw");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $Query = "SELECT * FROM Aziende WHERE IDAzienda=".$_SESSION["ID"]."";
            $QueryResult = $db->query($Query);
            $AccordionResult=$QueryResult->fetch(PDO::FETCH_ASSOC);

            $Query = "SELECT IDInserzione, Titolo, DescrizioneInserzione, Salario FROM Inserzioni JOIN Aziende ON Aziende.IDAzienda = Inserzioni.IDAzienda WHERE Aziende.IDAzienda = ".$_SESSION["ID"]."";
            $QueryResult = $db->query($Query);
            $QueryResult->setFetchMode(PDO::FETCH_ASSOC);
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

                    <script type="text/javascript">
                        function Check(){
                            var Titolo = $("#Titolo").val();
                            var Figura = $("#Figura").val();
                            var Anni = $("#Anni").val();
                            var Contratto = $("#Contratto").val();
                            var Salario = $("#Salario").val();
                            var Studio = $("#TitoloDiStudio").val();
                            var Descrizione = $("#DescrizioneInserzione").val();

                            //Controllo del nome
                            if(Titolo == "") {
                            document.getElementById("Titolo").style.border = "solid red";
                            bootbox.alert("<b>Errore.</b><br>Devi inserire un Titolo");
                            return false;
                            }else {
                            document.getElementById("Titolo").style.border = "solid green";
                            }

                            if(Figura == "") {
                            document.getElementById("Figura").style.border = "solid red";
                            bootbox.alert("<b>Errore.</b><br>Devi inserire una figura lavorativa");
                            return false;
                            }else {
                            document.getElementById("Figura").style.border = "solid green";
                            }

                            if(Anni == "") {
                            document.getElementById("Anni").style.border = "solid red";
                            bootbox.alert("<b>Errore.</b><br>Devi inserire degli anni di esperienza (Numero)");
                            return false;
                            }else {
                            document.getElementById("Anni").style.border = "solid green";
                            }

                            if (isNaN(Anni) === true) {
                            document.getElementById("Anni").style.border = "solid red";
                            bootbox.alert("<b>Errore.</b><br>Devi inserire degli anni di esperienza (Numero)");
                            return false;
                            }else {
                            document.getElementById("Anni").style.border = "solid green";
                            }

                            if(Contratto == "") {
                            document.getElementById("Contratto").style.border = "solid red";
                            bootbox.alert("<b>Errore.</b><br>Devi inserire un tipo di contratto");
                            return false;
                            }else {
                            document.getElementById("Contratto").style.border = "solid green";
                            }

                            if(Salario == "") {
                            document.getElementById("Salario").style.border = "solid red";
                            bootbox.alert("<b>Errore.</b><br>Devi inserire un salario (Numero)");
                            return false;
                            }else {
                            document.getElementById("Salario").style.border = "solid green";
                            }

                            if (isNaN(Salario) === true) {
                            document.getElementById("Salario").style.border = "solid red";
                            bootbox.alert("<b>Errore.</b><br>Devi inserire un salario (Numero ES: 90.90)");
                            return false;
                            }else {
                            document.getElementById("Salario").style.border = "solid green";
                            }

                            if(Studio == "") {
                            document.getElementById("TitoloDiStudio").style.border = "solid red";
                            bootbox.alert("<b>Errore.</b><br>Devi inserire titolo di studio");
                            return false;
                            }else {
                            document.getElementById("TitoloDiStudio").style.border = "solid green";
                            }

                            if(Descrizione == "") {
                            document.getElementById("DescrizioneInserzione").style.border = "solid red";
                            bootbox.alert("<b>Errore.</b><br>Devi inserire una descrizione all'annuncio");
                            return false;
                            }else {
                            document.getElementById("DescrizioneInserzione").style.border = "solid green";
                            }

                            //Inizio chiamata AJAX
                            $.ajax({
                                type: "POST",
                                url: "CreateInsertion.php",
                                data: {
                                        "Titolo" : Titolo,
                                        "Figura" : Figura,
                                        "Anni" : Anni,
                                        "Contratto" : Contratto,
                                        "Salario" : Salario,
                                        "Studio" : Studio,
                                        "Descrizione" : Descrizione
                                    },
                                dataType: "json",

                                success: function(response){
                                    // creare una risposta in ajax che funzioni con la sessione
                                    if(response == true){
                                      document.getElementById('ModalNotice').innerHTML = 'Inserzione creata correttamente.';
                                      document.getElementById("ModalNotice").classList.toggle('text-success');
                                      setTimeout(function(){ window.location.reload() }, 3000);
                                    }else{
                                      document.getElementById('ModalNotice').innerHTML = "Errore nel caricamento dell' inserzione";
                                      document.getElementById("ModalNotice").classList.toggle('text-danger');
                                    }
                                },
                                error: function(xhr, ajaxOptions, thrownError, response) {
                                  console.log(response);
                                  alert(response);
                                  alert(xhr.status);
                                  alert(thrownError);
                                }
                            });
                         }
                    
                    function Delete(ID){
                      $.ajax({
                        type: "POST",
                        url: "Delete.php",
                        data: {"ID" : ID},
                        dataType: "json",

                        success: function(response){
                            // creare una risposta in ajax che funzioni con la cancellazione
                            if(response == true){
                              bootbox.alert("Annuncio cancellato correttamente.");
                              setTimeout(function(){ window.location.reload() }, 3000);
                            }else{
                              bootbox.alert("Errore durante la cancellazione dell'annuncio.");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError, response) {
                          console.log(response);
                          alert(response);
                          alert(xhr.status);
                          alert(thrownError);
                        }
                      });
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
                            <a class="navbar-brand" href="https://lucalaspina.netsons.org/JobFinder/index.php" style="color: #9AFF0D">JobFinder</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                  <a class="nav-link" href="../index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="../search/index.php">Cerca lavoro</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#Insertion">Crea inserzione</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link active" aria-current="page" href="profile.php">Il mio profilo</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                <a class="nav-link" href="../aut/logout.php">Logout</a>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </nav>

                        <!-- Inizio del body -->
                        <br>
                        <div class="container">
                            <div class="display-1 text-center" style="font-family: 'Pacifico', coursive;">
                            JobFinder
                            </div>
                            <div class="h4 text-center" style="font-family: 'Crete Round', serif;">
                            Area profilo aziendale.
                            </div>
                        </div>

                        <div class="container">
                            <hr>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="accordion shadow-lg rounded" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Premessa
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                Benvenuto, questa è l'area privata della tua azienda: <strong><?php echo $AccordionResult["NomeAzienda"]; ?></strong>. all'interno di questa sezione potrai vedere le tue inserzioni, pubblibare nuove inserzioni e visualizzare i dati inerenti alla tua azienda!
                                                </div>
                                            </div>
                                            </div>
                                            <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Dati azienda
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                              <div class="row">
                                                <div class="col-md-2">
                                                  <div class="accordion-body">
                                                      Nome:
                                                      <br>
                                                      Numero dipendenti:
                                                      <br>
                                                      Descrizione:
                                                      <br>
                                                      Telefono:
                                                      <br>
                                                      Email:
                                                  </div>
                                                </div>
                                                <div class="col">
                                                  <div class="accordion-body">
                                                      <?php echo $AccordionResult["NomeAzienda"]; ?>
                                                      <br>
                                                      <?php echo $AccordionResult["NDipendenti"]; ?>
                                                      <br>
                                                      <?php echo $AccordionResult["DescrizioneAzienda"]; ?>
                                                      <br>
                                                      <?php echo $AccordionResult["TelefonoAzienda"]; ?>
                                                      <br>
                                                      <?php echo $AccordionResult["EmailAzienda"]; ?>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            </div>
                                            <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Le tue inserzioni.
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <!-- Codice PHP -->
                                                    <?php while($DinamicResult = $QueryResult->fetch()){ ?>
                                                    <div class="list-group">
                                                        <span class="list-group-item list-group-item-action flex-column align-items-start">
                                                            <div class="d-flex w-100 justify-content-between">
                                                              <h5 class="mb-1"><strong>Titolo: </strong> <?php echo htmlspecialchars($DinamicResult['Titolo']); ?></h5>
                                                              <button class="badge bg-danger" onclick="Delete(<?php echo $DinamicResult['IDInserzione'];?>)">X</Button>
                                                            </div>
                                                            <p class="mb-1"><strong>Descrizione: </strong> <?php echo htmlspecialchars($DinamicResult['DescrizioneInserzione']); ?></p>
                                                            <small><strong>Salario mensile: </strong> <?php echo htmlspecialchars($DinamicResult['Salario']); ?>€</small>
                                                        </span>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Insertion Modal -->
                        <div class="modal fade" id="Insertion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Dashboard inserizione</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <!-- Form crezione inserzione -->
                                <form>
                                  <div class="row">
                                    <div class="text-center">
                                      <label class="form-label">Titolo*</label>
                                      <input type="text" class="form-control" id="Titolo">
                                    </div>
                                    <div class="col-12">
                                      <hr>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <label class="form-label">Figura ricercata*</label>
                                        <input type="text" class="form-control" id="Figura">
                                      </div>
                                      <div class="col-6">
                                        <label class="form-label">Anni di esperienza*</label>
                                        <input type="text" class="form-control" id="Anni">
                                      </div>
                                      <div class="col-6">
                                        <label class="form-label">Tipo di contratto*</label>
                                        <select id="Contratto" class="form-select">
                                          <option></option>
                                          <option>Determinato</option>
                                          <option>Indeterminato</option>
                                        </select>
                                      </div>
                                      <div class="col-6">
                                        <label class="form-label">Salario mensile*</label>
                                        <input type="text" class="form-control" id="Salario">
                                      </div>
                                      <div class="col-12">
                                        <label class="form-label">Titolo di studio minimo*</label>
                                        <select id="TitoloDiStudio" class="form-select">
                                          <option></option>
                                          <option>Diploma scuola media</option>
                                          <option>Diploma scuola superione</option>
                                          <option>Laurea triennale</option>
                                          <option>Lauera magistrale</option>
                                          <option>Dottorato</option>
                                        </select>
                                      </div>
                                      <div class="col-12">
                                        <label class="form-label">Descrizione*</label>
                                        <textarea type="text" class="form-control" id="DescrizioneInserzione"></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="ModalNotice" class="fw-bold text-center">
                                  </div>
                                  <br>
                                  <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-primary" onclick="Check();">Invia</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    </body>
                </html>
                <?php
            } catch(PDOException $e){
                echo 'Errore: ' . $e->getMessage();
            }
        }else {
            echo "Sessione scaduta, si prega di rifare il login.";
        }
?>
