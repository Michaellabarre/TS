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
        <title>Liste des missions cloturées</title>
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
			background:blue url(../images/button.gif);
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
			color:#006CC;
		}
		
		.delete{
		background:url(../../images/deconnexion.png) no-repeat 10px 8px;
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
            #echeance td{
                border: 1px solid grey;                
                /*border-style: none;*/
            }
            
            #echeance input{
                border-color: transparent;
            }            
            
            .trans {
                border-style: none;
            }
            
            input[type='submit'] {
                /*width: 100px!important;*/    
                float: right;                         
            }
            #selectionner{
                margin-right: 1030px;
            }
            .cout{
                float: right;
                margin-left: 0px;
            }
        </style>
        <script type="text/javascript" language="javascript">
            function getIndex(chaine, leSelect){
                            var nb = document.getElementById(leSelect).options.length;                
                            var iz = 0;
                            var lindex = 0;
                            while(iz<nb){
                                if(document.getElementById(leSelect).options[iz].value === chaine){
                                    lindex = iz;
                                }
                                iz++;
                            }
                            return lindex;
            }
        </script>
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
                    <MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1> </MARQUEE>
                 <!--   <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                -->    
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

					  <li><a href="../index.php">CLIENTS</a><!-- n1 -->
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
					
					
                <!-- tabs -->
                  <!--  <nav class="menu">  
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
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <li><a class='tab selected' href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>
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
                    <font style=" color: black"><b><center>LISTE DES MISSIONS CLOTURÉES</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }            
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
						
					<li><a href="./index.php">MISSIONS</a>
						<ul>
							<li><a href="./nouvellemission.php"><b>Nouvelle Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="./missioncode.php"><b>Fiche de Mission</b></a></li>
							<li><a href="./missiondept.php"><b>Mission par Départ.</b></a></li>
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
           <!--     <nav class="menu">  
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
                            <li><a href='./missiondept.php'><span>Mission par département</span></a></li>
                            <li><a class='tab selected' href='./missioncloture.php'><span>Missions cloturées</span></a></li>
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
                    <br/><br/>
                    <font style=" color: black"><b><center>LISTE DES MISSIONS CLOTURÉES</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
            else if($prof == 'Assistant(e) Manager'  ){
                ?>
                <!-- tabs -->
                    
					<ul id="nav">
					<li class="current"><a href="../../guide/index.php">GUIDE</a></li><!-- n1 -->

					  <li><a href="../../guide/client/index.php">CLIENTS</a><!-- n1 -->
						<ul>
							<li><a href="../../guide/client/ajoutclient.php"><b>Nouveau Client </b><img src="../images/addusers.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../../guide/client/listeclient.php"><b>Liste des Clients </b><img src="../images/utilisateurs.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../../guide/client/modifclientcode.php"><b>Modification Client</b></a></li><!-- n2 -->
						</ul>
					</li>
						
					<li><a href="../mission/index.php">MISSIONS</a>
						<ul>
							<li><a href="./nouvellemission.php"><b>Nouvelle Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="./missioncode.php"><b>Modification Mission</b></a></li>
							<li><a href="./missiondept.php"><b>Mission par Départ.</b></a></li>
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
					
					<!--<nav class="menu">  
                    <div>                                        
                        <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='../../guide/client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='../../guide/client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='../../guide/client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='../../guide/client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>    
                        <a class='tab selected' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='./nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='./missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='./missiondept.php'><span>Mission par département</span></a></li>
                            <li><a class='tab selected' href='./missioncloture.php'><span>Missions cloturées</span></a></li>
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
                    <br/><br/>
                    <font style=" color: black"><b><center>LISTE DES MISSIONS CLOTURÉES</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }            
        ?>
                      
        <div id="container" style="max-height: 550px;overflow: scroll; top: 500px">            
            
            
                
                <div>
                    <!-- /top -->
<!--                    <div class="note" id="note"><b><font color="red">Notes:</font></b> 
                        <br/>&emsp; Les champs grisés sont obligatoires
                        <br/>&emsp; Un département, au moins doit être affécté à la mission
                    </div>-->
                    <!--<br/><br/>-->
                    <div id="dp">
                        <?php
                        $reqMissionCode = mysqli_query($connect,'select RefProjet, RefClient, NomProjet from projets where cloture in ("1") '                            
                            . 'order by RefProjet ASC;');
                        ?>
                        <form name="missionCode" method="post">	
                            <ul>
                            <label for="code_mission"></label>							
                            <select name="code_mission" id="code_mission" style="width:173px">
                                <option>Sélectionnez la mission</option>
                                <?php
                                    while($r = mysqli_fetch_array($reqMissionCode, MYSQLI_BOTH)){
                                        echo '<option value="'.$r[0].'">'.$r[0].'&emsp; &emsp;|&emsp; &emsp;'.$r[1].'&emsp; &emsp;|&emsp; &emsp;'.$r[2].'</option>';                                        
                                    }
                                ?>																																		
                            </select>
                            <input type="submit" name="selectionner" id="selectionner" value="Selectionner" />
                            </ul>
                        </form>
                        
                        <?php
                        if(isset($_POST['selectionner'])){
                            if($_POST['code_mission'] == 'Sélectionnez la mission'){						
                                echo '<font color="red"><b><br/>Veuillez s&eacute;lectionner une mission.</b></font>';																
                            }
                            else{
                                ?>
                                <script>
                                    document.missionCode.style.display = 'none';
//                                    $('#note').css("display", "none");
                                </script>
                                <center>
                                <?php
                                $codeMission = $_POST['code_mission'];
                                
                                $reqMission = 'SELECT NomProjet AS mission FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                $reqMi = mysqli_query($connect,$reqMission);
                                $resultMi = mysqli_fetch_assoc($reqMi);
                                $mission = $resultMi['mission'];
                                
                                $reqCli = 'SELECT C.NomSociete as cli from client C inner join projets P on (P.RefClient = C.RefClient) WHERE RefProjet = "'.$codeMission.'";';
                                $reqCl = mysqli_query($connect,$reqCli);
                                $resultCli = mysqli_fetch_assoc($reqCl);
                                $cli = $resultCli['cli'];                                
                                
                                $reqCategorie = 'SELECT TypeProjet AS cat FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                $reqCat = mysqli_query($connect,$reqCategorie);
                                $resultCat = mysqli_fetch_assoc($reqCat);
                                $categorie = $resultCat['cat'];
                                
                                $reqOrigine = 'SELECT Origine AS org FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                $reqOrg = mysqli_query($connect,$reqOrigine);
                                $resultOrg = mysqli_fetch_assoc($reqOrg);
                                $orig = $resultOrg['org'];
                                
                                //type du client
                                $reqTypeClient = 'SELECT typeclient AS clitype FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                $reqType = mysqli_query($connect,$reqTypeClient);
                                $resultType = mysqli_fetch_assoc($reqType);
                                $cliType = $resultType['clitype'];
                                
                                $reqstat = 'SELECT stat AS stat FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                $reqestat = mysqli_query($connect,$reqstat);
                                $resultstat = mysqli_fetch_assoc($reqestat);
                                $stat = $resultstat['stat'];
                                
                                $reqnif = 'SELECT nif AS nif FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                $reqenif = mysqli_query($connect,$reqnif);
                                $resultnif = mysqli_fetch_assoc($reqenif);
                                $nif = $resultnif['nif'];
                                
                                $reqcif = 'SELECT cif AS cif FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                $reqecif = mysqli_query($connect,$reqcif);
                                $resultcif = mysqli_fetch_assoc($reqecif);
                                $cif = $resultcif['cif'];
                                
                                $reqrcs = 'SELECT rcs AS rcs FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                $reqercs = mysqli_query($connect,$reqrcs);
                                $resultrcs = mysqli_fetch_assoc($reqercs);
                                $rcs = $resultrcs['rcs'];
                                
                                $reqcloture = 'SELECT cloture AS cloture FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                $reqecloture = mysqli_query($connect,$reqcloture);
                                $resultcloture = mysqli_fetch_assoc($reqecloture);
                                $cloture = $resultcloture['cloture'];
                                
                                $reqRefSte = 'select S.NomSociete AS nomSoc from projets P inner join societe S on (P.RefSociete = S.RefSociete) where P.RefProjet = "'.$codeMission.'";';
                                $reqRefS = mysqli_query($connect,$reqRefSte);
                                $resultRefS = mysqli_fetch_assoc($reqRefS);
                                $nomSoc = $resultRefS['nomSoc'];
                                ?>
                                <script>
                                    
                                    
                                </script>
                                
                                <form name="modifMission" id="modifMission" method="post" onsubmit="return verifAll(this)">                                     
                                    <input type="submit" name="modifier" id="modifier" value="Modifier" />
                                    <br/>
                                    
                                    <input type="checkbox" id="cloturer" name="cloturer" 
                                           <?php
                                            if($cloture == 1) {
                                                echo 'checked disabled';                                           
                                            }                                            
                                           ?>
                                    />
                                    <span id="cochetext"> Clôturer la mission </span><br/><br/>                                    
                                <table>
                                    <tr>                                
                                        <td>   
                                            <ul style=" list-style-type: none">
                                                <!--<fieldset style="border-color: #F0F5FF">-->
                                                <legend><b>Infos Client</b></legend>                                        
                                                <table>  
                                                    <tr>
                                                        <td><label>Code Mission</label></td>
                                                        <td><input  type="text" name="cdeMission" style="width:173px" id="cdeMission" value="<?php echo $codeMission; ?>" readonly="true" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Mission</label></td>
                                                        <td><input type="text" name="mission" style="width:173px" id="mission" value="<?php echo $mission; ?>" onblur="verifChampNul(this)" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Nom du Client</label></td>
                                                        <td>
                                                            <select name="client" id="client" style="width:179px" onblur="verifChampNul(this)" >                                            
                                                                <option ></option>
                                                                    <?php
                                                                        $reqListCli = mysqli_query($connect,'select NomSociete from client order by NomSociete ASC;');
                                                                        while($rowCli = mysqli_fetch_array($reqListCli, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowCli[0].'" >'.$rowCli[0].'</option>';
                                                                        }
                                                                    ?>
                                                            </select>
                                                            <script>
                                                                cli = "<?php echo $cli; ?>";                                                                    
                                                                document.getElementById("client").selectedIndex = getIndex(cli, "client");                                                                    
                                                            </script>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label>Cat&eacute;gorie</label></td>
                                                        <td>
                                                            <select name="categorie" id="categorie" style="width:179px" onblur="verifChampNul(this)">
                                                                <option></option>
                                                                    <?php
                                                                        $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null order by TypeProjet ASC;');
                                                                        while($rowCat = mysqli_fetch_array($reqListCategorie, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowCat[0].'" >'.$rowCat[0].'</option>';
                                                                        }
                                                                    ?>
                                                            </select>
                                                            <script>
                                                                categorie = "<?php echo $categorie; ?>";                                                                    
                                                                document.getElementById("categorie").selectedIndex = getIndex(categorie, "categorie");                                                                    
                                                            </script>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Origine </label></td>
                                                        <td>
                                                            <select name="origine" id="origine" style="width:179px" onblur="verifChampNul(this)">
                                                                <option></option>
                                                                    <?php
                                                                        $reqListOrigine = mysqli_query($connect,'select distinct Origine from projets where Origine is not null order by Origine ASC;');
                                                                        while($rowOrg = mysqli_fetch_array($reqListOrigine, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowOrg[0].'" >'.$rowOrg[0].'</option>';
                                                                        }
                                                                    ?>
                                                            </select>
                                                            <script>
                                                                orig = "<?php echo $orig; ?>";                                                                      
                                                                document.getElementById("origine").selectedIndex = getIndex(orig, "origine");                                                                    
                                                            </script>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Type</label></td>
                                                        <td>
                                                            <select name="typeClient" id="typeClient" style="width:179px" onblur="verifChampNul(this)">
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
                                                            <script>
                                                                cliType = "<?php echo $cliType; ?>";                                                                    
                                                                document.getElementById("typeClient").selectedIndex = getIndex(cliType, "typeClient");                                                                    
                                                            </script>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label id="labstat" for="stat" style="display: none"> STAT</label></td>
                                                        <td><input type="text" name="stat" id="stat" value="<?php echo $stat;?>" style="display: none;width:173px" placeholder="11111 11 1111 11111"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label id="labnif" for="nif" style="display: none"> N.I.F </label></td>
                                                        <td><input type="text" name="nif" id="nif" value="<?php echo $nif;?>" style="display: none;width:173px" placeholder="1111111111"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label id="labcif" for="cif" style="display: none"> C.I.F </label></td>
                                                        <td><input type="text" name="cif" id="cif" value="<?php echo $cif;?>" style="display: none;width:173px" placeholder="1111111/DGI-B du jj/mm/aaaa"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label id="labrcs" for="rcs" style="display: none"> R.C.S </label></td>
                                                        <td><input type="text" name="rcs" id="rcs" value="<?php echo $rcs;?>" style="display: none;width:173px" placeholder="1111 B 11111"/></td>
                                                    </tr>
                                                </table>  
                                            <!--</fieldset>-->
                                            </ul>
                                        </td>
                                        <td> 
                                            <ul style=" list-style-type: none">
                                            <!--<fieldset style="border-color: #F0F5FF">-->
                                            <?php
                                            $reqInfoContrat = 'select Datesignature, Datearchctr, Avenantctr, Datesignaven, '
                                                . 'Paysmission, Villemission, Chefmission, DateDebutProjet, DateFinProjet, '
                                                . 'DateDebutR, DateFinR, RefSociete, DeviseCa, Reftypehono, Modefachono, '
                                                . 'Deboursrefact, Modefacdebour, Interlocfacture, Adressefacture, Monnaie, '
                                                . 'EstimationCoutTotalProjet, EstimationCoutDebours, Coordoninterloc '
                                                . 'from projets where RefProjet = "'.$codeMission.'";';                                        
                                            $reqInfoC = mysqli_query($connect, $reqInfoContrat);
                                            if ($resultInfoC = mysqli_fetch_object($reqInfoC)){                                                                                            
                                            ?>
                                                <legend><b>Infos Contrat</b></legend>
                                                <table>                                        
                                                    <tr>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td><label>Chef de mission FTHM.</label></td>
                                                                    <td><input type="text" name="chef" id="chef" style="width:173px" value="<?php echo($resultInfoC -> Chefmission) ?>" onblur="verifChampNul(this)"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Date signature contrat</label></td>
                                                                    <td><input  type="date" name="signContrat" style="width:173px" id="signContrat" value="<?php echo ($resultInfoC -> Datesignature);?>" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Date d'archivage</label></label></td>
                                                                    <td><input  type="date" name="dteArchiv" style="width:173px" id="dteArchiv" value="<?php echo ($resultInfoC -> Datearchctr)?>"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Date de d&eacute;but pr&eacute;vue</label></td>
                                                                    <td><input type="date" name="dtePrevu" style="width:173px" id="dtePrevu" value="<?php echo ($resultInfoC -> DateDebutProjet)?>" onblur="verifChampNul(this)"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Date de fin pr&eacute;vue</label></td>
                                                                    <td><input type="date" name="dteFin" id="dteFin" style="width:173px" value="<?php echo ($resultInfoC -> DateFinProjet)?>" onblur="verifChampNul(this)"/> </td>
                                                                </tr>                                                        
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <ul style=" list-style-type: none">
                                                            <table>
                                                                <tr>
                                                                    <td><label>Date d&eacute;but r&eacute;elle</label></td>
                                                                    <td><input type="date" name="dbuReel" style="width:173px" id="dbuReel" value="<?php echo ($resultInfoC -> DateDebutR)?>" style="width:173px"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Date fin r&eacute;elle</label></td>
                                                                    <td><input type="date" name="finReel" style="width:173px" id="finReel" value="<?php echo ($resultInfoC -> DateFinR)?>" style="width:173px"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Pays de la mission</label></td>
                                                                    <td><input type="text" name="paysMission" style="width:173px" id="paysMission" value="<?php echo($resultInfoC -> Paysmission) ?>" onblur="verifChampNul(this)"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Ville de la mission</label></td>
                                                                    <td><input  type="text" name="villeMission" style="width:173px" id="villeMission" value="<?php echo($resultInfoC -> Villemission) ?>" onblur="verifChampNul(this)"/></td>
                                                                </tr> 
                                                                <tr>
                                                                    <td><label>Avenant </label></td>
                                                                    <td>
                                                                        <select name="avenant" id="avenant" style="width:179px" onblur="verifChampNul(this)">
                                                                            <option></option>
                                                                                <?php
                                                                                    $avenantDefaut = $resultInfoC -> Avenantctr;
                                                                                    $reqAvenant = mysqli_query($connect,'select distinct Avenantctr from projets where Avenantctr is not null order by Avenantctr ASC;');
                                                                                    while($rowAvenant = mysqli_fetch_array($reqAvenant, MYSQLI_BOTH)){
                                                                                        echo '<option value="'.$rowAvenant[0].'" >'.$rowAvenant[0].'</option>';
                                                                                    }
                                                                                ?>
                                                                        </select>
                                                                        <script>
                                                                            avenantDefault = "<?php echo $avenantDefaut; ?>";                                                                                
                                                                            document.getElementById("avenant").selectedIndex = getIndex(avenantDefault, "avenant");                                                                    
                                                                        </script>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label id="labAvenant" for="dteAvenant" style="display: none">Date sign. avenant </label></td>
                                                                    <td><input type="date" name="dteAvenant" style="width:173px" id="dteAvenant" value="<?php echo (($resultInfoC -> Datesignaven)); ?>"  style="display: none; width: 173px"/></td>
                                                                </tr>
                                                            </table>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </table> 
                                                <?php
                                                }
                                                ?>
                                            <!--</fieldset>-->
                                            </ul>
                                        </td>                               
                                    </tr>                                
                                </table>                        
                                <table>
                                    <tr>                                
                                        <td>   
                                            <ul style=" list-style-type: none">
                                                <!--<fieldset style="border-color: #F0F5FF">-->
                                                <br><br>

                                                <legend><b>Infos Facturation</b></legend>
                                                <table>
                                                    <tr>
                                                        <td><label>Soci&eacute;t&eacute; Fact</label></td>
                                                        <td>
                                                            <select name="refSoc" id="refSoc" style="width:179px" onblur="verifChampNul(this)">
                                                                <option selected></option>                                                                                     
                                                                    <?php
                                                                        $reqRecSteList = mysqli_query($connect,'select NomSociete Origine from societe where NomSociete is not null order by NomSociete ASC;');
                                                                        while($rowRefSte = mysqli_fetch_array($reqRecSteList, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowRefSte[0].'" >'.$rowRefSte[0].'</option>';
                                                                        }
                                                                    ?>                                            
                                                            </select>
                                                            <script>
                                                                nomSoc = "<?php echo $nomSoc; ?>";                                                                    
                                                                document.getElementById("refSoc").selectedIndex = getIndex(nomSoc, "refSoc");
                                                            </script>
                                                        </td>
                                                    </tr>                                            
                                                    <tr>
                                                        <td><label>Interloc. Fact.  </label></td>
                                                        <td><input type="text" name="interFac" style="width:173px" id="interFac" value="<?php echo($resultInfoC -> Interlocfacture) ?>" onblur="verifChampNul(this)"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Adresse Fact</label></td>
                                                        <td><input type="text" name="adresseFact" style="width:173px" id="adresseFact" value="<?php echo($resultInfoC -> Adressefacture) ?>"  onblur="verifChampNul(this)"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Coordonn&eacute;es</label></td>
                                                        <td><input type="text" name="Coord" style="width:173px" id="Coord" value="<?php echo($resultInfoC -> Coordoninterloc) ?>" onblur="verifChampNul(this)"/></td>
                                                    </tr>
                                                </table>

                                                <!--</fieldset>-->
                                            </ul>
                                        </td>
                                        <td>
                                            <ul style=" list-style-type: none">
                                                <br><br>
                                            <table>
                                                <tr>
                                                    <td><label>Ca EXPORT / LOCAL  </label></td>
                                                    <td>
                                                        <select name="CA" id="CA" style="width:179px" onblur="verifChampNul(this)">
                                                            <option selected></option>
                                                                <?php
                                                                    $ca = $resultInfoC -> DeviseCa;
                                                                    $reqCAExport = mysqli_query($connect, 'select distinct DeviseCa from projets where DeviseCa is not null order by DeviseCa ASC');										
                                                                    while($rowCA = mysqli_fetch_array($reqCAExport, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowCA[0].'" >'.$rowCA[0].'</option>';
                                                                    }
                                                                ?>
                                                        </select>
                                                        <script>
                                                            ca = "<?php echo $ca; ?>";                                                                
                                                            document.getElementById("CA").selectedIndex = getIndex(ca, "CA");
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Devise</label></td>
                                                    <td>
                                                        <select name="devizy" id="devizy" style="width:179px" onblur="verifChampNul(this)">
                                                            <option selected></option>
                                                                <?php
                                                                    $monnaie = $resultInfoC -> Monnaie;
                                                                    $reqDeviseList = mysqli_query($connect,'select distinct Monnaie from projets where Monnaie is not null order by Monnaie ASC;');
                                                                    while($rowDevise = mysqli_fetch_array($reqDeviseList, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowDevise[0].'" >'.$rowDevise[0].'</option>';
                                                                    }
                                                                ?>
                                                        </select>
                                                        <script>
                                                            monnaie = "<?php echo $monnaie; ?>";                                                               
                                                            document.getElementById("devizy").selectedIndex = getIndex(monnaie, "devizy");
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Type Honoraire </label></td>
                                                    <td>
                                                        <select name="typehono" id="typehono" style="width:179px" onblur="verifChampNul(this)">
                                                            <option selected></option>
                                                                <?php
                                                                    $refhonotype = $resultInfoC -> Reftypehono;
                                                                    $reqListTypeHonoraire = mysqli_query($connect,'select distinct Reftypehono from projets where Reftypehono is not null order by Reftypehono ASC;');
                                                                    while($rowTypeHono = mysqli_fetch_array($reqListTypeHonoraire, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowTypeHono[0].'" >'.$rowTypeHono[0].'</option>';
                                                                    }
                                                                ?>                                            
                                                        </select>
                                                        <script>
                                                            refhonotype = "<?php echo $refhonotype; ?>";                                                                
                                                            document.getElementById("typehono").selectedIndex = getIndex(refhonotype, "typehono");
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Montant honoraire / HT</label></td>
                                                    <td><input type="double" name="montantHono" style="width:173px" id="montantHono" value="<?php echo(number_format($resultInfoC -> EstimationCoutTotalProjet,2, ".", " ")); ?>" onblur="verifChampNul(this)" /></td>
                                                </tr>                                                                                                                             
                                            </table>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul style=" list-style-type: none">
                                                <br><br>
                                            <table>
                                                <tr>
                                                    <td><label>Mode facturation.</label></td>
                                                    <td>
                                                        <select name="mod_fac" id="mod_fac" style="width:179px" onblur="verifChampNul(this)">
                                                            <option selected></option>
                                                                <?php
                                                                    $honomode = $resultInfoC -> Modefachono;
                                                                    $reqModFacturation = mysqli_query($connect,'select distinct Modefachono from projets where Modefachono is not null order by Modefachono ASC;');
                                                                    while($rowModFac = mysqli_fetch_array($reqModFacturation, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowModFac[0].'" >'.$rowModFac[0].'</option>';
                                                                    }
                                                                ?>                                            
                                                        </select>
                                                        <script>
                                                            honomode = "<?php echo $honomode; ?>";                                                               
                                                            document.getElementById("mod_fac").selectedIndex = getIndex(honomode, "mod_fac");
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labDeb" for="debPayer">D&eacute;bours &agrave; payer</label></td>
                                                    <td>
                                                        <select name="debPayer" id="debPayer" style="width:179px" onblur="verifChampNul(this)">
                                                            <option></option>
                                                                <?php
                                                                    $refactDebours = $resultInfoC -> Deboursrefact;
                                                                    $reqDebApayer = mysqli_query($connect,'select distinct Deboursrefact from projets where Deboursrefact is not null order by Deboursrefact ASC;');
                                                                    while($rowDebPayer = mysqli_fetch_array($reqDebApayer, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowDebPayer[0].'" >'.$rowDebPayer[0].'</option>';
                                                                    }
                                                                ?>
                                                        </select>
                                                        <script>
                                                            refactDebours = "<?php echo $refactDebours; ?>";                                                                
                                                            document.getElementById("debPayer").selectedIndex = getIndex(refactDebours, "debPayer");
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labDebMod" for="modFact" style="display: none">Mode fact d&eacute;bours </label></td>
                                                    <td><input type="text" name="modFact" style="width:173px" id="modFact" value="<?php echo($resultInfoC -> Modefacdebour) ?>" style="display: none"/></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="labMontantDeb" for="montantDeb" style="display: none">Montant d&eacute;bours </label></td>
                                                    <td><input type="double" name="montantDeb" style="width:173px" id="montantDeb" value="<?php echo(number_format($resultInfoC -> EstimationCoutDebours,2, ".", " ")) ?>"  style="display: none"/></td>
                                                </tr>
                                            </table>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td>
                                            <ul style=" list-style-type: none">
                                                <br><br>
                                                <legend><b>Affectation Département</b></legend>
                                                <div style="max-height: 200px;overflow: scroll; top: 50px">
                                                <table id="echeance">                                                                                        
                                                    <tr>
                                                        <td>Département</td> 
                                                        <td>Manager</td> 
                                                        <td>Associé</td>
                                                    </tr>
                                                    <?php
                                                    $qdep   = 'select count(1) as nbdep from departement;';
                                                    $resdep = mysqli_query($connect,$qdep);
                                                    $fecdep = mysqli_fetch_assoc($resdep);
                                                    $nbdep  = $fecdep['nbdep'];
                                                    $j = 1;
                                                    $reqAffecMission = 'select D.Departement as Département, E.Prenom as Manager, E2.Prenom as Associé 
                                                        from departement D
                                                    inner join deptprojet DP on (DP.Coddept = D.Coddept)
                                                    inner join projets P on (P.RefProjet = DP.RefProjet)
                                                    inner join employes E on (E.RefEmploye = DP.Respvalid)
                                                    inner join employes E2 on (E2.RefEmploye = DP.Dirmission)
                                                    where P.RefProjet = "'.$codeMission.'";';
                                                    $reqMissionAffect = mysqli_query($connect, $reqAffecMission);
                                                    $colonne = mysqli_num_fields($reqMissionAffect); //col
                                                    $ligne = mysqli_num_rows($reqMissionAffect); //rows
//                                                    echo ' ligne: '.$ligne.' colonnee: '.$colonne;
                                                    
                                                    $qdep   = 'select count(1) as nbdep from departement;';
                                                    $resdep = mysqli_query($connect,$qdep);
                                                    $fecdep = mysqli_fetch_assoc($resdep);
                                                    $nbdep  = $fecdep['nbdep'];
//                                                    echo '<br/>nbdep: '.$nbdep;
                                                    $j = 1;
                                                                                                                
                                                        while($row = mysqli_fetch_array($reqMissionAffect, MYSQLI_BOTH)){                                                           
                                                            echo '<tr>';
                                                            for($m=0; $m < $colonne ; $m++){
                                                                switch ($m){
                                                                    case 0:
                                                                        echo '<td>';
                                                                            echo '<select class="trans" name="deptList[]" id=name="deptList[]" style="width:125px" >';
                                                                            echo '<option></option>';
                                                                            echo '<option selected>'.$row[$m].'</option>';
                                                                                $reqDepList = 'select Departement from departement order by Departement ASC;';
                                                                                $resultDepList = mysqli_query($connect,$reqDepList);
                                                                                while($rowDepList = mysqli_fetch_array($resultDepList, MYSQLI_BOTH)){
                                                                                    echo '<option value="'.$rowDepList[0].'" >'.$rowDepList[0].'</option>';
                                                                                }
                                                                            echo '</select>';                                                                           
                                                                        echo '</td>';
                                                                        break;
                                                                    case 1:
                                                                        echo '<td>';
                                                                            echo '<select class="trans" name="managerList[]" style="width:125px">';
                                                                                echo '<option></option>';
                                                                                echo '<option selected>'.$row[$m].'</option>';
                                                                                $reqManagerList = 'select Prenom from employes where Profil = "Manager" or Profil like "%Associé%" order by Prenom ASC;';
                                                                                $resultManagerList = mysqli_query($connect,$reqManagerList);
                                                                                while($rowManagerList = mysqli_fetch_array($resultManagerList, MYSQLI_BOTH)){
                                                                                    echo '<option value="'.$rowManagerList[0].'" >'.$rowManagerList[0].'</option>';
                                                                                }
                                                                            echo '</select>';
                                                                        echo '</td>';
                                                                        break;
                                                                    case 2:
                                                                        echo '<td>';
                                                                            echo '<select class="trans" name="assocList[]" style="width:125px">';
                                                                                echo '<option></option>';
                                                                                echo '<option selected>'.$row[$m].'</option>';
                                                                                $reqAssocList = 'select Prenom from employes where Profil = "Associé" order by Prenom ASC' ;
                                                                                $resultAssocList = mysqli_query($connect,$reqAssocList);
                                                                                while($rowAssocList = mysqli_fetch_array($resultAssocList, MYSQLI_BOTH)){
                                                                                    echo '<option value="'.$rowAssocList[0].'" >'.$rowAssocList[0].'</option>';
                                                                                }
                                                                            echo '</select>';
                                                                        echo '</td>';
                                                                        break;
                                                                }                                                                
                                                            }
                                                            echo '</tr>';
                                                        } 
                                                        
                                                    for ($j; $j<=20; $j++){
                                                        echo '<tr name="'.$j.'">                                        
                                                            <td>';
                                                            if($j == 1){
                                                                echo '        <select class="trans" name="deptList[]" style="width:125px" onblur="verifChampNul(this)">';
                                                            }
                                                            else{
                                                                echo '        <select class="trans" name="deptList[]" style="width:125px" >';
                                                            }

                                                        echo '        <option></option>';
                                                                    $reqDepList = 'select Departement from departement order by Departement ASC;';
                                                                    $resultDepList = mysqli_query($connect,$reqDepList);
                                                                    while($rowDepList = mysqli_fetch_array($resultDepList, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowDepList[0].'" >'.$rowDepList[0].'</option>';
                                                                    }
                                                        echo '  </select>
                                                            </td>                                                                                        
                                                            <td>';
                                                            if($j == 1){
                                                                echo '      <select class="trans" name="managerList[]" style="width:125px"> onblur="verifChampNul(this)"';
                                                            }
                                                            else{
                                                                echo '      <select class="trans" name="managerList[]" style="width:125px">';
                                                            }
                                                        echo '            <option></option>';
                                                                    $reqManagerList = 'select Prenom from employes where Profil = "Manager" or Profil like "%Associé%" order by Prenom ASC;';
                                                                    $resultManagerList = mysqli_query($connect,$reqManagerList);
                                                                    while($rowManagerList = mysqli_fetch_array($resultManagerList, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowManagerList[0].'" >'.$rowManagerList[0].'</option>';
                                                                    }
                                                        echo '  </select>
                                                            </td>
                                                            <td>';
                                                            if($j == 1){
                                                                echo '        <select class="trans" name="assocList[]" style="width:125px"> onblur="verifChampNul(this)"';
                                                            }
                                                            else{
                                                                echo '        <select class="trans" name="assocList[]" style="width:125px">';
                                                            }
                                                        echo '            <option></option>';
                                                                    $reqAssocList = 'select Prenom from employes where Profil = "Associé" order by Prenom ASC' ;
                                                                    $resultAssocList = mysqli_query($connect,$reqAssocList);
                                                                    while($rowAssocList = mysqli_fetch_array($resultAssocList, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowAssocList[0].'" >'.$rowAssocList[0].'</option>';
                                                                    }
                                                        echo '  </select>  
                                                            </td>
                                                        </tr>';
                                                    }
                                                    ?>
                                                </table>
                                                </div>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul style=" list-style-type: none">
                                                <br><br>
                                                <legend><b>Intervenants</b></legend>
                                                <div style="max-height: 200px;overflow: scroll; top: 50px">
                                                <table id="echeance">                                                                                        
                                                    <tr>
                                                        <td>Consultant</td> 
                                                        <td>Profil</td> 
                                                        <td>Nombre JH</td> 
                                                        <td>Tarif JH</td> 
                                                        <td>Montant</td> 
                                                    </tr>
                                                    <?php
                                                    $montant = array();
                                                    $total = 0;
                                                    $reqInterv = 'select E.prenom as Consultant, PR.Protarif as Profil, J.NombreJH as NombreJH, J.TarifJH as TarifJH, J.NombreJH*J.TarifJH as Montant from jhprevu J
                                                    inner join employes E on (E.RefEmploye = J.RefEmploye)
                                                    inner join protarif PR on (PR.Protarif = J.Protarif)
                                                    inner join projets P on (P.RefProjet = J.RefProjet)
                                                    where P.RefProjet = "'.$codeMission.'"';
                                                    $reqIntervenant = mysqli_query($connect, $reqInterv);
                                                    $colonneInterv = mysqli_num_fields($reqIntervenant); //col
                                                    $ligneInterv = mysqli_num_rows($reqIntervenant); //rows
                                                    
                                                    while($rowInterv = mysqli_fetch_array($reqIntervenant, MYSQLI_BOTH)){
                                                        echo '<tr>';
                                                        for($n=0;$n<$colonneInterv;$n++){
                                                            switch ($n){
                                                                case 0: echo '<td>'
                                                                    . '<select class="trans" name="nameCons[]" style="width:250px">'
                                                                    . '<option></option>'
                                                                    . '<option selected>'.$rowInterv[$n].'</option>';
                                                                        $reqnameConsList = 'select prenom from employes order by prenom ASC';
                                                                        $resultNameConsList = mysqli_query($connect,$reqnameConsList);
                                                                    while($rowNameConsList = mysqli_fetch_array($resultNameConsList, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowNameConsList[0].'" >'.$rowNameConsList[0].'</option>';
                                                                    }
                                                                        echo '</option>'
                                                                            . '</select>'

                                                                        . '</td>';
                                                                    break;    
                                                                case 1: echo '<td>'
                                                                            . '<select class="trans" name="prof[]" style="width:125px">  '
                                                                            . '<option></option>'
                                                                            . '<option selected>'.$rowInterv[$n].'</option>';
                                                                            $reqProfily = 'select Protarif from protarif order by Protarif ASC';
                                                                                $resultProfily = mysqli_query($connect,$reqProfily);
                                                                            while($rowProf = mysqli_fetch_array($resultProfily, MYSQLI_BOTH)){
                                                                                echo '<option value="'.$rowProf[0].'" >'.$rowProf[0].'</option>';
                                                                            }
                                                                        echo ''
                                                                            . '</select>'

                                                                        . '</td>';
                                                                        break;    
                                                                case 2: echo '<td><input type="double"  name="nbJH[]" value="'.$rowInterv[$n].'" style="width:100px" onclick="verifChampDynClear(this)"/></td>';
                                                                            break;
                                                                case 3: echo '<td><input type="double"  name="tarifJH[]" value="'.number_format((float)$rowInterv[$n], 2, ".", " ").'" style="width:115px"  onclick="verifChampDynClear(this)"/></td>';
                                                                            break;
                                                                case 4: echo '<td><input type="double"  readonly="true" name="montant[]" value="'.number_format((float)$rowInterv[$n], 2, ".", " ").'"  style="width:115px"/></td>';
                                                                    $montant[] = $rowInterv[$n];
                                                                    break;
                                                            }
                                                        }
                                                        echo '</tr>';
                                                    }
                                                    
                                                    foreach($montant as $val){
                                                        $total += $val;                                            
                                                    }

                                                    $k = 1;
                                                    for($k; $k<=20; $k++){
                                                        echo '<tr name="'.$k.'">                                        
                                                            <td>                                            
                                                                <select class="trans" name="nameCons[]" style="width:250px">                                            
                                                                    <option></option>';
                                                                    $reqnameConsList = 'select prenom from employes order by prenom ASC';
                                                                    $resultNameConsList = mysqli_query($connect,$reqnameConsList);
                                                                    while($rowNameConsList = mysqli_fetch_array($resultNameConsList, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowNameConsList[0].'" >'.$rowNameConsList[0].'</option>';
                                                                    }
                                                        echo '  </select>
                                                            </td>                                                                                        
                                                            <td>
                                                                <select class="trans" name="prof[]" style="width:125px">                                                
                                                                    <option></option>';
                                                                    $reqProfily = 'select Protarif from protarif order by Protarif ASC';
                                                                    $resultProfily = mysqli_query($connect,$reqProfily);
                                                                    while($rowProf = mysqli_fetch_array($resultProfily, MYSQLI_BOTH)){
                                                                        echo '<option value="'.$rowProf[0].'" >'.$rowProf[0].'</option>';
                                                                    }
                                                        echo '  </select>
                                                            </td>
                                                            <td><input type="double" name="nbJH[]" style="width:100px" onclick="verifChampDynClear(this)" /></td>
                                                            <td><input type="double" name="tarifJH[]" style="width:115px"  onclick="verifChampDynClear(this)" /></td>                                                            
                                                            <td><input type="double" readonly="true" name="montant[]" style="width:115px"/></td>
                                                        </tr>';
                                                    }
                                                    ?>
                                                    </table>
                                                </div>
                                            </ul>
                                        </td>
                                    </tr>                                    
                                </table>
                                    <div class="cout">
                                        <table>                                            
                                            <tr><b>Coût Total JH: </b><?php echo  number_format((float)$total, 2, ".", " ");?></tr>
                                        </table>
                                    </div>
                                    
                                <ul style=" list-style-type: none">
                                <br><br>
                                <legend><b>Echéance prévisionnelle de facturation</b></legend>
                                <div style="max-height: 200px;overflow: scroll; max-width: 1070px">
                                <table id="echeance">
                                    <tr>
                                        <td>Date échéance</td>
                                        <td>Honoraire Débours</td>
                                        <td>Intitulé</td>
                                        <td>% Contrat</td>
                                        <td>Devise</td>
                                        <td>Montant Prévisionnel</td>
                                    </tr>
                                    <?php
                                    $ligne = 20;
                                    $i = 1;
                                    $facttot = array();
                                    $totFac = 0;
                                    $reqFacturation = 'select F.Echeance as EcheanceDate, F.Typefac as HonoraireDebours, 
                                        F.Libelle as Intitulé, F.Pcontrat as PContrat, F.Monnaie as Devise, 
                                        F.Montant as MontantPrevisionnel 
                                        from facturation F
                                        inner join projets P on (P.RefProjet = F.RefProjet)
                                        where F.RefProjet = "'.$codeMission.'"';
                                    $reqFact = mysqli_query($connect, $reqFacturation);
                                    $colFact = mysqli_num_fields($reqFact); 
                                    $ligneFact = mysqli_num_rows($reqFact); 
                                    
                                    
                                    
                                    while($rowFac = mysqli_fetch_array($reqFact, MYSQLI_BOTH)){
                                        echo '<tr>';
                                            for($p=0; $p < $colFact ; $p++){
                                                switch ($p){
                                                    case 0:
                                                        echo '        <td><input type="date" name="echeanceDate[]" value="'.$rowFac[$p].'"  id="echeanceDate"  /></td>';
                                                        break;
                                                    case 1:
                                                        echo '       <td>                                            
                                                    <select class="trans" name="honodebours[]" style="width:173px" />
                                                    <option></option>
                                                    <option selected>'.$rowFac[$p].'</option>';
                                                    $ListHonoDebours = 'select distinct Typefac from facturation order by Typefac ASC';
                                                    $resultListHonoDeb = mysqli_query($connect,$ListHonoDebours);
                                                    while($rowHonoDeb = mysqli_fetch_array($resultListHonoDeb, MYSQLI_BOTH)){
                                                        echo '<option value="'.$rowHonoDeb[0].'" >'.$rowHonoDeb[0].'</option>';
                                                    }
                                        echo '      </select>
                                                </td>';
                                                        break;
                                                    case 2:
                                                        echo '         <td><input type="text" name="intitule[]" value="'.$rowFac[$p].'" style="width:190px" /></td>';
                                                        break;
                                                    case 3:
                                                        echo '        <td><input type="double" name="PContrat[]" value="'.$rowFac[$p].'" onclick="verifChampDynClear(this)"/></td>';
                                                        break;
                                                    case 4:
                                                        echo '        <td>
                                                    <select class="trans" name="devise[]" style="width:173px" >
                                                    <option></option>
                                                    <option selected>'.$rowFac[$p].'</option>';
                                                    $listDevise = 'select distinct Monnaie from facturation order by Monnaie ASC';
                                                    $resultDevise = mysqli_query($connect,$listDevise);
                                                    while($rowDevises = mysqli_fetch_array($resultDevise, MYSQLI_BOTH)){
                                                        echo '<option value="'.$rowDevises[0].'" >'.$rowDevises[0].'</option>';
                                                    }
                                        echo '      </select>
                                                </td>';
                                                        break;
                                                    case 5:
                                                        echo '        <td><input type="double" value="'.number_format((float)$rowFac[$p], 2, ".", " ").'" name="montantPrevisionnel[]" /></td>';
                                                        $facttot[] = $rowFac[$p];
                                                        break;
                                                }
                                            }
                                        echo '</tr>';
                                    }
                                    
                                    foreach($facttot as $valu){
                                        $totFac += $valu;                                            
                                    }
                                    
                                    for($i; $i<=$ligne;  $i++){
                                        echo '<tr name="'.$i.'">';
                                        echo '        <td><input type="date" name="echeanceDate[]" id="echeanceDate"  /></td>';
                                        echo '       <td>                                            
                                                    <select class="trans" name="honodebours[]" style="width:173px" />
                                                    <option></option>';
                                                    $ListHonoDebours = 'select distinct Typefac from facturation order by Typefac ASC';
                                                    $resultListHonoDeb = mysqli_query($connect,$ListHonoDebours);
                                                    while($rowHonoDeb = mysqli_fetch_array($resultListHonoDeb, MYSQLI_BOTH)){
                                                        echo '<option value="'.$rowHonoDeb[0].'" >'.$rowHonoDeb[0].'</option>';
                                                    }
                                        echo '      </select>
                                                </td>';
                                        echo '         <td><input type="text" name="intitule[]" style="width:190px" /></td>';
                                        echo '        <td><input type="double" name="PContrat[]" onclick="verifChampDynClear(this)"/></td>';
                                        echo '        <td>
                                                    <select class="trans" name="devise[]" style="width:173px" >
                                                    <option></option>';
                                                    $listDevise = 'select distinct Monnaie from facturation order by Monnaie ASC';
                                                    $resultDevise = mysqli_query($connect,$listDevise);
                                                    while($rowDevises = mysqli_fetch_array($resultDevise, MYSQLI_BOTH)){
                                                        echo '<option value="'.$rowDevises[0].'" >'.$rowDevises[0].'</option>';
                                                    }
                                        echo '      </select>
                                                </td>';
                                        echo '        <td><input type="double" name="montantPrevisionnel[]" /></td>
                                        </tr>';
                                    }
                                    ?>
                                </table>                                    
                                </div>
                                </ul>
                                   <div class="cout">
                                        <table>                                            
                                            <tr><b>Montant prévisionnelle total: </b><?php echo  number_format((float)$totFac, 2, ".", " ");?></tr>
                                        </table>
                                    </div>
                                    <br/><br/>
                                </form>
                                </center>
                                <?php                                 
                            }
                        }
                        
                        if (isset($_POST['modifier'])){
                            ?>
                                <script>
                                    document.modifMission.style.display = 'none';
                                    $('#note').css("display", "none");
                                </script>
                            <?php
                            //cloture de la mission                                                 
                            if(isset($_POST['cloturer'])){
                                $clo = 1;
                            }
                            else{
                                $clo = 0;
                            }                            
                            
                            //infos client
                            $cdeMission = $_POST['cdeMission'];
                            $mission = $_POST['mission'];
                            $client = $_POST['client'];$categorie = $_POST['categorie'];
                            $origine = $_POST['origine'];$typeClient = 

                            //infos admnistrative client
                            $typeClientSaisi = $_POST['typeClient'];        
                            if($typeClientSaisi == 'International' || $typeClientSaisi == 'Public' || $typeClientSaisi == 'ONG'){
                                $statSaisi  = "";
                                $nifSaisi   = "";
                                $cifSaisi   = "";
                                $rcsSaisi   = "";
                            }
                            else if($typeClientSaisi == 'Privé') {
                                $statSaisi  = $_POST['stat'];
                                $nifSaisi   = $_POST['nif'];
                                $cifSaisi   = $_POST['cif'];
                                $rcsSaisi   = $_POST['rcs'];
                            }    

                            //Infos contrat
                            $chef = $_POST['chef'];$signContrat = $_POST['signContrat'];$dteArchiv = $_POST['dteArchiv'];
                            $dtePrevu = $_POST['dtePrevu'];$dteFin = $_POST['dteFin'];$dbuReel = $_POST['dbuReel'];
                            $finReel = $_POST['finReel'];$paysMission = $_POST['paysMission'];$villeMission = $_POST['villeMission'];
                            $avenant = $_POST['avenant'];$dteAvenant = $_POST['dteAvenant'];

                            //infos facturation
                            $refSoc = $_POST['refSoc'];$interFac = $_POST['interFac'];$adresseFact = $_POST['adresseFact'];
                            $Coord= $_POST['Coord'];$CA = $_POST['CA'];$devizy = $_POST['devizy'];
                            $typehono = $_POST['typehono'];$montantHono = str_replace(" ", "", $_POST['montantHono']);$mod_fac = $_POST['mod_fac'];
                            $debPayer = $_POST['debPayer'];$modFact = $_POST['modFact'];$montantDeb = str_replace(" ", "", $_POST['montantDeb']);                                                        

                            //les dates non obligatoires
                            if(empty($_POST['signContrat'])){
                                //echo 'signContrat: '.$signContrat;
                                $signContrat = '0000-00-00';
                            }

                            if(empty($_POST['dteArchiv'])){
                                $dteArchiv = '0000-00-00';
                            }

                            if($avenant == 'NON'){
                                $dteAvenant = '0000-00-00';
                            }
                            
//                            if(empty($_POST['$dteAvenant'])){
//                                $dteAvenant = '0000-00-00';
//                            }

                            if(empty($_POST['dbuReel'])){
                                $dbuReel = '0000-00-00';
                            }

                            if(empty($_POST['finReel'])){
                                $finReel = '0000-00-00';
                            } 

                            $reqRefCli = 'select RefClient as REF from client where NomSociete="'.$client.'"';
                            $rekRefCli = mysqli_query($connect,$reqRefCli);											
                            $resultRefCli = mysqli_fetch_assoc($rekRefCli);
                            $CliRef = $resultRefCli['REF'];

                            $reqRefSoc = 'select RefSociete as SOC from societe where NomSociete = "'.$refSoc.'"';
                            $rekRefSoc = mysqli_query($connect,$reqRefSoc);											
                            $resultReSoc = mysqli_fetch_assoc($rekRefSoc);
                            $RefSoc = $resultReSoc['SOC'];                                                                
/*****************************************UPDATE PROJET: Infos client et infos contrat et infos facturation**************************/ 
                            $mysqli->query("SET AUTOCOMMIT=0");
                            $reqUpProjet = 'update projets set '
                                . 'NomProjet = "'.$mission.'", RefClient = "'.$CliRef.'", TypeProjet = "'.$categorie.'", Origine = "'.$origine.'",'
                                . 'Datesignature = "'.$signContrat.'", Datearchctr = "'.$dteArchiv.'", Avenantctr = "'.$avenant.'", Datesignaven = "'.$dteAvenant.'", Paysmission = "'.$paysMission.'", Villemission = "'.$villeMission.'", Chefmission = "'.$chef.'", DateDebutProjet = "'.$dtePrevu.'", DateFinProjet = "'.$dteFin.'", DateDebutR = "'.$dbuReel.'", DateFinR = "'.$finReel.'",'
                                . 'RefSociete = "'.$RefSoc.'", DeviseCa = "'.$CA.'", Reftypehono = "'.$typehono.'", Modefachono = "'.$mod_fac.'", Deboursrefact = "'.$debPayer.'", Modefacdebour = "'.$modFact.'", Interlocfacture = "'.$interFac.'", Adressefacture = "'.$adresseFact.'", Monnaie = "'.$devizy.'", EstimationCoutTotalProjet = "'.$montantHono.'", EstimationCoutDebours = "'.$montantDeb.'", Coordoninterloc = "'.$Coord.'",'
                                . 'typeclient = "'.$typeClientSaisi.'", stat = "'.$statSaisi.'", nif = "'.$nifSaisi.'", cif = "'.$cifSaisi.'", rcs = "'.$rcsSaisi.'", cloture = '.$clo.' '
                                . 'where RefProjet = "'.$cdeMission.'"';
                            $reqProjetM = mysqli_query($connect,$reqUpProjet);
                            
                            if (!$reqProjetM){
                                echo '<font color="red"><b><br />MAJ Information Mission &eacute;chou&eacute;e.<br/></font></b>';
                                $mysqli->query("ROLLBACK");
                                exit(mysqli_error($connect));
                            }
/***************************************** FIN UPDATE PROJET**************************/        
/*****************************************UPDATE deptprojet: affectation dpt**************************/ 
                            $reqKountAffect = 'select count(1) as konty from deptprojet '
                                    . 'where RefProjet = "'.$cdeMission.'"';
                            $rekKountAffect = mysqli_query($connect,$reqKountAffect);
                            $resultKountAffect = mysqli_fetch_assoc($rekKountAffect);
                            $countDept = $resultKountAffect['konty'];
//                            echo '<br />nb dept deja dans la base: '.$countDept; 
                            
                            //new affectation
                            if($countDept > 0){
                                $countDeptTot = count($_POST['deptList']);
//                                echo '<br>nb de ligne de dept existant: '.$countDeptTot;
                                $countDeptnonvide = 0;
                                for ($j=0; $j<$countDeptTot; $j++){
                                    if(empty($_POST['deptList'][$j])or empty($_POST['managerList'][$j]) or empty($_POST['assocList'][$j])){                                    
                                        break;
                                    }
                                    else{
                                        $countDeptnonvide = $countDeptnonvide + 1;
                                    }
                                }
//                                echo '<br/>nb total de dept non vide: '.$countDeptnonvide;
                                $newcountDept = $countDeptnonvide - $countDept;
//                                echo '<br/>nb new dept à inserer: '.$newcountDept;
                                
                                //modification et ajout dept
                                if($newcountDept > 0){                                                                       
                                    //update affectation des lignes dejà existantes
                                    $coddepM = array();
                                    $empM = array();
                                    $emplM = array();
                                    $tabCod = array();
                                    $reqCodeDept = 'select deptprojet.Coddept from deptprojet
                                        inner join projets on (projets.RefProjet = deptprojet.RefProjet)
                                        where deptprojet.RefProjet = "'.$cdeMission.'";';
                                    $reqCodeDep = mysqli_query($connect, $reqCodeDept);
                                    while($row = mysqli_fetch_row($reqCodeDep)){                                    
                                        $a=0;
                                            $tabCod[] = $row[$a];
                                        $a += $a;
                                    }
                                    for($i=0; $i<$countDept; $i++){
                                        $deptListM    = $_POST['deptList'][$i];
                                        $managerListM = $_POST['managerList'][$i];
                                        $assocListM   = $_POST['assocList'][$i];
                                        
                                        //code departement par ligne
                                        $reqCoddepM    = 'select Coddept as DEP from departement where Departement = "'.$deptListM.'"';
                                        $rekCoddepM    = mysqli_query($connect,$reqCoddepM);
                                        $resultCoddepM = mysqli_fetch_assoc($rekCoddepM);
                                        $coddepM[$i]   = $resultCoddepM['DEP'];
                                        //manager par departement par ligne
                                        $reqEmpM    = 'select RefEmploye as EMP from employes where Prenom = "'.$managerListM.'"';
                                        $rekEmpM    = mysqli_query($connect,$reqEmpM);
                                        $resultEmpM = mysqli_fetch_assoc($rekEmpM);
                                        $empM[$i]   = $resultEmpM['EMP'];
                                        //associé par departement par ligne
                                        $reqEmplM    = 'select RefEmploye as EMPL from employes where Prenom = "'.$assocListM.'"';
                                        $rekEmplM    = mysqli_query($connect,$reqEmplM);
                                        $resultEmplM = mysqli_fetch_assoc($rekEmplM);
                                        $emplM[$i]   = $resultEmplM['EMPL'];

//                                        echo '<br/>departement: '.$coddepM[$i].' manager: '.$empM[$i].' associé: '.$emplM[$i];
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpDeptProjet = 'update deptprojet '
                                            . 'inner join projets on (projets.RefProjet = deptprojet.RefProjet) '
                                            . 'set '
                                            . 'deptprojet.Coddept = "'.$coddepM[$i].'", deptprojet.Respvalid = "'.$empM[$i].'", deptprojet.Dirmission = "'.$emplM[$i].'" '
                                            . 'where deptprojet.RefProjet = "'.$cdeMission.'" and deptprojet.Coddept="'.$tabCod[$i].'"'; 

                                        $reqDeptprojetM = mysqli_query($connect,$reqUpDeptProjet);
                                        if(!$reqDeptprojetM){
                                            ?>
                                                <script>
                                                    document.missionNew.style.display = 'none';
                                                    $('#note').css("display", "none");
                                                </script>
                                            <?php 
                                            echo '<font color="red"><b>Erreur au niveau: Modification Affectation Département</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                            $mysqli->query("ROLLBACK");
    //                                        exit(1);
                                        }
                                    }                                    
                                    
                                    // ajout nouveau dept
                                    for($i=$countDept; $i<$countDeptnonvide; $i++){
                                        $deptList = $_POST['deptList'][$i];
                                        $managerList = $_POST['managerList'][$i];
                                        $assocList = $_POST['assocList'][$i];
                                        
                                        //code departement par ligne
                                        $reqCoddep    = 'select Coddept as DEP from departement where Departement = "'.$deptList.'"';
                                        $rekCoddep    = mysqli_query($connect,$reqCoddep);
                                        $resultCoddep = mysqli_fetch_assoc($rekCoddep);
                                        $coddep[$j]   = $resultCoddep['DEP'];
                                        //manager par departement par ligne
                                        $reqEmp    = 'select RefEmploye as EMP from employes where Prenom = "'.$managerList.'"';
                                        $rekEmp    = mysqli_query($connect,$reqEmp);
                                        $resultEmp = mysqli_fetch_assoc($rekEmp);
                                        $emp[$j]   = $resultEmp['EMP'];
                                        //associé par departement par ligne
                                        $reqEmpl    = 'select RefEmploye as EMPL from employes where Prenom = "'.$assocList.'"';
                                        $rekEmpl    = mysqli_query($connect,$reqEmpl);
                                        $resultEmpl = mysqli_fetch_assoc($rekEmpl);
                                        $empl[$j]   = $resultEmpl['EMPL'];

//                                        echo '<br/>departement: '.$coddep[$j].' manager: '.$emp[$j].' associé: '.$empl[$j];
                                        
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqinsertDeptprojet = 'insert into deptprojet '
                                            . '(RefProjet, Coddept, Respvalid, Dirmission) values '
                                            . '("'.$cdeMission.'", "'.$coddep[$j].'", "'.$emp[$j].'", "'.$empl[$j].'")';                                    
                                        $reqDeptprojet = mysqli_query($connect,$reqinsertDeptprojet);
                                        if(!$reqDeptprojet){
                                            ?>
                                                <script>
                                                    document.missionNew.style.display = 'none';
                                                    $('#note').css("display", "none");
                                                </script>
                                            <?php 
                                            echo '<font color="red"><b>Erreur au niveau: Insertion de nouvelle affectation Département</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                            $mysqli->query("ROLLBACK");
    //                                        exit(1);
                                        }
                                    }
                                }
                                //modification dept only
                                else if($newcountDept == 0){                                                                                                            
                                    $coddepM = array();
                                    $empM = array();
                                    $emplM = array();
                                    $tabCod = array();
                                    $reqCodeDept = 'select deptprojet.Coddept from deptprojet
                                        inner join projets on (projets.RefProjet = deptprojet.RefProjet)
                                        where deptprojet.RefProjet = "'.$cdeMission.'";';
                                    $reqCodeDep = mysqli_query($connect, $reqCodeDept);
                                    while($row = mysqli_fetch_row($reqCodeDep)){                                    
                                        $a=0;
                                            $tabCod[] = $row[$a];
                                        $a += $a;
                                    }
                                    for($i=0; $i<$countDept; $i++){
                                        $deptListM    = $_POST['deptList'][$i];
                                        $managerListM = $_POST['managerList'][$i];
                                        $assocListM   = $_POST['assocList'][$i];
                                        
                                        //code departement par ligne
                                        $reqCoddepM    = 'select Coddept as DEP from departement where Departement = "'.$deptListM.'"';
                                        $rekCoddepM    = mysqli_query($connect,$reqCoddepM);
                                        $resultCoddepM = mysqli_fetch_assoc($rekCoddepM);
                                        $coddepM[$i]   = $resultCoddepM['DEP'];
                                        //manager par departement par ligne
                                        $reqEmpM    = 'select RefEmploye as EMP from employes where Prenom = "'.$managerListM.'"';
                                        $rekEmpM    = mysqli_query($connect,$reqEmpM);
                                        $resultEmpM = mysqli_fetch_assoc($rekEmpM);
                                        $empM[$i]   = $resultEmpM['EMP'];
                                        //associé par departement par ligne
                                        $reqEmplM    = 'select RefEmploye as EMPL from employes where Prenom = "'.$assocListM.'"';
                                        $rekEmplM    = mysqli_query($connect,$reqEmplM);
                                        $resultEmplM = mysqli_fetch_assoc($rekEmplM);
                                        $emplM[$i]   = $resultEmplM['EMPL'];

//                                        echo '<br/>departement: '.$coddepM[$i].' manager: '.$empM[$i].' associé: '.$emplM[$i];
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpDeptProjet = 'update deptprojet '
                                            . 'inner join projets on (projets.RefProjet = deptprojet.RefProjet) '
                                            . 'set '
                                            . 'deptprojet.Coddept = "'.$coddepM[$i].'", deptprojet.Respvalid = "'.$empM[$i].'", deptprojet.Dirmission = "'.$emplM[$i].'" '
                                            . 'where deptprojet.RefProjet = "'.$cdeMission.'" and deptprojet.Coddept="'.$tabCod[$i].'"'; 

                                        $reqDeptprojetM = mysqli_query($connect,$reqUpDeptProjet);
                                        if(!$reqDeptprojetM){
                                            ?>
                                                <script>
                                                    document.missionNew.style.display = 'none';
                                                    $('#note').css("display", "none");
                                                </script>
                                            <?php 
                                            echo '<font color="red"><b>Erreur au niveau: Modification Affectation Département</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                            $mysqli->query("ROLLBACK");
    //                                        exit(1);
                                        }
                                    }
                                }                                
                            }
                            
/*****************************************FIN UPDATE deptprojet**************************/
                            
/*****************************************UPDATE jhprevu: affectation intervenants**************************/
                            $reqCons = 'select count(1) as kountyCons from jhprevu '
                                    . 'where RefProjet = "'.$cdeMission.'"';
                            $rekCons = mysqli_query($connect,$reqCons);
                            $resultCons = mysqli_fetch_assoc($rekCons);
                            $kountyCons = $resultCons['kountyCons'];
//                            echo '<br />nb intervenant deja dans la base: '.$countDept;
                            
                            if($kountyCons > 0){
                                $countIntervTot = count($_POST['nameCons']);
//                                echo '<br>nb de ligne d interv existant: '.$countIntervTot;
                                $countIntnonvide = 0;
                                for ($j=0; $j<$countIntervTot; $j++){
                                    if(empty($_POST['nameCons'][$j]) or empty($_POST['prof'][$j])or empty($_POST['nbJH'][$j]) or empty($_POST['tarifJH'][$j])){                                    
                                        break;
                                    }
                                    else{
                                        $countIntnonvide = $countIntnonvide + 1;
                                    }
                                }                                
//                                echo '<br/>nb total ligne interv non vide: '.$countIntnonvide;
                                $newcountInterv = $countIntnonvide - $kountyCons;
//                                echo '<br/>nb new interv à inserer: '.$newcountInterv;
                                
                                //modification et ajout interv
                                if($newcountInterv > 0){
                                    //update des intervenants dejà existants
                                    $montant = array();
                                    $countConsM = count($_POST['nameCons']);
                                    $ConsM = array();
                                    $ProM = array();
                                    $nbJHM = array();
                                    $tarifJHM =  array();
                                    $tabRefEmpl = array();
                                    $reqRefEmp = 'select jhprevu.RefEmploye from jhprevu 
                                        inner join employes on (employes.RefEmploye = jhprevu.RefEmploye)
                                        inner join protarif on (protarif.Protarif = jhprevu.Protarif)
                                        inner join projets on (projets.RefProjet = jhprevu.RefProjet)
                                        where projets.RefProjet = "'.$cdeMission.'"';
                                    $resultRefEmp = mysqli_query($connect, $reqRefEmp);
                                    while($row = mysqli_fetch_row($resultRefEmp)){                                    
                                        $k=0;
                                            $tabRefEmpl[] = $row[$k];
                                        $k += $k;
                                    }
                                    for($k=0 ; $k < $kountyCons ; $k++){
                                        $nameConsM = $_POST['nameCons'][$k];
                                        $profM = $_POST['prof'][$k];
                                        $nbJHM[$k] = $_POST['nbJH'][$k];
                                        $tarifJHM[$k] = str_replace(" ", "", $_POST['tarifJH'][$k]);
                                        
                                        $reqConsM = 'select RefEmploye as consu from employes where prenom = "'.$nameConsM.'"';
                                        $rekConsM = mysqli_query($connect,$reqConsM);
                                        $resultConsM = mysqli_fetch_assoc($rekConsM);
                                        $ConsM[$k] = $resultConsM['consu'];
                                        
                                        $reqProM = 'select Protarif as PR from protarif where Protarif="'.$profM.'"';
                                        $rekProM = mysqli_query($connect,$reqProM);
                                        $resultProM = mysqli_fetch_assoc($rekProM);
                                        $ProM[$k] = $resultProM['PR']; 
                                        
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpJhprevu = 'update jhprevu '
                                            . 'inner join employes on (employes.RefEmploye = jhprevu.RefEmploye) '
                                            . 'inner join protarif on (protarif.Protarif = jhprevu.Protarif) '
                                            . 'inner join projets on (projets.RefProjet = jhprevu.RefProjet) '
                                            . 'set '                                                
                                            . 'jhprevu.RefEmploye = "'.$ConsM[$k].'", jhprevu.Protarif = "'.$ProM[$k].'",'
                                                . ' jhprevu.NombreJH = "'.$nbJHM[$k].'", '
                                                . 'jhprevu.TarifJH = "'.$tarifJHM[$k].'"'
                                            . 'where jhprevu.RefProjet = "'.$cdeMission.'" and jhprevu.RefEmploye="'.$tabRefEmpl[$k].'"';
                                        $reqJhprevuM = mysqli_query($connect,$reqUpJhprevu);
                                        if(!$reqJhprevuM){
                                            ?>
                                                <script>
                                                    document.missionNew.style.display = 'none';
                                                    $('#note').css("display", "none");
                                                </script>
                                            <?php 
                                            echo '<font color="red"><b>Erreur au niveau: Modification Intervenants</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                            $mysqli->query("ROLLBACK");
    //                                        exit(1);
                                        }
                                    }
                                    
                                    //ajout nouveau intervenant
                                    $cons = array();
                                    $Pro = array();
                                    $nbJH = array();
                                    $tarifJH =  array();
                                    for($k=$kountyCons ; $k < $countIntnonvide ; $k++){
                                        $nameCons    = $_POST['nameCons'][$k];
                                        $prof        = $_POST['prof'][$k];
                                        //nbJH par ligne
                                        $nbJH[$k]    = $_POST['nbJH'][$k];
                                        //montant par ligne
                                        $tarifJH[$k] = str_replace(" ", "", $_POST['tarifJH'][$k]);
                                        $reqCons = 'select RefEmploye as consu from employes where prenom = "'.$nameCons.'"';
                                        $rekCons = mysqli_query($connect,$reqCons);
                                        $resultCons = mysqli_fetch_assoc($rekCons);
                                        $Cons[$k] = $resultCons['consu'];
                                        //profil par ligne
                                        $reqPro = 'select Protarif as PR from protarif where Protarif="'.$prof.'"';
                                        $rekPro = mysqli_query($connect,$reqPro);
                                        $resultPro = mysqli_fetch_assoc($rekPro);
                                        $Pro[$k] = $resultPro['PR'];                                    
    //                                    echo '<br/>cons: '.$Cons[$k].' prof: '.$Pro[$k].' nbJH: '.$nbJH[$k].' montant: '.$tarifJH[$k];
                                        
                                        $reqInsertJhprevu = 'insert into jhprevu '
                                        . '(RefProjet, RefEmploye, Protarif, NombreJH, TarifJH) values '
                                        . '("'.$cdeMission.'", "'.$Cons[$k].'", "'.$Pro[$k].'", "'.$nbJH[$k].'", "'.$tarifJH[$k].'")';
                                        $reqJhprevu = mysqli_query($connect,$reqInsertJhprevu);
                                        if(!$reqJhprevu){
                                            ?>
                                                <script>
                                                    document.missionNew.style.display = 'none';
                                                    $('#note').css("display", "none");
                                                </script>
                                            <?php 
                                            echo '<font color="red"><b>Erreur au niveau: Ajout nouveaux intervenants</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                            $mysqli->query("ROLLBACK");
    //                                        exit(1);
                                        }
                                    }
                                }
                                else if($newcountInterv == 0){                                    
                                    //update des intervenants dejà existants
                                    $montant = array();
                                    $countConsM = count($_POST['nameCons']);
                                    $ConsM = array();
                                    $ProM = array();
                                    $nbJHM = array();
                                    $tarifJHM =  array();
                                    $tabRefEmpl = array();
                                    $reqRefEmp = 'select jhprevu.RefEmploye from jhprevu 
                                        inner join employes on (employes.RefEmploye = jhprevu.RefEmploye)
                                        inner join protarif on (protarif.Protarif = jhprevu.Protarif)
                                        inner join projets on (projets.RefProjet = jhprevu.RefProjet)
                                        where projets.RefProjet = "'.$cdeMission.'"';
                                    $resultRefEmp = mysqli_query($connect, $reqRefEmp);
                                    while($row = mysqli_fetch_row($resultRefEmp)){                                    
                                        $k=0;
                                            $tabRefEmpl[] = $row[$k];
                                        $k += $k;
                                    }
                                    for($k=0 ; $k < $kountyCons ; $k++){
                                        $nameConsM = $_POST['nameCons'][$k];
                                        $profM = $_POST['prof'][$k];
                                        $nbJHM[$k] = $_POST['nbJH'][$k];
                                        $tarifJHM[$k] = str_replace(" ", "", $_POST['tarifJH'][$k]);
                                        
                                        $reqConsM = 'select RefEmploye as consu from employes where prenom = "'.$nameConsM.'"';
                                        $rekConsM = mysqli_query($connect,$reqConsM);
                                        $resultConsM = mysqli_fetch_assoc($rekConsM);
                                        $ConsM[$k] = $resultConsM['consu'];
                                        
                                        $reqProM = 'select Protarif as PR from protarif where Protarif="'.$profM.'"';
                                        $rekProM = mysqli_query($connect,$reqProM);
                                        $resultProM = mysqli_fetch_assoc($rekProM);
                                        $ProM[$k] = $resultProM['PR']; 
                                        
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpJhprevu = 'update jhprevu '
                                            . 'inner join employes on (employes.RefEmploye = jhprevu.RefEmploye) '
                                            . 'inner join protarif on (protarif.Protarif = jhprevu.Protarif) '
                                            . 'inner join projets on (projets.RefProjet = jhprevu.RefProjet) '
                                            . 'set '                                                
                                            . 'jhprevu.RefEmploye = "'.$ConsM[$k].'", jhprevu.Protarif = "'.$ProM[$k].'",'
                                                . ' jhprevu.NombreJH = "'.$nbJHM[$k].'", '
                                                . 'jhprevu.TarifJH = "'.$tarifJHM[$k].'"'
                                            . 'where jhprevu.RefProjet = "'.$cdeMission.'" and jhprevu.RefEmploye="'.$tabRefEmpl[$k].'"';
                                        $reqJhprevuM = mysqli_query($connect,$reqUpJhprevu);
                                        if(!$reqJhprevuM){
                                            ?>
                                                <script>
                                                    document.missionNew.style.display = 'none';
                                                    $('#note').css("display", "none");
                                                </script>
                                            <?php 
                                            echo '<font color="red"><b>Erreur au niveau: Modification Intervenants</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                            $mysqli->query("ROLLBACK");
    //                                        exit(1);
                                        }
                                    }
                                }
                            }
                            if($kountyCons == 0){
                                $countIntervTot = count($_POST['nameCons']);
//                                echo '<br>nb de ligne d interv existant: '.$countIntervTot;
                                $countIntnonvide = 0;
                                for ($j=0; $j<$countIntervTot; $j++){
                                    if(empty($_POST['nameCons'][$j]) or empty($_POST['prof'][$j])or empty($_POST['nbJH'][$j]) or empty($_POST['tarifJH'][$j])){                                    
                                        break;
                                    }
                                    else{
                                        $countIntnonvide = $countIntnonvide + 1;
                                    }
                                }                                
//                                echo '<br/>nb total ligne interv non vide: '.$countIntnonvide;
                                $newcountInterv = $countIntnonvide - $kountyCons;
//                                echo '<br/>nb new dept à inserer: '.$newcountInterv;
                                
                                 //ajout nouveau intervenant
                                    $cons = array();
                                    $Pro = array();
                                    $nbJH = array();
                                    $tarifJH =  array();
                                    for($k=0 ; $k < $countIntnonvide ; $k++){
                                        $nameCons    = $_POST['nameCons'][$k];
                                        $prof        = $_POST['prof'][$k];
                                        //nbJH par ligne
                                        $nbJH[$k]    = $_POST['nbJH'][$k];
                                        //montant par ligne
                                        $tarifJH[$k] = str_replace(" ", "", $_POST['tarifJH'][$k]);
                                        $reqCons = 'select RefEmploye as consu from employes where prenom = "'.$nameCons.'"';
                                        $rekCons = mysqli_query($connect,$reqCons);
                                        $resultCons = mysqli_fetch_assoc($rekCons);
                                        $Cons[$k] = $resultCons['consu'];
                                        //profil par ligne
                                        $reqPro = 'select Protarif as PR from protarif where Protarif="'.$prof.'"';
                                        $rekPro = mysqli_query($connect,$reqPro);
                                        $resultPro = mysqli_fetch_assoc($rekPro);
                                        $Pro[$k] = $resultPro['PR'];                                    
    //                                    echo '<br/>cons: '.$Cons[$k].' prof: '.$Pro[$k].' nbJH: '.$nbJH[$k].' montant: '.$tarifJH[$k];
                                        
                                        $reqInsertJhprevu = 'insert into jhprevu '
                                        . '(RefProjet, RefEmploye, Protarif, NombreJH, TarifJH) values '
                                        . '("'.$cdeMission.'", "'.$Cons[$k].'", "'.$Pro[$k].'", "'.$nbJH[$k].'", "'.$tarifJH[$k].'")';
                                        $reqJhprevu = mysqli_query($connect,$reqInsertJhprevu);
                                        if(!$reqJhprevu){
                                            ?>
                                                <script>
                                                    document.missionNew.style.display = 'none';
                                                    $('#note').css("display", "none");
                                                </script>
                                            <?php 
                                            echo '<font color="red"><b>Erreur au niveau: Ajout nouveaux intervenants</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                            $mysqli->query("ROLLBACK");
    //                                        exit(1);
                                        }
                                    }
                                
                                
                            }
/*****************************************FIN jhprevu: affectation intervenants**************************/                             
/*****************************************facturation: echeance pervisionnelle**************************/ 
                            $reqFact = 'select count(1) as kountyFact from facturation '
                                    . 'where RefProjet = "'.$cdeMission.'"';
                            $rekFact = mysqli_query($connect,$reqFact);
                            $resultFact = mysqli_fetch_assoc($rekFact);
                            $kountyFact = $resultFact['kountyFact'];
//                            echo '<br />nb fact deja dans la base: '.$kountyFact; 
                            
                            if($kountyFact > 0){
                                $countFactTot = count($_POST['echeanceDate']);
//                                echo '<br>nb de ligne de fact existant: '.$countFactTot;
                                $countFactnonvide = 0;
                                for ($j=0; $j<$countFactTot; $j++){
                                    if(empty($_POST['echeanceDate'][$j]) or empty($_POST['honodebours'][$j]) or empty($_POST['intitule'][$j])
                                        or empty($_POST['PContrat'][$j]) or empty($_POST['devise'][$j]) or empty($_POST['montantPrevisionnel'][$j])){                                                                        
                                        break;
                                    }
                                    else{
                                        $countFactnonvide = $countFactnonvide + 1;
                                    }
                                }
//                                echo '<br/>nb total de fact non vide: '.$countFactnonvide;
                                $newcountFact = $countFactnonvide - $kountyFact;
//                                echo '<br/>nb new fact à inserer: '.$newcountFact;
                                
                                //modification et ajout fact
                                if($newcountFact > 0){
                                    //update ligne fact dejà existante
                                    $echeanceDateM = $_POST['echeanceDate'];$honodeboursM = $_POST['honodebours'];
                                    $intituleM = $_POST['intitule'];$PContratM = $_POST['PContrat'];
                                    $deviseM = $_POST['devise'];$montantPrevisionnelM = $_POST['montantPrevisionnel'];
                                    
                                    $echeanceDateM = array();
                                    $honodeboursM = array();
                                    $intituleM = array();
                                    $PContratM = array();
                                    $deviseM = array();
                                    $montantPrevisionnelM = array();
                                    $tabFact = array();
                                    $reqFacturation = 'select facturation.Idauto from facturation 
                                        inner join projets on (projets.RefProjet = facturation.RefProjet)
                                        where facturation.RefProjet = "'.$cdeMission.'"';
                                    $resultFact = mysqli_query($connect, $reqFacturation);
                                    while($row = mysqli_fetch_row($resultFact)){                                    
                                        $j=0;
                                            $tabFact[] = $row[$j];
                                        $j += $j;
                                    }
                                    for ($j = 0; $j < $kountyFact; $j++){
                                        $echeanceDateM[$j] = $_POST['echeanceDate'][$j];
                                        $honodeboursM[$j] = $_POST['honodebours'][$j];
                                        $intituleM[$j] = $_POST['intitule'][$j];
                                        $PContratM[$j] = $_POST['PContrat'][$j];
                                        $deviseM[$j] = $_POST['devise'][$j];
                                        $montantPrevisionnelM[$j] = str_replace(" ", "", $_POST['montantPrevisionnel'][$j]);
                                        
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpFact = 'update facturation '
                                            . 'inner join projets on (projets.RefProjet = facturation.RefProjet) '
                                            . 'set '
                                            . 'facturation.Echeance = "'.$echeanceDateM[$j].'", facturation.Typefac = "'.$honodeboursM[$j].'", facturation.Libelle = "'.$intituleM[$j].'", facturation.Pcontrat = "'.$PContratM[$j].'", facturation.Monnaie = "'.$deviseM[$j].'", facturation.Montant = "'.$montantPrevisionnelM[$j].'"'
                                            . 'where facturation.RefProjet = "'.$cdeMission.'" and facturation.Idauto = "'.$tabFact[$j].'"';                                  
                                        $reqfacturationM = mysqli_query($connect,$reqUpFact);
                                        if(!$reqfacturationM){
                                            ?>
                                                <script>
                                                    document.missionNew.style.display = 'none';
                                                    $('#note').css("display", "none");
                                                </script>
                                            <?php 
                                            echo '<font color="red"><b>Erreur au niveau: Modification Echeance prévisionnelle<b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                            $mysqli->query("ROLLBACK");
    //                                        exit(1);
                                        }
                                    }
                                    
                                    //insertion nouvelle ligne de facturation
                                    $echeanceDate = array();
                                    $honodebours = array();
                                    $intitule = array();
                                    $PContrat = array();
                                    $devise = array();
                                    $montantPrevisionnel = array();
                                    for ($j = $kountyFact; $j < $countFactnonvide; $j++){                                        
                                        $echeanceDate[$j] = $_POST['echeanceDate'][$j];
                                        $honodebours[$j] = $_POST['honodebours'][$j];
                                        $intitule[$j] = $_POST['intitule'][$j];
                                        $PContrat[$j] = $_POST['PContrat'][$j];
                                        $devise[$j] = $_POST['devise'][$j];
                                        $montantPrevisionnel[$j] = str_replace(" ", "", $_POST['montantPrevisionnel'][$j]);
                                        $reqIdAuto = 'select max(Idauto) as idauto from facturation;';
                                        $rekIdAuto = mysqli_query($connect,$reqIdAuto);
                                        $resultIdAuto = mysqli_fetch_assoc($rekIdAuto);
                                        $idAuto = $resultIdAuto['idauto'] + 1;
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqinsertFacturation = 'insert into facturation'
                                        . '(Idauto, RefProjet, Echeance, Typefac, Libelle, Pcontrat, Monnaie, Montant) values'
                                        . '("'.$idAuto.'","'.$cdeMission.'", "'.$echeanceDate[$j].'", "'.$honodebours[$j].'", "'.$intitule[$j].'", "'.$PContrat[$j].'", "'.$devise[$j].'", "'.$montantPrevisionnel[$j].'")';                            
                                        $reqfacturation = mysqli_query($connect,$reqinsertFacturation);
                                        if(!$reqfacturation){
                                        ?>
                                            <script>
                                                document.missionNew.style.display = 'none';
                                                $('#note').css("display", "none");
                                            </script>
                                        <?php 
                                        echo '<font color="red"><b>Erreur au niveau: nouvelle insertion échéance prévisionnelle</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                        $mysqli->query("ROLLBACK");    
                                        }
                                    }
                                }
                                else if($newcountFact == 0){
                                    //update ligne fact dejà existante
                                    $echeanceDateM = $_POST['echeanceDate'];$honodeboursM = $_POST['honodebours'];
                                    $intituleM = $_POST['intitule'];$PContratM = $_POST['PContrat'];
                                    $deviseM = $_POST['devise'];$montantPrevisionnelM = $_POST['montantPrevisionnel'];
                                    
                                    $echeanceDateM = array();
                                    $honodeboursM = array();
                                    $intituleM = array();
                                    $PContratM = array();
                                    $deviseM = array();
                                    $montantPrevisionnelM = array();
                                    $tabFact = array();
                                    $reqFacturation = 'select facturation.Idauto from facturation 
                                        inner join projets on (projets.RefProjet = facturation.RefProjet)
                                        where facturation.RefProjet = "'.$cdeMission.'"';
                                    $resultFact = mysqli_query($connect, $reqFacturation);
                                    while($row = mysqli_fetch_row($resultFact)){                                    
                                        $j=0;
                                            $tabFact[] = $row[$j];
                                        $j += $j;
                                    }
                                    for ($j = 0; $j < $kountyFact; $j++){
                                        $echeanceDateM[$j] = $_POST['echeanceDate'][$j];
                                        $honodeboursM[$j] = $_POST['honodebours'][$j];
                                        $intituleM[$j] = $_POST['intitule'][$j];
                                        $PContratM[$j] = $_POST['PContrat'][$j];
                                        $deviseM[$j] = $_POST['devise'][$j];
                                        $montantPrevisionnelM[$j] = str_replace(" ", "", $_POST['montantPrevisionnel'][$j]);
                                        
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpFact = 'update facturation '
                                            . 'inner join projets on (projets.RefProjet = facturation.RefProjet) '
                                            . 'set '
                                            . 'facturation.Echeance = "'.$echeanceDateM[$j].'", facturation.Typefac = "'.$honodeboursM[$j].'", facturation.Libelle = "'.$intituleM[$j].'", facturation.Pcontrat = "'.$PContratM[$j].'", facturation.Monnaie = "'.$deviseM[$j].'", facturation.Montant = "'.$montantPrevisionnelM[$j].'"'
                                            . 'where facturation.RefProjet = "'.$cdeMission.'" and facturation.Idauto = "'.$tabFact[$j].'"';                                  
                                        $reqfacturationM = mysqli_query($connect,$reqUpFact);
                                        if(!$reqfacturationM){
                                            ?>
                                                <script>
                                                    document.missionNew.style.display = 'none';
                                                    $('#note').css("display", "none");
                                                </script>
                                            <?php 
                                            echo '<font color="red"><b>Erreur au niveau: Modification Echeance prévisionnelle<b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                            $mysqli->query("ROLLBACK");
    //                                        exit(1);
                                        }
                                    }
                                }
                            }
                            else if($kountyFact == 0){
                                $countFactTot = count($_POST['echeanceDate']);
//                                echo '<br>nb de ligne de fact existant: '.$countFactTot;
                                $countFactnonvide = 0;
                                for ($j=0; $j<$countFactTot; $j++){
                                    if(empty($_POST['echeanceDate'][$j]) or empty($_POST['honodebours'][$j]) or empty($_POST['intitule'][$j])
                                        or empty($_POST['PContrat'][$j]) or empty($_POST['devise'][$j]) or empty($_POST['montantPrevisionnel'][$j])){                                                                        
                                        break;
                                    }
                                    else{
                                        $countFactnonvide = $countFactnonvide + 1;
                                    }
                                }
//                                echo '<br/>nb total de fact non vide: '.$countFactnonvide;
                                $newcountFact = $countFactnonvide - $kountyFact;
//                                echo '<br/>nb new fact à inserer: '.$newcountFact;
                                
                                //insertion nouvelle ligne de facturation
                                    $echeanceDate = array();
                                    $honodebours = array();
                                    $intitule = array();
                                    $PContrat = array();
                                    $devise = array();
                                    $montantPrevisionnel = array();
                                    for ($j = 0; $j < $countFactnonvide; $j++){                                        
                                        $echeanceDate[$j] = $_POST['echeanceDate'][$j];
                                        $honodebours[$j] = $_POST['honodebours'][$j];
                                        $intitule[$j] = $_POST['intitule'][$j];
                                        $PContrat[$j] = $_POST['PContrat'][$j];
                                        $devise[$j] = $_POST['devise'][$j];
                                        $montantPrevisionnel[$j] = str_replace(" ", "", $_POST['montantPrevisionnel'][$j]);
                                        $reqIdAuto = 'select max(Idauto) as idauto from facturation;';
                                        $rekIdAuto = mysqli_query($connect,$reqIdAuto);
                                        $resultIdAuto = mysqli_fetch_assoc($rekIdAuto);
                                        $idAuto = $resultIdAuto['idauto'] + 1;
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqinsertFacturation = 'insert into facturation'
                                        . '(Idauto, RefProjet, Echeance, Typefac, Libelle, Pcontrat, Monnaie, Montant) values'
                                        . '("'.$idAuto.'","'.$cdeMission.'", "'.$echeanceDate[$j].'", "'.$honodebours[$j].'", "'.$intitule[$j].'", "'.$PContrat[$j].'", "'.$devise[$j].'", "'.$montantPrevisionnel[$j].'")';                            
                                        $reqfacturation = mysqli_query($connect,$reqinsertFacturation);
                                        if(!$reqfacturation){
                                        ?>
                                            <script>
                                                document.missionNew.style.display = 'none';
                                                $('#note').css("display", "none");
                                            </script>
                                        <?php 
                                        echo '<font color="red"><b>Erreur au niveau: nouvelle insertion échéance prévisionnelle</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                        $mysqli->query("ROLLBACK");    
                                        }
                                    }
                            }
/*****************************************FIN facturation echenace previsionne;le **************************/                                                                                                            
                            echo '<br/><br/><br/><center><font color="green"><b>Le projet - '.$cdeMission.' - a été modifié avec succ&egrave;s.</b></font></center><br/>';
                            echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
                            $mysqli->query("COMMIT");
                        }    
                        
                        ?>
                    </div>               
                    <!-- bottom -->
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
	<!-- /bottom -->
        
            <?php else : ?>
            <p>
                <span>Vous n’avez pas les autorisations n&eacute;cessaires pour acc&eacute;der &agrave; cette page.</span> Please <a href="../../index.php">login</a>.
            </p>
            <?php endif; ?>  
            
             <script>                               
                $(document).ready(function(){
                    //si cloture = 1
                    var cloture = '<?php echo $cloture;?>';                    
                    if(cloture === '1'){                        
                        $('#modifMission').find('input, button, select').attr('disabled','disabled');
                        $("#modifMission").find('input, select').css('background-color', 'white');
                        $('#note').css("display", "none");
                        $("#modifier").css("display", "none");
                    }
                    
                    //affichage infos type de client dans la liste deroulante                                                           
                    cliType = "<?php echo $cliType; ?>";
                    if(cliType === 'Privé'){                        
                        $('#labstat').css("display", "inline"); 
                        $('#stat').css("display", "inline"); 
                        $('#labnif').css("display", "inline"); 
                        $('#nif').css("display", "inline"); 
                        $('#labcif').css("display", "inline"); 
                        $('#cif').css("display", "inline"); 
                        $('#labrcs').css("display", "inline"); 
                        $('#rcs').css("display", "inline"); 
                        //$('#label').css("display", "block");
                    }
                    
                    //affichage avenant
                    avenantDefault = "<?php echo $avenantDefaut; ?>";                    
                    if(avenantDefault === 'OUI'){                        
                        $('#dteAvenant').css("display", "inline");
                        $('#labAvenant').css("display", "inline"); 
                    }
                    else{
                        $('#dteAvenant').css("display", "none");
                        $('#labAvenant').css("display", "none"); 
                    }
                    
                    //affichage debours à payer
                    refactDebours = "<?php echo $refactDebours; ?>";                    
                    if(refactDebours === 'OUI'){                        
                        $('#modFact').css("display", "inline");
                        $('#labDebMod').css("display", "inline"); 
                        $('#labMontantDeb').css("display", "inline");
                        $('#montantDeb').css("display", "inline"); 
                    }
                    else{
                        $('#modFact').css("display", "none");
                        $('#labDebMod').css("display", "none"); 
                        $('#labMontantDeb').css("display", "none");
                        $('#montantDeb').css("display", "none"); 
                    }
                    
                   //à la selection d'un type de client
                    $("#typeClient").on('change', function(){
                        var type = $(this).val();
                        //alert('type: ' + type);
                        if(type === 'Privé'){
                            //alert("yes");
                            $('#labstat').css("display", "inline"); 
                            $('#stat').css("display", "inline"); 
                            $('#labnif').css("display", "inline"); 
                            $('#nif').css("display", "inline"); 
                            $('#labcif').css("display", "inline"); 
                            $('#cif').css("display", "inline"); 
                            $('#labrcs').css("display", "inline"); 
                            $('#rcs').css("display", "inline"); 
                            //$('#label').css("display", "block"); 
                        }
                        else{
                            //alert("nooo");                                                        
                            $('#labstat').css("display", "none"); 
                            $('#stat').css("display", "none"); 
                            $('#labnif').css("display", "none"); 
                            $('#nif').css("display", "none"); 
                            $('#labcif').css("display", "none"); 
                            $('#cif').css("display", "none");
                            $('#labrcs').css("display", "none"); 
                            $('#rcs').css("display", "none");                                                         
                        }
                    });
                    
                    //a la selection d'un avenant = NON
                    $("#avenant").on('change', function(){
                        var type = $(this).val();
                        //alert('type: ' + type);
                        if(type === 'NON'){
                            //alert("yes");
                            $('#dteAvenant').css("display", "none");
                            $('#labAvenant').css("display", "none");
                            //labAvenant                           
                        }
                        else if(type === 'OUI'){
                            //alert("nooo");                                                        
                            $('#dteAvenant').css("display", "inline");
                            $('#labAvenant').css("display", "inline");                            
                        }
                    });
                    
                    //a la selection d'un debours a payer
                    $("#debPayer").on('change', function(){                        
                        var deb = $(this).val();
                        //alert('deb: ' + deb);
                        if(deb === 'NON'){
                            //alert("yes");
                            $('#labDebMod').css("display", "none");
                            $('#modFact').css("display", "none");
                            $('#labMontantDeb').css("display", "none");
                            $('#montantDeb').css("display", "none");
                            //labAvenant                           
                        }
                        else{
                            //alert("nooo");                                                        
                            $('#labDebMod').css("display", "inline");
                            $('#modFact').css("display", "inline");
                            $('#labMontantDeb').css("display", "inline");
                            $('#montantDeb').css("display", "inline");
                            //$('#dteAvenant').css("width", "350px");
                        }
                    });
                    
                    $("#montantHono").on('click', function(){                             
                        if(montantHono.value === "Veuillez saisir un nombre."){                                
                            placeholder(montantHono);
                        }
                    });
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
                
                function verifChampNullDynamik(champ1, champ2, champ3){
                    var i = 1, long1, long2, long3;
                    deplista = document.getElementsByName(champ1);
                    managerList = document.getElementsByName(champ2);
                    assocList = document.getElementsByName(champ3);
                    long1 = deplista.length;
                    long2 = managerList.length;
                    long3 = assocList.length;
                    //alert("longeur deplista " + long1 +" longeur managerlist: " + long2 +" longeur assoclist: " + long3);
                    for(i; i<long1-1;i++){                                                                        
                        if(deplista[i].value === "" && managerList[i].value === "" && assocList[i].value === ""){ 
                            return true;
                            break;
                        }
                        else if(deplista[i].value === "" || managerList[i].value === "" || assocList[i].value === ""){                            
                            deplista[i].style.backgroundColor = "#DCDCDC";
                            managerList[i].style.backgroundColor = "#DCDCDC";
                            assocList[i].style.backgroundColor = "#DCDCDC";
                            alert("AFFECTATION DEPARTEMENT: Tous les champs de la ligne " +(i+1) +" doivent être remplis!");                            
                            return false;
                        }
                        else if(deplista[i].value !== "" && managerList[i].value !== "" && assocList[i].value !== ""){                            
                            deplista[i].style.backgroundColor = "";
                            managerList[i].style.backgroundColor = "";
                            assocList[i].style.backgroundColor = "";
                            continue;
                        }                        
                    }    
                }
                
                 function verifChampNullDynamiq(champ1, champ2, champ3, champ4){
                    var i = 0, long, val = 0;
                    nameCons = document.getElementsByName(champ1);
                    prof = document.getElementsByName(champ2);
                    nbJH = document.getElementsByName(champ3);
                    tarifJH = document.getElementsByName(champ4);
                    long = tarifJH.length;                                        
                    for(i; i<long-1;i++){                                                                                                                        
                        if(nameCons[i].value === "" && prof[i].value === "" && nbJH[i].value === "" && tarifJH[i].value === ""){                                                                                     
                            return true;
                            break;                            
                        }
                        else if(nameCons[i].value === "" || prof[i].value === "" || nbJH[i].value === "" || tarifJH[i].value === ""){  
                            nameCons[i].style.backgroundColor = "#DCDCDC";
                            prof[i].style.backgroundColor = "#DCDCDC";
                            nbJH[i].style.backgroundColor = "#DCDCDC";
                            tarifJH[i].style.backgroundColor = "#DCDCDC";
                            alert("INTERVENANTS: Tous les champs de la ligne " +(i+1) +" doivent être remplis!");                            
                            return false;
                        }
                        if(nameCons[i].value !== "" && prof[i].value !== "" && nbJH[i].value !== "" && tarifJH[i].value !== ""){
                            nameCons[i].style.backgroundColor = "";
                            prof[i].style.backgroundColor = "";                              
                            
                            if(!(isNaN(strReplace(nbJH[i].value, " ", "")))){                                
                                nbJH[i].style.backgroundColor = "";                                 
                            }
                            else{                                                                
                                nbJH[i].style.backgroundColor = "#87CEFA";
                                nbJH[i].value = 'Veuillez saisir un nombre.'; 
                                val = val+1;
                            }
                            
                            if(!(isNaN(strReplace(tarifJH[i].value, " ", "")))){                                
                                nbJH[i].style.backgroundColor = "";                                 
                            }
                            else{                                                                
                                tarifJH[i].style.backgroundColor = "#87CEFA";
                                tarifJH[i].value = 'Veuillez saisir un nombre.';                                                               
                                val = val+1;
                            }
                            if(val >0){
                                return false;                                
                            }
                            continue;
                        }                            
                    }
                }
                
                function verifChampNullDynamika(champ1, champ2, champ3, champ4, champ5, champ6){
                    var i = 0, long, val = 0;
                    echeanceDate = document.getElementsByName(champ1);
                    honodebours = document.getElementsByName(champ2);
                    intitule = document.getElementsByName(champ3);
                    PContrat = document.getElementsByName(champ4);
                    devise = document.getElementsByName(champ5);
                    montantPrevisionnel = document.getElementsByName(champ6);
                    long = PContrat.length;                                        
                    for(i; i<long-1;i++){                                                                                                                        
                        if(echeanceDate[i].value === "" && honodebours[i].value === "" && intitule[i].value === "" && PContrat[i].value === "" && devise[i].value === "" && montantPrevisionnel[i].value === ""){
                            return true;
                            break;                            
                        }
                        else if(echeanceDate[i].value === "" || honodebours[i].value === "" || intitule[i].value === "" || PContrat[i].value === "" || devise[i].value === "" || montantPrevisionnel[i].value === ""){  
                            echeanceDate[i].style.backgroundColor = "#DCDCDC";
                            honodebours[i].style.backgroundColor = "#DCDCDC";
                            intitule[i].style.backgroundColor = "#DCDCDC";
                            PContrat[i].style.backgroundColor = "#DCDCDC";
                            devise[i].style.backgroundColor = "#DCDCDC";
                            montantPrevisionnel[i].style.backgroundColor = "#DCDCDC";
                            alert("ECHEANCE PREVISIONNELLE: Tous les champs de la ligne " +(i+1) +" doivent être remplis!");                            
                            return false;
                        }
                        else if(echeanceDate[i].value !== "" && honodebours[i].value !== "" && intitule[i].value !== "" && PContrat[i].value !== "" && devise[i].value !== "" && montantPrevisionnel[i].value !== ""){
                            echeanceDate[i].style.backgroundColor = "";
                            honodebours[i].style.backgroundColor = "";                                                        
                            intitule[i].style.backgroundColor = "";                                                        
                            devise[i].style.backgroundColor = "";                                                           
                            
                            if(!(isNaN(strReplace(PContrat[i].value, " ", "")))){                                
                                PContrat[i].style.backgroundColor = "";                                   
                            }
                            else{                                                                
                                PContrat[i].style.backgroundColor = "#87CEFA";
                                PContrat[i].value = 'Veuillez saisir un nombre.';  
                                val = val +1;
                            }
                            
                            if(!(isNaN(strReplace(montantPrevisionnel[i].value, " ", "")))){                                
                                montantPrevisionnel[i].style.backgroundColor = "";                                 
                            }
                            else{                                                                
                                montantPrevisionnel[i].style.backgroundColor = "#87CEFA";
                                montantPrevisionnel[i].value = 'Veuillez saisir un nombre.'; 
                                val = val +1;
                            }
                            if(val > 0){
                                return false;                                
                            }
                            continue;
                        }                            
                    }
                }
                
                function verifChampNullDyn(champ){
                    var deplist;
                    deplist = document.getElementsByName(champ);
                    long = deplist.length;
                    //alert("longeur deplist " + long);  
                    val = deplist[0].value;                       
                    //alert("val "+val);
                    if(val === ""){
                        //alert("tsy mety");
                        deplist[0].style.backgroundColor = "#DCDCDC"; 
                        return false;
                    }
                    else if(val !== ""){
//                        alert("mety");
                        deplist[0].style.backgroundColor = "#FFF";                        
                        return true;
                    }
                }
                
                function verifChampNullDynamikSansLigne(nomName){
                    var i = 0, deplist, val, long, nbDeplist = 0;
                    deplist = document.getElementsByName(nomName);
                    long = deplist.length;
                    //alert("longeur deplist " + long);
                    for(i; i<long;i++){
                       //var nameVal = deplist.item(i).getAttribute("name");                                              

                       //alert("name de chaque ligne: " + nameVal);
                       val = deplist[i].value;                       
                       //alert("valeur deplist de " +i + val);                                                
                       if(val === ""){
                           //alert("tsy mety");
                           deplist[i].style.backgroundColor = "#DCDCDC";
                           nbDeplist++;
                       }
                       else if(val !== ""){
                           //alert("mety");
                           deplist[i].style.backgroundColor = "";
                        }
                    }
                   
                   //alert("nb de deplist vide: " + nbDeplist);
                   
                   if(nbDeplist > 0)
                       return false;
                   else
                       return true;    
                } 
                
                function strReplace(chaine, aremplacer, remplacement){
                    return chaine.replace(new RegExp(aremplacer, 'g'), remplacement);
                }
                
                function verifNombre(nomName){
                    var i = 0, deplist, val, valeur, long, nbDeplist = 0, nbNb = 0;
                    deplist = document.getElementsByName(nomName);
                    long = deplist.length;
                    //alert("longeur deplist " + long);
                    for(i; i<long;i++){
                       //var nameVal = deplist.item(i).getAttribute("name");                                              

                       //alert("name de chaque ligne: " + nameVal);
                       valeur = deplist[i].value;  
                       val = strReplace(valeur, " ", "");
                       //alert("valeur deplist de " +i + val);                                                
                       if(val === ""){
                           //alert("tsy mety");
                           deplist[i].style.backgroundColor = "#DCDCDC";
                           nbDeplist++;
                       }
                       else if(val !== ""){
                           //alert("mety");
                           if(!(isNaN(val))){       
                               nbNb++;
                               deplist[i].style.backgroundColor = "";
                           }
                           else{                               
                               deplist[i].style.backgroundColor = "#87CEFA";                                                              
                               deplist[i].value = 'Veuillez saisir un nombre.';                                  
                           } 
                        }
                    }
                   
                   //alert("nb de " +nomName +" vide: " + nbDeplist);
                   
                   if(nbDeplist > 0)
                       return false;
                   else{
                       //alert("nbNb: " + nbNb +" long: " +long);
                        if (nbNb === long)
                            return true;
                        else 
                            return false;
                   }
                }
                
                function placeholder(nomName){
                    nomName.value = "";
                    nomName.style.backgroundColor = "";
                }   
                
                function verifChampDynClear(champ){
                    if(champ.value === "Veuillez saisir un nombre."){
                        champ.value = "";
                        champ.style.backgroundColor = "";
                    }
                }


                function verifAll(f){                                          
//                   var cdeMission = verifChampNul(f.cdeMission);
                   var mission = verifChampNul(f.mission);
                   var client = verifChampNul(f.client);var categorie = verifChampNul(f.categorie);
                   var origine = verifChampNul(f.origine);var avenant = verifChampNul(f.avenant);
                   
                   //info type de Client
                   var typeClient = verifChampNul(f.typeClient);
//                   var cif = verifChampNul(f.cif);
//                   var stat = verifChampNul(f.stat);
//                   var rcs = verifChampNul(f.rcs);
                   
                   var paysMission = verifChampNul(f.paysMission);var villeMission = verifChampNul(f.villeMission);
                   var chef = verifChampNul(f.chef);var dtePrevu = verifChampNul(f.dtePrevu);
                   var dteFin = verifChampNul(f.dteFin);var refSoc = verifChampNul(f.refSoc);
                   var CA = verifChampNul(f.CA);var typehono = verifChampNul(f.typehono);
                   var mod_fac = verifChampNul(f.mod_fac);var debPayer = verifChampNul(f.debPayer);
                   var interFac = verifChampNul(f.interFac);var adresseFact = verifChampNul(f.adresseFact);
                   var devizy = verifChampNul(f.devizy);/*var montantHono = verifChampNul(f.montantHono);*/
                   var Coord = verifChampNul(f.Coord);       
                   
                   /************************Verification des champs affectation mission*************************************/
                   var verifDepList = verifChampNullDyn('deptList[]');
                   var verifManList = verifChampNullDyn('managerList[]');
                   var verifAssocList = verifChampNullDyn('assocList[]');
                   
                   var verifDepListDyn = verifChampNullDynamik('deptList[]', 'managerList[]', 'assocList[]');
                   var consl = verifChampNullDynamiq('nameCons[]', 'prof[]', 'nbJH[]', 'tarifJH[]');
                   var pre = verifChampNullDynamika('echeanceDate[]', 'honodebours[]', 'intitule[]', 'PContrat[]', 'devise[]', 'montantPrevisionnel[]');  
                   
                   /************************Verification des champs numerique *************************************/  
                   var montantHono = verifNombre('montantHono');
//                   var verifnbJH = verifNombre('nbJH[]');
//                   var verifTarifJH = verifNombre('tarifJH[]');
//                   var verifPContrat = verifNombre('PContrat[]');
//                   var verifmontantPrevisionnel = verifNombre('montantPrevisionnel[]');
                   //var nif = verifNombre('nif');
                   
                    /************************Verification final *************************************/                                          
                   if(/*cdeMission && */mission && client && categorie && origine  && avenant && paysMission && villeMission
                           //info type de client
                               && typeClient 
                           //&& cif && stat && rcs 
                           //&& nif
                           && chef && dtePrevu && dteFin && refSoc && CA && typehono && mod_fac && debPayer && interFac
                           && adresseFact && devizy && montantHono && Coord 
                           && verifDepList && verifManList && verifAssocList
                           && verifDepListDyn  
                           && consl && pre
//                           && verifNameCons && verifProf 
//                           && verifnbJH 
//                           && verifTarifJH && verifecheanceDate && verifhonodebours && verifintitule 
//                           && verifPContrat && verifdevise && verifmontantPrevisionnel
                           )
                      return true;
                   else{
                      alert("Veuillez remplir correctement tous les champs.");                      
                      return false;
                   }
                }
            </script>
    </body>
</html>

