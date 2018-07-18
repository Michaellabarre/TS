<?php
    header ('Content-type:text/html; charset=utf-8');

    include 'db_connect.php';
    include 'functions.php';

    ini_set('display_errors', 0);    
    ini_set('log_errors', 1);    
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');    
    //error_reporting(e_all);

    sec_session_start();

    if (isset($_POST['Nomuser'], $_POST['p'])){
        $Nomuser = $_POST['Nomuser'];
        $password = md5($_POST['p']); // Le mot de passe hashé.
        echo '<br />username:' .$Nomuser .'<br />password ' .$password;

        if (login($Nomuser, $password, $mysqli) == true) {                        
//            header('location: ../acceuil.php');
        header('location: ../guide/index.php');
        } else {            
            header('location: ../index.php?error=1');            
        }
    } else {        
        echo 'Invalid Request';
    }