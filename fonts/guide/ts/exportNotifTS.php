<?php
header ('Content-type:text/html; charset=utf-8');
 require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';
//    require_once '../includes/functions.php';

header ('Content-type:text/html; charset=utf-8');

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
    header("Content-Disposition: attachment; filename=notifTS.xls");
    header("Content-Transfer-Encoding: binary" );
    
    
    

    function changeDate2($date){
        $tab = explode("-", $date);
        $dateChangee = $tab[2]."-".$tab[1]."-".$tab[0];
        return $dateChangee;
    }
    
    if(isset($_GET['daty'])){
        $dateNow = $_GET['daty'];
//        echo 'liliiii '.$dateNow;
        
        
//        echo '<br/><br/>';
                            
//                                $dateNow = date('Y-m-d');
//                                $dateNow = '2015-08-01';
//                                $dateNow = $datyChoisit;                            
                                echo '<b>Date:</b> '.changeDate2($dateNow).'<br>';
                            
                                $date_exp = explode("-", $dateNow);
                                $jour   = $date_exp[2];
                                $mois   = $date_exp[1];
                                $annee  = $date_exp[0];        
                            
                            //    echo '</br>jour: '.$jour;    
                            //    echo '</br>mois: '.$mois;
                            //    echo '</br>annee: '.$annee;
                                
                            //    $volana= mktime(0,0,0,$mois,1,$annee);
                            //    $NombreDeJourDuMois = date("t",$volana);
                            ////    $nombreDeJours = intval(date("t",$mois)); 
                            //    echo '<br/>NombreDeJourDuMois: '.$NombreDeJourDuMois;
                            
//                                if($jour == 01 && $mois<=12 && $mois>1){        
//                                    $mois = $mois;
//                            //        echo '<br>mois2: '.$mois;
//                                    $volana= mktime(0,0,0,$mois,1,$annee);
//                                    $NombreDeJourDuMois = date("t",$volana);           
//                            //        echo '<br/>NombreDeJourDuMois: '.$NombreDeJourDuMois;
//                                    // Détermination du nombre de jour ouvrable en un mois
//                                    $nb_jour = date('t',mktime(0, 0, 0, $mois, 1, $annee));             
//                                    $date1="$annee/$mois/01";
//                                    $date2="$annee/$mois/$NombreDeJourDuMois";     
//                                    $datePde1 = "01";
//                                    $datePde2 = "16";   
//                                    $DateEntree1 = $annee."-".$mois."-".$datePde1;
//                                    $DateEntree2 = $annee."-".$mois."-".$datePde2;
//                                    $DateEntree = " ('$DateEntree1', '$DateEntree2')";
//                            //        echo '</br>DateEntree: '.$DateEntree;
//                                }
                                if($jour >= 1 && $jour <=15){        
                                    // Détermination du nombre de jour ouvrable en quinzaine
                                    $volana= mktime(0,0,0,$mois,1,$annee);
                                    $NombreDeJourDuMois = date("t",$volana);        
                            //        echo '<br/>NombreDeJourDuMois: '.$NombreDeJourDuMois;
                                    $nb_jour = date('t',mktime(0, 0, 0, $mois, 1, $annee));     
                                    $date1="$annee/$mois/01";
                                    $date2="$annee/$mois/15";
                                    $datePde = "01";
                                    $DateEntree = "('".$annee."-".$mois."-".$datePde."')";
                            //        echo '</br>DateEntree: '.$DateEntree;
                                }
//                                else if($jour == 16){
//                                    $volana= mktime(0,0,0,$mois,1,$annee);
//                                    $NombreDeJourDuMois = date("t",$volana);         
//                            //        echo '<br/>NombreDeJourDuMois: '.$NombreDeJourDuMois;
//                                    // Détermination du nombre de jour ouvrable en quinzaine
//                                    $nb_jour = date('t',mktime(0, 0, 0, $mois, 1, $annee));     
//                                    $date1="$annee/$mois/01";
//                                    $date2="$annee/$mois/15";
//                                    $datePde = "01";
//                                    $DateEntree = "('".$annee."-".$mois."-".$datePde."')";
//                            //        echo '</br>DateEntree: '.$DateEntree;
//                                }
                                else if($jour >= 16 && $jour <= 31){        
                                    // Détermination du nombre de jour ouvrable en un mois
                                    $volana= mktime(0,0,0,$mois,1,$annee);
                                    $NombreDeJourDuMois = date("t",$volana);   
                                    $nb_jour = date('t',mktime(0, 0, 0, $mois, 1, $annee));     
                                    $date1="$annee/$mois/01";
                                    $date2="$annee/$mois/$NombreDeJourDuMois";     
                                    $datePde1 = "01";
                                    $datePde2 = "16";   
                                    $DateEntree1 = $annee."-".$mois."-".$datePde1;
                                    $DateEntree2 = $annee."-".$mois."-".$datePde2;
                                    $DateEntree = " ('$DateEntree1', '$DateEntree2')";
                            //        echo '</br>DateEntree: '.$DateEntree;
                                }
                                    
                                //On détermine ainsi la date de départ et de fin
                                $date_depart = strtotime($date1);
                                $date_fin = strtotime($date2);
//                                echo '<br/>date1: '.$date1;
//                                echo '<br/>date2: '.$date2;
                                
                                //nb de jour ouvrable
                                $nb_jours_ouvres = get_nb_open_days($date_depart, $date_fin);
                                echo '<b>Nombre de jour ouvrable:</b> '.$nb_jours_ouvres;
                                
                                //nombre d'heures travaillés
                                $nbH = $nb_jours_ouvres * 8;
                                echo '<br/><b>Heures Max:</b> '.$nbH;
                                echo '<br><br>';
                                    
                                $consultant     = "select RefEmploye as Code FROM employes "
                                        . "where "
                                        . "(RefEmploye REGEXP '^[0-9]' or RefEmploye like 'S%') "
                                        . "and Coddept not in ('ADM', 'ASC', 'DIR', 'OFF', 'QUA', 'RHI') "
                                        . "and actif = 0 "            
                                        . "order by RefEmploye;"; 
                            //    $consultant = "select RefEmploye as Code FROM employes "
                            //            . "where RefEmploye in ('368', '905', '903', '904')";
                                $req_consultant = mysqli_query($connect, $consultant) or exit(mysqli_error($connect));
                                $colonne        = mysqli_num_fields($req_consultant); 
                                $ligne = mysqli_num_rows($req_consultant);
                                
                                echo '<center>';
                                echo '<div style="max-height: 450px;overflow: scroll;  ">';
                                
                                echo '<table border=1>';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<td id="sshh"><b><center>Matricule</center></b></td>';
                                        echo '<td><b><center>Prénom</center></b></td>';
                                        echo '<td><b><center>Nom</center></b></td>';            
                                        echo '<td><b><center>Heures Manquantes</center></b></td>';                        
                                        echo '<td><b><center>Status</center></b></td>';   
                                        echo '<td><b><center>Adresse Email</center></b></td>';      
                                    echo '</tr>';
                                echo '</thead>';    
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
                                            echo '<tbody>';
                                            echo '<tr>';
                                            while($row_tot = mysqli_fetch_array($req_tot, MYSQLI_BOTH)){                    
                                                for($k=0; $k < $colTot ; $k++){   
                            //                        echo '<td>'.$row_tot[$k].'</td>';
                                                    switch ($k) {
                                                        case 0:echo '<td><center>'.$row_tot[$k].'</center></td>';
                                                            break;
                                                        case 1:echo '<td><center>'.$row_tot[$k].'</center></td>';
                                                            break;
                                                        case 2:echo '<td><center>'.$row_tot[$k].'</center></td>';
                                                            break;
                                                        case 3:if($row_tot[$k] < $nbH){                                    
                                                                $emp[] = $row[$j];                                                                             
                                                                echo '<td><center> '.($nbH-$row_tot[$k]).' </center></td>';
                                                                echo '<td><font color="red"><b>Not Completed</b></td>';
                                                                break;
                                                            }
                                                            else if ($row_tot[$k] == $nbH){                                    
                                                                echo '<td><center> '.($nbH-$row_tot[$k]).' </center></td>';
                                                                echo '<td><font color="blue"><b>Completed</b></font></td>';
                                                                break;
                                                            }
                                                            else if($row_tot[$k] > $nbH){                                    
                                                                echo '<td><center><font color="magenta"><b>'.($nbH-$row_tot[$k]).'<b></font></center></td>';
                                                                echo '<td><font color="blue"><b>Completed</b></font></td>';
                                                                break;
                                                            }
                                                        case 4:echo '<td><center>'.$row_tot[$k].'</center></td>';
                                                            break;
                                                        case 5:echo '<td><center>'.$row_tot[$k].'<center></td>';
                                                            break;
                            //                            default :echo '<td>'.$row_tot[$k].'</td>';
                            //                                break;
                                                    }
                                                }                            
                                            }
                                            echo '</tr>';   
                                            echo '<tbody>';
                                        }
                                    }
                                echo '</table> ';
    }
    
    
        
