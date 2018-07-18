<?php   
        
    header ('Content-type:text/html; charset=utf-8');
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';
    
    sec_session_start();        

    if($_GET['client'] == ''){
        die("error");
    }
    else{
        $cli = $_GET['client'];                
        
        $reqListCli = 'select typeclient as Ty, stat as ST, nif as NI, cif as CI, rcs as RC from client where NomSociete = "'.$cli.'"';    
        $rekListCli = mysqli_query($connect,$reqListCli) or exit(mysqli_error($connect));
        $resultListCli = mysqli_fetch_assoc($rekListCli);              
        $typeCli = $resultListCli['Ty'];
        $statTi = $resultListCli['ST'];
        $nifTi  = $resultListCli['NI'];
        $cifTi  = $resultListCli['CI'];
        $rcsTi  = $resultListCli['RC'];  
        
        echo $typeCli.'!';  //0:type
        echo $statTi.'!';   //1:stat
        echo $nifTi.'!';     //2:nif
        echo $cifTi.'!';     //3:cif
        echo $rcsTi.'!';     //4:rcs
                
        
    }
    
die("success");
