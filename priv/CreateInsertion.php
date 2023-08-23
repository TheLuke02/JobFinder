<?php

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('You cannot access to the page');
    }

    session_start();

    if (isset($_SESSION["ID"])) {
        include("../.gitignore/config.php");

        $Titolo = filter_var($_POST["Titolo"], FILTER_SANITIZE_ADD_SLASHES);
        $Figura = filter_var($_POST["Figura"], FILTER_SANITIZE_ADD_SLASHES);
        $Anni = filter_var($_POST["Anni"], FILTER_SANITIZE_ADD_SLASHES);
        $Contratto = filter_var($_POST["Contratto"], FILTER_SANITIZE_ADD_SLASHES);
        $Salario = filter_var($_POST["Salario"], FILTER_SANITIZE_ADD_SLASHES);
        $Studio = filter_var($_POST["Studio"], FILTER_SANITIZE_ADD_SLASHES);
        $Descrizione = filter_var($_POST["Descrizione"], FILTER_SANITIZE_ADD_SLASHES);

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
