<?php
header ('Content-type:text/html; charset=utf-8');
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';

// Afficher les erreurs à l'écran
    ini_set('display_errors', 0);
    // Enregistrer les erreurs dans un fichier de log
    ini_set('log_errors', 1);
    // Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');
    // Afficher les erreurs et les avertissements
    //error_reporting(e_all);


    
    // à elle seule, la ligne suivante suffit à envoyer le résultat du script dans une feuille Excel    
    //header("Content-type: application/vnd.ms-excel");
    header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    // la ligne suivante est facultative, elle sert à donner un nom au fichier Excel
    header("Content-Disposition: attachment; filename=export.xls");
    header("Content-Transfer-Encoding: binary" );
    
    
/**************************************************************************************************************/    
//POUR LE TEST: année 2014
    //$taona = "2014";    
    //echo 'taona: '.$taona;
/**************************************************************************************************************/        
    
    
/**************************************************************************************************************/    
//POUR LA MISE EN PROD
      
//    $reqYear  = 'select YEAR(CURRENT_DATE()) as taona ;';
//    $resYear  = mysqli_query($connect, $reqYear) or exit(mysqli_error($connect));
//    $resTaona = mysqli_fetch_assoc($resYear);
//    $taona = $resTaona['taona'];
//    //echo 'taona: '.$taona;
/**************************************************************************************************************/      
    $mm = $_GET['daty'];
    $taona = $_GET['taona'];
//    echo 'aaaa ' .$mm;
    //$mois = "%".current($_POST['bouton'])."  ".$taona."%";
    $mois = "%".$mm." ".$taona."%";
//    echo 'On a cliqué sur le bouton '.$mois;      
    
    //Janvier  2015  -  du  01 au 15   
    
//    $mm = $_GET['daty'];
//    $mois = "%".$mm." ".$taona."%";
    
    $reqTSEx = 'select E.RefEmploye as Matricule, concat(E.Prenom, " ", E.NomFamille) as Nom, H.JourTravaille as Date, 
        H.RefProjet as CodeMission , P.RefClient as NomClient, D.Departement as Departement, 
        H.HeureFacturables as Heures, H.HeureFacturables/8 as Nb_jours, P.TypeProjet, 
        CASE 
            WHEN H.JourTravaille like "'.$taona.'-01-%" THEN "01"
            WHEN H.JourTravaille like "'.$taona.'-02-%" THEN "02"
            WHEN H.JourTravaille like "'.$taona.'-03-%" THEN "03"
            WHEN H.JourTravaille like "'.$taona.'-04-%" THEN "04"
            WHEN H.JourTravaille like "'.$taona.'-05-%" THEN "05"
            WHEN H.JourTravaille like "'.$taona.'-06-%" THEN "06"
            WHEN H.JourTravaille like "'.$taona.'-07-%" THEN "07"
            WHEN H.JourTravaille like "'.$taona.'-08-%" THEN "08"
            WHEN H.JourTravaille like "'.$taona.'-09-%" THEN "09"
            WHEN H.JourTravaille like "'.$taona.'-10-%" THEN "10"
            WHEN H.JourTravaille like "'.$taona.'-11-%" THEN "11"
            WHEN H.JourTravaille like "'.$taona.'-12-%" THEN "12" 
                else NULL
        END as Mois,
        E.Protarif as Position, H.DescriptionTravail as Description, H.Facture as Validation      
        from heuresfichepointage H 
        inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) 
        inner join employes E on (E.RefEmploye = F.RefEmploye)
        inner join projets P on (P.RefProjet = H.RefProjet)
        inner join departement D on (D.Coddept = H.Coddept)
        where H.RefFichePointage in 
        (
            select RefFichePointage as refFiche 
            from fichepointage 
            inner join periode P on (fichepointage.DateEntree = P.DateEntree)

            where P.PERIODE like "'.$mois.'"                
        )
        order by E.NomFamille, H.JourTravaille ASC;';
    
    $resTSEx = mysqli_query($connect,$reqTSEx) or exit(mysqli_error($connect));
       
    // on vérifie le contenu de  la requête ;
    if (mysqli_num_rows($resTSEx) == 0){   
        // si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
            print "<script> alert('La requête n\'a pas abouti !')</script>";
    } 
    
    $colonne = mysqli_num_fields($resTSEx); //col        
    $ligne = mysqli_num_rows($resTSEx); //rows
    
    // construction du tableau HTML
    echo '<table border=1>
        <!-- impression des titres de colonnes -->
         <TR>
            <TD><b>Numero Matricule</b></TD>
            <TD><b>Consultant</b></TD>
            <TD><b>Date</b></TD>
            <TD><b>Code mission</b></TD>
            <TD><b>Code Client</b></TD>
            <TD><b>D&eacute;partement</b></TD>
            <TD><b>Heures</b></TD>
            <TD><b>Nb Jours</b></TD>
            <TD><b>Type</b></TD>
            <TD><b>Mois</b></TD>
            <TD><b>Position</b></TD>                
            <TD><b>Description</b></TD>
            <TD><b>Validation</b></TD>
        </TR>';        
        
    while($row = mysqli_fetch_array($resTSEx, MYSQLI_BOTH)){
        echo '<tr>';
        for($j=0; $j < $colonne ; $j++){
            switch($j){
                case $j >0 && $j <12: 
                    echo '<td>'.$row[$j].'</td>';
                    break;
                case $j=13: if($row['Validation']==1){
                            echo '<td>Validé</td>';  
                        }
                        else if($row['Validation']==0){
                            echo '<td>Non Validé</td>';  
                        }
                        break;
            }               
        }
        echo '</tr>';
    }
        
    echo '</TABLE>';
    //mysql_close();       
