<?php
header ('Content-type:text/html; charset=utf-8');
//include 'functions.php';

//require_once './includes/functions.php';
require_once './includes/db_connect.php';
require_once './includes/fonction.php';
require_once './includes/functions.php';

// Afficher les erreurs à l'écran
    ini_set('display_errors', 0);
    // Enregistrer les erreurs dans un fichier de log
    ini_set('log_errors', 1);
    // Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');
    // Afficher les erreurs et les avertissements
    //error_reporting(e_all);
    //
    //
//script de Deconnexion

sec_session_start();
 
// Détruisez les variables de session 
$_SESSION = array();
 
// Retournez les paramètres de session 
$params = session_get_cookie_params();
 
// Effacez le cookie. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Détruisez la session 
session_destroy();
$sql2 = 'DELETE FROM nb_online where ip = "'.$_SERVER['REMOTE_ADDR'].'"';
$req = mysqli_query($connect, $sql2) or exit(mysqli_error($connect));

header('Location: ./index.php');