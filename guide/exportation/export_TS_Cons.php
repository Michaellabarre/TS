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
    
    function changeDate($date){ // fonction de conversion date
        $tab = explode("-", $date);
        $dateChangee = $tab[2]."-".$tab[0]."-".$tab[1];
        return $dateChangee;
    }
    
    function changeDate2($date){ // fonction de conversion date
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
        <link type="text/css" rel="stylesheet" href="../../includes/db_connect.php"/>        
		<link   type="text/css" rel="stylesheet" href="../helpers/media/style.css?v=1783"/>
        <link rel="stylesheet" href="../../jquery/jquery-ui-1.11.2/jquery-ui.css" />

        <!-- helper libraries -->
          
	<!-- /head -->
        <style>           

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
			
			
            
            .ui-datepicker-current-day .ui-state-active { background: red; }
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
					<MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1></MARQUEE>
                   <!-- <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>      -->              
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
            if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Collaborateur' or $prof == 'Superviseur' or $prof == 'Collaboratrice'){
                ?>
                <!-- tabs -->
				
				<ul id="nav">
					<li class="current"><a href="../../guide/index.php">GUIDE</a></li><!-- n1 -->

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
				
				
				
				
                <!--    <nav class="menu">  
                    <div>                                        
                        <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>    
                        <a class='tab' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../mission/missioncode.php'><span>Fiche de Mission</span></a></li>                        
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
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
                            <a class='tab selected' href='./export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/>
                    <font style=" color: black"><b><center>EXPORTATION DES TIME SHEET SOUS EXCEL</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            } 
            else if($prof == 'Assistant(e) Manager' ){
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
					<li><a href="../ts/index.php">TIMESHEET</a>
						<ul>
							<li><a href="../ts/saisits.php"><b>Saisir TIMESHEET</b> <img src="../images/todo.png" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="../ts/listets.php"><b>Lister TIMESHEET</b><img src="../images/liste.png" border="0" width="15" height="15" align="absmiddle"></a></li>
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
                            <a class='tab selected' href='./export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/>
                    <font style=" color: black"><b><center>EXPORTATION DES TIME SHEET SOUS EXCEL</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }
        ?>
                      
        <div id="container" >            
            
            <!--<div id="content">-->
                <div>
                    <!-- /top -->                    
                    <div id="dp">
                        
                        <form method="POST"> 
                            <input id="daty" name="daty" type="text" style="width:175px;text-align: center" placeholder="Sélectionner la période"/>                                                        
                            <input type="submit" name="mois" value="Selectionner" />
                        </form>
                        
                        <!--<form action="exportTS_cons.php" method="POST">-->
                        <center>
                        <?php
                        
                        if(isset($_POST['mois'])){
                            $datyChoisit = $_POST['daty'];                           
                           $datyChoisit = changeDate(str_replace("/", "-", $datyChoisit));
//                           $datyChoisit = 
//                           echo 'daty choisit: '.$datyChoisit;
                           if($datyChoisit == '--'){                               
                               echo '<font color="red"><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Veuillez sélectionner la période.</font>';	
                           }
                           else{
                               echo '<br/>';
                            
//                                $dateNow = date('Y-m-d');
//                                $dateNow = '2015-08-01';
                                $dateNow = $datyChoisit;                            
                                
                                $date_exp = explode("-", $dateNow);
                                $jour   = $date_exp[2];
                                $moiss  = $date_exp[1];
                                $taona  = $date_exp[0]; 
                                $mm = moy($moiss);
                                
                                $mois = "%".moy($moiss)." ".$taona."%";
//                                echo 'MMM: '.$mois;
                                
                                $employe = $_SESSION['username'];

                                $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';                    
                                $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                                $refEmploye = $resultRefEmp['EMPLO'];

                                //echo 'HAHAHA '.$refEmploye;

                                $reqTSEx = 'select H.RefDetailFichePointage as Ref, concat(E.Prenom, " ", E.NomFamille) as Nom, H.JourTravaille as Date, 
                                    H.RefProjet as CodeMission , C.NomSociete as NomClient, H.Coddept as Departement, 
                                    H.HeureFacturables as Heures, H.DescriptionTravail, H.Facture as Validation,H.Date_validation_TS as datevalide,
                                    FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs 
                                    from heuresfichepointage H
                                    left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage)     
                                    inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) 
                                    inner join employes E on (E.RefEmploye = F.RefEmploye)
                                    inner join projets P on (P.RefProjet = H.RefProjet) 
                                    inner join client C on (P.RefClient = C.RefClient)
                                    where H.RefFichePointage in 
                                    (
                                        select RefFichePointage as refFiche 
                                        from fichepointage 
                                        inner join periode P on (fichepointage.DateEntree = P.DateEntree)
                                        where P.PERIODE like "'.$mois.'"                
                                    )        
                                    and F.RefEmploye = "'.$refEmploye.'"
                                    order by E.NomFamille, H.JourTravaille ASC;';




                                $resTSEx = mysqli_query($connect,$reqTSEx) or exit(mysqli_error($connect));

                                // on vérifie le contenu de  la requête ;
                                if (mysqli_num_rows($resTSEx) == 0){   
                                    // si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
                                        print "<script> alert('Aucun enregistrement trouvé!')</script>";
                                }
                                else{

                                $colonne = mysqli_num_fields($resTSEx); //col        
                                $ligne = mysqli_num_rows($resTSEx); //rows

//                                echo "ligne: ".$ligne;
                            //    echo ' colonne: '.$colonne;

                                // construction du tableau HTML
                                echo '<div style="max-height: 400px;overflow: scroll;  ">';
                                echo '<table border="1">
                                    <!-- impression des titres/entetes de colonnes -->
                                     <TR>
                                        <TD><b><center>Consultant</center></b></TD>
                                        <TD><b><center>Date</center></b></TD>
                                        <TD><b><center>Code mission</center></b></TD>
                                        <TD><b><center>Code Client</center></b></TD>
                                        <TD><b><center>D&eacute;partement</center></b></TD>
                                        <TD><b><center>Heures</center></b></TD>            
                                        <TD><b><center>Description</center></b></TD>     
                                        <TD><b><center>Validation</center></b></TD>   
                                        <TD><b><center>Date de validation<center></b></TD>     
                                        <TD><b><center>Dépense</center></b></TD>                                            
                                        <TD><b><center>Justificatifs</center></b></TD>                                            
                                    </TR>';

                                $linina = 0;   
                                $val = array();
                                while($row = mysqli_fetch_array($resTSEx, MYSQLI_BOTH)){        
                                    echo '<tr>';      

                                    for($j=0; $j < $colonne ; $j++){            
                                        if($j == 0){
                                            $val[$linina] = array($row[$j]);
                                            if($val[$linina-1][$j] == $val[$linina][$j]){                    
                                                //echo '<td>'.$val[$linina][$j].' biiii '.$linina.'</td>';  
                                                for($j=0; $j < $colonne ; $j++){                     
                                                    switch($j){                             
                                                        case $j > 1 && $j <=8: 
                                                            echo '<td style="border:none"></td>'; 
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
                                
                                ?>
                            <br/><br/>
                                <form action="exportTS_cons.php?daty=<?php echo $mm;?>&taona=<?php echo $taona;?>" method="POST">
                                    <!--<td><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';-->
                                    <input type="submit" name="notifTS" id="notifTS" value="Export To Excel" />        
                                </form> 
                                <?php
                                }

                           }
                        }                                                                                  
                        ?>
                        </center>
                    </div>  
                    
                    <!-- bottom -->
                <!--</div>-->
            </div>
        </div>
    </div>
  
    <script type="text/javascript">
        $(document).ready(function() {
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
                        $(this).datepicker('option', 'defaultDate', new Date(year, month));
                        $(this).datepicker('setDate', new Date(year, month));
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
            
            
            
            for(i=1;i<=12;i++){                
                $('#id'+i).click(function(){                    
                    $(this).css('background','#2E9AFE');                    
                });
            }
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
