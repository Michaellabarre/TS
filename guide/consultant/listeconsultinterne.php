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
        <title>Liste des consultants externes</title>
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

        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
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
             .code{
                width: 49px;
                text-align: center;
            }
            .prenom{
                width: 200px;
                text-align: left;
            }
            .nom{
                width: 325px;
                text-align: left;
            }
            .titre{
                /*width: 209px;*/
                text-align: left;
            }
            #echeance {
                /*border: none;*/                
                /*border-style: none;*/
            }
            tr.test:hover {background-color: #19a3ff;}
            /*tr.test:nth-child(odd) {background-color: #bed4f7;}*/
            /*tr.test:nth(even) {background-color: #ffffff;}*/

            /* Cells in even rows (2,4,6...) are one color */        
            tr.test:nth-child(even) td { background: #F1F1F1; } 

            /* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
            tr.test:nth-child(odd) td { background: #FEFEFE; }
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
                   <MARQUEE scrolldelay="150"> <h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1> </MARQUEE>
                  <!--  <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                -->    
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
    				<!-- tabs -->
					<!---
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
                             <li><a href='../consultant/ajoutconsultexterne.php'><span>Nouveau externe</span></a></li>
                             <li><a href='../consultant/listeconsultant.php'><span>Liste des consultants</span></a></li>                        
                             <li><a href='../consultant/listeconsultexterne.php'><span>Liste Cons. externes</span></a></li>
                             <li><a class='tab selected' href='../consultant/listeconsultinterne.php'><span>Liste Cons. internes</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                       <!-- </ul>
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
                    <font style=" color: black"><b><center>LISTE DES CONSULTANTS INTERNES</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }            
            else if($prof == 'Administrateur'){
                ?>
                <div id="tabs">
                    <!-- tabs -->
                    <div>                    
                        <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                        <a class='tab selected' href='../../guide/consultant/index.php'><span style="width: 100px; text-align:center;">CONSULTANTS</span></a>                    
                    </div>                
                    <div class="header"><div class="bg-help">Les consultants internes de FTHM</div></div>
                    <!-- /tabs -->
                </div>
                <?php
            }
        ?>
                      
        <div id="container" >
            
                        
                <div>
                    <!-- /top -->
<!--                    <div class="note" id="note"><b><font color="red">Notes:</font></b> 
                        <br/>&emsp; Les champs grisés sont obligatoires                                               
                        <br/>&emsp; Le code Client doit contenir 3 à 6 caractères et ne doit être composé que des lettres uniquement.
                    </div>-->     
                    <center>
                        <!-- ENTETE DU TABLEAU HTML -->
                        <!-- <div>
                        <table cellspacing="0" cellpadding="0" border="0" id="echeance" width="820px" border = "1"> 
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" border="1" width="800px"  id="echeance">
                                        <tr>
                                            <td class="code"><b><center>Code </center></b></td>
                                            <td class="prenom"><b><center>Prénom</center></b></td>                                                                                   
                                            <td class="nom"><b><center>Nom</center></b></td>
                                            <td class="titre"><b><center>Département</center></b></td>                                                                
                                        </tr>
                                    </table>
                                </td> -->
								<!-- FIN ENTETE DU TABLEAU HTML -->
                        <!--     </tr>
                            <tr>
                                <td>
                                    <div style="height:450px; overflow-y: auto; overflow-x: hidden" width="820px"> 
                                            <table cellspacing="0" cellpadding="0" border="0" id="echeance" width="800px"> -->
                                            <?php
											// AFFICHAGE DES RESULTATS DE LA LISTE DES CONS. INTERNES VIA APPEL SQL
											
                                            // $liste = 'select RefEmploye as Code, Prenom as Prénom, NomFamille as Nom, Titre FROM employes '
                                            //         . 'where RefEmploye not like "%E0%" and actif = 0 '
                                            //         . 'and RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") '
                                            //         . 'ORDER BY RefEmploye ASC;';                                                                                
                                            // $tesita = mysqli_query($connect, $liste) or exit(mysqli_error($connect));
                                            // $colonne = mysqli_num_fields($tesita); //col        
                                            // $ligne = mysqli_num_rows($tesita); //rows  
                                            // while($row = mysqli_fetch_array($tesita, MYSQLI_BOTH)){
                                            // echo '<tr class="test">';
                                            //     for($j=0; $j < $colonne ; $j++){
                                            //         switch ($j){
                                            //             case 0: echo '<td class="code">'.$row[$j].'</td>';
                                            //                 break;
                                            //             case 1: echo '<td class="prenom"><center>'.$row[$j].'</center></td>';
                                            //                 break;
                                            //             case 2: echo '<td class="nom"><center>'.$row[$j].'</center></td>';
                                            //                 break;
                                            //             case 3: echo '<td class="titre"><center>'.$row[$j].'</center></td>';
                                            //                 break;
                                            //         }    
                                            //     }
                                            //     echo '</tr>';
                                            // }
											// FIN AFFICHAGE DES RESULTATS DE LA LISTE DES CONS. EXTERNES VIA APPEL SQL
                                            ?>
                       <!--                  </table>
                                    </div>
                                </td>
                            </tr>                                                                                                                                                                                                                                                                
                        </table>
                    </div> --> 

                    <table id="example" class="display" style="width:80%" >
        <thead>
            <tr>
                <th>Code</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Département / Fonction</th>
                <!-- <th>Start date</th>
                <th>Salary</th> -->
            </tr>
        </thead>
        <tbody>

            <?php 
                //$req='SELECT RefEmploye as Code, Prenom as Prénom, NomFamille as Nom, Titre FROM employes where RefEmploye like "%E0%" or RefEmploye not like "%E0%" and actif = 0 and RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ", "ITADMIN")';
                $req = 'select RefEmploye as Code, Prenom as Prénom, NomFamille as Nom, Titre FROM employes '
                                                    . 'where RefEmploye not like "%E0%" and actif = 0 '
                                                    . 'and RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") '
                                                    . 'ORDER BY RefEmploye ASC;';
                $resultat = mysqli_query($connect, $req) or exit(mysqli_error($connect));
                //$row = mysqli_fetch_array($resultat, MYSQLI_BOTH);

                while($row = mysqli_fetch_array($resultat)){
                    echo '<tr>';
                    echo '<td align="center"><b>'.$row['Code'].'</b></td>';
                    echo '<td align="center"><b>'.$row['Prénom'].'</b></td>';
                    echo '<td align="center"><b>'.$row['Nom'].'</b></td>';
                    echo '<td align="center"><b>'.$row['Titre'].'</b></td>';
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
                <th>Code</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Dépt / Fonction</th>
                <!-- <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> -->
    </table>
                                                                                            
                    </center>
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
	         
        <?php else : ?>
            <p>
                <span>Vous n’avez pas les autorisations n&eacute;cessaires pour acc&eacute;der &agrave; cette page.</span> Please <a href="../../index.php">login</a>.
            </p>
        <?php endif; ?> 
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
    </body>
</html>

