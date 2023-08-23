<?php
    include("../config.php");

    session_start();

    //Controllo se la sessione è attiva
    if(isset($_SESSION["ID"])){
        try {
            $db = new PDO($cnn , "$db_user", "$db_psw");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query per le informazioni dell'utente
            $Query = "SELECT * FROM Utenti WHERE IDUtente=".$_SESSION["ID"]."";
            $QueryResult = $db->query($Query);
            $Result=$QueryResult->fetch(PDO::FETCH_ASSOC);

            $Query = "SELECT Preferiscono.IDInserzione, Preferiscono.IDUtente, NomeAzienda, Titolo, DescrizioneInserzione, Salario
            FROM Aziende JOIN (Inserzioni JOIN Preferiscono ON Inserzioni.IDInserzione = Preferiscono.IDInserzione) ON Aziende.IDAzienda = Inserzioni.IDAzienda
            WHERE Preferiscono.IDUtente = ".$_SESSION["ID"]."";
            
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

                        <script>
                            function Delete(IDInserzione, IDUtente){

                                $.ajax({
                                    type: "POST",
                                    url: "DeleteFavourite.php",
                                    data: {"IDInserzione" : IDInserzione, "IDUtente" : IDUtente},
                                    dataType: "json",

                                    success: function(response){
                                        // creare una risposta in ajax che funzioni con la cancellazione
                                        console.log(response);
                                        if(response == true){
                                        bootbox.alert("Annuncio cancellato correttamente dai preferiti.");
                                        setTimeout(function(){ window.location.reload() }, 3000);
                                        }else{
                                        bootbox.alert("Errore durante la cancellazione dell'annuncio dai preferiti.");
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
                                Area personale utente.
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
                                                    Benvenuto <strong><?php echo $Result["Nome"]; ?></strong>, questa è il tuo profilo personale. Qui potrai visualizzare i tuoi dati personali e le Inserzioni che hai inserito nella lista dei preferiti!
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Dati utente
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="row">
                                                      <div class="col-md-2">
                                                        <div class="accordion-body">
                                                            Nome:
                                                            <br>
                                                            Cognome:
                                                            <br>
                                                            Codice Fiscale:
                                                            <br>
                                                            Telefono:
                                                            <br>
                                                            Email:
                                                        </div>
                                                      </div>
                                                      <div class="col">
                                                        <div class="accordion-body">
                                                            <?php echo $Result["Nome"]; ?>
                                                            <br>
                                                            <?php echo $Result["Cognome"]; ?>
                                                            <br>
                                                            <?php echo $Result["CF"]; ?>
                                                            <br>
                                                            <?php echo $Result["TelefonoUtente"]; ?>
                                                            <br>
                                                            <?php echo $Result["EmailUtente"]; ?>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Inserzioni preferite
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
                                                              <button class="badge bg-danger" onclick="Delete('<?php echo $DinamicResult['IDInserzione'];?>', '<?php echo $DinamicResult['IDUtente'];?>')">X</Button>
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
