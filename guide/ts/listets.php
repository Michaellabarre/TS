﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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



<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Lister Time Sheet</title>
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">
        <!-- demo stylesheet -->
        <link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../../includes/db_connect.php"/>
		<link   type="text/css" rel="stylesheet" href="../helpers/media/style.css?v=1783"/>

        <!-- helper libraries -->
        <script src="../helpers/jquery-1.9.1.min.js" type="text/javascript"></script>  
	<!-- /head -->
        <style type="text/css">  
		a.button{
			background: blue url(../images/button.gif);
			border-radius: 2em;
			-moz-border-radius: 2em;
			 float: right;   
			display:block;
			color:#555555;
			font-weight:bold;
			height:30px;
			line-height:29px;
			text-decoration:none;
			width:115px;
			
		}
		a:hover.button{
			color:#0066CC;
		}
		
		.delete{
		background:url(../images/deconnexion.png) no-repeat 10px 8px;
		text-indent:30px;
		display:block;
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
            
            table{
                border-collapse: collapse;
                
            }
            td{
                border: 1px solid black;
                border-style: dotted;
                border-color: #1c4e63;
            }
            #blanl{
                border: none;
                border-style: none;
            }
            tr.test:hover {background-color: #19a3ff;}
            /*tr.test:nth-child(odd) {background-color: #bed4f7;}*/
            /*tr.test:nth(even) {background-color: #ffffff;}*/

            /* Cells in even rows (2,4,6...) are one color */        
            tr.test:nth-child(even) td { background: #F1F1F1; } 

            /* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
            tr.test:nth-child(odd) td { background: #FEFEFE; } 
        </style>
    </head>
    <body>

  <!-- top -->
    <?php if (login_check($mysqli) == true) : ?>
        <div id="header">            
            
            <?php
                $Nomuser      = $_SESSION['username'];   
                
                $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$Nomuser.'"';                    
                $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                $refEmploye = $resultRefEmp['EMPLO'];
                
                $reky         = 'select RefEmploye as ref, Prenom as prenom, NomFamille as nom from employes '
                    . 'where Nomuser = "'.$Nomuser.'"';
                $rekPrenom    = mysqli_query($connect,$reky);
                $resultPrenom = mysqli_fetch_assoc($rekPrenom);
                $prenom       = $resultPrenom['prenom'];
                $nom          = $resultPrenom['nom'];
                $refEm        = $resultPrenom['ref'];
            ?>
            
            <div class="bg-help">
                <div class="inBox">
                    <center>
                     <MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1></MARQUEE>
                    <!--<a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                    -->
                    <hr class="hidden" />
                    </center>
                </div>
            </div>
        </div>   
        <a href="../../logout.php" class="button" title="Deconnexion"><span class="delete">Deconnexion</span></a>
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
				
				<ul id="nav">
					<li class="current"><a href="../index.php">GUIDE</a></li><!-- n1 -->

					  <li><a href="../client/index.php">CLIENTS</a><!-- n1 -->
						<ul>
							<li><a href="../client/ajoutclient.php"><b>Nouveau Client </b><img src="../images/addusers.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../client/listeclient.php"><b>Liste des Clients </b><img src="../images/utilisateurs.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../client/modifclientcode.php"><b>Modification Client</b></a></li><!-- n2 -->
						</ul>
					</li>
					<li><a href="../consultant/index.php">CONSULTANTS</a>
						<ul>
							<li><a href="../consultant/ajoutconsultexterne.php"><b>Nouveau Externe</b><img src="../images/news.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="../consultant/listeconsultant.php"><b>Liste Consultants</b><img src="../images/membree.png" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="../consultant/listeconsultexterne.php"><b>Liste Cons. Externe</b><img src="../images/membree.png" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="../consultant/listeconsultinterne.php"><b>Liste Cons. Internes </b><img src="../images/membree.png" border="0" width="15" height="15" align="absmiddle"></a></li>
						</ul>
					</li>	
					<li><a href="../mission/index.php">MISSIONS</a>
						<ul>
							<li><a href="../mission/nouvellemission.php"><b>Nouvelle Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="../mission/missioncode.php"><b>Modification Mission</b></a></li>
							<li><a href="../mission/missiondept.php"><b>Mission par Départ.</b></a></li>
						</ul>
					</li>
					<li><a href="../ts/index.php">TIMESHEET</a>
						<ul>
							<li><a href="../ts/saisits.php"><b>Saisir TIMESHEET</b> <img src="../images/todo.png" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="../ts/listets.php"><b>Lister TIMESHEET</b><img src="../images/liste.png" border="0" width="15" height="15" align="absmiddle"></a></li>
						</ul>
					</li>
					<li><a href="../ts/validts.php">VALIDE TS</a></li>
					<li><a href="../alert/index.php">ALERT</a>
						<ul>
							<li><a href="../alert/alertcontrat.php"><b>Contrat non signé</b> <img src="../images/erreur.gif" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="../alert/alertfacturation.php"><b>Alerte Facturation</b><img src="../images/Warning.gif" border="0" width="15" height="15" align="absmiddle"></a></li>
						</ul>
					</li>
					<li><a href="../exportation/index.php">EXPORTATION</a></li>
					</ul>
					<!--
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
                        <a href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                     <!--   </ul>
                    </div>
                    <div>    
                        <a class='tab selected' href='../ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='../ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a class='tab selected' href='../ts/listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                    <div>                                        
                        <a class='tab' href='../ts/validts.php'><span style="width: 100px; text-align:center;">VALID TS</span></a>  
                    </div>
                    <div>                                        
                        <a class='tab' href='../alert/index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>    
                        <ul>
                            <li><a href='../alert/alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a href='../alert/alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../exportation/index.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>DETAILS DU TIME SHEET</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
            else if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Collaborateur' or $prof == 'Superviseur' or $prof == 'Collaboratrice'){
                ?>
                <!-- tabs -->
				
				<ul id="nav">
					<li class="current"><a href="../index.php">GUIDE</a></li><!-- n1 -->

					<li><a href="../mission/index.php">MISSIONS</a>
						<ul>
							<li><a href="../mission/missioncode.php"><b>Fiche de Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="../mission/missiondept.php"><b>Mission par Départ.</b></a></li>
						</ul>
					</li>
					<li><a href="../ts/index.php">TIMESHEET</a>
						<ul>
							<li><a href="../ts/saisits.php"><b>Saisir TIMESHEET</b> <img src="../images/todo.png" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="../ts/listets.php"><b>Lister TIMESHEET</b><img src="../images/liste.png" border="0" width="15" height="15" align="absmiddle"></a></li>
						</ul>
					</li>
					<li><a href="../exportation/export_TS_Cons.php">EXPORTATION</a></li>
					</ul>
				
                   <!-- <nav class="menu">                    
                        <div>
                            <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>                            
                        </div>    
                        <div>
                            <a class='tab' href='../../guide/mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                            <ul>
                                <li><a href='../mission/missioncode.php'><span>Fiche de Mission</span></a></li>                        
                                <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            </ul>
                        </div>                        
                        <div>
                            <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a>                                                                                                
                            <ul>
                                <li><a href='./saisits.php'><span>Saisir Time Sheet</span></a></li>
                                <li><a href='./listets.php'><span>Lister Time Sheet</span></a></li>
                            </ul>                                                        
                        </div>    
                        <div>
                            <a class='tab' href='../../guide/exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                           
                        </div>-->
                        <br/><br/>
                        <font style=" color: black"><b><center>DETAILS DU TIME SHEET</center></b></font>
                        <br/>
                    </nav>
                    <!-- /tabs -->
                <?php
            }            
            else if($prof == 'Assistant(e) Manager'  ){
                ?>
                <!-- tabs -->
                    
					
					
				<ul id="nav">
					<li class="current"><a href="../../guide/index.php">GUIDE</a></li><!-- n1 -->

					  <li><a href="../client/index.php">CLIENTS</a><!-- n1 -->
						<ul>
							<li><a href="../client/ajoutclient.php"><b>Nouveau Client </b><img src="../images/addusers.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../client/listeclient.php"><b>Liste des Clients </b><img src="../images/utilisateurs.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../client/modifclientcode.php"><b>Modification Client</b></a></li><!-- n2 -->
						</ul>
					</li>
						
					<li><a href="../mission/index.php">MISSIONS</a>
						<ul>
							<li><a href="../mission/nouvellemission.php"><b>Nouvelle Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="../mission/missioncode.php"><b>Modification Mission</b></a></li>
							<li><a href="../mission/missiondept.php"><b>Mission par Départ.</b></a></li>
						</ul>
					</li>
					<li><a href="./index.php">TIMESHEET</a>
						<ul>
							<li><a href="./saisits.php"><b>Saisir TIMESHEET</b> <img src="../images/todo.png" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="./listets.php"><b>Lister TIMESHEET</b><img src="../images/liste.png" border="0" width="15" height="15" align="absmiddle"></a></li>
						</ul>
					</li>
					<li><a href="../exportation/export_TS_Cons.php">EXPORTATION</a></li>
					</ul>
					<!--<nav class="menu">  
                    <div>                                        
                        <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
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
                        <a class='tab' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>                        
                        <ul>
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->                        
                     <!---   </ul>
                    </div>
                    <div>    
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='./saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a class='tab selected' href='./listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                        <div>    
                            <a class='tab' href='../exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/>
                    <font style=" color: black"><b><center>DETAILS DU TIME SHEET</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs -->
                <?php
            }            
        ?>
                      
        <div id="container" >            
            
            
                <div>
                    <!-- /top -->                    
                    <div id="dp">
                        <center>
                        <?php
                            $dateNow = date('Y-m-d');
//                            $dateNow = '2016-01-01';  
//                            echo 'Date: '.$dateNow.'<br>';
                            
                            $date_exp = explode("-", $dateNow);
                            $jour   = $date_exp[2];
                            $mois   = $date_exp[1];
                            $annee  = $date_exp[0];                       

//                            echo '</br>jour: '.$jour;    
//                            echo '</br>mois: '.$mois;
//                            echo '</br>annee: '.$annee;
                            
                            if($mois >= 1 && $mois <= 03){                                
                                $anneepre = $annee - 1;                                
                                $first = $anneepre."-10-01";
                                $end   = $annee."-12-31" ;
//                                echo '<br/>'.$first;
//                                echo '<br/>'.$end;
//                                echo '<br/>select PERIODE from periode where DateEntree between "'.$first.'" and "'.$end.'"<br/>';
                            }
                            else{                                
                                $first = $annee."-01-01";
                                $end   = $annee."-12-31" ;
//                                echo '<br/>*** '.$first;
//                                echo '<br/>*** '.$end;
//                                echo 'select PERIODE from periode where DateEntree between "'.$first.'" and "'.$end.'"';
                            }
                        $reqListPeriod = mysqli_query($connect,'select PERIODE from periode where DateEntree between "'.$first.'" and "'.$end.'";');
//                        $reqListPeriod = mysqli_query($connect,'select PERIODE from periode where DateEntree between "2015-01-01" and "2015-12-31";');
                        if($prof == 'Associé' or $prof == 'Manager' or $prof == 'DAF'){
                            $reqNomCons = mysqli_query($connect,'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre 
                            FROM employes where 
                            actif = 0 and 
                            RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") 
                            ORDER BY Prenom ASC;');
                        }
                        else if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Assistant(e) Manager' or $prof == 'Collaborateur' 
                        or $prof == 'Collaboratrice' or $prof == 'Superviseur'  ){
                            $reqNomCons = mysqli_query($connect,'select concat(E.Prenom, " ", E.NomFamille) from employes where RefEmploye = "'.$refEmploye.'";');
                        }
                        ?>
                        <form name="consultTS" method="POST">
                            S&eacute;l&eacute;ctionner la p&eacute;riode                                    
                                <select name="periode" id="periode" style="width: 210px">
                                    <option></option>
                                        <?php
	                                            while($rowPde = mysqli_fetch_array($reqListPeriod, MYSQLI_BOTH)){
                                                    echo '<option value="'.$rowPde[0].'" >'.$rowPde[0].'</option>';
                                            }
                                        ?>
                                </select>
                            
                            <?php
                                if($prof == 'Associé' or $prof == 'Manager' or $prof == 'DAF'){
                            ?>
                            Collaborateur                                    
                                <select name="nomCons" id="nomCons" style="width: 250px">                                            
                                    <option></option>
                                        <?php
                                            while($rowNomCons = mysqli_fetch_array($reqNomCons, MYSQLI_BOTH)){
                                                echo '<option value="'.$rowNomCons[0].'" >'.$rowNomCons[1].'</option>';
                                            }
                                        ?>

                                </select>                            
                            <?php
                                }
                            ?>
                            <input type="submit" name="go" value="Selectionner" />
                        </form>
                        
                        <?php                        
                        if (isset($_POST['go'])){  
                            $dep = array();
                            $periode = $_POST['periode']; //periode: 
                            
                            if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Assistant(e) Manager' or $prof == 'Collaborateur' 
                                or $prof == 'Collaboratrice'){
                                $consu = $refEm;
                            }                            
                            else if($prof == 'Associé' or $prof == 'Manager' or $prof == 'DAF'){
                                $consu = $_POST['nomCons'];
                            }
                            
//                            $reqCodeEmp = 'select RefEmploye as EMP from employes where Prenom = "'.$consu.'"';
//                            $rekCodeEmp = mysqli_query($connect,$reqCodeEmp);											
//                            $resultCodeEmp = mysqli_fetch_assoc($rekCodeEmp);
//                            $refEmp = $resultCodeEmp['EMP'];
                            
                            $refEmp = $consu;
                            
                            $reqheuretot = 'select sum(H.HeureFacturables) as tot
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
                                where P.PERIODE = "'.$periode.'"                
                            )        
                            and F.RefEmploye = "'.$refEmp.'"
                            order by H.JourTravaille ASC, H.RefDetailFichePointage ;';
                            $resheureTot= mysqli_query($connect,$reqheuretot);
                            $resultheureTot = mysqli_fetch_assoc($resheureTot);
                            $heureTot = $resultheureTot['tot'];                                                         
                            
                            echo '<br><b>P&eacute;riode: </b>'.$periode;                                                                                                                                            
//                            echo '<br/><b>Consultant: </b>'.$consu;                                                                                                                                            
                            echo '<br/><b>Heure Totale: </b>'.$heureTot;  
                            
                                                        
                            echo '<br/><br/><br/>';   
                            
                            $reqTSEx = 'select H.RefDetailFichePointage as Ref, concat(E.Prenom, " ", E.NomFamille) as Nom, H.JourTravaille as Date, 
                            H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, 
                            H.HeureFacturables as Heures, H.DescriptionTravail, H.Facture as Validation, H.Date_validation_TS as datevalide, 
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
                                where P.PERIODE = "'.$periode.'"                
                            )        
                            and F.RefEmploye = "'.$refEmp.'"
                            order by H.JourTravaille ASC, H.RefDetailFichePointage ;';
                        $resTSEx = mysqli_query($connect,$reqTSEx) or exit(mysqli_error($connect));
                        
                        
                        

                        // on vérifie le contenu de  la requête ;
                        if (mysqli_num_rows($resTSEx) == 0){   
                            // si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
                                print "<script> alert('La requête n\'a pas abouti!Aucun résultat pour le TS')</script>";
                        } 

                        $colonne = mysqli_num_fields($resTSEx); //col                               
                        echo '<div style="max-height: 400px;overflow: scroll; ">';
                        echo '<table>
                            <!-- impression des titres de colonnes -->
                             <TR>
                                <TD><font color=""><b>Consultant</b></font></TD>
                                <TD><font color=""><b>Date</b></font></TD>
                                <TD><font color=""><b>Code mission</b></font></TD>
                                <TD><font color=""><b>Nom du client</b></font></TD>
                                <TD><font color=""><b>D&eacute;partement</b></font></TD>
                                <TD><font color=""><b>Heures</b></font></TD>            
                                <TD><font color=""><b>Description</b></font></TD>   
                                <TD><font color=""><b>Validation</b></font></TD>
                                <TD><font color=""><b>Date de validation</b></font></TD>     
                                <TD><font color=""><b>D&eacute;pense</b></font></TD>                                            
                                <TD><font color=""><b>Justificatifs</b></font></TD>                                            
                            </TR>';

                        $val = array();
                        $linina = 0;
                        while($row = mysqli_fetch_array($resTSEx, MYSQLI_BOTH)){   
                        echo '<tr class="test">';            
                            for($j=0; $j < $colonne ; $j++){                                   
                                if($j == 0){
                                    $val[$linina] = array($row[$j]);
                                    if($val[$linina-1][$j] == $val[$linina][$j]){                    
                                        //echo '<td>'.$val[$linina][$j].' biiii '.$linina.'</td>';  
                                        for($j=0; $j < $colonne ; $j++){                     
                                            switch($j){                                                 
                                                case $j > 1 && $j <=8: echo '<td style="border:none"></td>'; 
                                                    break;                           
                                                case 9:
                                                    $dep[] = $row[$j];
                                                    echo '<td>'.$row[$j].'</td>';  
                                                    break;
                                                case 10: echo '<td>'.$row[$j].'</td>';  
                                                    break;
                                            }
                                        }
                                    }                                   
                                }
                                else{
                                    for($j=1; $j < $colonne ; $j++){
                                        switch($j){                             
                                            case $j >= 1 && $j <=7: echo '<td>'.$row[$j].'</td>';  
                                                break;   
//                                            case 5: 
                                            case 8: if($row['Validation']==1){
//                                                echo '<input type="checkbox" id="cloturer" name="cloturer" checked disabled />' ;
                                                        echo '<td> Validé</td>';  
                                                    }
                                                    else if($row['Validation']==0){
                                                        echo '<td> Non Validé</td>';  
                                                    }                                
                                                break;
                                            case 9: 
                                                $dep[] = $row[$j];
                                                echo '<td>'.$row[$j].'</td>';  
                                                break;
                                            case 10: echo '<td>'.$row[$j].'</td>';  
                                                break;
                                            case 11: echo '<td>'.$row[$j].'</td>';  
												break;
                                        }
                                    }                                              
                                }            
                            }
                            echo '</tr>';
                            $linina = $linina + 1;        
                        }                        
                        echo '</TABLE>';
                        echo '</div>';
                        foreach ($dep as $valeur){
                            $depTotal += $valeur;                            
                        }
                        echo '<font style=" top: 400px; left: 405px; right:500px"><b>Depense Totale: </b>Ar ' .$depTotal .'</font>';
                        //mysql_close(); 
                        }
                    ?>
                        </center>
                    </div>               
                    <!-- bottom -->
                </div>
            
        </div>
    </div>
  
    <script>
        $(document).ready(function(){
            var pdeSelected = '<?php echo $periode;?>';
            document.getElementById('periode').value = pdeSelected;
            var consu = '<?php echo $consu;?>';
            document.getElementById('nomCons').value = consu;
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

