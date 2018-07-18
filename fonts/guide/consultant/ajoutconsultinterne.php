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
        <title>Ajout consultant interne</title>
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
            margin-right: 50px;            
            }
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
            if($prof == 'Administrateur'){
                ?>
                <nav class="menu">  
                    <div>                                        
                        <a href='../index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>                                        
                    <div>                                        
                        <a class='tab selected' href='./consultant/index.php'><span style="width: 100px; text-align:center;">CONSULTANTS</span></a>
                         <ul>
                             <li><a href='./ajoutconsultexterne.php'><span>Nouveau cons. externe</span></a></li>
                             <li><a class='tab selected' href='./ajoutconsultinterne.php'><span>Nouveau cons. interne </span></a></li>
                             <li><a href='./modifierconsult.php'><span>Modifier un consultant </span></a></li>  
                             <li><a href='./listeconsultant.php'><span>Liste des consultants</span></a></li>                              
                        </ul>
                    </div>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>AJOUT D'UN NOUVEAU CONSULTANT INTERNE</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
        ?>
                      
        <div id="container" >
            
            
            
                <div>
                    <!-- /top -->
                    <div class="note" id="note"><center><b><font color="red">Note:</font></b> 
                        Tous les champs sont obligatoires
                        </center>
                    </div>   
                    <br/><br/>
                    <div id="dp">
                        <form name="ajoutConsInt" method="post" onsubmit="return verifAll(this)">
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
                                                                    <td><input type="text" style=" width: 200px" name="code" id="code" onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="prenom">Pr&eacute;nom</label></td>
                                                                    <td><input type="text" style=" width: 200px" name="prenom" id="nomPrenom"  onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="nomFamille">Nom de famille</label></td>
                                                                    <td><input type="text" style=" width: 200px" name="nomFamille" id="nomFamille"  onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Poste">Poste</label></td>
                                                                    <td><input type="text" style=" width: 200px" name="Poste" id="Poste"  onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Ville">Ville</label></td>
                                                                    <td><input type="text" style=" width: 200px" name="Ville" id="Ville"  onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                            </table>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul style=" list-style-type: none">
                                                            <table>
                                                                <tr>
                                                                    <td><label for="Adresse">Email FTHM</label></td>
                                                                    <td><input type="text" style=" width: 200px" name="Adresse" id="Adresse"  onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="CodePostal">Adresse</label></td>
                                                                    <td><input type="text" style=" width: 200px" name="CodePostal" id="CodePostal"  onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="TelProfessionnel">Téléphone Professionnel</label></td>
                                                                    <td><input type="text" style=" width: 200px" name="TelProfessionnel" id="TelProfessionnel"  onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Nomuser">Login</label></td>
                                                                    <td><input type="text" style=" width: 200px" name="Nomuser" id="Nomuser"  onblur="verifChampNul(this)" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Password">Mot de passe</label></td>
                                                                    <td><input type="text" style=" width: 200px" name="Password" id="Password"  onblur="verifChampNul(this)" /></td>
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
                                                                        <select name="Manager" id="Manager" style="width:173px"  onblur="verifChampNul(this)" >									
                                                                        <option></option>
                                                                        <?php   
                                                                            $man= "select RefEmploye, concat(Prenom, ' ', NomFamille) as nomPre from employes where (Profil = 'Manager' or Profil like '%Associé%') and Prenom not in ('Administrateur', 'Administrateur 03', 'TOUS') order by Prenom ASC;";
                                                                            $resultMan = mysqli_query($connect,$man) or exit(mysqli_error($connect));
                                                                            while($row = mysqli_fetch_array($resultMan, MYSQLI_BOTH)){                                        
                                                                                echo '<option value="'.$row[0].'">'.$row[1].'</option>';                                          
                                                                            }                                    
                                                                        ?>																																		
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Coddept">Code d&eacute;partement</label></td>
                                                                    <td>
                                                                        <select name="Coddept" id="Coddept" style="width:173px"  onblur="verifChampNul(this)" >									
                                                                        <option></option>
                                                                            <?php  
                                                                                $test = mysqli_query($connect,'SELECT Coddept from departement;');
                                                                                while($row = mysqli_fetch_array($test, MYSQLI_BOTH)){                                        
                                                                                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';                                          
                                                                                }                                    
                                                                            ?>																																		
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Profil">Profil</label></td>
                                                                    <td>
                                                                        <select name="Profil" id="Profil"  style="width:173px"  onblur="verifChampNul(this)" >									
                                                                        <option></option>
                                                                            <?php      
                                                                                $req_profil = mysqli_query($connect,'SELECT Nomprof from profil where Nomprof not in ("Administrateur") order by Nomprof;');
                                                                                while($row1 = mysqli_fetch_array($req_profil, MYSQLI_BOTH)){                                        
                                                                                    echo '<option value="'.$row1[0].'">'.$row1[0].'</option>';                                          
                                                                                }                                    
                                                                            ?>																																		
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="RefSociete">R&eacute;f&eacute;rence soci&eacute;t&eacute;</label></td>
                                                                    <td>
                                                                        <select name="RefSociete" id="RefSociete"  style="width:173px"  onblur="verifChampNul(this)" >									
                                                                        <option></option>
                                                                            <?php  
                                                                                $req_societe = mysqli_query($connect,'SELECT NomSociete from societe;');
                                                                                while($row2 = mysqli_fetch_array($req_societe, MYSQLI_BOTH)){                                        
                                                                                    echo '<option value="'.$row2[0].'">'.$row2[0].'</option>';                                          
                                                                                }                                    
                                                                            ?>																																		
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label for="Protarif">Protarif</label></td>
                                                                    <td>
                                                                        <select name="Protarif" id="Protarif"  style="width:173px" onblur="verifChampNul(this)" >									
                                                                        <option></option>
                                                                            <?php
                                                                                $tesita = mysqli_query($connect,'SELECT Protarif from protarif;'); 
                                                                                while($row3 = mysqli_fetch_array($tesita, MYSQLI_BOTH)){
                                                                                        echo '<option value="'.$row3[0].'">'.$row3[0].'</option>';
                                                                                }
                                                                            ?>																																		
                                                                        </select>
                                                                    </td>
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
                            <span id="spann" style="float: right; padding: 8px;"><input type="submit" name="enregistrer" id="enregistrer" value="Enregistrer" disabled="disabled" onmouseover="this.disabled='';"/></span>                            
                        </form>
                    </div>               
                    <!-- bottom -->
                    
                    <?php
                        if(isset($_POST['enregistrer'])){
                            ?>  
                            <script>
                                document.ajoutConsInt.style.display='none';
                            </script>
                            <?php
                            $code       = $_POST['code'];
                            $prenom     = $_POST['prenom'];
                            $nomFamille = $_POST['nomFamille'];
                            $Coddept    = $_POST['Coddept'];
                            $Poste      = $_POST['Poste'];
                            $Profil     = $_POST['Profil'];
                            $RefSociete = $_POST['RefSociete'];
                            $Adresse    = $_POST['Adresse'];
                            $Ville      = $_POST['Ville'];
                            $CodePostal = $_POST['CodePostal'];
                            $TelProfessionnel = $_POST['TelProfessionnel'];
                            $Nomuser    = $_POST['Nomuser'];
                            $Password   = $_POST['Password'];
                            $Manager    = $_POST['Manager'];
                            $Protarif   = $_POST['Protarif'];
                            $dateNow    = date('Y-m-d');    
                            

                            /*
                            echo '$code: '.$code;
                            echo '$prenom '.$prenom;
                            echo '$nomFamille '.$nomFamille;
                            echo '$Coddept '.$Coddept;
                            echo '$Poste '.$Poste;
                            echo '$Profil'.$Profil;
                            echo '$RefSociete '.$RefSociete;
                            echo '$Adresse '.$Adresse;
                            echo '$Ville '.$Ville;
                            echo '$CodePostal '.$CodePostal;
                            echo '$TelProfessionnel '.$TelProfessionnel;
                            echo '$Nomuser '.$Nomuser;
                            echo '$Password '.$Password;
                            echo '$Manager '.$Manager;
                            echo '$Protarif '.$Protarif;
                             * 
                             */
                            
//                            $refMan = 'select RefEmploye as Code from employes where Prenom = "'.$Manager.'"';
//                            $resultRefMan = mysqli_query($connect,$refMan) or exit(mysqli_error($connect));
//                            $resRefMan = mysqli_fetch_assoc($resultRefMan);
//                            $doce = $resRefMan['Code'];
                            $doce = $Manager;
                            
                            $reketyCoddept = 'select Coddept AS kody from departement where Coddept = "'.$Coddept.'"';
                            $reqCoddept = mysqli_query($connect,$reketyCoddept);
                            $resultCoddept = mysqli_fetch_assoc($reqCoddept);
                            $kodi = $resultCoddept['kody'];
                            
                            $reketyNomdept = 'select Nomdept AS dptname from departement where Coddept = "'.$Coddept.'"';
                            $reqNomdept = mysqli_query($connect,$reketyNomdept);
                            $resultNomdept = mysqli_fetch_assoc($reqNomdept);
                            $nameDept = $resultNomdept['dptname'];
                            
                            $reketyprofil = 'select Nomprof AS profname from profil where Nomprof="'.$Profil.'"';
                            $reqprofil = mysqli_query($connect,$reketyprofil);
                            $resultprofil = mysqli_fetch_assoc($reqprofil);
                            $nameprofil = $resultprofil['profname'];
                            
                            $reketyRefSte = 'select RefSociete AS Refste from societe where NomSociete = "'.$RefSociete.'"';
                            $reqRefSte = mysqli_query($connect,$reketyRefSte);
                            $resultRefSte = mysqli_fetch_assoc($reqRefSte);
                            $steRef = $resultRefSte['Refste'];
                            
                            $reketyProtarif = 'select Protarif AS taffp from protarif where Protarif = "'.$Protarif.'"';
                            $reqProtarif = mysqli_query($connect,$reketyProtarif);
                            $resultProtarif = mysqli_fetch_assoc($reqProtarif);
                            $tarifPro = $resultProtarif['taffp'];
                            
                            $mysqli->query("SET AUTOCOMMIT=0");
                            $ajout = mysqli_query($connect, 'insert into employes                                                
                                        (RefEmploye , Prenom        , NomFamille      , Coddept    , Nomdept        , Titre          , Poste       , Profil           , RefSociete   , Adresse       , Ville       , CodePostal       , TelProfessionnel       , Nomuser       , Password       , Pleindroit, Manager       , Protarif       , actif, datecreation, datemodification, nombremodification, usermodif    ) values
                                        ("'.$code.'", "'.$prenom.'" ,"'.$nomFamille.'", "'.$kodi.'", "'.$nameDept.'", "'.$nameDept.'", "'.$Poste.'", "'.$nameprofil.'", "'.$steRef.'", "'.$Adresse.'", "'.$Ville.'", "'.$CodePostal.'", "'.$TelProfessionnel.'", "'.$Nomuser.'", "'.md5($Password).'", 0         , "'.$doce.'"   , "'.$tarifPro.'", 0    , "'.$dateNow.'", "'.$dateNow.'"  , 0                 , "'.$refEmp.'");')
                            or exit(mysqli_error($connect));                          
                            
                            if($ajout){
                                 ?>
                                <script>
                                    $('#note').css("display", "none");
                                </script>
                                <?php
                                echo '<font color="green"><b><center>Le consultant a &eacute;t&eacute; ajout&eacute; avec succ&egrave;s.</center></b></font>';
                                $mysqli->query("COMMIT");
                            }
                            else {                                                                          
                                $mysqli->query("ROLLBACK");exit(1);
                                //exit(mysqli_error($connect));
                            }
                            
                            $query_max_RefFichePointage = "select max(RefFichePointage) as max from fichepointage;";
                            $result_max_RefFichePointage = mysqli_query($connect, $query_max_RefFichePointage) or exit(mysqli_error($connect));
                            $resultMax = mysqli_fetch_assoc($result_max_RefFichePointage);
                            $refMax = $resultMax['max'];                            
                            $i = 1;
                                                        
                            $reqEmp = 'select RefEmploye as emp from employes '
                                    . 'where RefEmploye = "'.$code.'"';
                            $resEmp = mysqli_query($connect,$reqEmp)  or exit(mysqli_error($connect));;
                            $resultEmp = mysqli_fetch_assoc($resEmp);
                            $Emp = $resultEmp['emp'];
                            
//                            $dateNow = date('Y-m-d');   
                            
                            $query_insert = 'insert into fichepointage '
                                    . '(RefFichePointage, RefEmploye, DateEntree, Valide, Dateval, UT, DT, datemodification, nombremodification, usermodif) '
                                    . 'values '
                                    . '('.($refMax + 1).', "'.$Emp.'", "2015-01-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 2).', "'.$Emp.'", "2015-01-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), '
                                    . '('.($refMax + 3).', "'.$Emp.'", "2015-02-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 4).', "'.$Emp.'", "2015-02-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 5).', "'.$Emp.'", "2015-03-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 6).', "'.$Emp.'", "2015-03-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 7).', "'.$Emp.'", "2015-04-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 8).', "'.$Emp.'", "2015-04-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 9).', "'.$Emp.'", "2015-05-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 10).', "'.$Emp.'", "2015-05-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 11).', "'.$Emp.'", "2015-06-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 12).', "'.$Emp.'", "2015-06-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 13).', "'.$Emp.'", "2015-07-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 14).', "'.$Emp.'", "2015-07-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 15).', "'.$Emp.'", "2015-08-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 16).', "'.$Emp.'", "2015-08-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 17).', "'.$Emp.'", "2015-09-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 18).', "'.$Emp.'", "2015-09-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 19).', "'.$Emp.'", "2015-10-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 20).', "'.$Emp.'", "2015-10-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 21).', "'.$Emp.'", "2015-11-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 22).', "'.$Emp.'", "2015-11-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 23).', "'.$Emp.'", "2015-12-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 24).', "'.$Emp.'", "2015-12-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    
                                    . '('.($refMax + 25).', "'.$Emp.'", "2016-01-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 26).', "'.$Emp.'", "2016-01-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), '
                                    . '('.($refMax + 27).', "'.$Emp.'", "2016-02-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 28).', "'.$Emp.'", "2016-02-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 29).', "'.$Emp.'", "2016-03-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 30).', "'.$Emp.'", "2016-03-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 31).', "'.$Emp.'", "2016-04-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 32).', "'.$Emp.'", "2016-04-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 33).', "'.$Emp.'", "2016-05-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 34).', "'.$Emp.'", "2016-05-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 35).', "'.$Emp.'", "2016-06-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 36).', "'.$Emp.'", "2016-06-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 37).', "'.$Emp.'", "2016-07-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 38).', "'.$Emp.'", "2016-07-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 39).', "'.$Emp.'", "2016-08-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 40).', "'.$Emp.'", "2016-08-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 41).', "'.$Emp.'", "2016-09-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 42).', "'.$Emp.'", "2016-09-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 43).', "'.$Emp.'", "2016-10-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 44).', "'.$Emp.'", "2016-10-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 45).', "'.$Emp.'", "2016-11-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 46).', "'.$Emp.'", "2016-11-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 47).', "'.$Emp.'", "2016-12-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 48).', "'.$Emp.'", "2016-12-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),' 

                                    . '('.($refMax + 49).', "'.$Emp.'", "2017-01-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 50).', "'.$Emp.'", "2017-01-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), '
                                    . '('.($refMax + 51).', "'.$Emp.'", "2017-02-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 52).', "'.$Emp.'", "2017-02-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 53).', "'.$Emp.'", "2017-03-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 54).', "'.$Emp.'", "2017-03-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 55).', "'.$Emp.'", "2017-04-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 56).', "'.$Emp.'", "2017-04-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 57).', "'.$Emp.'", "2017-05-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 58).', "'.$Emp.'", "2017-05-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 59).', "'.$Emp.'", "2017-06-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 60).', "'.$Emp.'", "2017-06-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 61).', "'.$Emp.'", "2017-07-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 62).', "'.$Emp.'", "2017-07-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 63).', "'.$Emp.'", "2017-08-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 64).', "'.$Emp.'", "2017-08-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 65).', "'.$Emp.'", "2017-09-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 66).', "'.$Emp.'", "2017-09-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 67).', "'.$Emp.'", "2017-10-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 68).', "'.$Emp.'", "2017-10-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 69).', "'.$Emp.'", "2017-11-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 70).', "'.$Emp.'", "2017-11-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 71).', "'.$Emp.'", "2017-12-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 72).', "'.$Emp.'", "2017-12-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),' 
                            
                                    . '('.($refMax + 73).', "'.$Emp.'", "2018-01-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 74).', "'.$Emp.'", "2018-01-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), '
                                    . '('.($refMax + 75).', "'.$Emp.'", "2018-02-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 76).', "'.$Emp.'", "2018-02-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 77).', "'.$Emp.'", "2018-03-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 78).', "'.$Emp.'", "2018-03-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 79).', "'.$Emp.'", "2018-04-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 80).', "'.$Emp.'", "2018-04-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 81).', "'.$Emp.'", "2018-05-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 82).', "'.$Emp.'", "2018-05-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 83).', "'.$Emp.'", "2018-06-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 84).', "'.$Emp.'", "2018-06-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 85).', "'.$Emp.'", "2018-07-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 86).', "'.$Emp.'", "2018-07-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 87).', "'.$Emp.'", "2018-08-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 88).', "'.$Emp.'", "2018-08-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 89).', "'.$Emp.'", "2018-09-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 90).', "'.$Emp.'", "2018-09-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 91).', "'.$Emp.'", "2018-10-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 92).', "'.$Emp.'", "2018-10-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 93).', "'.$Emp.'", "2018-11-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 94).', "'.$Emp.'", "2018-11-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 95).', "'.$Emp.'", "2018-12-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 96).', "'.$Emp.'", "2018-12-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'                                     
                                    
                                    . '('.($refMax + 97).', "'.$Emp.'", "2019-01-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 98).', "'.$Emp.'", "2019-01-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), '
                                    . '('.($refMax + 99).', "'.$Emp.'", "2019-02-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 100).', "'.$Emp.'", "2019-02-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 101).', "'.$Emp.'", "2019-03-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 102).', "'.$Emp.'", "2019-03-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 103).', "'.$Emp.'", "2019-04-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 104).', "'.$Emp.'", "2019-04-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 105).', "'.$Emp.'", "2019-05-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 106).', "'.$Emp.'", "2019-05-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 107).', "'.$Emp.'", "2019-06-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 108).', "'.$Emp.'", "2019-06-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 109).', "'.$Emp.'", "2019-07-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 110).', "'.$Emp.'", "2019-07-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 111).', "'.$Emp.'", "2019-08-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 112).', "'.$Emp.'", "2019-08-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 113).', "'.$Emp.'", "2019-09-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 114).', "'.$Emp.'", "2019-09-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 115).', "'.$Emp.'", "2019-10-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 116).', "'.$Emp.'", "2019-10-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 117).', "'.$Emp.'", "2019-11-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 118).', "'.$Emp.'", "2019-11-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 119).', "'.$Emp.'", "2019-12-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 120).', "'.$Emp.'", "2019-12-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),' 
                                    
                                    . '('.($refMax + 121).', "'.$Emp.'", "2020-01-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 122).', "'.$Emp.'", "2020-01-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), '
                                    . '('.($refMax + 123).', "'.$Emp.'", "2020-02-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 124).', "'.$Emp.'", "2020-02-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 125).', "'.$Emp.'", "2020-03-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 126).', "'.$Emp.'", "2020-03-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 127).', "'.$Emp.'", "2020-04-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 128).', "'.$Emp.'", "2020-04-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 129).', "'.$Emp.'", "2020-05-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 130).', "'.$Emp.'", "2020-05-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 131).', "'.$Emp.'", "2020-06-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 132).', "'.$Emp.'", "2020-06-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 133).', "'.$Emp.'", "2020-07-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 134).', "'.$Emp.'", "2020-07-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 135).', "'.$Emp.'", "2020-08-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 136).', "'.$Emp.'", "2020-08-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 137).', "'.$Emp.'", "2020-09-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 138).', "'.$Emp.'", "2020-09-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 139).', "'.$Emp.'", "2020-10-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 140).', "'.$Emp.'", "2020-10-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 141).', "'.$Emp.'", "2020-11-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 142).', "'.$Emp.'", "2020-11-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"),'
                                    . '('.($refMax + 143).', "'.$Emp.'", "2020-12-01", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'"), ('.($refMax + 144).', "'.$Emp.'", "2020-12-16", 0, NULL, NULL, NOW(), NOW(), 0, "'.$Emp.'")' ;                                    
                                    $res_insert = mysqli_query($connect, $query_insert) or exit(mysqli_error($connect));
                                    
                        }
                    ?>
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
                   var code = verifChampNul(f.code);var prenom = verifChampNul(f.prenom);var nomFamille = verifChampNul(f.nomFamille);
                   var Coddept = verifChampNul(f.Coddept);var Poste = verifChampNul(f.Poste);var Profil = verifChampNul(f.Profil);
                   var RefSociete = verifChampNul(f.RefSociete);var Adresse = verifChampNul(f.Adresse);var Ville = verifChampNul(f.Ville);
                   var CodePostal = verifChampNul(f.CodePostal);var TelProfessionnel = verifChampNul(f.TelProfessionnel);var Nomuser = verifChampNul(f.Nomuser);
                   var Password = verifChampNul(f.Password);var Manager = verifChampNul(f.Manager);var Protarif = verifChampNul(f.Protarif);
                   
                   if(code && prenom && nomFamille && Coddept && Poste && Profil && RefSociete && Adresse && Ville && CodePostal && 
                          TelProfessionnel && Nomuser && Password && Manager && Protarif)
                      return true;
                   else{
                      alert("Veuillez remplir correctement tous les champs.");
                      return false;
                   }
                }
            </script>                        
    </body>
</html>

