<!DOCTYPE html>

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


<html>
    <head>
        <title>Modifier Consultant</title>
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">
        <!-- demo stylesheet -->
        <link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../../includes/db_connect.php" />
        <script src="../../jquery/jquery-1.8.1.min.js" type="text/javascript"></script>           
        <script src="../../jquery/jquery-ui-1.11.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="../../jquery/jquery-ui-1.11.2/jquery-ui.css" />
               
        <style type="text/css"> 
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
                
            }            
            #modifier{
                margin-right: 1030px;            
            }
            #valider{
                margin-right: 70px;            
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
                
                $reqRefEmp = 'select RefEmploye as REF from employes '
                        . 'where Nomuser = "'.$Nomuser.'"';
                $rekRefEmp = mysqli_query($connect,$reqRefEmp);              						
                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                $refEmp = $resultRefEmp['REF']; 
            ?>
            
            <div class="bg-help">
                <div class="inBox">
                    <center>
                    <h1 id="logo"><?php echo '<b><i>'.$prenom.' '.$nom.'</i></b>'; ?></h1> 
                    <a href="../../logout.php" id="deco"><font style=" color: "><img src="../../images/deconnexion.png" title="Deconnexion"></font></a>                    
                    <hr class="hidden" />
                    </center>
                </div>
            </div>
        </div>   
        
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
                <div id="tabs">
                    <!-- tabs -->
                    <div>
                        <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>  
                        <a class='tab' href='../../guide/client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <a class='tab selected' href='../../guide/consultant/index.php'><span style="width: 100px; text-align:center;">CONSULTANTS</span></a>
                        <a class='tab' href='../../guide/mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <a class='tab' href='../../guide/ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a>
                        <a class='tab' href='../../guide/ts/validts.php'><span style="width: 100px; text-align:center;">VALID TS</span></a>                                                              
                        <a class='tab' href='../../guide/alert/index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>                    
                        <a class='tab' href='../../guide/exportation/index.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a> 
                        <div class="header"><div class="bg-help">Modification d'un consultant</div></div>
                    </div>                                    
                    <!-- /tabs -->
                </div>
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
                             <li><a href='./ajoutconsultexterne.php'><span>Nouveau cons. externe</span></a></li>
                             <li><a href='./ajoutconsultinterne.php'><span>Nouveau cons. interne </span></a></li>
                             <li><a class='tab selected' href='./modifierconsult.php'><span>Modifier un consultant </span></a></li>  
                             <li><a href='./listeconsultant.php'><span>Liste des consultants</span></a></li>                              
                        </ul>
                    </div>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>MISE À JOUR DES INFORMATIONS D'UN CONSULTANT</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
        ?>
                      
        <div id="container" >
            
            
            
                <div>
                    <!-- /top -->
                    <div class="note" id="note"><b><font color="red">Note:</font></b> 
                        Tous les champs sont obligatoires
                        <!--<br/>&emsp;&emsp;Le champ «Fonction» est réservé aux consultants externes, mettez «NA» pour les consultants internes-->
                    </div>   
                    <br/><br/>
                    <div id="dp">
                        <form name="modifConsultant" method="POST">
                            <ul>
                                <select name="nomCons" id="nomCons" style="width: 210px">                                            
                                    <option>Sélectionnez le consultant</option>
                                        <?php
                                            $reqNomCons = mysqli_query($connect,"select RefEmploye, Prenom, NomFamille from employes 
                                            where Prenom not like '%admin%'                                             
                                            and RefEmploye not like '%E0%' 
                                            and RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ')
                                            order by Prenom ASC;");
                                            while($rowNomCons = mysqli_fetch_array($reqNomCons, MYSQLI_BOTH)){
                                                echo '<option value="'.$rowNomCons[0].'" >'.$rowNomCons[1].' '.$rowNomCons[2].'</option>';
                                            }
                                        ?>
                                </select>
                                <input type="submit" name="modifier" id="modifier" value="Modifier" />
                            </ul>
                        </form>
                        
                        <?php
                            if(isset($_POST['modifier'])){
                                if($_POST['nomCons'] == 'Sélectionnez le consultant'){						
                                echo '<font color="red"><br/>&emsp;&emsp;&emsp;&emsp;Veuillez s&eacute;lectionner un consultant.</font>';																
                            }
                            else{  
                                ?>
                                <script>
                                    document.modifConsultant.style.display = 'none';
                                </script>                        
                                <?php  
                                $Nomuser = $_POST['nomCons']; 
                                $request = 'select RefEmploye as code, Prenom as prenom, NomFamille as nom, 
                                    Titre as titre, Coddept as coddept, Poste as poste, Profil as profil, RefSociete as refsociete, 
                                    Adresse as adresse, Ville as ville, CodePostal as codepostal, 
                                    TelProfessionnel as telpro, Nomuser as nomuser, Password as pass, Manager as manager, 
                                    Protarif as protarif, actif as actif
                                    from employes where RefEmploye = "'.$Nomuser.'";';
                                $req = mysqli_query($connect,$request);
                                $result = mysqli_fetch_assoc($req);        
                                $code = $result['code'];$prenom = $result['prenom'];$nom = $result['nom'];
                                $coddept = $result['coddept'];  $titre = $result['titre'];$poste = $result['poste'];
                                $profil = $result['profil'];$refste = $result['refsociete'];
                                $adresse = $result['adresse'];$ville = $result['ville'];
                                $codepostal = $result['codepostal'];$telpro = $result['telpro'];
                                $nomuser = $result['nomuser'];$pass = $result['pass'];
                                $manager = $result['manager'];
                                $protarif = $result['protarif'];
                                $actif = $result['actif'];

                                $reqRefSte = 'select NomSociete as refste from societe where RefSociete = "'.$refste.'"';
                                $resReqSte = mysqli_query($connect, $reqRefSte);
                                $resRef    = mysqli_fetch_assoc($resReqSte);
                                $refsociete = $resRef['refste'];
                                
//                                $prenomMan = 'select concat(Prenom, " ", NomFamille) as anar from employes where RefEmploye = "'.$manager.'"';
//                                $resultPrenomMan = mysqli_query($connect,$prenomMan) or exit(mysqli_error($connect));
//                                $resPreMan = mysqli_fetch_assoc($resultPrenomMan);
//                                $prenomMan = $resPreMan['anar'];  
//                                
//                                echo 'manager '.$manager.' preNom: ' .$prenomMan;
                        ?>
                                                
                        <form name="consultantModif" method="post"   onsubmit="return verifAll(this)">
                            <table>
                                <tr>
                                    <td>
                                        <ul style=" list-style-type: none">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <ul style=" list-style-type: none">
                                                            <table>
                                                                <tr>
                                                                    <td><label for="code">Numéro Matricule</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="code" id="code" value="<?php echo $code; ?>" readonly="true"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="prenom">Pr&eacute;nom</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="prenom" id="prenom" value="<?php echo $prenom; ?>" onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="nomFamille">Nom de famille</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="nom" id="nom" value="<?php echo $nom; ?>" onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Poste">Poste</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="poste" id="poste" value="<?php echo $poste; ?>" onblur="verifChampNul(this)"  /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Ville">Ville</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="ville" id="ville" value="<?php echo $ville; ?>" onblur="verifChampNul(this)"  /></td>
                                                                </tr>
                                                            </table>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul style=" list-style-type: none">
                                                            <table>
                                                                <tr>
                                                                    <td><label for="Adresse">Email FTHM</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="adresse" id="adresse" value="<?php echo $adresse; ?>" onblur="verifChampNul(this)"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="CodePostal">Adresse</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="postal" id="postal" value="<?php echo $codepostal; ?>" onblur="verifChampNul(this)"  /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="TelProfessionnel">Téléphone Professionnel</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="tel" id="tel" value="<?php echo $telpro; ?>" onblur="verifChampNul(this)"  /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label id="lablogin" for="Nomuser" >Login</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="login" id="login" value="<?php echo $nomuser; ?>" onblur="verifChampNul(this)"  /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label id="labmdp"  for="Password">Mot de passe</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="mdp" id="mdp" value="" onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>                             
                                                                    <td><label id="labmdp"  for="Password"><font style="color: red"><span style="margin-left: 0.5em;">Veuillez re-saisir le mot de passe!!!</span><font></label></td>                            
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Titre">Fonction</label></td>
                                                                    <td><input  type="text" style=" width: 200px" name="titre" id="titre" value="<?php echo $titre; ?>" onblur="verifChampNul(this)"  /></td>
                                                                </tr>
                                                            </table>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul style=" list-style-type: none">
                                                            <table>
                                                                <tr>
                                                                    <td><label for="Manager">Manager</label></td>
                                                                    <td>
                                                                        <select name="manager" id="manager" style="width:173px" onblur="verifChampNul(this)" >	
                                                                        <!--<option><?php // echo $preFam; ?></option>-->
                                                                        <?php                                                                                                                                                                                                                                      
                                                                            $man= "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre 
                                                                                from employes 
                                                                                where (Profil = 'Manager' or Profil like '%Associé%') 
                                                                                and actif =0 
                                                                                and RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ') order by Prenom ASC;";
                                                                            $resultMan = mysqli_query($connect,$man) or exit(mysqli_error($connect));
                                                                            while($row = mysqli_fetch_array($resultMan, MYSQLI_BOTH)){                                        
                                                                                echo '<option value="'.$row[0].'">'.$row[1].'</option>';                                          
                                                                            }                                    
                                                                        ?>																																		
                                                                        </select> 
                                                                        <script>                                                                            
                                                                            mana = "<?php echo $manager; ?>";                                                                                                                                                
                                                                            document.getElementById("manager").selectedIndex = getIndex(mana, "manager");                                                                    
                                                                        </script>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Coddept">Code d&eacute;partement</label></td>
                                                                    <td>
                                                                        <select name="Coddept" id="Coddept" style="width:173px"  onblur="verifChampNul(this)" >									                                                                        
                                                                            <?php  
                                                                                $test = mysqli_query($connect,'SELECT Coddept from departement;');
                                                                                while($row = mysqli_fetch_array($test, MYSQLI_BOTH)){                                        
                                                                                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';                                          
                                                                                }                                    
                                                                            ?>																																		
                                                                        </select>
                                                                        <script>
                                                                            cli = "<?php echo $coddept; ?>";                                                                    
                                                                            document.getElementById("Coddept").selectedIndex = getIndex(cli, "Coddept");                                                                    
                                                                        </script>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label id="labprofil"  for="Profil">Profil</label></td>
                                                                    <td>
                                                                        <select name="Profil" id="Profil"  style="width:173px"  onblur="verifChampNul(this)" >									
                                                                        
                                                                            <?php      
                                                                                $req_profil = mysqli_query($connect,'SELECT Nomprof from profil where Nomprof not in ("Administrateur") order by Nomprof;');
                                                                                while($row1 = mysqli_fetch_array($req_profil, MYSQLI_BOTH)){                                        
                                                                                    echo '<option value="'.$row1[0].'">'.$row1[0].'</option>';                                          
                                                                                }                                    
                                                                            ?>																																		
                                                                        </select>
                                                                        <script>
                                                                            pro = "<?php echo $profil; ?>";                                                                    
                                                                            document.getElementById("Profil").selectedIndex = getIndex(pro, "Profil");                                                                    
                                                                        </script>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="RefSociete">R&eacute;f&eacute;rence soci&eacute;t&eacute;</label></td>
                                                                    <td>
                                                                        <select name="societe" id="societe" style="width:173px" onblur="verifChampNul(this)" >		
                                                                            
                                                                            <?php  
                                                                                $req_societe = mysqli_query($connect,'SELECT NomSociete from societe;');
                                                                                while($row2 = mysqli_fetch_array($req_societe, MYSQLI_BOTH)){                                        
                                                                                    echo '<option value="'.$row2[0].'">'.$row2[0].'</option>';                                          
                                                                                }                                    
                                                                            ?>																																		
                                                                        </select>
                                                                        <script>
                                                                            refs = "<?php echo $refsociete; ?>";                                                                    
                                                                            document.getElementById("societe").selectedIndex = getIndex(refs, "societe");                                                                    
                                                                        </script>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label id="labprotarif"  for="Protarif">Protarif</label></td>
                                                                    <td>
                                                                        <select name="Protarif" id="Protarif" style="width:173px" onblur="verifChampNul(this)" >									
                                                                        
                                                                            <?php
                                                                                $tesita = mysqli_query($connect,'SELECT Protarif from protarif;'); 
                                                                                while($row3 = mysqli_fetch_array($tesita, MYSQLI_BOTH)){
                                                                                    echo '<option value="'.$row3[0].'">'.$row3[0].'</option>';
                                                                                }
                                                                            ?>																																		
                                                                        </select>
                                                                        <script>
                                                                            prt = "<?php echo $protarif; ?>";                                                                    
                                                                            document.getElementById("Protarif").selectedIndex = getIndex(prt, "Protarif");                                                                    
                                                                        </script>
                                                                    </td>
                                                                    <tr>
                                                                        <td style=" width: 91px"><label id="labdesactive" for="desactive" ><font style="color: red">Desactiver le consultant? </font></label></td>
                                                                    <td><input type="checkbox" id="desactive" name="desactive"
                                                                               <?php
                                                                                if($actif == 1) {
                                                                                    echo 'checked';                                           
                                                                                } 
                                                                               ?>
                                                                               /><br/></td>
                                                                    </tr>
                                                                </tr>
                                                            </table>
                                                        </ul>
                                                    </td>
                                                </tr>                                
                                            </table>
                                        </ul>
                                    </td>
                                </tr>
                                
                            </table>
                            <br><span id="spann" style="float: right; padding: 8px;"><input type="submit" name="valider" id="valider" value="Modifier" disabled="disabled" onmouseover="this.disabled='';"/></span>                            
                        </form>

                        <?php
                            }
                            }
                            if(isset($_POST['valider'])){
                                ?>            
                                <script>
                                    document.modifConsultant.style.display = 'none';
                                    document.consultantModif.style.display='none';                    
                                </script>
                                <?php
                                //recuperation des valeurs des champs
                                $cod       = $_POST['code'];
                                $prenom     = $_POST['prenom'];
                                $nomFamille = $_POST['nom'];
                                $Coddepte    = $_POST['Coddept'];
                                $titr      = $_POST['titre'];
                                $Post      = $_POST['poste'];
                                
                                $societe    = $_POST['societe'];
                                $Adress    = $_POST['adresse'];
                                $Vill      = $_POST['ville'];
                                $CodePostale = $_POST['postal'];
                                $TelProfessionnel = $_POST['tel'];
                                $userNom    = $_POST['login'];
                                $Password   = $_POST['mdp'];
                                $Manage    = $_POST['manager'];
                                
                                $dateNow = date('Y-m-d');                                 
                                
                                if($_POST['desactive'] == ''){
                                    $actif = 0;
                                }
                                else if($_POST['desactive'] == 'on'){
                                    $actif = 1;
                                }
                                

                                $reqSte = 'select RefSociete as STE from societe where NomSociete = "'.$societe.'"';
                                $resSte = mysqli_query($connect, $reqSte);
                                $ressSTE    = mysqli_fetch_assoc($resSte);
                                $societeRef = $ressSTE['STE'];

//                                $refMan = 'select RefEmploye as Code from employes where Prenom = "'.$Manage.'"';
//                                $resultRefMan = mysqli_query($connect,$refMan) or exit(mysqli_error($connect));
//                                $resRefMan = mysqli_fetch_assoc($resultRefMan);
//                                $doce = $resRefMan['Code'];
                                
                                $reqnbModif = 'select max(nombremodification) as nb from employes where RefEmploye =  "'.$cod.'"';
                                $resnbModif = mysqli_query($connect, $reqnbModif) or exit(mysqli_error($connect));
                                $resultnbModif = mysqli_fetch_assoc($resnbModif);
                                $nbModif = $resultnbModif['nb'];

                                $nb = $nbModif  + 1;                                                                 
                                
                                //update
                                 $mysqli->query("SET AUTOCOMMIT=0");
                                 if(strstr($cod, "E0", TRUE)){
                                     //echo 'prrrr';
                                 }
                                 else{
//                                     if($prof == "Administrateur"){                                                                                                          
                                         $Profile     = $_POST['Profil'];
                                         $Protari   = $_POST['Protarif'];
                                         $reqUpdate = 'UPDATE employes inner join profil on (profil.Nomprof = employes.Profil) set '
                                         . 'Prenom = "'.$prenom.'" ,'
                                         . 'NomFamille = "'.$nomFamille.'" ,'
                                         . 'Coddept = "'.$Coddepte.'" ,'
                                         . 'Titre = "'.$titr.'" ,'
                                         . 'Poste = "'.$Post.'" ,'
                                         . 'Profil = "'.$Profile.'" ,'
                                         . 'RefSociete = "'.$societeRef.'" ,'
                                         . 'Adresse = "'.$Adress.'" ,'
                                         . 'Ville = "'.$Vill.'" ,'
                                         . 'CodePostal = "'.$CodePostale.'" ,'
                                         . 'TelProfessionnel = "'.$TelProfessionnel.'" ,'
                                         . 'Nomuser = "'.$userNom.'" ,'
                                         . 'Password = "'.md5($Password).'" ,'
                                         . 'Pleindroit = 0 ,'
                                         . 'Manager = "'.$Manage.'" ,'
                                         . 'Protarif = "'.$Protari.'", '
                                         . 'actif = "'.$actif.'", '
                                         . 'datemodification = "'.$dateNow.'", '
                                         . 'nombremodification = "'.$nb.'", '
                                         . 'usermodif = "'.$refEmp.'" '
                                         . 'where RefEmploye = "'.$cod.'"';
//                                     }
//                                     else{                                                                                 
//                                         $reqUpdate = 'UPDATE employes inner join profil on (profil.Nomprof = employes.Profil) set '
//                                         . 'Prenom = "'.$prenom.'" ,'
//                                         . 'NomFamille = "'.$nomFamille.'" ,'
//                                         . 'Coddept = "'.$Coddepte.'" ,'
//                                         . 'Titre = "'.$titr.'" ,'
//                                         . 'Poste = "'.$Post.'" ,'
////                                         . 'Profil = "'.$Profile.'" ,'
//                                         . 'RefSociete = "'.$societeRef.'" ,'
//                                         . 'Adresse = "'.$Adress.'" ,'
//                                         . 'Ville = "'.$Vill.'" ,'
//                                         . 'CodePostal = "'.$CodePostale.'" ,'
//                                         . 'TelProfessionnel = "'.$TelProfessionnel.'" ,'
//                                         . 'Nomuser = "'.$userNom.'" ,'
//                                         . 'Password = "'.$Password.'" ,'
//                                         . 'Pleindroit = 0 ,'
//                                         . 'Manager = "'.$Manage.'" '
////                                         . 'Protarif = "'.$Protari.'" '
//                                         . 'datemodification = "'.$dateNow.'", '
//                                         . 'nombremodification = "'.$nb.'", '
//                                         . 'usermodif = "'.$refEmp.'" '
//                                         . 'where RefEmploye = "'.$cod.'"';
//                                     }                                                                                              
                                     $resUpdate = mysqli_query($connect,$reqUpdate) or exit(mysqli_error($connect));

                                     if($resUpdate){
                                         echo '<font color="green"><b><center>Les modifications ont &eacute;t&eacute; correctement effectu&eacute;es.</center></b></font>'; 
                                         $mysqli->query("COMMIT");
                                         ?>
                                            <script>
                                                $('#note').css("display", "none");
                                            </script>
                                        <?php
                                     }
                                     else{
                                         $mysqli->query("ROLLBACK");exit(1);
                                         exit(mysqli_error($connect));
                                     }
                                 }
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
	         
        <?php else : ?>
            <p>
                <span>Vous n’avez pas les autorisations n&eacute;cessaires pour acc&eacute;der &agrave; cette page.</span> Please <a href="../../index.php">login</a>.
            </p>
        <?php endif; ?>   
            
        <script type="text/javascript">
            $(document).ready(function(){
                if($('#valider').is(':disabled')){
//                        alert("disa");                        
                        $('#spann').bind({
                            mouseenter: function(e) {
                                // Hover event handler
                                $('#valider').attr('disabled', false);  
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
//                        $('#valider').attr('disabled', false);  
                    $('#spann').unbind('mouseover mouseout');
                });

                $('#valider').on('mouseout', function(){                        
//                        alert("kaka");
                    $('#valider').attr('disabled', 'disabled');    

                });
                
                var profil = '<?php echo $prof;?>';
                if(profil !== "Administrateur"){                        
                    $('#adresse').attr("readonly", "true");
                    $('#login').attr("readonly", "true");
                    $('#mdp').attr("readonly", "true");
                    $('#Profil').attr("disabled", "true");   
                    $('#Protarif').attr("disabled", "true");   
                    
                } 
                else if(profil === "Administrateur"){                         
                }                
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
                   var prenom = verifChampNul(f.prenom);var nom = verifChampNul(f.nom);
                   var Coddept = verifChampNul(f.Coddept); var titre =  verifChampNul(f.titre);
                   var poste = verifChampNul(f.poste);var Profil = verifChampNul(f.Profil);
                   var societe = verifChampNul(f.societe);var adresse = verifChampNul(f.adresse);var ville = verifChampNul(f.ville);
                   var postal = verifChampNul(f.postal);var tel = verifChampNul(f.tel);var login = verifChampNul(f.login);
                   var mdp = verifChampNul(f.mdp);var manager = verifChampNul(f.manager);var Protarif = verifChampNul(f.Protarif);
                   
                   if(prenom && nom && Coddept && titre && poste && Profil && societe && adresse && ville && postal && 
                          tel && login && mdp && manager && Protarif)
                      return true;
                   else{
                      alert("Veuillez remplir correctement tous les champs.");
                      return false;
                   }
                }
            </script>                      
    </body>
</html>

