<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php

date_default_timezone_set('Etc/UTC');
    header ('Content-type:text/html; charset=utf-8');
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';
	
	sec_session_start();
	
	// MODIF RODDY ENLEVE LE MESSAGE DE FIREFOX => CONFIRMATION LORS DE L'ENREGISTREMENT  DE TS
	
	// session_start();

	// if(!empty($_POST) OR !empty($_FILES))
	// {
	// $_SESSION['sauvegarde'] = $_POST ;
	// $_SESSION['sauvegardeFILES'] = $_FILES ;

	// $fichierActuel = $_SERVER['PHP_SELF'] ;
	// if(!empty($_SERVER['QUERY_STRING']))
	// {
	// $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ;
	// }

	// header('Location: ' . $fichierActuel);
	// exit;
	// }

	// if(isset($_SESSION['sauvegarde']))
	// {
	// $_POST = $_SESSION['sauvegarde'] ;
	// $_FILES = $_SESSION['sauvegardeFILES'] ;

	// unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);
	// }
	
	//FIN  MODIF RODDY ENLEVE LE MESSAGE DE FIREFOX => CONFIRMATION LORS DE L'ENREGISTREMENT  DE TS
    
 //   sec_session_start();
        
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
//    echo $user_agent_name;
    
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
        <title>Saisie Time Sheet</title>
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">  
        <!--dialog-->
        <script type="text/javascript" src="../../jquery/jquery.js"></script> 
     
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
            changeYear: true,
//            showWeek: true
            });        
    });
});
</script>

<script type="text/javascript">                                                            
</script>
        <link rel="stylesheet" href="../../jquery/jquery-ui-1.11.2/jquery-ui.css" />
        <!--<link rel="stylesheet" href="../../jquery/jquery-ui-1.11.2/jquery-ui.css" />-->        
        
        <!-- demo stylesheet -->  
        <link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../../includes/db_connect.php"/>
<link   type="text/css" rel="stylesheet" href="../helpers/media/style.css?v=1783"/>        

        <!-- helper libraries -->
        <!--<script src="../helpers/jquery-1.9.1.min.js" type="text/javascript"></script>-->

           
	<!-- /head -->
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
            
            .style1{
                background-color : #F2F1EB;
            }
            .style2{
                background-color : #DAE9F4;
            }
            
            .deptot{
                text-align: left;
                width: 410px;
                border-right: transparent;
            }
            
            .options{
                width: 550px;                
                /*height: 50px;*/
            }
            
            .heuretot{
                text-align: left;
                width: 125px;
            }
            
            .nbhr{
                text-align: justify;                
            }
            
            table{
                border-collapse: collapse;
            }
            #echeance td{
                border: 1px solid grey;                
                /*border-style: none;*/
            }
            
            #echeance input, input[type='textarea']{
                border-color: transparent;
            }            
            
            .trans {
                border-style: none;
            }
            
            input[type='submit'] {
                /*width: 100px!important;*/    
                /*float: right;*/
                /*margin-right: 80px;*/            
            }
            #go{
                margin-right: 898px;
            }
            #enregistrer{
                float: right;
                margin-right: 50px;
            }
            #successGlobal, #errorGlobal{
                margin-left: 500px; 
                margin-top: 10px;
            }
            #errorGlobal{
                /*background-color: red;*/
            }
            .alert {
                text-shadow: 0 1px 0 rgba(255, 255, 255, .2);
                -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .25), 0 1px 2px rgba(0, 0, 0, .05);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, .25), 0 1px 2px rgba(0, 0, 0, .05);
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid transparent;
                border-radius: 4px;
            }
            .alert-success {
                background-image: -webkit-linear-gradient(top, #dff0d8 0%, #c8e5bc 100%);
                background-image: -o-linear-gradient(top, #dff0d8 0%, #c8e5bc 100%);
                background-image: -webkit-gradient(linear, left top, left bottom, from(#dff0d8), to(#c8e5bc));
                background-image: linear-gradient(to bottom, #dff0d8 0%, #c8e5bc 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffdff0d8', endColorstr='#ffc8e5bc', GradientType=0);
                background-repeat: repeat-x;
                border-color: #b2dba1;
            }
            .alert-danger {
                background-image: -webkit-linear-gradient(top, #f2dede 0%, #e7c3c3 100%);
                background-image: -o-linear-gradient(top, #f2dede 0%, #e7c3c3 100%);
                background-image: -webkit-gradient(linear, left top, left bottom, from(#f2dede), to(#e7c3c3));
                background-image:  linear-gradient(to bottom, #f2dede 0%, #e7c3c3 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff2dede', endColorstr='#ffe7c3c3', GradientType=0);
                background-repeat: repeat-x;
                border-color: #dca7a7;
            }
            #laka{
                /*background-image: url( ../../images/gray.png);*/
                /*background: steelblue;*/
                /*background: steelblue;*/
                /*background: #A9BCF5;*/
                background: #A9BCF5;
                display: none;
            } 
            #general{
                background: white;
            }
/*            select{
                height:22px;
                border-color: transparent;
            }*/
/*            input{
                background: whitesmoke;
            }*/
        </style>
        <script>
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
                
                $reqRefEmploye = 'select RefEmploye as EMPLO, Coddept from employes where Nomuser = "'.$Nomuser.'"';   
                $rekRefEmp     = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                $resultRefEmp  = mysqli_fetch_assoc($rekRefEmp);
                $refEmploye    = $resultRefEmp['EMPLO'];
                $coddepa       = $resultRefEmp['Coddept'];
	
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
							<li><a href="../alert/alertcontrat.php"><b>Contrat non signé</b> </a></li>
							<li><a href="../alert/alertfacturation.php"><b>Alerte Facturation</b></a></li>
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
                    <!--    </ul>
                    </div>
                    <div>    
                        <a class='tab selected' href='../ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a class='tab selected' href='../ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a href='../ts/listets.php'><span>Lister Time Sheet</span></a></li>
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
                    <font style=" color: black"><b><center>SAISIE ET MODIFICATION DU TIME SHEET</center></b></font>
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
                                 compteur.innerHTML="<font style='color: red'><b><i>Attention vous êtes déconnecté (toute modification non enregistrée seront perdue)</b></i></font>"
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
            else if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Collaborateur' or $prof == 'Superviseur' or $prof == 'Collaboratrice'){
                ?>                
                    <!-- tabs -->
					
					<ul id="nav">
					<li class="current"><a href="../../guide/index.php">GUIDE</a></li><!-- n1 -->

					<li><a href="../../guide/mission/index.php">MISSIONS</a>
						<ul>
							<li><a href="../mission/missioncode.php"><b>Fiche de Mission</b> <img src="../images/dossier.png" border="0" width="15" height="15" align="absmiddle"> </a></li>
							<li><a href="../mission/missiondept.php"><b>Mission par Départ.</b></a></li>
						</ul>
					</li>
					<li><a href="./index.php">TIMESHEET</a>
						<ul>
							<li><a href="./saisits.php"><b>Saisir TIMESHEET</b> <img src="../images/todo.png" border="0" width="15" height="15" align="absmiddle"></a></li>
							<li><a href="./listets.php"><b>Lister TIMESHEET</b><img src="../images/liste.png" border="0" width="15" height="15" align="absmiddle"></a></li>
						</ul>
					</li>
					<li><a href="../../guide/exportation/export_TS_Cons.php">EXPORTATION</a></li>
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
                        <font style=" color: black"><b><center>SAISIE ET MODIFICATION DU TIME SHEET</center></b></font>
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
                                   compteur.innerHTML="<font style='color: red'><b><i>Attention vous êtes déconnecté (toute modification non enregistrée seront perdue)</b></i></font>"
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
                    <!-- /tabs -->                
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
                        <a href='../../guide/client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='../../guide/client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='../../guide/client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='../../guide/client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>                        
                        <ul>
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->                        
                   <!--     </ul>
                    </div>
                    <div>    
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a class='tab selected' href='./saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a href='./listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                        <div>    
                            <a class='tab' href='../exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/>
                    <font style=" color: black"><b><center>SAISIE ET MODIFICATION DU TIME SHEET</center></b></font>
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
                                 compteur.innerHTML="<font style='color: red'>Attention vous êtes déconnecté (toute modification non enregistrée seront perdue)</font>"
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
                   compteur.innerHTML="<font style='color: red'>Attention vous allez être déconnecté dans "+h+":"+m+":"+s+"<br />Passé ce délai toute modification non enregistrée sera perdue</font>"
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
                    <!-- /tabs -->
                <?php
            }            
        ?>
        
        <div id="errorGlobal" class="alert alert-danger" role="alert" style=" display: none"></div>
        <div id="successGlobal" class="alert alert-success" role="alert"  style=" display: none"></div>
                      
        <div id="container">                        
            <div id="dp">
                
                        <div>
                        <form name="consultTS" method="POST">	
                        
                        <label for="code_mission"></label>							
                        <?php
                            $dateNow = date('Y-m-d');
//                            $dateNow = '2016-04-01'; 
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
                        ?>
                        <select name="periode" id="periode" style="width:215px">
                            <option value="" disabled="" selected style="display:none">S&eacute;lectionnez la période</option>
                            <!--<option value="" disabled="" selected style="display:none">Sélectionnez la période</option>-->
                            <?php                                                                                            
//                                $reqListPeriod = mysqli_query($connect,'select PERIODE from periode where DateEntree between "2015-01-01" and "2015-12-31";');
                                $reqListPeriod = mysqli_query($connect,'select PERIODE from periode where DateEntree between "'.$first.'" and "'.$end.'";');
                                while($rowPde = mysqli_fetch_array($reqListPeriod, MYSQLI_BOTH)){
                                    echo '<option value="'.$rowPde[0].'" >'.$rowPde[0].'</option>';
									
                                }
                            ?>																																		
                        </select>
						
					
                        <input type="submit" name="go" id="go" value="S&eacute;lectionner" >
						
						
                    </form>
					
					
					<?php
					
					// DERNIER MODIF RODDY CE 08/07/2017
					// if(isset($_POST['periode'])) {
					 // $reqListDatentree = mysqli_query($connect,'select DateEntree, PERIODE from periode where DateEntree between "'.$first.'" and "'.$end.'";');
                                // while($rowDateentree = mysqli_fetch_array($reqListDatentree, MYSQLI_BOTH)){
									// $date_TS = $rowDateentree[0];		
									// echo 'date_TS = '.$date_TS;									
                                // }		
								

				//	echo $_POST['periode']; 
					//}
						?>
                    </div>
                        
                        
                        <?php
                        if (isset($_POST['go'])){
                            if($_POST['periode'] == ''){						
                                echo '<font color="red"><br/>Veuillez s&eacute;lectionner une p&eacute;riode.</font>';																
                            }
                            else{                                
                                $periode = $_POST['periode'];                                                                                                                            
                                $pp   = explode(" ", $periode);
                                $annee = $pp[1];
                                $mois = $pp[0];
                                $jour = $pp[4];      


                                
                                if($mois == "Janvier") {$mois = "January";}else if($mois == "Février") {$mois = "February";}
                                if($mois == "Mars") {$mois = "March";}else if($mois == "Avril") {$mois = "April";}
                                if($mois == "Mai") {$mois = "May";}else if($mois == "Juin") {$mois = "June";}
                                if($mois == "Juillet") {$mois = "July";}else if($mois == "Août") {$mois = "August";}
                                if($mois == "Septembre") {$mois = "September";}else if($mois == "Octobre") {$mois = "October";}
                                if($mois == "Novembre") {$mois = "November";}else if($mois == "Décembre") {$mois = "December";}
                                
                                $numMois = date('m', strtotime($mois));                               
                                
                                $volana= mktime(0,0,0,$numMois,1,$annee);
                                $NombreDeJourDuMois = date("t",$volana);                                                                                                   
                                
                                if($jour == "01"){
                                    $dateDebut = "$annee/$numMois/01";
                                    $dateFin   = "$annee/$numMois/15";
                                }
                                else{
                                    $dateDebut = "$annee/$numMois/16";
                                    $dateFin   = "$annee/$numMois/$NombreDeJourDuMois";
                                }
                                                                
                                $dateDebut = strtotime($dateDebut);
                                $dateFin   = strtotime($dateFin);
                                
                                $nb_jours_ouvres = get_nb_open_days($dateDebut, $dateFin);
                                $nbH = $nb_jours_ouvres * 8;                                                                
                                
                                ?>
                                <!--<div id="content" style="max-height: 450px;overflow: scroll;">-->
                                <center>
                                <div>                                                                           
                                    <form id="saisits" enctype="multipart/form-data" onsubmit="return verifAll(this)" action = "upload.php" method = "POST">                                        
                                        <span id="spann" style="float: right; padding: 8px;"><button disabled="disabled" name="enregistrer" id="enregistrer" onmouseover="this.disabled='';">Enregistrer</button></span>                                        
                                        <br/><br/>
										<br/><br/>
										
										   <!--MODIF RODDY - AJOUT BOUTON IMPORTATION FICHIER-->
							
											<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
											<fieldset>
											 <legend><i><b>IMPORTATION FICHIER EXCEL</b></i></legend><input type="file" name="myFile"/> 
											 
											<input type="submit" name="importer" value="Importer" id= "importer" >
											
											</fieldset>
											<br/><br/>
										
											<!--FIN MODIF RODDY - AJOUT BOUTON IMPORTATION FICHIER-->
											
                                        <div>
                                            <table id="general" cellspacing="0" cellpadding="0" border="0" max-width="1120px" id="echeance">                                                 
                                                <tr>
                                                    <td>
                                                        <table cellspacing="0" cellpadding="0" border="1" width="1100px"  id="echeance">
                                                            <tr>
                                                                <?php
                                                                    if($user_agent_name == 'Google Chrome'){
                                                                ?>
                                                                    <th class="centre" width="54px">Ligne</th>                                                                
                                                                    <th class="centre" width="155px">Date </th>
                                                                    <th class="centre" width="150px">Code Mission </th>
                                                                    <th class="centre" width="150px">Département </th>
                                                                    <th class="centre" width="54px">Heure </th>
                                                                    <th class="centre" width="0px">Description </th>
                                                                    <th class="centre" width="26px">V </th>
                                                                    <th class="centre" width="26px"></th>
                                                                <?php
                                                                    }
                                                                    else if($user_agent_name == 'Mozilla Firefox'){
                                                                ?>
                                                                    <th class="centre" width="56px">Ligne</th>                                                                
                                                                    <th class="centre" width="156px">Date </th>
                                                                    <th class="centre" width="150px">Code Mission </th>
                                                                    <th class="centre" width="150px">Département </th>
                                                                    <th class="centre" width="56px">Heure </th>
                                                                    <th class="centre" width="0px">Description </th>
                                                                    <th class="centre" width="24px">V </th>
                                                                    <th class="centre" width="23px"></th>
                                                                <?php
                                                                    }
                                                                    else if($user_agent_name == 'navigateur inconnu' || $user_agent_name == 'Internet Explorer'){
                                                                ?>
                                                                    <th class="centre" width="56px">Ligne</th>                                                                
                                                                    <th class="centre" width="156px">Date </th>
                                                                    <th class="centre" width="150px">Code Mission </th>
                                                                    <th class="centre" width="150px">Département </th>
                                                                    <th class="centre" width="56px">Heure </th>
                                                                    <th class="centre" width="0px">Description </th>
                                                                    <th class="centre" width="24px">V </th>
                                                                    <th class="centre" width="23px"></th>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div style="width:1120px; height:400px; overflow:auto;">
                                                            <table class="monTab" cellspacing="0" cellpadding="0" border="1" width="1100px" id="echeance" >                                                                                                                                   
                                                                    <?php                                                                        
                                                                        $numligne = 0;
                                                                        $employe = $Nomuser;
                                                                        $lignevalid = array();                                                                        
                                                                        $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';                    
                                                                        $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                                                                        $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                                                                        $refEmploye = $resultRefEmp['EMPLO'];

                                                                        //echo 'refEmploye '.$refEmploye;

                                                                        $reqFicheP = 'select RefFichePointage as refFiche '
                                                                                    . 'from fichepointage '
                                                                                    . 'inner join periode P on (fichepointage.DateEntree = P.DateEntree)'
                                                                                    . 'where P.PERIODE = "'.$periode.'" '
                                                                                    . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';                            
                                                                        $rekFicheP = mysqli_query($connect,$reqFicheP) or exit(mysqli_error($connect));
                                                                        $resultFicheP = mysqli_fetch_assoc($rekFicheP);
                                                                        $refFicheR = $resultFicheP['refFiche'];

                                                                         //echo '<br /> refFicheP '.$refFicheR;

                                                                        $reqHrTrav = 'select H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
                                                                                    . 'H.RefProjet as CodeMission , H.Coddept as Departement, '
                                                                                    . 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, '
                                                                                    . 'H.Facture as Validation,'
                                                                                    . 'H.RefDetailFichePointage as RefFP '
                                                                                    . 'from heuresfichepointage H '                                    
                                                                                    . 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
                                                                                    . 'inner join projets P on (P.RefProjet = H.RefProjet) '
                                                                                    . 'where H.RefFichePointage = "'.$refFicheR.'"'
                                                                                    . 'order by H.JourTravaille ASC, H.RefProjet';
                                                                        $result = mysqli_query($connect,$reqHrTrav) or exit(mysqli_error($connect));
                                                                        
                                                                        $kountyTS = mysqli_num_rows($result);                                                                                                                                                
                                                                                                                                                
                                                                        $colonne = mysqli_num_fields($result);                        
                                                                        
                                                                        $k = 0;
                                                                        $moins = 0;
                                                                        $montant = array();
                                                                        $depTotal = 0;
                                                                        $numtot = $kountyTS+10;
                                                                        
                                                                        $reqHrTravValid = 'select H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
                                                                                    . 'H.RefProjet as CodeMission , H.Coddept as Departement, '
                                                                                    . 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, '
                                                                                    . 'H.Facture as Validation,'
                                                                                    . 'H.RefDetailFichePointage as RefFP '
                                                                                    . 'from heuresfichepointage H '                                    
                                                                                    . 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
                                                                                    . 'inner join projets P on (P.RefProjet = H.RefProjet) '
                                                                                    . 'where H.RefFichePointage = "'.$refFicheR.'" '
                                                                                    . 'and H.Facture = 1 '
                                                                                    . 'order by H.JourTravaille ASC, H.RefProjet';
                                                                        $resultValid = mysqli_query($connect,$reqHrTravValid) or exit(mysqli_error($connect));
                                                                        $valid = mysqli_num_rows($resultValid);
                                                                        
                                                                        $nonValid = $kountyTS - $valid;
                                                                        
//                                                                        echo ' ,ligne validée ooo '.$valid.' , ligne non validée '.$nonValid;                                                                        
                                                                        
//                                                                        echo ' kountyTS: '.$kountyTS .' numtot '.$numtot .' ';
                                                                        echo '<input type="hidden" id="numtot" name="numtot" value="'.$numtot.'" />';
                                                                        echo '<input type="hidden" id="periode" name="periode" value="'.$periode.'" />';
                                                                        echo '<input type="hidden" id="kountyTS" name="kountyTS" value="'.$kountyTS.'" />';
                                                                        echo '<input type="hidden" id="lignevalide" name="lignevalide" value="'.$valid.'" />';
                                                                        echo '<input type="hidden" id="rowsactive" name="rowsactive" value="'.$nonValid.'" />';
                                                                        if($kountyTS == 0){
//                                                                            $numtot = 100;
//                                                                        echo '$numtot '.$numtot;
                                                                            for($i = 1; $i <=10; $i++){
                                                                                $numligne = $numligne + 1;                                                                                                                                                                 
                                                                                echo "<tr id=\"".$numligne."\" onclick=\"afficheDep(this.id);\">";                                                                                                                                                                                                                                                
//                                                                                echo "<tr id=\"".$numligne."\" >";                                                                                                                                                                                                                                                
                                                                                echo '<td width=50px><input type="text" id="numli[]" name="numli[]" value="'.$numligne.'" readonly="true" style="width:50px;text-align: center"/></td>';
                                                                                
                                                                                if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){
                                                                                    echo '<td width=150px><input class="datepicker"  name="dateMvt[]"  type = "text"style="width:150px;text-align: center"/></td>';
                                                                                }
                                                                                else if($user_agent_name == 'Google Chrome'){
//                                                                                    echo '<td width=150px><input name="dateMvt[]" type="date" style="width:150px;text-align: center"/></td>';
                                                                                    echo '<td width=150px><input readonly="true" class="datepicker" name="dateMvt[]" type="text" style="width:150px;text-align: center"/></td>';                                                                                    
                                                                                }                                                                                
                                                                                
                                                                                
                                                                                if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){
                                                                                    echo '<td width=150px>
                                                                                   <select name="codeMission_'.$numligne.'" id="codeMission_'.$numligne.'" onchange="request(this);" style="width:150px;height:22px;border-color: transparent;">	    
                                                                                    <option class="options"></option>';
                                                                                }
																				
                                                                                else{
																					//MANIERE DE VALIDER UNE FORMULARE TOUT EN UTILISANT XMLHTTPRequest AU MOYENDE LA FONCTION request ()
																	//=> cas d'une selection dans une liste avec la balise option --- RODDY RECHERCHE-----
																	
                                                                                    echo '<td width=150px>
                                                                                   <select name="codeMission_'.$numligne.'" id="codeMission_'.$numligne.'" onchange="request(this);" style="width:150px;height:22px;border-color: transparent;">	    
                                                                                    <option></option>';
                                                                                }                                                                       
																																																											
//                                                                                    if($prof == 'Associé'){
//                                                                                        $reqCdeMission = 'select RefProjet, RefClient, NomProjet from projets '
//                                                                                            . 'where cloture not in ("1") '
//                                                                                            . 'order by RefProjet ASC;';
//                                                                                    }
//                                                                                    else{
																	
																	//---------------------------------------------------------------------
																	// RECHERCHE GLOBAL DES MISSIONS 
																	//-----------------------------------------------------------------------
																	
                                                                        // /*MODIF RODDY*/$reqCdeMission = 'select DISTINCT P.RefProjet, P.RefClient, 		P.NomProjet nomProjet 
                                                                                        // from deptprojet D
                                                                                        // inner join projets P on (P.RefProjet = D.RefProjet)
                                                                                        // inner join client C on (C.RefClient = P.RefClient)
                                                                                        // where P.cloture <> "1"
                                                                                        // and P.TypeProjet not in ("EXTRA")
                                                                                        // order by 1;';
																						
																	//---------------------------------------------------------------------
																	// FIN RECHERCHE GLOBAL DES MISSIONS 
																	//-----------------------------------------------------------------------
                                                                                            //order by D.RefProjet, C.NomSociete ;';
                                           
																	//------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	// RECHERCHE PAR FILTRE DES MISSIONS SELON LE DEPARTEMENT ET LES CONSULTANTS CONSERNES   MODIF RODDY (or JH.RefEmploye = "'.$refEmploye.'")
																	//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	 //  si ajout filtre			
																				
																		if ($refEmploye == "303")
																		{
																			 $reqCdeMission = 'select  distinct JH.RefProjet, P.RefClient, P.NomProjet 	nomProjet, D.Coddept, P.cloture
																			   from jhprevu JH
																			   inner join projets P on (P.RefProjet = JH.RefProjet)
																			   inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																			   inner join client C on (C.RefClient = P.RefClient)
																			   inner join employes E on (E.Coddept = D.Coddept)
																			  
																			   where D.Coddept = "BPH" and P.cloture <> "1"  
																			UNION
																				select P.RefProjet, P.RefClient, P.NomProjet nomProjet , D.Coddept, P.cloture  
																				from deptprojet D
																				inner join projets P on (P.RefProjet = D.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				where D.Coddept = "'.$coddepa.'" and P.cloture <> "1"
																			UNION
																				select  distinct JH.RefProjet, P.RefClient, P.NomProjet nomProjet, D.Coddept, P.cloture
																				from jhprevu JH
																				inner join projets P on (P.RefProjet = JH.RefProjet)
																				inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				inner join employes E on (E.Coddept = D.Coddept)
																				where JH.RefEmploye = "'.$refEmploye.'" and P.cloture <> "1"
																			   ';
																			   
																		
																		}
																		elseif ($refEmploye == "EP02")
																		{
																			$reqCdeMission = 'select  distinct JH.RefProjet, P.RefClient, P.NomProjet 	nomProjet, D.Coddept, P.cloture
																			   from jhprevu JH
																			   inner join projets P on (P.RefProjet = JH.RefProjet)
																			   inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																			   inner join client C on (C.RefClient = P.RefClient)
																			   inner join employes E on (E.Coddept = D.Coddept)
																			  
																			   where D.Coddept = "BPH" and P.cloture <> "1"  
																			UNION
																				select P.RefProjet, P.RefClient, P.NomProjet nomProjet , D.Coddept, P.cloture   
																				from deptprojet D
																				inner join projets P on (P.RefProjet = D.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				where D.Coddept = "'.$coddepa.'" and P.cloture <> "1"
																			UNION
																				select  distinct JH.RefProjet, P.RefClient, P.NomProjet nomProjet, D.Coddept, P.cloture
																				from jhprevu JH
																				inner join projets P on (P.RefProjet = JH.RefProjet)
																				inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				inner join employes E on (E.Coddept = D.Coddept)
																				where JH.RefEmploye = "'.$refEmploye.'" and P.cloture <> "1"
																			   ';
																		}
																		else
																		{
                                                                               $reqCdeMission = '
																				select P.RefProjet, P.RefClient, P.NomProjet nomProjet , D.Coddept, P.cloture   
																				from deptprojet D
																				inner join projets P on (P.RefProjet = D.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				where D.Coddept = "'.$coddepa.'" and P.cloture <> "1"
																			UNION
																				select  distinct JH.RefProjet, P.RefClient, P.NomProjet nomProjet, D.Coddept, P.cloture
																				from jhprevu JH
																				inner join projets P on (P.RefProjet = JH.RefProjet)
																				inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				inner join employes E on (E.Coddept = D.Coddept)
																				where JH.RefEmploye = "'.$refEmploye.'" and P.cloture <> "1"
																			   ';
																		}
																	//------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	// FIN RECHERCHE PAR FILTRE DES MISSIONS SELON LE DEPARTEMENT ET LES CONSULTANTS CONSERNES
																	//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//                                                                                    }
    //                                                                                       //                                                                                                                                                                    
                                                                                    $reqCdeMissionList = mysqli_query($connect,$reqCdeMission) or exit(mysqli_error($connect));                                                
                                                                                    while($r = mysqli_fetch_array($reqCdeMissionList, MYSQLI_BOTH)){
//                                                                                        echo '<option value="'.$r[0].'" >'.$r[0].'</option>';

																						//LES VALEURS CONTENUES DANS OPTION DANS TRAITER PAR XMLHTTPRequest POUR FAIRE SORTIE AUTOMATIQUEMENT LE CODE DEPARTEMENT --- RODDY RECHERCHE-----			
                                                                                        
																						echo '<option class="options" value="'.$r[0].'">'.$r[0].' --- '.$r[2].' --- '.$r[1].'</option>';                                        
                                                                                    }
                                                                                    echo '</select>';                                                                                
                                                                                    echo '</td>';

                                                                                    echo '<td width=150px>
                                                                                    <select id="departement_'.$numligne.'" name="departement_'.$numligne.'" style="width:150px;height:22px;border-color: transparent;">	                                                                                    
                                                                                    <option></option>';
                                                                                    $codeDeptTS = 'select Coddept from departement order by Coddept ASC';
                                                                                    $reqcodeDeptTS = mysqli_query($connect,$codeDeptTS) or exit(mysqli_error($connect));
    //                                                                                echo '<option></option>';
    //                                                                                while($r = mysqli_fetch_array($reqcodeDeptTS, MYSQL_BOTH)){
    //                                                                                    echo '<option value="'.$r[0].'">'.$r[0].'</option>';
    //                                                                                 }
                                                                                    echo '</select>
                                                                                    </td>';

                                                                                    echo '<td width=50px><input id="ora[]" name="ora[]" style="width:50px;text-align: center"/></td>';                                                                            

                                                                                    if($coddepa === 'BPC'){
                                                                                        echo '<td width=0px>
                                                                                            <select name="description[]" id="description[]" onchange="saisieDesc(this);" style="width: 470px;height:22px;border-color: transparent;">	
                                                                                                <option selected></option>
                                                                                                <optgroup label="Saisie Manuelle">
                                                                                                    <option>Saisir Manuellement</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Choisir dans la liste déroulante">';
                                                                                                    $reqLigneBPC = "select concat(CodeL, ' - ', DescL) as criptdesc from lignebpc order by CodeL;";
                                                                                                    $resLigneBPC = mysqli_query($connect, $reqLigneBPC);
                                                                                                    while($rowBPC = mysqli_fetch_array($resLigneBPC, MYSQLI_BOTH)){
                                                                                                        echo '<option value="'.$rowBPC[0].'">'.$rowBPC[0].'</option>';
                                                                                                    }
                                                                                                echo    '</optgroup>';                                                                                
                                                                                            echo '</select>
                                                                                        </td>';
                                                                                    }
                                                                                    else if($coddepa === 'BPH'){
                                                                                        echo '<td width=0px>
                                                                                            <select name="description[]" id="description[]" onchange="saisieDesc(this);" style="width:470px;height:22px;border-color: transparent;">
                                                                                                <option selected></option>
                                                                                                <optgroup label="Saisie Manuelle">
                                                                                                    <option>Saisir Manuellement</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Choisir dans la liste déroulante">';
                                                                                                    $reqLigneBPH = "select concat(CodeL, ' - ', DescL) as criptdesc from lignebph order by CodeL;";
                                                                                                    $resLigneBPH = mysqli_query($connect, $reqLigneBPH);
                                                                                                    while($rowBPH = mysqli_fetch_array($resLigneBPH, MYSQLI_BOTH)){
                                                                                                        echo '<option value="'.$rowBPH[0].'">'.$rowBPH[0].'</option>';
                                                                                                    }
                                                                                                echo '</optgroup>';                                                                                
                                                                                            echo '</select>
                                                                                        </td>';
                                                                                    }
                                                                                    else{
                                                                                        echo '<td width=0px><input id="description[]" name="description[]" style="width:470px"/></td>';
                                                                                    }
//                                                                                    echo '<td width=26px style="background-color:white;"></td>';
                                                                                    echo '<td width=26px style="background-color:white;"><center><font style="size:26px">☺</font></center></td>';
//                                                                                    echo '<td width=26px style="background-color:white;"></td>';
//                                                                                    echo "<td width=26px><a href='#' onclick='if (confirm(\"Etes-vous sur de vouloir supprimer cette ligne?\")) {load_page(\"supprimeTS.php?Id=".$row['RefFP']."\"); document.location.reload();}'><center><img src='../../images/close_link.png' title='Supprimer'></center></a></td>";                                                                                    
                                                                                    echo "<td width=26px style='background-color:white'><a href='#' onclick='if (confirm(\"Etes-vous sur de vouloir supprimer cette ligne?\")) {load_page(\"supprimeTSLigne.php?Id=".$numligne."\"); }'><center><img src='../../images/close_link.png' title='Supprimer'></center></a></td>";
                                                                                echo '</tr>';
                                                                                                                                                                
                                                                                echo '<tr id="kala_'.$numligne.'" >                                                                                            
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="1" style="border:transparent; background:white"><center><b></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="2" style="border:transparent; border-left:1px solid black;"><center><b><font style="color:black">Cat&eacute;gorie des dépenses</font></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="2"><center><b><font style="color:black">Montant des dépenses</font></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="1"><center><b><font style="color:black">Justificatif des dépenses</font></b></center></td>
                                                                                        </tr>';
                                                                                        $indice = 0;
                                                                                        for($k=0;$k<3;$k++){                                                                                             
                                                                                            $indice = $indice +1;                                                                                                                                                                                          
                                                                                            
                                                                                            echo '<tr id="laka" class="cache_'.$numligne.'"">'; 
                                                                                            echo '<td id="laka" colspan="1" class="cache_'.$numligne.'"" style="border:transparent; background:white"><center></center></td>';
                                                                                            echo '<td id="laka" colspan="2" class="cache_'.$numligne.'"_'.$numligne.'"" ><center><select id="modCat_'.$indice.''.$numligne.'" name="modCat_'.$indice.''.$numligne.'" style="background:#A9BCF5"><option selected></option>'; 
                                                                                                $reqCateg = 'select Categ from depense order by Categ ASC;';
                                                                                                $resultCateg = mysqli_query($connect,$reqCateg) or exit(mysqli_error($connect));
//                                                                                                echo '<option></option>';
                                                                                                while($ree = mysqli_fetch_array($resultCateg, MYSQLI_BOTH)){
                                                                                                    echo '<option value="'.$ree[0].'">'.$ree[0].'</option>';
                                                                                                }                                                                                                                                                                           
                                                                                            echo "</select></center></td>";
                                                                                            echo '<td id="laka" colspan="2" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5" class="cache_'.$numligne.'"" id="modMontant_'.$indice.''.$numligne.'" name="modMontant_'.$indice.''.$numligne.'" type="double" style=" width:125px;height:13px"/></center></td>';
                                                                                            echo '<td id="laka" colspan="1" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5;width:475px" class="cache_'.$numligne.'"" id="modDes_'.$indice.''.$numligne.'" name="modDes_'.$indice.''.$numligne.'" type="text" style=" width:460px;height:13px"/></center></td>';    
                                                                                            echo "</tr>";                                                                                            
                                                                                        }                                                                                        
                                                                                        echo '<input type="hidden" id="indice_'.$numligne.'" name="indice_'.$numligne.'" value="'.$indice.'" />';
                                                                            }
                                                                        }
                                                                        else{
                                                                            $c = 0;
                                                                            while($row = $result->fetch_array()){   
                                                                                    $numligne = $numligne + 1; 
                                                                                    $resulta[] = $row;
                                                                                    $aaa = $row['RefFP'];
                                                                                    
                                                                                    if(isset($resulta[$c])){
                                                                                       $reqDepTach = 'select sum(MontantDepense) as mon from fraisfichepointage '
                                                                                           . 'where RefDetailFichePointage = "'.$resulta[$c]['Ref'].'"';
                                                                                       $rekDepDepTach = mysqli_query($connect,$reqDepTach) or exit(mysqli_error($connect));
                                                                                       $resultDepDepTach = mysqli_fetch_assoc($rekDepDepTach);
                                                                                       $depTach = $resultDepDepTach['mon'];                                                                                       
                                                                                       $montant[] = $depTach;
                                                                                    }
                                                                                    $c++; 

                                                                                    if($row['Validation']==1){
                                                                                        $moins = $moins + 1;                                                                                        
                                                                                    }
                                                                                    
//                                                                                    echo ' kali '.$numligne;

                                                                                    echo "<tr id=\"".$numligne."\" onclick=\"afficheDep(this.id);\" >";
//                                                                                    echo '<input type="hidden" id="numtot" name="numtot" value="'.$numtot.'" />';
                                                                                    echo '<input type="hidden" id="periode" name="periode" value="'.$periode.'" />';
                                                                                    echo '<input type="hidden" id="kountyTS" name="kountyTS" value="'.$kountyTS.'" />';
                                                                                    echo '<td width="50px"><input type="text" id="numli[]" name="numli[]" value="'.$numligne.'" readonly="true" style="width:50px;text-align: center"/></td>';
                                                                                    echo '<input  type="hidden" id="ref[]" name="ref[]" value="'.$row['RefFP'].'" />';
                                                                                    
                                                                                    if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){
                                                                                        echo '<td width=150px><input class="datepicker" name="dateMvt[]" type = "text" value="'.changeDate2($row['Date']).'"  style="width:150px;text-align: center" /></td>';
                                                                                    }
                                                                                    else{
                                                                                        echo '<td width=150px><input readonly="true" class="datepicker" name="dateMvt[]" type="text" value="'.changeDate2($row['Date']).'"  style="width:150px;text-align: center" /></td>';
                                                                                    }
                                                                                    
                                                                                    $verifProjet = 'select cloture from projets where RefProjet = "'.$row['CodeMission'].'"';
                                                                                    $reqverifProjet    = mysqli_query($connect,$verifProjet);
                                                                                    $resultVerifProjet = mysqli_fetch_assoc($reqverifProjet);
                                                                                    $clotPro          = $resultVerifProjet['cloture'];                                                                                    
//                                                                                    echo '<br/>$clotPro: '.$clotPro;
                                                                                                                                                                        
                                                                                    if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){
                                                                                        echo '<td width=150px>
                                                                                       <select name="codeMission_'.$numligne.'" id="codeMission_'.$numligne.'" onchange="request(this);" style="width:150px;height:22px;border-color: transparent;">	    
                                                                                        <option class="options"></option>';
                                                                                        if($clotPro == 1){
                                                                                            echo '<option selected class="options">'.$row['CodeMission'].'</option>';
                                                                                        }                                                                                        
                                                                                    }
                                                                                    else{
                                                                                        echo '<td width=150px>
                                                                                       <select name="codeMission_'.$numligne.'" id="codeMission_'.$numligne.'" onchange="request(this);" style="width:150px;height:22px;border-color: transparent;">	    
                                                                                        <option></option>';
                                                                                        if($clotPro == 1){
                                                                                            echo '<option selected class="options">'.$row['CodeMission'].'</option>';
                                                                                        }
                                                                                    }

        //                                                                                $reqCdeMission = 'select RefProjet, RefClient, NomProjet from projets '
        //                                                                                        . 'where cloture not in ("1") '
        //                                                                                        . 'order by RefProjet ASC;';
		
                                                                                      // $reqCdeMission = 'select DISTINCT P.RefProjet, P.RefClient, P.NomProjet nomProjet 
                                                                                        // from deptprojet D
                                                                                        // inner join projets P on (P.RefProjet = D.RefProjet)
                                                                                        // inner join client C on (C.RefClient = P.RefClient)
                                                                                        // where P.cloture <> "1"
                                                                                        // and P.TypeProjet not in ("EXTRA")
                                                                                        // order by 1 ;';
																						
																							//------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	// RECHERCHE PAR FILTRE DES MISSIONS SELON LE DEPARTEMENT ET LES CONSULTANTS CONSERNES   MODIF RODDY (or JH.RefEmploye = "'.$refEmploye.'" )
																	//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	 //  si ajout filtre			
																	 if ($refEmploye == "303")
																		{
																			 $reqCdeMission = 'select  distinct JH.RefProjet, P.RefClient, P.NomProjet 	nomProjet, D.Coddept, P.cloture
																			   from jhprevu JH
																			   inner join projets P on (P.RefProjet = JH.RefProjet)
																			   inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																			   inner join client C on (C.RefClient = P.RefClient)
																			   inner join employes E on (E.Coddept = D.Coddept)
																			  
																			   where D.Coddept = "BPH" and P.cloture <> "1"  
																			UNION
																				select P.RefProjet, P.RefClient, P.NomProjet nomProjet , D.Coddept, P.cloture  
																				from deptprojet D
																				inner join projets P on (P.RefProjet = D.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				where D.Coddept = "'.$coddepa.'" and P.cloture <> "1"
																			UNION
																				select  distinct JH.RefProjet, P.RefClient, P.NomProjet nomProjet, D.Coddept, P.cloture
																				from jhprevu JH
																				inner join projets P on (P.RefProjet = JH.RefProjet)
																				inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				inner join employes E on (E.Coddept = D.Coddept)
																				where JH.RefEmploye = "'.$refEmploye.'" and P.cloture <> "1"
																			   ';
																			   
																		
																		}
																		elseif ($refEmploye == "EP02")
																		{
																			$reqCdeMission = 'select  distinct JH.RefProjet, P.RefClient, P.NomProjet 	nomProjet, D.Coddept, P.cloture
																			   from jhprevu JH
																			   inner join projets P on (P.RefProjet = JH.RefProjet)
																			   inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																			   inner join client C on (C.RefClient = P.RefClient)
																			   inner join employes E on (E.Coddept = D.Coddept)
																			  
																			   where D.Coddept = "BPH" and P.cloture <> "1"  
																			UNION
																				select P.RefProjet, P.RefClient, P.NomProjet nomProjet , D.Coddept, P.cloture   
																				from deptprojet D
																				inner join projets P on (P.RefProjet = D.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				where D.Coddept = "'.$coddepa.'" and P.cloture <> "1"
																			UNION
																				select  distinct JH.RefProjet, P.RefClient, P.NomProjet nomProjet, D.Coddept, P.cloture
																				from jhprevu JH
																				inner join projets P on (P.RefProjet = JH.RefProjet)
																				inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				inner join employes E on (E.Coddept = D.Coddept)
																				where JH.RefEmploye = "'.$refEmploye.'" and P.cloture <> "1"
																			   ';
																		}
																		else
																		{
                                                                               $reqCdeMission = '
																				select P.RefProjet, P.RefClient, P.NomProjet nomProjet , D.Coddept, P.cloture   
																				from deptprojet D
																				inner join projets P on (P.RefProjet = D.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				where D.Coddept = "'.$coddepa.'" and P.cloture <> "1"
																			UNION
																				select  distinct JH.RefProjet, P.RefClient, P.NomProjet nomProjet, D.Coddept, P.cloture
																				from jhprevu JH
																				inner join projets P on (P.RefProjet = JH.RefProjet)
																				inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				inner join employes E on (E.Coddept = D.Coddept)
																				where JH.RefEmploye = "'.$refEmploye.'" and P.cloture <> "1"
																			   ';
																		}
																	//------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	// FIN RECHERCHE PAR FILTRE DES MISSIONS SELON LE DEPARTEMENT ET LES CONSULTANTS CONSERNES
																	//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                                                                        
                                                                                        //si ajout filtre
//                                                                                        $reqCdeMission = 'select P.RefProjet, P.RefClient, P.NomProjet nomProjet 
//                                                                                        from deptprojet D
//                                                                                        inner join projets P on (P.RefProjet = D.RefProjet)
//                                                                                        inner join client C on (C.RefClient = P.RefClient)
//                                                                                        where D.Coddept = "'.$coddepa.'"
//                                                                                        and P.cloture <> "1"
//                                                                                        order by D.RefProjet, C.NomSociete ;';
                                                                                                                                                                                                                                                                                                                                                                
                                                                                        $reqCdeMissionList = mysqli_query($connect,$reqCdeMission) or exit(mysqli_error($connect));                                                
                                                                                        while($r = mysqli_fetch_array($reqCdeMissionList, MYSQLI_BOTH)){
//                                                                                            echo '<option value="'.$r[0].'" >'.$r[0].'</option>';
                                                                                            echo '<option class="options" value="'.$r[0].'">'.$r[0].' --- '.$r[2].' --- '.$r[1].'</option>';                                        
                                                                                        }
                                                                                        echo '</select>';
                                                                                        ?>
                                                                                        <script>                                                                                    
                                                                                            var codemi = "<?php echo $row['CodeMission']; ?>";
                                                                                            var ligne = "<?php echo $numligne; ?>";                                                                                    
                                                                                            document.getElementById("codeMission_"+ligne).selectedIndex = getIndex(codemi, "codeMission_"+ligne);                                                                    
                                                                                        </script>
                                                                                        <?php
                                                                                        echo '</td>';

                                                                                    echo '<td width=150px>
                                                                                        <select id="departement_'.$numligne.'" name="departement_'.$numligne.'" style="width:150px;height:22px;border-color: transparent;">
                                                                                        <option selected>'.$row['Departement'].'</option>';
                                                                                        $codeDeptTS = 'select Coddept from departement order by Coddept ASC';
                                                                                        $reqcodeDeptTS = mysqli_query($connect,$codeDeptTS) or exit(mysqli_error($connect));
        //                                                                                echo '<option></option>';
        //                                                                                while($r = mysqli_fetch_array($reqcodeDeptTS, MYSQL_BOTH)){
        //                                                                                    echo '<option value="'.$r[0].'">'.$r[0].'</option>';
        //                                                                                 }
                                                                                        echo '</select>
                                                                                    </td>';                                                                                                                                                        

                                                                                    echo '<td width=50px><input id="ora[]" name="ora[]" value="'.$row['Heures'].'" style="width:50px;text-align: center" /></td>';                                                                            

                                                                                    if($coddepa === 'BPC'){
                                                                                        echo '<td width=0px>
                                                                                            <select name="description[]" id="description[]" onchange="saisieDesc(this);" style="width:470px;height:22px;border-color: transparent;">
                                                                                                <option selected>'.$row['Description'].'</option>
                                                                                                <optgroup label="Saisie Manuelle">
                                                                                                    <option>Saisir Manuellement</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Choisir dans la liste déroulante">';
                                                                                                    $reqLigneBPC = "select concat(CodeL, ' - ', DescL) as criptdesc from lignebpc order by CodeL;";
                                                                                                    $resLigneBPC = mysqli_query($connect, $reqLigneBPC);
                                                                                                    while($rowBPC = mysqli_fetch_array($resLigneBPC, MYSQLI_BOTH)){
                                                                                                        echo '<option value="'.$rowBPC[0].'">'.$rowBPC[0].'</option>';
                                                                                                    }
                                                                                                echo    '</optgroup>';                                                                                
                                                                                            echo '</select>
                                                                                        </td>';
                                                                                    }
                                                                                    else if($coddepa === 'BPH'){
                                                                                        echo '<td width=0px>
                                                                                            <select name="description[]" id="description[]" onchange="saisieDesc(this);" style="width:470px;height:22px;border-color: transparent;">
                                                                                                <option selected>'.$row['Description'].'</option>
                                                                                                <optgroup label="Saisie Manuelle">
                                                                                                    <option>Saisir Manuellement</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Choisir dans la liste déroulante">';
                                                                                                    $reqLigneBPH = "select concat(CodeL, ' - ', DescL) as criptdesc from lignebph order by CodeL;";
                                                                                                    $resLigneBPH = mysqli_query($connect, $reqLigneBPH);
                                                                                                    while($rowBPH = mysqli_fetch_array($resLigneBPH, MYSQLI_BOTH)){
                                                                                                        echo '<option value="'.$rowBPH[0].'">'.$rowBPH[0].'</option>';
                                                                                                    }
                                                                                                echo '</optgroup>';                                                                                
                                                                                            echo '</select>
                                                                                        </td>';
                                                                                    }
                                                                                    else{
                                                                                        echo '<td width=0px><input id="description[]" name="description[]" value="'.$row['Description'].'" style="width:470px" /></td>';
                                                                                    }

                                                                                    if($row['Validation']==1){
                                                                                        echo "<td width=26px>";
                                                                                    }
                                                                                    else{
                                                                                        echo "<td width=26px style='background-color:white'>";
                                                                                    }
                                                                                    
                                                                                    echo "<input type='checkbox' name='valid[]' id='valid[]'";

                                                                                    if($row['Validation']==1){
                                                                                        echo 'checked';  
                                                                                        $lignevalid[] = $numligne;
                                                                                    }
                                                                                    echo " disabled>";
                                                                                    //.$row['Validation'].

                                                                                    echo "</input</td>";
                                                                                    
                                                                                    if($row['Validation']==1){
                                                                                        echo '<td width=26px><center><font style="size:26px">☻</font></center></td>';
                                                                                    }
                                                                                    else{                                                                                        
                                                                                        echo "<td width=26px style='background-color:white'><a href='#' onclick='if (confirm(\"Etes-vous sur de vouloir supprimer cette ligne?\")) {load_page(\"supprimeTS.php?Id=".$row['RefFP']."&ligneNum=".$numligne."\");}'><center><img src='../../images/close_link.png' title='Supprimer'></center></a></td>";
//                                                                                        . "<a href='#' onclick='if(confirm(\"Voulez vous vraiment effacer la ligne de TS?\")){load_page(\"./Time/supprimeTS.php\");}'>Supprimer</a>"                                                                        
                                                                                    }
                                                                                                                                                                        
                                                                                    echo '</tr>';                                                                                                                                                                                                                                                           

                                                                                    $query = 'select RefFraisFichePresence as reffrais, D.Categ as Categorie, MontantDepense as Montant, DescriptionDepense as Description '
                                                                                    . 'from fraisfichepointage '
                                                                                    . 'inner join depense D on (D.Categ = fraisfichepointage.Categ)'
                                                                                    . 'inner join heuresfichepointage H on (fraisfichepointage.RefDetailFichePointage = H.RefDetailFichePointage)'
                                                                                    . 'where fraisfichepointage.RefDetailFichePointage = "'.$row['RefFP'].'"'
                                                                                    . 'order by D.Categ ASC';
                                                                                $resultS = mysqli_query($connect,$query) or exit(mysqli_error($connect));                                                                                                                                                                
                                                                                if(!$resultS){                                                                            
                                                                                }
                                                                                else{   
                                                                                    $nbFrais = mysqli_num_rows($resultS);
                                                                                    
                                                                                    echo '<input type="hidden" id="nbFrais_'.$numligne.'" name="nbFrais_'.$numligne.'" value="'.$nbFrais.'" />';
                                                                                    
                                                                                    if($nbFrais==0){
                                                                                        echo '<tr id="kala_'.$numligne.'"">
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="1" style="border:transparent; background:white"><center><b></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="2" style="border:transparent; border-left:1px solid black;"><center><b><font style="color:black">Cat&eacute;gorie des dépenses</font></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="2"><center><b><font style="color:black">Montant des dépenses</font></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="1"><center><b><font style="color:black">Justificatif des dépenses</font></b></center></td>
                                                                                        </tr>';
                                                                                        $indice = 0;
                                                                                        for($k=0;$k<3;$k++){                                                                                         
                                                                                            $indice = $indice +1;  
                                                                                            
                                                                                            echo '<tr id="laka" class="cache_'.$numligne.'"">';                                                                                            
                                                                                            echo '<td id="laka" colspan="1" class="cache_'.$numligne.'"" style="border:transparent; background:white"><center></center></td>';
                                                                                            echo '<td id="laka" colspan="2" class="cache_'.$numligne.'"_'.$numligne.'""><center><select id="modCat_'.$indice.''.$numligne.'" name="modCat_'.$indice.''.$numligne.'" style="background:#A9BCF5"><option selected></option>'; 
                                                                                                $reqCateg = 'select Categ from depense order by Categ ASC;';
                                                                                                $resultCateg = mysqli_query($connect,$reqCateg) or exit(mysqli_error($connect));
                                                                                                
                                                                                                while($ree = mysqli_fetch_array($resultCateg, MYSQLI_BOTH)){
                                                                                                    echo '<option value="'.$ree[0].'">'.$ree[0].'</option>';
                                                                                                }                                                                                                                                                                           
                                                                                            echo "</select></center></td>";
                                                                                            echo '<td id="laka" colspan="2" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5" class="cache_'.$numligne.'"" id="modMontant_'.$indice.''.$numligne.'" name="modMontant_'.$indice.''.$numligne.'" type="double" style=" width:125px;height:13px"/></center></td>';
                                                                                            echo '<td id="laka" colspan="1" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5;width:475px" class="cache_'.$numligne.'"" id="modDes_'.$indice.''.$numligne.'" name="modDes_'.$indice.''.$numligne.'" type="text" style=" width:460px;height:13px"/></center></td>';    
                                                                                            echo "</tr>";                                                                                            
                                                                                        }                                                                                        
                                                                                        echo '<input type="hidden" id="indice_'.$numligne.'" name="indice_'.$numligne.'" value="'.$indice.'" />';
                                                                                    }
                                                                                    if($nbFrais>0 && $nbFrais<=3){   
                                                                                        echo '<tr id="kala_'.$numligne.'"">
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="1" style="border:transparent; background:white"><center><b></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="2" style="border:transparent; border-left:1px solid black;"><center><b><font style="color:black">Cat&eacute;gorie des dépenses</font></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="2"><center><b><font style="color:black">Montant des dépenses</font></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="1"><center><b><font style="color:black">Justificatif des dépenses</font></b></center></td>
                                                                                        </tr>';
                                                                                    
//                                                                                    echo '<div id="factContainer" style=" margin-left: 130px;">';
//                                                                                    echo '<table cellspacing="0" cellpadding="0" border="0" width="1122px" id="echeance"> ';
//                                                                                    echo '<center>';                                                                                        
//                                                                                        echo 'nbFrais '.$nbFrais;
                                                                                        $indice = 0;
                                                                                        while($rowQ = $resultS->fetch_array()){                                                                                                                                                                                                                                                                                    
                                                                                            $indice = $indice +1;                                                                                              
                                                                                            echo '<tr id="laka" class="cache_'.$numligne.'"">';
                                                                                            echo '<td id="laka" colspan="1" class="cache_'.$numligne.'"" style="border:transparent; background:white"><center></center></td>';
                                                                                            echo '<input id="reffrais_'.$indice.''.$numligne.'" name="reffrais_'.$indice.''.$numligne.'" type="hidden"  value="'.$rowQ['reffrais'].'" />';
                                                                                            echo '<td id="laka" colspan="2" class="cache_'.$numligne.'"_'.$numligne.'""><center>
                                                                                                <select id="modCat_'.$indice.''.$numligne.'" name="modCat_'.$indice.''.$numligne.'" style="background:#A9BCF5" >'; 
                                                                                                $reqCateg = 'select Categ from depense order by Categ ASC;';
                                                                                                $resultCateg = mysqli_query($connect,$reqCateg) or exit(mysqli_error($connect));
                                                                                                echo '<option></option>';
                                                                                                while($ree = mysqli_fetch_array($resultCateg, MYSQLI_BOTH)){
                                                                                                    echo '<option value="'.$ree[0].'">'.$ree[0].'</option>';
                                                                                                }
                                                                                                ?>
                                                                                                <script>                                                                                    
                                                                                                    var categ = "<?php echo $rowQ['Categorie']; ?>";                                                                                                    
                                                                                                    var indic = "<?php echo $indice; ?>";  
                                                                                                    var ligne = "<?php echo $numligne;?>";
                                                                                                    document.getElementById("modCat_"+indic+ligne).selectedIndex = getIndex(categ, "modCat_"+indic+ligne);
                                                                                                </script>
                                                                                                <?php                                                                            
                                                                                            echo "</select></center></td>";
                                                                                            echo '<td id="laka" colspan="2" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5" class="cache_'.$numligne.'"" id="modMontant_'.$indice.''.$numligne.'" name="modMontant_'.$indice.''.$numligne.'" type="double"  value="'.number_format($rowQ['Montant'], 0, ".", " ").'"" style=" width:125px;height:13px;text-align:center"/></center></td>';
                                                                                            echo '<td id="laka" colspan="1" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5;width:475px" class="cache_'.$numligne.'"" id="modDes_'.$indice.''.$numligne.'" name="modDes_'.$indice.''.$numligne.'" type="text"  value="'.$rowQ['Description'].'" style=" width:460px;height:13px"/></center></td>';    
                                                                                            if($row['Validation']==1){}
                                                                                            else{
                                                                                                echo "<td width=26px style='background-color:#A9BCF5'><a href='#' onclick='if (confirm(\"Etes-vous sur de vouloir supprimer la dépense?\")) {load_page(\"supprimeDep.php?Id=".$rowQ['reffrais']."&indice=".$indice."&ligneNum=".$numligne."\");}'><center><img src='../../images/close_link.png' title='Supprimer'></center></a></td>";
                                                                                            }                                                                                                                                                                                        
                                                                                            echo "</tr>";                                                                                            
                                                                                        }
                                                                                        if($nbFrais==1){                                                                                            
                                                                                            for($p=0;$p<2;$p++){                                                                                         
                                                                                                $indice = $indice +1;  

                                                                                                echo '<tr id="laka" class="cache_'.$numligne.'"">';  
                                                                                                echo '<td id="laka" colspan="1" class="cache_'.$numligne.'"" style="border:transparent; background:white"><center></center></td>';
                                                                                                echo '<td id="laka" colspan="2" class="cache_'.$numligne.'"_'.$numligne.'""><center><select id="modCat_'.$indice.''.$numligne.'" name="modCat_'.$indice.''.$numligne.'" style="background:#A9BCF5"><option selected></option>'; 
                                                                                                    $reqCateg = 'select Categ from depense order by Categ ASC;';
                                                                                                    $resultCateg = mysqli_query($connect,$reqCateg) or exit(mysqli_error($connect));
                                                                                                    while($ree = mysqli_fetch_array($resultCateg, MYSQLI_BOTH)){
                                                                                                        echo '<option value="'.$ree[0].'">'.$ree[0].'</option>';
                                                                                                    }                                                                                                                                                                           
                                                                                                echo "</select></center></td>";
                                                                                                echo '<td id="laka" colspan="2" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5" class="cache_'.$numligne.'"" id="modMontant_'.$indice.''.$numligne.'" name="modMontant_'.$indice.''.$numligne.'" type="double" style=" width:125px;height:13px"/></center></td>';
                                                                                                echo '<td id="laka" colspan="1" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5;width:475px" class="cache_'.$numligne.'"" id="modDes_'.$indice.''.$numligne.'" name="modDes_'.$indice.''.$numligne.'" type="text" style=" width:460px;height:13px"/></center></td>';    
                                                                                                echo "</tr>"; 
                                                                                            }
                                                                                        }
                                                                                        else if($nbFrais==2){                                                                                            
                                                                                            for($p=0;$p<1;$p++){                                                                                         
                                                                                                $indice = $indice +1;  

                                                                                                echo '<tr id="laka" class="cache_'.$numligne.'"">';  
                                                                                                echo '<td id="laka" colspan="1" class="cache_'.$numligne.'"" style="border:transparent; background:white"><center></center></td>';
                                                                                                echo '<td id="laka" colspan="2" class="cache_'.$numligne.'"_'.$numligne.'""><center><select id="modCat_'.$indice.''.$numligne.'" name="modCat_'.$indice.''.$numligne.'" style="background:#A9BCF5"><option selected></option>'; 
                                                                                                    $reqCateg = 'select Categ from depense order by Categ ASC;';
                                                                                                    $resultCateg = mysqli_query($connect,$reqCateg) or exit(mysqli_error($connect));
                                                                                                    while($ree = mysqli_fetch_array($resultCateg, MYSQLI_BOTH)){
                                                                                                        echo '<option value="'.$ree[0].'">'.$ree[0].'</option>';
                                                                                                    }                                                                                                                                                                           
                                                                                                echo "</select></center></td>";
                                                                                                echo '<td id="laka" colspan="2" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5" class="cache_'.$numligne.'"" id="modMontant_'.$indice.''.$numligne.'" name="modMontant_'.$indice.''.$numligne.'" type="double" style=" width:125px;height:13px"/></center></td>';
                                                                                                echo '<td id="laka" colspan="1" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5;width:475px" class="cache_'.$numligne.'"" id="modDes_'.$indice.''.$numligne.'" name="modDes_'.$indice.''.$numligne.'" type="text" style=" width:460px;height:13px"/></center></td>';    
                                                                                                echo "</tr>"; 
                                                                                            }
                                                                                        }
                                                                                        echo '<input type="hidden" id="indice_'.$numligne.'" name="indice_'.$numligne.'" value="'.$indice.'" />';
                                                                                    }                                                                                      
                                                                                }                                                                                
                                                                        }
                                                                        
                                                                        foreach ($montant as $valeur){
                                                                            $depTotal += $valeur;                                                                            
                                                                        }
//                                                                        $numtot = $numligne + 100;                                                                        
//                                                                        $numtot = $numtot + 100;
//                                                                        echo ' numtot total '.$numtot;                                                                                                                                                
                                                                        
                                                                        $rowsm = $kountyTS - $moins;  
//                                                                        echo ' rowsactive(ligne non validé): '.$rowsm.' , moins (ligne validé): '.$moins;
                                                                                                                                                
//                                                                        echo ' kountyTS: ' .$kountyTS .' ligne validé: '.$moins .' ligne non validé: '.$rowsm.' ';
                                                                                                                                                                  
//                                                                        echo '<input type="hidden" id="numtot" name="numtot" value="'.$numtot.'" />';                                                                        
                                                                        for($i = 1; $i <=10; $i++){
                                                                                $numligne = $numligne + 1;    
//                                                                                echo ' pili '.$numligne;
                                                                                echo "<tr id=\"".$numligne."\" onclick=\"afficheDep(this.id);\">";                                                                                                                                                                
                                                                                echo '<td width=50px><input type="text" id="numli[]" name="numli[]" value="'.$numligne.'" readonly="true" style="width:50px;text-align: center"/></td>';
                                                                                
                                                                                if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){
                                                                                    echo '<td width=150px><input class="datepicker"  name="dateMvt[]" type="text" style="width:150px;text-align: center"/></td>';
                                                                                }
                                                                                else{
                                                                                    echo '<td width=150px><input readonly="true" class="datepicker" name="dateMvt[]" type="text" style="width:150px;text-align: center"/></td>';
                                                                                }
                                                                                
                                                                                
                                                                                if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){
                                                                                    echo '<td width=150px>
                                                                                   <select name="codeMission_'.$numligne.'" id="codeMission_'.$numligne.'" onchange="request(this);" style="width:150px;height:22px;border-color: transparent;">	    
                                                                                    <option class="options"></option>';
                                                                                }
                                                                                else{
                                                                                    echo '<td width=150px>
                                                                                   <select name="codeMission_'.$numligne.'" id="codeMission_'.$numligne.'" onchange="request(this);" style="width:150px;height:22px;border-color: transparent;">	    
                                                                                    <option></option>';
                                                                                }

    //                                                                                $reqCdeMission = 'select RefProjet, RefClient, NomProjet from projets '
    //                                                                                        . 'where cloture not in ("1") '
    //                                                                                        . 'order by RefProjet ASC;';
                                                                                    // $reqCdeMission = 'select DISTINCT P.RefProjet, P.RefClient, P.NomProjet nomProjet 
                                                                                    // from deptprojet D
                                                                                    // inner join projets P on (P.RefProjet = D.RefProjet)
                                                                                    // inner join client C on (C.RefClient = P.RefClient)
                                                                                    // where P.cloture <> "1"
                                                                                    // and P.TypeProjet not in ("EXTRA")
                                                                                    // order by 1;';
																					
																											//------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	// RECHERCHE PAR FILTRE DES MISSIONS SELON LE DEPARTEMENT ET LES CONSULTANTS CONSERNES   MODIF RODDY (or JH.RefEmploye = "'.$refEmploye.'" )
																	//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	 //  si ajout filtre																			 
																	if ($refEmploye == "303")
																		{
																			 $reqCdeMission = 'select  distinct JH.RefProjet, P.RefClient, P.NomProjet 	nomProjet, D.Coddept, P.cloture
																			   from jhprevu JH
																			   inner join projets P on (P.RefProjet = JH.RefProjet)
																			   inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																			   inner join client C on (C.RefClient = P.RefClient)
																			   inner join employes E on (E.Coddept = D.Coddept)
																			  
																			   where D.Coddept = "BPH" and P.cloture <> "1"  
																			UNION
																				select P.RefProjet, P.RefClient, P.NomProjet nomProjet , D.Coddept, P.cloture  
																				from deptprojet D
																				inner join projets P on (P.RefProjet = D.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				where D.Coddept = "'.$coddepa.'" and P.cloture <> "1"
																			UNION
																				select  distinct JH.RefProjet, P.RefClient, P.NomProjet nomProjet, D.Coddept, P.cloture
																				from jhprevu JH
																				inner join projets P on (P.RefProjet = JH.RefProjet)
																				inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				inner join employes E on (E.Coddept = D.Coddept)
																				where JH.RefEmploye = "'.$refEmploye.'" and P.cloture <> "1"
																			   ';
																			   
																		
																		}
																		elseif ($refEmploye == "EP02")
																		{
																			$reqCdeMission = 'select  distinct JH.RefProjet, P.RefClient, P.NomProjet 	nomProjet, D.Coddept, P.cloture
																			   from jhprevu JH
																			   inner join projets P on (P.RefProjet = JH.RefProjet)
																			   inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																			   inner join client C on (C.RefClient = P.RefClient)
																			   inner join employes E on (E.Coddept = D.Coddept)
																			  
																			   where D.Coddept = "BPH" and P.cloture <> "1"  
																			UNION
																				select P.RefProjet, P.RefClient, P.NomProjet nomProjet , D.Coddept, P.cloture   
																				from deptprojet D
																				inner join projets P on (P.RefProjet = D.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				where D.Coddept = "'.$coddepa.'" and P.cloture <> "1"
																			UNION
																				select  distinct JH.RefProjet, P.RefClient, P.NomProjet nomProjet, D.Coddept, P.cloture
																				from jhprevu JH
																				inner join projets P on (P.RefProjet = JH.RefProjet)
																				inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				inner join employes E on (E.Coddept = D.Coddept)
																				where JH.RefEmploye = "'.$refEmploye.'" and P.cloture <> "1"
																			   ';
																		}
																		else
																		{
                                                                               $reqCdeMission = '
																				select P.RefProjet, P.RefClient, P.NomProjet nomProjet , D.Coddept, P.cloture   
																				from deptprojet D
																				inner join projets P on (P.RefProjet = D.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				where D.Coddept = "'.$coddepa.'" and P.cloture <> "1"
																			UNION
																				select  distinct JH.RefProjet, P.RefClient, P.NomProjet nomProjet, D.Coddept, P.cloture
																				from jhprevu JH
																				inner join projets P on (P.RefProjet = JH.RefProjet)
																				inner join deptprojet D on (D.RefProjet = JH.RefProjet)
																				inner join client C on (C.RefClient = P.RefClient)
																				inner join employes E on (E.Coddept = D.Coddept)
																				where JH.RefEmploye = "'.$refEmploye.'" and P.cloture <> "1"
																			   ';
																		}
																	//------------------------------------------------------------------------------------------------------------------------------------------------------------------
																	// FIN RECHERCHE PAR FILTRE DES MISSIONS SELON LE DEPARTEMENT ET LES CONSULTANTS CONSERNES
																	//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                                                                    
                                                                                        //if ajout filtre
//                                                                                    $reqCdeMission = 'select P.RefProjet, P.RefClient, P.NomProjet nomProjet 
//                                                                                    from deptprojet D
//                                                                                    inner join projets P on (P.RefProjet = D.RefProjet)
//                                                                                    inner join client C on (C.RefClient = P.RefClient)
//                                                                                    where D.Coddept = "'.$coddepa.'"
//                                                                                    and P.cloture <> "1"
//                                                                                    order by D.RefProjet, C.NomSociete ;';
                                                                                    
                                                                                    $reqCdeMissionList = mysqli_query($connect,$reqCdeMission) or exit(mysqli_error($connect));                                                
                                                                                    while($r = mysqli_fetch_array($reqCdeMissionList, MYSQLI_BOTH)){
//                                                                                        echo '<option value="'.$r[0].'" >'.$r[0].'</option>';
                                                                                        echo '<option class="options" value="'.$r[0].'">'.$r[0].' --- '.$r[2].' --- '.$r[1].'</option>';                                                                              
                                                                                    }
                                                                                    echo '</select>';                                                                                
                                                                                    echo '</td>';

                                                                                    echo '<td width=150px>
                                                                                    <select id="departement_'.$numligne.'" name="departement_'.$numligne.'" style="width:150px;height:22px;border-color: transparent;">
                                                                                    <option></option>';
                                                                                    $codeDeptTS = 'select Coddept from departement order by Coddept ASC';
                                                                                    $reqcodeDeptTS = mysqli_query($connect,$codeDeptTS) or exit(mysqli_error($connect));
    //                                                                                echo '<option></option>';
    //                                                                                while($r = mysqli_fetch_array($reqcodeDeptTS, MYSQL_BOTH)){
    //                                                                                    echo '<option value="'.$r[0].'">'.$r[0].'</option>';
    //                                                                                 }
                                                                                    echo '</select>
                                                                                    </td>';

                                                                                    echo '<td width=50px><input id="ora[]" name="ora[]" style="width:50px;text-align: center"/></td>';                                                                            

                                                                                    if($coddepa === 'BPC'){
                                                                                        echo '<td width=0px>
                                                                                            <select name="description[]" id="description[]" onchange="saisieDesc(this);" style="width:470px;height:22px;border-color: transparent;">	                          
                                                                                                <option selected>'.$row['Description'].'</option>
                                                                                                <optgroup label="Saisie Manuelle">
                                                                                                    <option>Saisir Manuellement</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Choisir dans la liste déroulante">';
                                                                                                    $reqLigneBPC = "select concat(CodeL, ' - ', DescL) as criptdesc from lignebpc order by CodeL;";
                                                                                                    $resLigneBPC = mysqli_query($connect, $reqLigneBPC);
                                                                                                    while($rowBPC = mysqli_fetch_array($resLigneBPC, MYSQLI_BOTH)){
                                                                                                        echo '<option value="'.$rowBPC[0].'">'.$rowBPC[0].'</option>';
                                                                                                    }
                                                                                                echo    '</optgroup>';                                                                                
                                                                                            echo '</select>
                                                                                        </td>';
                                                                                    }
                                                                                    else if($coddepa === 'BPH'){
                                                                                        echo '<td width=0px>
                                                                                            <select name="description[]" id="description[]" onchange="saisieDesc(this);" style="width:470px;height:22px;border-color: transparent;">	                           
                                                                                                <option selected>'.$row['Description'].'</option>
                                                                                                <optgroup label="Saisie Manuelle">
                                                                                                    <option>Saisir Manuellement</option>
                                                                                                </optgroup>
                                                                                                <optgroup label="Choisir dans la liste déroulante">';
                                                                                                    $reqLigneBPH = "select concat(CodeL, ' - ', DescL) as criptdesc from lignebph order by CodeL;";
                                                                                                    $resLigneBPH = mysqli_query($connect, $reqLigneBPH);
                                                                                                    while($rowBPH = mysqli_fetch_array($resLigneBPH, MYSQLI_BOTH)){
                                                                                                        echo '<option value="'.$rowBPH[0].'">'.$rowBPH[0].'</option>';
                                                                                                    }
                                                                                                echo '</optgroup>';                                                                                
                                                                                            echo '</select>
                                                                                        </td>';
                                                                                    }
                                                                                    else{
                                                                                        echo '<td width=0px><input id="description[]" name="description[]" style="width:470px"/></td>';
                                                                                    }
//                                                                                    echo '<td width=26px></td>';
                                                                                    
                                                                                    
                                                                                    
//                                                                                    echo '<td width=26px style="background-color:white;"></td>';
                                                                                    echo '<td width=26px style="background-color:white;"><center><font style="size:26px">☺</font></center></td>';
//                                                                                    echo '<td width=26px style="background-color:white;"></td>';
//                                                                                    echo "<td width=26px><a href='#' onclick='if (confirm(\"Etes-vous sur de vouloir supprimer cette ligne?\")) {load_page(\"supprimeTS.php?Id=".$row['RefFP']."\"); document.location.reload();}'><center><img src='../../images/close_link.png' title='Supprimer'></center></a></td>";                                                                                    
                                                                                    echo "<td width=26px style='background-color:white'><a href='#' onclick='if (confirm(\"Etes-vous sur de vouloir supprimer cette ligne?\")) {load_page(\"supprimeTSLigne.php?Id=".$numligne."\"); }'><center><img src='../../images/close_link.png' title='Supprimer'></center></a></td>";                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                echo '</tr>';
                                                                                
                                                                                echo '<tr id="kala_'.$numligne.'"">
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="1" style="border:transparent; background:white"><center><b></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="2" style="border:transparent; border-left:1px solid black;"><center><b><font style="color:black">Cat&eacute;gorie des dépenses</font></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="2"><center><b><font style="color:black">Montant des dépenses</font></b></center></td>
                                                                                            <td id="laka" class="kala_'.$numligne.'"" colspan="1"><center><b><font style="color:black">Justificatif des dépenses</font></b></center></td>
                                                                                        </tr>';
                                                                                        $indice = 0;
                                                                                        for($k=0;$k<3;$k++){                                                                                         
                                                                                            $indice = $indice +1;  
                                                                                            
                                                                                            echo '<tr id="laka" class="cache_'.$numligne.'"">';  
                                                                                            echo '<td id="laka" colspan="1" class="cache_'.$numligne.'"" style="border:transparent; background:white"><center></center></td>';
                                                                                            echo '<td id="laka" colspan="2" class="cache_'.$numligne.'"_'.$numligne.'""><center><select id="modCat_'.$indice.''.$numligne.'" name="modCat_'.$indice.''.$numligne.'" style="background:#A9BCF5"><option selected></option>'; 
                                                                                                $reqCateg = 'select Categ from depense order by Categ ASC;';
                                                                                                $resultCateg = mysqli_query($connect,$reqCateg) or exit(mysqli_error($connect));                                                                                                
                                                                                                while($ree = mysqli_fetch_array($resultCateg, MYSQLI_BOTH)){
                                                                                                    echo '<option value="'.$ree[0].'">'.$ree[0].'</option>';
                                                                                                }                                                                                                                                                                           
                                                                                            echo "</select></center></td>";
                                                                                            echo '<td id="laka" colspan="2" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5" class="cache_'.$numligne.'"" id="modMontant_'.$indice.''.$numligne.'" name="modMontant_'.$indice.''.$numligne.'" type="double"  style=" width:125px;height:13px"/></center></td>';
                                                                                            echo '<td id="laka" colspan="1" class="cache_'.$numligne.'""><center><input style="background:#A9BCF5;width:475px" class="cache_'.$numligne.'"" id="modDes_'.$indice.''.$numligne.'" name="modDes_'.$indice.''.$numligne.'" type="text" style=" width:460px;height:13px"/></center></td>';    
                                                                                            echo "</tr>";                                                                                            
                                                                                        }                                                                                        
                                                                                        echo '<input type="hidden" id="indice_'.$numligne.'" name="indice_'.$numligne.'" value="'.$indice.'" />';                                                                                
                                                                            }
                                                                            
                                                          
                                                                        
//                                                                        echo '<font style=" position: absolute;  top: 226px; left: 290px; ">'.$depTotal.'</font>';
//                                                                        echo '<font style="text-align: left"><b>D&eacute;pense Totale: </b>Ar '.$depTotal.'</font>';

                                                                        $reqhrTot = 'select sum(HeureFacturables) as sum from heuresfichepointage '
                                                                                    . 'where RefFichePointage = "'.$refFicheR.'"';
                                                                            $rekhrTot = mysqli_query($connect,$reqhrTot) or exit(mysqli_error($connect));
                                                                            $resulthrTot = mysqli_fetch_assoc($rekhrTot);
                                                                            $hrTot = $resulthrTot['sum'];
                                                                            //echo '<font style=" position: absolute;  top: 290px; left: 80px; "><b>Heures Totales: </b>'.$hrTot.'</font>';
//                                                                            echo '<br/><b>Heures Totales: </b>'.$hrTot.'</font>';
                                                                        }                                                                                                                                                                                                                               
                                                                    ?>                                                                
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                if($kountyTS != 0){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <table cellspacing="0" cellpadding="0" border="1" width="1100px"  id="echeance">
                                                            <tr>
<!--                                                                <th class="centre">Ligne</th>                                                                
                                                                <th class="centre">Date </th>
                                                                <th class="centre">Code Mission </th>
                                                                <th class="centre">Departement </th>
                                                                <th class="centre">Heure </th>
                                                                <th class="centre">Description </th>
                                                                <th class="centre">V </th>-->
                                                                <?php
                                                                if($user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu' or $user_agent_name == 'Mozilla Firefox'){                                                                    
                                                                    ?>
                                                                        <td class="deptot" colspan="0" style="border-right: transparent; border-left: transparent">
                                                                            <?php echo '<font style=""><b>D&eacute;pense Totale </b>Ar '.$depTotal.'</font>';?>
                                                                        </td>
                                                                        <td class="heuretot" style="border-right: transparent; border-left: transparent">
                                                                            <?php                                                                     
                                                                                echo '<b>Heures Totales </b></font>';                                                                    
                                                                            ?>
                                                                        </td>
                                                                        <td class="nbhr" style="border-right: transparent; border-left: transparent">
                                                                            <?php                                                                     
                                                                                echo ''.$hrTot;                                                                    
                                                                            ?>
                                                                        </td>                                                                        
                                                                        <td style="border-left: transparent; text-align: right">
                                                                            <?php                             
                                                                                $hm = $nbH-$hrTot;
                                                                                echo '<font style="text-align: left; color: red"><b>Heures manquantes: </b></font><font style="text-align: left; color:red"><b>'.$hm.'</b></font>';                                                                    
                                                                            ?>
                                                                        </td>
                                                                    <?php
                                                                }
                                                                else{                                                                    
                                                                    ?>
                                                                        <td colspan="3" width=250px style=" border-right: transparent; border-left: transparent">
                                                                            <?php echo '<font style="text-align: left"><b>D&eacute;pense Totale </b>Ar '.$depTotal.'</font>';?>
                                                                        </td>
                                                                        <td width=250px style="text-align: right;border-right: transparent; border-left: transparent">
                                                                            <?php                                                                     
                                                                                echo '<b>Heures Totales </b></font>';                                                                    
                                                                            ?>
                                                                        </td>
                                                                        <td colspan="2" width=70px style="text-align: center;border-right: transparent;border-left: transparent">
                                                                            <?php                                                                     
                                                                                echo ''.$hrTot;                                                                    
                                                                            ?>
                                                                        </td>
                                                                        <td width="530px" style="border-left: transparent; text-align: right">
                                                                            <?php                             
                                                                                $hm = $nbH-$hrTot;                                                                                
                                                                                echo '<font style="text-align: left; color: red"><b>Heures manquantes: </b></font><font style="text-align: left; color:red"><b>'.$hm.'</b></font>';                                                                    
                                                                            ?>
                                                                        </td>
                                                                    <?php
                                                                }
                                                                ?>                                                                                                                                                                                                
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                
                                            </table>
                                        </div>                                        
                                        <!--<hr>-->
                                        
                                                                                                               
                                        
                                    </form>                                       
                                <?php
                            }
                        }
                        ?>
                    </div> 
                                    
                                    <div id="cont">
                                    </div>
                    <!-- bottom -->
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
                
                nbClick = 0;
                
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
                
                //tab color
               $('table.monTab tr:nth-child(even)').addClass('style1');
                $('table.monTab tr:nth-child(odd)').addClass('style2');
                
                $(".alert").hide();                  
//                $("#enregistrer").css("display", "none");                
                
                var selected = '<?php echo $periode;?>';
                codeDept = "<?php echo $coddepa;?>";    
                                
                document.getElementById('periode').value = selected; 
                
                //desactiver la modification si tous ligne TS validé
                kountyTS = '<?php echo $kountyTS?>';                                                                               
                
                //disable all TS already validate
                $("table tr:visible input:checked").each(function(){                                        
                    var disCls = 'disabled';
                    var $table = $(this).closest('tr');                                                                                        
                    if ($table.hasClass(disCls)){    
                        return;
                    }                                                                                        
                    $table.addClass(disCls).find('input, select').prop('disabled', true).css('background-color', 'transparent');                                                                                       
//                    $table.css('background-color', '#E0F8E0');                    
                });                                
                
                $("#enregistrer").click(function(e){                                        
                    nbClick = nbClick + 1;
                    
//                    alert("nbClick " +nbClick);
                    
//                    var aa = $("#codeMission_78").val();
                    
                    e.preventDefault();
                    var formData = $("#saisits").serialize();
                //        alert(formData);                
                    
                    $.ajax({                        
                        type: 'POST',
                        url : "insertMvt.php",
                        data: formData,
                        success: function(data){
                            //if(data === "Expired"){
                            if (data === "Expired"){ 
                                alert('Your session has been expired. Please login!!!'); 
                                setTimeout('document.location.href="../../index.php"', 2000);                                 
                            }                            
                            else if (data === "success"){    
                                $("#errorGlobal").css("display", "none");
                                $("#enregistrer").css("display", "none");                                                                                                                                                                                           
//                                $("#saisits").find('input, select').css('background-color', 'white');
                                $("#saisits").find('input, select').attr('disabled', true);
//                                window.location.reload();
                                
                                $("#successGlobal").text("Enregistrement effectué avec succès");  
                                $("#successGlobal").show(500);                       
                                setTimeout('window.location.reload(true)', 2000);  
								
																
                            }
                            else{
//                                alert('nooo');                                                                    
                                $("#successGlobal").css("display", "none");
                                $("#errorGlobal p").text(data);  
                                $("#errorGlobal").text(data);
                                $("#errorGlobal").show(500); 
                                var num = data.indexOf(": ");								
                                if(num===-1){
//                                    alert("oooo");
                                    $('#saisits').find('input, select').attr('disabled','disabled');                                                               
                                    $("#enregistrer").css("display", "none");
                                }
                                else{
                                    var x = num+2;
                                    var y = x+2;                                
                                    var z = parseInt(kountyTS) + 1;                                    
                                    ligneDiso = data.substring(x, y);     
//                                    alert("x: " +x +" y: " +y +" z: " +z +" ligne diso " +ligneDiso);
                                    for(i=0;i<ligneDiso;i++){                                                     
                                        $('#'+i).find('input, select').attr('disabled','disabled');
                                        $('#'+i).find('input, select').css('background-color', 'transparent');
                                    }
                                    $('#'+ligneDiso).find('input, select').css('background-color', '#e7c3c3');                                     
//                                    $('#modCat_'+i+ligneDiso).attr('disabled','disabled');
//                                    $('input[id^="modCat_"]').attr('disabled','disabled');
                                }
                                var depNum = data.indexOf(" ( ");
                                if(depNum===-1){
                                }
                                else{                                    
                                    var m = depNum+2;
                                    var n = m+2;
                                    var depLigneDiso = data.substring(m, n);
                                    alert("lili: " +depLigneDiso +" ligne diso: " +ligneDiso);
                                    for(k=1;k<depLigneDiso;k++){                                                 
                                        $('#modCat_'+k+ligneDiso).attr('disabled','disabled');
                                        $('#modCat_'+k+ligneDiso).css('background-color', 'transparent');                                                                                       										
                                        $('#modMontant_'+k+ligneDiso).attr('disabled','disabled');
                                        $('#modMontant_'+k+ligneDiso).css('background-color', 'transparent');                                                                                       										
                                        $('#modDes_'+k+ligneDiso).attr('disabled','disabled');
                                        $('#modDes_'+k+ligneDiso).css('background-color', 'transparent');                                                                                       										
                                    }                                            
                                    $('#modCat_'+parseInt(depLigneDiso)+ligneDiso).css('background-color', '#e7c3c3');                                                                                       										                                    
                                    $('#modMontant_'+parseInt(depLigneDiso)+ligneDiso).css('background-color', '#e7c3c3');                                                                                       										                                    
                                    $('#modDes_'+parseInt(depLigneDiso)+ligneDiso).css('background-color', '#e7c3c3');                                                                                       										
                                }
                            }
                        }                        
                    });
                });                               
            });                                
            
            function saisieDesc(select){
                if(select.value === 'Saisir Manuellement'){
                    //<input id="description" type="text" name="description" />
                    var description = document.createElement('input');
                    description.setAttribute("id", "description[]");
                    description.setAttribute("name", "description[]");
                    description.setAttribute("type", "text");                    
                    description.setAttribute("style", "width:495px");   
                    select.parentNode.replaceChild(description, select);                    
                }
            }
            
            function getXMLHttpRequest() {
                var xhr = null;
                if (window.XMLHttpRequest || window.ActiveXObject) {
                        if (window.ActiveXObject) {
                                try {
                                        xhr = new ActiveXObject("Msxml2.XMLHTTP");
                                } catch(e) {
                                        xhr = new ActiveXObject("Microsoft.XMLHTTP");
                                }
                        } else {
                                xhr = new XMLHttpRequest(); 
                        }
                } else {
                        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
                        return null;
                }
                return xhr;
            }                        
            
            function request(oSelect, i){                                  
                var value = (oSelect.options[oSelect.selectedIndex].value).replace('+', '%2B');                                
                var xhr   = getXMLHttpRequest();                
                                                               
                xhr.onreadystatechange = function() {
//                    0 = non initialisé ;
//                    1 = ouverture. La méthode open() a été appelée avec succès ;
//                    2 = envoyé. La méthode send() a été appelée avec succès ;
//                    3 = en train de recevoir. Des données sont en train d'être transférées, mais le transfert n'est pas terminé ;
//                    4 = terminé. Les données sont chargées.
                                                            
                    if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
                        readData(xhr.responseXML, i); // FAIRE SORTIR AUTOMATIQUEMENT LE CODE DEPARTEMENT PAR RAPPORT AU CODE MISSION ASSOCIE ----- RODDY RECHERCHE-------
//                        alert("nope");
                    } else if (xhr.readyState < 4) {
//                            alert("yep");
                    }
                }; 
                //value1 = encodeURIComponent(value),               
                xhr.open("POST", "XMLHttpRequest_getListData.php", true);                
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                                                                  
                xhr.send("codeMission=" + value);
                //alert (value);                      
            }            
            
            function readData(oData){                
                var nodes   = oData.getElementsByTagName("item");                                               
                var oSelect = document.getElementById("departement_"+id);
                var oOption, oInner;                                

                oSelect.innerHTML = "";
                for (var i=0, c=nodes.length; i<c; i++) {
                    //alert("pfff");
                    oOption = document.createElement("option");
                    oInner  = document.createTextNode(nodes[i].getAttribute("name"));
                    oOption.value = nodes[i].getAttribute("id");

                    oOption.appendChild(oInner);
                    oSelect.appendChild(oOption);  
                                        
                    oSelect.selectedIndex = getIndex(codeDept, "departement_"+id);                        
                }            
            }
            
            function showFacturation(dateMvt, codeMiss, refFP){                   
                $("#factContainer").load("./getMvtFact.php?dateMvt="+dateMvt+"&codeMiss="+codeMiss+"&refFP="+refFP);
            }                         
            
            function Couleur(id){                
                var nbLigne = '<?php echo $kountyTS;?>';     
                var numLigne = '<?php echo $numtot;?>';                
                this.id = id;                                                                              
                this.couleur = '#D8D8D8';
                
                for(i=1;i<=numLigne;i++){                                     
                    if(i==this.id){                       
//                        alert("iiii" +i);
                        if (typeof this.highlighted==='undefined' || this.highlighted===''){
                            document.getElementById(this.id).style.background = this.couleur;
                            this.highligted=this.id;                            
                        }                        
                    }
                    else{                
//                        alert("oooo" +i);
                        document.getElementById(i).style.background = "transparent";
                    }
                }                                
            }
            
            function afficheDep(li){
                this.id = li;                               
                var nbLigne = '<?php echo $kountyTS;?>';  
                var numLigne = '<?php echo $numtot;?>';                  
                for(i=1;i<=numLigne;i++){
                    if(i==this.id){                        
                        $(".cache_"+i).show();  
                        $(".kala_"+i).show();  
//                        $("#laka").show();  
                    }
                    else{
                        $(".cache_"+i).hide();                        
                        $(".kala_"+i).hide();                        
                    }
                }
            }
            
            function load_page(page) {                
                $("#cont").load(page);
            }
        </script>
    </body>
</html>
