﻿<!DOCTYPE html>

<?php
    header ('Content-type:text/html; charset=utf-8');
    require_once '../includes/db_connect.php';
    require_once '../includes/fonction.php';
    require_once '../includes/functions.php';
    include 'nbOnline.php';
    
    sec_session_start();
        
    ini_set('display_errors', 0);    
    ini_set('log_errors', 1);    
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');    
//    error_reporting(e_all);
    
?>

<html>
    <head>
        <title>Acceuil</title>
        <!-- demo stylesheet -->
        <link rel="shortcut icon" href="../logo/fthm.ico" type="image/x-icon" />
        <link type="text/css" rel="stylesheet" href="helpers/demo.css?v=1783" />

        <!-- helper libraries -->
        <script src="helpers/jquery-1.9.1.min.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="helpers/media/layout.css?v=1783" />    
        <link type="text/css" rel="stylesheet" href="helpers/media/elements.css?v=1783" />  
        <style>
/*            #dodo{
                float: left;
                margin-top: 290px;
                margin-left: 300px;
            }            
            #what{
                float: right;
                margin-top: 200px;
                margin-right: 300px;
            }
            
            #gu{
                margin-top: 100px;                
            }*/
            
            #deco{
                float: right;
            }
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
        </style>
    </head>
    <body>
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
                
                $reqRefEmploye = 'select RefEmploye as EMPLO, Coddept from employes where Nomuser = "'.$Nomuser.'"';                    
                $rekRefEmp     = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                $resultRefEmp  = mysqli_fetch_assoc($rekRefEmp);
                $refEmploye    = $resultRefEmp['EMPLO'];                                                    
                
            ?>
            
            <div class="bg-help">
                <div class="inBox">
                    <center>
                    <h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1> 
                    <a href="../logout.php" id="deco"><font style=" color: "><img src="../images/deconnexion.png" title="Deconnexion"></font></a>
                    <hr class="hidden" />
                    </center>
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
                    if($prof == 'Associé' or $prof == 'Manager'){
                ?>
                <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a class='tab selected' href='index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='./client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='./client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='./client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='./client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>                                        
                        <a href='./consultant/index.php'><span style="width: 100px; text-align:center;">CONSULTANTS</span></a>
                         <ul>
                             <li><a href='./consultant/ajoutconsultexterne.php'><span>Nouveau externe</span></a></li>
                             <li><a href='./consultant/listeconsultant.php'><span>Liste des consultants</span></a></li>                        
                             <li><a href='./consultant/listeconsultexterne.php'><span>Liste Cons. externes</span></a></li>
                             <li><a href='./consultant/listeconsultinterne.php'><span>Liste Cons. internes</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='./mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='./mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='./mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='./mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='./mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='./ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='./ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a href='./ts/listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                    <div>                                        
                        <a class='tab' href='./ts/validts.php'><span style="width: 100px; text-align:center;">VALID TS</span></a>  
                    </div>
                    <div>                                        
                        <a class='tab' href='./alert/index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>
                        <ul>
                            <li><a href='./alert/alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a href='./alert/alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='./exportation/index.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>       
                        <br/><br/><br/>
                        <!--<font style=" color: black"><b><center>GUIDE UTILISATEUR</center></b></font>-->
                        <br/>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    </nav>
                    <!-- /tabs --> 
                <?php
            }
            else if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Collaborateur' or $prof == 'Superviseur' or $prof == 'Collaboratrice'){
                ?>                
                    <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a class='tab selected' href='index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>    
                        <a class='tab' href='./mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='./mission/missioncode.php'><span>Fiche de Mission</span></a></li>                        
                            <li><a href='./mission/missiondept.php'><span>Mission par département</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='./ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='./ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a href='./ts/listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                        <div>    
                            <a class='tab' href='../guide/exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>     
                    <br/><br/><br/>
                    <!--<font style=" color: black"><b><center>GUIDE UTILISATEUR</center></b></font>-->
                    <br/>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    </nav>
                    <!-- /tabs -->                
                <?php
            }
            else if($prof == 'DAF'){
                ?>                    
                <nav class="menu">  
                    <div>                                        
                        <a class='tab selected' href='index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='./client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>           
                            <li><a class='' href='./client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='./client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='./client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>                    
                    <div>    
                        <a class='tab' href='./mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>                                           
                            <li><a href='./mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='./mission/missioncode.php'><span>Fiche de Mission</span></a></li> 
                            <li><a href='./mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='./mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                        </ul>
                    </div>                                        
                    <div>                                        
                        <a class='tab' href='./alert/index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>
                        <ul>
                            <li><a href='./alert/alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a href='./alert/alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='./exportation/exportation.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <div>    
                        <a class='tab' href='./ts/vuets.php'><span style="width: 100px; text-align:center;">VUE TS</span></a>                                                         
                    </div> 
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <!--<font style=" color: black"><b><center>GUIDE UTILISATEUR</center></b></font>-->
                    <br/>
                    </nav>
                <?php
            }
            else if($prof == 'Assistant(e) Manager'  ){
                ?>
                <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a class='tab selected' href='index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='./client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='./client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='./client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='./client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='./mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../guide/mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../guide/mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../guide/mission/missiondept.php'><span>Mission par département</span></a></li>
                            <li><a href='../guide/mission/missioncloture.php'><span>Missions cloturées</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='./ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='../guide/ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a href='../guide/ts/listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                        <div>    
                            <a class='tab' href='../guide/exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                        <br/><br/><br/>
                        <!--<font style=" color: black"><b><center>GUIDE UTILISATEUR</center></b></font>-->
                        <br/>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    </nav>
                    <!-- /tabs --> 
                <?php
            }
            else if($prof == 'Administrateur'){
                ?>
                <nav class="menu">  
                    <div>                                        
                        <a class='tab selected' href='index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>                                        
                    <div>                                        
                        <a href='./consultant/index.php'><span style="width: 100px; text-align:center;">CONSULTANTS</span></a>
                         <ul>
                             <li><a href='./consultant/ajoutconsultexterne.php'><span>Nouveau cons. externe</span></a></li>
                             <li><a href='./consultant/ajoutconsultinterne.php'><span>Nouveau cons. interne </span></a></li>
                             <li><a href='./consultant/modifierconsult.php'><span>Modifier un consultant </span></a></li> 
                             <li><a href='./consultant/listeconsultant.php'><span>Liste des consultants</span></a></li> 
                        </ul>
                    </div>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    </nav>
                <?php
            }
            ?>

            <div id="container" >                
                <!--<div id="content">-->
                    <div>                
                        <!-- bottom -->                            
                        <?php
                            if($refEmploye == '368'){
                                
                            }
                        ?>
                        <center>
                        <?php
                        if($refEmploye == '368'){                                                        
                            ?>                            
                            <object data="dodo.png" type="image/png" title="dodo" id="dodo" style=" margin-top: 290px;float: left;margin-left: 300px"></object>
                            <a href='Guide.pdf' target="_blank"><object data="gu.png" type="image/png" title="Guide Utilisateur" id="gu" style=" margin-top: 100px;"></object></a>
                            <?php
                        }
                        
                        if($refEmploye != '368'){
                        ?>                                                    
                            <a href='Guide.pdf' target="_blank"><object data="gu.png" type="image/png" title="Guide Utilisateur" id="gu" style=" margin-top: 150px"></object></a>
                            <!--<object data="Guide.pdf" type="application/pdf" title="guide" width="8000px" height="8800px"></object>-->
                            <!--<embed src="Guide.pdf" width="650px" height="500px">-->                                                                                                                                        
                        <?php
                        }
                        
                        if($refEmploye == '368'){
                            $sql = 'SELECT count(*) FROM nb_online';
                                $req = mysqli_query($connect, $sql) or exit(mysqli_error($connect));
                                $data = mysqli_fetch_array($req, MYSQL_BOTH);
    //                            mysql_free_result($req);
                                echo '' , $data[0] , ' personne(s).';
                            ?>
                            <object data="what.png" type="image/png" title="dodo" id="what" style=" margin-top: 200px;float: right;margin-right: 300px"></object>                            
                            <?php                                                        
                        }
                        ?>
                        </center>
                    </div>
                <!--</div>-->
            </div>
        </div>
        
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
                <span>Vous n’avez pas les autorisations n&eacute;cessaires pour acc&eacute;der &agrave; cette page.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>    
    </body>
</html>
