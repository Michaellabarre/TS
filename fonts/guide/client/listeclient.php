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
?>


<html>
    <head>
        <title>Liste des Clients</title>
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">
        <!-- demo stylesheet -->
        <link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../../includes/db_connect.php"

        <!-- helper libraries -->
        <script src="../helpers/jquery-1.9.1.min.js" type="text/javascript"></script>

        <!-- daypilot libraries -->
        <script src="../js/daypilot-all.min.js?v=1783" type="text/javascript"></script>

        <style type="text/css">
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
            
            input[type='submit'] {
            /*width: 100px!important;*/    
            float: right;
            margin-right: 152px;            
            }
            
            table{
                border-collapse: collapse;                   
            }
            #echeance td{
                border: 1.5px solid #D8D8D8;    
                line-height: 150%;
                border-style: dotted;                                    
            }
            
/*            .societe{
                width: 175px;
                width: 130px;
            }
            .code{
                width: 90px;
                text-align: center;
            }
            .adresse{
                width: 250px;
                text-align: center;
            }
            .contact{
                width: 185px;
                text-align: center;
            }
            .tel{
                width: 120px;                
                text-align: center;
            }
            .mobile{
                width: 120px;
                text-align: center;
            }
            .mail{
                width: 200px;
                overflow: no-display;
            }
            .site{
                width: 300px;
                overflow: auto;
            }

            .societe1{                
                width: 50px;
            }
            .code1{
                width: 0px;                
            }
            .adresse1{
                width: 0px;                
            }
            .contact1{
                width: 0px;                
            }
            .tel1{
                width: 0px;                                
            }
            .mobile1{
                width: 0px;                
            }
            .mail1{
                width: 0px;
                overflow: no-display;
            }*/
            
        </style>
	<!-- /head -->
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
                    <center>
                    <h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1> 
                    <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                    
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
                        <a href='../index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='./ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a class='tab selected' href='./listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='./modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>                                        
                        <a href='../consultant/index.php'><span style="width: 100px; text-align:center;">CONSULTANTS</span></a>
                         <ul>
                             <li><a href='../consultant/ajoutconsultexterne.php'><span>Nouveau externe</span></a></li>
                             <li><a href='../consultant/listeconsultant.php'><span>Liste des consultants</span></a></li>                        
                             <li><a href='../consultant/listeconsultexterne.php'><span>Liste Cons. externes</span></a></li>
                             <li><a href='../consultant/listeconsultinterne.php'><span>Liste Cons. internes</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='../ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a href='../ts/listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                    <div>                                        
                        <a class='tab' href='../ts/validts.php'><span style="width: 100px; text-align:center;">VALID TS</span></a>  
                    </div>
                    <div>                                        
                        <a class='tab' href='../alert/index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>                    
                    </div>
                    <div>    
                        <a class='tab' href='../exportation/index.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>LISTE DES CLIENTS</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }            
            else if($prof == 'DAF'){
                ?>
                <nav class="menu">  
                    <div>                                        
                        <a href='../index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>             
                            <li><a class='' href='./ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a class='tab selected' href='./listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='./modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>                    
                    <div>    
                        <a class='tab' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>                                           
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Fiche de Mission</span></a></li> 
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                        </ul>
                    </div>                                        
                    <div>                                        
                        <a class='tab' href='../alert/index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>
                        <ul>
                            <li><a href='../alert/alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a href='../alert/alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../exportation/exportation.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <div>    
                        <a class='tab' href='../ts/vuets.php'><span style="width: 100px; text-align:center;">VUE TS</span></a>                                                         
                    </div> 
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>LISTE DES CLIENTS</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
            else if($prof == 'Assistant(e) Manager'  ){
                ?>
                <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a class='tab selected' href='listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../../guide/mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../../guide/mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../../guide/mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../../guide/mission/missiondept.php'><span>Mission par département</span></a></li>
                            <li><a href='../../guide/mission/missioncloture.php'><span>Missions cloturées</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../../guide/ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='../../guide/ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a href='../../guide/ts/listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                        <div>    
                            <a class='tab' href='../../guide/exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                        <br/><br/><br/>
                        <font style=" color: black"><b><center>LISTE DES CLIENTS</center></b></font>
                        <br/>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    </nav>
                    <!-- /tabs --> 
                <?php
            }
        ?>
                      
        <div id="container" >
            
            
            
                <div>
                    <center>                        
                    <!-- /top -->
<!--                    <div class="note" id="note"><b><font color="red">Notes:</font></b> 
                        <br/>&emsp; Les champs grisés sont obligatoires                                               
                        <br/>&emsp; Le code Client doit contenir 3 à 6 caractères et ne doit être composé que des lettres uniquement.
                    </div>-->                    
                    <!--<div id="dp" style="max-height: 450px;overflow: scroll;">-->
                        <?php                        
                            $liste = 'SELECT NomSociete as "Societé", RefClient as "Code", Adresse, NomContact as Contact, NumeroTel as "Téléphone", NumMobile as Mobile, Mail FROM client ORDER BY NomSociete ASC;';                                
//                            affisazy($liste);
                            $tesita = mysqli_query($connect, $liste) or exit(mysqli_error($connect));        
                            $colonne = mysqli_num_fields($tesita); //col        
                            $ligne = mysqli_num_rows($tesita); //rows  
                            
                        ?>  
                    <div>
                        <!--<table cellspacing="0" cellpadding="0" border="0" max-width="1120px" id="echeance">--> 
<!--                        <table  > 
                            <tr>
                            </tr>-->
                            <table border="1" cellspacing="4" cellpadding="0" style=" border-color: #A9E2F3">
                            <tr>
                                <td>
                                    <!--<table cellspacing="0" cellpadding="0" border="1" width="1100px"  id="echeance">-->                                    
                                    <table cellspacing="0" cellpadding="0" border="1" width="1300px" style=" border-color: blue" id="echeance">
                                        <tr>
                                            <td style="width:145px"><b><center>Société</center></b></td>
                                            <td style="width:74px"><b><center>Code</center></b></td>
                                            <td style="width:230px"><b><center>Adresse</center></b></td>                                    
                                            <td style="width:195px"><center><b>Contact</b></center></td>
                                            <td style="width:88px"><b><center>Téléphone</center></b></td>
                                            <td style="width:121px"><center><b>Mobile</b></center></td>
                                            <td style="width:232px"><center><b>Email</b></center></td>
                                            <!--<td class="site"><center><b>Site Web</b></center></td>-->
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--<div style="width:1120px; height:454px; overflow:auto;">-->
                                    <div style="width:1319px; height:446px; overflow:auto;">
                                    <table cellspacing="0" cellpadding="0" border="1" width="1300px" style=" border-color: blue" id="echeance">
                                        <!--<table cellspacing="0" cellpadding="0" border="0" width="1100px" id="echeance">--> 
                                            <?php
                                            while($row = mysqli_fetch_array($tesita, MYSQLI_BOTH)){
                                                echo '<tr>';
                                                    for($j=0; $j < $colonne ; $j++){
                                                        switch ($j){
                                                            case 0: echo '<td style="max-width:145px;word-wrap: break-word">'.$row[$j].'</td>';
                                                                break;
                                                            case 1: echo '<td style="max-width:74px;word-wrap: break-word">'.$row[$j].'</td>';
                                                                break;                                                                
                                                            case 2: echo '<td style="max-width:230px;word-wrap: break-word">'.$row[$j].'</td>';
                                                                break;
                                                            case 3: echo '<td style="max-width:195px;word-wrap: break-word">'.$row[$j].'</td>';
                                                                break;
                                                            case 4: echo '<td style="max-width:88px;word-wrap: break-word">'.$row[$j].'</td>';
                                                                break;
                                                            case 5: echo '<td style="max-width:121px;word-wrap: break-word">'.$row[$j].'</td>';
                                                                break;
                                                            case 6: echo '<td style="max-width:232px;word-wrap: break-word">'.$row[$j].'</td>';
                                                                break;
//                                                            case 7: echo '<td class="site">'.$row[$j].'</td>';
//                                                                break;
                                                        }
                                                    }
                                                echo '</tr>';
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </td>
                            </tr>                                                                                                                                                                                                                                                                
                        </table>
                    </div>                                                                                                                                                                                                                                                                      
                    <!--</div>-->               
                    <!-- bottom -->
                    </center>
                
            </div>                        
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
	         
        <?php else : ?>
            <p>
                <span>Vous n’avez pas les autorisations n&eacute;cessaires pour acc&eacute;der &agrave; cette page.</span> Please <a href="../../index.php">login</a>.
            </p>
        <?php endif; ?>                     	    
    </body>
</html>

