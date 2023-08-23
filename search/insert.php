<?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('You cannot access to the page');
    }

    include("../config.php");

    $IDUtente = filter_var($_POST["IDUtente"], FILTER_SANITIZE_ADD_SLASHES);
    $IDInserzione = filter_var($_POST["IDInserzione"], FILTER_SANITIZE_ADD_SLASHES);

    try{
        $db = new PDO($cnn , "$db_user", "$db_psw");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Query = "INSERT INTO Preferiscono (IDInserzione, IDUtente)
            VALUES ('".$IDInserzione."','".$IDUtente."')"; 

        $Response = $db->exec($Query);
        //Creazione pagina html
        if($Response > 0){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }

    }catch(PDOException $e){
        echo json_encode('Errore: ' . $e->getMessage());
    }
    $db = null;
?>