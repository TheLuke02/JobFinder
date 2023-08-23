<?php

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('You cannot access to the page');
    }

    session_start();

    if (isset($_SESSION["ID"])) {
        include("../config.php");

        $Titolo = filter_var($_POST["Titolo"], FILTER_SANITIZE_MAGIC_QUOTES);
        $Figura = filter_var($_POST["Figura"], FILTER_SANITIZE_MAGIC_QUOTES);
        $Anni = filter_var($_POST["Anni"], FILTER_SANITIZE_MAGIC_QUOTES);
        $Contratto = filter_var($_POST["Contratto"], FILTER_SANITIZE_MAGIC_QUOTES);
        $Salario = filter_var($_POST["Salario"], FILTER_SANITIZE_MAGIC_QUOTES);
        $Studio = filter_var($_POST["Studio"], FILTER_SANITIZE_MAGIC_QUOTES);
        $Descrizione = filter_var($_POST["Descrizione"], FILTER_SANITIZE_MAGIC_QUOTES);

        try{
            $db = new PDO($cnn , "$db_user", "$db_psw");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Prelevo l'id più grande al momento
            $Query = "SELECT MAX(IDInserzione) FROM Inserzioni";
            $QueryResult = $db->query($Query);
            $Result = $QueryResult->fetch(PDO::FETCH_ASSOC);
            $NewID = intval($Result["MAX(IDInserzione)"]);
            //Nuovo ID
            $NewID++;

            $Query = "INSERT INTO Inserzioni (IDInserzione, IDAzienda, Salario, DescrizioneInserzione, Titolo, FiguraRicercata, AnniEsperienza, TipoContratto, StudioMinimoRichiesto)
            VALUES ('".$NewID."','".$_SESSION['ID']."',$Salario,'".$Descrizione."','".$Titolo."','".$Figura."',$Anni,'".$Contratto."','".$Studio."')";


            $Response = $db->exec($Query);

            if($Response > 0){
                echo json_encode(true);
            }else{
                echo json_encode(false);
            }
        }catch(PDOException $e){
            echo 'Errore: ' . $e->getMessage();
        }
        $db = null;
    }else{
        json_encode("Errore nel controllo dell'account aziendale. Accesso negato.");
    }

?>
