<?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('You cannot access to the page');
    }

    include("../.gitignore/config.php");

    $Titolo = filter_var($_POST["Titolo"], FILTER_SANITIZE_ADD_SLASHES);
    $Provincia = filter_var($_POST["Provincia"], FILTER_SANITIZE_ADD_SLASHES);

    try{
        $db = new PDO($cnn , "$db_user", "$db_psw");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Query = "SELECT Inserzioni.IDAzienda, IDInserzione, Salario, DescrizioneInserzione, Titolo, NomeAzienda, EmailAzienda
        FROM Aziende JOIN Inserzioni ON Aziende.IDAzienda = Inserzioni.IDAzienda
        WHERE Titolo LIKE ('%".$Titolo."%') AND ProvinciaAzienda = '".$Provincia."'";

        $QueryResult = $db->query($Query);
        $Result=$QueryResult->fetchAll(PDO::FETCH_ASSOC);

        
        echo json_encode($Result);

    }catch(PDOException $e){
        echo json_encode('Errore: ' . $e->getMessage());
    }
    $db = null;
?>