<?php
header ('Content-type:text/html; charset=utf-8');
include 'psl-config.php'; 

// Afficher les erreurs à l'écran
    ini_set('display_errors', 0);
    // Enregistrer les erreurs dans un fichier de log
    ini_set('log_errors', 1);
    // Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');
    // Afficher les erreurs et les avertissements
    //error_reporting(e_all);

$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, DATABASE) or exit('Erreur '.mysqli_error($connect));
mysqli_query($connect, "SET NAMES UTF8");

?>