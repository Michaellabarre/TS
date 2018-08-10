<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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


<html  xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Liste des Clients</title>
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">
        <!-- demo stylesheet -->
        <link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../../includes/db_connect.php"/>

        <link type="text/css" rel="stylesheet" href="../helpers/media/style.css?v=1783"/>
        <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css"> -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!-- CDN Css -->

        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> -->
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script> -->

        <!-- helper libraries -->
        <script src="../helpers/jquery-1.9.1.min.js" type="text/javascript"></script>
		
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

        <!-- daypilot libraries -->
        <script src="../js/daypilot-all.min.js?v=1783" type="text/javascript"></script>
        <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script> -->
        <!-- <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->

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
            
            input[type='submit'] {
            /*width: 100px!important;*/    
            float: right;
            margin-right: 152px;            
            }
            
            table{
                border-collapse: collapse;                   
            }
            /*#echeance td{
                border: 1.5px solid #D8D8D8;    
                line-height: 150%;
                border-style: dotted;                                    
            }*/

       
            /*tr.test:hover {background-color: #19a3ff;}
            /*tr.test:nth-child(odd) {background-color: #bed4f7;}*/
            /*tr.test:nth(even) {background-color: #ffffff;}

            /* Cells in even rows (2,4,6...) are one color */        
            tr.test:nth-child(even) td { background: #D0E4F5; } 

            /* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
            tr.test:nth-child(odd) td { background: #ffffea; } 

            /*#echeance {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#echeance td, #echeance th {
    border: 1px solid #ddd;
    padding: 8px;
}

#echeance tr:nth-child(even){background-color: #f2f2f2;}

#echeance tr:hover {background-color: #ddd;}

#echeance th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}*/


            

            
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

            .progress-container {
  width: 100%;
  height: 8px;
  background: #ccc;
}

.progress-bar {
  height: 8px;
  background: #4caf50;
  width: 0%;
}

tr.up
{
    text-transform: uppercase;
}
            
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
                   <MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1></MARQUEE>
                 <!--   <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                    -->
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
		// GESTION DES INTERFACES UTILISATEURS
            if($prof == 'Associé' or $prof == 'Manager'){
                ?>
				
				<ul id="nav">
					<li class="current"><a href="../index.php">GUIDE</a></li><!-- n1 -->

					  <li><a href="./index.php">CLIENTS</a><!-- n1 -->
						<ul>
							<li><a href="./ajoutclient.php"><b>Nouveau Client </b><img src="../images/addusers.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="./listeclient.php"><b>Liste des Clients </b><img src="../images/utilisateurs.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="./modifclientcode.php"><b>Modification Client</b></a></li><!-- n2 -->
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
				
				
				
				
                <!-- tabs -->
				<!--
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
                      <!--
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
					<ul id="nav">
					<li class="current"><a href="../index.php">GUIDE</a></li><!-- n1 -->

					  <li><a href="../index.php">CLIENTS</a><!-- n1 -->
						<ul>
							<li><a href="./ajoutclient.php"><b>Nouveau lient </b><img src="../images/addusers.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="./listeclient.php"><b>Liste des Clients </b><img src="../images/utilisateurs.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="./modifclientcode.php"><b>Modification Client</b></a></li><!-- n2 -->
						</ul>
					</li>
	
					<li><a href="../mission/index.php">MISSIONS</a>
						<ul>
							<li><a href="../mission/nouvellemission.php"><b>Nouvelle Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="../mission/missioncode.php"><b>Fiche de Mission</b></a></li>
							<li><a href="../mission/missiondept.php"><b>Mission par Départ.</b></a></li>
						</ul>
					</li>
					<li><a href="../alert/index.php">ALERT</a>
						<ul>
							<li><a href="../alert/alertcontrat.php"><b>Contrat non signé</b> <img src="../images/erreur.gif" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="../alert/alertfacturation.php"><b>Alerte Facturation</b><img src="../images/Warning.gif" border="0" width="15" height="15" align="absmiddle"></a></li>
						</ul>
					</li>
					<li><a href="../exportation/exportation.php">EXPORTATION</a></li>
					<li>    
                        <a href='../ts/vuets.php'><span style="width: 100px; text-align:center;">VUE TS</span></a>                                                         
                    </li> 
					</ul>
				
				
                <!--<nav class="menu">  
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
                    <!--    </ul>
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
				
				
				<ul id="nav">
					<li class="current"><a href="../../guide/index.php">GUIDE</a></li><!-- n1 -->

					  <li><a href="index.php">CLIENTS</a><!-- n1 -->
						<ul>
							<li><a href="ajoutclient.php"><b>Nouveau Client </b><img src="../images/addusers.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="listeclient.php"><b>Liste des Clients </b><img src="../images/utilisateurs.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="modifclientcode.php"><b>Modification Client</b></a></li><!-- n2 -->
						</ul>
					</li>
						
					<li><a href="../../guide/mission/index.php">MISSIONS</a>
						<ul>
							<li><a href="../../guide/mission/nouvellemission.php"><b>Nouvelle Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="../../guide/mission/missioncode.php"><b>Modification Mission</b></a></li>
							<li><a href="../../guide/mission/missiondept.php"><b>Mission par Départ.</b></a></li>
						</ul>
					</li>
					<li><a href="../../guide/ts/index.php">TIMESHEET</a>
						<ul>
							<li><a href="../../guide/ts/saisits.php"><b>Saisir TIMESHEET</b> <img src="../images/todo.png" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="../../guide/ts/listets.php"><b>Lister TIMESHEET</b><img src="../images/liste.png" border="0" width="15" height="15" align="absmiddle"></a></li>
						</ul>
					</li>
					<li><a href="../../guide/exportation/export_TS_Cons.php">EXPORTATION</a></li>
					</ul>
					
                 <!--   <nav class="menu">  
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
                    </div>            -->    
                        <br/><br/>
                        <font style=" color: white"><b><center>LISTE DES CLIENTS</center></b></font>
                        <br/>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                  <!--  </nav>
                    <!-- /tabs --> 
                <?php
            }
        ?>
          <!-- FIN GESTION DES INTERFACES UTILISATEURS            -->
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
                        <!-- Champ de recherche 
                        <form method="Post" action="#">-->
                           <!-- <input type="search" name="Rechercher" value="" placeholder="Rechercher" style="vertical-align: 10px; float: " >
                           <?php 
                               // $sql = 'SELECT * from client 
                               // WHERE '.$_POST['Rechercher'].' = RefClient'?> -->
                        <!-- </form> -->

                    <div>
                        <!--<table cellspacing="0" cellpadding="0" border="0" max-width="1120px" id="echeance">--> 
<!--                        <table  > 
                            <tr>
                            </tr>-->
                            <!-- <table border="1" cellspacing="4" cellpadding="0" style=" border-color: #A9E2F3" >
                            <tr>
                                <td> -->
                                    <!--<table cellspacing="0" cellpadding="0" border="1" width="1100px"  id="echeance">-->                                    
                                    <!-- Affichage des données TS sous forme de tableau -->
                                    
                                        
                                    
									<!-- <table cellspacing="0" cellpadding="0" border="1" width="1300px" style=" border-color: none" id="echeance"> -->
                                        <!-- <tr>
                                            <td style="width:145px"><b><center>Société</center></b></td>
                                            <td style="width:74px"><b><center>Code</center></b></td>
                                            <td style="width:230px"><b><center>Adresse</center></b></td>                                    
                                            <td style="width:195px"><center><b>Contact</b></center></td>
                                            <td style="width:88px"><b><center>Téléphone</center></b></td>
                                            <td style="width:121px"><center><b>Mobile</b></center></td>
                                            <td style="width:232px"><center><b>Email</b></center></td> -->
                                            <!--<td class="site"><center><b>Site Web</b></center></td>-->
                                        <!-- </tr> -->
                                        <!-- <div class="progress-container">
                                            <div class="progress-bar" id="myBar"></div>
                                        </div>
                                        <tr class="up">
                                            <th style="width:145px"><b>Société</b></th>
                                            <th style="width:74px">Code</th>
                                            <th style="width:230px">Adresse</th>
                                            <th style="width:195px">Contact</th>
                                            <th style="width:88px">Téléphone</th>
                                            <th style="width:121px">Mobile</th>
                                            <th style="width:232px">Email</th>
                                         </tr> -->
                                        <!-- <thead>
                                             <tr>
                                                <th>Month</th>
                                                <th>Savings</th>
                                                <th>Savings</th>
                                                <th>Savings</th>
                                                <th>Savings</th>
                                                <th>Savings</th>
                                                <th>Savings</th>
                                            </tr>
                                        </thead> -->
                                     <!-- </table>
                                   
                                </td>
                            </tr>
                            <tr>
                                <td> -->
                                    <!--<div style="width:1120px; height:454px; overflow:auto;">
                                    <div style="width:1319px; height:446px; overflow:auto;"> -->
                                    <!-- <table cellspacing="0" cellpadding="0" border="1" width="1300px" style=" border-color: none" id="echeance"> -->
                                        <!--<table cellspacing="0" cellpadding="0" border="0" width="1100px" id="echeance">--> 
                                            <?php
                                            // while($row = mysqli_fetch_array($tesita, MYSQLI_BOTH)){
                                            //     echo '<tr class="test">';
                                            //         for($j=0; $j < $colonne ; $j++){
                                            //             switch ($j){
                                            //                 case 0: echo '<td style="max-width:145px;word-wrap: break-word"><b><center>'.$row[$j].'</center></b></td>';
                                            //                     break;
                                            //                 case 1: echo '<td style="max-width:74px;word-wrap: break-word"><b><center>'.$row[$j].'</center></b></td>';
                                            //                     break;                                                                
                                            //                 case 2: echo '<td style="max-width:230px;word-wrap: break-word"><b><center>'.$row[$j].'</center></b></td>';
                                            //                     break;
                                            //                 case 3: echo '<td style="max-width:195px;word-wrap: break-word"><b><center>'.$row[$j].'</center></b></td>';
                                            //                     break;
                                            //                 case 4: echo '<td style="max-width:88px;word-wrap: break-word"><b><center>'.$row[$j].'</center></b></td>';
                                            //                     break;
                                            //                 case 5: echo '<td style="max-width:121px;word-wrap: break-word"><b><center>'.$row[$j].'</center></b></td>';
                                            //                     break;
                                            //                 case 6: echo '<td style="max-width:232px;word-wrap: break-word"><b><center>'.$row[$j].'</center></b></td>';
                                            //                     break;
//                                                            case 7: echo '<td class="site">'.$row[$j].'</td>';
//                                                                break;
                                                        // }
                                                    // }
                                                // echo '</tr>';
                                                // }
                                            ?>

                                        <!-- </table> -->
                                    <!-- </div> -->
									 <!-- FIN Affichage des données TS sous forme de tableau -->
                                <!-- </td> -->
                            <!-- </tr>                                                                                                                                                                                                                                                                 -->
                        <!-- </table> -->
                    <!-- </div>                                                                                                                                                                                                                                                                       -->
                    <!--</div>-->               
                    <!-- bottom -->
                            <table id="example" class="display" style="width:100%" >
        <thead>
            <tr>
                <th>Société</th>
                <th width="74px">Code</th>
                <th>Adresse</th>
                <th>Contact</th>
                <th>Téléphone</th>
                <th>Mobile</th>
                <th>Email</th>
                <!-- <th>Start date</th>
                <th>Salary</th> -->
            </tr>
        </thead>
        <tbody>

            <?php 
                $req='SELECT NomSociete, RefClient as "Code", Adresse, NomContact as Contact, NumeroTel as "Téléphone", NumMobile as Mobile, Mail FROM client ORDER BY NomSociete ASC;';
                $resultat = mysqli_query($connect, $req) or exit(mysqli_error($connect));
                //$row = mysqli_fetch_array($resultat, MYSQLI_BOTH);

                while($row = mysqli_fetch_array($resultat)){
                    echo '<tr>';
                    echo '<td align="center"><b>'.$row['NomSociete'].'</b></td>';
                    echo '<td align="center" width="74px"><b>'.$row['Code'].'</b></td>';
                    echo '<td align="center"><b>'.$row['Adresse'].'</b></td>';
                    echo '<td align="center"><b>'.$row['Contact'].'</b></td>';
                    echo '<td align="center"><b>'.$row['Téléphone'].'</b></td>';
                    echo '<td align="center"><b>'.$row['Mobile'].'</b></td>';
                    echo '<td align="center"><b>'.$row['Mail'].'</b></td>';
                    echo '</tr>';
                }


                // echo '<tr>';
                // foreach($row as $ii)
                // {
                //      //echo '<td>'.$ii.'</td>';
                     
                // }
                //     echo '<td>'.$row['Code'].'</td>';
                //     echo '<td>'.$row['Prénom'].'</td>';
                //     echo '<td>'.$row['Nom'].'</td>';
                //     echo '<td>'.$row['Titre'].'</td>';

                 
                
            ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>Société</th>
                <th>Code</th>
                <th>Adresse</th>
                <th>Contact</th>
                <th>Téléphone</th>
                <th>Mobile</th>
                <th>Email</th>
                <!-- <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> -->
    </table>
                    </center>
                
            </div>                        
        </div>
    </div>  
<script type="text/javascript">
    $(document).ready( function () {
    $('#echeance').DataTable();
} );
</script>
<script>
// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

function myFunction() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("myBar").style.width = scrolled + "%";
}
</script>
<script type="text/javascript">
                $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Rechercher par '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
            </script>  
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

