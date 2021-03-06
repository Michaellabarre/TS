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
    
        if(strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') !== false)
        $user_agent_name = 'Mozilla Firefox';                
        elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') !== false)
        $user_agent_name = 'Internet Explorer';
        elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') !== false)
        $user_agent_name = 'Google Chrome';
        else
        $user_agent_name = 'navigateur inconnu';
        //UTILISATION
        //echo $user_agent_name;
        
        function changeDate($date){
            $tab = explode("-", $date);
            $dateChangee = $tab[2]."-".$tab[1]."-".$tab[0];
            return $dateChangee;        
        }   
        
        function changeDate2($date){
            $tab = explode("-", $date);
            $dateChangee = $tab[2]."/".$tab[1]."/".$tab[0];
            return $dateChangee;        
        }   
?>



<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>MAJ Mission</title>
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">
        
        <link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../../includes/db_connect.php" />
		<link   type="text/css" rel="stylesheet" href="../helpers/media/style.css?v=1783"/>
        <script src="../../jquery/jquery-1.8.1.min.js" type="text/javascript"></script>           
        <script src="../../jquery/jquery-ui-1.11.2/jquery-ui.js"></script>
         <script>
$(function() {
    $(".datepicker").each(function(){
        $(this).datepicker({
            autoclose: true,
            dateFormat:"dd/mm/yy",
            //format: "yyyy-mm-dd",
            //daysOfWeekDisabled: [0, 6],
            todayHighlight: true,
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            firstDay: 1,
            monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
            changeMonth: true,
            changeYear: true
            });        
    });
});
</script>
        <link rel="stylesheet" href="../../jquery/jquery-ui-1.11.2/jquery-ui.css" />

        <!-- helper libraries -->
        <!--<script src="../helpers/jquery-1.9.1.min.js" type="text/javascript"></script>-->   
	<!-- /head -->
        <style type="text/css">  
			fieldset{
				background-color:#CCC;
				border:2px solid green;
				-moz-border-radius:8px;
				-webkit-border-radius:8px;	
				border-radius:5px;
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
            #titla{
                color: #0075b0;                
                font-family: serif;
                font-size: 1.1em;
                font-weight: bold;
            }                        
            
            .highlight{
                background-color:#58ACFA;
            }
            
            textarea{
                width: 173px;
                height: 16px;
            }
            
            .pre{
                float: right;
                margin-right: 375px;
                /*background: red;*/
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
            
            select[size]{
            /*your style here */
               width: 550px;                
            }
                        
            .options{
                width: 550px;                
                /*height: 50px;*/
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
            
/*            input[type='submit'] {
                width: 100px!important;    
                float: right;                
            }
            #selectionner{                 
                margin-right: 780px;            
            }*/
            #modifier{
                width: 100px!important;    
                float: right;                
                margin-right: 50px;
            }
            
            #droite{
                float: right;
            }
            
            .cout{
                float: right;
                margin-right: 10px;
                height: 30px;
            }
            .client{
                width: 120px;
                text-align: center;
            }
            .codeprojet{
                width: 220px;
                /*text-align: center;*/
            }
            .nomprojet{
                /*text-align: center;*/
			}
				#compteur {
				text-decoration: blink;
				}
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
                    <MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1></MARQUEE> 
<!--<a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                    -->
                    <hr class="hidden" />
                    </center>
                </div>
            </div>
        </div>   
        <a href="../../logout.php" class="button" title="Deconnexion"><span class="delete">Deconnexion</span></a>
        <?php
            $req     = 'select Profil as profily, RefEmploye as ref, Nomuser as nuser from employes '
                . 'where Nomuser = "'.$Nomuser.'"';
            $rekProf = mysqli_query($connect,$req);
            $resultProf = mysqli_fetch_assoc($rekProf);
            $prof = $resultProf['profily'];
            $ref = $resultProf['ref'];
			$mail_user = $resultProf ['nuser'];
        ?>

    <div id="main">
        <?php
            if($prof == 'Associé' or $prof == 'Manager'){
                ?>
				
				<ul id="nav">
					<li class="current"><a href="index.php">GUIDE</a></li><!-- n1 -->

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
					</ul>
				
                <!-- tabs -->
                   <!-- <nav class="menu">  
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
                            <li><a class='tab selected' href='../mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                     <!--   </ul>
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
                    <font style=" color: black"><b><center>MISE À JOUR DES INFORMATIONS D'UNE MISSION</center></b></font>
                    <br/>
                     <!--xxxCode Patrick RAKOTOMAHANDRYxxxx Code de compteur à reboursxxxx--->
                    <div id="compteur" ></div>
                 <script language="JavaScript">

				 function t()
                 {
             var compteur=document.getElementById('compteur');
             s=duree;
             m=0;h=0;
             if(s<0)
                         {
                                 compteur.innerHTML="<font style='color: red ' ><b><i>Attention vous êtes déconnecté (toute modification non enregistrée sera perdue)</b></i></font>"
						}
                         else
                         {
                                 if(s>59)
                                 {
                                         m=Math.floor(s/60);
                                         s=s-m*60
                 }
                                 if(m>59)
                                 {
                                         h=Math.floor(m/60);
                     m=m-h*60
                                 }
                 if(s<10)
                                 {
                                         s="0"+s
                 }
                 if(m<10)
                                 {
                     m="0"+m
                 }
                   compteur.innerHTML="<font style='color: red'><b><i>Attention vous allez être déconnecté dans "+h+":"+m+":"+s+"<br />Passé ce délai toute modification non enregistrée sera perdue</b></i></font>"
             }
             duree=duree-1;
             window.setTimeout("t();",999);
 
         }
		  </script>
<script>
 duree="1800";
                         t();
                 </script>
                    
                    </nav>
                    <!-- /tabs --> 
                <?php
            }     
            else if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Collaborateur' or $prof == 'Superviseur' or $prof == 'Collaboratrice'){
                ?>
                <!-- tabs -->
				
				
			<ul id="nav">
					<li class="current"><a href="../../guide/index.php">GUIDE</a></li><!-- n1 -->

					<li><a href="../mission/index.php">MISSIONS</a>
						<ul>
							<li><a href="./missioncode.php"><b>Fiche de Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
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
                        <a class='tab selected' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a class='tab selected' href='./missioncode.php'><span>Fiche de Mission</span></a></li>                        
                            <li><a href='./missiondept.php'><span>Mission par département</span></a></li>
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
                    <font style=" color: black"><b><center>VUE SUR LES MISSIONS</center></b></font>
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
							<li><a href="../client/ajoutclient.php"><b>Nouveau lient </b><img src="../images/addusers.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../client/listeclient.php"><b>Liste des Clients </b><img src="../images/utilisateurs.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../client/modifclientcode.php"><b>Modification Client</b></a></li><!-- n2 -->
						</ul>
					</li>
	
					<li><a href="./index.php">MISSIONS</a>
						<ul>
							<li><a href="./nouvellemission.php"><b>Nouvelle Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="./missioncode.php"><b>Modification Mission</b></a></li>
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
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>                    
                            <li><a href='./nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a class='tab selected' href='./missioncode.php'><span>Fiche de Mission</span></a></li> 
                            <li><a href='./missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='./missioncloture.php'><span>Missions cloturées</span></a></li>-->
                      <!--  </ul>
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
                    <font style=" color: black"><b><center>MISE À JOUR DES INFORMATIONS D'UNE MISSION</center></b></font>
    <!--xxxCode Patrick RAKOTOMAHANDRYxxxx Code de compteur à reboursxxxx--->
                    <div id="compteur"></div>
                 <script language="JavaScript">
				 function t()
                 {
             var compteur=document.getElementById('compteur');
             s=duree;
             m=0;h=0;
             if(s<0)
                         {
                                 compteur.innerHTML="<font style='color: red ' ><b><i>Attention vous êtes déconnecté (toute modification non enregistrée sera perdue)</b></i></font>"
             }
                         else
                         {
                                 if(s>59)
                                 {
                                         m=Math.floor(s/60);
                                         s=s-m*60
                 }
                                 if(m>59)
                                 {
                                         h=Math.floor(m/60);
                     m=m-h*60
                                 }
                 if(s<10)
                                 {
                                         s="0"+s
                 }
                 if(m<10)
                                 {
                     m="0"+m
                 }
                       compteur.innerHTML="<font style='color: red'><b><i>Attention vous allez être déconnecté dans "+h+":"+m+":"+s+"<br />Passé ce délai toute modification non enregistrée sera perdue</b></i></font>"
             }
             duree=duree-1;
             window.setTimeout("t();",999);
 
         }
		  </script>
<script>
 duree="1800";
                         t();
                 </script>
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
							<li><a href="../../guide/ajoutclient.php"><b>Nouveau Client </b><img src="../images/addusers.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../../guide/listeclient.php"><b>Liste des Clients </b><img src="../images/utilisateurs.png" border="0" width="15" height="15" align="absmiddle"></a><!-- n2 -->
							</li>
							<li><a href="../../guide/modifclientcode.php"><b>Modification Client</b></a></li><!-- n2 -->
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
                <!--    <nav class="menu">  
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
                            <li><a class='tab selected' href='./missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='./missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='./missioncloture.php'><span>Missions cloturées</span></a></li>-->
                     <!--   </ul>
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
                    <font style=" color: black"><b><center>MISE À JOUR DES INFORMATIONS D'UNE MISSION</center></b></font>
                    <br/>
                        <!--xxxCode Patrick RAKOTOMAHANDRYxxxx Code de compteur à reboursxxxx--->
                    <div id="compteur"></div>
                 <script language="JavaScript">
				 function t()
                 {
             var compteur=document.getElementById('compteur');
             s=duree;
             m=0;h=0;
             if(s<0)
                         {
                                 compteur.innerHTML="<font style='color: red'><b>Attention vous êtes déconnecté (toute modification non enregistrée seront perdue)<b></font>"
             }
                         else
                         {
                                 if(s>59)
                                 {
                                         m=Math.floor(s/60);
                                         s=s-m*60
                 }
                                 if(m>59)
                                 {
                                         h=Math.floor(m/60);
                     m=m-h*60
                                 }
                 if(s<10)
                                 {
                                         s="0"+s
                 }
                 if(m<10)
                                 {
                     m="0"+m
                 }
                    compteur.innerHTML="<font style='color: red ' ><b><i>Attention vous êtes déconnecté (toute modification non enregistrée sera perdue)</b></i></font>"	
             }
             duree=duree-1;
             window.setTimeout("t();",999);
 
         }
		  </script>
<script>
 duree="1800";
                         t();
                 </script>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }            
        ?>
                      
        <div id="container" style="max-height:520px; overflow:scroll; top:500px">                                    
            <div id="dp">
                <center>
                        <div>
                
                    <!-- /top -->
                    <?php
                    if($prof === "Consultant" || $prof === "Consultante" || $prof === "Collaborateur" || $prof === "Superviseur" || $prof === "Collaboratrice" 
                            || $prof === "DAF"){                                                
                    }
                    else{
                        ?>
                        <div class="note" id="note"><b><font color="red">Notes:</font></b> 
                        <br/>&emsp; Les champs grisés sont obligatoires
                        <br/>&emsp; Un département, au moins doit être affecté à la mission                        
                        </div>
                        <?php
                    }
                    ?>

                    
                    <!--<div id="dp">-->
                        <?php
                        
                        ?>
                        
                        <table>
                            <tr>                                
                                <td>
                                    <ul>
                                        <table>
                                            <tr>
                                                <td>
                                                    <form name="missionCode" method="post">	                                                        
                                                        <label for="code_mission"></label>				
                                                        
                                                        <select name="code_mission" id="code_mission" style="width:195px">
                                                            <!--<option>Selection par code mission</option>-->
                                                            <option value="" disabled="" selected style="display:none">Selection par code mission</option>
                                                            <?php
                                                                if($prof == 'DAF'){
                                                                    $reqMissionCode = mysqli_query($connect,'select RefProjet, RefClient, NomProjet from projets '                                                                                            
                                                                    . 'order by RefProjet ASC ;');
                                                                }
                                                                else{
                                                                    $reqMissionCode = mysqli_query($connect,'select RefProjet, RefClient, NomProjet from projets '                            
                                                                    . 'where TypeProjet not in ("EXTRA") '
                                                                    . 'order by RefProjet ASC ;');
                                                                }
                                                            
//                                                                $reqMissionCode = mysqli_query($connect,'select RefProjet, RefClient, NomProjet from projets '                            
//                                                                . 'where TypeProjet not in ("EXTRA") '
//                                                                . 'order by RefProjet ASC ;');
                                                            
                                                                
                                                                while($r = mysqli_fetch_array($reqMissionCode, MYSQLI_BOTH)){
                                                                    if($user_agent_name == 'Mozilla Firefox'){
                                                                            echo '<option class="options" value="'.$r[0].'">'.$r[0].' --- '.$r[2].' --- '.$r[1].'</option>';                                        
                                                                    }
                                                                    else{
                                                                            echo '<option value="'.$r[0].'">'.$r[0].' --- '.$r[2].' --- '.$r[1].'</option>';                                        
                                                                    }
                                                                    
                                                                }
                                                            ?>																																		
                                                        </select>
                                                        
                                                        <input type="submit" name="selectionner1" id="selectionner" value="Selectionner" />                                                        
                                                    </form>
                                                </td>
                                                <td>
                                                    <form name="missionCode" method="post">	
                                                        <ul>
                                                        <select name="code_cli" id="code_cli" style="width:179px">									
                                                            <!--<option>Selection par nom Client</option>-->
                                                            <option value="" disabled="" selected style="display:none">Selection par nom Client</option>
                                                            <?php                                                               
                                                                $reqNomClient = mysqli_query($connect, 'select NomSociete, RefProjet, NomProjet, count(1) as kount                                                               
                                                                    from projets
                                                                    inner join client on (client.RefClient = projets.RefClient)
                                                                    where client.NomSociete in 
                                                                    (
                                                                            select C.NomSociete from projets P inner join client C on (C.RefClient = P.RefClient)
                                                                    )
                                                                    group by NomSociete;'); 
                                                                                                                                  
                                                                while($rc = mysqli_fetch_array($reqNomClient, MYSQLI_BOTH)){
                                                                    if($rc[3] > 1){
                                                                        echo '<option value="'.$rc[0].'">'.$rc[0].'</option>';
                                                                    }
                                                                    else{
                                                                        echo '<option value="'.$rc[0].'">'.$rc[0].'</option>';
                                                                    }                                                                    
                                                                }
                                                            ?>																																		
                                                        </select>

                                                        <input type="submit" name="selectionner2" value="Selectionner" />
                                                        </ul>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                        
                        
                        <?php
                        if(isset($_POST['selectionner1']) or isset($_POST['selectionner2'])){                            
                            if(isset($_POST['selectionner1'])){
                                if($_POST['code_mission'] == ''){
                                    echo '<font color="red"><br/>Veuillez s&eacute;lectionner le code.</font>';																
                                }
                                else{
                                    
                                    $codeMission = $_POST['code_mission'];  
                                    
                                    $reqRefEmploye = 'select RefEmploye as EMPLO, Coddept from employes where Nomuser = "'.$Nomuser.'"';                                                                          
                                    $rekRefEmp     = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                                    $resultRefEmp  = mysqli_fetch_assoc($rekRefEmp);
                                    $refEmploye    = $resultRefEmp['EMPLO'];
                                    $coddepa       = $resultRefEmp['Coddept'];                                    
                                    
//                                    echo 'refemploye '.$refEmploye;
                                                                                                                                              
                                    $reqDept = 'select count(1) as kounty from deptprojet
                                    where RefProjet = "'.$codeMission.'"
                                    and Coddept = "'.$coddepa.'";';                                    
                                    $rekDep     = mysqli_query($connect,$reqDept) or exit(mysqli_error($connect));
                                    $resultDep  = mysqli_fetch_assoc($rekDep);
                                    $kounty     = $resultDep['kounty'];   
                                    
                                    $reqDeptMan = 'select count(1) as kounty from deptprojet
                                    where RefProjet = "'.$codeMission.'"
                                    and Respvalid = "'.$refEmploye.'";';
                                    $rekDepMan     = mysqli_query($connect,$reqDeptMan) or exit(mysqli_error($connect));
                                    $resultDepMan  = mysqli_fetch_assoc($rekDepMan);
                                    $kountyMan        = $resultDepMan['kounty']; 
                                    
//                                    echo '$kountyman '.$kountyMan;                                    
//                                    echo 'kounty ' .$kounty;                                    
                                    
                                    $reqMission = 'SELECT NomProjet AS mission FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqMi = mysqli_query($connect,$reqMission);
                                    $resultMi = mysqli_fetch_assoc($reqMi);
                                    $mission = $resultMi['mission'];

                                    $reqCli = 'SELECT C.NomSociete as cli from client C inner join projets P on (P.RefClient = C.RefClient) WHERE RefProjet = "'.$codeMission.'";';
                                    $reqCl = mysqli_query($connect,$reqCli);
                                    $resultCli = mysqli_fetch_assoc($reqCl);
                                    $cli = $resultCli['cli'];           
									
									//MODIF RODDY 
									$reqgrCli = 'SELECT GroupeCli AS groupcli FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqqgrCl = mysqli_query($connect,$reqgrCli);
                                    $resultgrCli = mysqli_fetch_assoc($reqqgrCl);
                                    $groupeCli = $resultgrCli['groupcli']; 	
									
									$reqliencom = 'SELECT LienCom  FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqqliencom = mysqli_query($connect,$reqliencom);
                                    $resultliencom= mysqli_fetch_assoc($reqqliencom);
                                    $Liencomm= $resultliencom['LienCom']; 	

									$reqliencontrat = 'SELECT LienContrat  FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqqliencontrat = mysqli_query($connect,$reqliencontrat);
                                    $resultliencontrat= mysqli_fetch_assoc($reqqliencontrat);
                                    $Liencontratt= $resultliencontrat['LienContrat']; 
									

									$reqlangue= 'SELECT Langue  FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqqlienlangue = mysqli_query($connect,$reqlangue);
                                    $resultlienlangue= mysqli_fetch_assoc($reqqlienlangue);
                                    $languee= $resultlienlangue['Langue']; 
									
									//FIN MODIF RODDY 

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
                                        <span id="spann" style="float: right; padding: 8px;"><input type="submit" disabled="disabled" name="modifier" id="modifier" value="Modifier" onmouseover="this.disabled='';"/></span>
                                        <!--<input type="submit" name="modifier" id="modifier" value="Modifier" />-->
                                        <br/>
                                            
                                        <input type="checkbox" id="cloturer" name="cloturer" 
                                               <?php
                                                if($cloture == 1) {
                                                    echo 'checked disabled';                                           
                                                }                                            
                                               ?>
                                               onclick="if(this.checked){
                                                            var ok;
                                                            ok = confirm('Vous êtes sur le point de clôturer la mission. Voulez-vous continuer?');
                                                                if(ok == true){
                                                                    this.checked = true;
                                                                }
                                                                else{
                                                                    this.checked = false;
                                                                }
                                                            }    
                                                        "/>                                    
                                               
                                        <span id="cochetext"> <b><font color="">Clôturer la mission</font></b> </span><br/><br/>                                    
                                    <table>
                                        <tr>                                
                                            <td>   
                                                <ul style=" list-style-type: none">
                                                    <!--<fieldset style="border-color: #F0F5FF">-->
                                                    <Fieldset><legend><b>INFOS CLIENT</b></legend>                                        
                                                    <table>  
                                                        <tr>
                                                            <td><label>Code Mission</label></td>
                                                            <td><input  type="text" name="cdeMission" style="width:173px" id="cdeMission" value="<?php echo $codeMission; ?>" readonly /></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Mission</label></td>
                                                            <td><textarea type="text" name="mission" style="width:173px" id="mission" onblur="verifChampNul(this)"><?php echo $mission; ?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Nom du Client</label></td>
                                                            <td>
                                                                <textarea type="text" name="client" id="client" readonly style="width:173px" ><?php echo $cli; ?></textarea>                                                                                                                    
                                                            </td>
                                                        </tr>
														<!-- MODIF RODDY AJOUT GROUPE CLIENT-->
														<tr>
														<td><label>Groupe Client </label></td>
														<td><textarea type="text" name="grclient" id="grclient" style="width:173px" onblur="verifChampNul(this)"><?php echo $groupeCli; ?></textarea></td>
														</tr>
														<!--MODIF RODDY GROUPE MISSION -->
                                                        <tr>
                                                            <td><label>Cat&eacute;gorie</label></td>
                                                            <td>
                                                                <select name="categorie" id="categorie" style="width:179px" onblur="verifChampNul(this)">                                                                    
                                                                        <?php
                                                                            if($prof == 'DAF'){
                                                                                $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null and TypeProjet in ("EXTRA") order by TypeProjet ASC;');
                                                                            }
                                                                            else{
                                                                                $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null and TypeProjet not in ("DISPO", "QUALITE", "EXTRA") order by TypeProjet ASC;');
                                                                            }
                                                                        
//                                                                            $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null and TypeProjet not in ("DISPO", "QUALITE") order by TypeProjet ASC;');
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
                                                                <select name="origine" id="origine" style="width:179px" onblur="verifChampNul(this)" onchange="saisieOrigine(this);">   
                                                                    <optgroup label="Choisir dans la liste déroulante">;
                                                                    <?php
                                                                        $reqListOrigine = mysqli_query($connect,'select distinct Origine from projets where Origine is not null order by Origine ASC;');
                                                                        while($rowOrg = mysqli_fetch_array($reqListOrigine, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowOrg[0].'" >'.$rowOrg[0].'</option>';
                                                                        }
                                                                    ?>
                                                                    </optgroup>
                                                                    <optgroup label="Nouvelle Origine">
                                                                        <option>Ajouter</option>
                                                                    </optgroup>
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
                                                                <textarea type="text" name="typeClient" id="typeClient" readonly style="width:173px" ><?php echo $cliType; ?></textarea>                                                    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labstat" for="stat" style="display: none"> STAT</label></td>
                                                            <td><textarea type="text" name="stat" id="stat" readonly style="display: none;width:173px" placeholder="11111 11 1111 11111"><?php echo $stat;?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labnif" for="nif" style="display: none"> N.I.F </label></td>
                                                            <td><textarea type="text" name="nif" id="nif" readonly style="display: none;width:173px" placeholder="1111111111"><?php echo $nif;?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labcif" for="cif" style="display: none"> C.I.F </label></td>
                                                            <td><textarea type="text" name="cif" id="cif" readonly style="display: none;width:173px" placeholder="1111111/DGI-B du jj/mm/aaaa"><?php echo $cif;?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labrcs" for="rcs" style="display: none"> R.C.S </label></td>
                                                            <td><textarea type="text" name="rcs" id="rcs" readonly style="display: none;width:173px" placeholder="1111 B 11111"><?php echo $rcs;?></textarea></td>
                                                        </tr>
                                                    </table>  
													</Fieldset>
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
                                                   <fieldset><legend><b>INFOS CONTRATS</b></legend>
                                                    <table>                                        
                                                        <tr>
                                                            <td>
                                                                <table>
                                                                    <tr>
                                                                        <td><label>Chef de mission FTHM.</label></td>
                                                                        <td><textarea type="text" name="chef" style="width:173px" id="chef" onblur="verifChampNul(this)"><?php echo($resultInfoC -> Chefmission) ?></textarea></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date signature contrat</label></td>                                                                        
                                                                        <td><input readonly type="text" name="signContrat"  style="width:174px" id="signContrat" value="<?php if( $resultInfoC -> Datesignature == "" || $resultInfoC -> Datesignature == "0000-00-00"){echo '';}  else {echo (changeDate2($resultInfoC -> Datesignature));}?>"/></td>                                                                                
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date d'archivage</label></label></td>                                                                        
                                                                        <td><input readonly type="text" name="dteArchiv"  style="width:174px" id="dteArchiv" value="<?php if($resultInfoC -> Datearchctr == "" || $resultInfoC -> Datearchctr == "0000-00-00"){ echo '';} else {echo (changeDate2($resultInfoC -> Datearchctr));}?>"/></td>                                                                                
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date de d&eacute;but pr&eacute;vu</label></td>                                                                        
                                                                        <td><input readonly type="text" name="dtePrevu"  style="width:174px" id="dtePrevu" value="<?php if($resultInfoC -> DateDebutProjet == "" || $resultInfoC -> DateDebutProjet == "0000-00-00"){echo '';} else{ echo (changeDate2($resultInfoC -> DateDebutProjet));}?>" onblur="verifChampNul(this)"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date de fin pr&eacute;vue</label></td>                                                                        
                                                                        <td><input readonly type="text" name="dteFin"  id="dteFin" style="width:174px" value="<?php if($resultInfoC -> DateFinProjet == "" || $resultInfoC -> DateFinProjet == "0000-00-00"){echo '';} else{ echo (changeDate2($resultInfoC -> DateFinProjet));}?>" onblur="verifChampNul(this)"/> </td>
                                                                    </tr> 
																	
													<!-- MODIF RODDY AJOUT lien com et lien contrat -->
																	<tr>
																		<td><label>Lien vers Proposition Commerciale </label></td>                                                            
																		<td><input type="text" name="Liencom" style="width:300px" id="Liencom" value="<?php echo $Liencomm; ?>" /></td> 
																	</tr>
																	<tr>
																		<td><label>Lien vers Contrat </label></td>                                                            
																		<td><input type="text" name="Liencontrat" style="width:300px" id="Liencontrat" value = "<?php echo $Liencontratt; ?>"  /></td> 
																	</tr>
														<!-- FIN MODIF RODDY AJOUT lien com et lien contrat -->
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <ul style=" list-style-type: none">
                                                                <table>
                                                                    <tr>
                                                                        <td><label>Date d&eacute;but r&eacute;elle</label></td>                                                                        
                                                                        <td><input readonly type="text" name="dbuReel"  id="dbuReel" value="<?php if($resultInfoC -> DateDebutR == "" || $resultInfoC -> DateDebutR == "0000-00-00"){echo '';} else{  echo (changeDate2($resultInfoC -> DateDebutR));}?>" style="width:174px"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date fin r&eacute;elle</label></td>                                                                        
                                                                        <td><input readonly type="text" name="finReel"  id="finReel" value="<?php if($resultInfoC -> DateFinR == "" || $resultInfoC -> DateFinR == "0000-00-00"){echo '';} else{ echo (changeDate2($resultInfoC -> DateFinR));}?>" style="width:174px"/></td>
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
                                                                        <td><input readonly type="text" name="dteAvenant" id="dteAvenant"  value="<?php if($resultInfoC -> Datesignaven == "" || $resultInfoC -> Datesignaven == "0000-00-00"){echo '';} else{ echo (changeDate2($resultInfoC -> Datesignaven));} ?>"  style="display: none; width: 174px" /></td>                                                                                                                                                  
                                                                    </tr>
                                                                </table>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </table> 
													</fieldset>
                                                    <?php
                                                    }
                                                    ?>
                                                <!--</fieldset>-->
                                                </ul>
                                            </td>                               
                                        </tr>                                
                                    </table> 
									<ul style=" list-style-type: none">
									<Fieldset><legend><b>INFOS FACTURATION</b></legend>									
                                    <table>
                                        <tr>                                
                                            <td>   
                                                
                                                    <!--<fieldset style="border-color: #F0F5FF">-->
                                                    <br><br>

                                                  <!---  <legend><b>Infos Facturation</b></legend>-->
                                                    <table>
                                                        <tr>
                                                            <td><label>Soci&eacute;t&eacute; Fact</label></td>
                                                            <td>
                                                                <select name="refSoc" id="refSoc" style="width:179px" onblur="verifChampNul(this)">                                                                                                                                                        
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
                                                            <td><textarea type="text" name="interFac" style="width:173px" id="interFac" onblur="verifChampNul(this)"><?php echo($resultInfoC -> Interlocfacture) ?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Adresse Fact</label></td>
                                                            <td><textarea type="text" name="adresseFact" id="adresseFact" style="width:173px" onblur="verifChampNul(this)"><?php echo($resultInfoC -> Adressefacture) ?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Coordonn&eacute;es</label></td>
                                                            <td><textarea type="text" name="Coord" id="Coord" style="width:173px" onblur="verifChampNul(this)"><?php echo($resultInfoC -> Coordoninterloc) ?></textarea></td>
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
                                                            <select name="devizy" id="devizy" style="width:179px" onblur="verifChampNul(this)" onchange="saisieDevise(this);">   
                                                                <optgroup label="Choisir dans la liste déroulante">;
                                                                    <?php
                                                                        $monnaie = $resultInfoC -> Monnaie;
//                                                                        $reqDeviseList = mysqli_query($connect,'select distinct Monnaie from projets where Monnaie is not null order by Monnaie ASC;');
                                                                        $reqDeviseList = mysqli_query($connect,'select distinct CodeDevise from devise order by CodeDevise ASC;');
                                                                        while($rowDevise = mysqli_fetch_array($reqDeviseList, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowDevise[0].'" >'.$rowDevise[0].'</option>';
                                                                        }
                                                                    ?>
                                                                </optgroup>
<!--                                                                <optgroup label="Nouvelle Devise">
                                                                    <option>Ajouter</option>
                                                                </optgroup>-->
                                                            </select>
                                                            <script>
                                                                monnaie = "<?php echo $monnaie; ?>";                                                               
                                                                document.getElementById("devizy").selectedIndex = getIndex(monnaie, "devizy");
                                                            </script>
                                                        </td>
                                                    </tr>
													
														<!--MODIF RODDY AJOUT langue-->
													 <tr>
															<td><label>Langue  </label></td>
														   <!--<td><input  type="text" name="langue" id="langue" style="width:164px" onblur="verifChampNul(this)"/> </td> -->
														   <td>
														   <select name="langue" id="langue" style="width:179px" onblur="verifChampNul(this);" >   
																<option ></option>
																<option >Française</option>
																<option >Malagasy</option>
																<option >Américaine</option>
																<option >Africaine</option>
																<option >Comorienne</option>
															</select>  
															<script>
                                                                langueee = "<?php echo $languee; ?>";                                                               
                                                                document.getElementById("langue").selectedIndex = getIndex(langueee, "langue");
                                                            </script>
															</td>
														</tr>
										<!--FIN MODIF RODDY AJOUT langue-->
													
                                                    <tr>
                                                        <td><label>Type Honoraire </label></td>
                                                        <td>
                                                            <select name="typehono" id="typehono" style="width:179px" onblur="verifChampNul(this)" onchange="saisieTypeHono(this);">
                                                                <optgroup label="Choisir dans la liste déroulante">;
                                                                    <?php
                                                                        $refhonotype = $resultInfoC -> Reftypehono;
                                                                        $reqListTypeHonoraire = mysqli_query($connect,'select distinct Reftypehono from projets where Reftypehono is not null order by Reftypehono ASC;');
                                                                        while($rowTypeHono = mysqli_fetch_array($reqListTypeHonoraire, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowTypeHono[0].'" >'.$rowTypeHono[0].'</option>';
                                                                        }
                                                                    ?>                                            
                                                                </optgroup>
                                                                <optgroup label="Nouvelle Type Honoraire">
                                                                    <option>Ajouter</option>
                                                                </optgroup>
                                                            </select>                                                            
                                                            <script>
                                                                refhonotype = "<?php echo $refhonotype; ?>";                                                                
                                                                document.getElementById("typehono").selectedIndex = getIndex(refhonotype, "typehono");
                                                            </script>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Montant honoraire (HT)</label></td>
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
                                                            <select name="mod_fac" id="mod_fac" style="width:179px" onblur="verifChampNul(this)" onchange="saisieModeFact(this);">
                                                                <optgroup label="Choisir dans la liste déroulante">;
                                                                    <?php
                                                                        $honomode = $resultInfoC -> Modefachono;
                                                                        $reqModFacturation = mysqli_query($connect,'select distinct Modefachono from projets where Modefachono is not null order by Modefachono ASC;');
                                                                        while($rowModFac = mysqli_fetch_array($reqModFacturation, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowModFac[0].'" >'.$rowModFac[0].'</option>';
                                                                        }
                                                                    ?> 
                                                                </optgroup>
                                                                <optgroup label="Nouvelle Mode de Facturation">
                                                                    <option>Ajouter</option>
                                                                </optgroup>
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
                                                        <td><textarea type="text" name="modFact" id="modFact" style="width:173px" style="display: none"><?php echo($resultInfoC -> Modefacdebour) ?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label id="labMontantDeb" for="montantDeb" style="display: none">Montant d&eacute;bours </label></td>
                                                        <td><input type="double" name="montantDeb" id="montantDeb" style="width:173px" value="<?php echo(number_format($resultInfoC -> EstimationCoutDebours,2, ".", " ")) ?>"  style="display: none"/></td>
                                                    </tr>
                                                </table>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>
									</fieldset>
                                    <table>
                                        <tr>
                                            <td>
                                                <ul style=" list-style-type: none">
                                                    <br><br>
                                                    <legend><b>Affectation Département</b></legend>
                                                    <div style="max-height: 200px;overflow: scroll; top: 50px">
                                                    <table id="echeance">                                                                                        
                                                        <tr>
                                                            <td id="titla" style=" background-color: white"><center>Département</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Manager</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Associé</center></td>
                                                        </tr>
                                                        <?php
                                                        $qdep   = 'select count(1) as nbdep from departement;';
                                                        $resdep = mysqli_query($connect,$qdep);
                                                        $fecdep = mysqli_fetch_assoc($resdep);
                                                        $nbdep  = $fecdep['nbdep'];
                                                        $j = 1;
                                                        $reqAffecMission = 'select D.Departement as Département, DP.Respvalid as Manager, DP.Dirmission as Associe 
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
                                                            $li = 0;
                                                            while($row = mysqli_fetch_array($reqMissionAffect, MYSQLI_BOTH)){                                                           
                                                                $li = $li +1;
                                                                echo '<tr>';
                                                                for($m=0; $m < $colonne ; $m++){
                                                                    switch ($m){
                                                                        case 0:
                                                                            echo '<td>';
                                                                                echo '<select class="trans" name="deptList[]" id="deptList_'.$li.'" style="width:125px" >';
                                                                                echo '<option></option>';
//                                                                                echo '<option selected>'.$row[$m].'</option>';
                                                                                    $reqDepList = 'select Departement from departement order by Departement ASC;';
                                                                                    $resultDepList = mysqli_query($connect,$reqDepList);
                                                                                    while($rowDepList = mysqli_fetch_array($resultDepList, MYSQLI_BOTH)){
                                                                                        echo '<option value="'.$rowDepList[0].'" >'.$rowDepList[0].'</option>';
                                                                                    }
                                                                                echo '</select>'; 
                                                                                ?>
                                                                                <script>
                                                                                    var cde = "<?php echo $row[$m]; ?>"; 
                                                                                    var li  = "<?php echo $li; ?>"; 
                                                                                    document.getElementById("deptList_"+li).selectedIndex = getIndex(cde, "deptList_"+li);
                                                                                </script>
                                                                                <?php
                                                                                
                                                                            echo '</td>';
                                                                            break;
                                                                        case 1:
                                                                            echo '<td>';
                                                                                echo '<select class="trans" name="managerList[]" id="managerList_'.$li.'" style="width:125px">';
                                                                                    echo '<option></option>';                                                                                    
                                                                                                                                                                        
                                                                                $verifMan       = 'select actif as actMan, concat(Prenom, " ", NomFamille) as prenMan from employes where RefEmploye = "'.$row[$m].'"';
                                                                                $reqVerifMan    = mysqli_query($connect,$verifMan);
                                                                                $resultVerifMan = mysqli_fetch_assoc($reqVerifMan);
                                                                                $manIff         = $resultVerifMan['actMan'];
                                                                                $prenMan        = $resultVerifMan['prenMan'];           
                                                                                    
                                                                                if($manIff == 1){
                                                                                    echo '<option selected>'.$prenMan.'</option>';
                                                                                    $reqManagerList = "select RefEmploye, Prenom, NomFamille 
                                                                                                    from employes 
                                                                                                    where (Profil = 'Manager' or Profil like '%Associé%') 
                                                                                                    and actif =0 
                                                                                                    and RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ') order by Prenom ASC;";
                                                                                    $resultManagerList = mysqli_query($connect,$reqManagerList);
                                                                                    while($rowManagerList = mysqli_fetch_array($resultManagerList, MYSQLI_BOTH)){
                                                                                        echo '<option value="'.$rowManagerList[0].'" >'.$rowManagerList[1].' '.$rowManagerList[2].'</option>';
                                                                                    }
                                                                                    echo '</select>';                                                                                    
                                                                                }
                                                                                else{
                                                                                    $reqManagerList = "select RefEmploye, Prenom, NomFamille 
                                                                                                    from employes 
                                                                                                    where (Profil = 'Manager' or Profil like '%Associé%') 
                                                                                                    and actif =0 
                                                                                                    and RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ') order by Prenom ASC;";
                                                                                    $resultManagerList = mysqli_query($connect,$reqManagerList);
                                                                                    while($rowManagerList = mysqli_fetch_array($resultManagerList, MYSQLI_BOTH)){
                                                                                        echo '<option value="'.$rowManagerList[0].'" >'.$rowManagerList[1].' '.$rowManagerList[2].'</option>';
                                                                                    }
                                                                                    echo '</select>';
                                                                                    ?>
                                                                                    <script>
                                                                                        var mang = "<?php echo $row[$m]; ?>"; 
                                                                                        var li  = "<?php echo $li; ?>"; 
                                                                                        document.getElementById("managerList_"+li).selectedIndex = getIndex(mang, "managerList_"+li);
                                                                                    </script>
                                                                                    <?php
                                                                                }                                                                                                                                                                        
                                                                            echo '</td>';
                                                                            break;
                                                                        case 2:
                                                                            echo '<td>';
                                                                                echo '<select class="trans" name="assocList[]" id="assocList_'.$li.'" style="width:125px">';
                                                                                    echo '<option></option>';
                                                                                    
                                                                                    $verifAss       = 'select actif as actAss, concat(Prenom, " ", NomFamille) as prenAss from employes where RefEmploye = "'.$row[$m].'"';
                                                                                    $reqVerifAss    = mysqli_query($connect,$verifAss);
                                                                                    $resultVerifAss = mysqli_fetch_assoc($reqVerifAss);
                                                                                    $assIff         = $resultVerifAss['actAss'];
                                                                                    $prenAss        = $resultVerifAss['prenAss'];
            //                                                                        echo 'actif: '.$actIff;
                                                                                    
                                                                                    if($assIff == 1){
                                                                                        echo '<option selected>'.$prenAss.'</option>';
                                                                                        $reqAssocList = "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre "
                                                                                            . "from employes "
                                                                                            . "where Profil = 'Associé' "
                                                                                            . "and actif =0 "
                                                                                            . "order by Prenom ASC" ;
                                                                                            $resultAssocList = mysqli_query($connect,$reqAssocList);
                                                                                            while($rowAssocList = mysqli_fetch_array($resultAssocList, MYSQLI_BOTH)){
                                                                                                echo '<option value="'.$rowAssocList[0].'" >'.$rowAssocList[1].'</option>';
                                                                                            }
                                                                                        echo '</select>';                                                                                        
                                                                                    }
                                                                                    else{
                                                                                        $reqAssocList = "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre "
                                                                                            . "from employes "
                                                                                            . "where Profil = 'Associé' "
                                                                                            . "and actif =0 "
                                                                                            . "order by Prenom ASC" ;
                                                                                            $resultAssocList = mysqli_query($connect,$reqAssocList);
                                                                                            while($rowAssocList = mysqli_fetch_array($resultAssocList, MYSQLI_BOTH)){
                                                                                                echo '<option value="'.$rowAssocList[0].'" >'.$rowAssocList[1].'</option>';
                                                                                            }
                                                                                        echo '</select>';
                                                                                        ?>
                                                                                        <script>
                                                                                            var assli = "<?php echo $row[$m]; ?>"; 
                                                                                            var li  = "<?php echo $li; ?>"; 
                                                                                            document.getElementById("assocList_"+li).selectedIndex = getIndex(assli, "assocList_"+li);
                                                                                        </script>
                                                                                        <?php
                                                                                    }
                                                                                    
                                                                                    
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
                                                                        $reqManagerList = "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre
                                                                                from employes 
                                                                                where (Profil = 'Manager' or Profil like '%Associé%') 
                                                                                and actif =0 
                                                                                and RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ') order by Prenom ASC;";
                                                                        $resultManagerList = mysqli_query($connect,$reqManagerList);
                                                                        while($rowManagerList = mysqli_fetch_array($resultManagerList, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowManagerList[0].'" >'.$rowManagerList[1].'</option>';
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
                                                                        $reqAssocList = "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre "
                                                                            . "from employes "
                                                                            . "where Profil = 'Associé' "
                                                                            . "and actif =0 "
                                                                            . "order by Prenom ASC" ;
                                                                        $resultAssocList = mysqli_query($connect,$reqAssocList);
                                                                        while($rowAssocList = mysqli_fetch_array($resultAssocList, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowAssocList[0].'" >'.$rowAssocList[1].'</option>';
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
                                                            <td id="titla" style=" background-color: white"><center>Consultant</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Profil</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Nombre JH</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Tarif JH</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Montant</center></td> 
                                                        </tr>
                                                        <?php
                                                        $montant = array();
                                                        $total = 0;
                                                        $reqInterv = 'select E.RefEmploye as Consultant, PR.Protarif as Profil, J.NombreJH as NombreJH, 
                                                            J.TarifJH as TarifJH, J.NombreJH*J.TarifJH as Montant  
                                                            from jhprevu J
                                                        inner join employes E on (E.RefEmploye = J.RefEmploye)
                                                        inner join protarif PR on (PR.Protarif = J.Protarif)
                                                        inner join projets P on (P.RefProjet = J.RefProjet)
                                                        where P.RefProjet = "'.$codeMission.'" ';
//                                                                . 'order by E.prenom';
                                                        $reqIntervenant = mysqli_query($connect, $reqInterv);
                                                        $colonneInterv = mysqli_num_fields($reqIntervenant); //col
                                                        $ligneInterv = mysqli_num_rows($reqIntervenant); //rows
                                                        
                                                        $lili = 0;
                                                        while($rowInterv = mysqli_fetch_array($reqIntervenant, MYSQLI_BOTH)){
                                                            $lili = $lili +1;
                                                            echo '<tr>';
                                                            for($n=0;$n<$colonneInterv;$n++){
                                                                switch ($n){
                                                                    case 0: echo '<td>'
                                                                        . '<select class="trans" name="nameCons[]" id="nameCons_'.$lili.'" style="width:250px">'
                                                                        . '<option></option>';
//                                                                        . '<option selected>'.$rowInterv[$n].'</option>';                                                                        
                                                                        
                                                                        $verifcons       = 'select actif as act, concat(Prenom, " ", NomFamille) as pren from employes where RefEmploye = "'.$rowInterv[$n].'"';
                                                                        $reqVerifCons    = mysqli_query($connect,$verifcons);
                                                                        $resultVerifCons = mysqli_fetch_assoc($reqVerifCons);
                                                                        $actIff          = $resultVerifCons['act'];
                                                                        $pren          = $resultVerifCons['pren'];
//                                                                        echo 'actif: '.$actIff;
                                                                        
                                                                        if($actIff == 1){
                                                                            echo '<option selected>'.$pren.'</option>'; 
                                                                            $reqnameConsList = 'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre '
                                                                                . 'FROM employes where '
                                                                                . 'actif = 0 and '
                                                                                . 'RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") '
                                                                                . 'ORDER BY Prenom ASC;';
                                                                            $resultNameConsList = mysqli_query($connect,$reqnameConsList);
                                                                            while($rowNameConsList = mysqli_fetch_array($resultNameConsList, MYSQLI_BOTH)){
                                                                                echo '<option value="'.$rowNameConsList[0].'" >'.$rowNameConsList[1].'</option>';
                                                                            }
                                                                                echo '</option>'
                                                                                    . '</select>';                                                                                
                                                                                echo '</td>';
                                                                            break;
                                                                        }
                                                                        else{
//                                                                            echo '<option selected>'.$rowInterv[$n].'</option>'; 
                                                                            $reqnameConsList = 'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre '
                                                                                . 'FROM employes where '
                                                                                . 'actif = 0 and '
                                                                                . 'RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") '
                                                                                . 'ORDER BY Prenom ASC;';
                                                                            $resultNameConsList = mysqli_query($connect,$reqnameConsList);
                                                                            while($rowNameConsList = mysqli_fetch_array($resultNameConsList, MYSQLI_BOTH)){
                                                                                echo '<option value="'.$rowNameConsList[0].'" >'.$rowNameConsList[1].'</option>';
                                                                            }
                                                                                echo '</option>'
                                                                                    . '</select>';
                                                                                ?>
                                                                                    <script>
                                                                                        var cons = "<?php echo $rowInterv[$n]; ?>"; 
                                                                                        var li  = "<?php echo $lili; ?>"; 
                                                                                        document.getElementById("nameCons_"+li).selectedIndex = getIndex(cons, "nameCons_"+li);
                                                                                    </script>
                                                                                <?php
                                                                                echo '</td>';
                                                                            break;
                                                                        }
                                                                        
                                                                    case 1: echo '<td>'
                                                                                . '<select class="trans" name="prof[]" id="prof_'.$lili.'" style="width:125px">  '
                                                                                . '<option></option>';
//                                                                                . '<option selected>'.$rowInterv[$n].'</option>';
                                                                                $reqProfily = 'select Protarif from protarif order by Protarif ASC';
                                                                                    $resultProfily = mysqli_query($connect,$reqProfily);
                                                                                while($rowProf = mysqli_fetch_array($resultProfily, MYSQLI_BOTH)){
                                                                                    echo '<option value="'.$rowProf[0].'" >'.$rowProf[0].'</option>';
                                                                                }
                                                                            echo ''
                                                                                . '</select>';
                                                                            ?>
                                                                                <script>
                                                                                    var pro = "<?php echo $rowInterv[$n]; ?>"; 
                                                                                    var li  = "<?php echo $lili; ?>"; 
                                                                                    document.getElementById("prof_"+li).selectedIndex = getIndex(pro, "prof_"+li);
                                                                                </script>
                                                                            <?php
                                                                            echo '</td>';
                                                                            break;    
                                                                    case 2: echo '<td><input type="double" name="nbJH[]" value="'.$rowInterv[$n].'" style="width:100px" onclick="verifChampDynClear(this)"/></td>';
                                                                                break;
                                                                    case 3: echo '<td><input type="double" style=" text-align: right" name="tarifJH[]" value="'.number_format((float)$rowInterv[$n], 2, ".", " ").'" style="width:115px"  onclick="verifChampDynClear(this)"/></td>';
                                                                                break;
                                                                    case 4: echo '<td><input type="double" style=" text-align: right" name="montant[]" value="'.number_format((float)$rowInterv[$n], 2, ".", " ").'"  style="width:115px" readonly/></td>';
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
                                                                        $reqnameConsList = 'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre '
                                                                            . 'FROM employes where actif = 0 '
                                                                            . 'and RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") '
                                                                            . 'ORDER BY Prenom ASC;';
                                                                        $resultNameConsList = mysqli_query($connect,$reqnameConsList);
                                                                        while($rowNameConsList = mysqli_fetch_array($resultNameConsList, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowNameConsList[0].'" >'.$rowNameConsList[1].'</option>';
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
                                                            </tr>';
                                                        }
                                                        ?>
                                                        </table>
                                                    </div>
                                                </ul>
                                            </td>
                                        </tr>                                    
                                    </table>
                                        <?php
                                            $reqRemise     = 'select EstimationCoutTotalProjet as hono, pgeremise as p, montantremise as m, TxRemise as t, montantavecremise as mar '
                                                    . 'from projets '
                                                    . 'where RefProjet = "'.$codeMission.'"';
                                            $resRemise     = mysqli_query($connect,$reqRemise) or exit(mysqli_error());
                                            $resulttRemise = mysqli_fetch_assoc($resRemise);
                                            $hono      = $resulttRemise['hono'];
//                                            $mti       = $resulttRemise['mti'];
                                            $pr        = $resulttRemise['p'];
                                            $mr        = $resulttRemise['m'];
                                            $tr        = $resulttRemise['t'];
                                            if($pr == 0 && $mr == 0){
//                                                echo number_format((float)$total, 2, ".", " ");
                                                $mar       = $total;
                                            }
                                            else{
                                                $mar       = $resulttRemise['mar'];
                                            }                                                                                        
                                        ?>
                                                                                
                                        <div class="cout">
                                            <table id="echeance">                                            
                                                <tr>
                                                    <td style="width: 175px"></td>
                                                    <td id="titla" style="width: 50px"><b><center>%</center></b></td>
                                                    <td id="titla" style="width: 175px"><b><center>Valeur</center></b></td>
                                                    <td id="titla" style="width: 172px"><b><center>Total</center></b></td>
                                                </tr>  
                                                <tr>
                                                    <td style="width: 175px">Montant total</td>
                                                    <td style="width: 50px"></td>
                                                    <td style="width: 175px"></td>
                                                    <td style="width: 172px"><b><input style=" text-align: right; width: 168px" readonly id="montanttotal" name="montanttotal" type="text" value="<?php echo number_format((float)$total, 2, ".", " ");?>" /></b></td>
                                                </tr>                                               
                                                <tr>
                                                    <td style="width: 175px">Montant remise accordée</td>
                                                    <td style="width: 50px"><input id="remiseptge" name="remiseptge" value="<?php echo number_format((float)$pr, 2, ".", " "); ?>" style="width:100px" type="double" placeholder="En %" onblur="calcul();"/></td>
                                                    <td style="width: 175px"><input id="remisechiffre" name="remisechiffre" value="<?php echo number_format((float)$mr, 2, ".", " "); ?>" style="width:175px" type="double" placeholder="En montant" onblur="calcul2();"></td>
                                                    <td style="width: 172px"><b><input style=" text-align: right; width: 168px" value="<?php echo number_format((float)$tr, 2, ".", " "); ?>" readonly name="montantremise" id="montantremise" type="double" value="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px">Montant honoraire (HT)</td>
                                                    <td style="width: 50px"></td>
                                                    <td style="width: 175px"></td>
                                                    <td style="width: 172px"><b><input style=" text-align: right; width: 168px" value="<?php echo number_format((float)$mar, 2, ".", " "); ?>" readonly id="totalavecremise" name="totalavecremise" type="double" value="" /></b></td>
                                                </tr>
                                            </table>
                                        </div>

                                    <ul style=" list-style-type: none">
                                    <br/><br/><br/><br/><br/><br/><br/><br/><br/>
                                    <legend><b>Echéance prévisionnelle de facturation</b></legend>
                                    <div style="max-height: 200px;overflow: scroll; max-width: 1500px">
                                        <table id="echeance">
                                        <tr>
                                            <td id="titla" style=" background-color: white; width: 80px"><center>Date échéance</center></td>
                                            <td id="titla" style=" background-color: white; width: 90px"><center>Honoraire Débours</center></td>
                                            <td id="titla" style=" background-color: white; width: 400px"><center>Intitulé</center></td>
                                            <td id="titla" style=" background-color: white; width: 55px"><center>% Contrat</center></td>
                                            <td id="titla" style=" background-color: white; width: 60px"><center>Devise</center></td>
                                            <td id="titla" style=" background-color: white; width: 130px"><center>Montant Prévisionnel</center></td>
                                            <td id="titla" style=" background-color: white; width: 15px"><center>F</center></td>
                                            <td id="titla" style=" background-color: white; width: 125px"><center>Montant Réel</center></td>                                            
                                            <td id="titla" style=" background-color: white; width: 135px"><center>Date Paiement</center></td>                                            
                                            <td id="titla" style=" background-color: white; width: 80px"><center>Num Fact</center></td> 
<!--                                    <input type="checkbox" style=" border-color: " />-->
                                        </tr>
                                        <?php
                                        $ligne = 20;
                                        $i = 1;
                                        $facttot = array();
                                        $totFac = 0;
                                        $numligne = 0;
										//MODIF RODDY => ajout facture fa 
										
										//--> left join facture fa on (fa.MissionCode = F.RefProjet
										// fa.MontantPaye, fa.DatePaiement, fa.FactNum
										/////////////////////////////////////////////////////////////
										
                                        $reqFacturation = 'select F.Echeance as EcheanceDate, F.Typefac as HonoraireDebours, 
                                            F.Libelle as Intitulé, F.Pcontrat as PContrat, F.Monnaie as Devise, 
                                            F.Montant as MontantPrevisionnel,F.Afacturer as fact, F.Idauto as ID, F.MontantReel as MR, F.DatePaiement as DP, F.Fac_num as FN
                                            from facturation F
                                            inner join projets P on (P.RefProjet = F.RefProjet)
                                            where F.RefProjet = "'.$codeMission.'"'
                                                . 'order by EcheanceDate';
										//FIN MODIF RODDY => facture fa
                                        $reqFact = mysqli_query($connect, $reqFacturation) or exit(mysqli_error($connect));;
                                        $colFact = mysqli_num_fields($reqFact); 
                                        $ligneFact = mysqli_num_rows($reqFact); 

                                        $lifa = 0;
                                        while($rowFac = mysqli_fetch_array($reqFact, MYSQLI_BOTH)){
                                            $lifa = $lifa + 1;
                                            $numligne = $numligne + 1;                                             
                                            echo "<tr id=\"".$numligne."\">";
                                                for($p=0; $p < $colFact ; $p++){
                                                    switch ($p){
                                                        case 0:
                                                            echo '        <td style=" width: 80px"><input style=" width: 80px; text-align: center" class="datepicker" type="text"  name="echeanceDate[]" value="'.changeDate2($rowFac[$p]).'" /></td>';  
                                                            break;
                                                        case 1:
                                                            echo '       <td style=" width: 90px">                                            
                                                        <select class="trans" name="honodebours[]" id="honodebours_'.$lifa.'" style="width:90px; text-align: center" />';
                                                        
//                                                        <option selected>'.$rowFac[$p].'</option>';
                                                        $ListHonoDebours = 'select distinct Typefac from facturation order by Typefac ASC';
                                                        $resultListHonoDeb = mysqli_query($connect,$ListHonoDebours);
                                                        while($rowHonoDeb = mysqli_fetch_array($resultListHonoDeb, MYSQLI_BOTH)){
                                                            echo '<option value="'.$rowHonoDeb[0].'" >'.$rowHonoDeb[0].'</option>';
                                                        }
                                            echo '      </select>';
                                            ?>
                                                <script>
                                                    var hono = "<?php echo $rowFac[$p]; ?>"; 
                                                    var li  = "<?php echo $lifa; ?>"; 
                                                    document.getElementById("honodebours_"+li).selectedIndex = getIndex(hono, "honodebours_"+li);
                                                </script>
                                            <?php
                                            echo '       </td>';
                                                            break;
                                                        case 2:
                                                            echo '         <td style=" width: 400px"><input type="text" name="intitule[]" value="'.$rowFac[$p].'" style="width:400px" /></td>';
                                                            break;
                                                        case 3:
                                                            echo '        <td style=" width: 55px"><input style="width:55px; text-align: center" type="double" name="PContrat[]" value="'.$rowFac[$p].'" onclick="verifChampDynClear(this)"/></td>';
                                                            break;
                                                        case 4:
                                                            echo '        <td style=" width: 60px">
                                                        <select class="trans" name="devise[]"  id="devise_'.$lifa.'" style="width:60px" onchange="saisieDeviseFact(this);">
                                                        <option></option>
                                                        
                                                        <optgroup label="Choisir dans la liste déroulante">';
//                                                        $listDevise = 'select distinct Monnaie from facturation order by Monnaie ASC;';
                                                        $listDevise = 'select distinct CodeDevise from devise order by CodeDevise ASC;';
                                                                $resultDevise = mysqli_query($connect,$listDevise);
                                                                while($rowDevises = mysqli_fetch_array($resultDevise, MYSQLI_BOTH)){
                                                                    echo '<option value="'.$rowDevises[0].'" >'.$rowDevises[0].'</option>';
                                                                }
                                                    echo '      </optgroup>';
//                                                                <optgroup label="Nouvelle Devise">
//                                                                    <option>Ajouter</option>
//                                                                </optgroup>';
                                                    echo '      </select>';
                                                    ?>
                                                        <script>
                                                            var dev = "<?php echo $rowFac[$p]; ?>"; 
                                                            var li  = "<?php echo $lifa; ?>"; 
                                                            document.getElementById("devise_"+li).selectedIndex = getIndex(dev, "devise_"+li);
                                                        </script>
                                                    <?php
                                                    echo '</td>';
                                                            break;
                                                        case 5:                                                            
                                                            echo '        <td style=" width: 130px"><input type="double" style=" text-align: right; width: 130px" value="'.number_format((float)$rowFac[$p], 2, ".", " ").'" name="montantPrevisionnel[]" /></td>';                                                                                                                            
                                                            $facttot[] = $rowFac[$p];
                                                            break;                                                                                                                      
                                                        case 6:
                                                            echo "        <td style=' width: 15px'><center><input type='checkbox' style=' text-align: right; width: 15px' name='".$rowFac['ID']."' id='".$rowFac['ID']."' ";
                                                            
                                                            if($rowFac['fact'] == 1){
                                                                echo "checked disabled ";  
                                                            }
														
                                                            ?>
                                                            onclick="if(this.checked){
                                                                var ok;
                                                                var ref = '<?php echo $ref;?>';
                                                                $(this).parent().addClass('highlight'); 
                                                                var idnum = '<?php echo $numligne;?>';                                                                                                                                
                                                                $('#'+idnum).addClass('highlight'); 
                                                                ok = confirm('Vous êtes sur le point de facturer la mission. Voulez-vous continuer?');
                                                                    if(ok == true){
                                                                        this.checked = true;   
                                                                       $.post('mailfacturation.php', { id: this.id, manager: ref}); 
                                                                        $(this).attr('disabled','disabled'); 
                                                                        $(this).parent().removeClass('highlight');
                                                                        $('#'+idnum).removeClass('highlight'); 
                                                                    }
                                                                    else{
                                                                        this.checked = false;
                                                                        $(this).parent().removeClass('highlight');
                                                                        $('#'+idnum).removeClass('highlight'); 
                                                                    }
                                                                }"
                                                            <?php
															  //  $.post('mailfacturation.php', { id: this.id, manager: ref}, function (data){alert(data);}); 
                                                            echo " /></center></td>";                                                            
                                                            break;
                                                        case 7:   
                                                            if($rowFac['MR'] == ''){
                                                                echo '         <td style=" width: 100px"></td>';
                                                            }
                                                            else{
                                                               echo '         <td style=" width: 125px"><input type="double" style=" text-align: right; width: 125px" readonly="true" name="mtr[]" value="'.number_format((float)$rowFac['MR'], 2, ".", " ").'"  /></td>';
                                                            }                                                            
                                                            break;
                                                        case 8:
                                                            echo '         <td style=" width: 135px"><input type="text" style=" text-align: center; width: 135px" readonly="true" name="dp[]" value="'.$rowFac['DP'].'" style="width:190px" /></td>';
                                                            break;
                                                        case 9:
                                                            echo '         <td style=" width: 80px"><input type="text" style=" text-align: center; width: 80px" readonly="true" name="fn[]" value="'.$rowFac['FN'].'" style="width:190px" /></td>';
                                                            break;
															case 10:
																//echo 'mail_ref = '.$mail_ref;
																//echo 'id = '.$rowFac['ID'];
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
                                            
                                            
                                                    echo '        <td style=" width: 80px"><input style=" width: 80px; text-align: center" class="datepicker" type="text"  name="echeanceDate[]"   /></td>';
                                            
                                            

                                            echo '       <td style=" width: 90px">                                            
                                                        <select class="trans" name="honodebours[]" style="width:90px; text-align: center" />
                                                        <option></option>';
                                                        $ListHonoDebours = 'select distinct Typefac from facturation order by Typefac ASC';
                                                        $resultListHonoDeb = mysqli_query($connect,$ListHonoDebours);
                                                        while($rowHonoDeb = mysqli_fetch_array($resultListHonoDeb, MYSQLI_BOTH)){
                                                            echo '<option value="'.$rowHonoDeb[0].'" >'.$rowHonoDeb[0].'</option>';
                                                        }
                                            echo '      </select>
                                                    </td>
                                                    <td style=" width: 400px"><input type="text" name="intitule[]" style="width:400px" /></td>
                                                    <td style=" width: 55px"><input style="width:55px; text-align: center" type="double" name="PContrat[]" onclick="verifChampDynClear(this)"/></td>
                                                    <td style=" width: 60px">
                                                        <select class="trans" name="devise[]" style="width:60px" onchange="saisieDeviseFact(this);">
                                                        <option></option>
                                                        <optgroup label="Choisir dans la liste déroulante">';
//                                                        $listDevise = 'select distinct Monnaie from facturation order by Monnaie ASC;';
                                                        $listDevise = 'select distinct CodeDevise from devise order by CodeDevise ASC;';
                                                        $resultDevise = mysqli_query($connect,$listDevise);
                                                        while($rowDevises = mysqli_fetch_array($resultDevise, MYSQLI_BOTH)){
                                                            echo '<option value="'.$rowDevises[0].'" >'.$rowDevises[0].'</option>';
                                                        }
                                            echo '      </optgroup>';
//                                                        <optgroup label="Nouvelle Devise">
//                                                            <option>Ajouter</option>
//                                                        </optgroup>';
                                            echo '      </select>
                                                    </td>';
                                            echo '        <td style=" width: 130px"><input type="double" name="montantPrevisionnel[]" style=" text-align: right; width: 130px"/></td>';             
//                                            echo '        <td style=" background-color: white; width: 100px"></td>';
//                                            echo '        <td style=" background-color: white; width: 100px"></td>';
//                                            echo '        <td style=" background-color: white; width: 100px"></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </table>                                    
                                    </div>
                                    </ul>
                                       <div class="cout" >
                                            <table>                                            
                                                <tr><div class="pre"><b>TOTAL: </b><?php echo  number_format((float)$totFac, 2, ".", " ");?></div></tr>
                                            </table>
                                        </div>
                                        <br/><br/>
                                    </form>
                                <?php                                 
                            }                                                                                                
                            }
                            else if(isset($_POST['selectionner2'])){
                                if ($_POST['code_cli'] == ''){
                                    echo '<font color="red"><br/>Veuillez s&eacute;lectionner le Client.</font>';																
                                }
                                else{
                                    $client = $_POST['code_cli']; 
//                                    echo 'nom client '.$client;
                                    
                                    $reqCount = 'select count(1) as count from projets
                                    inner join client on (client.RefClient = projets.RefClient)
                                    where client.NomSociete = "'.$client.'";';
                                    $reqCounts = mysqli_query($connect,$reqCount);											
                                    $resultCount = mysqli_fetch_assoc($reqCounts);
                                    $count = $resultCount['count'];
                                    
                                    if($count>=2){                                        
                                        
                                        if($prof == 'DAF'){
                                            $reqProj = 'select C.NomSociete, P.RefProjet, P.NomProjet from projets P
                                                inner join client C on (C.RefClient = P.RefClient)
                                                where C.NomSociete = "'.$client.'";';
                                        }
                                        else{
                                            $reqProj = 'select C.NomSociete, P.RefProjet, P.NomProjet from projets P
                                                inner join client C on (C.RefClient = P.RefClient)
                                                where P.TypeProjet not in ("EXTRA") and C.NomSociete = "'.$client.'";';
                                        }
                                        
                                        
                                        
//                                        $reqProj = 'select C.NomSociete, P.RefProjet, P.NomProjet from projets P
//                                                inner join client C on (C.RefClient = P.RefClient)
//                                                where C.NomSociete = "'.$client.'";';
                                        $reqP = mysqli_query($connect, $reqProj);                                            						
                                        $colonne = mysqli_num_fields($reqP); //col
                                    ?>

                                    <br /><br /><br />
                                    <div>
                                        <center>
                                            <table border="1" style="font:0.9em trebuchet ms; border-collapse: collapse;width: 1200px;">
                                                <thead>
                                                    <tr style="text-align: left;">
                                                        <th class="client" style="text-align: center"><b>Client</b></th>
                                                        <th class="codeprojet" style="text-align: center">Code Projet</th>
                                                        <th  class="nomprojet" style="text-align: center">Nom Projet</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div style="width: 1200px; height:350px; overflow:auto;">
                                            <table border="1" style="font:0.9em trebuchet ms; border-collapse: collapse;width: 1200px;">
                                                <tbody>
                                                    <?php
                                                        while($row = mysqli_fetch_array($reqP, MYSQLI_BOTH)){
                                                            echo '<tr>';
                                                                for($j=0; $j < $colonne ; $j++){
                                                                    switch($j){
                                                                        case 0: echo '<td class="client">'.$row[$j].'</td>';
                                                                            break; 
                                                                        case 1: echo '<td class="codeprojet"><a href="./missionClientCli.php?test='.str_replace('+', '%2B', $row[$j]).'">'.$row[$j].'</a></td>';
                                                                            break;                                                            
                                                                        case 2: echo '<td class="nomprojet">'.$row[$j].'</td>';
                                                                            break;
                                                                    }
                                                                }
                                                            echo '</tr>';
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </center> 
                                    </div>
                                    <div id="content">                                    
                                    </div>

                                    <?php 
                                    }
                                    else{
                                        if($prof == 'DAF'){
                                            $reqCodMiss = 'select projets.RefProjet as RF from projets
                                            inner join client on (client.RefClient = projets.RefClient)
                                            where client.NomSociete = "'.$client.'"';
                                        }
                                        else{
                                            $reqCodMiss = 'select projets.RefProjet as RF from projets
                                            inner join client on (client.RefClient = projets.RefClient)
                                            where projets.TypeProjet not in ("EXTRA") and client.NomSociete = "'.$client.'"';
                                        }
                                        
                                                                                
//                                        $reqCodMiss = 'select projets.RefProjet as RF from projets
//                                        inner join client on (client.RefClient = projets.RefClient)
//                                        where client.NomSociete = "'.$client.'"';

                                        $reqCodMi = mysqli_query($connect,$reqCodMiss);
                                        $resultCodMi = mysqli_fetch_assoc($reqCodMi);
                                        $codeMission = $resultCodMi['RF'];
                                        
                                    $reqRefEmploye = 'select RefEmploye as EMPLO, Coddept from employes where Nomuser = "'.$Nomuser.'"';                                                                          
                                    $rekRefEmp     = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                                    $resultRefEmp  = mysqli_fetch_assoc($rekRefEmp);
                                    $refEmploye    = $resultRefEmp['EMPLO'];
                                    $coddepa       = $resultRefEmp['Coddept'];                                    
                                    
//                                    echo 'refemploye '.$refEmploye;
                                                                                                                                              
                                    $reqDept = 'select count(1) as kounty from deptprojet
                                    where RefProjet = "'.$codeMission.'"
                                    and Coddept = "'.$coddepa.'";';                                    
                                    $rekDep     = mysqli_query($connect,$reqDept) or exit(mysqli_error($connect));
                                    $resultDep  = mysqli_fetch_assoc($rekDep);
                                    $kounty     = $resultDep['kounty'];   
                                    
                                    $reqDeptMan = 'select count(1) as kounty from deptprojet
                                    where RefProjet = "'.$codeMission.'"
                                    and Respvalid = "'.$refEmploye.'";';
                                    $rekDepMan     = mysqli_query($connect,$reqDeptMan) or exit(mysqli_error($connect));
                                    $resultDepMan  = mysqli_fetch_assoc($rekDepMan);
                                    $kountyMan        = $resultDepMan['kounty']; 
                                    
//                                    echo '$kountyman '.$kountyMan;                                    
//                                    echo 'kounty ' .$kounty;                                    
                                    
                                    $reqMission = 'SELECT NomProjet AS mission FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqMi = mysqli_query($connect,$reqMission);
                                    $resultMi = mysqli_fetch_assoc($reqMi);
                                    $mission = $resultMi['mission'];

                                    $reqCli = 'SELECT C.NomSociete as cli from client C inner join projets P on (P.RefClient = C.RefClient) WHERE RefProjet = "'.$codeMission.'";';
                                    $reqCl = mysqli_query($connect,$reqCli);
                                    $resultCli = mysqli_fetch_assoc($reqCl);
                                    $cli = $resultCli['cli'];    

									//MODIF RODDY 
									$reqgrCli = 'SELECT GroupeCli AS groupcli FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqqgrCl = mysqli_query($connect,$reqgrCli);
                                    $resultgrCli = mysqli_fetch_assoc($reqqgrCl);
                                    $groupeCli = $resultgrCli['groupcli']; 	
									
									$reqliencom = 'SELECT LienCom  FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqqliencom = mysqli_query($connect,$reqliencom);
                                    $resultliencom= mysqli_fetch_assoc($reqqliencom);
                                    $Liencomm= $resultliencom['LienCom']; 	
									
									$reqliencontrat = 'SELECT LienContrat  FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqqliencontrat = mysqli_query($connect,$reqliencontrat);
                                    $resultliencontrat= mysqli_fetch_assoc($reqqliencontrat);
                                    $Liencontratt= $resultliencontrat['LienCom']; 
									
									$reqlangue= 'SELECT Langue  FROM projets WHERE RefProjet = "'.$codeMission.'";';
                                    $reqqlienlangue = mysqli_query($connect,$reqlangue);
                                    $resultlienlangue= mysqli_fetch_assoc($reqqlienlangue);
                                    $languee= $resultlienlangue['Langue']; 
									
									//FIN MODIF RODDY 									

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
                                        <!-- <span id="spann" style="float: right; padding: 8px;"><input type="submit" disabled="disabled" name="modifier" id="modifier" value="Modifier" onmouseover="this.disabled='';"/></span> -->
                                        <span id="spann" style="float: right; padding: 8px;"><input type="submit" name="modifier" id="modifier" value="Modifier"/></span>
                                        <!--<input type="submit" name="modifier" id="modifier" value="Modifier" />-->
                                        <br/>
                                            
                                        <input type="checkbox" id="cloturer" name="cloturer" 
                                               <?php
                                                if($cloture == 1) {
                                                    echo 'checked disabled';                                           
                                                }                                            
                                               ?>
                                               onclick="if(this.checked){alert('Attention !!! Vous êtes sur le point de clôturer la mission.');}    "/>                                    
                                        <span id="cochetext"> <b><font color="">Clôturer la mission</font></b> </span><br/><br/>                                    
                                    <table>
                                        <tr>                                
                                            <td>   
                                                <ul style=" list-style-type: none">
                                                    <!--<fieldset style="border-color: #F0F5FF">-->
                                                    <Fieldset><legend><b>Infos Client</b></legend>                                        
                                                    <table>  
                                                        <tr>
                                                            <td><label>Code Mission</label></td>
                                                            <td><input  type="text" name="cdeMission" style="width:173px" id="cdeMission" value="<?php echo $codeMission; ?>" readonly /></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Mission</label></td>
                                                            <td><textarea type="text" name="mission" style="width:173px" id="mission" onblur="verifChampNul(this)"><?php echo $mission; ?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Nom du Client</label></td>
                                                            <td>
                                                                <textarea type="text" name="client" id="client" readonly style="width:173px" ><?php echo $cli; ?></textarea>                                                                                                                    
                                                            </td>
                                                        </tr>
														<!-- MODIF RODDY AJOUT GROUPE CLIENT-->
														<tr>
														<td><label>Groupe Client </label></td>
														<td><textarea type="text" name="grclient" id="grclient" style="width:173px" onblur="verifChampNul(this)"><?php echo $groupeCli; ?></textarea></td>
														</tr>
														<!--MODIF RODDY GROUPE MISSION -->
                                                        <tr>
                                                            <td><label>Cat&eacute;gorie</label></td>
                                                            <td>
                                                                <select name="categorie" id="categorie" style="width:179px" onblur="verifChampNul(this)">                                                                    
                                                                        <?php
                                                                            if($prof == 'DAF'){
                                                                                $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null and TypeProjet in ("EXTRA") order by TypeProjet ASC;');
                                                                            }
                                                                            else{
                                                                                $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null and TypeProjet not in ("DISPO", "QUALITE", "EXTRA") order by TypeProjet ASC;');
                                                                            }
                                                                        
//                                                                            $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null and TypeProjet not in ("DISPO", "QUALITE") order by TypeProjet ASC;');
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
                                                                <select name="origine" id="origine" style="width:179px" onblur="verifChampNul(this)" onchange="saisieOrigine(this);">   
                                                                    <optgroup label="Choisir dans la liste déroulante">;
                                                                    <?php
                                                                        $reqListOrigine = mysqli_query($connect,'select distinct Origine from projets where Origine is not null order by Origine ASC;');
                                                                        while($rowOrg = mysqli_fetch_array($reqListOrigine, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowOrg[0].'" >'.$rowOrg[0].'</option>';
                                                                        }
                                                                    ?>
                                                                    </optgroup>
                                                                    <optgroup label="Nouvelle Origine">
                                                                        <option>Ajouter</option>
                                                                    </optgroup>
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
                                                                <textarea type="text" name="typeClient" id="typeClient" readonly style="width:173px" ><?php echo $cliType; ?></textarea>                                                    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labstat" for="stat" style="display: none"> STAT</label></td>
                                                            <td><textarea type="text" name="stat" id="stat" readonly style="display: none;width:173px" placeholder="11111 11 1111 11111"><?php echo $stat;?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labnif" for="nif" style="display: none"> N.I.F </label></td>
                                                            <td><textarea type="text" name="nif" id="nif" readonly style="display: none;width:173px" placeholder="1111111111"><?php echo $nif;?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labcif" for="cif" style="display: none"> C.I.F </label></td>
                                                            <td><textarea type="text" name="cif" id="cif" readonly style="display: none;width:173px" placeholder="1111111/DGI-B du jj/mm/aaaa"><?php echo $cif;?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labrcs" for="rcs" style="display: none"> R.C.S </label></td>
                                                            <td><textarea type="text" name="rcs" id="rcs" readonly style="display: none;width:173px" placeholder="1111 B 11111"><?php echo $rcs;?></textarea></td>
                                                        </tr>
                                                    </table> 
													</Fieldset>													
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
                                                    <fieldset><legend><b>Infos Contrat</b></legend>
                                                    <table>                                        
                                                        <tr>
                                                            <td>
                                                                <table>
                                                                    <tr>
                                                                        <td><label>Chef de mission FTHM.</label></td>
                                                                        <td><textarea type="text" name="chef" style="width:173px" id="chef" onblur="verifChampNul(this)"><?php echo($resultInfoC -> Chefmission) ?></textarea></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date signature contrat</label></td>                                                                        
                                                                        <td><input readonly type="text" name="signContrat"  style="width:174px" id="signContrat" value="<?php if( $resultInfoC -> Datesignature == "" || $resultInfoC -> Datesignature == "0000-00-00"){echo '';}  else {echo (changeDate2($resultInfoC -> Datesignature));}?>"/></td>                                                                                
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date d'archivage</label></label></td>                                                                        
                                                                        <td><input readonly type="text" name="dteArchiv"  style="width:174px" id="dteArchiv" value="<?php if($resultInfoC -> Datearchctr == "" || $resultInfoC -> Datearchctr == "0000-00-00"){ echo '';} else {echo (changeDate2($resultInfoC -> Datearchctr));}?>"/></td>                                                                                
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date de d&eacute;but pr&eacute;vu</label></td>                                                                        
                                                                        <td><input readonly type="text" name="dtePrevu"  style="width:174px" id="dtePrevu" value="<?php if($resultInfoC -> DateDebutProjet == "" || $resultInfoC -> DateDebutProjet == "0000-00-00"){echo '';} else{ echo (changeDate2($resultInfoC -> DateDebutProjet));}?>" onblur="verifChampNul(this)"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date de fin pr&eacute;vue</label></td>                                                                        
                                                                        <td><input readonly type="text" name="dteFin"  id="dteFin" style="width:174px" value="<?php if($resultInfoC -> DateFinProjet == "" || $resultInfoC -> DateFinProjet == "0000-00-00"){echo '';} else{ echo (changeDate2($resultInfoC -> DateFinProjet));}?>" onblur="verifChampNul(this)"/> </td>
                                                                    </tr> 
																		<!-- MODIF RODDY AJOUT lien com et lien contrat -->
																	<td><label>Lien vers Proposition Commerciale </label></td>                                                            
																		<td><input type="text" name="Liencom" style="width:300px" id="Liencom" value="<?php echo $Liencomm; ?>" /></td> 
																	</tr>
																	<tr>
																		<td><label>Lien vers Contrat </label></td>                                                            
																		<td><input type="text" name="Liencontrat" style="width:300px" id="Liencontrat" value = "<?php echo $Liencontratt; ?>"  /></td> 
																	</tr>
																	<!-- FIN MODIF RODDY AJOUT lien com et lien contrat -->
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <ul style=" list-style-type: none">
                                                                <table>
                                                                    <tr>
                                                                        <td><label>Date d&eacute;but r&eacute;elle</label></td>                                                                        
                                                                        <td><input readonly type="text" name="dbuReel"  id="dbuReel" value="<?php if($resultInfoC -> DateDebutR == "" || $resultInfoC -> DateDebutR == "0000-00-00"){echo '';} else{  echo (changeDate2($resultInfoC -> DateDebutR));}?>" style="width:174px"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label>Date fin r&eacute;elle</label></td>                                                                        
                                                                        <td><input readonly type="text" name="finReel"  id="finReel" value="<?php if($resultInfoC -> DateFinR == "" || $resultInfoC -> DateFinR == "0000-00-00"){echo '';} else{ echo (changeDate2($resultInfoC -> DateFinR));}?>" style="width:174px"/></td>
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
                                                                        <td><input readonly type="text" name="dteAvenant" id="dteAvenant"  value="<?php if($resultInfoC -> Datesignaven == "" || $resultInfoC -> Datesignaven == "0000-00-00"){echo '';} else{ echo (changeDate2($resultInfoC -> Datesignaven));} ?>"  style="display: none; width: 174px" /></td>                                                                                                                                                  
                                                                    </tr>
                                                                </table>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </table> 
													</fieldset>
                                                    <?php
                                                    }
                                                    ?>
                                                <!--</fieldset>-->
                                                </ul>
                                            </td>                               
                                        </tr>                                
                                    </table>  
									 <Fieldset><legend><b>Infos Facturation</b></legend>
                                    <table>
                                        <tr>                                
                                            <td>   
                                                <ul style=" list-style-type: none">
                                                    <!--<fieldset style="border-color: #F0F5FF">-->
                                                    <br><br>

                                                 <!--   <legend><b>Infos Facturation</b></legend>-->
                                                    <table>
                                                        <tr>
                                                            <td><label>Soci&eacute;t&eacute; Fact</label></td>
                                                            <td>
                                                                <select name="refSoc" id="refSoc" style="width:179px" onblur="verifChampNul(this)">                                                                                                                                                        
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
                                                            <td><textarea type="text" name="interFac" style="width:173px" id="interFac" onblur="verifChampNul(this)"><?php echo($resultInfoC -> Interlocfacture) ?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Adresse Fact</label></td>
                                                            <td><textarea type="text" name="adresseFact" id="adresseFact" style="width:173px" onblur="verifChampNul(this)"><?php echo($resultInfoC -> Adressefacture) ?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Coordonn&eacute;es</label></td>
                                                            <td><textarea type="text" name="Coord" id="Coord" style="width:173px" onblur="verifChampNul(this)"><?php echo($resultInfoC -> Coordoninterloc) ?></textarea></td>
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
                                                            <select name="devizy" id="devizy" style="width:179px" onblur="verifChampNul(this)" onchange="saisieDevise(this);">   
                                                                <optgroup label="Choisir dans la liste déroulante">;
                                                                    <?php
                                                                        $monnaie = $resultInfoC -> Monnaie;
//                                                                        $reqDeviseList = mysqli_query($connect,'select distinct Monnaie from projets where Monnaie is not null order by Monnaie ASC;');
                                                                        $reqDeviseList = mysqli_query($connect,'select distinct CodeDevise from devise order by CodeDevise ASC;');
                                                                        while($rowDevise = mysqli_fetch_array($reqDeviseList, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowDevise[0].'" >'.$rowDevise[0].'</option>';
                                                                        }
                                                                    ?>
                                                                </optgroup>
<!--                                                                <optgroup label="Nouvelle Devise">
                                                                    <option>Ajouter</option>
                                                                </optgroup>-->
                                                            </select>
                                                            <script>
                                                                monnaie = "<?php echo $monnaie; ?>";                                                               
                                                                document.getElementById("devizy").selectedIndex = getIndex(monnaie, "devizy");
                                                            </script>
                                                        </td>
                                                    </tr>
													<!--MODIF RODDY AJOUT langue-->
												 <tr>
														<td><label>Langue  </label></td>
													   <!--<td><input  type="text" name="langue" id="langue" style="width:164px" onblur="verifChampNul(this)"/> </td> -->
													   <td>
													   <select name="langue" id="langue" style="width:179px" onblur="verifChampNul(this);" >   
															<option ></option>
															<option >Française</option>
															<option >Malagasy</option>
															<option >Américaine</option>
															<option >Africaine</option>
															<option >Comorienne</option>
														</select>  
														  <script>
                                                                langueee = "<?php echo $languee; ?>";                                                               
                                                                document.getElementById("langue").selectedIndex = getIndex(langueee, "langue");
                                                           </script>
														</td>
													</tr>
													<!--FIN MODIF RODDY AJOUT langue-->
                                                    <tr>
                                                        <td><label>Type Honoraire </label></td>
                                                        <td>
                                                            <select name="typehono" id="typehono" style="width:179px" onblur="verifChampNul(this)" onchange="saisieTypeHono(this);">
                                                                <optgroup label="Choisir dans la liste déroulante">;
                                                                    <?php
                                                                        $refhonotype = $resultInfoC -> Reftypehono;
                                                                        $reqListTypeHonoraire = mysqli_query($connect,'select distinct Reftypehono from projets where Reftypehono is not null order by Reftypehono ASC;');
                                                                        while($rowTypeHono = mysqli_fetch_array($reqListTypeHonoraire, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowTypeHono[0].'" >'.$rowTypeHono[0].'</option>';
                                                                        }
                                                                    ?>                                            
                                                                </optgroup>
                                                                <optgroup label="Nouvelle Type Honoraire">
                                                                    <option>Ajouter</option>
                                                                </optgroup>
                                                            </select>                                                            
                                                            <script>
                                                                refhonotype = "<?php echo $refhonotype; ?>";                                                                
                                                                document.getElementById("typehono").selectedIndex = getIndex(refhonotype, "typehono");
                                                            </script>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Montant honoraire (HT)</label></td>
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
                                                            <select name="mod_fac" id="mod_fac" style="width:179px" onblur="verifChampNul(this)" onchange="saisieModeFact(this);">
                                                                <optgroup label="Choisir dans la liste déroulante">;
                                                                    <?php
                                                                        $honomode = $resultInfoC -> Modefachono;
                                                                        $reqModFacturation = mysqli_query($connect,'select distinct Modefachono from projets where Modefachono is not null order by Modefachono ASC;');
                                                                        while($rowModFac = mysqli_fetch_array($reqModFacturation, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowModFac[0].'" >'.$rowModFac[0].'</option>';
                                                                        }
                                                                    ?> 
                                                                </optgroup>
                                                                <optgroup label="Nouvelle Mode de Facturation">
                                                                    <option>Ajouter</option>
                                                                </optgroup>
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
                                                        <td><textarea type="text" name="modFact" id="modFact" style="width:173px" style="display: none"><?php echo($resultInfoC -> Modefacdebour) ?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label id="labMontantDeb" for="montantDeb" style="display: none">Montant d&eacute;bours </label></td>
                                                        <td><input type="double" name="montantDeb" id="montantDeb" style="width:173px" value="<?php echo(number_format($resultInfoC -> EstimationCoutDebours,2, ".", " ")) ?>"  style="display: none"/></td>
                                                    </tr>
                                                </table>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>
									</Fieldset>
                                    <table>
                                        <tr>
                                            <td>
                                                <ul style=" list-style-type: none">
                                                    <br><br>
                                                    <legend><b>Affectation Département</b></legend>
                                                    <div style="max-height: 200px;overflow: scroll; top: 50px">
                                                    <table id="echeance">                                                                                        
                                                        <tr>
                                                            <td id="titla" style=" background-color: white">Département</td> 
                                                            <td id="titla"style=" background-color: white">Manager</td> 
                                                            <td id="titla" style=" background-color: white">Associé</td>
                                                        </tr>
                                                        <?php
                                                        $qdep   = 'select count(1) as nbdep from departement;';
                                                        $resdep = mysqli_query($connect,$qdep);
                                                        $fecdep = mysqli_fetch_assoc($resdep);
                                                        $nbdep  = $fecdep['nbdep'];
                                                        $j = 1;
                                                        $reqAffecMission = 'select D.Departement as Département, DP.Respvalid as Manager, DP.Dirmission as Associe 
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
                                                            $li = 0;
                                                            while($row = mysqli_fetch_array($reqMissionAffect, MYSQLI_BOTH)){                                                           
                                                                $li = $li +1;
                                                                echo '<tr>';
                                                                for($m=0; $m < $colonne ; $m++){
                                                                    switch ($m){
                                                                        case 0:
                                                                            echo '<td>';
                                                                                echo '<select class="trans" name="deptList[]" id="deptList_'.$li.'" style="width:125px" >';
                                                                                echo '<option></option>';
//                                                                                echo '<option selected>'.$row[$m].'</option>';
                                                                                    $reqDepList = 'select Departement from departement order by Departement ASC;';
                                                                                    $resultDepList = mysqli_query($connect,$reqDepList);
                                                                                    while($rowDepList = mysqli_fetch_array($resultDepList, MYSQLI_BOTH)){
                                                                                        echo '<option value="'.$rowDepList[0].'" >'.$rowDepList[0].'</option>';
                                                                                    }
                                                                                echo '</select>'; 
                                                                                ?>
                                                                                <script>
                                                                                    var cde = "<?php echo $row[$m]; ?>"; 
                                                                                    var li  = "<?php echo $li; ?>"; 
                                                                                    document.getElementById("deptList_"+li).selectedIndex = getIndex(cde, "deptList_"+li);
                                                                                </script>
                                                                                <?php
                                                                                
                                                                            echo '</td>';
                                                                            break;
                                                                        case 1:
                                                                            echo '<td>';
                                                                                echo '<select class="trans" name="managerList[]" id="managerList_'.$li.'" style="width:125px">';
                                                                                    echo '<option></option>';                                                                                    
                                                                                                                                                                        
                                                                                $verifMan       = 'select actif as actMan, concat(Prenom, " ", NomFamille) as prenMan from employes where RefEmploye = "'.$row[$m].'"';
                                                                                $reqVerifMan    = mysqli_query($connect,$verifMan);
                                                                                $resultVerifMan = mysqli_fetch_assoc($reqVerifMan);
                                                                                $manIff         = $resultVerifMan['actMan'];
                                                                                $prenMan        = $resultVerifMan['prenMan'];           
                                                                                    
                                                                                if($manIff == 1){
                                                                                    echo '<option selected>'.$prenMan.'</option>';
                                                                                    $reqManagerList = "select RefEmploye, Prenom, NomFamille 
                                                                                                    from employes 
                                                                                                    where (Profil = 'Manager' or Profil like '%Associé%') 
                                                                                                    and actif =0 
                                                                                                    and RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ') order by Prenom ASC;";
                                                                                    $resultManagerList = mysqli_query($connect,$reqManagerList);
                                                                                    while($rowManagerList = mysqli_fetch_array($resultManagerList, MYSQLI_BOTH)){
                                                                                        echo '<option value="'.$rowManagerList[0].'" >'.$rowManagerList[1].' '.$rowManagerList[2].'</option>';
                                                                                    }
                                                                                    echo '</select>';                                                                                    
                                                                                }
                                                                                else{
                                                                                    $reqManagerList = "select RefEmploye, Prenom, NomFamille 
                                                                                                    from employes 
                                                                                                    where (Profil = 'Manager' or Profil like '%Associé%') 
                                                                                                    and actif =0 
                                                                                                    and RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ') order by Prenom ASC;";
                                                                                    $resultManagerList = mysqli_query($connect,$reqManagerList);
                                                                                    while($rowManagerList = mysqli_fetch_array($resultManagerList, MYSQLI_BOTH)){
                                                                                        echo '<option value="'.$rowManagerList[0].'" >'.$rowManagerList[1].' '.$rowManagerList[2].'</option>';
                                                                                    }
                                                                                    echo '</select>';
                                                                                    ?>
                                                                                    <script>
                                                                                        var mang = "<?php echo $row[$m]; ?>"; 
                                                                                        var li  = "<?php echo $li; ?>"; 
                                                                                        document.getElementById("managerList_"+li).selectedIndex = getIndex(mang, "managerList_"+li);
                                                                                    </script>
                                                                                    <?php
                                                                                }                                                                                                                                                                        
                                                                            echo '</td>';
                                                                            break;
                                                                        case 2:
                                                                            echo '<td>';
                                                                                echo '<select class="trans" name="assocList[]" id="assocList_'.$li.'" style="width:125px">';
                                                                                    echo '<option></option>';
                                                                                    
                                                                                    $verifAss       = 'select actif as actAss, concat(Prenom, " ", NomFamille) as prenAss from employes where RefEmploye = "'.$row[$m].'"';
                                                                                    $reqVerifAss    = mysqli_query($connect,$verifAss);
                                                                                    $resultVerifAss = mysqli_fetch_assoc($reqVerifAss);
                                                                                    $assIff         = $resultVerifAss['actAss'];
                                                                                    $prenAss        = $resultVerifAss['prenAss'];
            //                                                                        echo 'actif: '.$actIff;
                                                                                    
                                                                                    if($assIff == 1){
                                                                                        echo '<option selected>'.$prenAss.'</option>';
                                                                                        $reqAssocList = "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre "
                                                                                            . "from employes "
                                                                                            . "where Profil = 'Associé' "
                                                                                            . "and actif =0 "
                                                                                            . "order by Prenom ASC" ;
                                                                                            $resultAssocList = mysqli_query($connect,$reqAssocList);
                                                                                            while($rowAssocList = mysqli_fetch_array($resultAssocList, MYSQLI_BOTH)){
                                                                                                echo '<option value="'.$rowAssocList[0].'" >'.$rowAssocList[1].'</option>';
                                                                                            }
                                                                                        echo '</select>';                                                                                        
                                                                                    }
                                                                                    else{
                                                                                        $reqAssocList = "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre "
                                                                                            . "from employes "
                                                                                            . "where Profil = 'Associé' "
                                                                                            . "and actif =0 "
                                                                                            . "order by Prenom ASC" ;
                                                                                            $resultAssocList = mysqli_query($connect,$reqAssocList);
                                                                                            while($rowAssocList = mysqli_fetch_array($resultAssocList, MYSQLI_BOTH)){
                                                                                                echo '<option value="'.$rowAssocList[0].'" >'.$rowAssocList[1].'</option>';
                                                                                            }
                                                                                        echo '</select>';
                                                                                        ?>
                                                                                        <script>
                                                                                            var assli = "<?php echo $row[$m]; ?>"; 
                                                                                            var li  = "<?php echo $li; ?>"; 
                                                                                            document.getElementById("assocList_"+li).selectedIndex = getIndex(assli, "assocList_"+li);
                                                                                        </script>
                                                                                        <?php
                                                                                    }
                                                                                    
                                                                                    
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
                                                                        $reqManagerList = "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre
                                                                                from employes 
                                                                                where (Profil = 'Manager' or Profil like '%Associé%') 
                                                                                and actif =0 
                                                                                and RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ') order by Prenom ASC;";
                                                                        $resultManagerList = mysqli_query($connect,$reqManagerList);
                                                                        while($rowManagerList = mysqli_fetch_array($resultManagerList, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowManagerList[0].'" >'.$rowManagerList[1].'</option>';
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
                                                                        $reqAssocList = "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre "
                                                                            . "from employes "
                                                                            . "where Profil = 'Associé' "
                                                                            . "and actif =0 "
                                                                            . "order by Prenom ASC" ;
                                                                        $resultAssocList = mysqli_query($connect,$reqAssocList);
                                                                        while($rowAssocList = mysqli_fetch_array($resultAssocList, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowAssocList[0].'" >'.$rowAssocList[1].'</option>';
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
                                                            <td id="titla" style=" background-color: white"><center>Consultant</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Profil</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Nombre JH</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Tarif JH</center></td> 
                                                            <td id="titla" style=" background-color: white"><center>Montant</center></td> 
                                                        </tr>
                                                        <?php
                                                        $montant = array();
                                                        $total = 0;
                                                        $reqInterv = 'select E.RefEmploye as Consultant, PR.Protarif as Profil, J.NombreJH as NombreJH, 
                                                            J.TarifJH as TarifJH, J.NombreJH*J.TarifJH as Montant  
                                                            from jhprevu J
                                                        inner join employes E on (E.RefEmploye = J.RefEmploye)
                                                        inner join protarif PR on (PR.Protarif = J.Protarif)
                                                        inner join projets P on (P.RefProjet = J.RefProjet)
                                                        where P.RefProjet = "'.$codeMission.'" ';
//                                                                . 'order by E.prenom';
                                                        $reqIntervenant = mysqli_query($connect, $reqInterv);
                                                        $colonneInterv = mysqli_num_fields($reqIntervenant); //col
                                                        $ligneInterv = mysqli_num_rows($reqIntervenant); //rows
                                                        
                                                        $lili = 0;
                                                        while($rowInterv = mysqli_fetch_array($reqIntervenant, MYSQLI_BOTH)){
                                                            $lili = $lili +1;
                                                            echo '<tr>';
                                                            for($n=0;$n<$colonneInterv;$n++){
                                                                switch ($n){
                                                                    case 0: echo '<td>'
                                                                        . '<select class="trans" name="nameCons[]" id="nameCons_'.$lili.'" style="width:250px">'
                                                                        . '<option></option>';
//                                                                        . '<option selected>'.$rowInterv[$n].'</option>';                                                                        
                                                                        
                                                                        $verifcons       = 'select actif as act, concat(Prenom, " ", NomFamille) as pren from employes where RefEmploye = "'.$rowInterv[$n].'"';
                                                                        $reqVerifCons    = mysqli_query($connect,$verifcons);
                                                                        $resultVerifCons = mysqli_fetch_assoc($reqVerifCons);
                                                                        $actIff          = $resultVerifCons['act'];
                                                                        $pren          = $resultVerifCons['pren'];
//                                                                        echo 'actif: '.$actIff;
                                                                        
                                                                        if($actIff == 1){
                                                                            echo '<option selected>'.$pren.'</option>'; 
                                                                            $reqnameConsList = 'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre '
                                                                                . 'FROM employes where '
                                                                                . 'actif = 0 and '
                                                                                . 'RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") '
                                                                                . 'ORDER BY Prenom ASC;';
                                                                            $resultNameConsList = mysqli_query($connect,$reqnameConsList);
                                                                            while($rowNameConsList = mysqli_fetch_array($resultNameConsList, MYSQLI_BOTH)){
                                                                                echo '<option value="'.$rowNameConsList[0].'" >'.$rowNameConsList[1].'</option>';
                                                                            }
                                                                                echo '</option>'
                                                                                    . '</select>';                                                                                
                                                                                echo '</td>';
                                                                            break;
                                                                        }
                                                                        else{
//                                                                            echo '<option selected>'.$rowInterv[$n].'</option>'; 
                                                                            $reqnameConsList = 'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre '
                                                                                . 'FROM employes where '
                                                                                . 'actif = 0 and '
                                                                                . 'RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") '
                                                                                . 'ORDER BY Prenom ASC;';
                                                                            $resultNameConsList = mysqli_query($connect,$reqnameConsList);
                                                                            while($rowNameConsList = mysqli_fetch_array($resultNameConsList, MYSQLI_BOTH)){
                                                                                echo '<option value="'.$rowNameConsList[0].'" >'.$rowNameConsList[1].'</option>';
                                                                            }
                                                                                echo '</option>'
                                                                                    . '</select>';
                                                                                ?>
                                                                                    <script>
                                                                                        var cons = "<?php echo $rowInterv[$n]; ?>"; 
                                                                                        var li  = "<?php echo $lili; ?>"; 
                                                                                        document.getElementById("nameCons_"+li).selectedIndex = getIndex(cons, "nameCons_"+li);
                                                                                    </script>
                                                                                <?php
                                                                                echo '</td>';
                                                                            break;
                                                                        }
                                                                        
                                                                    case 1: echo '<td>'
                                                                                . '<select class="trans" name="prof[]" id="prof_'.$lili.'" style="width:125px">  '
                                                                                . '<option></option>';
//                                                                                . '<option selected>'.$rowInterv[$n].'</option>';
                                                                                $reqProfily = 'select Protarif from protarif order by Protarif ASC';
                                                                                    $resultProfily = mysqli_query($connect,$reqProfily);
                                                                                while($rowProf = mysqli_fetch_array($resultProfily, MYSQLI_BOTH)){
                                                                                    echo '<option value="'.$rowProf[0].'" >'.$rowProf[0].'</option>';
                                                                                }
                                                                            echo ''
                                                                                . '</select>';
                                                                            ?>
                                                                                <script>
                                                                                    var pro = "<?php echo $rowInterv[$n]; ?>"; 
                                                                                    var li  = "<?php echo $lili; ?>"; 
                                                                                    document.getElementById("prof_"+li).selectedIndex = getIndex(pro, "prof_"+li);
                                                                                </script>
                                                                            <?php
                                                                            echo '</td>';
                                                                            break;    
                                                                    case 2: echo '<td><input type="double" name="nbJH[]" value="'.$rowInterv[$n].'" style="width:100px" onclick="verifChampDynClear(this)"/></td>';
                                                                                break;
                                                                    case 3: echo '<td><input type="double" style=" text-align: right" name="tarifJH[]" value="'.number_format((float)$rowInterv[$n], 2, ".", " ").'" style="width:115px"  onclick="verifChampDynClear(this)"/></td>';
                                                                                break;
                                                                    case 4: echo '<td><input type="double" style=" text-align: right" name="montant[]" value="'.number_format((float)$rowInterv[$n], 2, ".", " ").'"  style="width:115px" readonly/></td>';
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
                                                                        $reqnameConsList = 'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre '
                                                                            . 'FROM employes where actif = 0 '
                                                                            . 'and RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") '
                                                                            . 'ORDER BY Prenom ASC;';
                                                                        $resultNameConsList = mysqli_query($connect,$reqnameConsList);
                                                                        while($rowNameConsList = mysqli_fetch_array($resultNameConsList, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowNameConsList[0].'" >'.$rowNameConsList[1].'</option>';
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
                                                            </tr>';
                                                        }
                                                        ?>
                                                        </table>
                                                    </div>
                                                </ul>
                                            </td>
                                        </tr>                                    
                                    </table>
                                        <?php
                                            $reqRemise     = 'select EstimationCoutTotalProjet as hono, pgeremise as p, montantremise as m, TxRemise as t, montantavecremise as mar '
                                                    . 'from projets '
                                                    . 'where RefProjet = "'.$codeMission.'"';
                                            $resRemise     = mysqli_query($connect,$reqRemise) or exit(mysqli_error());
                                            $resulttRemise = mysqli_fetch_assoc($resRemise);
                                            $hono      = $resulttRemise['hono'];
//                                            $mti       = $resulttRemise['mti'];
                                            $pr        = $resulttRemise['p'];
                                            $mr        = $resulttRemise['m'];
                                            $tr        = $resulttRemise['t'];
                                            if($pr == 0 && $mr == 0){
//                                                echo number_format((float)$total, 2, ".", " ");
                                                $mar       = $total;
                                            }
                                            else{
                                                $mar       = $resulttRemise['mar'];
                                            }                                                                                        
                                        ?>
                                                                                
                                        <div class="cout">
                                            <table id="echeance">                                            
                                                <tr>
                                                    <td style="width: 175px"></td>
                                                    <td id="titla" style="width: 50px"><b><center>%</center></b></td>
                                                    <td id="titla" style="width: 175px"><b><center>Valeur</center></b></td>
                                                    <td id="titla" style="width: 172px"><b><center>Total</center></b></td>
                                                </tr>  
                                                <tr>
                                                    <td style="width: 175px">Montant total</td>
                                                    <td style="width: 50px"></td>
                                                    <td style="width: 175px"></td>
                                                    <td style="width: 172px"><b><input style=" text-align: right; width: 168px" readonly id="montanttotal" name="montanttotal" type="text" value="<?php echo number_format((float)$total, 2, ".", " ");?>" /></b></td>
                                                </tr>                                               
                                                <tr>
                                                    <td style="width: 175px">Montant remise accordée</td>
                                                    <td style="width: 50px"><input id="remiseptge" name="remiseptge" value="<?php echo number_format((float)$pr, 2, ".", " "); ?>" style="width:100px" type="double" placeholder="En %" onblur="calcul();"/></td>
                                                    <td style="width: 175px"><input id="remisechiffre" name="remisechiffre" value="<?php echo number_format((float)$mr, 2, ".", " "); ?>" style="width:175px" type="double" placeholder="En montant" onblur="calcul2();"></td>
                                                    <td style="width: 172px"><b><input style=" text-align: right; width: 168px" value="<?php echo number_format((float)$tr, 2, ".", " "); ?>" readonly name="montantremise" id="montantremise" type="double" value="" /></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px">Montant honoraire (HT)</td>
                                                    <td style="width: 50px"></td>
                                                    <td style="width: 175px"></td>
                                                    <td style="width: 172px"><b><input style=" text-align: right; width: 168px" value="<?php echo number_format((float)$mar, 2, ".", " "); ?>" readonly id="totalavecremise" name="totalavecremise" type="double" value="" /></b></td>
                                                </tr>
                                            </table>
                                        </div>

                                    <ul style=" list-style-type: none">
                                    <br/><br/><br/><br/><br/><br/><br/><br/><br/>
                                    <legend><b>Echéance prévisionnelle de facturation</b></legend>
                                    <div style="max-height: 200px;overflow: scroll; max-width: 1500px">
                                        <table id="echeance">
                                        <tr>
                                            <td id="titla" style=" background-color: white; width: 80px"><center>Date échéance</center></td>
                                            <td id="titla" style=" background-color: white; width: 90px"><center>Honoraire Débours</center></td>
                                            <td id="titla" style=" background-color: white; width: 400px"><center>Intitulé</center></td>
                                            <td id="titla" style=" background-color: white; width: 55px"><center>% Contrat</center></td>
                                            <td id="titla" style=" background-color: white; width: 60px"><center>Devise</center></td>
                                            <td id="titla" style=" background-color: white; width: 130px"><center>Montant Prévisionnel</center></td>
                                            <td id="titla" style=" background-color: white; width: 15px"><center>F</center></td>
                                            <td id="titla" style=" background-color: white; width: 125px"><center>Montant Réel</center></td>                                            
                                            <td id="titla" style=" background-color: white; width: 135px"><center>Date Paiement</center></td>      
                                            <td id="titla" style=" background-color: white; width: 80px"><center>Num Fact</center></td> 
<!--                                    <input type="checkbox" style=" border-color: " />-->
                                        </tr>
                                        <?php
                                        $ligne = 20;
                                        $i = 1;
                                        $facttot = array();
                                        $totFac = 0;
                                        $numligne = 0;
										//MODIF RODDY => ajout facture fa
                                        $reqFacturation = 'select F.Echeance as EcheanceDate, F.Typefac as HonoraireDebours, 
                                            F.Libelle as Intitulé, F.Pcontrat as PContrat, F.Monnaie as Devise, 
                                            F.Montant as MontantPrevisionnel, F.Afacturer as fact, F.Idauto as ID, F.MontantRéel as MR, F.DatePaiement as DP, F.Fac_num as FN
                                            from facturation F
                                            inner join projets P on (P.RefProjet = F.RefProjet)
                                            where F.RefProjet = "'.$codeMission.'"'
                                                . 'order by EcheanceDate';
										//FIN MODIF RODDY => facture fa
                                        $reqFact = mysqli_query($connect, $reqFacturation) or exit(mysqli_error($connect));;
                                        $colFact = mysqli_num_fields($reqFact); 
                                        $ligneFact = mysqli_num_rows($reqFact); 

                                        $lifa = 0;
                                        while($rowFac = mysqli_fetch_array($reqFact, MYSQLI_BOTH)){
                                            $lifa = $lifa + 1;
                                            $numligne = $numligne + 1; 
                                            echo "<tr id=\"".$numligne."\">";
                                                for($p=0; $p < $colFact ; $p++){
                                                    switch ($p){
                                                        case 0:
                                                            echo '        <td style=" width: 80px"><input style=" width: 80px; text-align: center" class="datepicker" type="text"  name="echeanceDate[]" value="'.changeDate2($rowFac[$p]).'" /></td>';                      
                                                            break;
                                                        case 1:
                                                            echo '       <td style=" width: 90px">                                            
                                                        <select class="trans" name="honodebours[]" id="honodebours_'.$lifa.'" style="width:90px; text-align: center" />';
                                                        
//                                                        <option selected>'.$rowFac[$p].'</option>';
                                                        $ListHonoDebours = 'select distinct Typefac from facturation order by Typefac ASC';
                                                        $resultListHonoDeb = mysqli_query($connect,$ListHonoDebours);
                                                        while($rowHonoDeb = mysqli_fetch_array($resultListHonoDeb, MYSQLI_BOTH)){
                                                            echo '<option value="'.$rowHonoDeb[0].'" >'.$rowHonoDeb[0].'</option>';
                                                        }
                                            echo '      </select>';
                                            ?>
                                                <script>
                                                    var hono = "<?php echo $rowFac[$p]; ?>"; 
                                                    var li  = "<?php echo $lifa; ?>"; 
                                                    document.getElementById("honodebours_"+li).selectedIndex = getIndex(hono, "honodebours_"+li);
                                                </script>
                                            <?php
                                            echo '       </td>';
                                                            break;
                                                        case 2:
                                                            echo '         <td style=" width: 400px"><input type="text" name="intitule[]" value="'.$rowFac[$p].'" style="width:400px" /></td>';
                                                            break;
                                                        case 3:
                                                            echo '        <td style=" width: 55px"><input style="width:55px; text-align: center" type="double" name="PContrat[]" value="'.$rowFac[$p].'" onclick="verifChampDynClear(this)"/></td>';
                                                            break;
                                                        case 4:
                                                            echo '        <td style=" width: 60px">
                                                        <select class="trans" name="devise[]"  id="devise_'.$lifa.'" style="width:60px" onchange="saisieDeviseFact(this);">
                                                        <option></option>
                                                        
                                                        <optgroup label="Choisir dans la liste déroulante">';
//                                                        $listDevise = 'select distinct Monnaie from facturation order by Monnaie ASC;';
                                                        $listDevise = 'select distinct CodeDevise from devise order by CodeDevise ASC;';
                                                                $resultDevise = mysqli_query($connect,$listDevise);
                                                                while($rowDevises = mysqli_fetch_array($resultDevise, MYSQLI_BOTH)){
                                                                    echo '<option value="'.$rowDevises[0].'" >'.$rowDevises[0].'</option>';
                                                                }
                                                    echo '      </optgroup>';
//                                                                <optgroup label="Nouvelle Devise">
//                                                                    <option>Ajouter</option>
//                                                                </optgroup>';
                                                    echo '      </select>';
                                                    ?>
                                                        <script>
                                                            var dev = "<?php echo $rowFac[$p]; ?>"; 
                                                            var li  = "<?php echo $lifa; ?>"; 
                                                            document.getElementById("devise_"+li).selectedIndex = getIndex(dev, "devise_"+li);
                                                        </script>
                                                    <?php
                                                    echo '</td>';
                                                            break;
                                                        case 5:
                                                            if($rowFac[$p] == ''){
                                                                echo '         <td style=" width: 100px"></td>';                                                                
                                                            }
                                                            else{
                                                                echo '        <td style=" width: 130px"><input type="double" style=" text-align: right; width: 130px" value="'.number_format((float)$rowFac[$p], 2, ".", " ").'" name="montantPrevisionnel[]" /></td>';                                                                                                                            
                                                                $facttot[] = $rowFac[$p];
                                                                break;
                                                            }    
                                                        case 6:
                                                            echo "        <td style=' width: 15px'><center><input type='checkbox' style=' text-align: right; width: 15px' name='".$rowFac['ID']."' id='".$rowFac['ID']."' ";
                                                            
                                                            if($rowFac['fact'] == 1){
                                                                echo "checked disabled ";  
                                                            }
                                                            ?>
                                                            onclick="if(this.checked){
                                                                var ok;
                                                                var ref = '<?php echo $ref;?>';
                                                                $(this).parent().addClass('highlight'); 
                                                                var idnum = '<?php echo $numligne;?>';                                                                                                                                
                                                                $('#'+idnum).addClass('highlight'); 
                                                                ok = confirm('Vous êtes sur le point de facturer la mission. Voulez-vous continuer?');
                                                                    if(ok == true){
                                                                        this.checked = true;                                                                        
                                                                        $.post('mailfacturation.php', { id: this.id, manager: ref});
                                                                        $(this).attr('disabled','disabled'); 
                                                                        $(this).parent().removeClass('highlight');
                                                                        $('#'+idnum).removeClass('highlight'); 
                                                                    }
                                                                    else{
                                                                        this.checked = false;
                                                                        $(this).parent().removeClass('highlight');
                                                                        $('#'+idnum).removeClass('highlight'); 
                                                                    }
                                                                }"
                                                            <?php
                                                            echo " /></center></td>";                                                            
                                                            break;
                                                        case 7:   
                                                            if($rowFac['MR'] == ''){
                                                                echo '         <td style=" width: 100px"></td>';
                                                            }
                                                            else{
                                                                echo '         <td style=" width: 125px"><input type="double" style=" text-align: right; width: 125px" readonly="true" name="mtr[]" value="'.number_format((float)$rowFac['MR'], 2, ".", " ").'"  /></td>';
                                                            }                                                            
                                                            break;
                                                        case 8:
                                                            echo '         <td style=" width: 135px"><input type="text" style=" text-align: center; width: 135px" readonly="true" name="dp[]" value="'.$rowFac['DP'].'" style="width:190px" /></td>';
                                                            break;
                                                        case 9:
                                                            echo '         <td style=" width: 80px"><input type="text" style=" text-align: center; width: 80px" readonly="true" name="fn[]" value="'.$rowFac['FN'].'" style="width:190px" /></td>';
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
                                            
                                            
                                                    echo '        <td style=" width: 80px"><input style=" width: 80px; text-align: center" class="datepicker" type="text"  name="echeanceDate[]"   /></td>';
                                            
                                            

                                            echo '       <td style=" width: 90px">                                            
                                                        <select class="trans" name="honodebours[]" style="width:90px; text-align: center" />
                                                        <option></option>';
                                                        $ListHonoDebours = 'select distinct Typefac from facturation order by Typefac ASC';
                                                        $resultListHonoDeb = mysqli_query($connect,$ListHonoDebours);
                                                        while($rowHonoDeb = mysqli_fetch_array($resultListHonoDeb, MYSQLI_BOTH)){
                                                            echo '<option value="'.$rowHonoDeb[0].'" >'.$rowHonoDeb[0].'</option>';
                                                        }
                                            echo '      </select>
                                                    </td>
                                                    <td style=" width: 400px"><input type="text" name="intitule[]" style="width:400px" /></td>
                                                    <td style=" width: 55px"><input style="width:55px; text-align: center" type="double" name="PContrat[]" onclick="verifChampDynClear(this)"/></td>
                                                    <td style=" width: 60px">
                                                        <select class="trans" name="devise[]" style="width:60px" onchange="saisieDeviseFact(this);">
                                                        <option></option>
                                                        <optgroup label="Choisir dans la liste déroulante">';
//                                                        $listDevise = 'select distinct Monnaie from facturation order by Monnaie ASC;';
                                                        $listDevise = 'select distinct CodeDevise from devise order by CodeDevise ASC;';
                                                        $resultDevise = mysqli_query($connect,$listDevise);
                                                        while($rowDevises = mysqli_fetch_array($resultDevise, MYSQLI_BOTH)){
                                                            echo '<option value="'.$rowDevises[0].'" >'.$rowDevises[0].'</option>';
                                                        }
                                            echo '      </optgroup>';
//                                                        <optgroup label="Nouvelle Devise">
//                                                            <option>Ajouter</option>
//                                                        </optgroup>';
                                            echo '      </select>
                                                    </td>';
                                            echo '        <td style=" width: 130px"><input type="double" name="montantPrevisionnel[]" style=" text-align: right; width: 130px"/></td>';             
//                                            echo '        <td style=" background-color: white; width: 100px"></td>';
//                                            echo '        <td style=" background-color: white; width: 100px"></td>';
//                                            echo '        <td style=" background-color: white; width: 100px"></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </table>                                    
                                    </div>
                                    </ul>
                                       <div class="cout">
                                            <table>                                            
                                                <tr><div class="pre"><b>Montant prévisionnelle total: </b><?php echo  number_format((float)$totFac, 2, ".", " ");?></div></tr>
                                            </table>
                                        </div>
                                        <br/><br/>
                                    </form>
                                <?php 
                                    }
                                }
                            }
                        }
                        
                        if (isset($_POST['modifier'])){
                                                        
                            $reqRefEmp = 'select RefEmploye as REF from employes '
                                    . 'where Nomuser = "'.$Nomuser.'"';
                            $rekRefEmp = mysqli_query($connect,$reqRefEmp);              						
                            $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                            $refEmp = $resultRefEmp['REF'];                                                         
                            
                            ?>
                                <script>
//                                    document.modifMission.style.display = 'none';
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
							//MODIF RODDY
							$groupeclient = $_POST['grclient'];
							$liencom =$_POST['Liencom'];
							$liencontrat =$_POST['Liencontrat'];
							$langue = $_POST['langue'];
							//FIN MODIF RODDY
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
                            $chef = $_POST['chef'];                                                        
                                
                                $signContrat = $_POST['signContrat'];
                                $position = strpos($signContrat, "-");                                
                                if($position === false){
                                    $signContrat = changeDate(str_replace("/", "-", $signContrat));    
                                }
                                                                                                
                                $dteArchiv = $_POST['dteArchiv'];                            
                                $positionA = strpos($dteArchiv, "-");                                
                                if($positionA === false){
                                    $dteArchiv = changeDate(str_replace("/", "-", $dteArchiv));
                                }                                
                                
                                $dtePrevu = $_POST['dtePrevu'];
                                $positionP= strpos($dtePrevu, "-"); 
                                if($positionP === false){
                                    $dtePrevu = changeDate(str_replace("/", "-", $dtePrevu));
                                }
                                
                                $dteFin = $_POST['dteFin'];
                                $positionF= strpos($dteFin, "-"); 
                                if($positionF === false){
                                    $dteFin = changeDate(str_replace("/", "-", $dteFin));
                                }                                                                                                
                                
                                $dbuReel = $_POST['dbuReel'];
                                $positionD= strpos($dbuReel, "-"); 
                                if($positionD === false){
                                    $dbuReel = changeDate(str_replace("/", "-", $dbuReel));
                                }                                            
                                
                                $finReel = $_POST['finReel'];
                                $positionR= strpos($finReel, "-"); 
                                if($positionR === false){
                                    $finReel = changeDate(str_replace("/", "-", $finReel));
                                }                                
                                
                                $dteAvenant = $_POST['dteAvenant'];
                                $positionAv= strpos($dteAvenant, "-"); 
                                if($positionAv === false){
                                    $dteAvenant = changeDate(str_replace("/", "-", $dteAvenant));
                                }                                  
                            
                            
                            
                            $paysMission = $_POST['paysMission'];$villeMission = $_POST['villeMission'];
                            $avenant = $_POST['avenant'];
                            

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
                            
                            if($debPayer == 'NON'){
                                $modFact = '';
                                $montantDeb = 0;
                            }
                            
                            if(empty($_POST['$dteAvenant'])){
                                $dteAvenant = '0000-00-00';
                            }

                            if(empty($_POST['dbuReel'])){
                                $dbuReel = '0000-00-00';
                            }

                            if(empty($_POST['finReel'])){
                                $finReel = '0000-00-00';
                            } 

                            $reqRefCli = 'select RefClient as REF from client where NomSociete="'.$client.'"';
                            $rekRefCli = mysqli_query($connect,$reqRefCli)or exit(mysqli_error($connect));											
                            $resultRefCli = mysqli_fetch_assoc($rekRefCli);
                            $CliRef = $resultRefCli['REF'];

                            $reqRefSoc = 'select RefSociete as SOC from societe where NomSociete = "'.$refSoc.'"';
                            $rekRefSoc = mysqli_query($connect,$reqRefSoc)or exit(mysqli_error($connect));											
                            $resultReSoc = mysqli_fetch_assoc($rekRefSoc);
                            $RefSoc = $resultReSoc['SOC'];  
                            
                            $reqnbModifProjet = 'select max(nombremodification) as nb from projets where RefProjet = "'.$cdeMission.'"';
                            $resnbModifProjet = mysqli_query($connect, $reqnbModifProjet) or exit(mysqli_error($connect));
                            $resultnbModifProjet = mysqli_fetch_assoc($resnbModifProjet);
                            $nbModifProjet = $resultnbModifProjet['nb'];

                            $nbProjet = $nbModifProjet  + 1;  
                                                        
                            $pgeremise     = str_replace(' ', '', $_POST['remiseptge']);
                            $montantremise = str_replace(' ', '', $_POST['remisechiffre']);
                            $TxRemise      = str_replace(' ', '', $_POST['montantremise']);  
                            $Txavecremise  = str_replace(' ', '', $_POST['totalavecremise']);  
                            
//                            echo 'pr '.$pgeremise .' mr '.$montantremise .' tr '.$TxRemise .' tar '.$Txavecremise .' $refEmp' .$refEmp; 
                            
/*****************************************UPDATE PROJET: Infos client et infos contrat et infos facturation**************************/ 
                            $mysqli->query("SET AUTOCOMMIT=0");
							
                            $reqUpProjet = 'update projets set '
                                . 'NomProjet = "'.$mission.'", RefClient = "'.$CliRef.'", GroupeCli = "'.$groupeclient.'", TypeProjet = "'.$categorie.'", Origine = "'.$origine.'",'
                                . 'Datesignature = "'.$signContrat.'", Datearchctr = "'.$dteArchiv.'", Avenantctr = "'.$avenant.'", '
                                . 'Datesignaven = "'.$dteAvenant.'", '
                                . 'Paysmission = "'.$paysMission.'", Villemission = "'.$villeMission.'", Chefmission = "'.$chef.'", '
                                . 'DateDebutProjet = "'.$dtePrevu.'", DateFinProjet = "'.$dteFin.'", DateDebutR = "'.$dbuReel.'", '
                                . 'DateFinR = "'.$finReel.'",LienCom = "'.$liencom.'", LienContrat = "'.$liencontrat.'",'
                                . 'RefSociete = "'.$RefSoc.'", DeviseCa = "'.$CA.'", Reftypehono = "'.$typehono.'", Modefachono = "'.$mod_fac.'", '
                                . 'Deboursrefact = "'.$debPayer.'", Modefacdebour = "'.$modFact.'", Interlocfacture = "'.$interFac.'", '
                                . 'Adressefacture = "'.$adresseFact.'", Monnaie = "'.$devizy.'", Langue = "'.$langue.'", EstimationCoutTotalProjet = "'.$montantHono.'", '
                                . 'EstimationCoutDebours = "'.$montantDeb.'", Coordoninterloc = "'.$Coord.'",'
                                . 'typeclient = "'.$typeClientSaisi.'", stat = "'.$statSaisi.'", nif = "'.$nifSaisi.'", cif = "'.$cifSaisi.'", '
                                . 'rcs = "'.$rcsSaisi.'", cloture = '.$clo.', '
                                . 'datemodification = NOW(), '
                                . 'nombremodification = '.$nbProjet.', '
                                . 'usermodif = "'.$refEmp.'" , '
                                . 'pgeremise = '.$pgeremise.' , '
                                . 'montantremise = '.$montantremise.' , '
                                . 'TxRemise =  '.$TxRemise.','
                                . 'montantavecremise = '.$Txavecremise.' '                                
                                . 'where RefProjet = "'.$cdeMission.'"';
                            $reqProjetM = mysqli_query($connect,$reqUpProjet) or exit(mysqli_error($connect));
                            
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
//                                        $reqEmpM    = 'select RefEmploye as EMP from employes where Prenom = "'.$managerListM.'"';
//                                        $rekEmpM    = mysqli_query($connect,$reqEmpM);
//                                        $resultEmpM = mysqli_fetch_assoc($rekEmpM);
//                                        $empM[$i]   = $resultEmpM['EMP'];
                                        $empM[$i]   = $_POST['managerList'][$i];
                                        //associé par departement par ligne
//                                        $reqEmplM    = 'select RefEmploye as EMPL from employes where Prenom = "'.$assocListM.'"';
//                                        $rekEmplM    = mysqli_query($connect,$reqEmplM);
//                                        $resultEmplM = mysqli_fetch_assoc($rekEmplM);
//                                        $emplM[$i]   = $resultEmplM['EMPL'];
                                        $emplM[$i] = $_POST['assocList'][$i];
                                        
                                        $reqnbModifdeptprojet = 'select max(nombremodification) as nbdept from deptprojet '
                                                . 'where deptprojet.RefProjet = "'.$cdeMission.'" '
                                                . 'and deptprojet.Coddept="'.$tabCod[$i].'"';
                                        $resnbModifdeptprojet = mysqli_query($connect, $reqnbModifdeptprojet) or exit(mysqli_error($connect));
                                        $resultnbModifdeptprojet = mysqli_fetch_assoc($resnbModifdeptprojet);
                                        $nbModifdeptprojet = $resultnbModifdeptprojet['nbdept'];

                                        $nbdeptprojet = $nbModifdeptprojet  + 1;
										 
//                                        echo '<br/>departement: '.$coddepM[$i].' manager: '.$empM[$i].' associé: '.$emplM[$i];
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpDeptProjet = 'update deptprojet '
                                            . 'inner join projets on (projets.RefProjet = deptprojet.RefProjet) '
                                            . 'set '
                                            . 'deptprojet.Coddept = "'.$coddepM[$i].'", deptprojet.Respvalid = "'.$empM[$i].'", '
                                            . 'deptprojet.Dirmission = "'.$emplM[$i].'", '
                                            . 'deptprojet.datemodification = NOW(), '
                                            . 'deptprojet.nombremodification = "'.$nbdeptprojet.'", '
                                            . 'deptprojet.usermodif = "'.$refEmp.'" '
                                            . 'where deptprojet.RefProjet = "'.$cdeMission.'" and deptprojet.Coddept="'.$tabCod[$i].'"'; 

                                        $reqDeptprojetM = mysqli_query($connect,$reqUpDeptProjet)or exit(mysqli_error($connect));                                   
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
//                                        $reqEmp    = 'select RefEmploye as EMP from employes where Prenom = "'.$managerList.'"';
//                                        $rekEmp    = mysqli_query($connect,$reqEmp);
//                                        $resultEmp = mysqli_fetch_assoc($rekEmp);
//                                        $emp[$j]   = $resultEmp['EMP'];
                                        $emp[$j] = $_POST['managerList'][$i];
                                        //associé par departement par ligne
//                                        $reqEmpl    = 'select RefEmploye as EMPL from employes where Prenom = "'.$assocList.'"';
//                                        $rekEmpl    = mysqli_query($connect,$reqEmpl);
//                                        $resultEmpl = mysqli_fetch_assoc($rekEmpl);
//                                        $empl[$j]   = $resultEmpl['EMPL'];
                                        $empl[$j] = $_POST['assocList'][$i];
//                                        echo '<br/>departement: '.$coddep[$j].' manager: '.$emp[$j].' associé: '.$empl[$j];
                                        
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqinsertDeptprojet = 'insert into deptprojet '
                                            . '(RefProjet, Coddept, Respvalid, Dirmission, datemodification, nombremodification, usermodif) values '
                                            . '("'.$cdeMission.'", "'.$coddep[$j].'", "'.$emp[$j].'", "'.$empl[$j].'", NOW(), 0, "'.$refEmp.'")';                                    
                                        $reqDeptprojet = mysqli_query($connect,$reqinsertDeptprojet)or exit(mysqli_error($connect));                                   
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
//                                        $reqEmpM    = 'select RefEmploye as EMP from employes where Prenom = "'.$managerListM.'"';
//                                        $rekEmpM    = mysqli_query($connect,$reqEmpM);
//                                        $resultEmpM = mysqli_fetch_assoc($rekEmpM);
//                                        $empM[$i]   = $resultEmpM['EMP'];
                                        $empM[$i] = $_POST['managerList'][$i];
                                        //associé par departement par ligne
//                                        $reqEmplM    = 'select RefEmploye as EMPL from employes where Prenom = "'.$assocListM.'"';
//                                        $rekEmplM    = mysqli_query($connect,$reqEmplM);
//                                        $resultEmplM = mysqli_fetch_assoc($rekEmplM);
//                                        $emplM[$i]   = $resultEmplM['EMPL'];
                                        $emplM[$i] = $_POST['assocList'][$i];
                                        
                                        $reqnbModifdeptprojet2 = 'select max(nombremodification) as nbdept2 from deptprojet '
                                                . 'where deptprojet.RefProjet = "'.$cdeMission.'" '
                                                . 'and deptprojet.Coddept="'.$tabCod[$i].'"';
                                        $resnbModifdeptprojet2 = mysqli_query($connect, $reqnbModifdeptprojet2) or exit(mysqli_error($connect));
                                        $resultnbModifdeptprojet2 = mysqli_fetch_assoc($resnbModifdeptprojet2);
                                        $nbModifdeptprojet2 = $resultnbModifdeptprojet2['nbdept2'];

                                        $nbdeptprojet2 = $nbModifdeptprojet2  + 1;

//                                        echo '<br/>departement: '.$coddepM[$i].' manager: '.$empM[$i].' associé: '.$emplM[$i];
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpDeptProjet = 'update deptprojet '
                                            . 'inner join projets on (projets.RefProjet = deptprojet.RefProjet) '
                                            . 'set '
                                            . 'deptprojet.Coddept = "'.$coddepM[$i].'", deptprojet.Respvalid = "'.$empM[$i].'", '
                                            . 'deptprojet.Dirmission = "'.$emplM[$i].'", '
                                            . 'deptprojet.datemodification = NOW(), '
                                            . 'deptprojet.nombremodification = "'.$nbdeptprojet2.'", '
                                            . 'deptprojet.usermodif = "'.$refEmp.'" '
                                            . 'where deptprojet.RefProjet = "'.$cdeMission.'" and deptprojet.Coddept="'.$tabCod[$i].'"'; 

                                        $reqDeptprojetM = mysqli_query($connect,$reqUpDeptProjet)or exit(mysqli_error($connect));                                   
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
//                            echo '<br />nb intervenant deja dans la base: '.$kountyCons;
                            
                            if($kountyCons > 0){
                                $countIntervTot = count($_POST['nameCons']);
//                                echo '<br>nb de ligne d interv existant: '.$countIntervTot;
                                $countIntnonvide = 0;
                                for ($j=0; $j<$countIntervTot; $j++){
                                    if(($_POST['nameCons'][$j] == '') or ($_POST['prof'][$j]== '')or ($_POST['nbJH'][$j] == '') or ($_POST['tarifJH'][$j] == '')){                                    
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
                                    $resultRefEmp = mysqli_query($connect, $reqRefEmp)or exit(mysqli_error($connect));                                   ;
                                    while($row = mysqli_fetch_row($resultRefEmp)){                                    
                                        $k=0;
                                            $tabRefEmpl[] = $row[$k];
                                        $k += $k;
                                    }
                                    for($k=0 ; $k < $kountyCons ; $k++){
                                        if(is_numeric($_POST['nameCons'][$k]) || substr($_POST['nameCons'][$k], 0, 2) == 'E0' || $_POST['nameCons'][$k] == 'EP01' || $_POST['nameCons'][$k] == 'EP02' || (substr($_POST['nameCons'][$k], 0, 1) == 'S' && $_POST['nameCons'][$k].length < 5)){                                            
                                            $ConsM[$k] = $_POST['nameCons'][$k];
                                        }
                                        else{
                                            $nameConsM = $_POST['nameCons'][$k];
                                            $reqConsM = 'select RefEmploye as consu from employes where concat(Prenom, " ", NomFamille) like "'.$nameConsM.'"';
                                            $rekConsM = mysqli_query($connect,$reqConsM);
                                            $resultConsM = mysqli_fetch_assoc($rekConsM);
                                            $ConsM[$k] = $resultConsM['consu'];                                                                                        
                                        }
                                        
                                        $profM = $_POST['prof'][$k];
                                        $nbJHM[$k] = $_POST['nbJH'][$k];
                                        $tarifJHM[$k] = str_replace(" ", "", $_POST['tarifJH'][$k]);                                                                             
                                        
                                        $reqProM = 'select Protarif as PR from protarif where Protarif="'.$profM.'"';
                                        $rekProM = mysqli_query($connect,$reqProM);
                                        $resultProM = mysqli_fetch_assoc($rekProM);
                                        $ProM[$k] = $resultProM['PR']; 
                                        
                                        $reqnbModifjhprevu = 'select max(nombremodification) as nbjhprevu from jhprevu '
                                                . 'where jhprevu.RefProjet = "'.$cdeMission.'" and jhprevu.RefEmploye="'.$tabRefEmpl[$k].'"';                                                
                                        $resnbModifjhprevu = mysqli_query($connect, $reqnbModifjhprevu) or exit(mysqli_error($connect));
                                        $resultnbModifjhprevu = mysqli_fetch_assoc($resnbModifjhprevu);
                                        $nbModifjhprevu = $resultnbModifjhprevu['nbjhprevu'];

                                        $nbjhprevu = $nbModifjhprevu  + 1;
                                       // $mysqli->query($connect, "SET FOREIGN_KEY_CHECKS=0");
                                        $mysqli->query("SET AUTOCOMMIT=0");
										//$mysqli->query($connect, "SET FOREIGN_KEY_CHECKS=0");
                                        $reqUpJhprevu = 'update jhprevu '
                                            . 'inner join employes on (employes.RefEmploye = jhprevu.RefEmploye) '
                                            . 'inner join protarif on (protarif.Protarif = jhprevu.Protarif) '
                                            . 'inner join projets on (projets.RefProjet = jhprevu.RefProjet) '
                                            . 'set '                                                
                                            . 'jhprevu.RefEmploye = "'.$ConsM[$k].'", '
                                            . 'jhprevu.Protarif = "'.$ProM[$k].'",'
                                            . ' jhprevu.NombreJH = "'.$nbJHM[$k].'", '
                                            . 'jhprevu.TarifJH = "'.$tarifJHM[$k].'", '
                                            . 'jhprevu.datemodification = NOW(), '
                                            . 'jhprevu.nombremodification = "'.$nbjhprevu.'", '
                                            . 'jhprevu.usermodif = "'.$refEmp.'" '
                                            . 'where jhprevu.RefProjet = "'.$cdeMission.'" and jhprevu.RefEmploye="'.$tabRefEmpl[$k].'"';
										
										// $mysqli->query($connect, "SET FOREIGN_KEY_CHECKS=0");
                                        $reqJhprevuM = mysqli_query($connect,$reqUpJhprevu)or exit(mysqli_error($connect)); 
										                                
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
                                        
//                                        $reqCons = 'select RefEmploye as consu from employes where prenom = "'.$nameCons.'"';
//                                        $rekCons = mysqli_query($connect,$reqCons);
//                                        $resultCons = mysqli_fetch_assoc($rekCons);
//                                        $Cons[$k] = $resultCons['consu'];
                                        $Cons[$k] = $nameCons;
                                        //profil par ligne
                                        $reqPro = 'select Protarif as PR from protarif where Protarif="'.$prof.'"';
                                        $rekPro = mysqli_query($connect,$reqPro);
                                        $resultPro = mysqli_fetch_assoc($rekPro);
                                        $Pro[$k] = $resultPro['PR'];        
//                                        echo 'aaaaaaaaaaa';
//                                        echo '<br/>1111 cons: '.$Cons[$k].' prof: '.$Pro[$k].' nbJH: '.$nbJH[$k].' montant: '.$tarifJH[$k];
                                        
                                        $reqInsertJhprevu = 'insert into jhprevu '
                                        . '(RefProjet, RefEmploye, Protarif, NombreJH, TarifJH, datemodification, nombremodification, usermodif) values '
                                        . '("'.$cdeMission.'", "'.$Cons[$k].'", "'.$Pro[$k].'", "'.$nbJH[$k].'", "'.$tarifJH[$k].'", NOW(), 0, "'.$refEmp.'")';
                                        $reqJhprevu = mysqli_query($connect,$reqInsertJhprevu) or exit(mysqli_error($connect));                                   
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
                                    $resultRefEmp = mysqli_query($connect, $reqRefEmp)or exit(mysqli_error($connect));
                                    while($row = mysqli_fetch_row($resultRefEmp)){                                    
                                        $k=0;
                                            $tabRefEmpl[] = $row[$k];
//                                            echo ' sshhhh '.$row[$k] .' k '.$k;
                                        $k += $k;
                                    }
                                    for($k=0 ; $k < $kountyCons ; $k++){                                                                                  
                                        if(is_numeric($_POST['nameCons'][$k]) || substr($_POST['nameCons'][$k], 0, 2) == 'E0' || $_POST['nameCons'][$k] == 'EP01' || $_POST['nameCons'][$k] == 'EP02' || (substr($_POST['nameCons'][$k], 0, 1) == 'S' && $_POST['nameCons'][$k].length < 5)){                                            
//                                            echo 'num '.$_POST['nameCons'][$k].' ';
                                            $ConsM[$k] = $_POST['nameCons'][$k];                                            
                                        }
                                        else{                                            
                                            $nameConsM = $_POST['nameCons'][$k]; 
//                                            echo 'namecons '.$nameConsM.' ';
                                            $reqConsM = 'select RefEmploye as consu from employes where concat(Prenom, " ", NomFamille) like "'.$nameConsM.'"';
                                            $rekConsM = mysqli_query($connect,$reqConsM);
                                            $resultConsM = mysqli_fetch_assoc($rekConsM);
                                            $ConsM[$k] = $resultConsM['consu'];                                                                                                                                    
                                        }                                        
                                        
                                        $profM = $_POST['prof'][$k];
                                        $nbJHM[$k] = $_POST['nbJH'][$k];
                                        $tarifJHM[$k] = str_replace(" ", "", $_POST['tarifJH'][$k]);                                                                                
                                        
                                        $reqProM = 'select Protarif as PR from protarif where Protarif="'.$profM.'"';
                                        $rekProM = mysqli_query($connect,$reqProM);
                                        $resultProM = mysqli_fetch_assoc($rekProM);
                                        $ProM[$k] = $resultProM['PR']; 
                                        
                                        $reqnbModifjhprevu2 = 'select max(nombremodification) as nbjhprevu2 from jhprevu '
                                                . 'where jhprevu.RefProjet = "'.$cdeMission.'" and jhprevu.RefEmploye="'.$tabRefEmpl[$k].'"';                                                
                                        $resnbModifjhprevu2 = mysqli_query($connect, $reqnbModifjhprevu2) or exit(mysqli_error($connect));
                                        $resultnbModifjhprevu2 = mysqli_fetch_assoc($resnbModifjhprevu2);
                                        $nbModifjhprevu2 = $resultnbModifjhprevu2['nbjhprevu2'];

                                        $nbjhprevu2 = $nbModifjhprevu2  + 1;                                                                                
                                        
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpJhprevu = 'update jhprevu '
                                            . 'inner join employes on (employes.RefEmploye = jhprevu.RefEmploye) '
                                            . 'inner join protarif on (protarif.Protarif = jhprevu.Protarif) '
                                            . 'inner join projets on (projets.RefProjet = jhprevu.RefProjet) '
                                            . 'set '                                                
                                            . 'jhprevu.RefEmploye = "'.$ConsM[$k].'", '
                                            . 'jhprevu.Protarif = "'.$ProM[$k].'",'
                                            . ' jhprevu.NombreJH = "'.$nbJHM[$k].'", '
                                            . 'jhprevu.TarifJH = "'.$tarifJHM[$k].'", '
                                            . 'jhprevu.datemodification = NOW(), '
                                            . 'jhprevu.nombremodification = "'.$nbjhprevu2.'", '
                                            . 'jhprevu.usermodif = "'.$refEmp.'" '
                                            . 'where jhprevu.RefProjet = "'.$cdeMission.'" and jhprevu.RefEmploye="'.$tabRefEmpl[$k].'"';
                                        $reqJhprevuM = mysqli_query($connect,$reqUpJhprevu)or exit(mysqli_error($connect));                                   
                                        
                                        if($reqJhprevuM){
//                                            echo 'mety refemp '.$ConsM[$k].' protarif '.$ProM[$k].' jh '.$nbJHM[$k].' tarif '.$tarifJHM[$k].' ';
                                        }
                                        else if(!$reqJhprevuM){
//                                            echo 'tsy mety refemp '.$ConsM[$k].' protarif '.$ProM[$k].' jh '.$nbJHM[$k].' tarif '.$tarifJHM[$k].' ';
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
                                    if(($_POST['nameCons'][$j] == '') or ($_POST['prof'][$j] == '')or ($_POST['nbJH'][$j] == '') or ($_POST['tarifJH'][$j] == '')){                                    
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
//                                        $reqCons = 'select RefEmploye as consu from employes where prenom = "'.$nameCons.'"';
//                                        $rekCons = mysqli_query($connect,$reqCons);
//                                        $resultCons = mysqli_fetch_assoc($rekCons);
//                                        $Cons[$k] = $resultCons['consu'];
                                        $Cons[$k] = $nameCons;
                                        //profil par ligne
                                        $reqPro = 'select Protarif as PR from protarif where Protarif="'.$prof.'"';
                                        $rekPro = mysqli_query($connect,$reqPro);
                                        $resultPro = mysqli_fetch_assoc($rekPro);
                                        $Pro[$k] = $resultPro['PR'];                                    
//                                        echo '<br/>2222 cons: '.$Cons[$k].' prof: '.$Pro[$k].' nbJH: '.$nbJH[$k].' montant: '.$tarifJH[$k];
                                        
                                        $reqInsertJhprevu = 'insert into jhprevu '
                                        . '(RefProjet, RefEmploye, Protarif, NombreJH, TarifJH, datemodification, nombremodification, usermodif) values '
                                        . '("'.$cdeMission.'", "'.$Cons[$k].'", "'.$Pro[$k].'", "'.$nbJH[$k].'", "'.$tarifJH[$k].'", NOW(), 0, "'.$refEmp.'")';
                                        $reqJhprevu = mysqli_query($connect,$reqInsertJhprevu)or exit(mysqli_error($connect));
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
                                    if(($_POST['echeanceDate'][$j] == '') or ($_POST['honodebours'][$j] == '') or ($_POST['intitule'][$j] == '')
                                        or ($_POST['PContrat'][$j] == '') or ($_POST['devise'][$j] == '') or ($_POST['montantPrevisionnel'][$j] == '')){                                                                        
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
                                    $echeanceDateM = $_POST['echeanceDate'];
                                    
                                    $honodeboursM = $_POST['honodebours'];
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
                                    $resultFact = mysqli_query($connect, $reqFacturation)or exit(mysqli_error($connect));
                                    while($row = mysqli_fetch_row($resultFact)){                                    
                                        $j=0;
                                            $tabFact[] = $row[$j];
                                        $j += $j;
                                    }
                                    for ($j = 0; $j < $kountyFact; $j++){                                                                                
                                        
                                            $echeanceDateM[$j] = $_POST['echeanceDate'][$j];
                                            $positionM = strpos($echeanceDateM[$j], "-");                                
                                            if($positionM === false){
                                                $echeanceDateM[$j] = changeDate(str_replace("/", "-", $echeanceDateM[$j]));
                                            }                                            
                                        
                                        
                                        $honodeboursM[$j] = $_POST['honodebours'][$j];
                                        $intituleM[$j] = $_POST['intitule'][$j];
                                        $PContratM[$j] = $_POST['PContrat'][$j];
                                        $deviseM[$j] = $_POST['devise'][$j];
                                        $montantPrevisionnelM[$j] = str_replace(" ", "", $_POST['montantPrevisionnel'][$j]);
                                        
                                        $reqnbModiffacturation = 'select max(nombremodification) as nbfacturation from facturation '
                                                . 'where facturation.RefProjet = "'.$cdeMission.'" and facturation.Idauto = "'.$tabFact[$j].'"';                                                
                                        $resnbModiffacturation = mysqli_query($connect, $reqnbModiffacturation) or exit(mysqli_error($connect));
                                        $resultnbModiffacturation = mysqli_fetch_assoc($resnbModiffacturation);
                                        $nbModiffacturation = $resultnbModiffacturation['nbfacturation'];

                                        $nbfacturation = $nbModiffacturation  + 1;
                                        
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpFact = 'update facturation '
                                            . 'inner join projets on (projets.RefProjet = facturation.RefProjet) '
                                            . 'set '
                                            . 'facturation.Echeance = "'.$echeanceDateM[$j].'", facturation.Typefac = "'.$honodeboursM[$j].'", '
                                            . 'facturation.Libelle = "'.$intituleM[$j].'", facturation.Pcontrat = "'.$PContratM[$j].'", '
                                            . 'facturation.Monnaie = "'.$deviseM[$j].'", facturation.Montant = "'.$montantPrevisionnelM[$j].'", '
                                            . 'facturation.datemodification = NOW(), '
                                            . 'facturation.nombremodification = "'.$nbfacturation.'", '
                                            . 'facturation.usermodif = "'.$refEmp.'" '
                                            . 'where facturation.RefProjet = "'.$cdeMission.'" and facturation.Idauto = "'.$tabFact[$j].'"';                                  
                                        $reqfacturationM = mysqli_query($connect,$reqUpFact) or exit(mysqli_error($connect));                                   
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
                                            $positionK = strpos($echeanceDate[$j], "-");                                
                                            if($positionK === false){
                                                $echeanceDate[$j] = changeDate(str_replace("/", "-", $echeanceDate[$j]));
                                            }                                             
                                        

                                        $honodebours[$j] = $_POST['honodebours'][$j];
                                        $intitule[$j] = $_POST['intitule'][$j];
                                        $PContrat[$j] = $_POST['PContrat'][$j];
                                        $devise[$j] = $_POST['devise'][$j];
                                        $montantPrevisionnel[$j] = str_replace(" ", "", $_POST['montantPrevisionnel'][$j]);
                                        $reqIdAuto = 'select max(Idauto) as idauto from facturation;';
                                        $rekIdAuto = mysqli_query($connect,$reqIdAuto) or exit(mysqli_error($connect)); ;
                                        $resultIdAuto = mysqli_fetch_assoc($rekIdAuto);
                                        $idAuto = $resultIdAuto['idauto'] + 1;
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqinsertFacturation = 'insert into facturation'
                                        . '(Idauto, RefProjet, Echeance, Typefac, Libelle, Pcontrat, Monnaie, Montant, datemodification, nombremodification, usermodif) values '
                                        . '("'.$idAuto.'","'.$cdeMission.'", "'.$echeanceDate[$j].'", "'.$honodebours[$j].'", "'.$intitule[$j].'", "'.$PContrat[$j].'", "'.$devise[$j].'", "'.$montantPrevisionnel[$j].'", NOW(), 0, "'.$refEmp.'")';
                                        $reqfacturation = mysqli_query($connect,$reqinsertFacturation) or exit(mysqli_error($connect));                                   
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
                                    $echeanceDateM = $_POST['echeanceDate'];
                                    
                                    $honodeboursM = $_POST['honodebours'];
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
                                    $resultFact = mysqli_query($connect, $reqFacturation) or exit(mysqli_error($connect));
                                    while($row = mysqli_fetch_row($resultFact)){                                    
                                        $j=0;
                                            $tabFact[] = $row[$j];
                                        $j += $j;
                                    }
                                    for ($j = 0; $j < $kountyFact; $j++){
 
                                            $echeanceDateM[$j] = $_POST['echeanceDate'][$j];
                                            $positionL = strpos($echeanceDateM[$j], "-");                                
                                            if($positionL === false){
                                                $echeanceDateM[$j] = changeDate(str_replace("/", "-", $echeanceDateM[$j]));
                                            }                                             
                                        
                                        
                                        $honodeboursM[$j] = $_POST['honodebours'][$j];
                                        $intituleM[$j] = $_POST['intitule'][$j];
                                        $PContratM[$j] = $_POST['PContrat'][$j];
                                        $deviseM[$j] = $_POST['devise'][$j];
                                        $montantPrevisionnelM[$j] = str_replace(" ", "", $_POST['montantPrevisionnel'][$j]);
                                        
                                        $reqnbModiffacturation2 = 'select max(nombremodification) as nbfacturation2 from facturation '
                                                . 'where facturation.RefProjet = "'.$cdeMission.'" and facturation.Idauto = "'.$tabFact[$j].'"';                                                
                                        $resnbModiffacturation2 = mysqli_query($connect, $reqnbModiffacturation2) or exit(mysqli_error($connect));
                                        $resultnbModiffacturation2 = mysqli_fetch_assoc($resnbModiffacturation2);
                                        $nbModiffacturation2 = $resultnbModiffacturation2['nbfacturation2'];

                                        $nbfacturation2 = $nbModiffacturation2  + 1;
                                        
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqUpFact = 'update facturation '
                                            . 'inner join projets on (projets.RefProjet = facturation.RefProjet) '
                                            . 'set '
                                            . 'facturation.Echeance = "'.$echeanceDateM[$j].'", facturation.Typefac = "'.$honodeboursM[$j].'", '
                                            . 'facturation.Libelle = "'.$intituleM[$j].'", facturation.Pcontrat = "'.$PContratM[$j].'", '
                                            . 'facturation.Monnaie = "'.$deviseM[$j].'", facturation.Montant = "'.$montantPrevisionnelM[$j].'", '
                                            . 'facturation.datemodification = NOW(), '
                                            . 'facturation.nombremodification = "'.$nbfacturation2.'", '
                                            . 'facturation.usermodif = "'.$refEmp.'" '
                                            . 'where facturation.RefProjet = "'.$cdeMission.'" and facturation.Idauto = "'.$tabFact[$j].'"';                                  
                                        $reqfacturationM = mysqli_query($connect,$reqUpFact) or exit(mysqli_error($connect));                                   
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
                                    if(($_POST['echeanceDate'][$j] == '') or ($_POST['honodebours'][$j]== '') or ($_POST['intitule'][$j] == '')
                                        or ($_POST['PContrat'][$j] == '') or ($_POST['devise'][$j] == '') or ($_POST['montantPrevisionnel'][$j] == '')){                                                                        
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
                                            $positionQ = strpos($echeanceDate[$j], "-");                                
                                            if($positionQ === false){
                                                $echeanceDate[$j] = changeDate(str_replace("/", "-", $echeanceDate[$j]));
                                            }                                            
					
                                        $honodebours[$j] = $_POST['honodebours'][$j];
                                        $intitule[$j] = $_POST['intitule'][$j];
                                        $PContrat[$j] = $_POST['PContrat'][$j];
                                        $devise[$j] = $_POST['devise'][$j];
                                        $montantPrevisionnel[$j] = str_replace(" ", "", $_POST['montantPrevisionnel'][$j]);
                                        $reqIdAuto = 'select max(Idauto) as idauto from facturation;';
                                        $rekIdAuto = mysqli_query($connect,$reqIdAuto) or exit(mysqli_error($connect));
                                        $resultIdAuto = mysqli_fetch_assoc($rekIdAuto);
                                        $idAuto = $resultIdAuto['idauto'] + 1;
                                        $mysqli->query("SET AUTOCOMMIT=0");
                                        $reqinsertFacturation = 'insert into facturation'
                                        . '(Idauto, RefProjet, Echeance, Typefac, Libelle, Pcontrat, Monnaie, Montant, datemodification, nombremodification, usermodif) values '
                                        . '("'.$idAuto.'","'.$cdeMission.'", "'.$echeanceDate[$j].'", "'.$honodebours[$j].'", "'.$intitule[$j].'", "'.$PContrat[$j].'", "'.$devise[$j].'", "'.$montantPrevisionnel[$j].'", NOW(), 0, "'.$refEmp.'")';                                                        
                                        $reqfacturation = mysqli_query($connect,$reqinsertFacturation) or exit(mysqli_error($connect));
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
                    <!--</div>-->               
                    <!-- bottom -->
                
            </div>
            </center>
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
                    $("textarea").focus(function(e){
                        $(this).height(40);
                        $(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
                    });
                    
                    $("textarea").blur(function(e){
                        $(this).height(16);
//                        $(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
                    });
                    
                    if($('#modifier').is(':disabled')){
//                        alert("disa");                        
                        $('#spann').bind({
                            mouseenter: function(e) {
                                // Hover event handler
                                $('#modifier').attr('disabled', false);  
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
//                        $('#modifier').attr('disabled', false);  
                        $('#spann').unbind('mouseover mouseout');
                    });
                                                            
                    $('#modifier').on('mouseout', function(){                        
//                        alert("kaka");
                        $('#modifier').attr('disabled', 'disabled');    
                        
                    });
                    
                    var user_agent_name = '<?php echo $user_agent_name;?>';
                    var ligne = '<?php echo $ligne;?>';					
                    
                        $('#signContrat').datepicker({
                            autoclose: true,
                            dateFormat:"dd/mm/yy",
                            //format: "yyyy-mm-dd",
                            //daysOfWeekDisabled: [0, 6],
                            todayHighlight: true,
                            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                            firstDay: 1,
                            monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                            changeMonth: true,
                            changeYear: true
                            //endDate: 'today'                            
                        });
                        $("#dteArchiv").datepicker({
                            autoclose: true,
                            dateFormat:"dd/mm/yy",
                            //format: "yyyy-mm-dd",
                            //daysOfWeekDisabled: [0, 6],
                            todayHighlight: true,
                            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                            firstDay: 1,
                            monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                            changeMonth: true,
                            changeYear: true
                            //endDate: 'today'                            
                        });
                        $("#dtePrevu").datepicker({
                            autoclose: true,
                            dateFormat:"dd/mm/yy",
                            //format: "yyyy-mm-dd",
                            //daysOfWeekDisabled: [0, 6],
                            todayHighlight: true,
                            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                            firstDay: 1,
                            monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                            changeMonth: true,
                            changeYear: true
                            //endDate: 'today'                            
                        });                        
                        $("#dteFin").datepicker({
                            autoclose: true,
                            dateFormat:"dd/mm/yy",
                            //format: "yyyy-mm-dd",
                            //daysOfWeekDisabled: [0, 6],
                            todayHighlight: true,
                            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                            firstDay: 1,
                            monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                            changeMonth: true,
                            changeYear: true
                            //endDate: 'today'                            
                        }); 
                        $("#dbuReel").datepicker({
                            autoclose: true,
                            dateFormat:"dd/mm/yy",
                            //format: "yyyy-mm-dd",
                            //daysOfWeekDisabled: [0, 6],
                            todayHighlight: true,
                            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                            firstDay: 1,
                            monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                            changeMonth: true,
                            changeYear: true
                            //endDate: 'today'                            
                        }); 
                        $("#finReel").datepicker({
                            autoclose: true,
                            dateFormat:"dd/mm/yy",
                            //format: "yyyy-mm-dd",
                            //daysOfWeekDisabled: [0, 6],
                            todayHighlight: true,
                            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                            firstDay: 1,
                            monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                            changeMonth: true,
                            changeYear: true
                            //endDate: 'today'                            
                        }); 
                        $("#dteAvenant").datepicker({
                            autoclose: true,
                            dateFormat:"dd/mm/yy",
                            //format: "yyyy-mm-dd",
                            //daysOfWeekDisabled: [0, 6],
                            todayHighlight: true,
                            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                            firstDay: 1,
                            monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                            changeMonth: true,
                            changeYear: true
                            //endDate: 'today'                            
                        }); 
                                     

                    var profil = '<?php echo $prof;?>';   
                    var $refEmploye = '<?php echo $refEmploye;?>';
                    var kounty = '<?php echo $kounty;?>';
                    var kountyMan = '<?php echo $kountyMan; ?>';
                    
//                    alert("kountyMan " +kountyMan);
                    
//                    alert("kounty "+kounty);
                    if(profil === "Consultant" || profil === "Consultante" || profil === "Collaborateur" || profil === "Superviseur" || profil === "Collaboratrice" 
                            || profil === "DAF"){                       
                        $('#modifMission').find('input, button, select').attr('disabled','disabled');
                        $('#modifMission').find('input, button, select, textarea').attr('readonly','true');
                        $("#modifMission").find('input, select').css('background-color', 'white');
                        $('#note').css("display", "none");
                        $("#modifier").css("display", "none");
                    }
                    
                    if(((profil === "Manager" || profil === "Associé" || profil === "Assistant(e) Manager") && kounty >= "1") || (kountyMan >= "1")){
//                        alert("desactive");
                    }
                    else{
                        $('#modifMission').find('input, button, select').attr('disabled','disabled');
                        $('#modifMission').find('input, button, select, textarea').attr('readonly','true');
                        $("#modifMission").find('input, select, textarea').css('background-color', 'white');
                        $('#note').css("display", "none");
                        $("#modifier").css("display", "none");
                    }
                    
                    //disable all forms when cloture = 1
                    var cloture = '<?php echo $cloture;?>';                    
                    if(cloture === '1'){                        
                        $('#modifMission').find('input, button, select').attr('disabled','disabled');
                        $('#modifMission').find('input, button, select, textarea').attr('readonly','true');
                        $('#modifMission').find('input, select, textarea').css('background-color', 'transparent');
                        
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
                            $('#stat').css('background-color', '#F2F1EB');
                            $('#nif').css('background-color', '#F2F1EB');
                            $('#cif').css('background-color', '#F2F1EB');
                            $('#rcs').css('background-color', '#F2F1EB');
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
                    
                    
                    /*********************************REMISE MONTANT SUR INTERVENANTS**************************/
//                    $("#remiseptge").on('click', function(){
//                        
//                        var montanttotal = $("#montanttotal").val().replace(' ', '');
//                        var d = 2;
////                        var montantremise = parseFloat(montanttotal) / d;
//                        
////                        alert("montantnt "+montanttotal);
////                        alert("kaka");
//                        $('#remisechiffre').prop("readonly", true);
//                        $('#remiseptge').prop("readonly", false);
//                        $('#remisechiffre').prop("value", "");  
//                        $('#montantremise').prop("value", "");  
//                        $('#totalavecremise').prop("value", "");  
////                        $('#montantremise').prop("value", montantremise);                        
//                    });
                    
//                    $("#remisechiffre").on('click', function(){
////                        alert("pipi");
//                        $('#remiseptge').prop("readonly", true);
//                        $('#remiseptge').prop("value", "");
//                        $('#remisechiffre').prop("readonly", false);
//                        $('#montantremise').prop("value", "");  
//                        $('#totalavecremise').prop("value", "");  
//                    });
                    
                    /*********************************fin REMISE MONTANT SUR INTERVENANTS**************************/
                    
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
                    var dev = document.getElementById("devizy").value;
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
                            
                            if(devise[i].value !== dev){
                                val = val +1;
                                devise[i].style.backgroundColor = "red";
                                document.getElementById("devizy").style.backgroundColor = "red";
                                alert("La devise de l'Infos Facturation est différent de la devise de l'Echéance prévisionnelle. Veuillez modifier");
                            }
                            
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

                function verifFinMission(){                                        
                    var fin = $("#finReel").val();                    
                    var ff = $('#cloturer').is(':checked');                    
                    if(ff===true && fin === ""){
                        alert("La date de fin réelle n'a pas été spécifiée. Vous ne pouvez pas clôturer la mission.");
                        return false;                         
                    }
                    else{
                        return true;
                    }
                }

                function verifAll(f){                         
//                    $typecli = $("#typeClient").val();                   
//                    if($typecli === 'Privé'){
//                        var stat = verifChampNul(f.stat);
//                        var nif = verifChampNul(f.nif);
//                        var cif = verifChampNul(f.cif);
//                        var rcs = verifChampNul(f.rcs);
//                    }                    
                    
//                   var cdeMission = verifChampNul(f.cdeMission);
                    var miFin = verifFinMission();
                   var mission = verifChampNul(f.mission);
                   var client = verifChampNul(f.client);var categorie = verifChampNul(f.categorie);
                   var origine = verifChampNul(f.origine);var avenant = verifChampNul(f.avenant);
                   
                   //info type de Client
//                   var typeClient = verifChampNul(f.typeClient);
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
//                   var verifDevisy = verifDevise('devise[]');
                   
                   var verifDepListDyn = verifChampNullDynamik('deptList[]', 'managerList[]', 'assocList[]');
                   var consl = verifChampNullDynamiq('nameCons[]', 'prof[]', 'nbJH[]', 'tarifJH[]');
                   var pre = verifChampNullDynamika('echeanceDate[]', 'honodebours[]', 'intitule[]', 'PContrat[]', 'devise[]', 'montantPrevisionnel[]');
  
                    /************************Verification des champs Intervenants: *************************************/                   
//                   var verifNameCons = verifChampNullDynamikSansLigne('nameCons[]');
//                   var verifProf = verifChampNullDynamikSansLigne('prof[]');
                   //var verifnbJH = verifChampNullDynamikSansLigne('nbJH[]');
                   //var verifTarifJH = verifChampNullDynamikSansLigne('tarifJH[]');
                   
                   /************************Verification des champs Echéance prévisionnelle de facturation *************************************/  
//                   var verifecheanceDate = verifChampNullDynamikSansLigne('echeanceDate[]');
//                   var verifhonodebours = verifChampNullDynamikSansLigne('honodebours[]');
//                   var verifintitule = verifChampNullDynamikSansLigne('intitule[]');
                   //var verifPContrat = verifChampNullDynamikSansLigne('PContrat[]');
//                   var verifdevise = verifChampNullDynamikSansLigne('devise[]');
                   //var verifmontantPrevisionnel = verifChampNullDynamikSansLigne('montantPrevisionnel[]');
                   
                   /************************Verification des champs numerique *************************************/  
                   var montantHono = verifNombre('montantHono');
//                   var verifnbJH = verifNombre('nbJH[]');
//                   var verifTarifJH = verifNombre('tarifJH[]');
//                   var verifPContrat = verifNombre('PContrat[]');
//                   var verifmontantPrevisionnel = verifNombre('montantPrevisionnel[]');
                   //var nif = verifNombre('nif');
                   
                    /************************Verification final *************************************/  
                    
//                    if(avenant){
//                        if(document.missionNew.avenant.value === "NON"){
//                            alert(" ");   
//                            //document.missionNew.dteAvenant.setAttribute("desable", "true");
//                            //document.missionNew.dteAvenant.style.display = 'none';
//                            
//                        }                            
//                        else alert("");
                        
//                    }

                    if(miFin === false){
                        return false;
                    }
//                    else if($typecli === 'Privé'){                             
//                        if(
//                            stat &&
//                            nif &&
//                            cif &&
//                            rcs &&
//                                
//                            /*cdeMission && */mission && client && categorie && origine  && avenant && paysMission && villeMission
//                           //info type de client
//                               && typeClient 
//                           //&& cif && stat && rcs 
//                           //&& nif
//                           && chef && dtePrevu && dteFin && refSoc && CA && typehono && mod_fac && debPayer && interFac
//                           && adresseFact && devizy && montantHono && Coord 
//                           && verifDepList && verifManList && verifAssocList
//                           && verifDepListDyn  
//                           && consl && pre
////                           && verifDevisy
////                           && verifNameCons && verifProf 
////                           && verifnbJH 
////                           && verifTarifJH && verifecheanceDate && verifhonodebours && verifintitule 
////                           && verifPContrat && verifdevise && verifmontantPrevisionnel
//                           ){
////                           alert("lulu");
//                            return true;
//                            }
//                        else{
//                           alert("Veuillez remplir correctement tous les champs.");                      
//                           return false;
//                        }
//                    }
//                    else{
//                        alert("vvvvvv");
                        else if(/*cdeMission && */mission && client && categorie && origine  && avenant && paysMission && villeMission
                           //info type de client
//                               && typeClient 
                           //&& cif && stat && rcs 
                           //&& nif
                           && chef && dtePrevu && dteFin && refSoc && CA && typehono && mod_fac && debPayer && interFac
                           && adresseFact && devizy && montantHono && Coord 
                           && verifDepList && verifManList && verifAssocList
                           && verifDepListDyn  
                           && consl && pre
//                           && verifDevisy
//                           && verifNameCons && verifProf 
//                           && verifnbJH 
//                           && verifTarifJH && verifecheanceDate && verifhonodebours && verifintitule 
//                           && verifPContrat && verifdevise && verifmontantPrevisionnel
                           ){
                            return true;
                        }
                        else{
                           alert("Veuillez remplir correctement tous les champs.");                      
                           return false;
                        }
//                    }
                    
                   
                }  
                
                function saisieOrigine(select){
                    if(select.value === 'Ajouter'){
                        //<input id="description" type="text" name="description" />
                        var description = document.createElement('input');
                        description.setAttribute("id", "origine");
                        description.setAttribute("name", "origine");
                        description.setAttribute("type", "text");                    
                        description.setAttribute("style", "width:173px");   
                        select.parentNode.replaceChild(description, select);                    
                    }
                }
                
                function saisieDevise(select){
                    if(select.value === 'Ajouter'){
                        //<input id="description" type="text" name="description" />
                        var description = document.createElement('input');
                        description.setAttribute("id", "devizy");
                        description.setAttribute("name", "devizy");
                        description.setAttribute("type", "text");                    
                        description.setAttribute("style", "width:173px");   
                        select.parentNode.replaceChild(description, select);                    
                    }
                }
                
                function saisieDeviseFact(select){
                if(select.value === 'Ajouter'){
                    //<input id="description" type="text" name="description" />
                    var description = document.createElement('input');
                    description.setAttribute("id", "devise[]");
                    description.setAttribute("name", "devise[]");
                    description.setAttribute("type", "text");                    
                    description.setAttribute("style", "width:173px");   
                    select.parentNode.replaceChild(description, select);                    
                }
            }
                
                function saisieTypeHono(select){
                    if(select.value === 'Ajouter'){
                        //<input id="description" type="text" name="description" />
                        var description = document.createElement('input');
                        description.setAttribute("id", "typehono");
                        description.setAttribute("name", "typehono");
                        description.setAttribute("type", "text");                    
                        description.setAttribute("style", "width:173px");   
                        select.parentNode.replaceChild(description, select);                    
                    }
                }
                
                function saisieModeFact(select){
                    if(select.value === 'Ajouter'){
                        //<input id="description" type="text" name="description" />
                        var description = document.createElement('input');
                        description.setAttribute("id", "mod_fac");
                        description.setAttribute("name", "mod_fac");
                        description.setAttribute("type", "text");                    
                        description.setAttribute("style", "width:173px");   
                        select.parentNode.replaceChild(description, select);                    
                    }
                }
                
                function milliersep(nbr){
                    var nombre = ''+nbr;
                    var nb = nombre.split(".");
                    var nb1 = nb[0];
                    var nb2 = nb[1];
//                        alert("nb " +nb +" nb1 " +nb1 +" nb2 " +nb2);
                        
                    var retour = '';
                    var count=0;
                    for(var i=nb1.length-1 ; i>=0 ; i--){
                        if(count!==0 && count % 3 === 0)
                                retour = nombre[i]+' '+retour ;
                        else
                                retour = nombre[i]+retour ;
                        count++;
                    }
//                    alert('nb : '+nbr+' => '+retour);
                    
                    if(nb2 === undefined){
                        retour = retour + ".00";                                                            
                    }
                    else{
                        retour = retour + "." +nb2;                                                            
                    }                                        
                    return retour;
                }                                        
                
                function calcul(){ 
                    var mt = strReplace(document.getElementById("montanttotal").value, " ", "");
                    var rp = strReplace(document.getElementById("remiseptge").value, " ", "");
                    var mr = (parseFloat(mt) * parseFloat(rp))/100;
                        mr = mr.toFixed(2);
                    var rc = (parseFloat(mt) * parseFloat(rp))/100;
                        rc = rc.toFixed(2);
//                    mt = strReplace(mt, " ", "");

                    document.getElementById("montantremise").value= 
                            milliersep(mr);
                                        
                    document.getElementById("remisechiffre").value= 
                            milliersep(rc);
                    
                    var tr = strReplace(document.getElementById("montantremise").value, " ", "");
                        tr = tr.toFixed(2);
                    document.getElementById("totalavecremise").value= 
                            milliersep(parseFloat(mt) - parseFloat(tr));
                }
                
                function calcul2(){ 
                    var mt = strReplace(document.getElementById("montanttotal").value, " ", "");
//                    var rp = strReplace(document.getElementById("remiseptge").value, " ", "");
                    var rc = strReplace(document.getElementById("remisechiffre").value, " ", "");                    
//                    mt = strReplace(mt, " ", "");

                    document.getElementById("remiseptge").value= 
                            ((parseFloat(rc) * 100)/ parseFloat(mt)).toFixed(2);
//                            (parseFloat(rc) * 100)/ parseFloat(mt);
                                        
                    document.getElementById("montantremise").value= 
                            milliersep(parseFloat(rc));
                    
                    document.getElementById("totalavecremise").value= 
                            milliersep(parseFloat(mt) - parseFloat(strReplace(document.getElementById("montantremise").value, " ", "")));
                }                                
            </script>
    </body>
</html>
