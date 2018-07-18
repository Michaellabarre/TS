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
    
    function moy($month) {
        $month_arr = array();
        $month_arr['01'] =  "Janvier";
        $month_arr['02'] =  "Février";
        $month_arr['03'] =  "Mars";
        $month_arr['04'] =  "Avril";
        $month_arr['05'] =  "Mai";
        $month_arr['06'] =  "Juin";
        $month_arr['07'] =  "Juillet";
        $month_arr['08'] =  "Août";
        $month_arr['09'] =  "Septembre";
        $month_arr['10'] =  "Octobre";
        $month_arr['11'] =  "Novembre";
        $month_arr['12'] =  "Décembre";
        return $month_arr[$month];
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<title>Export TS</title>	
		
	    <HTA:APPLICATION ID="oMyApp" 
        APPLICATIONNAME="Application Executer" 
        BORDER="no"
        CAPTION="no"
        SHOWINTASKBAR="yes"
        SINGLEINSTANCE="yes"
        SYSMENU="yes"
        SCROLL="no"
        WINDOWSTATE="normal">
		
			<script language="JavaScript" type="text/javascript">
			<!--
			function RunFile()
			{
			var wshShell = new ActiveXObject("WScript.Shell");
			alert ("ok");
			wshShell.Run("\\192.168.1.9\04-Outils internes\Boite a Outils AMOA\01-Projets Internes\FICHE OUVERTURE MISSION\Fiche de recette_fonctionnalités.docx", 1, true);
			}
			-->
			</script>


        
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">
        <!-- demo stylesheet -->
        <script type="text/javascript" src="../../jquery/jquery.js"></script>        
        <script src="../../jquery/jquery-1.8.1.min.js" type="text/javascript"></script>        
        <script src="../../jquery/jquery-ui-1.11.2/jquery-ui.js"></script>  
        <link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=1783" />     
        <link rel="stylesheet" href="../../jquery/jquery-ui-1.11.2/jquery-ui.css" />
		<link   type="text/css" rel="stylesheet" href="../helpers/media/style.css?v=1783"/>

        <!-- helper libraries -->
          
	<!-- /head -->
        <style>   
fieldset{
				width:500px;
				background-color:#CCC;
				max-width:500px;
				padding:16px;	
				border:2px solid green;
				-moz-border-radius:8px;
				-webkit-border-radius:8px;	
				border-radius:8px;
			 }
	.legend
{
  margin-bottom:0px;
  margin-left:16px;
}

.gauche{
				float:left;
				margin-left : 150px;
			}
.droite{
				float:right;
				margin-right : 150px;
			}
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
			color:blue;
		}
		
		a.button2{
			background: yellow url(../images/button.gif);
			border-radius: 0.5em;
			-moz-border-radius: 2em;
			 float: center;   
			display:block;
			color:black;
			margin-center : 150px;
			font-weight:bold;
			height:30px;
			line-height:29px;
			text-decoration:none;
			width:115px;
			
		}
		
		a:hover.button2{
			color:blue;
		}
		
		.delete{
		background:url(../images/deconnexion.png) no-repeat 10px 8px;
		text-indent:30px;
		display:block;
		}	

		.export{
		background:url(../images/dossier2.png) no-repeat 10px 8px;
		text-indent:20px;
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
        </style>
    </head>
    <body>

  <!-- top -->
    <?php if (login_check($mysqli) == true) : ?>
        <div id="header">            
            
            <?php
                $Nomuser      = $_SESSION['username'];                                
                $reky         = 'select Prenom as prenom, RefEmploye as red, NomFamille as nom from employes '
                    . 'where Nomuser = "'.$Nomuser.'"';
                $rekPrenom    = mysqli_query($connect,$reky);
                $resultPrenom = mysqli_fetch_assoc($rekPrenom);
                $prenom       = $resultPrenom['prenom'];
                $nom          = $resultPrenom['nom'];
                $refe         = $resultPrenom['red'];
            ?>
            
            <div class="bg-help">
                <div class="inBox">
                    <center>
                     <MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1></MARQUEE>
                 <!--   <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>-->
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
							<li><a href="../mission/missiondept.php"><b>Mission par Départ</b></a></li>
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
                  <!--      </ul>
                    </div>
                    <div>    
                        <a href='../ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
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
                        <a class='tab selected' href='../exportation/index.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>EXPORTATION DE LA FICHE E006 OU/ET DES TIME SHEET SOUS EXCEL</center></b></font>
                    <br/>
                    </nav>
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
                <!--    <nav class="menu">  
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
                    <!--    </ul>
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
            
            <center>
                <div>
                    <!-- /top -->                    
                    <div id="dp">
                        <?php
                        $reqListPeriod = mysqli_query($connect,'select PERIODE from periode where DateEntree between "2015-01-01" and "2015-12-31";');
                        if($prof == 'Manager'){
							
							//-------MODIF RODDY--------
							//$reqNomCons = mysqli_query($connect,'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre from employes where RefEmploye = "'.$refe.'";');
                            $reqNomCons = mysqli_query($connect,'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre from employes  where 
                            actif = 0 and 
                            RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") 
                            ORDER BY Prenom ASC;');
                        }
						//-------FIN MODIF RODDY--------
						
                        else if($prof == 'Associé'){
                            $reqNomCons = mysqli_query($connect,'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre 
                            FROM employes where 
                            actif = 0 and 
                            RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") 
                            ORDER BY Prenom ASC;');
                        }
                        ?>
                        
                        
                        <section>                                                                                    
                            <form method="POST">     
							<FIELDSET class="gauche">
								<LEGEND><strong>EXPORTATION DE LA FICHE E006</strong></LEGEND>
								<a href = "../exportation/Export_Fiche_E006.accde"   class="button2" title="Exportation de la fiche E006" ><span class="export">Export_E006</span></a>
							</FIELDSET >
							<FIELDSET class = "droite">
							<LEGEND><strong>EXPORTATION TIMESHEET</strong></LEGEND>
									   <input id="daty" name="daty" type="text" style="width:175px;text-align: center"placeholder="Sélectionner la période"/>                                                        
<!--                                <select name="periode" id="periode" style="width: 210px">
                                    <option value="" disabled="" selected style="display:none">-------------------- Mois --------------------</option>                                    
                                    <option name="Janvier" value="Janvier">Janvier</option>
                                    <option name="Fevrier" value="Fevrier">Février</option>    
                                    <option name="Mars" value="Mars">Mars</option>    
                                    <option name="Avril" value="Avril">Avril</option>    
                                    <option name="Mai" value="Mai">Mai</option>    
                                    <option name="Juin" value="Juin">Juin</option>    
                                    <option name="Juillet" value="Juillet">Juillet</option>    
                                    <option name="Aout" value="Aout">Aout</option>    
                                    <option name="Septembre" value="Septembre">Septembre</option>    
                                    <option name="Octobre" value="Octobre">Octobre</option>    
                                    <option name="Novembre" value="Novembre">Novembre</option>    
                                    <option name="Decembre" value="Decembre">Décembre</option>    
                                </select>                                -->
                                <select name="coll" id="coll" style="width: 210px">                                            
                                    <option value="" disabled="" selected style="display:none" text-align: center">-------------- Collaborateur --------------</option>
                                    <option value="avalider">A valider</option>
									<
                                        <?php
                                            while($rowNomCons = mysqli_fetch_array($reqNomCons, MYSQLI_BOTH)){
                                                echo '<option value="'.$rowNomCons[0].'" >'.$rowNomCons[1].'</option>';
                                            }
                                        ?>

                                </select>                                
                                <input type="submit" name="export" value="Afficher" /> 
							</FIELDSET>
                             <br><br>
								<!--<a href="javascript:;"  onClick="window.open('/home/randrianarison/Bureau/BUG_LIBERTEMPO_1.9.odt');" class="button" title="Deconnexion" >Bloc-Note</a>-->
								<!--<input type="button" value="Run Notepad" onclick="RunFile();"/>-->
						</form>                            
                        </section> 
                        <br/><br/><br/><br/><br/><br/><br/>
                        <?php
                            if(isset($_POST['export']) && $prof == 'Manager'){
                                if(empty($_POST['daty']) || empty($_POST['coll'])){
                                    echo '<font color="red"><b><br/>Veuillez s&eacute;lectionner la période et le Collaborateur.</b></font>';
                                }
                                else{
                                    $datyChoisit = $_POST['daty'];                           
                                    $datyChoisit = changeDate(str_replace("/", "-", $datyChoisit));
                                    
                                    $dateNow = $datyChoisit;                            
                                
                                    $date_exp = explode("-", $dateNow);
                                    $jour   = $date_exp[2];
                                    $moiss  = $date_exp[1];
                                    $taona  = $date_exp[0]; 
                                    $mm = moy($moiss);
                                    
//                                    echo 'mm: '.$mm;

                                    $mois = "%".moy($moiss)." ".$taona."%";
                                    
                                    
//                                    $reqYear  = 'select YEAR(CURRENT_DATE()) as taona ;';
//                                    $resYear  = mysqli_query($connect, $reqYear) or exit(mysqli_error($connect));
//                                    $resTaona = mysqli_fetch_assoc($resYear);
//                                    $taona = $resTaona['taona'];
                                    
//                                    $mm = $_POST['periode'];
//                                    $mois = "%".$_POST['periode']." ".$taona."%";
                                    $collaborateur = $_POST['coll']; 
                                    // echo 'mois '.$mois .' col ' .$collaborateur;
                                    
//                                    $reqRefCol = 'select RefEmploye as refCol from employes where Prenom = "'.$collaborateur.'"';                    
//                                    $rekRefCol = mysqli_query($connect,$reqRefCol) or exit(mysqli_error($connect));
//                                    $resultRefCol = mysqli_fetch_assoc($rekRefCol);
//                                    $refCol = $resultRefCol['refCol'];
                                    $refCol = $collaborateur;
									// echo ' refCol = '.$refCol;
																
									
									
									//Recherche à partir de la session en cours du manager authentifié
                                    $employe = $_SESSION['username'];
									 // echo 'employe '.$employe;
									 $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';           // => il s'agit du login manager
                                    $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                                    $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                                    $refEmploye = $resultRefEmp['EMPLO'];
									//echo ' refEmploye =  '.$refEmploye;
									
									
									//-- Recherche à partir du matricule de l'employe ou du consultant
										$refCons = '';
										$queryref = "select RefEmploye as EMPLO  from employes where RefEmploye is not null and actif = 0 and  RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ') ORDER BY Prenom ASC";
										$rekref = mysqli_query($connect,$queryref) or exit(mysqli_error($connect));
										while($rowRefCons = mysqli_fetch_array($rekref, MYSQLI_BOTH)){
											$refCons = strval($rowRefCons[0]);		// => MODIF RODDY car refCons doit être ce type pou être pris en compte par le valeur string 'avalider'
											//echo  ' refCons ='.$refCons;
											 if($refCol == $refCons){
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
														where P.PERIODE like "'.$mois.'"                
													)        
													and F.RefEmploye = "'.$refCons.'"
													order by H.JourTravaille ASC, H.RefDetailFichePointage ;';
													  $resTSEx = mysqli_query($connect,$reqTSEx) or exit(mysqli_error($connect));
													     // on vérifie le contenu de  la requête ;
														if (mysqli_num_rows($resTSEx) == 0){   
															// si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
																print "<script> alert('Aucun enregistrement trouvé!')</script>";
														}
														else{

														$colonne = mysqli_num_fields($resTSEx); //col        
														//$ligne = mysqli_num_rows($resTSEx); //rows

													//    echo "ligne: ".$ligne;
													//    echo ' colonne: '.$colonne;

														// construction du tableau HTML
														
														echo '<div style="max-height: 400px;overflow: scroll;  ">';
														echo '<table border=1>
															<!-- impression des titres de colonnes -->
															 <TR>

																<TD><b>Consultant</b></TD>
																<TD><b>Date</b></TD>
																<TD><b>Code mission</b></TD>
																<TD><b>Code Client</b></TD>
																<TD><b>D&eacute;partement</b></TD>
																<TD><b>Heures</b></TD>            
																<TD><b>Description</b></TD>                                            
																<TD><b>Validation</b></TD>  
																<TD><b>Date de validation</b></TD>   // Ajout de la date de validation dans l IHM                                       
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
																				case 11: echo '<td>'.$row[$j].'</td>';  
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
														echo '</div>';
														//mysql_close();  
														?>
															<br/>
															<form action="exportTSMan.php?daty=<?php echo $mm;?>&collaborateur=<?php echo $collaborateur;?>&taona=<?php echo $taona;?>" method="POST">
																<!--<td><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';-->
																<input type="submit" name="notifTS" id="notifTS" value="Export To Excel" />        
															</form> 
														<?php
														}
													  }
											
												 // echo  ' refCol ='.$refCol;
												// echo  ' refCons ='.$refCons;
										}
									
									//--  TS A VALIDER PAR LE MANGER MODIF CODE LILIANE PAR RODDY : refCol doit être de type String
										if ($refCol == 'avalider')
												{
												//echo 'avalider'; 

												//echo 'On a cliqué sur le bouton '.$mois;

												$truncateT = 'truncate table temptab;';
												$resTrun   = mysqli_query($connect, $truncateT)or exit(mysqli_error($connect));   
												echo '<div style="max-height: 400px;overflow: scroll;  ">';
												

												$reqDatEntre = 'select F.DateEntree as dte, F.RefEmploye '
														. 'from fichepointage F '
														. 'inner join periode P on (P.DateEntree = F.DateEntree) '
														. 'where P.PERIODE like "'.$mois.'"'
														. 'order by F.RefEmploye ASC';
												$rekDteEntre = mysqli_query($connect,$reqDatEntre);
												$resultDteEntre = mysqli_fetch_assoc($rekDteEntre);
												$dteEntre = $resultDteEntre['dte'];                            
												//echo '<br />date '.$dteEntre;   

												$reqRefEmploye = 'select RefEmploye as EMPLO, Profil as pro from employes where Nomuser = "'.$employe.'"';                    
												$rekRefEmp = mysqli_query($connect,$reqRefEmploye);
												$resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
												$refEmploye = $resultRefEmp['EMPLO'];
												$pro = $resultRefEmp['pro'];
												//echo '<br />refEmploye '.$refEmploye;                                   
												//echo '<br />profil: '.$pro;    

												$req = 'select DPT.RefProjet as projet, DPT.Coddept as code '
												. 'from projets P '
												. 'inner join deptprojet DPT on (P.RefProjet = DPT.RefProjet) '
												. 'inner join employes E on (E.RefEmploye = DPT.Respvalid) '
												. 'where DPT.Respvalid = "'.$refEmploye.'" ';
												$reqDept = mysqli_query($connect, $req);

												while ($res = mysqli_fetch_array($reqDept, MYSQLI_BOTH)) {                                
													$reqTS = 'insert into temptab (Colaborateur, Ref, Date, CodeMission, NomClient, Departement, Heures, Description, Validation, '
															. 'RefFP, Depense, Justificatifs ) '
															. 'select concat(E.Prenom, " ", E.NomFamille) as Colaborateur, H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
															. 'H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, '
															. 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, H.Facture as Validation, '
															. 'H.RefDetailFichePointage as RefFP, '
															. 'FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs '                    
															. 'from heuresfichepointage H '
															. 'left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage) '                    
															. 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
															. 'inner join periode Pe on (F.DateEntree = Pe.DateEntree) '
															. 'inner join employes E on (E.RefEmploye = F.RefEmploye) '
															. 'inner join projets P on (P.RefProjet = H.RefProjet) '
															. 'where Pe.PERIODE like "'.$mois.'" '
															. 'and H.RefProjet = "'.$res['projet'].'" '
															. 'and H.Coddept = "'.$res['code'].'" '
															//. 'and H.Facture = "0" '
															. 'and E.RefEmploye <> "'.$refEmploye.'"'
															. 'and E.Profil <> "Associé" '
															. 'ORDER BY H.JourTravaille ASC ;';
													$resTS = mysqli_query($connect, $reqTS)or exit(mysqli_error($connect));   

													//$colonne = mysqli_num_fields($resTS); //col        
													//$ligne = mysqli_num_rows($resTS); //rows            

										//            while ($rowTS = mysqli_fetch_array($resTS, MYSQL_BOTH)) {
										//                $GLOBALS['compte'] = $compte +1;
										//                //echo "<tr onclick=\"showFacturation('".$rowTS['Date']."', '".$rowTS['CodeMission']."', '".$rowTS['RefFP']."')\">";"<tr>";
										//                echo "<tr>";
										//                echo "<td>".$rowTS['Ref']."</td>"
										//                        . "<td>".$rowTS['Colaborateur']."</td>"
										//                        . "<td>".$rowTS['Date']."</td>"
										//                        . "<td>".$rowTS['CodeMission']."</td>"
										//                        . "<td>".$rowTS['NomClient']."</td>"
										//                        . "<td>".$rowTS['Departement']."</td>"
										//                        . "<td>".$rowTS['Heures']."</td>"
										//                        . "<td>".$rowTS['Description']."</td>"
										//                        . "<td>".$rowTS['Depense']."</td>"
										//                        . "<td>".$rowTS['Justificatifs']."</td>";
										//                echo '</tr>';                                    
										//            }
												}
												$reqTim = 'select Ref, Colaborateur, Date, CodeMission, NomClient, Departement, Heures, Description, Validation,  
													Depense, Justificatifs from temptab
													order by Colaborateur ASC, Date, Ref;';
												$resTim = mysqli_query($connect, $reqTim) or exit(mysqli_error($connect));
												if (mysqli_num_rows($resTim) == 0){   
												// si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
													print "<script> alert('Aucun enregistrement trouvé!')</script>";
												}
												else{
													echo '<table border=1>
													<!-- impression des titres de colonnes -->
													 <TR>                
														<TD><b>Nom</b></TD>
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
												
												$colon = mysqli_num_fields($resTim); //col 
												//echo 'colon: '.$colon;
												$linin = 0;   
												$valu = array();
												while ($rowTS = mysqli_fetch_array($resTim, MYSQLI_BOTH)) {            
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
												echo '</div>';
												?>
													<br/>
													<form action="exportTSMan.php?daty=<?php echo $mm;?>&collaborateur=<?php echo $collaborateur;?>&taona=<?php echo $taona;?>" method="POST">
														<!--<td><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';-->
														<input type="submit" name="notifTS" id="notifTS" value="Export To Excel" />        
													</form> 
												<?php
												}
											
											//--  FIN TS A VALIDER PAR LE MANGER MODIF CODE LILIANE PAR RODDY			
															
										}
										
										
										//CODE LILIANE => TS A VALIDER PAR LE MANAGER 						LEGENDE // // ce sont des commentaires

                                    // else{
                                      //  //echo 'avalider'; 

                                      //  //echo 'On a cliqué sur le bouton '.$mois;

                                        // $truncateT = 'truncate table temptab;';
                                        // $resTrun   = mysqli_query($connect, $truncateT)or exit(mysqli_error($connect));   
                                        // echo '<div style="max-height: 400px;overflow: scroll;  ">';
                                        

                                        // $reqDatEntre = 'select F.DateEntree as dte, F.RefEmploye '
                                                // . 'from fichepointage F '
                                                // . 'inner join periode P on (P.DateEntree = F.DateEntree) '
                                                // . 'where P.PERIODE like "'.$mois.'"'
                                                // . 'order by F.RefEmploye ASC';
                                        // $rekDteEntre = mysqli_query($connect,$reqDatEntre);
                                        // $resultDteEntre = mysqli_fetch_assoc($rekDteEntre);
                                        // $dteEntre = $resultDteEntre['dte'];                            
                                     //   //echo '<br />date '.$dteEntre;   

                                        // $reqRefEmploye = 'select RefEmploye as EMPLO, Profil as pro from employes where Nomuser = "'.$employe.'"';                    
                                        // $rekRefEmp = mysqli_query($connect,$reqRefEmploye);
                                        // $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                                        // $refEmploye = $resultRefEmp['EMPLO'];
                                        // $pro = $resultRefEmp['pro'];
                                     //   //echo '<br />refEmploye '.$refEmploye;                                   
                                      //  //echo '<br />profil: '.$pro;    

                                        // $req = 'select DPT.RefProjet as projet, DPT.Coddept as code '
                                        // . 'from projets P '
                                        // . 'inner join deptprojet DPT on (P.RefProjet = DPT.RefProjet) '
                                        // . 'inner join employes E on (E.RefEmploye = DPT.Respvalid) '
                                        // . 'where DPT.Respvalid = "'.$refEmploye.'" ';
                                        // $reqDept = mysqli_query($connect, $req);

                                        // while ($res = mysqli_fetch_array($reqDept, MYSQLI_BOTH)) {                                
                                            // $reqTS = 'insert into temptab (Colaborateur, Ref, Date, CodeMission, NomClient, Departement, Heures, Description, Validation, '
                                                    // . 'RefFP, Depense, Justificatifs ) '
                                                    // . 'select concat(E.Prenom, " ", E.NomFamille) as Colaborateur, H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
                                                    // . 'H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, '
                                                    // . 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, H.Facture as Validation, '
                                                    // . 'H.RefDetailFichePointage as RefFP, '
                                                    // . 'FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs '                    
                                                    // . 'from heuresfichepointage H '
                                                    // . 'left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage) '                    
                                                    // . 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
                                                    // . 'inner join periode Pe on (F.DateEntree = Pe.DateEntree) '
                                                    // . 'inner join employes E on (E.RefEmploye = F.RefEmploye) '
                                                    // . 'inner join projets P on (P.RefProjet = H.RefProjet) '
                                                    // . 'where Pe.PERIODE like "'.$mois.'" '
                                                    // . 'and H.RefProjet = "'.$res['projet'].'" '
                                                    // . 'and H.Coddept = "'.$res['code'].'" '
                                               //     //. 'and H.Facture = "0" '
                                                    // . 'and E.RefEmploye <> "'.$refEmploye.'"'
                                                    // . 'and E.Profil <> "Associé" '
                                                    // . 'ORDER BY H.JourTravaille ASC ;';
                                            // $resTS = mysqli_query($connect, $reqTS)or exit(mysqli_error($connect));   

                                          //  //$colonne = mysqli_num_fields($resTS); //col        
                                            //$ligne = mysqli_num_rows($resTS); //rows            

							   //     //            while ($rowTS = mysqli_fetch_array($resTS, MYSQL_BOTH)) {
							   //     //                $GLOBALS['compte'] = $compte +1;
							   //     //               //echo "<tr onclick=\"showFacturation('".$rowTS['Date']."', '".$rowTS['CodeMission']."', '".$rowTS['RefFP']."')\">";"<tr>";
                                //     //              echo "<tr>";
                                //     //          echo "<td>".$rowTS['Ref']."</td>"
                                //     //                        . "<td>".$rowTS['Colaborateur']."</td>"
                                //     //                       . "<td>".$rowTS['Date']."</td>"
                                //     //                       . "<td>".$rowTS['CodeMission']."</td>"
                                //     //                       . "<td>".$rowTS['NomClient']."</td>"
                                //     //                       . "<td>".$rowTS['Departement']."</td>"
                                //     //                       . "<td>".$rowTS['Heures']."</td>"
                                //     //                       . "<td>".$rowTS['Description']."</td>"
                                //     //                      . "<td>".$rowTS['Depense']."</td>"
                                //     //                       . "<td>".$rowTS['Justificatifs']."</td>";
                                //     //               echo '</tr>';                                    
                                //     //           }
                                    //    }
                                        // $reqTim = 'select Ref, Colaborateur, Date, CodeMission, NomClient, Departement, Heures, Description, Validation,  
                                            // Depense, Justificatifs from temptab
                                            // order by Colaborateur ASC, Date, Ref;';
                                        // $resTim = mysqli_query($connect, $reqTim) or exit(mysqli_error($connect));
                                        // if (mysqli_num_rows($resTim) == 0){   
                                      //  // si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
                                            // print "<script> alert('Aucun enregistrement trouvé!')</script>";
                                        // }
                                        // else{
                                            // echo '<table border=1>
                                            // <!-- impression des titres de colonnes -->
                                             // <TR>                
                                                // <TD><b>Nom</b></TD>
                                                // <TD><b>Date</b></TD>
                                                // <TD><b>Code mission</b></TD>
                                                // <TD><b>Code Client</b></TD>
                                                // <TD><b>D&eacute;partement</b></TD>
                                                // <TD><b>Heures</b></TD>            
                                                // <TD><b>Description</b></TD>   
                                                // <TD><b>Validation</b></TD>   
                                                // <TD><b>Dépense</b></TD>                                            
                                                // <TD><b>Justificatifs</b></TD>     
                                            // </TR>';
                                        
                                        // $colon = mysqli_num_fields($resTim); //col 
                                       // //echo 'colon: '.$colon;
                                        // $linin = 0;   
                                        // $valu = array();
                                        // while ($rowTS = mysqli_fetch_array($resTim, MYSQLI_BOTH)) {            
                                            // echo '<tr>';  
                                            // for($j=0; $j < $colon ; $j++){            
                                                // if($j == 0){
                                                    // $valu[$linin] = array($rowTS[$j]);
                                                    // if($valu[$linin-1][$j] == $valu[$linin][$j]){                    
                                                     //   //echo '<td>'.$valu[$linin][$j].' biiii '.$linin.'</td>';  
                                                        // for($j=0; $j < $colon ; $j++){                     
                                                            // switch($j){                             
                                                                // case $j > 1 && $j <=8: echo '<td style="border:none"></td>'; 
                                                                    // break;                           
                                                                // case 9: echo '<td>'.$rowTS[$j].'</td>';  
                                                                    // break;
                                                                // case 10: echo '<td>'.$rowTS[$j].'</td>';  
                                                                    // break;
                                                            // }
                                                        // }
                                                    // }
                                 //   //                else{
                                  //  //                    echo '<td>'.$valu[$linin][$j].'</td>';                                    
                                 //   //                }                
                                                // }
                                                // else{

                                                    // for($j=1; $j < $colon ; $j++){
                                                        // switch($j){                             
                                                            // case $j >= 1 && $j <=7: echo '<td>'.$rowTS[$j].'</td>';  
                                                                // break;                           
                                                            // case 8: if($rowTS['Validation']==1){
                                                                        // echo '<td>Validé</td>';  
                                                                    // }
                                                                    // else if($rowTS['Validation']==0){
                                                                        // echo '<td>Non Validé</td>';  
                                                                    // }                                
                                                                // break;
                                                            // case 9: echo '<td>'.$rowTS[$j].'</td>';  
                                                                // break;
                                                            // case 10: echo '<td>'.$rowTS[$j].'</td>';  
                                                                // break;
                                                        // }
                                                    // }

                                                  //  //echo '<td>'.$rowTS[$j].'</td>';             
                                                // }            
                                            // }

                                            // echo '</tr>';
                                            // $linin = $linin + 1;                                    
                                        // }

                                        // echo '</TABLE>';
                                        // echo '</div>';
                                        ?>
                                       <!---   <!--  <br/>
                                            <form action="exportTSMan.php?daty=<?php //echo $mm;?>&collaborateur=<?php //echo $collaborateur;?>&taona=<?php// echo $taona;?>" method="POST">
                                               <!--  <!--<td><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';-->
                                         <!--   <!--    <input type="submit" name="notifTS" id="notifTS" value="Export To Excel" />        
                                            </form> 
                                        <?php
                                        // }
                                    // }   
									
									//FIN CODE LILIANE => TS A VALIDER PAR LE MANAGER
									//}
									
                                }
                            }
                            else if(isset($_POST['export']) && $prof == 'Associé'){
                                if(empty($_POST['daty']) || empty($_POST['coll'])){
                                    echo '<font color="red"><b><br/>Veuillez s&eacute;lectionner la période et le Collaborateur.</b></font>';
                                }
                                else{
                                    $datyChoisit = $_POST['daty'];                           
                                    $datyChoisit = changeDate(str_replace("/", "-", $datyChoisit));
                                    
                                    $dateNow = $datyChoisit;                            
                                
                                    $date_exp = explode("-", $dateNow);
                                    $jour   = $date_exp[2];
                                    $moiss  = $date_exp[1];
                                    $taona  = $date_exp[0]; 
                                    $mm = moy($moiss);
                                    
//                                    echo 'mm: '.$mm;

                                    $mois = "%".moy($moiss)." ".$taona."%";
                                    
//                                    $reqYear  = 'select YEAR(CURRENT_DATE()) as taona ;';
//                                    $resYear  = mysqli_query($connect, $reqYear) or exit(mysqli_error($connect));
//                                    $resTaona = mysqli_fetch_assoc($resYear);
//                                    $taona = $resTaona['taona'];
//                                    
//                                    $mm = $_POST['periode'];
//                                    $mois = "%".$_POST['periode']." ".$taona."%";
                                    $collaborateur = $_POST['coll']; 
//                                    echo 'mois '.$mois .' col ' .$collaborateur;
                                    
                                    if($collaborateur == 'avalider'){
        
                                    $truncateTass = 'truncate table tempvalidass;';
                                    $resTrun   = mysqli_query($connect, $truncateTass)or exit(mysqli_error($connect));  
                                    
                                    echo '<div style="max-height: 400px;overflow: scroll;  ">';
                                    echo '<table border=1>';
                                    

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
                                            . 'E.Prenom as prenom '
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
                                                . 'select concat(Prenom, " ", NomFamille) as Colaborateur, H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
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
                                    if (mysqli_num_rows($resTimAss) == 0){   
                                        // si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
                                            print "<script> alert('Aucun enregistrement trouvé!!')</script>";
                                    }
                                    else{
                                        echo '   <!-- impression des titres de colonnes -->
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
                                    echo '</div>';
                                    ?>
                                        <br/>
                                        <form action="exportTSAss.php?daty=<?php echo $mm;?>&collaborateur=<?php echo $collaborateur;?>&taona=<?php echo $taona;?>" method="POST">
                                            <!--<td><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';-->
                                            <input type="submit" name="notifTS" id="notifTS" value="Export To Excel" />        
                                        </form> 
                                    <?php
                                    }
                                }
                                else{
                                    //echo 'col'.$collaborateur;
//                                    $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Prenom = "'.$collaborateur.'"';                    
//                                    $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
//                                    $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
//                                    $refEmploye = $resultRefEmp['EMPLO'];
                                    
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
                                            print "<script> alert('Aucun enregistrement trouvé!!')</script>";
                                    } 
                                    else{
                                    $colonne = mysqli_num_fields($resTSEx); //col        
                                    //$ligne = mysqli_num_rows($resTSEx); //rows

                                //    echo "ligne: ".$ligne;
                                //    echo ' colonne: '.$colonne;

                                    // construction du tableau HTML
                                    echo '<div style="max-height: 400px;overflow: scroll;  ">';
                                    echo '<table border=1>
                                        <!-- impression des titres de colonnes -->
                                         <TR>
                                            <TD><b>Consultants</b></TD>
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
//                                                                    echo '<td>'.$row['Validation'].'</td>';
                                                                }
                                                                else if($row['Validation']==0){
                                                                    echo '<td>Non Validé</td>';
//                                                                    echo '<td>'.$row['Validation'].'</td>';
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
                                    echo '</div>';
                                    ?>
                                        <br/>
                                        <form action="exportTSAss.php?daty=<?php echo $mm;?>&collaborateur=<?php echo $collaborateur;?>&taona=<?php echo $taona;?>" method="POST">
                                            <!--<td><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';-->
                                            <input type="submit" name="notifTS" id="notifTS" value="Export To Excel" />        
                                        </form> 
                                    <?php
                                    //mysql_close(); 
                                }
                                }
                                }
                            }
                        ?>
                        
                    </div>               
                    <!-- bottom -->
                </div>
            </center>
        </div>
    </div>
  
      <script type="text/javascript">
        $(document).ready(function() {
//            var col = '<?php echo $collaborateur;?>';
//            var mois = '<?php echo $mm;?>';
//            document.getElementById('coll').value = col;
//            document.getElementById('periode').value = mois;
            
            $("#daty").datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
//                format: "yyyy-mm-dd",
                //daysOfWeekDisabled: [0, 6],
                todayHighlight: true,
                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
//                dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                firstDay: 1,
                monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                changeMonth: true,
                changeYear: true,
                //endDate: 'today'
                onClose: function (dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                },
                beforeShow: function (input, inst) {
                    if ((datestr = $(this).val()).length > 0) {
                        actDate = datestr.split('/');
                        year = actDate[1];
                        month = actDate[0] - 1;
                        $(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
                       // $(this).datepicker('setDate', new Date(year, month, 1)); // Modification de la date plus  tard    => MODIF RODDY
                    }
                }                                            
            }); 
            $("#daty").focus(function () {
                $(".ui-datepicker-calendar").hide();
                $("#ui-datepicker-div").position({
                    my: "center top",
                    at: "center bottom",
                    of: $(this)
                });
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
