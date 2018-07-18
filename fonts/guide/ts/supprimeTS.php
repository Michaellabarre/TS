<!DOCTYPE html>

<?php

header ('Content-type:text/html; charset=utf-8');
require_once '../../includes/db_connect.php';
require_once '../../includes/fonction.php';
require_once '../../includes/functions.php';

ini_set('display_errors', 0);    
ini_set('log_errors', 1);    
ini_set('error_log', 'C:\www\TS\log_error_php.txt');    
//    error_reporting(e_all);    

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_GET['Id'])){
    $Id  = $_GET['Id'];  
    $numLigne = $_GET['ligneNum']; 
//    echo 'id '.$Id;
    
    $mysqli->query("SET AUTOCOMMIT=0");
    $req = 'delete from heuresfichepointage
        where RefDetailFichePointage = "'.$Id.'"';
    $res = mysqli_query($connect, $req) or exit(mysqli_error($connect));
    if($res){
        $mysqli->query("COMMIT");
//        echo 'yesss';
    }
    else{
//        echo 'noooo';
        echo 'Erreur !!!';
    }
}

?>


<html lang="fr" xml:lang="fr">  
    <head>
        <meta http-equiv="content-type" content="text/html" charset="utf-8" />
        <script type="text/javascript" src="../../jquery/jquery.js"></script>        
        <script src="../../jquery/jquery-1.8.1.min.js" type="text/javascript"></script>        
        <script src="../../jquery/jquery-ui-1.11.2/jquery-ui.js"></script>  
    </head>
    <body>
        <script type="text/javascript">    
            $(document).ready(function() {                
                var nbLigne = 500;
                var numLigne = "<?php echo $numLigne;?>";
                for(i=1; i<=nbLigne;i++){
                    if(i == numLigne){
                        $("tr").remove("#" +numLigne);
                        $("tr").remove(".cache_" +numLigne);
                        $("tr").remove("#kala_" +numLigne);
                        break;
                    }
                }                                              
            });                                  
        </script>   
    </body>
</html>