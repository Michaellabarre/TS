﻿<!DOCTYPE html>

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
        <title>Lister Time Sheet</title>
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
            
            table{
                border-collapse: collapse;
                
            }
            td{
                border: 1px solid black;
                border-style: dotted;
                border-color: #1c4e63;
            }
            #blanl{
                border: none;
                border-style: none;
            }
        </style>
    </head>
    <body>

  <!-- top -->
    <?php if (login_check($mysqli) == true) : ?>
        <div id="header">            
            
            <?php
                $Nomuser      = $_SESSION['username'];   
                
                $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$Nomuser.'"';                    
                $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                $refEmploye = $resultRefEmp['EMPLO'];
                
                $reky         = 'select RefEmploye as ref, Prenom as prenom, NomFamille as nom from employes '
                    . 'where Nomuser = "'.$Nomuser.'"';
                $rekPrenom    = mysqli_query($connect,$reky);
                $resultPrenom = mysqli_fetch_assoc($rekPrenom);
                $prenom       = $resultPrenom['prenom'];
                $nom          = $resultPrenom['nom'];
                $refEm        = $resultPrenom['ref'];
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
                        <a class='tab selected' href='../ts/index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='../ts/saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a class='tab selected' href='../ts/listets.php'><span>Lister Time Sheet</span></a></li>
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
                    <font style=" color: black"><b><center>DETAILS DU TIME SHEET</center></b></font>
                    <br/>
                    </nav>
                <?php
            }
            else if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Collaborateur' or $prof == 'Superviseur' or $prof == 'Collaboratrice'){
                ?>
                <!-- tabs -->
                    <nav class="menu">                    
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
                        </div>
                        <br/><br/><br/>
                        <font style=" color: black"><b><center>DETAILS DU TIME SHEET</center></b></font>
                        <br/>
                    </nav>
                    <!-- /tabs -->
                <?php
            }            
            else if($prof == 'Assistant(e) Manager'  ){
                ?>
                <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
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
                        <a class='tab' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>                        
                        <ul>
                            <li><a href='../mission/nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='../mission/missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='../mission/missiondept.php'><span>Mission par département</span></a></li>
                            <!--<li><a href='../mission/missioncloture.php'><span>Missions cloturées</span></a></li>-->                        
                        </ul>
                    </div>
                    <div>    
                        <a class='tab selected' href='./index.php'><span style="width: 100px; text-align:center;">TIME SHEET</span></a> 
                        <ul>
                            <li><a href='./saisits.php'><span>Saisir Time Sheet</span></a></li>
                            <li><a class='tab selected' href='./listets.php'><span>Lister Time Sheet</span></a></li>
                        </ul>
                    </div>
                        <div>    
                            <a class='tab' href='../exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>DETAILS DU TIME SHEET</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs -->
                <?php
            }            
        ?>
                      
        <div id="container" >            
            
            
                <div>
                    <!-- /top -->                    
                    <div id="dp">
                        <center>
                        <?php
                            $dateNow = date('Y-m-d');
//                            $dateNow = '2016-01-01';  
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
                        $reqListPeriod = mysqli_query($connect,'select PERIODE from periode where DateEntree between "'.$first.'" and "'.$end.'";');
//                        $reqListPeriod = mysqli_query($connect,'select PERIODE from periode where DateEntree between "2015-01-01" and "2015-12-31";');
                        if($prof == 'Associé' or $prof == 'Manager' or $prof == 'DAF'){
                            $reqNomCons = mysqli_query($connect,'select RefEmploye as Code, concat(Prenom, " ", NomFamille) as nomPre 
                            FROM employes where 
                            actif = 0 and 
                            RefEmploye not in ("Z05", "Z06", "Z07", "ZA1", "ZA2", "ZA3", "ZZZ") 
                            ORDER BY Prenom ASC;');
                        }
                        else if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Assistant(e) Manager' or $prof == 'Collaborateur' 
                        or $prof == 'Collaboratrice' or $prof == 'Superviseur'  ){
                            $reqNomCons = mysqli_query($connect,'select concat(E.Prenom, " ", E.NomFamille) from employes where RefEmploye = "'.$refEmploye.'";');
                        }
                        ?>
                        <form name="consultTS" method="POST">
                            S&eacute;l&eacute;ctionner la p&eacute;riode                                    
                                <select name="periode" id="periode" style="width: 210px">
                                    <option></option>
                                        <?php
	                                            while($rowPde = mysqli_fetch_array($reqListPeriod, MYSQLI_BOTH)){
                                                    echo '<option value="'.$rowPde[0].'" >'.$rowPde[0].'</option>';
                                            }
                                        ?>
                                </select>
                            
                            <?php
                                if($prof == 'Associé' or $prof == 'Manager' or $prof == 'DAF'){
                            ?>
                            Collaborateur                                    
                                <select name="nomCons" id="nomCons" style="width: 250px">                                            
                                    <option></option>
                                        <?php
                                            while($rowNomCons = mysqli_fetch_array($reqNomCons, MYSQLI_BOTH)){
                                                echo '<option value="'.$rowNomCons[0].'" >'.$rowNomCons[1].'</option>';
                                            }
                                        ?>

                                </select>                            
                            <?php
                                }
                            ?>
                            <input type="submit" name="go" value="Selectionner" />
                        </form>
                        
                        <?php                        
                        if (isset($_POST['go'])){  
                            $dep = array();
                            $periode = $_POST['periode']; //periode: 
                            
                            if($prof == 'Consultant' or $prof == 'Consultante' or $prof == 'Assistant(e) Manager' or $prof == 'Collaborateur' 
                                or $prof == 'Collaboratrice'){
                                $consu = $refEm;
                            }                            
                            else if($prof == 'Associé' or $prof == 'Manager' or $prof == 'DAF'){
                                $consu = $_POST['nomCons'];
                            }
                            
//                            $reqCodeEmp = 'select RefEmploye as EMP from employes where Prenom = "'.$consu.'"';
//                            $rekCodeEmp = mysqli_query($connect,$reqCodeEmp);											
//                            $resultCodeEmp = mysqli_fetch_assoc($rekCodeEmp);
//                            $refEmp = $resultCodeEmp['EMP'];
                            
                            $refEmp = $consu;
                            
                            $reqheuretot = 'select sum(H.HeureFacturables) as tot
                            from heuresfichepointage H
                            left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage)     
                            inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) 
                            inner join employes E on (E.RefEmploye = F.RefEmploye)
                            inner join projets P on (P.RefProjet = H.RefProjet) 
                            where H.RefFichePointage in 
                            (
                                select RefFichePointage as refFiche 
                                from fichepointage 
                                inner join periode P on (fichepointage.DateEntree = P.DateEntree)
                                where P.PERIODE = "'.$periode.'"                
                            )        
                            and F.RefEmploye = "'.$refEmp.'"
                            order by H.JourTravaille ASC, H.RefDetailFichePointage ;';
                            $resheureTot= mysqli_query($connect,$reqheuretot);
                            $resultheureTot = mysqli_fetch_assoc($resheureTot);
                            $heureTot = $resultheureTot['tot'];                                                         
                            
                            echo '<br><b>P&eacute;riode: </b>'.$periode;                                                                                                                                            
//                            echo '<br/><b>Consultant: </b>'.$consu;                                                                                                                                            
                            echo '<br/><b>Heure Totale: </b>'.$heureTot;  
                            
                                                        
                            echo '<br/><br/><br/>';   
                            
                            $reqTSEx = 'select H.RefDetailFichePointage as Ref, concat(E.Prenom, " ", E.NomFamille) as Nom, H.JourTravaille as Date, 
                            H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, 
                            H.HeureFacturables as Heures, H.DescriptionTravail, H.Facture as Validation, 
                            FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs 
                            from heuresfichepointage H
                            left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage)     
                            inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) 
                            inner join employes E on (E.RefEmploye = F.RefEmploye)
                            inner join projets P on (P.RefProjet = H.RefProjet) 
                            where H.RefFichePointage in 
                            (
                                select RefFichePointage as refFiche 
                                from fichepointage 
                                inner join periode P on (fichepointage.DateEntree = P.DateEntree)
                                where P.PERIODE = "'.$periode.'"                
                            )        
                            and F.RefEmploye = "'.$refEmp.'"
                            order by H.JourTravaille ASC, H.RefDetailFichePointage ;';
                        $resTSEx = mysqli_query($connect,$reqTSEx) or exit(mysqli_error($connect));
                        
                        
                        

                        // on vérifie le contenu de  la requête ;
                        if (mysqli_num_rows($resTSEx) == 0){   
                            // si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
                                print "<script> alert('La requête n\'a pas abouti!Aucun résultat pour le TS')</script>";
                        } 

                        $colonne = mysqli_num_fields($resTSEx); //col                               
                        echo '<div style="max-height: 400px;overflow: scroll; ">';
                        echo '<table>
                            <!-- impression des titres de colonnes -->
                             <TR>
                                <TD><font color=""><b>Consultant</b></font></TD>
                                <TD><font color=""><b>Date</b></font></TD>
                                <TD><font color=""><b>Code mission</b></font></TD>
                                <TD><font color=""><b>Nom du client</b></font></TD>
                                <TD><font color=""><b>D&eacute;partement</b></font></TD>
                                <TD><font color=""><b>Heures</b></font></TD>            
                                <TD><font color=""><b>Description</b></font></TD>   
                                <TD><font color=""><b>Validation</b></font></TD>    
                                <TD><font color=""><b>Dépense</b></font></TD>                                            
                                <TD><font color=""><b>Justificatifs</b></font></TD>                                            
                            </TR>';

                        $val = array();
                        $linina = 0;
                        while($row = mysqli_fetch_array($resTSEx, MYSQLI_BOTH)){               
                            for($j=0; $j < $colonne ; $j++){                                   
                                if($j == 0){
                                    $val[$linina] = array($row[$j]);
                                    if($val[$linina-1][$j] == $val[$linina][$j]){                    
                                        //echo '<td>'.$val[$linina][$j].' biiii '.$linina.'</td>';  
                                        for($j=0; $j < $colonne ; $j++){                     
                                            switch($j){                                                 
                                                case $j > 1 && $j <=8: echo '<td style="border:none"></td>'; 
                                                    break;                           
                                                case 9:
                                                    $dep[] = $row[$j];
                                                    echo '<td>'.$row[$j].'</td>';  
                                                    break;
                                                case 10: echo '<td>'.$row[$j].'</td>';  
                                                    break;
                                            }
                                        }
                                    }                                   
                                }
                                else{
                                    for($j=1; $j < $colonne ; $j++){
                                        switch($j){                             
                                            case $j >= 1 && $j <=7: echo '<td>'.$row[$j].'</td>';  
                                                break;   
//                                            case 5: 
                                            case 8: if($row['Validation']==1){
//                                                echo '<input type="checkbox" id="cloturer" name="cloturer" checked disabled />' ;
                                                        echo '<td> Validé</td>';  
                                                    }
                                                    else if($row['Validation']==0){
                                                        echo '<td> Non Validé</td>';  
                                                    }                                
                                                break;
                                            case 9: 
                                                $dep[] = $row[$j];
                                                echo '<td>'.$row[$j].'</td>';  
                                                break;
                                            case 10: echo '<td>'.$row[$j].'</td>';  
                                                break;
                                        }
                                    }                                              
                                }            
                            }
                            echo '</tr>';
                            $linina = $linina + 1;        
                        }                        
                        echo '</TABLE>';
                        echo '</div>';
                        foreach ($dep as $valeur){
                            $depTotal += $valeur;                            
                        }
                        echo '<font style=" top: 400px; left: 405px; right:500px"><b>Depense Totale: </b>Ar ' .$depTotal .'</font>';
                        //mysql_close(); 
                        }
                    ?>
                        </center>
                    </div>               
                    <!-- bottom -->
                </div>
            
        </div>
    </div>
  
    <script>
        $(document).ready(function(){
            var pdeSelected = '<?php echo $periode;?>';
            document.getElementById('periode').value = pdeSelected;
            var consu = '<?php echo $consu;?>';
            document.getElementById('nomCons').value = consu;
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

