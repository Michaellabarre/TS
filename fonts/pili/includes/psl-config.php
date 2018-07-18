<?php
header ('Content-type:text/html; charset=utf-8');
// Afficher les erreurs à l'écran
    ini_set('display_errors', 0);
    // Enregistrer les erreurs dans un fichier de log
    ini_set('log_errors', 1);
    // Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');
    // Afficher les erreurs et les avertissements
    //error_reporting(e_all);

/*********************connexion a la base de donnees mysql***************************/

/**
 * Voici les détails de connexion à la base de données
 */  
define("MYSQL_HOST", "localhost");     // L’hébergeur où vous voulez vous connecter.
define("MYSQL_USER", "manager");    // Le nom d’utilisateur de la base de données.
define("MYSQL_PASS", "eKcGZr59zAa2BEWUp");    // Le mot de passe de la base de données. 
define("DATABASE", "basets");    // Le nom de la base de données.
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // pour utiliser https: mettre la valeur TRUE (lors de l'implementation)

$connect;
$ppde;

	static $form = array();
	
	$connect = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
        //mysqli_query("SET NAMES UTF8"); 
	//mysqli_set_charset($connect,"utf8");
	mysqli_select_db($connect,'basets');
	
?>