<?php
    header ('Content-type:text/html; charset=utf-8');

    require_once './includes/db_connect.php';
    require_once './includes/functions.php';
    
    ini_set('display_errors', 0);    
    ini_set('log_errors', 1);    
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');    
    //error_reporting(e_all);

    sec_session_start();

    if (login_check($mysqli) == true) {    
        $logged = 'in';
    } else {    
        $logged = 'out';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="./logo/fthm.ico" type="image/x-icon" />
        <meta http-equiv="content-type" content="text/html" charset="utf-8" />
        <title>Identification</title>                
        <script type="text/javascript" src="jquery/jquery.js"></script>
        <script type="text/JavaScript" src="jquery/forms.js"></script> 
        <script type="text/JavaScript" src="jquery/sha512.js"></script>                      		
        <script type="text/javascript" src="js/slide.js"></script>
        <script type="text/javascript" src="jquery/alert.js"></script>
        
        <link rel="stylesheet" href="jquery/alert.css" />
        <link href="styles/template.css" rel="stylesheet" type="text/css">
        <link href="styles/home.css" rel="stylesheet" type="text/css">
        <link href="styles/slide.css" rel="stylesheet" type="text/css" media="screen">
      
        <style type="text/css">        
            .Style2 {
                font-family : "Lucida Console";
                font-weight : bold;
            }        
        </style>
        
    </head>
    
    <body >    
        <div id="toppanel">
            <div id="panel">
                <div class="content clearfix">
                    <div class="left">
                        <h1 style="color:#999999; font-weight:bold; font-size:16px;">TIMESHEET FTHM Consulting <font style=" font-size: 10px; color: white">V 4</font></h1>
                        
                        <h2><img src="images/auteurforum.png">BIENVENUE</h2>		
                        <p class="grey">Merci de vous connecter avec votre <font color="#FFFFFF">identifiant</font> et <font color="#FFFFFF"> mot de passe  (le même que pour accéder au serveur)</font>.</p>
                    </div>

                    <div class="left">
                        <div id="connexion">
                            <br /><b>Authentification</b><br /><br />
                            <form action="./includes/process_login.php" method="post" name="login_form">                      
                                <input type="text" name="Nomuser" placeholder="Login (id serveur)"/><br /><br />                
                                <input type="password" name="password" id="password" placeholder="Mot de passe"/><br /><br />
                                <input type="submit" value="Connexion" onclick="formhash(this.form, this.form.password);" />                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <!-- The tab on top -->	
            <div class="tab">
                <ul class="login">
                    <li class="left">&nbsp;</li>
                    <li>Connexion utilisateur!</li>
                    <li class="sep"></li>
                    <li id="toggle">
                        <a id="open" class="open" href="#"> Ouvrir </a>
                        <a id="close" style="display: none;" class="close" href="#"> Fermer </a>			
                    </li>
                    <li class="right">&nbsp;</li>
                </ul> 
            </div> <!-- / top -->
        </div>
        
		<script>
			
			
			
		</script>
		
        <div id="page" style="-moz-border-radius: 6px 6px 6px 6px; opacity:0.92; filter:alpha(opacity=92); size:landscape;">
            <div id="home">             
                <?php
                    if (isset($_GET['error'])) {
						?>

						<script type="text/javascript">
							alert('Merci de vérifier votre identifiant et/ou mot de passe!','Login et/ou mot de passe eroné');
							
                        </script>
                        <?php
                    }
                ?>
					<center><img src="./images/time-sheet-logo.gif" border="0" width="253" height="118" align="absmiddle"></center>
                <!--<div class=" manager" ><img src="./images/time-sheet-logo.gif" border="0" width="253" height="118" align="absmiddle"></div>-->
                <div class=" module" style="background-image:url(images/logo_fthm.jpg);background-repeat:no-repeat; background-position:center; height="248px" ></div>        
                <div class=" copyright"></div>
				<p><MARQUEE BGCOLOR = "yellow" SCROLLDELAY="150"  onmouseover="this.stop()" onmouseout="this.start()"><i>Cet outil est aussi disponible depuis l'extérieur de FTHM à l'adresse suivante: <b><font class="Style2">http://smtp1.fthm.mg:8090/TS</b></i></MARQUEE>
            </div>    
        </div>
    </body>
</html>


<!--<p><span class=" fieldName"><font class="Style2" size="+1" style="color:#333366;">TIMESHEET FTHM Consulting</font></span></p>-->
