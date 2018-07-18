<?php
header ('Content-type:text/html; charset=utf-8');

include 'db_connect.php';
include 'functions.php';

// Afficher les erreurs à l'écran
    ini_set('display_errors', 0);
    // Enregistrer les erreurs dans un fichier de log
    ini_set('log_errors', 1);
    // Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');
    // Afficher les erreurs et les avertissements
    //error_reporting(e_all);
    
sec_session_start();
 
if (isset($_POST['Nomuser'], $_POST['p'])){
    $Nomuser = $_POST['Nomuser'];
    $password = $_POST['p']; // Le mot de passe hashé.
    echo '<br />username:' .$Nomuser .'<br />password ' .$password;
 
    if (login($Nomuser, $password, $mysqli) == true) {
        // Connecté 
        //echo '<br /> Ouverture de session réussie.';
        header('location: ../modif_pass.php');
    } else {
        // Pas connecté 
        header('location: ../connex.php?error=1');
        //echo 'NOOOOOO';
    }
} else {
    // Les variables POST correctes n’ont pas été envoyées à cette page
    echo 'Invalid Request';
}

?>