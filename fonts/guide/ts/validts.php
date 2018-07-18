<!DOCTYPE html>

<?php
//modification de la table temporaire de validation
//ALTER TABLE `tempvalid` ADD `Categ` VARCHAR(100) NULL AFTER `RefFP`, ADD `Depense` DOUBLE NULL AFTER `Categ`, ADD `Justificatifs` VARCHAR(500) NULL AFTER `Depense`;
//
//ALTER TABLE `tempassvalid` ADD `Categ` VARCHAR(100) NULL AFTER `RefFP`, ADD `Depense` DOUBLE NULL AFTER `Categ`, ADD `Justificatifs` VARCHAR(500) NULL AFTER `Depense`

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
        <title>Validation TS</title>
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
        <style>
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
            
            
            #OK{
                float: right;
                margin-right: 42px;
            }
            table{
                border-collapse: collapse;
            }
            #echeance td{
                border: 1px solid grey;                                
                /*border-style: none;*/
            }
            #cochetext{
                float: right;
                margin-right: 5px;
            }
            #cochetout{
                float: right;                
                margin-right: 45px;
            }  
            .colabo{
                width: 150px;                           
            }
            .daty{
                width: 90px; 
                text-align: center;
            }
            .mission{
                width: 150px;                     
            }
            .heure{
                width: 50px; 
                text-align: center;
            }
            .description{
                width: 420px;                                 
            }
            .categ{
                width: 75px;
                text-align: center;
            }
            .depense{
                width: 75px;
                text-align: center;
            }
            .justificatif{
                max-width: 200px;
                text-align: center;
                overflow: hidden;
            }
            .V{
                width: 30px; 
                text-align: center;                    
            }
            .time{
                width: 500px;
                background-color: #08C;
            }
            .dep{
                background-color: #3399ff;
                width: 250px;
                border-right-color: red;
                border-right-width: 1px
            }
            .vide{
                /*width: 50px;*/
                background-color: red;
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
                        <a class='tab selected' href='../ts/validts.php'><span style="width: 100px; text-align:center;">VALID TS</span></a>  
                    </div>
                    <div>                                        
                        <a href='../alert/index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>   
                        <ul>
                            <li><a href='../alert/alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a href='../alert/alertfacturation.php'><span>Alerte Facturation</span></a></li>
                        </ul>
                    </div>
                    <div>    
                        <a href='../exportation/index.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                                                  
                    </div>   
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>VALIDATION DES TIME SHEET</center></b></font>
                    <br/>
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    </nav>
                <?php
            }            
        ?>
                                              
        <div id="container" >            
            
                <div>
                    
                <!-- menu -->
                <div class="header">
                    <div>
                        <form name="consultTS" method="POST">	                        
                        <label for="code_mission"></label>
                        
                        <?php
                            $dateNow = date('Y-m-d');
//                            $dateNow = '2016-02-01'; 
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
                        <select name="periode" id="periode" style="width:205px">
                            <option value="" disabled="" selected style="display:none">Sélectionnez la période</option>
                            <?php
//                                $reqListPeriod = mysqli_query($connect,'select PERIODE from periode where DateEntree between "2015-01-01" and "2015-12-31";');
                                $reqListPeriod = mysqli_query($connect,'select PERIODE from periode where DateEntree between "'.$first.'" and "'.$end.'";');
                                while($rowPde = mysqli_fetch_array($reqListPeriod, MYSQLI_BOTH)){
                                    echo '<option value="'.$rowPde[0].'" >'.$rowPde[0].'</option>';
                                }
                            ?>																																		
                        </select>
                        <ul><input type="submit" name="go" id="go" value="Selectionner" /></ul>                        
                    </form>
                    </div>
                </div>
                                       
                    <!-- /menu -->
                </div>
            
            
            <!--<div id="content" style=" background-color: red">-->
                <div>
                    <!-- /top -->                    
                    <div id="dp" >
                        
                        
                        <?php
                        if (isset($_POST['go'])){
                            if($_POST['periode'] == ''){						
                                echo '<font color="red">Veuillez s&eacute;lectionner une période.</b></font>';																
                            }
                            else{                                
                                $periode = $_POST['periode'];                                                            
                                ?>
                                <!--<div id="content" style="max<t>-height: 450px;overflow: scroll;">-->
                                <center>
                                <div>
                                    <form action="./sauveTS.php" name="kaka" id="kaka" method="post">                                           
                                        <input type="checkbox" id="cochetout" /> 
                                        <span id="cochetext"> Cocher Tout </span>
                                        <br/><br/>
                                        <div>
                                            <table  border="1" max-width="1120px" > 
                                                <tr>
                                                    <td>
                                                        <table cellspacing="0" cellpadding="0" border="0"  width="1300px" >
                                                            <td class="time" colspan="5"><center>TIME SHEET</center></td>
                                                            <td class="dep" colspan="3"><center>DEPENSES LIEES</center></td>
                                                            <td class="vide"></td>
                                                        </table>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table cellspacing="0" cellpadding="0" border="0" width="1300px" style=" border-color: blue" id="echeance">
                                                            <tr>
                                                                <td class="colabo"><b><center>Collaborateur</center></b></td>
                                                                <td class="daty"><b><center>Date</center></b></td>
                                                                <td class="mission"><b><center>Mission</center></b></td>                                    
                                                                <td class="heure"><b>Heure</b></td>
                                                                <td class="description"><b><center>Description du Time Sheet</center></b></td>
                                                                <td class='categ'><b><center>Catégorie</center></b></td>
                                                                <td class='depense'><b><center>Montant</center></b></td>
                                                                <td class='justificatif'><b><center>Justificatif</center></b></td>                                                                
                                                                <td class="V"><center><b>V</b></center></td>
                                                        
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div style="width:1319px; height:318px; overflow:auto;">
                                                            <table cellspacing="0" cellpadding="0" border="0" width="1300px" id="echeance">                                                                                                                                   
                                                                    <?php
                                                                    $employe = $Nomuser;
                                                                    $reqDatEntre = 'select F.DateEntree as dte from fichepointage F '
                                                                        . 'inner join periode P on (P.DateEntree = F.DateEntree) '
                                                                        . 'where P.PERIODE = "'.$periode.'"';
                                                                    $rekDteEntre = mysqli_query($connect,$reqDatEntre);
                                                                    $resultDteEntre = mysqli_fetch_assoc($rekDteEntre);
                                                                    $dteEntre = $resultDteEntre['dte'];

                                                                    $reqRefEmploye = 'select RefEmploye as EMPLO, Profil as pro from employes where Nomuser = "'.$employe.'"';                    
                                                                    $rekRefEmp = mysqli_query($connect,$reqRefEmploye);
                                                                    $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                                                                    $refEmploye = $resultRefEmp['EMPLO'];
                                                                    $pro = $resultRefEmp['pro'];

                                                                    $compte = 0;
                                                                    $idcheck = '';
                                                                    $truncateTV = 'truncate table tempvalid;';
                                                                    $resTrunV   = mysqli_query($connect, $truncateTV)or exit(mysqli_error($connect));                                                
                                                                    $kountyTS = 0;
                                                                    $numligne = 0;
                                                                    $kountyTSASS = 0;
                                                                    if($pro == 'Manager'){                                                    
                                                                        $req = 'select DPT.RefProjet as projet, DPT.Coddept as code '
                                                                            . 'from projets P '
                                                                            . 'inner join deptprojet DPT on (P.RefProjet = DPT.RefProjet) '
                                                                            . 'inner join employes E on (E.RefEmploye = DPT.Respvalid) '
                                                                            . 'where DPT.Respvalid = "'.$refEmploye.'" ';
                                                                        $reqDept = mysqli_query($connect, $req);
                                                                        
                                                                        while ($res = mysqli_fetch_array($reqDept, MYSQLI_BOTH)) {
                                                                            $reqTS = 'insert into tempvalid (Colaborateur, Ref, Date, CodeMission, Departement, Heures, Description, '
                                                                                . 'Validation, RefFP, Categ, Depense, Justificatifs) '
                                                                                . 'select concat(E.Prenom, " ", E.NomFamille) as Colaborateur, H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
                                                                                . 'H.RefProjet as CodeMission , H.Coddept as Departement, '
                                                                                . 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, '
                                                                                . 'H.Facture as Validation,'
                                                                                . 'H.RefDetailFichePointage as RefFP, '
                                                                                    . 'FP.Categ as Categ, FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs '
                                                                                . 'from heuresfichepointage H '
                                                                                    . 'left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage)  '
                                                                                . 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
                                                                                . 'inner join employes E on (E.RefEmploye = F.RefEmploye)'
                                                                                . 'where F.DateEntree = "'.$dteEntre.'" '
                                                                                . 'and H.RefProjet = "'.$res['projet'].'" '
                                                                                . 'and H.Coddept = "'.$res['code'].'" '
                                                                                . 'and H.Facture = "0" '
                                                                                . 'and E.RefEmploye <> "'.$refEmploye.'"'
                                                                                . 'and E.Profil <> "Associé" '
                                                                                . 'ORDER BY E.Prenom , H.JourTravaille;';
                                                                            $resTS = mysqli_query($connect, $reqTS);                                                        
                                                                        }
                                                                        $reqTim = 'select Ref, Colaborateur, Date, CodeMission, Departement, Heures, Description, 
                                                                            RefFP, Validation, Categ, Depense, Justificatifs from tempvalid
                                                                            order by Colaborateur, Date, CodeMission;';
                                                                        $resTim = mysqli_query($connect, $reqTim)or exit(mysqli_error($connect));
                                                                        $kountyTS = mysqli_num_rows($resTim);
//                                                                        echo 'kkk: '.$kountyTS;
                                                                        $colonne = mysqli_num_fields($resTim); //col 
//                                                                        echo ' colonne '.$colonne;                                                                        
                                                                        $valRef = array();
                                                                        while ($rowTS = mysqli_fetch_array($resTim, MYSQLI_BOTH)) {                                                        
                                                                            $GLOBALS['compte'] = $compte +1;                                    
                                                                            $numligne = $numligne + 1;  
                                                                            if($numligne == 1){
                                                                                $valRef[$numligne] = $rowTS['Ref'];                                                                            
//                                                                                echo 'valRef '.$valRef[$numligne];
//                                                                                echo ' numLigne '.$numligne;
    //                                                                            echo "<tr id=\"".$numligne."\" onclick=\"Couleur(this.id);showFacturation('".$rowTS['Date']."', '".$rowTS['CodeMission']."', '".$rowTS['RefFP']."')\">";"<tr>";
																				
                                                                                echo "<tr id=\"".$numligne."\" onclick=\"Couleur(this.id)\">";"<tr>";
                                                                                echo "<td class='colabo'>".$rowTS['Colaborateur']."</td>"                                                                                       
                                                                                        . "<td class='daty' >".$rowTS['Date']."</td>"
                                                                                        . "<td class='mission'>".$rowTS['CodeMission']."</td>"
                                                                                        . "<td class='heure'>".$rowTS['Heures']."</td>"
                                                                                        . "<td class='description'>".$rowTS['Description']."</td>"
                                                                                        . "<td class='categ'>".$rowTS['Categ']."</td>";
                                                                                if(empty($rowTS['Depense'])){
                                                                                    echo    "<td class='depense'>".$rowTS['Depense']."</td>";
                                                                                }
                                                                                else{
                                                                                    echo    "<td class='depense'>".number_format($rowTS['Depense'], 0, ".", " ")."</td>";
                                                                                }
                                                                                echo    "<td class='justificatif'>".$rowTS['Justificatifs']."</td>"
                                                                                        . "<ul id='cases'><td id='cases[]' class='V'><center><input type='checkbox' name='modif[".$rowTS['Ref']."]' value='non' id=".$rowTS['Ref']." ><center></ul>";                                  
                                                                                echo "</input></td>";
                                                                                echo '</tr>';                                                       
                                                                            }
                                                                            else if($numligne > 1){
                                                                                $valRef[$numligne] = $rowTS['Ref'];
                                                                                $valRefFarany = $valRef[$numligne-1];
//                                                                                echo 'valref farany: '.$valRef[$numligne-1];
//                                                                                echo ' valRef '.$valRef[$numligne];
//                                                                                echo ' numLigne '.$numligne;
                                                                                                                                                                
                                                                                if($valRef[$numligne] == $valRefFarany){
//                                                                                    echo ' misy dep';
    //                                                                            echo "<tr id=\"".$numligne."\" onclick=\"Couleur(this.id);showFacturation('".$rowTS['Date']."', '".$rowTS['CodeMission']."', '".$rowTS['RefFP']."')\">";"<tr>";
                                                                                    echo "<tr id=\"".$numligne."\" onclick=\"Couleur(this.id)\">";"<tr>";
                                                                                    echo "<td class='colabo' style='border:none'></td>"
                                                                                            . "<td class='daty' style='border:none'></td>"                                                                                            
                                                                                            . "<td class='mission' style='border:none'></td>"
                                                                                            . "<td class='heure' style='border:none'></td>"
                                                                                            . "<td class='description' style='border:none'></td>"
                                                                                            . "<td class='categ'>".$rowTS['Categ']."</td>";
                                                                                    if(empty($rowTS['Depense'])){
                                                                                        echo    "<td class='depense'>".$rowTS['Depense']."</td>";
                                                                                    }
                                                                                    else{
                                                                                        echo    "<td class='depense'>".number_format($rowTS['Depense'], 0, ".", " ")."</td>";
                                                                                    }
                                                                                    
                                                                                    echo    "<td class='justificatif'>".$rowTS['Justificatifs']."</td>"
                                                                                            . "<ul id='cases'><td style='border:none' id='cases[]' class='V'><center><center></ul>";                                  
                                                                                    echo "</input></td>";
                                                                                    echo '</tr>';                                                       
                                                                                }
                                                                                else{
//                                                                                    echo ' tsisy dep';
    //                                                                            echo "<tr id=\"".$numligne."\" onclick=\"Couleur(this.id);showFacturation('".$rowTS['Date']."', '".$rowTS['CodeMission']."', '".$rowTS['RefFP']."')\">";"<tr>";
                                                                                    echo "<tr id=\"".$numligne."\" onclick=\"Couleur(this.id)\">";"<tr>";
                                                                                    echo "<td class='colabo'>".$rowTS['Colaborateur']."</td>"                                                                                            
                                                                                            . "<td class='daty' >".$rowTS['Date']."</td>"
                                                                                            . "<td class='mission'>".$rowTS['CodeMission']."</td>"
                                                                                            . "<td class='heure'>".$rowTS['Heures']."</td>"
                                                                                            . "<td class='description'>".$rowTS['Description']."</td>"
                                                                                            . "<td class='categ'>".$rowTS['Categ']."</td>";
                                                                                    if(empty($rowTS['Depense'])){
                                                                                        echo    "<td class='depense'>".$rowTS['Depense']."</td>";
                                                                                    }
                                                                                    else{
                                                                                        echo    "<td class='depense'>".number_format($rowTS['Depense'], 0, ".", " ")."</td>";
                                                                                    }                                                                                    
                                                                                    echo    "<td class='justificatif'>".$rowTS['Justificatifs']."</td>"
                                                                                            . "<ul id='cases'><td id='cases[]' class='V'><center><input type='checkbox' name='modif[".$rowTS['Ref']."]' value='non' id=".$rowTS['Ref']." ><center></ul>";                                  
                                                                                    echo "</input></td>";
                                                                                    echo '</tr>';                                                       
                                                                                }
                                                                            }
                                                                        }   
//                                                                        echo 'valRef '.$valRef;
                                                                    }

                                                                    else if($pro == 'Associé'){
                                                                        $truncateTAss = 'truncate table tempassvalid;';
                                                                        $resTrunTAss   = mysqli_query($connect, $truncateTAss)or exit(mysqli_error($connect));
                                                                        $reqManager = 'select F.RefFichePointage as FRP, D.RefProjet as projet, D.Coddept as coddept, '
                                                                                . 'concat(E.Prenom, " ", E.NomFamille) as prenom '
                                                                                . 'from fichepointage F '
                                                                                . 'inner join deptprojet D on (D.Respvalid = F.RefEmploye) '
                                                                                . 'inner join employes E on (E.RefEmploye = D.Respvalid)'
                                                                                . 'where F.dateentree = "'.$dteEntre.'" '
                                                                                . 'and D.Dirmission = "'.$refEmploye.'" '
                                                                                . 'order by E.Prenom';                                
                                                                        $resMan = mysqli_query($connect, $reqManager);                                                    
                                                                        while ($res = mysqli_fetch_array($resMan, MYSQLI_BOTH)){
//                                                                            echo '<br/>Projet: '.$res['projet']. ' - prenom: '.$res['prenom'];
                                                                            $reqTSMan = 'select H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
                                                                                    . 'H.RefProjet as CodeMission , H.Coddept as Departement, '
                                                                                    . 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, '
                                                                                    . 'H.Facture as Validation,'
                                                                                    . 'H.RefDetailFichePointage as RefFP, '
                                                                                    . 'FP.Categ as Categ, FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs '
                                                                                    . 'from heuresfichepointage H '
                                                                                    . 'left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage) '
                                                                                    . 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
                                                                                    . 'where H.RefFichePointage = "'.$res['FRP'].'" '
                                                                                    . 'and H.RefProjet = "'.$res['projet'].'" '
                                                                                    . 'and H.Coddept = "'.$res['coddept'].'"'
                                                                                    . 'and H.Facture = "0" '
                                                                                    . 'order by H.JourTravaille';
                                                                            $resTSMan = mysqli_query($connect, $reqTSMan);
                                                                            if(!$resTSMan){
                                                                                echo '<br/>Une erreur est survenu: '.  mysqli_error($connect);
                                                                            }
                                                                            else{                                                                                    
                                                                                while ($rowTSMan = mysqli_fetch_array($resTSMan, MYSQLI_BOTH)) {                                                                                    
//                                                                                    echo 'lala '.$rowTSMan['Depense'];
                                                                                    $reqTSAss = 'insert into tempassvalid (Colaborateur, Ref, Date, CodeMission, Departement, Heures, Description, Validation, RefFP, '
                                                                                            . 'Categ, Depense, Justificatifs) '
                                                                                            . 'values '
                                                                                            . ' ("'.$res['prenom'].'" , '.$rowTSMan['Ref'].', "'.$rowTSMan['Date'].'", "'.$rowTSMan['CodeMission'].'",'
                                                                                            . ' "'.$rowTSMan['Departement'].'", "'.$rowTSMan['Heures'].'", "'.$rowTSMan['Description'].'", "'.$rowTSMan['Validation'].'",'
//                                                                                            . ' "'.$rowTSMan['RefFP'].'", "'.$rowTSMan['Categ'].'", "'.number_format((double)$rowTSMan['Depense'], 2, ".", " ").'", "'.$rowTSMan['Justificatifs'].'");';
                                                                                            . ' "'.$rowTSMan['RefFP'].'", "'.$rowTSMan['Categ'].'", "'.$rowTSMan['Depense'].'", "'.$rowTSMan['Justificatifs'].'");';
                                                                                    $resTSASs = mysqli_query($connect, $reqTSAss); // or exit(mysqli_error($connect));                                   
                                                                                    if($resTSASs){}
                                                                                    else{
//                                                                                        echo 'diso '.mysqli_error($connect);
                                                                                    }
                                                                                }
                                                                            }
                                                                        } 
                                                                        $valRefAss = array();
                                                                        $reqAssTs = 'select Ref, Colaborateur, Date, CodeMission, Departement, Heures, Description, 
                                                                            RefFP, Validation, Categ, Depense, Justificatifs from tempassvalid
                                                                            order by Colaborateur, Date, CodeMission;';
                                                                        $resTAssTS = mysqli_query($connect, $reqAssTs)or exit(mysqli_error($connect));
                                                                        $kountyTS = mysqli_num_rows($resTAssTS);
//                                                                        echo 'kkk: '.$kountyTS;
                                                                        while ($rowTSMan = mysqli_fetch_array($resTAssTS, MYSQLI_BOTH)){
                                                                            $kountyTSASS = $kountyTSASS + 1;
                                                                            $numligne = $numligne + 1; 
                                                                            $GLOBALS['compte'] = $compte +1;
                                                                            if($numligne == 1){
                                                                                echo '';
//                                                                                echo "<tr id=\"".$numligne."\" onclick=\"CouleurAss(this.id);showFacturation('".$rowTSMan['Date']."', '".$rowTSMan['CodeMission']."', '".$rowTSMan['RefFP']."')\">";"<tr>";                                                                                                                                
                                                                                echo "<tr id=\"".$numligne."\" onclick=\"CouleurAss(this.id);\">";"<tr>";
                                                                                echo "<td class='colabo'>".$rowTSMan['Colaborateur']."</td>"
//                                                                                        . "<td class='daty'>".$rowTSMan['Ref']."</td>"
                                                                                        . "<td class='daty'>".$rowTSMan['Date']."</td>"
                                                                                        . "<td class='mission'>".$rowTSMan['CodeMission']."</td>"
                                                                                        . "<td class='heure'>".$rowTSMan['Heures']."</td>"
                                                                                        . "<td class='description'>".$rowTSMan['Description']."</td>"
                                                                                        . "<td class='categ'>".$rowTSMan['Categ']."</td>";
//                                                                                        . "<td class='depense'>".number_format((double)$rowTSMan['Depense'], 2, ".", " ")."</td>"                                                                                        
                                                                                if(empty($rowTSMan['Depense']) || $rowTSMan['Depense'] == '0'){
                                                                                    echo    "<td class='depense'></td>";
                                                                                }
                                                                                else{
//                                                                                    echo    "<td class='depense'>".$rowTSMan['Depense']."</td>";
                                                                                    echo    "<td class='depense'>".number_format($rowTSMan['Depense'], 0, ".", " ")."</td>";
                                                                                }
                                                                                
                                                                                echo    "<td class='justificatif'>".$rowTSMan['Justificatifs']."</td>"
                                                                                        . "<td class='V'><center><input type='checkbox' name='modif[".$rowTSMan['Ref']."]' value='non' id=".$rowTSMan['Ref']."></center>";
                                                                                echo "</input></td>";
                                                                                echo '</tr>';
                                                                            }
                                                                            else if($numligne > 1){
//                                                                                echo 'numLigne '.$numligne;
                                                                                $valRefAss[$numligne] = $rowTSMan['Ref'];
                                                                                $valRefFaranyAss = $valRefAss[$numligne-1];
                                                                                if($valRefAss[$numligne] == $valRefFaranyAss){
                                                                                    echo '';
//                                                                                    echo "<tr id=\"".$numligne."\" onclick=\"CouleurAss(this.id);showFacturation('".$rowTSMan['Date']."', '".$rowTSMan['CodeMission']."', '".$rowTSMan['RefFP']."')\">";"<tr>";                                                                                                                                
                                                                                    echo "<tr id=\"".$numligne."\" onclick=\"CouleurAss(this.id);\">";"<tr>";
                                                                                    echo "<td class='colabo'></td>"
    //                                                                                        . "<td class='daty'>".$rowTSMan['Ref']."</td>"
                                                                                            . "<td class='daty'></td>"
                                                                                            . "<td class='mission'></td>"
                                                                                            . "<td class='heure'></td>"
                                                                                            . "<td class='description'></td>";
                                                                                    echo    "<td class='categ'>".$rowTSMan['Categ']."</td>";
//                                                                                            . "<td class='depense'>".number_format((double)$rowTSMan['Depense'], 2, ".", " ")."</td>"                                                                                        
                                                                                    if(empty($rowTSMan['Depense']) || $rowTSMan['Depense'] == '0'){
                                                                                        echo    "<td class='depense'></td>";
                                                                                    }
                                                                                    else{
    //                                                                                    echo    "<td class='depense'>".$rowTSMan['Depense']."</td>";
                                                                                        echo    "<td class='depense'>".number_format($rowTSMan['Depense'], 0, ".", " ")."</td>";
                                                                                    }
                                                                                    
                                                                                    echo    "<td class='justificatif'>".$rowTSMan['Justificatifs']."</td>"
                                                                                            . "<td class='V'><center></center>";
                                                                                    echo "</input></td>";
                                                                                    echo '</tr>';
                                                                                }
                                                                                else{
                                                                                    echo '';
//                                                                                    echo "<tr id=\"".$numligne."\" onclick=\"CouleurAss(this.id);showFacturation('".$rowTSMan['Date']."', '".$rowTSMan['CodeMission']."', '".$rowTSMan['RefFP']."')\">";"<tr>";                                                                                                                                
                                                                                    echo "<tr id=\"".$numligne."\" onclick=\"CouleurAss(this.id);\">";"<tr>";
                                                                                    echo "<td class='colabo'>".$rowTSMan['Colaborateur']."</td>"
    //                                                                                        . "<td class='daty'>".$rowTSMan['Ref']."</td>"
                                                                                            . "<td class='daty'>".$rowTSMan['Date']."</td>"
                                                                                            . "<td class='mission'>".$rowTSMan['CodeMission']."</td>"
                                                                                            . "<td class='heure'>".$rowTSMan['Heures']."</td>"
                                                                                            . "<td class='description'>".$rowTSMan['Description']."</td>"
                                                                                            . "<td class='categ'>".$rowTSMan['Categ']."</td>";
//                                                                                            . "<td class='depense'>".number_format((double)$rowTSMan['Depense'], 2, ".", " ")."</td>"                                                                                        
                                                                                    if(empty($rowTSMan['Depense']) || $rowTSMan['Depense'] == '0'){
                                                                                        echo    "<td class='depense'></td>";
                                                                                    }
                                                                                    else{
    //                                                                                    echo    "<td class='depense'>".$rowTSMan['Depense']."</td>";
                                                                                        echo    "<td class='depense'>".number_format($rowTSMan['Depense'], 0, ".", " ")."</td>";
                                                                                    }                                                                                   
                                                                                    echo    "<td class='justificatif'>".$rowTSMan['Justificatifs']."</td>"
                                                                                            . "<td class='V'><center><input type='checkbox' name='modif[".$rowTSMan['Ref']."]' value='non' id=".$rowTSMan['Ref']."></center>";
                                                                                    echo "</input></td>";
                                                                                    echo '</tr>';
                                                                                }                                                                                
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>                                                                                                                                                                                                                                                                
                                            </table>
                                        </div>
                                        
                                        <div id="factContainer">            
                                        </div><br/>
                                        <span id="spann" style="float: right; padding: 8px;"><input type="submit" disabled="disabled" name="OK" id="OK" value="Valider"  onmouseover="this.disabled='';"/></span>                                        
                                    </form>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        </center>
                    </div>               
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
            
         <script>                                                                              
            $(document).ready(function() {                                    
                if($('#OK').is(':disabled')){
//                        alert("disa");                        
                        $('#spann').bind({
                            mouseenter: function(e) {
                                // Hover event handler
                                $('#OK').attr('disabled', false);                                  
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

                $('#OK').on('mouseout', function(){                        
                    $('#OK').attr('disabled', 'disabled');                            
                });
                
                var selected = '<?php echo $periode;?>';             
                document.getElementById('periode').value = selected;
                               
                $("#cochetout").click(function(){                                                              
                    if(this.checked){                         
                        $('input[type=checkbox]').prop('checked', true);
                        $('#cochetext').html('Tout decocher'); 
                     }
                     else{
                        $('input[type=checkbox]').prop('checked', false);
                        $('#cochetext').html('Cocher tout');
                     }                               
                });
            });

            function showFacturation(dateMvt, codeMiss, refFP){                   
                $("#factContainer").load("./getMvtFact.php?dateMvt="+dateMvt+"&codeMiss="+codeMiss+"&refFP="+refFP);
            }
            
            function Couleur(id){                
                var nbLigne = '<?php echo $kountyTS;?>';                                                                                                 
                this.id = id;                                
                this.couleur = '#D8D8D8';
                
                for(i=1;i<=nbLigne;i++){                    
                    if(i==this.id){                        
                        if (typeof this.highlighted==='undefined' || this.highlighted===''){
                            document.getElementById(this.id).style.background = this.couleur;
                            this.highligted=this.id;                            
                        }                        
                    }
                    else{                        
                        document.getElementById(i).style.background = "transparent";
                    }
                }                                
            }
            
            function CouleurAss(id){                
                var nbLigne = '<?php echo $kountyTSASS;?>';                                                                                                 
                this.id = id;                                
                this.couleur = '#D8D8D8';
                
                for(i=1;i<=nbLigne;i++){                    
                    if(i==this.id){                        
                        if (typeof this.highlighted==='undefined' || this.highlighted===''){
                            document.getElementById(this.id).style.background = this.couleur;
                            this.highligted=this.id;                            
                        }                        
                    }
                    else{                        
                        document.getElementById(i).style.background = "transparent";
                    }
                }                                
            }
        </script>
    </body>
</html>

