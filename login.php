<?php

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('You cannot access to the page');
  }

  include("./.gitignore/config.php");

  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $pw = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  $table = filter_var($_POST['table'], FILTER_SANITIZE_STRING);

  $pw = md5($pw);

  try{
    $db = new PDO($cnn , "$db_user", "$db_psw");
    if($table == "Utenti"){
      $Query = "SELECT IDUtente, EmailUtente, PasswordUtente FROM Utenti WHERE EmailUtente='".$email."' AND PasswordUtente='".$pw."'";
    }else{
      $Query = "SELECT IDAzienda, EmailAzienda, PasswordAzienda FROM Aziende WHERE EmailAzienda='".$email."' AND PasswordAzienda='".$pw."'";
    }
    $QueryResult = $db->query($Query);
    $Result=$QueryResult->fetch(PDO::FETCH_ASSOC);

    if($table == "Utenti"){
      if(strcmp($pw, $Result["PasswordUtente"]) == 0){
        session_start();
        $_SESSION["ID"] = $Result["IDUtente"];
        $_SESSION["Table"] = "Utenti";
        echo json_encode(true);
      }else{
        echo json_encode(false);
      }
    }else{
      if(strcmp($pw, $Result["PasswordAzienda"]) == 0){
        session_start();
        $_SESSION["ID"] = $Result["IDAzienda"];
        $_SESSION["Table"] = "Aziende";
        echo json_encode(true);
      }
      else{
        echo json_encode(false);
      }
    }
  }catch(PDOException $e){
      echo 'Errore: ' . $e->getMessage();
  }
  $db = null;
?>
