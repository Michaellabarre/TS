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
    $mysqli->query("SET AUTOCOMMIT=0");
    
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
        $dateChangee = $tab[2]."-".$tab[0]."-".$tab[1];
        return $dateChangee;
    }
    
    function changeDate2($date){
        $tab = explode("-", $date);
        $dateChangee = $tab[2]."-".$tab[1]."-".$tab[0];
        return $dateChangee;
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Nouvelle Mission</title>
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">
        <!-- demo stylesheet -->
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
            #titla{
                color: #0075b0;                
                font-family: serif;
                font-size: 1.1em;
                font-weight: bold;
            }
            
            textarea{
                width: 173px;
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
                margin-right: 80px;            
            }
        </style>
        <script>
$(function(){                  
        var datepicker = function(saisie,envoi){
                saisie.datepicker({
                monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
                dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
                dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
                dateFormat: "DD d MM yy",
                monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                changeMonth: true,
                changeYear: true
                })
                .on('change', function(){
                        var date = $(this).datepicker( "getDate" );
                        date = $.datepicker.formatDate("yy-mm-dd", date);
                        envoi.val(date);
                })
        }
        var form = $('#form1').find("form");
        var saisie = form.find("input[data-picker=picker]");
        var envoi = form.find("input[data-picker=date]");
        if(saisie.length == envoi.length){
                saisie.each(function(i){
                    datepicker($(this),$(envoi[i]));
                });
        }
        else{
                alert('Le nombre de champs de saisie ayant l\'attribut data-picker="picker" est différent du nombre de champs d\'envoi des données ayant l\'attribut data-picker="date"')
        }
});

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
                
                $reqRefEmp = 'select RefEmploye as REF from employes '
                        . 'where Nomuser = "'.$Nomuser.'"';
                $rekRefEmp = mysqli_query($connect,$reqRefEmp);              						
                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                $refEmp = $resultRefEmp['REF'];
            ?>
            
            <div class="bg-help">
                <div class="inBox">
                    <center>
                    <MARQUEE scrolldelay="150"><h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1> </MARQUEE>
                    <!--<a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>          -->          
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
                 <!--   <nav class="menu">  
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
                            <li><a class='tab selected' href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
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
                    </div>                -->
					 </ul>
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>CREATION D'UNE NOUVELLE MISSION</center></b></font>
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
                   compteur.innerHTML="<font style='color: red'><b><i>Attention vous allez être déconnecté dans "+h+":"+m+":"+s+"<br />Passé ce délai toute modification non enregistrée sera perdue</font></b></i>"
             }
             duree=duree-1;
             window.setTimeout("t();",999);
 
         }
		  </script>
<script>
 duree="1800";
                         t();
                 </script>
                    
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                  <!--  </nav> -->
					
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
                            <li><a class='tab selected' href='./nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='./missioncode.php'><span>Modification Mission</span></a></li>                        
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
                    <font style=" color: black"><b><center>CREATION D'UNE NOUVELLE MISSION</center></b></font>
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
                            <li><a class='tab selected' href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Fiche de Mission</span></a></li> 
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='./missioncloture.php'><span>Missions cloturées</span></a></li>-->
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
                    <font style=" color: black"><b><center>INFORMATIONS SUR LES MISSIONS</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
        ?>
                      
        <div id="container" style="max-height: 520px;overflow: scroll; top: 500px">                                    
                <div id="dp">
                        <center>
                            <div>
                    <!-- /top -->
                    <div class="note" id="note"><b><font color="red">Notes:</font></b> 
                        <br/>&emsp; Les champs grisés sont obligatoires
                        <br/>&emsp; Un département, au moins doit être affecté à la mission
                        <br/>&emsp; Les champs « STAT, NIF, CIF et RCS » sont à remplir dans le cas où le type du Client est « Privé »
                    </div>
                    
                    
                        <form name="missionNew" method="post" onsubmit="return verifAll(this)"> 
                            <span id="spann" style="float: right; padding: 8px;"><input type="submit" name="ajouter" disabled="disabled" id="ajouter" value="Ajouter" onmouseover="this.disabled='';"/></span>
                            <!--<span id="spann" style="float: right; padding: 8px;"><input type="submit" disabled="disabled" name="OK" id="OK" value="Valider"  onmouseover="this.disabled='';"/></span>-->
                            <!--<button name="ajouter" id="ajouter" value="Ajouter">Ajouter</button>-->
                            <br/><br/>
                            
                   <table>
                            <tr>                                
                                <td>   
                                    <ul style=" list-style-type: none">
                                        <ul style=" list-style-type: none">
                                            <ul style=" list-style-type: none">
                                                <ul style=" list-style-type: none">
                                                    <ul style=" list-style-type: none">
                                                        <ul style=" list-style-type: none">
                                        <!--<fieldset style="border-color: #F0F5FF">-->
										 <ul style=" list-style-type: none">
                                       <fieldset><legend><b>INFOS CLIENTS</b></legend>                                        
                                        <table>  
                                            <tr>
                                                <td><label>Mission</label></td>
                                                <td><textarea type="text" name="mission" id="mission" style="width:173px" onblur="verifChampNul(this)"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><label>Client</label></td>
                                                <td>                                                                                                        
                                                    <select name="client" id="client" style="width:179px" onblur="verifChampNul(this)" >                                            
                                                        <option ></option>
                                                            <?php        
                                                                $reqListCli = mysqli_query($connect,'select NomSociete '
                                                                    . 'from client '
                                                                    . 'order by NomSociete ASC;') or exit(mysqli_error($connect));

                                                                while($rowCli = mysqli_fetch_array($reqListCli, MYSQLI_BOTH)){
                                                                    echo '<option value="'.$rowCli[0].'" >'.$rowCli[0].'</option>';
                                                                }
                                                            ?>
                                                    </select>
                                                    <script>
                                                        //à la selection d'un client
                                                        $("#client").on('change', function(){
                                                            var client = $("#client").serialize(); 
//                                                            alert(client); 
                                                            
                                                            $.ajax({
                                                                type: 'GET',
                                                                url : "traitement.php",
                                                                data: client,
                                                                success: function(data){                                                                    
                                                                    if (data === "success"){
//                                                                        alert("ok");
                                                                    }
                                                                    else {
//                                                                        alert(data);
                                                                        var donnees = data.valueOf();
//                                                                        alert("donnees: "+donnees);
                                                                        var reg = new RegExp("!");
                                                                        var tab = donnees.split(reg);
                                                                        //tab length = 6
                                                                        var type = tab[0];
                                                                        var stat = tab[1];
                                                                        var nif = tab[2];
                                                                        var cif = tab[3];
                                                                        var rcs = tab[4];                                                                                                                                                
                                                                        
                                                                        document.getElementById('typeClient').value = type;
                                                                        document.getElementById('stat').value = stat;
                                                                        document.getElementById('nif').value = nif;
                                                                        document.getElementById('cif').value = cif;
                                                                        document.getElementById('rcs').value = rcs;
                                                                    }
                                                                },
                                                                error:function(data){
                                                                    alert("error: "+data);                                                                    
                                                                }
                                                            });                                                            
                                                        });
                                                    </script>                                                    
                                                </td>
                                            </tr> 
												<!-- MODIF RODDY AJOUT GROUPE CLIENT-->
											 <tr>
											 <td><label>Groupe Client </label></td>
                                              <td><textarea type="text" name="grclient" id="grclient" style="width:173px" onblur="verifChampNul(this)"></textarea></td>
											<!--  <textarea type="text" name="grclient[]" id="grclient" placeholder = "Groupe 2" style="width:173px" onblur="verifChampNul(this)"></textarea>
											  <textarea type="text" name="grclient[]" id="grclient" placeholder = "Groupe 3"style="width:173px" onblur="verifChampNul(this)"></textarea>
											  <textarea type="text" name="grclient[]" id="grclient" placeholder = "Groupe 4" style="width:173px" onblur="verifChampNul(this)"></textarea></td>-->
                                            </tr>
												<!--MODIF RODDY GROUPE MISSION -->
                                            <tr>
                                                <td><label>Cat&eacute;gorie</label></td>
                                                <td>
                                                    <select name="categorie" id="categorie" style="width:179px" onblur="verifChampNul(this)">
                                                        <option></option>
                                                            <?php
                                                            
                                                                if($prof == 'DAF'){
                                                                    $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null and TypeProjet in ("EXTRA") order by TypeProjet ASC;');
                                                                }
                                                                else{
                                                                    $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null and TypeProjet not in ("DISPO", "QUALITE", "EXTRA") order by TypeProjet ASC;');
                                                                }
//                                                                $reqListCategorie = mysqli_query($connect,'select distinct TypeProjet from projets where TypeProjet is not null and TypeProjet not in ("DISPO", "QUALITE") order by TypeProjet ASC;');
                                                                
                                                                
                                                                while($rowCat = mysqli_fetch_array($reqListCategorie, MYSQLI_BOTH)){
                                                                    echo '<option value="'.$rowCat[0].'" >'.$rowCat[0].'</option>';
                                                                }
                                                            ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Origine </label></td>
                                                <td>
                                                    <select name="origine" id="origine" style="width:179px" onblur="verifChampNul(this)" onchange="saisieOrigine(this);">
                                                        <option selected></option>                                                        
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
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Type</label></td>
                                                <td>
                                                    <textarea type="text" name="typeClient" id="typeClient" readonly style="width:173px" ></textarea>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label id="labstat" for="stat" style=""> STAT</label></td>
                                                <td><textarea type="text" name="stat" id="stat" readonly style="width:173px" ></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><label id="labnif" for="nif" style=""> N.I.F </label></td>
                                                <td><textarea type="text" name="nif" id="nif" readonly style="width:173px" ></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><label id="labcif" for="cif" style=""> C.I.F </label></td>
                                                <td><textarea type="text" name="cif" id="cif" readonly style="width:173px" ></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><label id="labrcs" for="rcs" style=""> R.C.S </label></td>
                                                <td><textarea type="text" name="rcs" id="rcs" readonly style="width:173px" ></textarea></td>
                                            </tr>
                                        </table>  
										</fieldset>
										</ul>
                                    <!--</fieldset>-->
                                                    </ul>
                                                    </ul>
                                            </ul>
                                            </ul>
                                            </ul>
                                    </ul>
                                </td>
                                <td> 
                                    <ul style=" list-style-type: none">
                                    <!--<fieldset style="border-color: #F0F5FF">-->
                                        <Fieldset><legend><b>INFOS CONTRATS</b></legend>
                                        <table>                                        
                                            <tr>
                                                <td>
                                                    <table width = "450px">
                                                        <tr>
                                                            <td><label>Chef de mission FTHM</label></td>
                                                            <td><textarea type="text" name="chef" id="chef" style="width:173px" onblur="verifChampNul(this)"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Date sign.contrat</label></td>                                                           
                                                            <td><input type="text" name="signContrat" style="width:174px" id="signContrat" value=""/></td>                                                                                                                                                                                      
                                                        </tr>
                                                        <tr>
                                                            <td><label>Date d'archivage</label></label></td>                                                            
                                                            <td><input type="text" name="dteArchiv" style="width:174px" id="dteArchiv" /></td>
                                                                
                                                        </tr>
                                                        <tr>
                                                            <td><label>Date d&eacute;but pr&eacute;vu</label></td>                                                            
                                                            <td><input type="text" name="dtePrevu" style="width:174px" id="dtePrevu"  onblur="verifChampNul(this)"/></td>                                                              
                                                        </tr>
                                                        <tr>
                                                            <td><label>Date fin pr&eacute;vue</label></td>                                                            
                                                            <td><input readonly type="text" name="dteFin" id="dteFin" style="width:174px" onblur="verifChampNul(this)"/> </td>                                                                                                                          
                                                        </tr> 
														
														<!-- MODIF RODDY AJOUT lien com et lien contrat -->
														<tr>
                                                            <td><label>Lien vers Proposition Commerciale </label></td>                                                            
                                                            <td><input type="text" name="Liencom" style="width:300px" id="Liencom"  onblur="verifChampNul(this)"/></td>                                                              
                                                        </tr>
														<tr>
                                                            <td><label>Lien vers Contrat </label></td>                                                            
                                                            <td><input type="text" name="Liencontrat" style="width:300px" id="Liencontrat"  onblur="verifChampNul(this)"/></td>                                                              
                                                        </tr>
														<!-- FIN MODIF RODDY AJOUT lien com et lien contrat -->
														
                                                    </table>
                                                </td>
                                                <td>
                                                    <ul style=" list-style-type: none">
                                                    <table  width = "300px">
                                                        <tr>
                                                            <td><label>Date d&eacute;but r&eacute;el</label></td>                                                            
                                                            <td><input type="text" name="dbuReel" id="dbuReel" style="width:174px"/></td>                                                                                                                             
                                                        </tr>
                                                        <tr>
                                                            <td><label>Date fin r&eacute;elle</label></td>                                                            
                                                            <td><input type="text" name="finReel" id="finReel" style="width:174px"/></td>                                                                                                                          
                                                        </tr>
                                                        <tr>
                                                            <td><label>Pays de la mission</label></td>
                                                            <td><input type="text" name="paysMission" id="paysMission" style="width:173px" onblur="verifChampNul(this)"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Ville de la mission</label></td>
                                                            <td><input  type="text" name="villeMission" id="villeMission" style="width:173px" onblur="verifChampNul(this)"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td><label>Avenant </label></td>
                                                            <td>
                                                                <select name="avenant" id="avenant" style="width:179px" onblur="verifChampNul(this)">
                                                                    <option></option>
                                                                        <?php
                                                                            $reqAvenant = mysqli_query($connect,'select distinct Avenantctr from projets where Avenantctr is not null order by Avenantctr ASC;');
                                                                            while($rowAvenant = mysqli_fetch_array($reqAvenant, MYSQLI_BOTH)){
                                                                                echo '<option value="'.$rowAvenant[0].'" >'.$rowAvenant[0].'</option>';
                                                                            }
                                                                        ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labAvenant" for="dteAvenant" style="display: none">Date sign. avenant </label></td>                                                            
                                                            <td><input type="text" name="dteAvenant" id="dteAvenant"  style="display: none; width: 173px"/></td>                                                                                                                           
                                                        </tr>
                                                    </table>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </table>    
										</Fieldset>
                                    <!--</fieldset>-->
                                    </ul>
                                </td>                               
                            </tr>                                
						</table>
						 <!--<ul style=" list-style-type: none">-->
                       <Fieldset> <legend><b>INFOS FACTURATIONS</b></legend>
                        <table>
                            <tr>                                
                                <td>   
                                        <!--<fieldset style="border-color: #F0F5FF">-->
                                        
                                       <!-- <legend><b>Infos Facturation</b></legend>-->
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
                                                </td>
                                            </tr>                                            
                                            <tr>
                                                <td><label>Interloc. Fact.  </label></td>
                                                <td><textarea type="text" name="interFac" id="interFac" style="width:173px" onblur="verifChampNul(this)"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><label>Adresse Fact</label></td>
                                                <td><textarea type="text" name="adresseFact" id="adresseFact" style="width:173px" onblur="verifChampNul(this)"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><label>Coordonn&eacute;es</label></td>
                                                <td><textarea type="text" name="Coord" id="Coord" style="width:173px" onblur="verifChampNul(this)"></textarea></td>
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
                                                            $reqCAExport = mysqli_query($connect, 'select distinct DeviseCa from projets where DeviseCa is not null order by DeviseCa ASC');										
                                                            while($rowCA = mysqli_fetch_array($reqCAExport, MYSQLI_BOTH)){
                                                                echo '<option value="'.$rowCA[0].'" >'.$rowCA[0].'</option>';
                                                            }
                                                        ?>

                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Devise</label></td>
                                            <td>
                                                <select name="devizy" id="devizy" style="width:179px" onblur="verifChampNul(this)" onchange="saisieDevise(this);">   
                                                    <option selected></option>
                                                    <optgroup label="Choisir dans la liste déroulante">;
                                                        <?php
//                                                        $reqDeviseList = mysqli_query($connect,'select distinct Monnaie from projets where Monnaie is not null order by Monnaie ASC;');
                                                        $reqDeviseList = mysqli_query($connect,'select distinct CodeDevise from devise order by CodeDevise ASC;');
                                                            while($rowDevise = mysqli_fetch_array($reqDeviseList, MYSQLI_BOTH)){
                                                                echo '<option value="'.$rowDevise[0].'" >'.$rowDevise[0].'</option>';
                                                            }
                                                        ?>
                                                    </optgroup>
<!--                                                    <optgroup label="Nouvelle Devise">
                                                        <option>Ajouter</option>
                                                    </optgroup>-->
                                                </select> 
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
													<!--<option >Comorienne</option>-->
                                                </select>  
												</td>
                                            </tr>
										<!--FIN MODIF RODDY AJOUT langue-->
										
										
                                        <tr>
                                            <td><label>Type Honoraire </label></td>
                                            <td>
                                                <select name="typehono" id="typehono" style="width:179px" onblur="verifChampNul(this)" onchange="saisieTypeHono(this);">
                                                    <option selected></option>
                                                    <optgroup label="Choisir dans la liste déroulante">;
                                                        <?php
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
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Montant honoraire (HT)</label></td>
                                            <td><input type="double" name="montantHono" id="montantHono" style="width:173px" onblur="verifChampNul(this)"/></td>
                                        </tr>                                                                                                                             
                                    </table>
                                    </ul>
                                </td>
                                <td>
                                    <ul style=" list-style-type: none">
                                        <br><br>
                                    <table>
                                        <tr>
                                            <td><label>Mode facturation </label></td>
                                            <td>
                                                <select name="mod_fac" id="mod_fac" style="width:179px" onblur="verifChampNul(this)" onchange="saisieModeFact(this);">
                                                    <option selected></option>
                                                    <optgroup label="Choisir dans la liste déroulante">;
                                                        <?php
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
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label id="labDeb" for="debPayer">D&eacute;bours &agrave; payer</label></td>
                                            <td>
                                                <select name="debPayer" id="debPayer" style="width:179px" onblur="verifChampNul(this)">
                                                    <option></option>
                                                        <?php
                                                            $reqDebApayer = mysqli_query($connect,'select distinct Deboursrefact from projets where Deboursrefact is not null order by Deboursrefact ASC;');
                                                            while($rowDebPayer = mysqli_fetch_array($reqDebApayer, MYSQLI_BOTH)){
                                                                echo '<option value="'.$rowDebPayer[0].'" >'.$rowDebPayer[0].'</option>';
                                                            }
                                                        ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label id="labDebMod" for="modFact" style="display: none">Mode fact d&eacute;bours </label></td>
                                            <td><textarea type="text" name="modFact" id="modFact" style="display: none;width:173px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td><label id="labMontantDeb" for="montantDeb" style="display: none">Montant d&eacute;bours </label></td>
                                            <td><input type="double" name="montantDeb" id="montantDeb" style="display: none;width:173px"/></td>
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
                                            for ($j; $j<=$nbdep; $j++){
                                                echo '<tr name="'.$j.'">                                        
                                                    <td>';
                                                    if($j == 1){
                                                        echo '        <select class="trans" name="deptList[]" id="deptList[]" style="width:125px" onblur="verifChampNul(this)" >';
                                                    }
                                                    else{
                                                        echo '        <select class="trans" name="deptList[]" id="deptList[]" style="width:125px" >';
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
                                            </tr>
                                            <?php
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
                        <ul style=" list-style-type: none">
                        <br><br>
                        <legend><b>Echéance prévisionnelle de facturation</b></legend>
                        <div style="max-height: 200px;overflow: scroll; max-width: 1070px">
                        <table id="echeance">
                            <tr>
                                <td id="titla" style=" background-color: white"><center>Date échéance</center></td>
                                <td id="titla" style=" background-color: white"><center>Honoraire Débours</center></td>
                                <td id="titla" style=" background-color: white"><center>Intitulé</center></td>
                                <td id="titla" style=" background-color: white"><center>% Contrat</center></td>
                                <td id="titla" style=" background-color: white"><center>Devise</center></td>
                                <td id="titla" style=" background-color: white"><center>Montant Prévisionnel</center></td>
                            </tr>
                            <?php
                            $ligne = 20;
                            $i = 1;
                            for($i; $i<=$ligne;  $i++){
                                echo '<tr name="'.$i.'">';                                                                
                                echo '  <td><input class="datepicker" type="text" name="echeanceDate[]"  /></td>';                                                                    

                                echo '  <td>                                            
                                            <select class="trans" name="honodebours[]" style="width:173px" />';
                                            $ListHonoDebours = 'select distinct Typefac from facturation order by Typefac ASC';
                                            $resultListHonoDeb = mysqli_query($connect,$ListHonoDebours);
                                            while($rowHonoDeb = mysqli_fetch_array($resultListHonoDeb, MYSQLI_BOTH)){
                                                echo '<option value="'.$rowHonoDeb[0].'" >'.$rowHonoDeb[0].'</option>';
                                            }
                                echo '      </select>
                                        </td>
                                        <td><input type="text" name="intitule[]" style="width:190px" /></td>
                                        <td><input type="double" name="PContrat[]" onclick="verifChampDynClear(this)"/></td>
                                        <td>
                                            <select class="trans" name="devise[]" style="width:173px" onchange="saisieDeviseFact(this);">
                                            <option></option>
                                            <optgroup label="Choisir dans la liste déroulante">';
//                                            $listDevise = 'select distinct Monnaie from facturation order by Monnaie ASC;';
                                            $listDevise = 'select distinct CodeDevise from devise order by CodeDevise ASC;';
                                            $resultDevise = mysqli_query($connect,$listDevise);
                                            while($rowDevises = mysqli_fetch_array($resultDevise, MYSQLI_BOTH)){
                                                echo '<option value="'.$rowDevises[0].'" >'.$rowDevises[0].'</option>';
                                            }
                                echo '      </optgroup>';
//                                            <optgroup label="Nouvelle Devise">
//                                                <option>Ajouter</option>
//                                            </optgroup>';
                                echo '      </select>
                                        </td>
                                        <td><input type="double" name="montantPrevisionnel[]" /></td>
                                </tr>';
                            }
                            ?>
                        </table>
                        </div>
                        </ul>
                            
                        </form>
                        <?php
                        
                        if (isset($_POST['ajouter'])){                                                        
                            
                            //infos client
                            $mission = $_POST['mission'];$client = $_POST['client'];$categorie = $_POST['categorie'];
							//MODIF RODDY
							$groupeclient = $_POST['grclient'];
							$liencom =$_POST['Liencom'];
							$liencontrat =$_POST['Liencontrat'];
							$langue = $_POST['langue'];
							//FIN MODIF RODDY
                            $origine = $_POST['origine'];$typeClient = $_POST['typeClient'];$stat = $_POST['stat'];
                            $nif = $_POST['nif'];$cif = $_POST['cif'];$rcs = $_POST['rcs'];
                            //Infos contrat
                            $chef = $_POST['chef'];                                                                                    
                                
                                $signContrat = $_POST['signContrat'];
                                $position = strpos($signContrat, "-");                                
                                if($position === false){
                                    $signContrat = changeDate2(str_replace("/", "-", $signContrat));    
                                }
                                                                                                
                                $dteArchiv = $_POST['dteArchiv'];                            
                                $positionA = strpos($dteArchiv, "-");                                
                                if($positionA === false){
                                    $dteArchiv = changeDate2(str_replace("/", "-", $dteArchiv));
                                }                                
                                
                                $dtePrevu = $_POST['dtePrevu'];
                                $positionP= strpos($dtePrevu, "-"); 
                                if($positionP === false){
                                    $dtePrevu = changeDate2(str_replace("/", "-", $dtePrevu));
                                }
                                
                                $dteFin = $_POST['dteFin'];
                                $positionF= strpos($dteFin, "-"); 
                                if($positionF === false){
                                    $dteFin = changeDate2(str_replace("/", "-", $dteFin));
                                }                                                                                                
                                
                                $dbuReel = $_POST['dbuReel'];
                                $positionD= strpos($dbuReel, "-"); 
                                if($positionD === false){
                                    $dbuReel = changeDate2(str_replace("/", "-", $dbuReel));
                                }                                            
                                
                                $finReel = $_POST['finReel'];
                                $positionR= strpos($finReel, "-"); 
                                if($positionR === false){
                                    $finReel = changeDate2(str_replace("/", "-", $finReel));
                                }                                
                                
                                $dteAvenant = $_POST['dteAvenant'];
                                $positionAv= strpos($dteAvenant, "-"); 
                                if($positionAv === false){
                                    $dteAvenant = changeDate2(str_replace("/", "-", $dteAvenant));
                                }                                  
                            
                            

                            
                            
                            $paysMission = $_POST['paysMission'];$villeMission = $_POST['villeMission'];
                            $avenant = $_POST['avenant'];
                            
                            //infos facturation
                            $refSoc = $_POST['refSoc'];$interFac = $_POST['interFac'];$adresseFact = $_POST['adresseFact'];
                            $Coord= $_POST['Coord'];$CA = $_POST['CA'];
                            
                            $devizy = $_POST['devizy'];
                            $typehono = $_POST['typehono'];
                            $montantHono = str_replace(" ", "", $_POST['montantHono']);                            
                            $mod_fac = $_POST['mod_fac'];
                            $debPayer = $_POST['debPayer'];$modFact = $_POST['modFact'];
                            $montantDeb = str_replace(" ", "", $_POST['montantDeb']);                            
                            
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
                            
                            if(empty($_POST['dbuReel'])){
                                $dbuReel = '0000-00-00';
                            }
                            
                            if(empty($_POST['finReel'])){
                                $finReel = '0000-00-00';
                            }
                            
                            if(($avenant == 'OUI')&&(empty($_POST['dteAvenant']))){
                                $dteAvenant = '0000-00-00';
                            }
                            
                            //info facturation
                            if($debPayer == 'NON'){
                                $montantDeb = 0;
                            }                                                        
                            
                            if(($debPayer == 'OUI')&&(empty($_POST['montantDeb']))){
                                $montantDeb = 0;
                            }                                                                                   
//                            //Infos Client ECHO
//                            echo '<br/><br/>Infos Client';
//                            echo '<br> mission: '.$mission;echo  '<br> client: '.$client;echo  '<br>categorie:  '.$categorie;
//                            echo  '<br>origine:  '.$origine;
//                            echo  '<br>typeClient:  '.$typeClient;echo  '<br>stat:  '.$stat;echo  '<br>nif:  '.$nif;echo  '<br>cif:  '.$cif;
//                            echo  '<br>rcs:  '.$rcs;
//                            //Infos Contrat
//                            echo '<br/><br/>Infos contrat';
//                            echo  '<br>chef:  '.$chef;echo  '<br>signContrat:  '.$signContrat;echo  '<br>dteArchiv:  '.$dteArchiv;
//                            echo  '<br>dtePrevu:  '.$dtePrevu;echo  '<br>dteFin:  '.$dteFin;echo  '<br>dbuReel:  '.$dbuReel;
//                            echo  '<br>finReel:  '.$finReel;
//                            echo  '<br>paysMission:  '.$paysMission;echo  '<br>villeMission:  '.$villeMission;echo  '<br>avenant:  '.$avenant;
//                            echo  '<br>dteAvenant:  '.$dteAvenant;                                                        
//                            //Infos facturation
//                            echo '<br/><br/>Infos facturation';
//                            echo '<br/>refSoc :'.$refSoc;echo '<br/>interFac :'.$interFac;echo '<br/>adresseFact :'.$adresseFact;
//                            echo '<br/>Coord :'.$Coord;echo '<br/>CA :'.$CA;echo '<br/>devizy :'.$devizy;
//                            echo '<br/>typehono :'.$typehono;echo '<br/>montantHono :'.$montantHono;echo '<br/>mod_fac :'.$mod_fac;
//                            echo '<br/>debPayer :'.$debPayer;echo '<br/>modFact :'.$modFact;echo '<br/>montantDeb :'.$montantDeb;                                                                                                                
                            $reqRefCli = 'select RefClient as REF from client where NomSociete="'.$client.'"';
                            $rekRefCli = mysqli_query($connect,$reqRefCli);											
                            $resultRefCli = mysqli_fetch_assoc($rekRefCli);
                            $CliRef = $resultRefCli['REF'];
                            
                            $reqRefSoc = 'select RefSociete as SOC from societe where NomSociete = "'.$refSoc.'"';
                            $rekRefSoc = mysqli_query($connect,$reqRefSoc);											
                            $resultReSoc = mysqli_fetch_assoc($rekRefSoc);
                            $RefSoc = $resultReSoc['SOC'];
                            
/**DEBUT AJOUT AUTOMATIQUE DU CODE MISSION***/
                            $reqYear  = 'select YEAR(CURRENT_DATE()) as taona ;';
                            $resYear  = mysqli_query($connect, $reqYear) or exit(mysqli_error($connect));
                            $resTaona = mysqli_fetch_assoc($resYear);
                            $taona = $resTaona['taona'];
//                            echo '<br/>taona: '.$taona; 
//                            echo '<br/>client: '.$CliRef; 
                            
                            $annee = substr($taona, -2, 2);
//                            echo '<br/>année de la mission: '.$annee;                                                        
                            
                            $reqCount = 'select count(1) as count from projets
                                    inner join client on (client.RefClient = projets.RefClient)
                                    where client.RefClient = "'.$CliRef.'";';
                            $reqCounts = mysqli_query($connect,$reqCount);											
                            $resultCount = mysqli_fetch_assoc($reqCounts);
                            $count = $resultCount['count'];
//                            echo '<br/>count client '.$count; 
                            
                            if($count == 0){                         
                                $rang = "01";
                                $cdeMission = $CliRef.$rang.$annee;
                            }
                            else if($count > 0){                                
                                $currentCode = $CliRef."%".$annee;
//                                echo '$currentCode '.$currentCode;                                
                                $reqMaxCode = 'select max(RefProjet) as max from projets
                                    inner join client on (client.RefClient = projets.RefClient)
                                    where client.RefClient like "'.$CliRef.'" and 
                                    projets.RefProjet like "'.$currentCode.'" ';
                                $resMaxCode  = mysqli_query($connect, $reqMaxCode) or exit(mysqli_error($connect));
                                $resMax = mysqli_fetch_assoc($resMaxCode);
                                $max = $resMax['max'];
//                                echo '<br/>max: '.$max; 
                                
                                $version = substr($max, -4, 2)+1;
                                if($version<10){
                                    $rang = substr_replace("0", $version, strlen($version));
                                }
                                else{
                                    $rang = $version;
                                }                                
//                                echo '<br/>rang: '.$rang;
                                $cdeMission = $CliRef.$rang.$annee;
                                $cdeMission = strtoupper($cdeMission);                                                                   
                            }
                            
/**FIN AJOUT AUTOMATIQUE DU CODE MISSION***/                            
/****************DEBUT INSERTION DANS LA TABLE PROJET****************************************/

                            $reqInsertProjet = 'insert into projets'
                                    . ' (RefProjet, NomProjet, RefClient, GroupeCli, TypeProjet, Origine, cloture, '
                                    . ' Datesignature, Datearchctr, Avenantctr, Datesignaven, Paysmission, Villemission, Chefmission, DateDebutProjet, DateFinProjet, DateDebutR, DateFinR, LienCom, LienContrat,'
                                    . ' typeclient, stat, nif, cif, rcs,'
                                    . ' RefSociete, DeviseCa, Reftypehono, Modefachono, Deboursrefact, Modefacdebour, Interlocfacture, Adressefacture, Monnaie, Langue, EstimationCoutTotalProjet, EstimationCoutDebours, Coordoninterloc, Abonnement, datemodification, nombremodification, usermodif, UT) values'
                                    . ' ("'.$cdeMission.'", "'.$mission.'", "'.$CliRef.'", "'.$groupeclient.'", "'.$categorie.'", "'.$origine.'", 0, '                                    
                                    . ' "'.$signContrat.'", "'.$dteArchiv.'", "'.$avenant.'", "'.$dteAvenant.'", "'.$paysMission.'", "'.$villeMission.'", "'.$chef.'", "'.$dtePrevu.'", "'.$dteFin.'", "'.$dbuReel.'", "'.$finReel.'","'.$liencom.'", "'.$liencontrat.'" ,'
                                    . ' "'.$typeClient.'", "'.$stat.'", "'.$nif.'", "'.$cif.'", "'.$rcs.'", '
                                    . ' "'.$RefSoc.'", "'.$CA.'","'.$typehono.'","'.$mod_fac.'","'.$debPayer.'","'.$modFact.'","'.$interFac.'","'.$adresseFact.'","'.$devizy.'","'.$langue.'","'.$montantHono.'","'.$montantDeb.'","'.$Coord.'", 0 , NOW(), 0, "'.$refEmp.'", NOW())';
                            
                            $reqProjet = mysqli_query($connect,$reqInsertProjet) or exit(mysqli_error($connect));                                                          
                            
/****************FIN INSERTION DANS LA TABLE PROJET****************************************/                             
                            
                        if($reqProjet){
/****************DEBUT INSERTION DANS LA TABLE deptprojet****************************************/                             
                            //affectation departement
//                            echo '<br/><br/>Affectation departement';
                            for ($j=0; $j<$nbdep; $j++){
                                if(empty($_POST['deptList'][$j])or empty($_POST['managerList'][$j]) or empty($_POST['assocList'][$j])){                                    
                                    break;
                                }
                                else{                                    
                                    $deptList    = $_POST['deptList'][$j];
                                    $managerList = $_POST['managerList'][$j];
                                    $assocList   = $_POST['assocList'][$j];
                                    //code departement par ligne                                    
                                    $reqCoddep    = 'select Coddept as DEP from departement where Departement = "'.$deptList.'"';
                                    $rekCoddep    = mysqli_query($connect,$reqCoddep);
                                    $resultCoddep = mysqli_fetch_assoc($rekCoddep);
                                    $coddep[$j]   = $resultCoddep['DEP'];
                                    //manager par departement par ligne
                                    $reqEmp    = 'select RefEmploye as EMP from employes where Prenom = "'.$managerList.'"';
                                    $rekEmp    = mysqli_query($connect,$reqEmp);
                                    $resultEmp = mysqli_fetch_assoc($rekEmp);
//                                    $emp[$j]   = $resultEmp['EMP'];
                                    $emp[$j]   = $_POST['managerList'][$j];
                                    //associé par departement par ligne
                                    $reqEmpl    = 'select RefEmploye as EMPL from employes where Prenom = "'.$assocList.'"';
                                    $rekEmpl    = mysqli_query($connect,$reqEmpl);
                                    $resultEmpl = mysqli_fetch_assoc($rekEmpl);
//                                    $empl[$j]   = $resultEmpl['EMPL'];
                                    $empl[$j]   = $_POST['assocList'][$j];
                                    
//                                    echo '<br/>departement: '.$coddep[$j].' manager: '.$emp[$j].' associé: '.$empl[$j];
                                    
                                    $reqinsertDeptprojet = 'insert into deptprojet '
                                    . '(RefProjet, Coddept, Respvalid, Dirmission, datemodification, nombremodification, usermodif) values '
                                    . '("'.$cdeMission.'", "'.$coddep[$j].'", "'.$emp[$j].'", "'.$empl[$j].'", NOW(), 0, "'.$refEmp.'")';                                    
                                    $reqDeptprojet = mysqli_query($connect,$reqinsertDeptprojet);
                                    if(!$reqDeptprojet){
                                        ?>
                                            <script>
                                                document.missionNew.style.display = 'none';
                                                $('#note').css("display", "none");
                                            </script>
                                        <?php 
                                        echo '<font color="red"><b>Erreur au niveau: Affectation Département</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                        $mysqli->query("ROLLBACK");
//                                        exit(1);
                                    }
                                }
                            }
                            
/****************FIN INSERTION DANS LA TABLE deptprojet****************************************/                             
/****************DEBUT INSERTION DANS LA TABLE jhprevu****************************************/
                            //intervenants
//                            echo '<br/><br/>Intervenants'; 
                            $k = 0;
                            for($k; $k<20; $k++){
                                if(($_POST['nameCons'][$k] == '') or ($_POST['prof'][$k]== '')or ($_POST['nbJH'][$k] == '') or ($_POST['tarifJH'][$k] == '')){                                    
                                    break;
                                }
//                                if(empty($_POST['nameCons'][$k]) or empty($_POST['prof'][$k])or empty($_POST['nbJH'][$k]) or empty($_POST['tarifJH'][$k])){                                    
//                                    break;
//                                }
                                else{   
                                    $cons = array();
                                    $Pro = array();
                                    $nbJH = array();
                                    $tarifJH =  array();
                                    
                                    $nameCons    = $_POST['nameCons'][$k];
                                    $prof        = $_POST['prof'][$k];
                                    //nbJH par ligne
                                    $nbJH[$k]    = $_POST['nbJH'][$k];
                                    //montant par ligne
                                    $tarifJH[$k] = str_replace(" ", "", $_POST['tarifJH'][$k]);
                                    //consultant par ligne
                                    $reqCons = 'select RefEmploye as consu from employes where prenom = "'.$nameCons.'"';
                                    $rekCons = mysqli_query($connect,$reqCons);
                                    $resultCons = mysqli_fetch_assoc($rekCons);
//                                    $Cons[$k] = $resultCons['consu'];
                                    $Cons[$k] = $_POST['nameCons'][$k];
                                    //profil par ligne
                                    $reqPro = 'select Protarif as PR from protarif where Protarif="'.$prof.'"';
                                    $rekPro = mysqli_query($connect,$reqPro);
                                    $resultPro = mysqli_fetch_assoc($rekPro);
                                    $Pro[$k] = $resultPro['PR'];       
                                    
//                                    echo '<br/>cons: '.$Cons[$k].' prof: '.$Pro[$k].' nbJH: '.$nbJH[$k].' montant: '.$tarifJH[$k];
                                                                        
                                    $reqInsertJhprevu = 'insert into jhprevu '
                                        . '(RefProjet        , RefEmploye     , Protarif      , NombreJH       , TarifJH           , datemodification, nombremodification, usermodif    ) values '
                                        . '("'.$cdeMission.'", "'.$Cons[$k].'", "'.$Pro[$k].'", "'.$nbJH[$k].'", "'.$tarifJH[$k].'", NOW()           , 0                 , "'.$refEmp.'")';
                                    $reqJhprevu = mysqli_query($connect,$reqInsertJhprevu);
                                    if(!$reqJhprevu){
                                        ?>
                                            <script>
                                                document.missionNew.style.display = 'none';
                                                $('#note').css("display", "none");
                                            </script>
                                        <?php 
                                        echo '<font color="red"><b>Erreur au niveau: Ajout des intervenants</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                        $mysqli->query("ROLLBACK");
//                                        exit(1);
                                    }
                                }
                            }
//                            if(!$reqInsertJhprevu){
//                                echo 'Intervenants Erreur: '.mysqli_error($connect);
//                                $mysqli->query("ROLLBACK");exit(1);
//                            }
/****************FIN INSERTION DANS LA TABLE jhprevu****************************************/                            
/****************DEBUT INSERTION DANS LA TABLE facturation****************************************/ 
                            //echeance previsionnelle de facturation   
//                            echo '<br/><br/>echeance previsionnelle';                                                        
                            $l = 0;
                            for($l; $l<=20;  $l++){                                                                 
//                                if(empty($_POST['echeanceDate'][$l]) or empty($_POST['honodebours'][$l]) or empty($_POST['intitule'][$l])
//                                        or empty($_POST['PContrat'][$l]) or empty($_POST['devise'][$l]) or empty($_POST['montantPrevisionnel'][$l])){                                                                        
//                                    break;
//                                }
                                if(($_POST['echeanceDate'][$l] == '') or ($_POST['honodebours'][$l] == '') or ($_POST['intitule'][$l] == '')
                                    or ($_POST['PContrat'][$l] == '') or ($_POST['devise'][$l] == '') or ($_POST['montantPrevisionnel'][$l] == '')){                                                                        
                                    break;
                                }
                                
                                else{                                       
                                    
                                        $echeanceDate[$l] = $_POST['echeanceDate'][$l];                                          
                                        $positionX = strpos($echeanceDate[$l], "-");                                
                                        if($positionX === false){
                                            $echeanceDate[$l] = changeDate2(str_replace("/", "-", $echeanceDate[$l]));                                            
                                        }
                                        
                                    
                                    
                                    
                                    $honodebours[$l] = $_POST['honodebours'][$l];                                    
                                    $intitule[$l] = $_POST['intitule'][$l];                                    
                                    $PContrat[$l] = $_POST['PContrat'][$l];
                                    $devise[$l] = $_POST['devise'][$l];                                    
                                    $montantPrevisionnel[$l] = str_replace(" ", "", $_POST['montantPrevisionnel'][$l]);
                                    $reqIdAuto = 'select max(Idauto) as idauto from facturation;';
                                    $rekIdAuto = mysqli_query($connect,$reqIdAuto);
                                    $resultIdAuto = mysqli_fetch_assoc($rekIdAuto);
                                    $idAuto = $resultIdAuto['idauto'] + 1;
                                    
//                                    echo '<br/><br/>echeance Date: '.$echeanceDate[$l].' honodebours: '.$honodebours[$l].' intitulé: '.$intitule[$l]
//                                            .' Pcontrat: '.$PContrat[$l].' devise '.$devise[$l].' montantP: '.$montantPrevisionnel[$l];
//                                    echo ' id auto: '.$idAuto;                                                                        

                                    $reqinsertFacturation = 'insert into facturation '
                                        . '(Idauto       , RefProjet        , Echeance               , Typefac               , Libelle            , Pcontrat           , Monnaie          , Montant                       , datemodification, nombremodification, usermodif    ) values '
                                        . '("'.$idAuto.'", "'.$cdeMission.'", "'.$echeanceDate[$l].'", "'.$honodebours[$l].'", "'.$intitule[$l].'", "'.$PContrat[$l].'", "'.$devise[$l].'", "'.$montantPrevisionnel[$l].'", NOW()           , 0                 , "'.$refEmp.'")';                                                        
                                    $reqfacturation = mysqli_query($connect,$reqinsertFacturation);
                                    if(!$reqfacturation){
                                        ?>
                                            <script>
                                                document.missionNew.style.display = 'none';
                                                $('#note').css("display", "none");
                                            </script>
                                        <?php 
                                        echo '<font color="red"><b>Erreur au niveau: Ajout des écheances prévisionnelle</b></font> <br/><ul>'.mysqli_error($connect).'</ul>';
                                        $mysqli->query("ROLLBACK");
//                                        exit(1);
                                    }
                                }
                            }
/****************FIN INSERTION DANS LA TABLE facturation****************************************/                            
                        }                        
                        
                        if((($reqProjet) and ($reqDeptprojet)) or (($reqJhprevu) or ($reqfacturation)) ) {
                            ?>
                                <script>
                                    document.missionNew.style.display = 'none';
                                    $('#note').css("display", "none");
                                </script>
                            <?php                                                      
                            echo '<br/><br/><br/><center><font color="green"><b>Nouveau projet - '.$cdeMission.' - cr&eacute;&eacute; avec succ&egrave;s.</b></font></center><br/>';
                            echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
                            $mysqli->query("COMMIT");
                        }
                        else{
                            echo '<font color="red"><b>La mission n\'a pas pu être cr&eacute;&eacute;e.Veuillez contacter l\'Administrateur.</b></font>';
                            $mysqli->query("ROLLBACK");
                            exit(1);
                        }
                        }
                        ?>
                            </div>
                        </center>
                    </div>               
                    <!-- bottom -->
                
            
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
                        $(this).height(60);
                        $(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
                    });
                    
                    $("textarea").blur(function(e){
                        $(this).height(16);
//                        $(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
                    });
                    
                    if($('#ajouter').is(':disabled')){
//                        alert("disa");                        
                        $('#spann').bind({
                            mouseenter: function(e) {
                                // Hover event handler
                                $('#ajouter').attr('disabled', false);                                  
                            },
                            mouseleave: function(e) {                                
                            },
                            click: function(e) {                                
                            },
                            blur: function(e) {                                                                
                            }
                       });
                    }
                    else{
//                        $('#spann').bind('mouseover mouseout');
                    }                                        
                    
                    $('#spann').on('mouseover', function(){
                        $('#spann').unbind('mouseover mouseout');
                    });

                    $('#ajouter').on('mouseout', function(){                        
                        $('#ajouter').attr('disabled', 'disabled');                            
                    });
                    
                    var user_agent_name = '<?php echo $user_agent_name;?>';
                    var ligne = '<?php echo $ligne;?>';					
                    
                        $("#signContrat").datepicker({
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
                    
                    //griser les champs obligatoires                    
                    $('#mission').css('background-color', '#F2F1EB');
                    $('#client').css('background-color', '#F2F1EB');
                    $('#categorie').css('background-color', '#F2F1EB');
                    $('#origine').css('background-color', '#F2F1EB');
//                    $('#typeClient').css('background-color', '#F2F1EB');
                    $('#chef').css('background-color', '#F2F1EB');
                    $('#dtePrevu').css('background-color', '#F2F1EB');
                    $('#dteFin').css('background-color', '#F2F1EB');
                    $('#paysMission').css('background-color', '#F2F1EB');
                    $('#villeMission').css('background-color', '#F2F1EB');
                    $('#avenant').css('background-color', '#F2F1EB');
                    $('#refSoc').css('background-color', '#F2F1EB');
                    $('#interFac').css('background-color', '#F2F1EB');
                    $('#adresseFact').css('background-color', '#F2F1EB');
                    $('#Coord').css('background-color', '#F2F1EB');
                    $('#CA').css('background-color', '#F2F1EB');
                    $('#devizy').css('background-color', '#F2F1EB');
                    $('#typehono').css('background-color', '#F2F1EB');
                    $('#montantHono').css('background-color', '#F2F1EB');
                    $('#mod_fac').css('background-color', '#F2F1EB');
                    $('#debPayer').css('background-color', '#F2F1EB');  
                    
                    deptListNb = document.getElementsByName('deptList[]');                                        
                    deptListNb[0].style.backgroundColor = "#F2F1EB";
                    managerListNb = document.getElementsByName('managerList[]');                                        
                    managerListNb[0].style.backgroundColor = "#F2F1EB";
                    assocListNb = document.getElementsByName('assocList[]');                                        
                    assocListNb[0].style.backgroundColor = "#F2F1EB";
                                                                              
                    
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
//                    alert("longeur deplista " + long1 +" longeur managerlist: " + long2 +" longeur assoclist: " + long3);
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
//                    alert("longeur deplist " + long);
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
//                    $typecli = $("#typeClient").val();
//                    if($typecli === 'Privé'){
//                        var stat = verifChampNul(f.stat);
//                        var nif = verifChampNul(f.nif);
//                        var cif = verifChampNul(f.cif);
//                        var rcs = verifChampNul(f.rcs);
//                    }                    
                    
//                   var cdeMission = verifChampNul(f.cdeMission);
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

//                    if($typecli === 'Privé'){                        
//                        if(
//                                stat &&
//                                nif &&
//                                cif &&
//                                rcs &&
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
//                            return true;
//                        }
//                        else{
//                           alert("Veuillez remplir correctement tous les champs.");                      
//                           return false;
//                        }
//                    }
//                    else{
                        if(/*cdeMission && */mission && client && categorie && origine  && avenant && paysMission && villeMission
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
            </script>
    </body>
</html>
