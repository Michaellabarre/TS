<!DOCTYPE html>

<?php
    header ('Content-type:text/html; charset=utf-8');
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';
    
    sec_session_start();
        
    ini_set('display_errors', 0);    
    ini_set('log_errors', 1);    
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');    
//    error_reporting(e_all);   
    
    

    function changeDate($date){
        $tab = explode("-", $date);
        $dateChangee = $tab[2]."-".$tab[0]."-".$tab[1];
        return $dateChangee;
    }
    
    function changeDate2($date){
        $tab = explode("-", $date);
        $dateChangee = $tab[2]."-".$tab[1]."-".$tab[0];
        return $dateChangee;
    }
?>


<html>
    <head>
        <title>Vue TS</title>
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">
        <!-- demo stylesheet -->
        <link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../../includes/db_connect.php" />
        <script type="text/javascript" src="../../jquery/jquery.js"></script>
        <script src="../../jquery/jquery-1.8.1.min.js" type="text/javascript"></script>
        <script src="../../jquery/jquery-ui-1.11.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="../../jquery/jquery-ui-1.11.2/jquery-ui.css" />

        <!-- helper libraries -->
          
	<!-- /head -->
        <style>
            .menu:after{
                content: "";
                display: block;
                clear  : both;
            }
            .menu div:first-child{
                border-top-left-radius: 8px;
                border-bottom-left-radius: 8px;
            }
            .menu div:last-child{
                border-top-right-radius: 8px;
                border-bottom-right-radius: 8px; 
            }
            .menu div{
                position: relative;
                float: left;
                padding: 8px;
                background-color: #bbbbbb;
                background: linear-gradient(to bottom, #dddddd, #bbbbbb);
            }
            .menu div ul{
                position: absolute;
                left: 0;
                /*display: none;*/
                
                height: 0;
                padding: 0px;
                overflow: hidden;
                transition: height 0.5s;
                
                z-index: 7;
                margin-left: 0;
                background-color: #cccccc;
            }
            .menu div:hover ul{
                /*display: block;*/
                height: 155px;
            }
            .menu li{
                list-style: none;
                margin: 0 8px 0 8px;
            }
            .menu li:first-child{
                margin-top: 8px;
            }
            .menu li:last-child{
                margin-bottom: 8px;
            }                                    
            
            #notifTS{
                float: right;
                margin-right: 100px;
            }
            
            .ui-datepicker-current-day .ui-state-active { background: red; }
            
             
        </style>
    </head>
    <body>

  <!-- top -->
    <?php if (login_check($mysqli) == true) : ?>
        <div id="header">            
            
            <?php
                $Nomuser      = $_SESSION['username'];                                
                $reky         = 'select Prenom as prenom, NomFamille as nom from employes '
                    . 'where Nomuser = "'.$Nomuser.'"';
                $rekPrenom    = mysqli_query($connect,$reky);
                $resultPrenom = mysqli_fetch_assoc($rekPrenom);
                $prenom       = $resultPrenom['prenom'];
                $nom          = $resultPrenom['nom'];
            ?>
            
            <div class="bg-help">
                <div class="inBox">
                    <h1 id="logo"><?php echo '<center><b><i>'.$prenom.' '.$nom.'</i></b></center>'; ?></h1> 
                    <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                    
                    <hr class="hidden" />
                </div>
            </div>
        </div>   
        
        <?php
            $req     = 'select Profil as profily from employes '
                . 'where Nomuser = "'.$Nomuser.'"';
            $rekProf = mysqli_query($connect,$req);
            $resultProf = mysqli_fetch_assoc($rekProf);
            $prof = $resultProf['profily'];
        ?>

    <div id="main">
        <?php
            if($prof == 'DAF'){
                ?>
                <nav class="menu">  
                    <div>                                        
                        <a href='../index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='../client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>                           
                            <li><a href='../client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='../client/modifclientcode.php'><span>Détails Client</span></a></li>                            
                        </ul>
                    </div>                    
                    <div>    
                        <a href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Fiche de Mission</span></a></li> 
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                        </ul>
                    </div>                                        
                    <div>                                        
                        <a href='../alert/index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>
                        <ul>
                            <li><a href='../alert/alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a href='../alert/alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a href='../exportation/exportation.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <div>    
                        <a class='tab selected' class='tab' href='./vuets.php'><span style="width: 100px; text-align:center;">VUE TS</span></a>                                                         
                    </div> 
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>VUE SUR LE TIME SHEET DES CONSULTANTS</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
            
        ?>
                      
        <div id="container" >
                                    
                <div>
                    
                    <!-- /top -->                    
                    <div id="dp">   
                        <form method="POST"> 
                            <input id="daty" name="daty" type="text" style="width:175px;text-align: center" placeholder="Sélectionner  la date"/>                                                        
                            <input type="submit" name="mois" value="Selectionner" />
                        </form>
                        
                       <?php
                       
                       if(isset($_POST['mois'])){                                                      
                           $datyChoisit = $_POST['daty'];                           
                           $datyChoisit = changeDate(str_replace("/", "-", $datyChoisit));
//                           $datyChoisit = 
//                           echo 'daty choisit: '.$datyChoisit;
                           if($datyChoisit == '--'){                               
                               echo '<font color="red"><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Veuillez choisir une date.</font>';	
                           }
                           else{
                           
                           ?>
                            <form action="exportNotifTS.php?daty= <?php echo $datyChoisit; ?> " method="POST">
                                <!--<td><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';-->
                                <input type="submit" name="notifTS" id="notifTS" value="Export To Excel" />        
                            </form> 
                           <?php
                           
                            /***********************VUE TS**********************************/   
                            echo '<br/><br/>';
                            
//                                $dateNow = date('Y-m-d');
//                                $dateNow = '2015-08-01';
                                $dateNow = $datyChoisit;                            
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
                                        . "and Coddept not in ('ADM', 'ASC', 'DIR') "
                                        . "and actif = 0 "
                                        . "and RefEmploye not in ('900', '129', '265')"            
                                        . "order by RefEmploye;"; 
                                
//                                . "and Coddept not in ('ADM', 'ASC', 'DIR', 'OFF', 'QUA', 'RHI') "
                            //    $consultant = "select RefEmploye as Code FROM employes "
                            //            . "where RefEmploye in ('368', '905', '903', '904')";
                                $req_consultant = mysqli_query($connect, $consultant) or exit(mysqli_error($connect));
                                $colonne        = mysqli_num_fields($req_consultant); 
                                $ligne = mysqli_num_rows($req_consultant);
                                
                                echo '<center>';
                                echo '<div style="max-height: 400px;overflow: scroll;  ">';
                                
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
                                
                                echo '</div>';
                                echo '</center>';
                                
                                $emp = implode("', '", $emp);     
                                $emp = "'".$emp."'";
                            //    echo 'emp: '.$emp.'<br/>'; 

                            /***********************VUE TS**********************************/  
                        }
                       }
?>
                         
                    </div>               
                    <!-- bottom -->
                </div>
            
        </div>
    </div>
  
    <script>
        $(document).ready(function(){                        
            $("#daty").datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
//                format: "yyyy-mm-dd",
                //daysOfWeekDisabled: [0, 6],
                todayHighlight: true,
                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                firstDay: 1,
                monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                changeMonth: true,
                changeYear: true
                //endDate: 'today'                            
            }); 
        }); 
    </script>
<!--    <script type="text/javascript">
        $(document).ready(function() {
          var url = window.location.href;
          var filename = url.substring(url.lastIndexOf('/')+1);
          if (filename === "") filename = "index.html";
          $(".menu a[href='" + filename + "']").addClass("selected");
        });
    </script>-->
	<!-- /bottom -->
        
            <?php else : ?>
            <p>
                <span>Vous n’avez pas les autorisations n&eacute;cessaires pour acc&eacute;der &agrave; cette page.</span> Please <a href="../../index.php">login</a>.
            </p>
        <?php endif; ?>  
    </body>
</html>

