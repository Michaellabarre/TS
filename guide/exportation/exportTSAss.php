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

sec_session_start();
    
    // à elle seule, la ligne suivante suffit à envoyer le résultat du script dans une feuille Excel    
    //header("Content-type: application/vnd.ms-excel");
    header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    // la ligne suivante est facultative, elle sert à donner un nom au fichier Excel
    header("Content-Disposition: attachment; filename=export_ass.xls");
    header("Content-Transfer-Encoding: binary" );
    
    
/**************************************************************************************************************/    
//POUR LE TEST: année 2014
//    $taona = "2014";    
    //echo 'taona: '.$taona;
/**************************************************************************************************************/        
    
    
/**************************************************************************************************************/    
//POUR LA MISE EN PROD
      
//    $reqYear  = 'select YEAR(CURRENT_DATE()) as taona ;';
//    $resYear  = mysqli_query($connect, $reqYear) or exit(mysqli_error($connect));
//    $resTaona = mysqli_fetch_assoc($resYear);
//    $taona = $resTaona['taona'];
    //echo 'taona: '.$taona;
/**************************************************************************************************************/      
    
    //$mois          = $_POST['periode'];
    $collaborateur = $_GET['collaborateur'];
    //echo 'mois '.$mois.' coll '.$collaborateur;    
    
//    $mois = "%".$_POST['periode']." ".$taona."%";
    
    $mm = $_GET['daty'];
    $taona = $_GET['taona'];
    $mois = "%".$mm." ".$taona."%";
     
    
    if($collaborateur == 'avalider'){
        
        $truncateTass = 'truncate table tempvalidass;';
        $resTrun   = mysqli_query($connect, $truncateTass)or exit(mysqli_error($connect));  
        
        echo '<table border=1>
            <!-- impression des titres/entetes de colonnes -->
             <TR>                                
                <TD><b>Consultant</b></TD>
                <TD><b>Date</b></TD>
                <TD><b>Code mission</b></TD>
                <TD><b>Code Client</b></TD>
                <TD><b>D&eacute;partement</b></TD>
                <TD><b>Heures</b></TD>            
                <TD><b>Description</b></TD>   
                <TD><b>Validation</b></TD>    
                <TD><b>Dépense</b></TD>                                            
                <TD><b>Justificatifs</b></TD>     
            </TR>';
        
        //echo 'On a cliqué sur le bouton '.$mois;
        
        //echo 'col'.$collaborateur;
        
        $reqDatEntre = 'select F.DateEntree as dte, F.RefEmploye '
                . 'from fichepointage F '
                . 'inner join periode P on (P.DateEntree = F.DateEntree) '
                . 'where P.PERIODE like "'.$mois.'"'
                . 'order by F.RefEmploye ASC';
        $rekDteEntre = mysqli_query($connect,$reqDatEntre);
        $resultDteEntre = mysqli_fetch_assoc($rekDteEntre);
        $dteEntre = $resultDteEntre['dte'];                            
        //echo '<br />date '.$dteEntre;
        
        $employe = $_SESSION['username'];
        $reqRefEmploye = 'select RefEmploye as EMPLO, Profil as pro from employes where Nomuser = "'.$employe.'"';                    
        $rekRefEmp = mysqli_query($connect,$reqRefEmploye);
        $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
        $refEmploye = $resultRefEmp['EMPLO'];
        $pro = $resultRefEmp['pro'];
        
        $reqManager = 'select F.RefFichePointage as FRP, D.RefProjet as projet, D.Coddept as coddept, '
                . 'concat(E.Prenom, " ", E.NomFamille) as prenom '
                . 'from fichepointage F '
                . 'inner join periode Pe on (F.DateEntree = Pe.DateEntree) '
                . 'inner join deptprojet D on (D.Respvalid = F.RefEmploye) '
                . 'inner join employes E on (E.RefEmploye = D.Respvalid)'
                . 'where Pe.PERIODE like "'.$mois.'" '
                . 'and D.Dirmission = "'.$refEmploye.'" '
                . 'order by E.Prenom, F.RefFichePointage';                                
        $resMan = mysqli_query($connect, $reqManager);
        
        while ($res = mysqli_fetch_array($resMan, MYSQLI_BOTH)) {
            //echo '<br/>Projet: '.$res['projet']. ' - prenom: '.$res['prenom'];
            $reqTSMan = 'insert into tempvalidass (Colaborateur, Ref, Date, CodeMission, NomClient, Departement, Heures, '
                    . 'Description, Validation, RefFP, Depense, Justificatifs) '
                    . 'select concat(E.Prenom, " ", E.NomFamille) as Colaborateur, H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
                    . 'H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, '
                    . 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, H.Facture as Validation, '
                    . 'H.RefDetailFichePointage as RefFP, '
                    . 'FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs '                    
                    . 'from heuresfichepointage H '
                    . 'left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage) '                    
                    . 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
                    . 'inner join employes E on (E.RefEmploye = F.RefEmploye) '
                    . 'inner join projets P on (P.RefProjet = H.RefProjet) '
                    . 'where H.RefFichePointage = "'.$res['FRP'].'" '
                    . 'and H.RefProjet = "'.$res['projet'].'" '
                    . 'and H.Coddept = "'.$res['coddept'].'"'
                    //. 'and H.Facture = "0" '
                    . 'order by H.JourTravaille';
            $resTSMan = mysqli_query($connect, $reqTSMan);
            
//            while ($rowTSMan = mysqli_fetch_array($resTSMan, MYSQL_BOTH)) {
//                $GLOBALS['compte'] = $compte +1;
//                //echo "<tr onclick=\"showFacturation('".$rowTSMan['Date']."', '".$rowTSMan['CodeMission']."', '".$rowTSMan['RefFP']."')\">";"<tr>";
//                echo "<tr>";
//                echo "<td>".$rowTSMan['Ref']."</td>"
//                        . "<td>".$res['prenom']."</td>"
//                        . "<td>".$rowTSMan['Date']."</td>"
//                        . "<td>".$rowTSMan['CodeMission']."</td>"
//                        . "<td>".$rowTSMan['Departement']."</td>"
//                        . "<td>".$rowTSMan['Heures']."</td>"
//                        . "<td>".$rowTSMan['Description']."</td>"
//                        . "<td>".$rowTSMan['Depense']."</td>"
//                        . "<td>".$rowTSMan['Justificatifs']."</td>";                
//                echo "</input></td>";
//                echo '</tr>';                                    
//            }
            
        }
        $reqTimAss = 'select Ref, Colaborateur, Date, CodeMission, NomClient, Departement, Heures, Description, Validation, 
            Depense, Justificatifs 
            from tempvalidass
            order by Colaborateur ASC, Date, Ref;';
        $resTimAss = mysqli_query($connect, $reqTimAss)or exit(mysqli_error($connect)); 
        $colon = mysqli_num_fields($resTimAss); //col 
        $linin = 0;   
        $valu = array();
        while ($rowTS = mysqli_fetch_array($resTimAss, MYSQLI_BOTH)) {            
            echo '<tr>';      
        
            for($j=0; $j < $colon ; $j++){            
                if($j == 0){
                    $valu[$linin] = array($rowTS[$j]);
                    if($valu[$linin-1][$j] == $valu[$linin][$j]){                    
                        //echo '<td>'.$valu[$linin][$j].' biiii '.$linin.'</td>';  
                        for($j=0; $j < $colon ; $j++){                     
                            switch($j){                             
                                case $j > 1 && $j <=8: echo '<td style="border:none"></td>'; 
                                    break;                           
                                case 9: echo '<td>'.$rowTS[$j].'</td>';  
                                    break;
                                case 10: echo '<td>'.$rowTS[$j].'</td>';  
                                    break;
                            }
                        }
                    }
    //                else{
    //                    echo '<td>'.$valu[$linin][$j].'</td>';                                    
    //                }                
                }
                else{
                    
                    for($j=1; $j < $colon ; $j++){
                        switch($j){                             
                            case $j >= 1 && $j <=7: echo '<td>'.$rowTS[$j].'</td>';  
                                break;                           
                            case 8: if($rowTS['Validation']==1){
                                        echo '<td>Validé</td>';  
                                    }
                                    else if($rowTS['Validation']==0){
                                        echo '<td>Non Validé</td>';  
                                    }                                
                                break;
                            case 9: echo '<td>'.$rowTS[$j].'</td>';  
                                break;
                            case 10: echo '<td>'.$rowTS[$j].'</td>';  
                                break;
                        }
                    }
                    
                    //echo '<td>'.$rowTS[$j].'</td>';             
                }            
            }

            echo '</tr>';
            $linin = $linin + 1;                                    
        }
        
        
        echo '</TABLE>';
    }
    else{
        //echo 'col'.$collaborateur;
//        $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Prenom = "'.$collaborateur.'"';                    
//        $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
//        $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
//        $refEmploye = $resultRefEmp['EMPLO'];
        $refEmploye = $collaborateur;
        
        //echo 'refemploye: '.$refEmploye;
        
                //echo 'col';
         $reqTSEx = 'select H.RefDetailFichePointage as Ref, concat(E.Prenom, " ", E.NomFamille) as Nom, H.JourTravaille as Date, 
            H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, 
            H.HeureFacturables as Heures, H.DescriptionTravail, H.Facture as Validation, 
            FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs 
            from heuresfichepointage H
            left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage)     
            inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) 
            inner join employes E on (E.RefEmploye = F.RefEmploye)
            inner join projets P on (P.RefProjet = H.RefProjet) 
            where H.RefFichePointage in 
            (
                select RefFichePointage as refFiche 
                from fichepointage 
                inner join periode P on (fichepointage.DateEntree = P.DateEntree)
                where P.PERIODE like "'.$mois.'"                
            )        
            and F.RefEmploye = "'.$refEmploye.'"
            order by H.JourTravaille ASC, H.RefDetailFichePointage ;';

        $resTSEx = mysqli_query($connect,$reqTSEx) or exit(mysqli_error($connect));

        // on vérifie le contenu de  la requête ;
        if (mysqli_num_rows($resTSEx) == 0){   
            // si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
                print "<script> alert('La requête n\'a pas abouti !')</script>";
        } 

        $colonne = mysqli_num_fields($resTSEx); //col        
        //$ligne = mysqli_num_rows($resTSEx); //rows

    //    echo "ligne: ".$ligne;
    //    echo ' colonne: '.$colonne;

        // construction du tableau HTML
        echo '<table border=1>
            <!-- impression des titres/entetes de colonnes -->
             <TR>
                <TD><b>Consultant</b></TD>
                <TD><b>Date</b></TD>
                <TD><b>Code mission</b></TD>
                <TD><b>Code Client</b></TD>
                <TD><b>D&eacute;partement</b></TD>
                <TD><b>Heures</b></TD>            
                <TD><b>Description</b></TD>   
                <TD><b>Validation</b></TD>    
                <TD><b>Dépense</b></TD>                                            
                <TD><b>Justificatifs</b></TD>                                            
            </TR>';

        $val = array();
        $linina = 0;
        while($row = mysqli_fetch_array($resTSEx, MYSQLI_BOTH)){               
            for($j=0; $j < $colonne ; $j++){            
                if($j == 0){
                    $val[$linina] = array($row[$j]);
                    if($val[$linina-1][$j] == $val[$linina][$j]){                    
                        //echo '<td>'.$val[$linina][$j].' biiii '.$linina.'</td>';  
                        for($j=0; $j < $colonne ; $j++){                     
                            switch($j){                             
                                case $j > 1 && $j <=8: echo '<td style="border:none"></td>'; 
                                    break;                           
                                case 9: echo '<td>'.$row[$j].'</td>';  
                                    break;
                                case 10: echo '<td>'.$row[$j].'</td>';  
                                    break;
                            }
                        }
                    }
    //                else{
    //                    echo '<td>'.$val[$linina][$j].'</td>';                                    
    //                }                
                }
                else{
                    for($j=1; $j < $colonne ; $j++){
                        switch($j){                             
                            case $j >= 1 && $j <=7: echo '<td>'.$row[$j].'</td>';  
                                break;                           
                            case 8: if($row['Validation']==1){
                                        echo '<td>Validé</td>';  
                                    }
                                    else if($row['Validation']==0){
                                        echo '<td>Non Validé</td>';  
                                    }                                
                                break;
                            case 9: echo '<td>'.$row[$j].'</td>';  
                                break;
                            case 10: echo '<td>'.$row[$j].'</td>';  
                                break;
                        }
                    }
                    
                    //echo '<td>'.$row[$j].'</td>';             
                }            
            }

            echo '</tr>';
            $linina = $linina + 1;        
        }        

        echo '</TABLE>';
        //mysql_close(); 
    }               
