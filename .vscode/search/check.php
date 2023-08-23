<?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('You cannot access to the page');
    }

    include("../config.php");

    $IDUtente = filter_var($_POST["IDUtente"], FILTER_SANITIZE_MAGIC_QUOTES);
    $IDInserzione = filter_var($_POST["IDInserzione"], FILTER_SANITIZE_MAGIC_QUOTES);

    try{
        $db = new PDO($cnn , "$db_user", "$db_psw");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Query = "SELECT * FROM Preferiscono 
                  WHERE IDInserzione='".$IDInserzione."' AND IDUtente='".$IDUtente."'";

        $QueryResult = $db->query($Query);
        $Result=$QueryResult->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($Result);

    }catch(PDOException $e){
        echo json_encode('Errore: ' . $e->getMessage());
    }
    $db = null;
?>