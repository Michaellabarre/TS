﻿<!DOCTYPE html>

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
        <title>Mission par département</title>
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
	<!-- /head -->
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
        
            .def{
                text-align: left;
            }
            
            .fed{
/*                text-align: center;*/
            }
            
            #export{
                float: right;
                margin-right: 25px;
            }
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
                        <a href='../client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='../client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='../client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='../client/modifclientcode.php'><span>Modification Client</span></a></li>                            
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
                        <a class='tab selected' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a class='tab selected' href='../mission/missiondept.php'><span>Mission par département</span></a></li>
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
                    <font style=" color: black"><b><center>FILTRE DES MISSIONS PAR DÉPARTEMENT</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }
            else if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Collaborateur' or $prof == 'Superviseur' or $prof == 'Collaboratrice'){
                ?>
                <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>    
                        <a class='tab selected' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='./missioncode.php'><span>Fiche de Mission</span></a></li>                        
                            <li><a class='tab selected' href='./missiondept.php'><span>Mission par département</span></a></li>
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
                            <a class='tab' href='../exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>FILTRE DES MISSIONS PAR DÉPARTEMENT</center></b></font>
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
                        <a href='../client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>          
                            <li><a class='' href='../client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='../client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='../client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>                    
                    <div>    
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>                      
                            <li><a href='./nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='./missioncode.php'><span>Fiche de Mission</span></a></li> 
                            <li><a class='tab selected' href='./missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='./missioncloture.php'><span>Missions cloturées</span></a></li>-->
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
                    <font style=" color: black"><b><center>FILTRE DES MISSIONS PAR DÉPARTEMENT</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
            else if($prof == 'Assistant(e) Manager'  ){
                ?>
                <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='./client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='../client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='../client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='../client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>    
                        <a class='tab selected' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='./nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='./missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a class='tab selected' href='./missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='./missioncloture.php'><span>Missions cloturées</span></a></li>-->
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
                        <a class='tab' href='../exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>FILTRE DES MISSIONS PAR DÉPARTEMENT</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }            
        ?>
                      
        <div id="container" >            
            
           
                    <!-- /top -->                    
                    <div id="dp">  
                        <center>
                        <table border="1" style=" border-color: #3399ff">
                            <tr>
                                <td>
                                    <ul>
                                    <table>
                                        <tr><b>Missions en cours</b></tr>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <form name="missionDept" method="post">	                                                        
                                                        <label for="code_dept"></label>							
                                                        <select name="code_dept" id="code_dept">									
                                                            <!--<option>Sélectionnez le département</option>-->
                                                            <option value="" disabled="" selected style="display:none">Sélectionnez le département</option>
                                                            <?php
                                                                $reqDept = mysqli_query($connect,'select Departement from departement '                                        
                                                                    . 'order by Departement ASC;');
                                                                while($r = mysqli_fetch_array($reqDept, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                                                }
                                                            ?>																																		
                                                        </select>                                                        
                                                        <input type="submit" name="selectionner1" value="Selectionner" />
                                                    </form>
                                                </ul>
                                            </td>
                                        </tr>                                        
                                    </table>
                                    </ul>
                                </td>                                
                                <td>     
                                    <ul>
                                    <table>
                                        <tr><b>Missions cloturées</b></tr>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <form name="missionDept" method="post">	                                                        
                                                        <label for="code_dept"></label>							
                                                        <select name="code_dept" id="code_dept">									
                                                            <!--<option>Sélectionnez le département</option>-->
                                                            <option value="" disabled="" selected style="display:none">Sélectionnez le département</option>
                                                            <option>TOUTES LES MISSIONS</option>
                                                            <?php
                                                                $reqDept = mysqli_query($connect,'select Departement from departement '                                        
                                                                    . 'order by Departement ASC;');
                                                                while($r = mysqli_fetch_array($reqDept, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                                                }
                                                            ?>																																		
                                                        </select>                                                        
                                                        <input type="submit" name="selectionner2" value="Selectionner" />
                                                    </form>
                                                </ul>
                                            </td>
                                        </tr>                                        
                                    </table>
                                    </ul>
                                </td>
                                <td>     
                                    <ul>
                                    <table>
                                        <tr><b>Toutes les missions</b></tr>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <form name="missionDept" method="post">	                                                        
                                                        <label for="code_dept"></label>							
                                                        <select name="code_dept" id="code_dept">									
                                                            <!--<option>Sélectionnez le département</option>-->
                                                            <option value="" disabled="" selected style="display:none">Sélectionnez le département</option>
                                                            <?php
                                                                $reqDept = mysqli_query($connect,'select Departement from departement '                                        
                                                                    . 'order by Departement ASC;');
                                                                while($r = mysqli_fetch_array($reqDept, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                                                }
                                                            ?>																																		
                                                        </select>                                                        
                                                        <input type="submit" name="selectionner3" value="Selectionner" />
                                                    </form>
                                                </ul>
                                            </td>
                                        </tr>                                        
                                    </table>
                                    </ul>
                                </td>
                            </tr>                            
                        </table> 
                        
                        <?php
                        if(isset($_POST['selectionner1']) || isset($_POST['selectionner2']) || isset($_POST['selectionner3'])){
                            if($_POST['code_dept'] == ''){						
                                    echo '<font color="red"><br/>Veuillez s&eacute;lectionner un département.</font>';
                            }
                            else{
                                $dept   = $_POST['code_dept'];
                                $reqCodeDept = 'select Coddept as code from departement '
                                        . 'where Departement = "'.$dept.'"';
                                $reqCD       = mysqli_query($connect, $reqCodeDept);
                                $resultCD    = mysqli_fetch_assoc($reqCD);
                                $codeDept    = $resultCD['code'];                                                
                                
                                if(isset($_POST['selectionner1'])){
                                    
                                    if($prof == 'DAF'){
                                        $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
                                        from deptprojet D
                                        inner join projets P on (P.RefProjet = D.RefProjet)
                                        inner join client C on (C.RefClient = P.RefClient)
                                        where D.Coddept = "'.$codeDept.'"
                                        and P.cloture <> "1"
                                        order by D.RefProjet, C.NomSociete ;';
                                    }
                                    else{
                                        $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
                                        from deptprojet D
                                        inner join projets P on (P.RefProjet = D.RefProjet)
                                        inner join client C on (C.RefClient = P.RefClient)
                                        where D.Coddept = "'.$codeDept.'"
                                        and P.TypeProjet not in ("EXTRA")
                                        and P.cloture <> "1"
                                        order by D.RefProjet, C.NomSociete;';
                                    }                                                                        
                                    
//                                    $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
//                                        from deptprojet D
//                                        inner join projets P on (P.RefProjet = D.RefProjet)
//                                        inner join client C on (C.RefClient = P.RefClient)
//                                        where D.Coddept = "'.$codeDept.'"
//                                        and P.cloture <> "1"
//                                        order by D.RefProjet, C.NomSociete ;';
                                    $reqM       = mysqli_query($connect, $reqMission);// or exit(mysqli_error($connect));                                                
                                    $colonne    = mysqli_num_fields($reqM);
                                    $ligne      = mysqli_num_rows($reqM);                                    
                                }
                                else if(isset($_POST['selectionner2'])){
                                    if($_POST['code_dept'] == 'TOUTES LES MISSIONS'){
                                        if($prof == 'DAF'){
                                            $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
                                            from deptprojet D
                                            inner join projets P on (P.RefProjet = D.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where P.cloture in ("1")                                         
                                            order by D.Coddept, D.RefProjet, C.NomSociete, P.NomProjet ;'; 
                                        }
                                        else{
                                            $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
                                            from deptprojet D
                                            inner join projets P on (P.RefProjet = D.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where P.cloture in ("1")
                                            and P.TypeProjet not in ("EXTRA")
                                            order by D.Coddept, D.RefProjet, C.NomSociete, P.NomProjet ;';
                                        }
                                        
                                        
//                                        echo 'lala';
//                                        $reqMissionCode = mysqli_query($connect,'select RefProjet, RefClient, NomProjet from projets where cloture in ("1") '                            
//                                            . 'order by RefProjet ASC;');
//                                        $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
//                                        from deptprojet D
//                                        inner join projets P on (P.RefProjet = D.RefProjet)
//                                        inner join client C on (C.RefClient = P.RefClient)
//                                        where P.cloture in ("1")                                         
//                                        order by D.Coddept, D.RefProjet, C.NomSociete, P.NomProjet ;'; 
                                        $reqM       = mysqli_query($connect, $reqMission);// or exit(mysqli_error($connect));                                                
                                        $colonne    = mysqli_num_fields($reqM);
                                        $ligne      = mysqli_num_rows($reqM);
                                    }
                                    else{
                                        if($prof == 'DAF'){
                                            $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
                                            from deptprojet D
                                            inner join projets P on (P.RefProjet = D.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where D.Coddept = "'.$codeDept.'"
                                            and P.cloture = "1"
                                            order by D.Coddept, D.RefProjet, C.NomSociete, P.NomProjet ;';
                                        }
                                        else{
                                            $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
                                            from deptprojet D
                                            inner join projets P on (P.RefProjet = D.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where D.Coddept = "'.$codeDept.'"
                                            and P.cloture = "1"
                                            and P.TypeProjet not in ("EXTRA")
                                            order by D.Coddept, D.RefProjet, C.NomSociete, P.NomProjet ;';
                                        }
                                        
//                                        $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
//                                            from deptprojet D
//                                            inner join projets P on (P.RefProjet = D.RefProjet)
//                                            inner join client C on (C.RefClient = P.RefClient)
//                                            where D.Coddept = "'.$codeDept.'"
//                                            and P.cloture = "1"
//                                            order by D.Coddept, D.RefProjet, C.NomSociete, P.NomProjet ;';
                                        $reqM       = mysqli_query($connect, $reqMission);// or exit(mysqli_error($connect));                                                
                                        $colonne    = mysqli_num_fields($reqM);
                                        $ligne      = mysqli_num_rows($reqM); 
                                    }
                                }
                                else if(isset($_POST['selectionner3'])){
                                    if($prof == 'DAF'){
                                        $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
                                        from deptprojet D
                                        inner join projets P on (P.RefProjet = D.RefProjet)
                                        inner join client C on (C.RefClient = P.RefClient)
                                        where D.Coddept = "'.$codeDept.'"
                                        order by D.Coddept, D.RefProjet, C.NomSociete, P.NomProjet ;';
                                    }
                                    else{
                                        $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
                                        from deptprojet D
                                        inner join projets P on (P.RefProjet = D.RefProjet)
                                        inner join client C on (C.RefClient = P.RefClient)
                                        where D.Coddept = "'.$codeDept.'"
                                        and P.TypeProjet not in ("EXTRA")
                                        order by D.Coddept, D.RefProjet, C.NomSociete, P.NomProjet ;';
                                    }
//                                    $reqMission = 'select D.Coddept as dept, C.NomSociete as Client, D.RefProjet as codeProjet, P.NomProjet nomProjet 
//                                        from deptprojet D
//                                        inner join projets P on (P.RefProjet = D.RefProjet)
//                                        inner join client C on (C.RefClient = P.RefClient)
//                                        where D.Coddept = "'.$codeDept.'"
//                                        order by D.Coddept, D.RefProjet, C.NomSociete, P.NomProjet ;';
                                        $reqM       = mysqli_query($connect, $reqMission);// or exit(mysqli_error($connect));                                                
                                        $colonne    = mysqli_num_fields($reqM);
                                        $ligne      = mysqli_num_rows($reqM);
                                }
                                
                                if($ligne == 0){
                                    if(isset($_POST['selectionner1'])){
                                        echo '<br/><font color="red"><center>Le département '.$dept.' n\'a aucune mission en cours.</center></font>';
                                    }
                                    else if(isset($_POST['selectionner2']) && $_POST['code_dept'] != 'TOUTES LES MISSIONS'){
                                        echo '<br/><font color="red"><center>Aucune mission cloturée dans le departement '.$dept.'</center></font>';
                                    }
                                    else if(isset($_POST['selectionner3'])){
                                        echo '<br/><font color="red"><center>Le departement '.$dept.' n\'a eu aucune mission</center></font>';
                                    }
                                }
                                else{
                                    if(isset($_POST['selectionner1'])){
                                        echo '<br/><font color="gray"><center>MISSION EN COURS DU DEPARTEMENT '.$dept.'</center></font>';
                                    }
                                    else if(isset($_POST['selectionner2'])){
                                        if($_POST['code_dept'] == 'TOUTES LES MISSIONS'){
                                            echo '<br/><font color="gray"><center>MISSION CLOTUREES DE TOUS LES DEPARTEMENTS </center></font>';
                                        }
                                        else{
                                            echo '<br/><font color="gray"><center>MISSION CLOTUREES DU DEPARTEMENT '.$dept.'</center></font>';
                                        }                                        
                                    }
                                    else if(isset($_POST['selectionner3'])){
                                        echo '<br/><font color="gray"><center>TOUTES LES MISSION DU DEPARTEMENT '.$dept.'</center></font>';
                                    }
                                ?>                                                                         
                                
                                <div style="max-height: 400px;overflow: scroll; top: 500px; ">
                                    <!--<a id="export" href="./exportMission.php" />Export sous Excel</a>-->        
                                    <table>
                                        <thead>
                                            <tr>
                                                <td><center><b>Département</b></center></td>
                                                <td><center><b>Code Projet</b></center></td>
                                                <td><center><b>Code Client</b></center></td>                                                
                                                <td><center><b>Nom Projet</b></center></td>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <br/><br/>
                                                <?php 
                                                $ligne = 0;
                                                $valDept = array();
                                                while($result = mysqli_fetch_object($reqM)){                                                                                                        
                                                    
                                                    $ligne = $ligne + 1;
//                                                    echo ' ligne '.$ligne;
                                                    
                                                    if($ligne == 1){
                                                        $valDept[$ligne] = $result->dept;
//                                                        echo 'dept 1 '.$valDept[$ligne];
                                                        echo(
                                                            '<tr>'                                                                                                
                                                                . '<td><font style=" color: #5858FA"><b>'.$result->dept.'</b></font></td>');
                                                        echo '<td class="def"><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';                                                                                                                                                                
                                                        echo('<td class="fed">'.$result->Client.'</td>'
                                                        );                                                                                                                                                            
                                                        echo(
                                                            '<td class="fed">'.$result->nomProjet.'</td>'                                                            
                                                            . '</tr>'                                    
                                                        ) ;
                                                    }
                                                    else if($ligne > 1){
                                                        $valDept[$ligne] = $result->dept;
                                                        $valDeptFarany = $valDept[$ligne-1];
//                                                        echo ' haha '.$valDept[$ligne] .' hihi '.$valDeptFarany;
                                                        
                                                        if($valDept[$ligne] != $valDeptFarany){                                                            
//                                                            echo ' niova';
                                                            echo(
                                                                '<tr>'                                                                                                
                                                                    . '<td><hr><font style=" color: #5858FA"><b>'.$result->dept.'<b></font></td>');
                                                            echo '<td class="def"><hr><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';                                                                                                                                                                
                                                            echo('<td class="fed"><hr>'.$result->Client.'</td>'
                                                            );                                                                                                                                                            
                                                            echo(
                                                                '<td class="fed"><hr>'.$result->nomProjet.'</td>'                                                            
                                                                . '</tr>'                                    
                                                            ) ;                                                            
                                                        }
                                                        else{
                                                           echo(
                                                                '<tr>'                                                                                                
                                                                    . '<td>'.$result->dept.'</td>');
                                                            echo '<td class="def"><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';                                                                                                                                                                
                                                            echo('<td class="fed">'.$result->Client.'</td>'
                                                            );                                                                                                                                                            
                                                            echo(
                                                                '<td class="fed">'.$result->nomProjet.'</td>'                                                            
                                                                . '</tr>'                                    
                                                            ) ; 
                                                        }
                                                    }                                                                                                                                                            
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php 
                                }
                            }
                        }
                        ?>
                        </center>
                    </div>               
                    <!-- bottom -->
                
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
                <span>Vous n’avez pas les autorisations n&eacute;cessaires pour acc&eacute;der &agrave; cette page.</span> Please <a href="../../index.php">login</a>.
            </p>
        <?php endif; ?>  
    </body>
</html>

