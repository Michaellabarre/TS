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
        <title>MAJ Client code</title>
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

        <!-- daypilot libraries -->
        <script src="../js/daypilot-all.min.js?v=1783" type="text/javascript"></script>

        <!-- daypilot themes -->
         
   
	<!-- /head -->
        <style type="text/css">  
            textarea{
                width: 198px;
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
            
            input[type='submit'] {
            /*width: 100px!important;*/    
            float: right;
            margin-right: 102px;            
            }
            
            #selectionner{
                margin-right: 1080px;
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
                <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a href='../index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='./ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='./listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a class='tab selected' href='./modifclientcode.php'><span>Modification Client</span></a></li>                            
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
                        <a class='tab' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
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
                    <font style=" color: black"><b><center>MISE À JOUR CLIENT</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }            
            else if($prof == 'DAF'){
                ?>
                <nav class="menu">  
                    <div>                                        
                        <a href='../index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>         
                            <li><a class='' href='./ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='./listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a class='tab selected' href='./modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>                    
                    <div>    
                        <a class='tab' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>                                           
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Fiche de Mission</span></a></li> 
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                        </ul>
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
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>MISE À JOUR CLIENT</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
            else if($prof == 'Assistant(e) Manager'  ){
                ?>
                <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a class='tab selected' href='modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../../guide/mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='../../guide/mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../../guide/mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../../guide/mission/missiondept.php'><span>Mission par département</span></a></li>
                            <li><a href='../../guide/mission/missioncloture.php'><span>Missions cloturées</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../../guide/ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='../../guide/ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a href='../../guide/ts/listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                        <div>    
                            <a class='tab' href='../../guide/exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                        <br/><br/><br/>
                        <font style=" color: black"><b><center>MISE À JOUR CLIENT</center></b></font>
                        <br/>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    </nav>
                    <!-- /tabs --> 
                <?php
            }
        ?>
                      
        <div id="container" >
            <form id="codeClientChoix" name="codeClientChoix" method="post">													                                                    
                <select name="code_client" id="code_client" style="width:173px">									
                    <!--<option>Sélectionner le Client</option>-->
                    <option value="" disabled="" selected style="display:none">Sélectionner le Client</option>
                    <?php
                        $test = mysqli_query($connect,'SELECT RefClient, NomSociete from client order by RefClient ASC;');
                        while($row = mysqli_fetch_array($test, MYSQLI_BOTH)){
                            echo '<option value="'.$row[0].'">'.$row[1].'<b> --- </b>'.$row[0].'</option>';
                        }
                    ?>																																		
                </select>                                                
                <input type="submit" name="selectionner" id="selectionner" value="Selectionner" />
            </form>
            
            
            
                        	
                        
                        <?php
                        if(isset($_POST['selectionner'])){
                            if($_POST['code_client'] == ''){						
                                echo '<font color="red"><br/>Veuillez s&eacute;lectionner un Client.</font>';																
                            }
                            else{
                                ?>
                                
                                <script>
                                    document.codeClientChoix.style.display='none';  
//                                    $('#note').css("display", "block");
                                </script>
                                <!--<div id="content">-->
                                    <div class="noty" id="noty"><b><font color="red">Note:</font></b> 
                                        <br/>&emsp; Les champs grisés sont obligatoires  
                                        <br/>&emsp; Les champs « STAT, NIF, CIF et RCS » sont à remplir dans le cas où le type du Client est « Privé »
                                    </div>
                                    <br/>
                                    <div>
                                        <!-- /top -->
                                        <div class="note" id="note"><b><font color="red">Note:</font></b> 
                                            <br/>&emsp; Les champs grisés sont obligatoires                                                                    
                                        </div>
                                        <br/><br/><br/>

                                        <!--<div id="dp">-->
                                <?php
                                $val = $_POST['code_client']; 
//                                echo 'val '.$val;
                                $req = 'SELECT RefClient, NomSociete, CodePostal, Activite, PaysRegion, Ville, Adresse, TitreContact, NomContact,Fonction, NumeroTel, NumTelecopie, NumMobile, Mail, siteweb,'
                                        . 'typeclient, stat, nif, cif, rcs, Balance '
                                        . 'FROM client '
                                        . 'where RefClient = "'.$val.'";';
                                $choice = mysqli_query($connect,$req);
                                
                                if ($result = mysqli_fetch_object($choice)){
                                    $ha_stat = $result->stat;
                                    $ha_nif = $result->nif;
                                    $ha_cif = $result->cif;
                                    $ha_rcs = $result->rcs;
                                    
                                    ?>
                                <form name="modifClient_code" id="modifClient_code" method="post"  onsubmit="return verifAll(this)">
                                        <table>
                                            <tr>
                                                <td>
                                                    <ul style=" list-style-type: none">
                                                        <table>
                                                            <b>Infos Client</b>
                                                            <tr>
                                                                <td><label for="RefClient">Code </label></td>
                                                                <td><input type="text" style=" width: 200px" name="RefClient" id="RefClient" value="<?php echo($result->RefClient)?>" readonly="true" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labNomSociete" for="NomSociete" >Nom</label></td>
                                                                <td><textarea type="text" name="NomSociete" id="NomSociete" onblur="verifChampNul(this)" readonly="true"><?php echo($result->NomSociete)?></textarea></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td><label id="labActivite" for="Activite">Secteur d'activit&eacute;</label></td>
                                                                <td><textarea type="text" name="Activite" id="Activite" onblur="verifChampNul(this)"><?php echo($result->Activite)?></textarea></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labSiteWeb" for="siteWeb">Site Web</label></td>
                                                                <td><input type="text" style=" width: 200px" name="siteWeb" id="siteWeb" value="<?php echo($result->siteweb)?>"/></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labCodePostal" for="CodePostal">Groupe </label></td>
                                                                <td><textarea type="text" name="CodePostal" id="CodePostal"><?php echo($result->CodePostal)?></textarea></td>
                                                            </tr>
                                                        </table>                                                                                    
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul style=" list-style-type: none">
                                                        <table>
                                                            <br/>
                                                            <tr>
                                                                <td><label id="labAdresse" for="Adresse">Adresse</label></td>
                                                                <td><textarea type="text" name="Adresse" id="Adresse" onblur="verifChampNul(this)"><?php echo($result->Adresse)?></textarea></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labVille" for="Ville">Ville </label></td>
                                                                <td><input type="text" style=" width: 200px" name="Ville" id="Ville" value="<?php echo($result->Ville)?>" onblur="verifChampNul(this)"/></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labPaysRegion" for="PaysRegion">Pays</label></td>
                                                                <td><input type="text" style=" width: 200px" name="PaysRegion" id="PaysRegion" value="<?php echo($result->PaysRegion)?>" onblur="verifChampNul(this)"/></td>                                                    
                                                            </tr>                                                                                                                        
                                                            <tr>
                                                                <td><label id="labNumeroTel" for="NumeroTel">N° de t&eacute;l&eacute;phone </label></td>
                                                                <td><textarea type="text" name="NumeroTel" id="NumeroTel"><?php echo($result->NumeroTel)?></textarea></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labNumTelecopie" for="NumTelecopie">N° de t&eacute;l&eacute;copie </label></td>
                                                                <td><input type="text" style=" width: 200px" name="NumTelecopie" id="NumTelecopie" value="<?php echo($result->NumTelecopie)?>" /></td>
                                                            </tr>
                                                        </table>
                                                    </ul>
                                                </td>                                                                    
                                                <td>
                                                    <ul style=" list-style-type: none">
                                                        <table>       
                                                            <br/>
                                                            <tr>
                                                                <td><label id="labTitreContact" for="TitreContact">Titre Contact </label></td>
                                                                <td><input type="text" style=" width: 200px" name="TitreContact" id="TitreContact" value="<?php echo($result->TitreContact)?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labNomContact" for="NomContact">Nom Contact </label></td>
                                                                <td><textarea type="text" name="NomContact" id="NomContact" onblur="verifChampNul(this)"><?php echo($result->NomContact)?></textarea></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labFonction" for="Fonction">Fonction </label></td>
                                                                <td><input type="text" style=" width: 200px" name="Fonction" id="Fonction" value="<?php echo($result->Fonction)?>" onblur="verifChampNul(this)"/></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labMail" for="Mail">Mail </label></td>
                                                                <td><textarea type="text" name="Mail" id="Mail"><?php echo($result->Mail)?></textarea></li><br onblur="verifChampNul(this)"/></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label id="labNumMobile" for="NumMobile">N° T&eacute;l. Mobile </label></td>
                                                                <td><textarea type="text" name="NumMobile" id="NumMobile"><?php echo($result->NumMobile)?></textarea></td>
                                                            </tr>
                                                        </table>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul style=" list-style-type: none">
                                                        <table>
                                                        <br/>
                                                        <b><span id="tit">Infos Administratives</span></b><br/>
                                                        <tr>
                                                            <td><label id="labtype">Type</label></td>
                                                            <td>
                                                                <select name="typeClient" id="typeClient" style="width:204px; height: 22px" onblur="verifChampNul(this)">
                                                                <option></option>
                                                                <optgroup label="International">
                                                                    <?php
                                                                        $reqType1 = "select Description from type
                                                                            where Description in ('International');";
                                                                        $resType = mysqli_query($connect, $reqType1) or exit(mysqli_error());
                                                                        while($rowTypeCli = mysqli_fetch_array($resType, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowTypeCli[0].'" >'.$rowTypeCli[0].'</option>';
                                                                        }
                                                                    ?>
                                                                </optgroup>
                                                                <optgroup label="Local">
                                                                    <?php
                                                                        $reqType2 = "select Description from type
                                                                        where Description in ('Public', 'Privé', 'ONG');";
                                                                        $resType2 = mysqli_query($connect, $reqType2) or exit(mysqli_error());
                                                                        while($rowTypeCli2 = mysqli_fetch_array($resType2, MYSQLI_BOTH)){
                                                                            echo '<option value="'.$rowTypeCli2[0].'" >'.$rowTypeCli2[0].'</option>';
                                                                        }
                                                                    ?>
                                                                </optgroup>
                                                            </select>
                                                                <script>
                                                                    cliType = "<?php echo($result->typeclient); ?>";                                                                    
                                                                    document.getElementById("typeClient").selectedIndex = getIndex(cliType, "typeClient");                                                                    
                                                                </script>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labstat" for="stat" > STAT</label></td>
                                                            <td><textarea type="text" name="stat" id="stat" ><?php echo($result->stat)?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labnif" for="nif" > N.I.F </label></td>
                                                            <td><textarea type="text" name="nif" id="nif" ><?php echo($result->nif)?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labcif" for="cif" > C.I.F </label></td>
                                                            <td><textarea type="text" name="cif" id="cif"><?php echo($result->cif)?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label id="labrcs" for="rcs" > R.C.S </label></td>
                                                            <td><textarea type="text" name="rcs" id="rcs"><?php echo($result->rcs)?></textarea></td>
                                                        </tr>
                                                        <tr>                                                                                                        
                                                            <td style=" width: 91px"><label id="labbalance" for="balanceagee" >Balance agée? </label></td>
                                                            <td><input type="checkbox" id="balanceagee" name="balanceagee" 
                                                                    <?php                                                                                                                                              
                                                                        $clo = $result->Balance;                                                                        
                                                                        echo 'clo: '.$clo;
                                                                        if($clo == 1){
                                                                            ?>
                                                                            checked="true"
                                                                            <?php                                                                            
                                                                        }
                                                                    ?>
                                                                /><br/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    </ul>
                                                </td>
                                                
                                            </tr>
                                        </table>
                                    <span id="spann" style="float: right; padding: 8px;"><input type="submit" disabled="disabled" name="valider" id="valider" value="Modifier" onmouseover="this.disabled='';"/></span>                                    
                                    </form>
                                    <?php
                                }
                            }
                        }
                        
                        if(isset($_POST['valider'])){
                            ?>
                            <script>
                                document.codeClientChoix.style.display='true';                    
                            </script>
                            <?php
                                                        
                            $RefClient=$_POST["RefClient"];
                            $NomSociete=$_POST["NomSociete"];
                            $CodePostal=$_POST["CodePostal"];
                            $Activite=$_POST["Activite"];
                            $PaysRegion=$_POST["PaysRegion"];
                            $Ville=$_POST["Ville"];
                            $Adresse=$_POST["Adresse"];
                            $TitreContact=$_POST["TitreContact"];
                            $NomContact=$_POST["NomContact"];
                            $Fonction=$_POST["Fonction"];
                            $NumeroTel=$_POST["NumeroTel"];
                            $NumTelecopie=$_POST["NumTelecopie"];
                            $NumMobile=$_POST["NumMobile"];
                            $Mail=$_POST["Mail"]; 
                            $siteWeb = $_POST["siteWeb"];
                            
                            $dateNow = date('Y-m-d');   
                            
                            //infos administrative
                            $typeClient = $_POST['typeClient'];
                            
                            if($_POST['typeClient'] == 'Privé'){
                                $stat = $_POST['stat'];
                                $nif  = $_POST['nif'];
                                $cif  = $_POST['cif'];
                                $rcs  = $_POST['rcs'];
                            }
                            else{
                                $stat = '';
                                $nif  = '';
                                $cif  = '';
                                $rcs  = '';
                            }
                            
                            $GroupeNom  = $_POST['NomSociete'];                                                              
                            
//                            echo 'balance agé: '.$_POST['balanceagee'];
                            
                            if($_POST['balanceagee'] == ''){
                                $clo = 0;
                            }
                            else if($_POST['balanceagee'] == 'on'){
                                $clo = 1;
                            }
                            
                            $reqnbModif = 'select max(nombremodification) as nb from client where RefClient = "'.$RefClient.'"';
                            $resnbModif = mysqli_query($connect, $reqnbModif) or exit(mysqli_error($connect));
                            $resultnbModif = mysqli_fetch_assoc($resnbModif);
                            $nbModif = $resultnbModif['nb'];

                            $nb = $nbModif  + 1; 
                        
                            //requette update
                            $mysqli->query("SET AUTOCOMMIT=0");
                            $majCliReq = 'UPDATE client SET NomSociete = "'.$NomSociete.'",
                                CodePostal = "'.$CodePostal.'",
                                Activite = "'.$Activite.'",
                                PaysRegion = "'.$PaysRegion.'",
                                Ville = "'.$Ville.'",
                                Adresse = "'.$Adresse.'",
                                TitreContact = "'.$TitreContact.'",
                                NomContact = "'.$NomContact.'",
                                Fonction = "'.$Fonction.'",
                                NumeroTel = "'.$NumeroTel.'",
                                NumTelecopie = "'.$NumTelecopie.'",
                                NumMobile = "'.$NumMobile.'",
                                Mail = "'.$Mail.'", 
                                DT = NOW(),
                                siteweb = "'.$siteWeb.'",
                                datemodification = "'.$dateNow.'",
                                nombremodification = "'.$nb.'", 
                                    typeclient = "'.$typeClient.'", 
                                    stat = "'.$stat.'", 
                                    nif = "'.$nif.'", 
                                    cif = "'.$cif.'", 
                                    rcs = "'.$rcs.'", 
                                    GroupeNom = "'.$GroupeNom.'", 
                                    Balance = "'.$clo.'",
                                usermodif = "'.$refEmp.'" 
                                where RefClient = "'.$RefClient.'" '  ;                                                        
                        
                            // echo 'RefClient '.$RefClient.'<br />';
                            // echo 'NomSociete '.$NomSociete.'<br />';
                            // echo 'CodePostal '.$CodePostal.'<br />';
                            // echo 'Activite '.$Activite.'<br />';
                            // echo 'PaysRegion '.$PaysRegion.'<br />';
                            // echo 'Adresse '.$Ville.'<br />';
                            // echo 'TitreContact '.$Adresse.'<br />';
                            // echo 'NomContact '.$TitreContact.'<br />';
                            // echo 'Fonction '.$NomContact.'<br />';
                            // echo 'NumeroTel '.$Fonction.'<br />';
                            // echo 'NumTelecopie '.$NumeroTel.'<br />';
                            // echo 'NumMobile '.$NumTelecopie.'<br />';
                            // echo 'mail '.$NumMobile.'<br />';
                        
                            //execution de la requette
                            $requette = mysqli_query($connect,$majCliReq) or exit(mysqli_error($connect));
                            if($requette) {
                                ?>
                                <script>
                                    $('#note').css("display", "none");
                                    $('#noty').css("display", "none");
                                </script>
                                <?php
                                echo '<br/><font color="green"><b><center>Modification enregistrée.</center></b></font>'; 
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
                                            . '<font color="red" size="2em"><b>La modification a &eacute;chou&eacute;e.</b></font><br/>';
                                    echo '<br/><font size="0.5em">Erreur: '.mysqli_error($connect).'</font>';
                                    echo '</b></p></div>';            
                                    $mysqli->query("ROLLBACK");exit(1);
                                    exit(mysqli_error($connect));
                                }
                            
                                $majMission = 'select RefProjet, typeclient, stat, nif, cif, rcs '
                                    . 'from projets '
                                    . 'where RefClient = "'.$RefClient.'";';
                                
                                $reqMAJMission = mysqli_query($connect, $majMission) or exit(mysqli_error($connect));
                                $colonne = mysqli_num_fields($tesita); //col 
                                if($reqMAJMission){                                    
//                                    if ($resultMAJMission = mysqli_fetch_object($reqMAJMission)){
                                    while($row = mysqli_fetch_array($reqMAJMission, MYSQLI_BOTH)){
//                                        echo 'liliiiiii: '.$resultMAJMission -> RefProjet;
                                        $missionMaj = 'update projets set '
                                            . 'typeclient = "'.$typeClient.'", '
                                            . 'stat = "'.$stat.'", '
                                            . 'nif = "'.$nif.'", '
                                            . 'cif = "'.$cif.'", '
                                            . 'rcs = "'.$rcs.'" '
                                            . 'where RefProjet = "'.$row["RefProjet"].'";';
                                        $reqMissionMAJ = mysqli_query($connect, $missionMaj);
                                        if($reqMissionMAJ){}
                                        else{
                                            echo '<br/><font size="0.5em">Erreur MAJ mission: '.mysqli_error($connect).'</font>';
                                        }
                                    }
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
                                            . '<font color="red" size="2em"><b>La modification a &eacute;chou&eacute;e au niveau de la mission.</b></font><br/>';
                                    echo '<br/><font size="0.5em">Erreur: '.mysqli_error($connect).'</font>';
                                    echo '</b></p></div>';            
                                    $mysqli->query("ROLLBACK");exit(1);
                                    exit(mysqli_error($connect));
                                }
                            }
                        ?>                                                
                    <!--</div>-->               
                    <!-- bottom -->
                </div>
            <!--</div>-->
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
                
        <script type="text/javascript">  
                $(document).ready(function(){
                    $("textarea").focus(function(e){
                    $(this).height(40);
                    $(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
                });

                $("textarea").blur(function(e){
                    $(this).height(16);
    //                        $(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
                });
                
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
                
                $('#note').css("display", "none");
                
//                $('#NomSociete').css('background-color', '#DCDCDC');
                $('#Activite').css('background-color', '#F2F1EB');
                $('#PaysRegion').css('background-color', '#F2F1EB');
                $('#Ville').css('background-color', '#F2F1EB');
                $('#Adresse').css('background-color', '#F2F1EB');
//                $('#TitreContact').css('background-color', '#F2F1EB');
                $('#NomContact').css('background-color', '#F2F1EB');
                $('#Fonction').css('background-color', '#F2F1EB');
                $('#Mail').css('background-color', '#F2F1EB');
                
                //affichage infos type de client dans la liste deroulante  
                if(cliType === 'Privé'){                        
                    $('#stat').prop("readonly", false);
                    $('#nif').prop("readonly", false);
                    $('#cif').prop("readonly", false);
                    $('#rcs').prop("readonly", false);
//                    $('#stat').css('background-color', '#F2F1EB');
//                    $('#nif').css('background-color', '#F2F1EB');
//                    $('#cif').css('background-color', '#F2F1EB');
//                    $('#rcs').css('background-color', '#F2F1EB');  
                    //$('#label').css("display", "block"); 
                    //$('#label').css("display", "block");
                }
                else{
                    $('#stat').prop("readonly", true);
                    $('#nif').prop("readonly", true);
                    $('#cif').prop("readonly", true);
                    $('#rcs').prop("readonly", true);   
                }
                
                //à la selection d'un type de client
                $("#typeClient").on('change', function(){
                    var type = $(this).val();
                    var stat = '<?php echo $ha_stat;?>';
                    var nif = '<?php echo $ha_nif;?>';
                    var cif = '<?php echo $ha_cif;?>';
                    var rcs = '<?php echo $ha_rcs;?>';
                    if(type === 'Privé'){
                        //alert("yes");
                        //alert("yes");
                        $('#stat').prop("readonly", false);
                        $('#nif').prop("readonly", false);
                        $('#cif').prop("readonly", false);
                        $('#rcs').prop("readonly", false);
                        $('#stat').css('background-color', '#F2F1EB');
                        $('#nif').css('background-color', '#F2F1EB');
                        $('#cif').css('background-color', '#F2F1EB');
                        $('#rcs').css('background-color', '#F2F1EB');                              
                        //$('#label').css("display", "block"); 
                        document.getElementById('stat').value = stat;
                        document.getElementById('nif').value = nif;
                        document.getElementById('cif').value = cif;
                        document.getElementById('rcs').value = rcs;
                    }
                    else{
                        //alert("nooo");                                                        
                        $('#stat').prop("readonly", true);
                        $('#nif').prop("readonly", true);
                        $('#cif').prop("readonly", true);
                        $('#rcs').prop("readonly", true);   
                        $('#stat').css('background-color', '#FFFFFF');
                        $('#nif').css('background-color', '#FFFFFF');
                        $('#cif').css('background-color', '#FFFFFF');
                        $('#rcs').css('background-color', '#FFFFFF'); 
                        document.getElementById('stat').value = ' -- Not Applicable -- ';
                        document.getElementById('nif').value = ' -- Not Applicable -- ';
                        document.getElementById('cif').value = ' -- Not Applicable -- ';
                        document.getElementById('rcs').value = ' -- Not Applicable -- ';
                    }
                });
                
                var profil = '<?php echo $prof;?>';
//                if(profil === "DAF"){
//                    $('#modifClient_code').find('input, button, select').attr('disabled','disabled');
//                    $("#modifClient_code").find('input, select').css('background-color', 'white');
//                    $('#note').css("display", "none");
//                    $('#valider').css("display", "none");
//                }
                if(profil !== "DAF"){                                        
                    $('#labbalance').css("display", "none");
                    $('#balanceagee').css("display", "none");
                    $('#labCodePostal').css("display", "none");
                    $('#CodePostal').css("display", "none");
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
                    $typecli = $("#typeClient").val();                   
                    if($typecli === 'Privé'){
                        var stat = verifChampNul(f.stat);
                        var nif = verifChampNul(f.nif);
                        var cif = verifChampNul(f.cif);
                        var rcs = verifChampNul(f.rcs);
                    }
                    
//                   var RefClient = verifChampNul(f.RefClient);
                   var NomSociete = verifChampNul(f.NomSociete);
                   var Activite = verifChampNul(f.Activite);var PaysRegion = verifChampNul(f.PaysRegion);var Ville = verifChampNul(f.Ville);
                   var Adresse = verifChampNul(f.Adresse);
                   var Mail = verifChampNul(f.Mail);
//                   var TitreContact = verifChampNul(f.TitreContact);
                   var NomContact = verifChampNul(f.NomContact);var Fonction = verifChampNul(f.Fonction);
                   
                   var typeClient = verifChampNul(f.typeClient);
                   
//                   var typeClient = verifChampNul(f.typeClient);
                   
                   if($typecli === 'Privé'){
                       if(
                            stat && nif && cif && rcs && 
//                            RefClient && 
                            NomSociete && Activite && PaysRegion && Ville && Adresse 
                            && Mail 
//                            && NumMobile 
//                            && TitreContact 
                            && NomContact && Fonction)
                          return true;
                        else{
                          alert("Veuillez remplir correctement tous les champs.");
                          return false;
                       }
                   }
                   else{
                        if(
//                            RefClient && 
                            NomSociete && Activite && PaysRegion && Ville && Adresse 
                            && Mail 
//                            && NumMobile 
//                            && TitreContact 
                            && NomContact && Fonction && typeClient)
                          return true;
                        else{
                          alert("Veuillez remplir correctement tous les champs.");
                          return false;
                       }
                   }
                   
                   
                }
                                
                function VerifCodeCli(code){
                    var codeCli = code.value, i, unicode;
                    var long = codeCli.length;
                    
                    if(long<3 || long>6){                        
                        if(long===0){
                            alert("Le code client ne doit pas être vide.");
//                            $('#NomSociete').css("display", "none");                            
                            $('#CodePostal').css("display", "none");
                            $('#Activite').css("display", "none");
                            $('#PaysRegion').css("display", "none");
                            $('#Ville').css("display", "none");
                            $('#Adresse').css("display", "none");
                            $('#NumeroTel').css("display", "none");
                            $('#NumTelecopie').css("display", "none");
                            $('#NumMobile').css("display", "none");
                            $('#Mail').css("display", "none");
                            $('#TitreContact').css("display", "none");
                            $('#NomContact').css("display", "none");
                            $('#Fonction').css("display", "none");
                            $('#enregistrer').css("display", "none");
                            /***LAB****/
//                            $('#labNomSociete').css("display", "none");
                            $('#labCodePostal').css("display", "none");
                            $('#labActivite').css("display", "none");
                            $('#labPaysRegion').css("display", "none");
                            $('#labVille').css("display", "none");
                            $('#labAdresse').css("display", "none");
                            $('#labNumeroTel').css("display", "none");
                            $('#labNumTelecopie').css("display", "none");
                            $('#labNumMobile').css("display", "none");
                            $('#labMail').css("display", "none");
                            $('#labTitreContact').css("display", "none");
                            $('#labNomContact').css("display", "none");
                            $('#labFonction').css("display", "none");                         
                        }
                        else if(long<3){
                            alert("Le code client est trop court(6 caractères maximum).");
//                            $('#NomSociete').css("display", "none");                            
                            $('#CodePostal').css("display", "none");
                            $('#Activite').css("display", "none");
                            $('#PaysRegion').css("display", "none");
                            $('#Ville').css("display", "none");
                            $('#Adresse').css("display", "none");
                            $('#NumeroTel').css("display", "none");
                            $('#NumTelecopie').css("display", "none");
                            $('#NumMobile').css("display", "none");
                            $('#Mail').css("display", "none");
                            $('#TitreContact').css("display", "none");
                            $('#NomContact').css("display", "none");
                            $('#Fonction').css("display", "none");
                            $('#enregistrer').css("display", "none");
                            /***LAB****/
//                            $('#labNomSociete').css("display", "none");
                            $('#labCodePostal').css("display", "none");
                            $('#labActivite').css("display", "none");
                            $('#labPaysRegion').css("display", "none");
                            $('#labVille').css("display", "none");
                            $('#labAdresse').css("display", "none");
                            $('#labNumeroTel').css("display", "none");
                            $('#labNumTelecopie').css("display", "none");
                            $('#labNumMobile').css("display", "none");
                            $('#labMail').css("display", "none");
                            $('#labTitreContact').css("display", "none");
                            $('#labNomContact').css("display", "none");
                            $('#labFonction').css("display", "none");
                        }
                        else if(long>6){
                            alert("Le code client est trop long(6 caractères maximum).");
//                            $('#NomSociete').css("display", "none");                            
                            $('#CodePostal').css("display", "none");
                            $('#Activite').css("display", "none");
                            $('#PaysRegion').css("display", "none");
                            $('#Ville').css("display", "none");
                            $('#Adresse').css("display", "none");
                            $('#NumeroTel').css("display", "none");
                            $('#NumTelecopie').css("display", "none");
                            $('#NumMobile').css("display", "none");
                            $('#Mail').css("display", "none");
                            $('#TitreContact').css("display", "none");
                            $('#NomContact').css("display", "none");
                            $('#Fonction').css("display", "none");
                            $('#enregistrer').css("display", "none");
                            /***LAB****/
//                            $('#labNomSociete').css("display", "none");
                            $('#labCodePostal').css("display", "none");
                            $('#labActivite').css("display", "none");
                            $('#labPaysRegion').css("display", "none");
                            $('#labVille').css("display", "none");
                            $('#labAdresse').css("display", "none");
                            $('#labNumeroTel').css("display", "none");
                            $('#labNumTelecopie').css("display", "none");
                            $('#labNumMobile').css("display", "none");
                            $('#labMail').css("display", "none");
                            $('#labTitreContact').css("display", "none");
                            $('#labNomContact').css("display", "none");
                            $('#labFonction').css("display", "none");
                        }
                    }
                    else{
                        for(i=0; i<long; i++){                                                                                   
                            unicode = codeCli[i].toUpperCase().charCodeAt();
                            if(unicode > 90 || unicode < 65){
                                alert("Code client: veuillez n'introduire que des lettres.");
//                                $('#NomSociete').css("display", "none");                            
                                $('#CodePostal').css("display", "none");
                                $('#Activite').css("display", "none");
                                $('#PaysRegion').css("display", "none");
                                $('#Ville').css("display", "none");
                                $('#Adresse').css("display", "none");
                                $('#NumeroTel').css("display", "none");
                                $('#NumTelecopie').css("display", "none");
                                $('#NumMobile').css("display", "none");
                                $('#Mail').css("display", "none");
                                $('#TitreContact').css("display", "none");
                                $('#NomContact').css("display", "none");
                                $('#Fonction').css("display", "none");
                                $('#enregistrer').css("display", "none");
                                /***LAB****/
//                                $('#labNomSociete').css("display", "none");
                                $('#labCodePostal').css("display", "none");
                                $('#labActivite').css("display", "none");
                                $('#labPaysRegion').css("display", "none");
                                $('#labVille').css("display", "none");
                                $('#labAdresse').css("display", "none");
                                $('#labNumeroTel').css("display", "none");
                                $('#labNumTelecopie').css("display", "none");
                                $('#labNumMobile').css("display", "none");
                                $('#labMail').css("display", "none");
                                $('#labTitreContact').css("display", "none");
                                $('#labNomContact').css("display", "none");
                                $('#labFonction').css("display", "none");  
                                break;
                            }
                            else{
                                $('#NomSociete').css("display", "inline");                            
                                $('#CodePostal').css("display", "inline");
                                $('#Activite').css("display", "inline");
                                $('#PaysRegion').css("display", "inline");
                                $('#Ville').css("display", "inline");
                                $('#Adresse').css("display", "inline");
                                $('#NumeroTel').css("display", "inline");
                                $('#NumTelecopie').css("display", "inline");
                                $('#NumMobile').css("display", "inline");
                                $('#Mail').css("display", "inline");
                                $('#TitreContact').css("display", "inline");
                                $('#NomContact').css("display", "inline");
                                $('#Fonction').css("display", "inline");
                                $('#enregistrer').css("display", "inline");
                                /***LAB****/
                                $('#labNomSociete').css("display", "inline");
                                $('#labCodePostal').css("display", "inline");
                                $('#labActivite').css("display", "inline");
                                $('#labPaysRegion').css("display", "inline");
                                $('#labVille').css("display", "inline");
                                $('#labAdresse').css("display", "inline");
                                $('#labNumeroTel').css("display", "inline");
                                $('#labNumTelecopie').css("display", "inline");
                                $('#labNumMobile').css("display", "inline");
                                $('#labMail').css("display", "inline");
                                $('#labTitreContact').css("display", "inline");
                                $('#labNomContact').css("display", "inline");
                                $('#labFonction').css("display", "inline");
                            }
                        }
                    }                    
                }                                
            </script>	
    </body>
</html>

