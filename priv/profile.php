<?php
    include("../config.php");

    session_start();

    //Controllo se la sessione è attiva
    if(isset($_SESSION["ID"])){
      //Controllo a quale yabella si fa riferimento
      if($_SESSION["Table"] == "Utenti"){
          header("Location: https://lucalaspina.netsons.org/JobFinder/priv/User.php");
      }else {
          header("Location: https://lucalaspina.netsons.org/JobFinder/priv/Enterprise.php");
      }
    }else {
        echo "Sessione scaduta, si prega di rifare il login.";
    }


?>
