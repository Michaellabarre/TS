<?php
error_reporting(E_STRICT | E_ALL);
date_default_timezone_set('Etc/UTC');

header ('Content-type:text/html; charset=utf-8');

require_once './includes/db_connect.php';
require_once './includes/fonction.php';
//require_once './variables.php';
require_once './includes/functions.php';
/*************************************/
    //$dateNow = date('Y-m-d');
    $dateNow = '2017-02-28';
        
    echo 'Date: '.$dateNow.'<br>';

    $date_exp = explode("-", $dateNow);
    $jour   = $date_exp[2];
    $mois   = $date_exp[1];
    $annee  = $date_exp[0];
            
   // echo 'mm '.$mm;   
    
//    echo '</br>jour: '.$jour;    
//    echo '</br>mois: '.$mois;
//    echo '</br>annee: '.$annee;
    
//    $volana= mktime(0,0,0,$mois,1,$annee);
//    $NombreDeJourDuMois = date("t",$volana);
////    $nombreDeJours = intval(date("t",$mois)); 
//    echo '<br/>NombreDeJourDuMois: '.$NombreDeJourDuMois;

	//Localisation mois de December
    if($jour == 01 && $mois==1){  
//        $mm = getMonth(str_replace("0", "", $mois-1));
        $mm = 'December';
//        echo 'mm: '.$mm;
        $pde = $mm ." period"; // Champ à recupérer dans email
//        $mois = $mois-01;
        $mois = 12;
        $annee = $annee - 1;
        //echo "annee = "$annee;
//        if($mois<10){
//            $mois = substr_replace("0", $mois, strlen($mois));
//        }
//        echo '<br>mois2: '.$mois;
        $volana= mktime(0,0,0,$mois,1,$annee);  // pour obtenir le timestamp à cette date
        $NombreDeJourDuMois = date("t",$volana);  // pour avoir le nombre de jour dans un mois (dans notre cas c à cette date)
        echo "volana =" .$volana;

			$finDate = $annee."-".$mois."-".$NombreDeJourDuMois;
			$finDate = str_replace("-", "/", dateChange($finDate));	// Champ à recupérer dans email
        
       echo '<br/>NombreDeJourDuMois: '.$NombreDeJourDuMois;
        // Détermination du nombre de jour ouvrable en un mois
        $nb_jour = date('t',mktime(0, 0, 0, $mois, 1, $annee));   
        //date1 et date2 servent pour obtenir le nombre de jour ouvrable dans un mois  
        $date1="$annee/$mois/01"; //début
        $date2="$annee/$mois/$NombreDeJourDuMois"; //fin
        //AFFICHAGE DE LA TRANCHE MENSUELLE 
        $datePde1 = "01";
        $datePde2 = "16";   
        $DateEntree1 = $annee."-".$mois."-".$datePde1;
        $DateEntree2 = $annee."-".$mois."-".$datePde2;
        $DateEntree = " ('$DateEntree1', '$DateEntree2')";
        echo '</br>DateEntree: '.$DateEntree;
    }
    //localisation des mois entre Janvier jusqu'au mois de Novembre
    else if($jour == 01 && $mois<=12 && $mois>1){  
        $mm = getMonth(str_replace("0", "", $mois-1));
        echo 'mm: '.$mm;
        $pde = $mm ." period";
        $mois = $mois-01;
        echo '<br>mois0: '.$mois; // valeur du mois sans 0 devant le chiffre (ex : 6)
        if($mois<10){
            $mois = substr_replace("0", $mois, strlen($mois));
            //$mois = "0".$mois;
            //echo '<br>mois1: '.$mois;
        }
        echo '<br>mois2: '.$mois;
        $volana= mktime(0,0,0,$mois,1,$annee);
        $NombreDeJourDuMois = date("t",$volana);   
        $finDate = $annee."-".$mois."-".$NombreDeJourDuMois;
        $finDate = str_replace("-", "/", dateChange($finDate));
//        echo '<br/>NombreDeJourDuMois: '.$NombreDeJourDuMois;
        // Détermination du nombre de jour ouvrable en un mois
        $nb_jour = date('t',mktime(0, 0, 0, $mois, 1, $annee));     
        $date1="$annee/$mois/01";
        $date2="$annee/$mois/$NombreDeJourDuMois";     
        $datePde1 = "01";
        $datePde2 = "16";   
        $DateEntree1 = $annee."-".$mois."-".$datePde1;
        $DateEntree2 = $annee."-".$mois."-".$datePde2;
        $DateEntree = " ('$DateEntree1', '$DateEntree2')";
        //echo '</br>nb_jour: '.$nb_jour;
        echo '</br>DateEntree: '.$DateEntree;
    }       
    else if($jour == 16){
        $mm = getMonth(str_replace("0", "", $mois));
        $pde = "1st period of " .$mm;
        $volana= mktime(0,0,0,$mois,1,$annee);
        $NombreDeJourDuMois = date("t",$volana);     
        $finDate = $annee."-".$mois."-"."15";
        $finDate = str_replace("-", "/", dateChange($finDate));
//        echo '<br/>NombreDeJourDuMois: '.$NombreDeJourDuMois;
        // Détermination du nombre de jour ouvrable en quinzaine
        $nb_jour = date('t',mktime(0, 0, 0, $mois, 1, $annee));     
        $date1="$annee/$mois/01";
        $date2="$annee/$mois/15";
        $datePde = "01";
        $DateEntree = "('".$annee."-".$mois."-".$datePde."')";
        echo '</br>DateEntree: '.$DateEntree;
    }
    else if($jour >= 16 && $jour <= 31){
        $mm = getMonth(str_replace("0", "", $mois));
        $pde = "2nd period of " .$mm;
        echo "pde = ".$pde."</br>";
        // Détermination du nombre de jour ouvrable en un mois
        $volana= mktime(0,0,0,$mois,1,$annee);
        echo "volana =".$volana;
        $NombreDeJourDuMois = date("t",$volana);
        $finDate = $annee."-".$mois."-".$NombreDeJourDuMois;
        $finDate = str_replace("-", "/", dateChange($finDate));
        $nb_jour = date('t',mktime(0, 0, 0, $mois, 1, $annee));     
        $date1="$annee/$mois/01";
        $date2="$annee/$mois/$NombreDeJourDuMois";     
        $datePde1 = "01";
        $datePde2 = "16";   
        $DateEntree1 = $annee."-".$mois."-".$datePde1;
        $DateEntree2 = $annee."-".$mois."-".$datePde2;
        $DateEntree = " ('$DateEntree1', '$DateEntree2')";
        echo '</br>DateEntree: '.$DateEntree;
    }
        
    //On détermine ainsi la date de départ et de fin
    $date_depart = strtotime($date1);
    $date_fin = strtotime($date2);
    echo '<br/>date1: '.$date1;
    echo '<br/>date2: '.$date2;
    
    //nb de jour ouvrable
    $nb_jours_ouvres = get_nb_open_days($date_depart, $date_fin);
    //var_dump($nb_jours_ouvres);
    echo '<br/>Nombre de jour ouvrable: '.$nb_jours_ouvres;
    
    //nombre d'heures travaillés
    $nbH = $nb_jours_ouvres * 8;
    echo '<br/>Heures Max: '.$nbH;
        
    //requête pour reccupérer le code ou matricule
    $consultant     = "select RefEmploye as Code FROM employes "
            . "where "
            . "(RefEmploye REGEXP '^[0-9]' or RefEmploye like 'S%') "
            . "and Coddept not in ('ADM', 'ASC', 'DIR') "
            . "and actif = '0' "
            . "and RefEmploye not in ('900', '129', '265') "            
            . "order by RefEmploye;"; 
        
    //        . "where RefEmploye in ('368', '900', 'test3')";
    $req_consultant = mysqli_query($connect, $consultant) or exit(mysqli_error($connect));
    $colonne        = mysqli_num_fields($req_consultant); 
    $ligne = mysqli_num_rows($req_consultant);
    
//        echo '<br/>colonne: '.$colonne;
//        echo '<br/>ligne: '.$ligne;

    echo '<br/><div class="tableau"><center>';
    echo '<table border="1">';
    
        echo '<tr>';
            echo '<td><b>Numéro Matricule</b></td>';
            echo '<td><b>Prénom</b></td>';
            echo '<td><b>Nom</b></td>';            
            echo '<td><b>Heure Totale travaillée</b></td>';            
            echo '<td><b>Status</b></td>';   
            echo '<td><b>Email</b></td>'; 
        echo '</tr>';
        
//        $emp = array();

        while($row = mysqli_fetch_array($req_consultant, MYSQLI_BOTH)){
            for($j=0; $j < $colonne ; $j++){                                                
                $tot_heure = 'select employes.RefEmploye as emp, employes.Prenom, employes.NomFamille, sum(HeureFacturables) as somy, Adresse '
                        . 'from heuresfichepointage '
                        . 'inner join fichepointage on (heuresfichepointage.RefFichePointage = fichepointage.RefFichePointage) '
                        . 'inner join employes on (employes.RefEmploye = fichepointage.RefEmploye) '
                        . 'where fichepointage.RefEmploye = "'.$row[$j].'" '
                        . 'and fichepointage.DateEntree in '.$DateEntree.';';
                $req_tot = mysqli_query($connect, $tot_heure) or exit(mysqli_error($connect));
                $colTot  = mysqli_num_fields($req_tot); //col                 
                                                                                    
                echo '<tr>';
                while($row_tot = mysqli_fetch_array($req_tot, MYSQLI_BOTH)){                    
                    for($k=0; $k < $colTot ; $k++){   
//                        echo '<td>'.$row_tot[$k].'</td>';
                        switch ($k) {
//                            case 0:echo '<td>'.$row_tot[$k].'</td>';
//                                break;
//                            case 1:echo '<td>'.$row_tot[$k].'</td>';
//                                break;
//                            case 2:echo '<td>'.$row_tot[$k].'</td>';
//                                break;
                            case 3:if($row_tot[$k] < $nbH){                                    
                                    $emp[] = $row[$j];  // pour obtenir la matricule = Code                                                                           
                                    echo '<td>'.$row_tot[$k].'</td>';
                                    echo '<td><font color="red"><b>Not Completed</b></td>';
                                    break;
                                }
                                else{
                                    echo '<td>'.$row_tot[$k].'</td>';
                                    echo '<td><font color="blue"><b>Completed</b></td>';
                                    break;
                                }
                            default :echo '<td>'.$row_tot[$k].'</td>';
                                break;
                        }
                    }                            
                }
                echo '</tr>';                    
            }
        }
    echo '</table> ';
    echo '</center></div>';
    
    $emp = implode("', '", $emp);     
    $emp = "'".$emp."'";
    echo 'emp: '.$emp.'<br/>'; 
    
    /*************************************************************/
    
    echo 'periode '.$pde;
    
    tsmail($emp, $pde, $finDate); 
