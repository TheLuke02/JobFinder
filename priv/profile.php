<?php
    include("../.gitignore/config.php");

    session_start();

    //Controllo se la sessione è attiva
    if(isset($_SESSION["ID"])){
      //Controllo a quale yabella si fa riferimento
      if($_SESSION["Table"] == "Utenti"){
          header("Location: https://jobfinder.netsons.org/priv/User.php");
      }else {
          header("Location: https://jobfinder.netsons.org/priv/Enterprise.php");
      }
    }else {
        echo "Sessione scaduta, si prega di rifare il login.";
    }


?>
