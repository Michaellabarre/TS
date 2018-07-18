<!DOCTYPE html>

<?php
    header ('Content-type:text/html; charset=utf-8');
    require_once '../includes/db_connect.php';
    require_once '../includes/fonction.php';
    require_once '../includes/functions.php';
    
//    sec_session_start();
        
    ini_set('display_errors', 0);    
    ini_set('log_errors', 1);    
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');    
//    error_reporting(e_all);
    
    $tps_max_connex = 600;
    $temps_actuel = date("U");

    $sql = 'SELECT count(*) FROM nb_online WHERE ip= "'.$_SERVER['REMOTE_ADDR'].'"';
    $req = mysqli_query($connect, $sql) or exit(mysqli_error($connect));   
    
    $data = mysqli_fetch_array($req, MYSQLI_BOTH);
    mysqli_free_result($req);
    
    if ($data[0]) {	
	$sql = 'UPDATE nb_online SET time = "'.$temps_actuel.'" WHERE ip = "'.$_SERVER['REMOTE_ADDR'].'"';
        $req = mysqli_query($connect, $sql) or exit(mysqli_error($connect));
    }
    else {            
            $sql = 'INSERT INTO nb_online VALUES("'.$_SERVER['REMOTE_ADDR']. '", "'.$temps_actuel.'")';           
            $req = mysqli_query($connect, $sql) or exit(mysqli_error($connect));
    }
    
    $heure_max = $temps_actuel - $tps_max_connex;    
    
    $sql2 = 'DELETE FROM nb_online where time < "'.$heure_max.'"';
    $req = mysqli_query($connect, $sql2) or exit(mysqli_error($connect));
    
?>
