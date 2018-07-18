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



<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Alerte Facturation</title>
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
	<!-- DESIGN CSS -->
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
            
            #aaaa{
                border-collapse: collapse;
                border-color: gray;
            }
            
            #deco{
                    float: right;
            }	
            
            .daty{
                width: 80px;
                text-align: center;
            }
            .montant{
                width: 150px;
                /*text-align: center;*/
            }
            
/*            table{
                border-collapse: collapse;
                
            }
            td{
                border: 1px solid black;
                border-style: dotted;
                border-color: #1c4e63;
            }*/
        </style>
		<!-- FIN DESIGN CSS -->
    </head>
    <body>

  <!-- top -->
    <?php if (login_check($mysqli) == true) : ?>
        <div id="header">            
            
            <?php
			//AUTHENTIFICATION DE L'UTILSATEUR SELON LA SESSION EN COURS
                $Nomuser      = $_SESSION['username'];                                
                $reky         = 'select Prenom as prenom, NomFamille as nom from employes '
                    . 'where Nomuser = "'.$Nomuser.'"';
                $rekPrenom    = mysqli_query($connect,$reky);
                $resultPrenom = mysqli_fetch_assoc($rekPrenom);
                $prenom       = $resultPrenom['prenom'];
                $nom          = $resultPrenom['nom'];
			//FIN AUTHENTIFICATION DE L'UTILSATEUR SELON LA SESSION EN COURS
            ?>
            
            <div class="bg-help">
                <div class="inBox">
                    <center>
					<!-- ICI LE TEXT DEFILANT-->
                    <MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1></MARQUEE> 
					<!-- FIN LE TEXT DEFILANT-->
					
                   <!-- <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                    -->
                    <hr class="hidden" />
                    </center>
                </div>
            </div>
        </div>   
		<!--BOUTON DE DECONNEXION -->
        <a href="../../logout.php" class="button" title="Deconnexion"><span class="delete">Deconnexion</span></a>
		<!--FIN DE DECONNEXION -->
        <?php
            $req     = 'select Profil as profily from employes '
                . 'where Nomuser = "'.$Nomuser.'"';
            $rekProf = mysqli_query($connect,$req);
            $resultProf = mysqli_fetch_assoc($rekProf);
            $prof = $resultProf['profily'];
        ?>

    <div id="main">
	<!--INTERFACE POUR ASSOCIE ET MANAGER -->
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
                       <!-- </ul>
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
                        <a class='tab selected' href='index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>   
                        <ul>
                            <li><a href='./alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a class='tab selected' href='./alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../exportation/index.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>ALERTE FACTURATION</center></b></font>
                    <br/>
                    </nav>
			<!--FIN INTERFACE POUR ASSOCIE ET MANAGER -->
                <?php
            } 
			// INTERFACE DAF
            else if($prof == 'DAF'){
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
						
					<li><a href="../mission/index.php">MISSIONS</a>
						<ul>
							<li><a href="../mission/nouvellemission.php"><b>Nouvelle Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="../mission/missioncode.php"><b>Fiche de Mission</b></a></li>
							<li><a href="../mission/missiondept.php"><b>Mission par Départ.</b></a></li>
						</ul>
					</li>
					<li><a href="./index.php">ALERT</a>
						<ul>
							<li><a href="./alertcontrat.php"><b>Contrat non signé</b> <img src="../images/erreur.gif" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="./alertfacturation.php"><b>Alerte Facturation</b><img src="../images/Warning.gif" border="0" width="15" height="15" align="absmiddle"></a></li>
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
                        <a href='../client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>          
                            <li><a class='' href='../client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='../client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='../client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>                    
                    <div>    
                        <a href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>                                    
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Fiche de Mission</span></a></li> 
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                      <!--  </ul>
                    </div>                                        
                    <div>                                        
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>
                        <ul>
                            <li><a href='./alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a class='tab selected' href='./alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a href='../exportation/exportation.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <div>    
                        <a class='tab' href='../ts/vuets.php'><span style="width: 100px; text-align:center;">VUE TS</span></a>                                                         
                    </div> 
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/>
                    <font style=" color: black"><b><center>ALERTE FACTURATION</center></b></font>
                    <br/>
                    </nav>
                <?php
			// FIN INTERFACE DAF
            }                        
        ?>
                      
        <div id="container" >                                    
                <div>
                    <!-- /top -->                    
                    <!-- GESTION DE L'INTERFACE ALERTE FACTURATION du script alertefacturation.php--> 
                        <center>
                        <table border="1" style=" border-color: red">
                            <tr>
                                <td>
                                    <ul>
                                    <table>
                                        <tr><strong>Dates d'échéance à moins d'une semaine</strong></tr>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <form name="missionDept" method="post">	                                                        
                                                        <label for="code_dept"></label>							
                                                        <select name="code_dept" id="code_dept">									
                                                            <!--<option>Sélectionnez le département</option>-->
                                                            <option value="" disabled="" selected style="display:none">Sélectionnez le département</option>
                                                            <option>TOUS LES DEPARTEMENTS</option>
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
                                        <tr><b>Dates d'échéance dépassées</b></tr>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <form name="missionDept" method="post">	                                                        
                                                        <label for="code_dept"></label>							
                                                        <select name="code_dept" id="code_dept">									
                                                            <!--<option>Sélectionnez le département</option>-->
                                                            <option value="" disabled="" selected style="display:none">Sélectionnez le département</option>
                                                            <option>TOUS LES DEPARTEMENTS</option>
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
                                        <tr><b>Liste des factures impayées</b></tr>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <form name="missionDept" method="post">	                                                        
                                                        <label for="code_dept"></label>							
                                                        <select name="code_dept" id="code_dept">									
                                                            <!--<option>Sélectionnez le département</option>-->
                                                            <option value="" disabled="" selected style="display:none">Sélectionnez le département</option>
                                                            <option>TOUS LES DEPARTEMENTS</option>
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
                                
                                $reqFacture = 'select F.Echeance as echeance, Idauto
                                from facturation F                                
                                where F.Echeance is not null
                                order by Echeance;';
                                $recFacture = mysqli_query($connect,$reqFacture);
                                
                                $semaine = array();  
                                $echues = array();
                                while($rowFact = mysqli_fetch_array($recFacture, MYSQLI_BOTH)){
                                    //afficheFacturationSemaine($reqFacture);
                                    $dateEcheance = $rowFact[0];
                                    $dateNow = date('Y-m-d');
                                    $dif = nbJours($dateEcheance, $dateNow);

            //                        echo '<br/>$dateEcheance '.$dateEcheance;
            //                        echo '<br/>$dateNow '.$dateNow;
            //                        echo '<br/>$dif '.$dif;

                                    if(($dif >= 0) and ($dif <= 7)) {
                                        //afficheFacturationSemaine($reqFacture);
                                        //echo 'yep';
                                        $semaine[] = $rowFact[1];
                                    }
                                    else if($dif > 7){}
                                    else{
                                        //afficheFacturationEchues($reqFacture);
                                        //echo 'nope';
                                        $echues[] = $rowFact[1];
                                    }
                                }
                                
                                if(isset($_POST['selectionner1'])){
                                    if($_POST['code_dept'] == 'TOUS LES DEPARTEMENTS'){
                                        echo '<div id="aaaa"><br/><strong><font color="green-blue"><center>Dates d\'échéance à moins d\'une semaine de '.$dept.'</center></font></strong><br/></div>';                                        
                                    }
                                    else{
                                        echo '<div id="aaaa"><br/><strong><font color="green-blue"><center>Dates d\'échéance à moins d\'une semaine du département '.$dept.'</center></font></strong><br/></div>';                                        
                                    }
                                }
                                else if(isset($_POST['selectionner2'])){
                                    if($_POST['code_dept'] == 'TOUS LES DEPARTEMENTS'){
                                        echo '<div id="aaaa"><br/><strong><font color="green-blue"><center>Dates d\'échéance dépassées de '.$dept.'</center></font></strong><br/></div>';                                        
                                    }
                                    else{
                                        echo '<div id="aaaa"><br/><strong><font color="green-blue"><center>Dates d\'échéance dépassées du département '.$dept.'</center></font></strong><br/></div>';                                        
                                    }
                                }
                                else if(isset($_POST['selectionner3'])){
                                    if($_POST['code_dept'] == 'TOUS LES DEPARTEMENTS'){
                                        echo '<div id="aaaa"><br/><strong><font color="green-blue"><center>Liste des factures impayées de '.$dept.'</center></font></strong><br/></div>';                                        
                                    }
                                    else{
                                        echo '<div id="aaaa"><br/><strong><font color="green-blue"><center>Liste des factures impayées du département '.$dept.'</center></font></strong><br/></div>';                                        
                                    }
                                }
                                
                                    echo '<div id="dp" style="max-height: 500px;overflow: scroll; top: 500px">';
                                    echo '<table id="aaaa" border="1">';
                    
                                    echo '<tr id="aaaa">';
                                        echo '<td class="daty" id="aaaa"><b><center>Date Echéance</center></b></td>';
                                        echo '<td class="client" id="aaaa"><b><center>Nom du client</center></b></td>'; 
                                        echo '<td class="mission" id="aaaa"><b><center>Mission</center></b></td>';                                                                               
//                                        echo '<td class="type" id="aaaa"><b>Type</b></td>';
                                        echo '<td class="type" id="aaaa"><b><center>Honoraire Débours</center></b></td>';
//                                        echo '<td class="facture" id="aaaa"><b>Libellé Facture</b></td>';
                                        echo '<td class="facture" id="aaaa"><b><center>Intitulé</center></b></td>';
//                                        echo '<td class="contrat" id="aaaa"><b>% Contrat</b></td>';
                                        echo '<td class="devise" id="aaaa"><b><center>Devise</center></b></td>';
                                        echo '<td class="montant" id="aaaa"><b><center>Montant Previsionnel</center></b></td>';
                                        echo '<td class="daty" id="aaaa"><b><center>Date facturation</center></b></td>';
//                                        echo '<td class="montant" id="aaaa"><b>Montant fact.</b></td>';
//                                        echo '<td class="numFact" id="aaaa"><b>Num. fact.</b></td>';
//                                        echo '<td class="daty" id="aaaa"><b>P. Prév.</b></td>';
                                        echo '<td class="daty" id="aaaa"><b><center>Date Paiement</center></b></td>';
                                        echo '<td class="montant" id="aaaa"><b><center>Montant Payé</center></b></td>';
//                                        echo '<td class="montant" id="aaaa"><b>Taux / Ar</b></td>';

                            //        while ($fieldinfo=mysqli_fetch_field($tesita)){
                            //                echo '<td><b>'.$fieldinfo->name.'</b></td>';
                            //        }
                                    echo '</tr>';

                                
                                if(isset($_POST['selectionner1'])){                                     
                                    foreach($semaine as $val){                        
                                        //echo 'tab '.$val.'<br />'; 
                                        if($_POST['code_dept'] == 'TOUS LES DEPARTEMENTS'){
                                            $reqSemaine = 'select F.Echeance as echeance, C.NomSociete, F.RefProjet, F.Typefac, F.Libelle, F.Monnaie, F.Montant, F.DateEnvoiFacture, F.DatePaiement, F.MontantReel
                                            from facturation F
                                            inner join projets P on (P.RefProjet = F.RefProjet)  
                                            inner join deptprojet D on (D.RefProjet = P.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where F.Idauto = "'.$val.'"
                                                and F.Afacturer = 0                                                
                                            order by Echeance;';
                                        }
                                        else{
                                            $reqSemaine = 'select F.Echeance as echeance, C.NomSociete, F.RefProjet, F.Typefac, F.Libelle, F.Monnaie, F.Montant, F.DateEnvoiFacture, F.DatePaiement, F.MontantReel
                                            from facturation F
                                            inner join projets P on (P.RefProjet = F.RefProjet)  
                                            inner join deptprojet D on (D.RefProjet = P.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where D.Coddept = "'.$codeDept.'"
                                            and F.Idauto = "'.$val.'"
                                                and F.Afacturer = 0                                                
                                            order by Echeance;';
                                        }
                                        $reqSem = mysqli_query($connect, $reqSemaine) or exit(mysqli_error($connect));
                                        $ligne      = mysqli_num_rows($reqSem);                                        
                                        $colonne = mysqli_num_fields($reqSem); //col                                        
                                        
                                        while($row = mysqli_fetch_array($reqSem, MYSQLI_BOTH)){
                                            echo '<tr>';
                                                for($j=0; $j < $colonne ; $j++){
                                                    switch($j){
                                                        case 0: 
                                                            echo '<td class="daty">'.dateChange($row[$j]).'</td>';break;
                                                        case 1: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 2:
                                                            echo '<td><a href="../mission/missionfiltre.php?test='.str_replace('+', '%2B', $row[$j]).'">'.$row[$j].'</a></td>';break;
                                                        case 3: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 4: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 5: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 6: 
                                                            echo '<td class="montant">'.number_format($row[$j], 2, ".", " ").'</td>';break;                                                        
                                                        case 7: 
                                                            echo '<td class="daty">'.dateChange($row[$j]).'</td>';break;
                                                        case 8: 
                                                            echo '<td class="daty">'.dateChange($row[$j]).'</td>';break;                                                                                                                                                                        
                                                        case 9: 
                                                            echo '<td class="montant">'.number_format($row[$j], 2, ".", " ").'</td>';break;                                                                                                               
                                                    }                                                    
                                                }
                                            echo '</tr>';                                        
                                        }                                        
                                    }

                                    echo '</table>';
                                }
                                else if(isset($_POST['selectionner2'])){
                                    foreach($echues as $valy){
                                        if($_POST['code_dept'] == 'TOUS LES DEPARTEMENTS'){
                                            $reqSemaine = 'select F.Echeance as echeance, C.NomSociete, F.RefProjet, F.Typefac, F.Libelle, F.Monnaie, F.Montant, F.DateEnvoiFacture, F.DatePaiement, F.MontantReel
                                            from facturation F
                                            inner join projets P on (P.RefProjet = F.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where F.Idauto = "'.$valy.'"
                                                and F.Afacturer = 0
                                                and F.Echeance > "2014-12-31"
                                            order by Echeance;';
                                        }
                                        else{
                                            $reqSemaine = 'select F.Echeance as echeance, C.NomSociete, F.RefProjet, F.Typefac, F.Libelle, F.Monnaie, F.Montant, F.DateEnvoiFacture, F.DatePaiement, F.MontantReel
                                            from facturation F
                                            inner join projets P on (P.RefProjet = F.RefProjet)
                                            inner join deptprojet D on (D.RefProjet = P.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where D.Coddept = "'.$codeDept.'"
                                            and F.Idauto = "'.$valy.'"
                                                and F.Afacturer = 0
                                                and F.Echeance > "2014-12-31"
                                            order by Echeance;';
                                        }
                                        //echo 'tab '.$val.'<br />';                                        
                                        $reqSem = mysqli_query($connect, $reqSemaine) or exit(mysqli_error($connect));
                                        $colonne = mysqli_num_fields($reqSem); //col
                                        while($row = mysqli_fetch_array($reqSem, MYSQLI_BOTH)){
                                            echo '<tr>';
                                                for($j=0; $j < $colonne ; $j++){
                                                    switch($j){
                                                        case 0: 
                                                            echo '<td class="daty">'.dateChange($row[$j]).'</td>';break;
                                                        case 1: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 2:
                                                            echo '<td><a href="../mission/missionfiltre.php?test='.str_replace('+', '%2B', $row[$j]).'">'.$row[$j].'</a></td>';break;
                                                        case 3: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 4: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 5: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 6: 
                                                            echo '<td class="montant">'.number_format($row[$j], 2, ".", " ").'</td>';break;                                                        
                                                        case 7: 
                                                            echo '<td class="daty">'.dateChange($row[$j]).'</td>';break;
                                                        case 8: 
                                                            echo '<td class="daty">'.dateChange($row[$j]).'</td>';break;                                                                                                                                                                        
                                                        case 9: 
                                                            echo '<td class="montant">'.number_format($row[$j], 2, ".", " ").'</td>';break;
                                                    }                                                    
                                                }
                                            echo '</tr>';
                                        }
                                    }
                                }
                                else if(isset($_POST['selectionner3'])){
                                    foreach($echues as $valy){
                                        if($_POST['code_dept'] == 'TOUS LES DEPARTEMENTS'){
                                            $reqSemaine = 'select F.Echeance as echeance, C.NomSociete, F.RefProjet, F.Typefac, F.Libelle, F.Monnaie, F.Montant, F.DateEnvoiFacture, F.DatePaiement, F.MontantReel
                                            from facturation F
                                            inner join projets P on (P.RefProjet = F.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where F.Idauto = "'.$valy.'"
                                                and F.Afacturer = 1    
                                                and F.DatePaiement is NULL                                               
                                                and F.MontantReel is NULL
                                            order by Echeance;';
                                        }
                                        else{
                                            $reqSemaine = 'select F.Echeance as echeance, C.NomSociete, F.RefProjet, F.Typefac, F.Libelle, F.Monnaie, F.Montant, F.DateEnvoiFacture, F.DatePaiement, F.MontantReel
                                            from facturation F
                                            inner join projets P on (P.RefProjet = F.RefProjet)
                                            inner join deptprojet D on (D.RefProjet = P.RefProjet)
                                            inner join client C on (C.RefClient = P.RefClient)
                                            where D.Coddept = "'.$codeDept.'"
                                            and F.Idauto = "'.$valy.'"
                                                and F.Afacturer = 1                                                
                                                and F.DatePaiement is NULL                                               
                                                and F.MontantReel is NULL
                                            order by Echeance;';
                                        }
                                        //echo 'tab '.$val.'<br />';                                        
                                        $reqSem = mysqli_query($connect, $reqSemaine) or exit(mysqli_error($connect));
                                        $colonne = mysqli_num_fields($reqSem); //col
                                        while($row = mysqli_fetch_array($reqSem, MYSQLI_BOTH)){
                                            echo '<tr>';
                                                for($j=0; $j < $colonne ; $j++){
                                                    switch($j){
                                                        case 0: 
                                                            echo '<td class="daty">'.dateChange($row[$j]).'</td>';break;
                                                        case 1: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 2:
                                                            echo '<td><a href="../mission/missionfiltre.php?test='.str_replace('+', '%2B', $row[$j]).'">'.$row[$j].'</a></td>';break;
                                                        case 3: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 4: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 5: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 6: 
                                                            echo '<td class="montant">'.number_format($row[$j], 2, ".", " ").'</td>';break;                                                        
                                                        case 7: 
                                                            echo '<td>'.$row[$j].'</td>';break;
                                                        case 8: 
                                                            echo '<td class="daty">'.dateChange($row[$j]).'</td>';break;                                                                                                                                                                        
                                                        case 9: 
                                                            echo '<td class="montant">'.number_format($row[$j], 2, ".", " ").'</td>';break;
                                                    }                                                    
                                                }
                                            echo '</tr>';
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                        </center>  
					<!-- FIN GESTION DE L'INTERFACE ALERTE FACTURATION	-->					
                    </div>               
                    <!-- bottom -->
                </div>
            
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {          
          
        });
    </script>
	<!-- /bottom -->
        
            <?php else : ?>
            <p>
                <span>Vous n’avez pas les autorisations n&eacute;cessaires pour acc&eacute;der &agrave; cette page.</span> Please <a href="../../index.php">login</a>.
            </p>
        <?php endif; ?>  
    </body>
</html>

