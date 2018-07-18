<!DOCTYPE html>	

﻿<?php
header ('Content-type:text/html; charset=utf-8');    
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';
    
    sec_session_start();    
    
    ini_set('display_errors', 0);    
    ini_set('log_errors', 1);    
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');    
    //error_reporting(e_all);
    
    function changeDate($date){
        $tab = explode("-", $date);
        $dateChangee = $tab[2]."-".$tab[1]."-".$tab[0];
        return $dateChangee;
    }

$dateMvt = $_GET['dateMvt'];
$codeMission = $_GET['codeMiss'];
$refFP = $_GET['refFP'];


//echo 'dateMvt '.$dateMvt .' codeMission '.$codeMission .' refFP '.$refFP;


$query = 'select RefFraisFichePresence as reffrais, D.Categ as Categorie, MontantDepense as Montant, DescriptionDepense as Description '
    . 'from fraisfichepointage '
    . 'inner join depense D on (D.Categ = fraisfichepointage.Categ)'
    . 'inner join heuresfichepointage H on (fraisfichepointage.RefDetailFichePointage = H.RefDetailFichePointage)'
    . 'where fraisfichepointage.RefDetailFichePointage = "'.$refFP.'"'
    . 'order by D.Categ ASC';

?>

<html lang="fr" xml:lang="fr">
    <head>
        <meta http-equiv="content-type" content="text/html" charset="utf-8" />
        <script>
        function getIndex(chaine, leSelect){                                                                                        
            var nb = document.getElementById(leSelect).options.length;                
            var iz = 0;
            var lindex = 0;
            while(iz<nb){
                if(document.getElementById(leSelect).options[iz].value === chaine){
                    lindex = iz;
                }
                iz++;
            }
            return lindex;
        }
        </script>
    </head>
    <hr />

<!--<h4>D&eacute;pense</h4>-->
<?php // echo 'Date de d&eacute;pense: '.changeDate($dateMvt); ?>
<div id="factContainer" style=" margin-left: 0px;">
<center>
<table cellspacing="0" cellpadding="0" border="0" width="1122px" id="echeance"> 
    <thead>
        <tr>               
            <td ><b><center>Cat&eacute;gorie</center></b></td>
            <td ><b><center>Montant</center></b></td>
            <td ><b><center>D&eacute;scription</center></b></td>
        </tr>
    </thead>
    <tbody>

<?php
$mysqli->set_charset("utf8");
$result = $mysqli->query($query);


//echo $query;

while ($row = $result->fetch_array()) {
    //echo 'cat: '.$row['Categorie'].' montant '.$row['Montant'].' desc '.$row['Description'].'<br />';
    echo "<tr>";    
//    echo "<tr id=\"".$numligne."\" onclick=\"Couleur(this.id);sendFacturation('".$row['reffrais']."', '".$row['Categorie']."', '".$row['Montant']."', '".$row['Description']."')\">";                                                                             
    echo "<input id='refichepoint' name='refichepoint' type='hidden'  value='".$refFP."' />";
    echo "<input id='reffrais' name='reffrais' type='hidden'  value='".$row['reffrais']."' />";
    echo "<td><center> ".$row['Categorie']."</td>";
    echo "<td><center>".$row['Montant']."</center></td>";
    echo "<td><center>".$row['Description']."</center></td>";    
    echo "</tr>";
}
?>

    </tbody>
</table>
</center>    
</div>    
</html>


