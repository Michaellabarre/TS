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
                        <h1 style="color:#999999; font-weight:bold; font-size:16px;">TIMESHEET FTHM Conseils <font style=" font-size: 10px; color: white">V 3.5</font></h1>
                        
                        <h2><img src="images/auteurforum.png">BIENVENUE</h2>		
                        <p class="grey">Merci de vous connecter avec votre <font color="#FFFFFF">identifiant</font> (le même que pour accéder au serveur) et <font color="#FFFFFF"> mot de passe</font>.</p>
                    </div>

                    <div class="left">
                        <div id="connexion">
                            <br /><b>Identification</b><br /><br />
                            <form action="./includes/process_login.php" method="post" name="login_form">                      
                                <input type="text" name="Nomuser" placeholder="Identifiant (id serveur)"/><br /><br />                
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
                <div class=" manager"><span class=" fieldName"><font class="Style2" size="+1" style="color:#333366;">TIMESHEET FTHM Conseils</font></span><p>Cet outil est aussi disponible depuis l'extérieur de FTHM à l'adresse suivante:</p><font class="Style2">http://smtp1.fthm.mg:8090/TS</div>
                <div class=" module" style="background-image:url(images/logo.jpg);background-repeat:no-repeat; background-position:center; height:"298px"></div>        
                <div class=" copyright"></div>
            </div>    
        </div>
    </body>
</html>


