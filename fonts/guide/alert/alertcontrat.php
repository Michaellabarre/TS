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
        <title>Alert Contrat</title>
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
	<!-- /head -->
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
            
            #deco{
                float: right;
            }
            table{
                border-collapse: collapse;
                
            }
            td{
                border: 1px solid black;
                border-style: dotted;
                border-color: #1c4e63;
            }
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
                        </ul>
                    </div>
                    <div>    
                        <a href='../ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='../ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a href='../ts/listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                    <div>                                        
                        <a class='tab' href='../ts/validts.php'><span style="width: 100px; text-align:center;">VALID TS</span></a>  
                    </div>
                    <div>                                        
                        <a class='tab selected' href='index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>   
                        <ul>
                            <li><a class='tab selected' href='./alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a href='./alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a class='tab' href='../exportation/index.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>LISTE DES MISSIONS DE CONTRAT NON SIGNE</center></b></font>
                    <br/>
                    </nav>
                <?php
            }            
            else if($prof == 'DAF'){
                ?>
                <nav class="menu">  
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
                        <a href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>                             
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Fiche de Mission</span></a></li> 
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->
                        </ul>
                    </div>                                        
                    <div>                                        
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>
                        <ul>
                            <li><a class='tab selected' href='./alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a href='./alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a href='../exportation/exportation.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                          
                    </div>                
                    <div>    
                        <a class='tab' href='../ts/vuets.php'><span style="width: 100px; text-align:center;">VUE TS</span></a>                                                         
                    </div> 
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>LISTE DES MISSIONS DE CONTRAT NON SIGNE</center></b></font>
                    <br/>
                    </nav>
                <?php
            }            
        ?>
                      
        <div id="container" >            
            
            
                <div>
                    <!-- /top -->                    
                    <div id="dp" style="max-height: 500px;overflow: scroll; top: 500px">                        
                        <form name="missionDept" method="post">	                                                        
                            <label for="code_dept"></label>							
                            <select name="code_dept" id="code_dept">									
                                <!--<option>Sélectionnez le département</option>-->
                                <option value="" disabled="" selected style="display:none">Sélectionnez le département</option>
                                <option>TOUS LES DEPARTEMENTS</option>
                                <?php
                                    $reqDept = mysqli_query($connect,'select Departement from departement '                                        
                                        . 'order by Departement ASC;');
                                    while($r = mysqli_fetch_array($reqDept, MYSQLI_BOTH)){
                                            echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                    }
                                ?>																																		
                            </select>                                                        
                            <input type="submit" name="selectionner" value="Selectionner" />
                        </form>
                        
                        <?php
                            if(isset($_POST['selectionner'])){
                                if($_POST['code_dept'] == ''){						
                                    echo '<font color="red"><br/>Veuillez s&eacute;lectionner un département.</font>';
                                }
                                else if($_POST['code_dept'] == 'TOUS LES DEPARTEMENTS'){
                                    echo '<center>';
                                    $dept   = $_POST['code_dept'];
                                    $reqCodeDept = 'select Coddept as code from departement '
                                            . 'where Departement = "'.$dept.'"';
                                    $reqCD       = mysqli_query($connect, $reqCodeDept);
                                    $resultCD    = mysqli_fetch_assoc($reqCD);
                                    $codeDept    = $resultCD['code'];                                                
//                                    echo 'codedept '.$codeDept;
                                    
                                    $reqContrat = 'select P.RefProjet, P.NomProjet, C.NomSociete, P.TypeProjet, P.Datesignature, P.Datearchctr, P.DateDebutProjet,
                                        P.DateFinProjet, P.DateDebutR, P.DateFinR
                                        from projets P
                                        inner join deptprojet D on (D.RefProjet = P.RefProjet)
                                        inner join client C on (P.RefClient = C.RefClient)                                         
                                        where Datesignature is null 
                                        and TypeProjet = "MISSION"
                                        order by RefProjet ASC;';
                                    
                                    $recContrat = mysqli_query($connect,$reqContrat);
                                    $ligne      = mysqli_num_rows($recContrat);
                                    
                                    if($ligne==0){
                                        echo '<br/><font color="red"><center>Aucune alerte pour '.$dept.'.</center></font>';
                                    }                                    
                                    else if ($resultMissionAffect = mysqli_fetch_object($recContrat)){
                                    $tesita = mysqli_query($connect, $reqContrat) or exit(mysqli_error($connect));                            
                                    $colonne = mysqli_num_fields($tesita); //col                            
                                    $ligne = mysqli_num_rows($tesita); //rows   
                                    echo '<br/>';
                                    echo '<div>';
                                    echo '<table>';
                                    echo '<tr>';
                                    echo '<td><center><b><font color="">Code Mission</font></b></center></td>';
                                    echo '<td><center><b><font color="">Mission</font></b></center></td>';
                                    echo '<td><center><b><font color="">Client</font></b></center></td>';
                                    echo '<td><center><b><font color="">Catégorie</font></b></center></td>';
                                    echo '<td><center><b><font color="red">Date Signature Contrat</font></b></center></td>';
                                    echo '<td><center><b><font color="">Date d\'archivage</font></b></center></td>';
                                    echo '<td><center><b><font color="">Début du Projet</font></b></center></td>';
                                    echo '<td><center><b><font color="">Fin du projet</font></b></center></td>';
                                    echo '<td><center><b><font color="">Début Reel du Projet</font></b></center></td>';
                                    echo '<td><center><b><font color="">Fin réel du Projet</font></b></center></td>';
                            //        while ($fieldinfo=mysqli_fetch_field($tesita)){
                            //                echo '<td><b>'.$fieldinfo->name.'</b></td>';
                            //        }
                                    echo '</tr>';

                                    while($row = mysqli_fetch_array($tesita, MYSQLI_BOTH)){
                                            echo '<tr>';
                                            for($j=0; $j < $colonne ; $j++){
                                                switch($j){
                                                    case 0 : 
                                                        echo '<td><a href="../mission/missionfiltre.php?test='.str_replace('+', '%2B', $row[$j]).'">'.$row[$j].'</a></td>';break;
                                                    case 1 : case 2 : 
                                                            echo '<td>'.$row[$j].'</td>';break;                                                                                
                                                    case 3 :
                                                        echo '<td><center>'.$row[$j].'</center></td>';break;                                                                                
                                                    case 4 : case 5 : case 6 : case 7 : case 8 : case 9 :
                                                        echo '<td><center>'.  dateChange($row[$j]).'</center></td>';break;                                                                                                            
                                                }                        
                                            }
                                            echo '</tr>';
                                    }
                                    echo '</table> </div>';	

        //                            afficheContrat($reqContrat);
                                    }
                                }
                                else{
                                    echo '<center><br/>';
                                    
                                    $dept   = $_POST['code_dept'];
                                    $reqCodeDept = 'select Coddept as code from departement '
                                            . 'where Departement = "'.$dept.'"';
                                    $reqCD       = mysqli_query($connect, $reqCodeDept);
                                    $resultCD    = mysqli_fetch_assoc($reqCD);
                                    $codeDept    = $resultCD['code'];                                                
//                                    echo 'codedept '.$codeDept;
                                    
                                    $reqContrat = 'select P.RefProjet, P.NomProjet, C.NomSociete, P.TypeProjet, P.Datesignature, P.Datearchctr, P.DateDebutProjet,
                                        P.DateFinProjet, P.DateDebutR, P.DateFinR
                                        from projets P
                                        inner join deptprojet D on (D.RefProjet = P.RefProjet)
                                        inner join client C on (P.RefClient = C.RefClient)                                         
                                        where D.Coddept = "'.$codeDept.'"
                                        and Datesignature is null 
                                        and TypeProjet = "MISSION"
                                        order by RefProjet ASC;';
                                    $recContrat = mysqli_query($connect,$reqContrat);
                                    $ligne      = mysqli_num_rows($recContrat);
                                    
                                    if($ligne==0){
                                        echo '<br/><font color="red"><center>Aucune alerte pour le département '.$dept.'.</center></font>';
                                    }                                    
                                    else if ($resultMissionAffect = mysqli_fetch_object($recContrat)){
                                    $tesita = mysqli_query($connect, $reqContrat) or exit(mysqli_error($connect));                            
                                    $colonne = mysqli_num_fields($tesita); //col                            
                                    $ligne = mysqli_num_rows($tesita); //rows   
                                    echo '<div>';
                                    echo '<table>';
                                    echo '<tr>';
                                    echo '<td><b><font color="">Code Mission</font></b></td>';
                                    echo '<td><b><font color="">Mission</font></b></td>';
                                    echo '<td><b><font color="">Client</font></b></td>';
                                    echo '<td><b><font color="">Catégorie</font></b></td>';
                                    echo '<td><b><font color="red">Date Signature Contrat</font></b></td>';
                                    echo '<td><b><font color="">Date d\'archivage</font></b></td>';
                                    echo '<td><b><font color="">Début du Projet</font></b></td>';
                                    echo '<td><b><font color="">Fin du projet</font></b></td>';
                                    echo '<td><b><font color="">Début Reel du Projet</font></b></td>';
                                    echo '<td><b><font color="">Fin réel du Projet</font></b></td>';
                            //        while ($fieldinfo=mysqli_fetch_field($tesita)){
                            //                echo '<td><b>'.$fieldinfo->name.'</b></td>';
                            //        }
                                    echo '</tr>';

                                    while($row = mysqli_fetch_array($tesita, MYSQLI_BOTH)){
                                            echo '<tr>';
                                            for($j=0; $j < $colonne ; $j++){
                                                switch($j){
                                                    case 0 : 
                                                        echo '<td><a href="../mission/missionfiltre.php?test='.str_replace('+', '%2B', $row[$j]).'">'.$row[$j].'</a></td>';break;                                                                                                                                        
                                                    case 1 : case 2 : case 3 :
                                                        echo '<td>'.$row[$j].'</td>';break;                                                                                
                                                    case 4 : case 5 : case 6 : case 7 : case 8 : case 9 :
                                                        echo '<td>'.  dateChange($row[$j]).'</td>';break;                                                                                                            
                                                }                        
                                            }
                                            echo '</tr>';
                                    }
                                    echo '</table> </div>';	

        //                            afficheContrat($reqContrat);
                                }
                                }
                            }
                        ?>                                                
                        </center>
                    </div>               
                    <!-- bottom -->
                </div>
            
        </div>
    </div>
  
    <script type="text/javascript">
        $(document).ready(function() {
            var dept = '<?php echo $dept;?>';
            document.getElementById('code_dept').value = dept; 
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

