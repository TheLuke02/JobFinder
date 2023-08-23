<?php

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('You cannot access to the page');
    }

    include("../.gitignore/config.php");
    
    $Nome = filter_var($_POST["Nome"], FILTER_SANITIZE_ADD_SLASHES);
    $Email = filter_var($_POST["Email"], FILTER_SANITIZE_ADD_SLASHES);
    $Password = filter_var($_POST["Password"], FILTER_SANITIZE_ADD_SLASHES);
    $Telefono = filter_var($_POST["Telefono"], FILTER_SANITIZE_ADD_SLASHES);
    $Via = filter_var($_POST["Via"], FILTER_SANITIZE_ADD_SLASHES);
    $Città = filter_var($_POST["Città"], FILTER_SANITIZE_ADD_SLASHES);
    $Regione = filter_var($_POST["Regione"], FILTER_SANITIZE_ADD_SLASHES);
    $CodicePostale = filter_var($_POST["CodicePostale"], FILTER_SANITIZE_ADD_SLASHES);
    $Telefono = filter_var($_POST["Telefono"], FILTER_SANITIZE_ADD_SLASHES);
    $NDip = filter_var($_POST["NDipendenti"], FILTER_SANITIZE_ADD_SLASHES);
    $Bio = filter_var($_POST["BioAzienda"], FILTER_SANITIZE_ADD_SLASHES);
    $Provincia = filter_var($_POST["Provincia"], FILTER_SANITIZE_ADD_SLASHES);

    $Password = md5($Password);

    try {
        //Provo a collegarmi al DB
        $db = new PDO($cnn , "$db_user", "$db_psw");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Vedo se la query inserita è già eesistente
        $Query = "SELECT EmailAzienda FROM Aziende WHERE EmailAzienda='".$Email."'";
        
        $QueryResult = $db->query($Query);
        $Result = $QueryResult->fetch(PDO::FETCH_ASSOC);
        
        //Se non risulta alcuna email si inseriscono i dati
        if(empty($Result)){
            //Prelevo l'id più grande al momento
            $Query = "SELECT MAX(IDAzienda) FROM Aziende";
            $QueryResult = $db->query($Query);
            $Result = $QueryResult->fetch(PDO::FETCH_ASSOC);
            $NewID = intval($Result["MAX(IDAzienda)"]);
            //Nuovo ID
            $NewID++;
            
            
            $Query = "INSERT INTO Aziende (IDAzienda, NomeAzienda, TelefonoAzienda, EmailAzienda, PasswordAzienda, RegioneAzienda, CAPAzienda, CittaAzienda, ViaAzienda, DescrizioneAzienda, ProvinciaAzienda, NDipendenti)
            VALUES ('".$NewID."','".$Nome."','".$Telefono."','".$Email."','".$Password."','".$Regione."',$CodicePostale,'".$Città."','".$Via."','".$Bio."','".$Provincia."', $NDip)"; 

            $Response = $db->exec($Query);
            //Creazione pagina html
            if($Response > 0){
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
                            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                            
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
                            <link rel="shortcut icon" href="https://jobfinder.netsons.org/image/icon.png"/>

                            <title>JobFinder</title>
                        </head>
                        <body>
                            <!-- Navbar -->
                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-family: 'Roboto Slab', serif;">
                            <div class="container">
                                <a class="navbar-brand" href="https://jobfinder.netsons.org/" style="color: #9AFF0D">JobFinder</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            </nav>

                            <div class="container">
                            <!-- Card di registrazione -->
                            <div class="row d-flex align-items-center">
                                <br><br><br><br><br>
                                <br><br><br><br><br>
                                <br><br><br><br><br>
                                <br><br><br><br><br>
                                <div class="col text-center">
                                    <h1 class="display-1" style="font-family: 'Pacifico', cursive;">JobFinder</h1>
                                    <h1 class="display-6" style="font-family: 'Roboto Slab';">Il tuo account Aziendale è stato creato correttamente.</h1>
                                    <hr>
                                    <a href="https://jobfinder.netsons.org/">
                                        <button type="button" class="btn btn-success">Torna indietro</button>
                                    </a>
                                </div>
                            </div>
                        </body>
                    </html>
                <?php
            }
        }else {
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
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    
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
                    <link rel="shortcut icon" href="https://jobfinder.netsons.org/image/icon.png"/>

                    <title>JobFinder</title>
                </head>
                <body>
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-family: 'Roboto Slab', serif;">
                    <div class="container">
                        <a class="navbar-brand" href="https://jobfinder.netsons.org/" style="color: #9AFF0D">JobFinder</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    </nav>

                    <div class="container">
                    <!-- Card di registrazione -->
                    <div class="row d-flex align-items-center">
                        <br><br><br><br><br>
                        <br><br><br><br><br>
                        <br><br><br><br><br>
                        <br><br><br><br><br>
                        <div class="col text-center">
                            <h1 class="display-1" style="font-family: 'Pacifico', cursive;">JobFinder</h1>
                            <h1 class="display-6" style="font-family: 'Roboto Slab';">Errore, l'email che hai inserito he già stata utilizzata.</h1>
                            <hr>
                            <a href="https://jobfinder.netsons.org/aut/UserRegister.html">
                                <button type="button" class="btn btn-success">Torna indietro</button>
                            </a>
                        </div>
                    </div>
                </body>
            </html>
            <?php
        }
    }catch (PDOException $e) {
        echo 'Errore: ' . $e->getMessage();
    }
    $db = null;
?>

