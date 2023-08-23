<?php

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('You cannot access to the page');
    }

    session_start();

    if (isset($_SESSION["ID"])) {
        include("../config.php");

        $ID = filter_var($_POST["ID"], FILTER_SANITIZE_ADD_SLASHES);

        try{
            $db = new PDO($cnn , "$db_user", "$db_psw");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            try {
                $db->beginTransaction();
                $db->exec("DELETE FROM Preferiscono WHERE IDInserzione = '".$ID."'");
                $db->exec("DELETE FROM Inserzioni WHERE IDInserzione = '".$ID."'");
                $Response = $db->commit();
            }catch (PDOException $e) {
                $db->rollBack();
                echo $e->getMessage();
            }

            echo json_encode($Response);

        }catch(PDOException $e){
            echo json_encode('Errore: ' . $e->getMessage());
        }
        $db = null;

    }else{
        json_encode("Errore nel controllo dell'account aziendale. Accesso negato.");
    }
?>