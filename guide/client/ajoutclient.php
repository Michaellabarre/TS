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
        <title>Ajout Nouveau Client</title>
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
		<link   type="text/css" rel="stylesheet" href="../helpers/media/style.css?v=1783"/>

        <!-- daypilot libraries -->
        <script src="../js/daypilot-all.min.js?v=1783" type="text/javascript"></script>
   <!-- DESIGN CSS -->
        <style type="text/css">   
		fieldset{
				width:250px;
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
            textarea{
                width: 198px;
                height: 16px;
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
            
        </style>
		<!-- FIN DESIGN CSS -->
	<!-- /head -->
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
                
                $reqRefEmp = 'select RefEmploye as REF from employes '
                        . 'where Nomuser = "'.$Nomuser.'"';
                $rekRefEmp = mysqli_query($connect,$reqRefEmp);              						
                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                $refEmp = $resultRefEmp['REF']; 
				//FIN AUTHENTIFICATION DE L'UTILSATEUR SELON LA SESSION EN COURS
            ?>
            
            <div class="bg-help">
                <div class="inBox">
                    <center>
					<!-- ICI LE TEXTE DEFILANT-->
                    <MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1></MARQUEE>
					<!-- FIN TEXTE DEFILANT-->
					
                   <!-- <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion" /></font></a>                    -->
                    <hr class="hidden" />
                    </center>
                </div>
            </div>
        </div>   
		<!--BOUTON DE DECONNEXION -->
        <a href="../../logout.php" class="button" title="Deconnexion"><span class="delete">Deconnexion</span></a>
		<!--FIN BOUTON DE DECONNEXION -->
        <?php
            $req     = 'select Profil as profily from employes '
                . 'where Nomuser = "'.$Nomuser.'"';
            $rekProf = mysqli_query($connect,$req);
            $resultProf = mysqli_fetch_assoc($rekProf);
            $prof = $resultProf['profily'];
        ?>

    <div id="main">
        <?php
		// GESTION INTERFACE ASSOCIE et MANAGER
            if($prof == 'Associé' or $prof == 'Manager'){
                ?>
                <!-- tabs -->
				<ul id="nav">
					<li class="current"><a href="../index.php">GUIDE</a></li><!-- n1 -->

					  <li><a href="./index.php">CLIENTS</a><!-- n1 -->
						<ul>
							<li><a href="./ajoutclient.php"><b>Nouveau lient </b><img src="../images/addusers.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
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
							<li><a href="../consultant/listeconsultexterne.php"><b>Liste Cons. Externes</b><img src="../images/membree.png" border="0" width="15" height="15" align="absmiddle"></a></li>
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
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a class='tab selected' href='./ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='./listeclient.php'><span>Liste des Clients</span></a></li>                        
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
                  <!--      </ul>
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

-->					
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>CREATION D'UN NOUVEAU CLIENT</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
				// FIN GESTION INTERFACE ASSOCIE et MANAGER
            }
            else if($prof == 'DAF'){
				//  INTERFACE DAF
                ?>
				
				<ul id="nav">
					<li class="current"><a href="../index.php">GUIDE</a></li><!-- n1 -->

					  <li><a href="./index.php">CLIENTS</a><!-- n1 -->
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
				
               <!-- <nav class="menu">  
                    <div>                                        
                        <a href='../index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>                      
                            <li><a class='tab selected' href='./ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a class='' href='./listeclient.php'><span>Liste des Clients</span></a></li>                        
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
                     <!--   </ul>
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
                    <br/><br/>
                    <font style=" color: black"><b><center>LISTE DES CLIENTS</center></b></font>
                    <br/>
                    </nav>
                <?php
				//  FIN INTERFACE DAF
            }
            else if($prof == 'Assistant(e) Manager'  ){
                ?>
                <!-- tabs -->
				<!-- INTERFACE ASSISTANT MANAGER -->
				
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
					<li><a href="../exportation/export_TS_Cons.php">EXPORTATION</a></li>
					</ul>
                <!--    <nav class="menu">  
                    <div>                                        
                        <a href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a class='tab selected' href='ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='listeclient.php'><span>Liste des Clients</span></a></li>                        
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
                            <a class='tab' href='../exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>     -->           
                        <br/><br/>
                        <font style=" color: black"><b><center>CREATION D'UN NOUVEAU CLIENT</center></b></font>
                        <br/>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <!--</nav>
                    <!-- /tabs --> 
					
				<!-- FIN INTERFACE ASSISTANT MANAGER -->
				
                <?php
				
            }
        ?>
                      
        <div id="container" >            
            
            
                <div>
                    <!-- /top -->
                    <div class="note" id="note"><center><b><font color="red">Notes:</font></b>                        
                        <br/>&emsp; Les champs grisés sont obligatoires                                               
                        <br/>&emsp; Le code Client doit contenir 3 à 6 caractères et ne doit être composé que des lettres uniquement.
                        <br/>&emsp; Les champs « STAT, NIF, CIF et RCS » sont à remplir dans le cas où le type du Client est « Privé »
                        </center>
                    </div>
                    <br/><br/>
                    <div id="dp">                        
                        <form name="client" method="post" onsubmit="return verifAll(this)">   <!-- verifAll : fonction de vérification du formulaire selon la fonction JS -->
                            <table>
                                <tr>
                                    <td>
                                        <ul style=" list-style-type: none">
										<fieldset name = "Code">
										 <legend><b>CODE PROJET CLIENT</b></legend>
                                            <table>
                                                <tr>
                                                    <td><label for="RefClient">Code </label></td>
                                                    <td><input type="text" style=" width: 200px" name="RefClient" id="RefClient" onblur="verifChampNul(this); VerifCodeCli(this);" /></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labNomSociete" for="NomSociete" >Nom</label></td>
                                                    <td><textarea type="text" name="NomSociete" id="NomSociete" onblur="verifChampNul(this)"></textarea></td>
                                                </tr>                                                
                                                <tr>
                                                    <td><label id="labActivite" for="Activite">Secteur d'activit&eacute;</label></td>
                                                    <td><textarea type="text" name="Activite" id="Activite" onblur="verifChampNul(this)"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labsite" for="siteweb">Site Web</label></td>
                                                    <td><input type="text" style=" width: 200px" name="siteWeb" id="siteWeb" /></td>
                                                </tr>
                                                <!-- Modification de la part de Heritiana -->
                                                <!-- Ajout du champ Beneficiaire -->
                                                <tr>
                                                     <td><label id="labbeneficiaire" for="beneficiaire" > <i>Bénéficiaire</i> </label></td>
                                                     <td><textarea type="text" name="Beneficiaire" id="beneficiaire"><?php echo($result->beneficiaire)?></textarea></td>
                                                     </tr> 
                                                <!-- Ajout du champ Payeur -->
                                                <tr>
                                                    <td><label id="labpayeur" for="payeur" > <i>Payeur </i></label></td>
                                                    <td><textarea type="text" name="Payeur" id="Payeur"><?php echo($result->payeur)?></textarea></td>
                                                    </tr>
                                                
                                                <tr>
                                                    <td><label id="labCodePostal" for="CodePostal">Groupe </label></td>
                                                    <td><textarea type="text" name="CodePostal" id="CodePostal"></textarea><br/></td>
                                                </tr>
                                            </table>       
                                        </ul>
										</fieldset>
                                    </td>
                                    <td>
                                        <ul style=" list-style-type: none">
											<fieldset>
											<legend><b>ADRESSE CLIENT</b></legend>
                                            <table>
 
                                                <tr>
                                                    <td><label id="labAdresse" for="Adresse">Adresse</label></td>
                                                    <td><textarea type="text" name="Adresse" id="Adresse" onblur="verifChampNul(this)"></textarea></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td><label id="labVille" for="Ville">Ville </label></td>
                                                    <td><input type="text" style=" width: 200px" name="Ville" id="Ville" onblur="verifChampNul(this)" /></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td><label id="labPaysRegion" for="PaysRegion">Pays</label></td>
                                                    <td><input type="text" style=" width: 200px" name="PaysRegion" id="PaysRegion" onblur="verifChampNul(this)" /></td>                                                    
                                                </tr>
                                                
                                                <tr>
                                                    <td><label id="labNumeroTel" for="NumeroTel">N° de t&eacute;l&eacute;phone </label></td>
                                                    <td><textarea type="text" name="NumeroTel" id="NumeroTel" ></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labNumTelecopie" for="NumTelecopie">N° de t&eacute;l&eacute;copie </label></td>
                                                    <td><input type="text" style=" width: 200px" name="NumTelecopie" id="NumTelecopie"  /></td>
                                                </tr>
                                            </table>
                                        </ul>
										</fieldset>
                                    </td>                                                                    
                                    <td>
                                        <ul style=" list-style-type: none">
											<fieldset>
										 <legend><b>FONCTION / ACTIVITE</b></legend>
                                            <table>         
 
                                                <tr>
                                                    <td><label id="labTitreContact" for="TitreContact">Titre Contact </label></td>
                                                    <td><input type="text" style=" width: 200px" name="TitreContact" id="TitreContact"/></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labNomContact" for="NomContact">Nom Contact </label></td>
                                                    <td><textarea type="text" name="NomContact" id="NomContact" onblur="verifChampNul(this)" ></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labFonction" for="Fonction">Fonction </label></td>
                                                    <td><input type="text" style=" width: 200px" name="Fonction" id="Fonction" onblur="verifChampNul(this)" /></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labMail" for="Mail">Mail </label></td>
                                                    <td><textarea type="text" name="Mail" id="Mail" onblur="verifChampNul(this)" ></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labNumMobile" for="NumMobile">N° T&eacute;l. Mobile </label></td>
                                                    <td><textarea type="text" name="NumMobile" id="NumMobile" ></textarea></td>                                                    
                                                </tr>                                                
                                            </table>
                                        </ul>
										</fieldset>
                                    </td>
                                    
                                    
                                    <td>
                                        <ul style=" list-style-type: none">
										<fieldset>
										<legend><b>INFOS ADMINISTRATIVES</legend>     
                                            <table>
                                                <br/>
												 
                                               <!-- <Fieldset><b><span id="tit">INFOS ADMINISTRATIVES</span></b><br/>-->
                                                <tr>
                                                    <td><label id="labtype">Type</label></td>
                                                    <td>
                                                        <select name="typeClient" id="typeClient" style="width:204px; height: 22px" onblur="verifChampNul(this)">
                                                        <option></option>
                                                        <optgroup label="International">
                                                            <?php
                                                                $reqType1 = "select Description from type
                                                                    where Description in ('International');";
                                                                $resType = mysqli_query($connect, $reqType1) or exit(mysqli_error());
                                                                while($rowTypeCli = mysqli_fetch_array($resType, MYSQLI_BOTH)){
                                                                    echo '<option value="'.$rowTypeCli[0].'" >'.$rowTypeCli[0].'</option>';
                                                                }
                                                            ?>
                                                        </optgroup>
                                                        <optgroup label="Local">
                                                            <?php
                                                                $reqType2 = "select Description from type
                                                                where Description in ('Public', 'Privé', 'ONG');";
                                                                $resType2 = mysqli_query($connect, $reqType2) or exit(mysqli_error());
                                                                while($rowTypeCli2 = mysqli_fetch_array($resType2, MYSQLI_BOTH)){
                                                                    echo '<option value="'.$rowTypeCli2[0].'" >'.$rowTypeCli2[0].'</option>';
                                                                }
                                                            ?>
                                                        </optgroup>
                                                    </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labstat" for="stat" > STAT</label></td>
                                                    <td><textarea type="text" name="stat" id="stat" readonly="true" placeholder="Exemple:11111 11 1111 11111"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labnif" for="nif" > N.I.F </label></td>
                                                    <td><textarea type="text" name="nif" id="nif" readonly="true"  placeholder="Exemple:1111111111"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labcif" for="cif" > C.I.F </label></td>
                                                    <td><textarea type="text" name="cif" id="cif" readonly="true" placeholder="Exemple:1111111/DGI-B du jj/mm/aaaa"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labrcs" for="rcs" > R.C.S </label></td>
                                                    <td><textarea type="text" name="rcs" id="rcs" readonly="true" placeholder="Exemple:1111 B 11111"></textarea></td>
                                                </tr>
												
												
												
											<!--	BALANCE AGEE
											
											<tr>
												 <<td style=" width: 91px"><label id="labbalance" for="balanceagee" >Balance agée? </label></td>
                                                    <td><input type="checkbox" id="balanceagee" name="balanceagee" /><br/></td>
												</tr>-->

                                                <tr>                                                                                                        
                                                    <td style=" width: 91px"><label id="labbalance" for="balanceagee" >Balance agée? </label></td>
                                                    <td><input type="checkbox" id="balanceagee" name="balanceagee" /><br/></td>
                                                </tr>
                                            </table>
											
                                        </ul>
										</fieldset>
                                    </td>
                                </tr>
                            </table>                                                                                    
                            <span id="spann" style="float: right; padding: 8px;"><input type="submit" disabled="disabled" name="enregistrer" id="enregistrer" value="Enregistrer" action="#"  onmouseover="this.disabled='';" /></span>                            
                        </form>                                                
                    </div>               
                    <!-- bottom -->
                </div>
            
            
            <?php
			// ACTION D'INSERTION DE DONNEES SAISIES TS DANS LA BASE
                if (isset($_POST['enregistrer'])){                            
                    ?>                                        
                    <script>
                        document.client.style.display='none';                        
                    </script>
                    <?php
                    
                    $RefCli     = strtoupper($_POST['RefClient']);
                    $NomSte     = $_POST['NomSociete'];
                    
                    if($_POST['CodePostal']== ''){
                        $CodePost = strtoupper($_POST['RefClient']);
                    }
                    else{
                        $CodePost   = strtoupper($_POST['CodePostal']);
                    }                    
                    
                    $Activ      = $_POST['Activite'];
                    $PaysReg    = $_POST['PaysRegion'];
                    $Vil        = $_POST['Ville'];
                    $Adres      = $_POST['Adresse'];
                    $TitreContac = $_POST['TitreContact'];
                    $NomContac  = $_POST['NomContact'];
                    $Fonctio    = $_POST['Fonction'];
                    $NumeroTe   = $_POST['NumeroTel'];
                    $NumTelecopi = $_POST['NumTelecopie'];
                    $NumMobil   = $_POST['NumMobile'];
                    $Mai        = $_POST['Mail'];
                    $siteWeb    = $_POST['siteWeb'];
                    $dateNow    = date('Y-m-d'); 
                    /*Récupére le bénéficiaire et le payeur*/
                    $Beneficiaire = $_POST['Beneficiaire'];
                    $Payeur = $_POST['Payeur'];
                    
                    //infos administrative
                    $typeClient = $_POST['typeClient'];
                    
                    if($_POST['typeClient'] == 'Privé'){
                        $stat = $_POST['stat'];
                        $nif  = $_POST['nif'];
                        $cif  = $_POST['cif'];
                        $rcs  = $_POST['rcs'];
                    }
                    else{
                        $stat = '';
                        $nif  = '';
                        $cif  = '';
                        $rcs  = '';
                    }
                    
//                    $stat = $_POST['stat'];
//                    $nif  = $_POST['nif'];
//                    $cif  = $_POST['cif'];
//                    $rcs  = $_POST['rcs'];
                    $GroupeNom  = $_POST['NomSociete'];

                    // echo '$RefCli '.$RefCli;
                    // echo '$NomSte '.$NomSte;
                    // echo '$CodePost .'.$CodePost;
                    // echo '$Activ '.$Activ;
                    // echo '$PaysReg '.$PaysReg;
                    // echo '$Vil '.$Vil;
                    // echo '$Adres '.$Adres;
                    // echo '$TitreContac '.$TitreContac;
                    // echo '$NomContac '.$NomContac;
                    // echo '$Fonctio '.$Fonctio;
                    // echo '$NumeroTe '.$NumeroTe;
                    // echo '$NumTelecopi '.$NumTelecopi;
                    // echo '$NumMobil '.$NumMobil;
                    // echo '$Mai '.$Mai;

                    $mysqli->query("SET AUTOCOMMIT=0");
                    $InsertCli = 'insert into client'
                            . '(RefClient, NomSociete, CodePostal, GroupeNom, Activite, PaysRegion, Ville, Adresse, TitreContact, NomContact, Fonction, NumeroTel, NumTelecopie, NumMobile, Mail, UT, DT, siteweb, datemodification, nombremodification, usermodif'
                            . ', typeclient, stat, nif, cif, rcs, beneficiaire, payeur) '
                            . 'values '
                            . '("'.$RefCli.'", "'.$NomSte.'", "'.$CodePost.'", "'.$GroupeNom.'", "'.$Activ.'", "'.$PaysReg.'", "'.$Vil.'", "'.$Adres.'", "'.$TitreContac.'", "'.$NomContac.'", "'.$Fonctio.'", "'.$NumeroTe.'", "'.$NumTelecopi.'", "'.$NumMobil.'", "'.$Mai.'", now(), now(), "'.$siteWeb.'", "'.$dateNow.'", 0, "'.$refEmp.'"'
                            . ', "'.$typeClient.'", "'.$stat.'", "'.$nif.'", "'.$cif.'", "'.$rcs.'", "'.$Beneficiaire.'", "'.$Payeur.'")';

                    $ajoutCli = mysqli_query($connect, $InsertCli);  //or exit(mysqli_error($connect));

                    if($ajoutCli){
                            ?>
                            <script>
                                $('#note').css("display", "none");
                            </script>
                            <?php
                            echo '<br><center><font color="green"><b>Le client a &eacute;t&eacute; ajout&eacute; avec succ&egrave;s.</b></font></center>';
                            $mysqli->query("COMMIT");
                    }
                    else {  
                        ?>
                            <script>
                                $('#note').css("display", "none");
                            </script>
                            <?php
//                        echo '<br/><font size="0.5em">Erreur: '.mysqli_error($connect).'</font>';
                        echo '<br/><font color="red"; size="4px"><center><img src="../../images/Warning.gif"/> Désolé, le code Client existe déjà!!!</center></font>';
                        echo '</b></p></div>';            
                        $mysqli->query("ROLLBACK");exit(1);
                        exit(mysqli_error($connect));
                    }                        
                }
			// FIN ACTION D'INSERTION DE DONNEES SAISIES TS DANS LA BASE
            ?>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $("textarea").focus(function(e){
                $(this).height(40);
                $(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
            });

            $("textarea").blur(function(e){
                $(this).height(16);
//                        $(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
            });
            
            var url = window.location.href;
            var filename = url.substring(url.lastIndexOf('/')+1);
            if (filename === "") filename = "index.html";
            $(".menu a[href='" + filename + "']").addClass("selected");
        });
    </script>
	 
        
        <?php else : ?>
            <p>
                <span>Vous n’avez pas les autorisations n&eacute;cessaires pour acc&eacute;der &agrave; cette page.</span> Please <a href="../../index.php">login</a>.
            </p>
        <?php endif; ?> 
            
        <script type="text/javascript">  
            $(document).ready(function(){
                profil = '<?php echo $prof;?>';
                if(profil !== "DAF"){                                        
                    $('#labbalance').css("display", "none");
                    $('#balanceagee').css("display", "none");
                    $('#labCodePostal').css("display", "none");
                    $('#CodePostal').css("display", "none");
                }
                
                
                //à la selection d'un type de client
                    $("#typeClient").on('change', function(){
                        var type = $(this).val();                        
                        if(type === 'Privé'){
                            //alert("yes");
                            $('#stat').prop("readonly", false);
                            $('#nif').prop("readonly", false);
                            $('#cif').prop("readonly", false);
                            $('#rcs').prop("readonly", false);
                            $('#stat').css('background-color', '#F2F1EB');
                            $('#nif').css('background-color', '#F2F1EB');
                            $('#cif').css('background-color', '#F2F1EB');
                            $('#rcs').css('background-color', '#F2F1EB');                              
                            //$('#label').css("display", "block"); 
                            document.getElementById('stat').value = '';
                            document.getElementById('nif').value = '';
                            document.getElementById('cif').value = '';
                            document.getElementById('rcs').value = '';
                        }
                        else{
                            //alert("nooo");                                                        
                            $('#stat').prop("readonly", true);
                            $('#nif').prop("readonly", true);
                            $('#cif').prop("readonly", true);
                            $('#rcs').prop("readonly", true);                                                        
                            $('#stat').css('background-color', '#FFFFFF');
                            $('#nif').css('background-color', '#FFFFFF');
                            $('#cif').css('background-color', '#FFFFFF');
                            $('#rcs').css('background-color', '#FFFFFF'); 
                            document.getElementById('stat').value = ' -- Not Applicable -- ';
                            document.getElementById('nif').value = ' -- Not Applicable -- ';
                            document.getElementById('cif').value = ' -- Not Applicable -- ';
                            document.getElementById('rcs').value = ' -- Not Applicable -- ';
                        }
                    });
                
                
                if($('#enregistrer').is(':disabled')){
//                        alert("disa");                        
                        $('#spann').bind({
                            mouseenter: function(e) {
                                // Hover event handler
                                $('#enregistrer').attr('disabled', false);  
//                                alert("hover a");
                            },
                            mouseleave: function(e) {
                                // Hover event handler
//                                 alert("hover b");
                            },
                            click: function(e) {
                                // Click event handler
//                                 alert("click");
                            },
                            blur: function(e) {
                                // Blur event handler
                            }
                       });
                    }
                    else{
//                        alert("iiii");
//                        $('#spann').bind('mouseover mouseout');
                    }
                    
                    $('#spann').on ('mouseover', function(){
//                        $('#enregistrer').attr('disabled', false);  
                        $('#spann').unbind('mouseover mouseout');
                    });
                                                            
                    $('#enregistrer').on('mouseout', function(){                        
//                        alert("kaka");
                        $('#enregistrer').attr('disabled', 'disabled');    
                        
                    });
                                
                $('#RefClient').css('background-color', '#F2F1EB');
                $('#NomSociete').css('background-color', '#F2F1EB');
                $('#Activite').css('background-color', '#F2F1EB');
                $('#PaysRegion').css('background-color', '#F2F1EB');
                $('#Ville').css('background-color', '#F2F1EB');
                $('#Adresse').css('background-color', '#F2F1EB');
//                $('#TitreContact').css('background-color', '#F2F1EB');
                $('#NomContact').css('background-color', '#F2F1EB');
                $('#Fonction').css('background-color', '#F2F1EB');
                $('#Mail').css('background-color', '#F2F1EB');
                $('#typeClient').css('background-color', '#F2F1EB');
            }); 
            
                function afficheErreur(champ, erreur){
                    if(erreur){                            
                        champ.style.backgroundColor = "#DCDCDC";
                    }
                    else{                        
                        champ.style.backgroundColor = "";
                    }
                }

                function verifChampNul(champ){
                    if(champ.value === ""){
                        afficheErreur(champ, true);
                        return false;
                    }
                    else{
                        afficheErreur(champ, false);
                        return true;
                    }   
                }
                
                function verifAll(f){   
                    $typecli = $("#typeClient").val();                   
                    if($typecli === 'Privé'){
                        var stat = verifChampNul(f.stat);
                        var nif = verifChampNul(f.nif);
                        var cif = verifChampNul(f.cif);
                        var rcs = verifChampNul(f.rcs);
                    }                    
                    
                    var RefClient = verifChampNul(f.RefClient);
                    var NomSociete = verifChampNul(f.NomSociete);
                    var Activite = verifChampNul(f.Activite);
                    var PaysRegion = verifChampNul(f.PaysRegion);
                    var Ville = verifChampNul(f.Ville);
                    var Adresse = verifChampNul(f.Adresse);
                    var Mail = verifChampNul(f.Mail);
//                   var TitreContact = verifChampNul(f.TitreContact);
                    var NomContact = verifChampNul(f.NomContact);
                    var Fonction = verifChampNul(f.Fonction);
                   
                    var typeClient = verifChampNul(f.typeClient);
                    
                    
                    if($typecli === 'Privé'){
                        if(stat && nif && cif && rcs && 
                            RefClient && NomSociete && Activite && PaysRegion && Ville && Adresse  
                            && Mail 
//                          && NumMobile 
//                          && TitreContact 
                            && NomContact && Fonction && typeClient)
                            return true;
                        else{
                            alert("Veuillez remplir correctement tous les champs.");
                            return false;
                        }
                    }
                    else{
                        if(RefClient && NomSociete && Activite && PaysRegion && Ville && Adresse  
                        && Mail 
//                          && NumMobile 
//                          && TitreContact 
                        && NomContact && Fonction && typeClient)
                        return true;
                        else{
                            alert("Veuillez remplir correctement tous les champs.");
                            return false;
                        }
                    }
                   
                    
                }
                                
                function VerifCodeCli(code){
                    var codeCli = code.value, i, unicode;
                    var long = codeCli.length;
                    
                    if(long<3 || long>6){                        
                        if(long===0){
                            alert("Le code client ne doit pas être vide.");                                                        
                            $('#RefClient').css("background", "#FA5858");                            
//                            $('#NomSociete').css("display", "none");    
							                  
                            $('#CodePostal').css("display", "none");
                            $('#Activite').css("display", "none");
                            $('#PaysRegion').css("display", "none");
                            $('#Ville').css("display", "none");
                            $('#Adresse').css("display", "none");
                            $('#NumeroTel').css("display", "none");
                            $('#NumTelecopie').css("display", "none");
                            $('#NumMobile').css("display", "none");
                            $('#Mail').css("display", "none");
                            $('#TitreContact').css("display", "none");
                            $('#NomContact').css("display", "none");
                            $('#Fonction').css("display", "none");
                            $('#siteWeb').css("display", "none");
                            $('#enregistrer').css("display", "none");
                            
                            $('#typeClient').css("display", "none");                                                        
                            $('#stat').css("display", "none");
                            $('#nif').css("display", "none");
                            $('#cif').css("display", "none");
                            $('#rcs').css("display", "none");
                            $('#balanceagee').css("display", "none");
                            $('#tit').css("display", "none");
                            /***LAB****/
//                            $('#labNomSociete').css("display", "none");
                            $('#labCodePostal').css("display", "none");
                            $('#labActivite').css("display", "none");
                            $('#labPaysRegion').css("display", "none");
                            $('#labVille').css("display", "none");
                            $('#labAdresse').css("display", "none");
                            $('#labNumeroTel').css("display", "none");
                            $('#labNumTelecopie').css("display", "none");
                            $('#labNumMobile').css("display", "none");
                            $('#labMail').css("display", "none");
                            $('#labTitreContact').css("display", "none");
                            $('#labNomContact').css("display", "none");
                            $('#labFonction').css("display", "none");   
                            $('#labsite').css("display", "none");  
                            
                            $('#labtype').css("display", "none");
                            $('#labstat').css("display", "none");
                            $('#labnif').css("display", "none");
                            $('#labcif').css("display", "none");
                            $('#labrcs').css("display", "none");
                            $('#labbalance').css("display", "none");                            
                        }
                        else if(long<3){
                            alert("Le code client est trop court(6 caractères maximum).");
                            $('#RefClient').css("background", "#FA5858");    
//                            $('#NomSociete').css("display", "none");
							          
                            $('#CodePostal').css("display", "none");
                            $('#Activite').css("display", "none");
                            $('#PaysRegion').css("display", "none");
                            $('#Ville').css("display", "none");
                            $('#Adresse').css("display", "none");
                            $('#NumeroTel').css("display", "none");
                            $('#NumTelecopie').css("display", "none");
                            $('#NumMobile').css("display", "none");
                            $('#Mail').css("display", "none");
                            $('#TitreContact').css("display", "none");
                            $('#NomContact').css("display", "none");
                            $('#Fonction').css("display", "none");
                            $('#siteWeb').css("display", "none");
                            $('#enregistrer').css("display", "none");
                            
                            
                            $('#typeClient').css("display", "none");
                            $('#stat').css("display", "none");
                            $('#nif').css("display", "none");
                            $('#cif').css("display", "none");
                            $('#rcs').css("display", "none");
                            $('#balanceagee').css("display", "none");
                            $('#tit').css("display", "none");
                            /***LAB****/
//                            $('#labNomSociete').css("display", "none");
                            $('#labCodePostal').css("display", "none");
                            $('#labActivite').css("display", "none");
                            $('#labPaysRegion').css("display", "none");
                            $('#labVille').css("display", "none");
                            $('#labAdresse').css("display", "none");
                            $('#labNumeroTel').css("display", "none");
                            $('#labNumTelecopie').css("display", "none");
                            $('#labNumMobile').css("display", "none");
                            $('#labMail').css("display", "none");
                            $('#labTitreContact').css("display", "none");
                            $('#labNomContact').css("display", "none");
                            $('#labFonction').css("display", "none");
                            $('#labsite').css("display", "none");    
                            
                            $('#labtype').css("display", "none");
                            $('#labstat').css("display", "none");
                            $('#labnif').css("display", "none");
                            $('#labcif').css("display", "none");
                            $('#labrcs').css("display", "none");
                            $('#labbalance').css("display", "none");
                        }
                        else if(long>6){
                            alert("Le code client est trop long(6 caractères maximum).");
                            $('#RefClient').css("background", "#FA5858");    
//                            $('#NomSociete').css("display", "none");                            
                            $('#CodePostal').css("display", "none");
                            $('#Activite').css("display", "none");
                            $('#PaysRegion').css("display", "none");
                            $('#Ville').css("display", "none");
                            $('#Adresse').css("display", "none");
                            $('#NumeroTel').css("display", "none");
                            $('#NumTelecopie').css("display", "none");
                            $('#NumMobile').css("display", "none");
                            $('#Mail').css("display", "none");
                            $('#TitreContact').css("display", "none");
                            $('#NomContact').css("display", "none");
                            $('#Fonction').css("display", "none");
                            $('#siteWeb').css("display", "none");
                            $('#enregistrer').css("display", "none");
                            
                            $('#typeClient').css("display", "none");
                            $('#stat').css("display", "none");
                            $('#nif').css("display", "none");
                            $('#cif').css("display", "none");
                            $('#rcs').css("display", "none");
                            $('#balanceagee').css("display", "none");
                            $('#tit').css("display", "none");
                            /***LAB****/
//                            $('#labNomSociete').css("display", "none");
                            $('#labCodePostal').css("display", "none");
                            $('#labActivite').css("display", "none");
                            $('#labPaysRegion').css("display", "none");
                            $('#labVille').css("display", "none");
                            $('#labAdresse').css("display", "none");
                            $('#labNumeroTel').css("display", "none");
                            $('#labNumTelecopie').css("display", "none");
                            $('#labNumMobile').css("display", "none");
                            $('#labMail').css("display", "none");
                            $('#labTitreContact').css("display", "none");
                            $('#labNomContact').css("display", "none");
                            $('#labFonction').css("display", "none");
                            $('#labsite').css("display", "none");                               
                            
                            $('#labtype').css("display", "none");
                            $('#labstat').css("display", "none");
                            $('#labnif').css("display", "none");
                            $('#labcif').css("display", "none");
                            $('#labrcs').css("display", "none");
                            $('#labbalance').css("display", "none");
                        }
                    }
                    else{
                        for(i=0; i<long; i++){                                                                                   
                            unicode = codeCli[i].toUpperCase().charCodeAt();
                            if(unicode > 90 || unicode < 65){
                                alert("Code client: veuillez n'introduire que des lettres.");
                                $('#RefClient').css("background", "#FA5858");    
//                                $('#NomSociete').css("display", "none");                            
                                $('#CodePostal').css("display", "none");
                                $('#Activite').css("display", "none");
                                $('#PaysRegion').css("display", "none");
                                $('#Ville').css("display", "none");
                                $('#Adresse').css("display", "none");
                                $('#NumeroTel').css("display", "none");
                                $('#NumTelecopie').css("display", "none");
                                $('#NumMobile').css("display", "none");
                                $('#Mail').css("display", "none");
                                $('#TitreContact').css("display", "none");
                                $('#NomContact').css("display", "none");
                                $('#Fonction').css("display", "none");
                                $('#siteWeb').css("display", "none");
                                $('#enregistrer').css("display", "none");
                                
                                $('#typeClient').css("display", "none");
                                $('#stat').css("display", "none");
                                $('#nif').css("display", "none");
                                $('#cif').css("display", "none");
                                $('#rcs').css("display", "none");
                                $('#balanceagee').css("display", "none");
                                $('#tit').css("display", "none");
                                /***LAB****/
//                                $('#labNomSociete').css("display", "none");
                                $('#labCodePostal').css("display", "none");
                                $('#labActivite').css("display", "none");
                                $('#labPaysRegion').css("display", "none");
                                $('#labVille').css("display", "none");
                                $('#labAdresse').css("display", "none");
                                $('#labNumeroTel').css("display", "none");
                                $('#labNumTelecopie').css("display", "none");
                                $('#labNumMobile').css("display", "none");
                                $('#labMail').css("display", "none");
                                $('#labTitreContact').css("display", "none");
                                $('#labNomContact').css("display", "none");
                                $('#labFonction').css("display", "none");  
                                $('#labsite').css("display", "none");  
                                
                                $('#labtype').css("display", "none");
                                $('#labstat').css("display", "none");
                                $('#labnif').css("display", "none");
                                $('#labcif').css("display", "none");
                                $('#labrcs').css("display", "none");
                                $('#labbalance').css("display", "none");
                                break;
                            }
                            else{
                                $('#NomSociete').css("display", "inline");                            
                                $('#CodePostal').css("display", "inline");
                                $('#Activite').css("display", "inline");
                                $('#PaysRegion').css("display", "inline");
                                $('#Ville').css("display", "inline");
                                $('#Adresse').css("display", "inline");
                                $('#NumeroTel').css("display", "inline");
                                $('#NumTelecopie').css("display", "inline");
                                $('#NumMobile').css("display", "inline");
                                $('#Mail').css("display", "inline");
                                $('#TitreContact').css("display", "inline");
                                $('#NomContact').css("display", "inline");
                                $('#Fonction').css("display", "inline");
                                $('#siteWeb').css("display", "inline");
                                $('#enregistrer').css("display", "inline");
                                
                                $('#typeClient').css("display", "inline");
                                $('#stat').css("display", "inline");
                                $('#nif').css("display", "inline");
                                $('#cif').css("display", "inline");
                                $('#rcs').css("display", "inline");
                                $('#balanceagee').css("display", "inline");
                                $('#tit').css("display", "inline");
                                /***LAB****/
                                $('#labNomSociete').css("display", "inline");
                                $('#labCodePostal').css("display", "inline");
                                $('#labActivite').css("display", "inline");
                                $('#labPaysRegion').css("display", "inline");
                                $('#labVille').css("display", "inline");
                                $('#labAdresse').css("display", "inline");
                                $('#labNumeroTel').css("display", "inline");
                                $('#labNumTelecopie').css("display", "inline");
                                $('#labNumMobile').css("display", "inline");
                                $('#labMail').css("display", "inline");
                                $('#labTitreContact').css("display", "inline");
                                $('#labNomContact').css("display", "inline");
                                $('#labFonction').css("display", "inline");
                                $('#labsite').css("display", "inline");     
                                
                                $('#labtype').css("display", "inline");
                                $('#labstat').css("display", "inline");
                                $('#labnif').css("display", "inline");
                                $('#labcif').css("display", "inline");
                                $('#labrcs').css("display", "inline");
                                $('#labbalance').css("display", "inline");

//                                document.getElementById('typeClient').value = "";
                                
                                if(profil !== "DAF"){                                        
                                    $('#labbalance').css("display", "none");
                                    $('#balanceagee').css("display", "none");
                                    $('#labCodePostal').css("display", "none");
                                    $('#CodePostal').css("display", "none");
                                }
                                else{
                                    $('#labbalance').css("display", "inline");
                                    $('#balanceagee').css("display", "inline");
                                    $('#labCodePostal').css("display", "inline");
                                    $('#CodePostal').css("display", "inline");
                                }                                                               
                            }
                        }
                    }                    
                }                                
            </script>		    
    </body>
</html>

