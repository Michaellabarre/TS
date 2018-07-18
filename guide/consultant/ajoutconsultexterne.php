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
        <title>Ajout consultant externe</title>
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
            
            
            input[type='submit'] {
            /*width: 100px!important;*/    
            float: right;
            margin-right: 825px;            
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
                    <MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1> </MARQUEE>
					<!-- FIN TEXTE DEFILANT-->
                    <!--<a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                    -->
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
            
            $select = 'select max(RefEmploye) AS ref from employes where RefEmploye like "%E0%";';
            $req = mysqli_query($connect,$select);            
            $result = mysqli_fetch_assoc($req);
            $reference = $result['ref'];
                                                                        
            if (@preg_match('#^([^0-9]+)([0-9]+)$#',$reference,$decomposition_partie)){                            
                $decomp1 = $decomposition_partie[1];
                $decomp2 = (int)($decomposition_partie[2]);
            }
            $newRef = $decomp2 + 1;                        
            $newRe = str_pad($newRef, 4, "0", STR_PAD_LEFT);
            $code = $decomp1.$newRe;
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
					
					
                <!-- tabs -->
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
                        <a class='tab selected' href='../consultant/index.php'><span style="width: 100px; text-align:center;">CONSULTANTS</span></a>
                         <ul>
                             <li><a class='tab selected' href='../consultant/ajoutconsultexterne.php'><span>Nouveau externe</span></a></li>
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
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>NOUVEAU CONSULTANT EXTERNE</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }
            else if($prof == 'Administrateur'){
                ?>
				
				
                <nav class="menu">  
                    <div>                                        
                        <a href='../index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>                                        
                    <div>                                        
                        <a class='tab selected' href='./consultant/index.php'><span style="width: 100px; text-align:center;">CONSULTANTS</span></a>
                         <ul>
                             <li><a class='tab selected' href='./ajoutconsultexterne.php'><span>Nouveau cons. externe</span></a></li>
                             <li><a href='./ajoutconsultinterne.php'><span>Nouveau cons. interne </span></a></li>
                             <li><a href='./modifierconsult.php'><span>Modifier un consultant </span></a></li>  
                             <li><a href='./listeconsultant.php'><span>Liste des consultants</span></a></li>                              
                        </ul>
                    </div>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>NOUVEAU CONSULTANT EXTERNE</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
        ?>
                      
        <div id="container" >
            
            
            <div id="content">
                <div>
                    <!-- /top -->
                    <div class="note" id="note"><b><font color="red">Note:</font></b> 
                        Tous les champs sont obligatoires
                    </div>   
                    
                    <div id="dp">
                        <form name="ajoutConsExt" method="post" onsubmit="return verifAll(this)">
                            <table>
                                <tr>
                                    <td>
                                        <ul style=" list-style-type: none">
                                            <table>
                                                <tr>
                                                    <td><label for="prenom">Pr&eacute;nom</label></td>
                                                    <td><input type="text" name="prenom" id="prenom" onblur="verifChampNul(this)" /></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="nom">Nom</label></td>
                                                    <td><input type="text" name="nom" id="nom" onblur="verifChampNul(this)" /></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="Titre">Fonction</label></td>
                                                    <td><input type="text" name="Titre" id="Titre" onblur="verifChampNul(this)" /></td>
                                                </tr>
                                            </table>
                                        </ul>
                                    </td>
                                </tr>
                                
                            </table>
                            <!--<span id="spann" style="float: right; padding: 8px;"><input type="submit" disabled="disabled" name="valider" id="valider" value="Modifier" onmouseover="this.disabled='';"/></span>-->
                            <span id="spann" style="float: right; padding: 8px;"><input type="submit" disabled="disabled" name="enregistrer" id="enregistrer" value="Enregistrer" onmouseover="this.disabled='';" /></span>
                        </form>
                    </div>               
                    <!-- bottom -->
                    
                    <?php
					// ACTION D'ENREGISTEMENT D'UN CONS. EXTERNE
                        if(isset($_POST['enregistrer'])){
                            ?>
                            <script>
                                document.ajoutConsExt.style.display='none';                        
                            </script>
                            <?php                            
                            
                            $prenom = $_POST['prenom'];
                            $nom = $_POST['nom'];
                            $Titre = $_POST['Titre'];
                            $dateNow = date('Y-m-d');                            

                            $mysqli->query("SET AUTOCOMMIT=0");
                            $ajout = mysqli_query($connect, 'insert into employes 
                                (RefEmploye, Prenom, NomFamille, Titre, RefSociete, Pleindroit, Protarif, actif, datemodification, nombremodification, usermodif) 
                                values
                                ("'.$code.'","'.$prenom.'", "'.$nom.'", "'.$Titre.'","1", 0, "Externe", 0, "'.$dateNow.'", 0, "'.$refEmp.'");');

                            if($ajout) {
                                ?>
                                <script>
                                    $('#note').css("display", "none");
                                </script>
                                <?php
                                echo '<div class="okExt"><font color="green"><b>Le consultant externe a &eacute;t&eacute; ajout&eacute; avec succ&egrave;s.</b></font></div>';
                                $mysqli->query("COMMIT");
                            }
                            else {
                                ?>
                                <script>
                                        $(function(){
                                                $("#alert").dialog({
                                                        modal:true,
                                                        buttons: {
                                                                Ok: function(){
                                                                        $(this).dialog("close");
                                                                }
                                                        }
                                                });
                                        });
                                </script>
                                <?php
                                echo '<div id="alert" title="ALERT">'
                                        . '<p>'
                                        . '<font color="red" size="2em"><b>Cr&eacute;ation du consultant &eacute;chou&eacute;e.</b></font><br/>';
                                echo '<br/><font size="0.5em">Erreur: '.mysqli_error($connect).'</font>';
                                echo '</b></p></div>';            
                                $mysqli->query("ROLLBACK");exit(1);
                                exit(mysqli_error($connect));
                            }

                        }
						// FIN ACTION D'ENREGISTEMENT D'UN CONS. EXTERNE
                    ?>
                </div>
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
            
        <script type="text/javascript"> 
		// APPEL DE L'ID DU FORMULAIRE POUR LA GESTION DU FORMULAIRE => AJAX
            $(document).ready(function(){
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
            });
			// FIN APPEL DE L'ID DU FORMULAIRE POUR LA GESTION DU FORMULAIRE
			
			// QUELQUES FONCTIONS             
                function afficheErreur(champ, erreur){ // fonction pour localiser les champs contenant des erreurs et les colorés
                    if(erreur){                            
                        champ.style.backgroundColor = "#DCDCDC";
                    }
                    else{                        
                        champ.style.backgroundColor = "";
                    }
                }

                function verifChampNul(champ){ // fonction pour verifier les  champs vides
                    if(champ.value === ""){
                        afficheErreur(champ, true);
                        return false;
                    }
                    else{
                        afficheErreur(champ, false);
                        return true;
                    }   
                }
                
                function verifAll(f){    // fonction pour verifier l'intégralité des  champs               
                   var prenom = verifChampNul(f.prenom);var nom = verifChampNul(f.nom);var Titre = verifChampNul(f.Titre);                   
                   
                   if(prenom && nom && Titre)
                      return true;
                   else{
                      alert("Veuillez remplir correctement tous les champs.");
                      return false;
                   }
                }
				// FIN QUELQUES FONCTIONS 
            </script>                    
    </body>
</html>

