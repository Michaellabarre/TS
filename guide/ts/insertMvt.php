<?php
    header ('Content-type:text/html; charset=utf-8');    
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';
    
    sec_session_start();    
    
    if (login_check($mysqli) == true){       
    }
    else{
        die("Expired");
    }
    
    ini_set('display_errors', 0);    
    ini_set('log_errors', 1);    
    ini_set('error_log', 'C:\www\TS\log_error_php.txt'); 
    
    if(strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') !== false)
    $user_agent_name = 'Mozilla Firefox';                
    elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') !== false)
    $user_agent_name = 'Internet Explorer';
    elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') !== false)
    $user_agent_name = 'Google Chrome';
    else
    $user_agent_name = 'navigateur inconnu';      
    
    function changeDate($date){
        $tab = explode("-", $date);
        $dateChangee = $tab[2]."-".$tab[1]."-".$tab[0];
        return $dateChangee;        
    }   

    function changeDate2($date){
        $tab = explode("-", $date);
        $dateChangee = $tab[2]."-".$tab[1]."-".$tab[0];
        return $dateChangee;        
    }

    $periodeTS  = $_POST['periode'];     
    $Nomuser = $_SESSION['username'];  
    $employe = $Nomuser;
    
//    echo 'periode: '.$periodeTS;

    $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';                    
    $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
    $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
    $refEmploye = $resultRefEmp['EMPLO'];

//    echo ' refEmploye '.$refEmploye;

    $reqFicheP = 'select RefFichePointage as refFiche '
                . 'from fichepointage '
                . 'inner join periode P on (fichepointage.DateEntree = P.DateEntree)'
                . 'where P.PERIODE = "'.$periodeTS.'" '
                . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';                            
    $rekFicheP = mysqli_query($connect,$reqFicheP) or exit(mysqli_error($connect));
    $resultFicheP = mysqli_fetch_assoc($rekFicheP);
    $refFicheR = $resultFicheP['refFiche'];

//     echo ' refFicheP '.$refFicheR;

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
    $kountyFin = mysqli_num_rows($result);  
    
//    echo ' kountyFin '.$kountyFin;
    
//    $ligneTotal = count($_POST['dateMvt']); //ligne validée non inclus
//    $ligneTotal = $_POST['numtot']; //ligne validée non inclus 
    $ligneTotal = $kountyFin+10;
    $kountyTS   = $_POST['kountyTS'];        
    $ligneValide    = $_POST['lignevalide'];
//    $ligneNonValide = $_POST['rowsactive']; 
    $ligneNonValide = $kountyFin-$ligneValide;   
    $nbLigneAct = count($_POST['dateMvt'])-10; //ligne validée non inclus
          
    $numLi   = array();                
    $datemvt = array();
    $codemission = array();
    $dptm    = array();
    $heure   = array();
    $desc    = array();    
    $vraie   = FALSE;
    
    if($kountyTS == 0){
//        echo ' zero ';
        $mysqli->query("SET AUTOCOMMIT=0");
//        echo 'periode: '.$periodeTS.' ; ligne totale: '.$ligneTotal .'; ligne totale dans la base: '.$kountyTS .' ';
        for($k = 0; $k <10; $k++){
            $numLi = $_POST['numli'];

            $codemi = 'codeMission_'.$numLi[$k];
            $depart = 'departement_'.$numLi[$k];        
            
            if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){
                $datemvt = $_POST['dateMvt'][$k];  
                if(empty($datemvt)){                    
                }
                else{
                    $positionM = strpos($datemvt, "-");                                
                    if($positionM === false){
                        $datemvt = changeDate(str_replace("/", "-", $datemvt));
                    }                    
                }               
            }
            else{
                $datemvt = $_POST['dateMvt'][$k];  
                if(empty($datemvt)){                    
                }
                else{
                    $positionM = strpos($datemvt, "-");                                
                    if($positionM === false){
                        $datemvt = changeDate(str_replace("/", "-", $datemvt));
                    }                    
                }
            }
                                    
            $codemission = $_POST[$codemi];
            $dptm  = $_POST[$depart]; 
            $ora   = $_POST['ora'][$k];
            $desc  = $_POST['description'][$k];
                        
            if(empty($datemvt) && empty($codemission) && empty($ora) && empty($desc)){
//                echo 'Aucun enregistrement à insérer.';                
                break;                
            }
            else{                                               
//                echo '   AAAAAA nbLigne valide:'.$numRows .' numLi: '.$numLi[$k] .' date: '.$datemvt .' mission: ' .$codemission .' dept: '.$dptm .' ora: '.$ora .' desc: '.$desc;
                if(empty($datemvt)){                
                    echo "Veuillez sélectionner la date à la ligne: ".$numLi[$k]." ";
                    exit;
                }
                elseif(empty($codemission)){                
                    echo "Veuillez sélectionner le code mission à la ligne: ".$numLi[$k]." ";                
                    exit;
                }            
                elseif(empty($ora)){
                    echo "Veuillez saisir l'heure à la ligne: ".$numLi[$k] ." ";
                    exit;
                }
                elseif(!is_numeric ($ora)){
                    echo "L'heure saisie à la ligne: ".$numLi[$k]." n'est pas correcte.";
                    exit;
                }
                elseif($ora > 8){
                    echo "L'heure saisie à la ligne: ".$numLi[$k]." dépasse les 8 heures. Veuillez corriger.";
                    exit;
                }
                elseif(empty($desc)){
                    echo "Veuillez saisir la description à la ligne: ".$numLi[$k]." ";
                    exit;
                }
                else{                                        
                    if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){                        
                        $date_explosee = explode("-", str_replace("/", "-", $datemvt));                                                
                    }
                    else{
//                        $date_explosee = explode("-", $datemvt);                        
                        $date_explosee = explode("-", str_replace("/", "-", $datemvt));
                    }                       
                    $jourSaisi = $date_explosee[2];
                    $moisSaisi = $date_explosee[1];                    

                    if($jourSaisi >= 1 && $jourSaisi <=15){
                        $plus = "01 au 15";
                    }
                    else if($jourSaisi >= 16 && $jourSaisi <= 31){
                        switch($moisSaisi){
                            case 1: $plus = "16 au 31";break;case 2: $plus = "16 au 28";break;case 3: $plus = "16 au 31";break;
                            case 4: $plus = "16 au 30";break;case 5: $plus = "16 au 31";break;case 6: $plus = "16 au 30";break;
                            case 7: $plus = "16 au 31";break;case 8: $plus = "16 au 31";break;case 9: $plus = "16 au 30";break;
                            case 10: $plus = "16 au 31";break;case 11: $plus = "16 au 30";break;case 12: $plus = "16 au 31";break;                        
                        }
                    }                    

                    setlocale(LC_TIME, 'fr', 'fr_FR', 'french', 'fra', 'fra_FRA', 'fr_FR.ISO_8859-1', 'fra_FRA.ISO_8859-1', 'fr_FR.utf8', 'fr_FR.utf-8', 'fra_FRA.utf8', 'fra_FRA.utf-8');
                    $periodeSaisie = ucfirst(utf8_encode(strftime("%B %Y - du ".$plus, strtotime($datemvt))));  //OK pour Windows
//                        $periodeSaisie = ucfirst(strftime("%B %Y - du ".$plus, utf8_encode(strtotime($datemvt))));  // OK pour Linx                                        
                    
//                    echo 'periode saisie: '.$periodeSaisie;
                    
                    $pS = preg_replace ("/\s+/", " ", $periodeSaisie);
                    $pT = preg_replace ("/\s+/", " ", $periodeTS);
                    
//                    echo ' $pS '.$pS;
//                    echo ' $pT '.$pT;
                    
                    if(strcmp($pS, $pT) !== 0){
//                        echo 'ps '.$pS .' pT '.$pT .' datemvt '.$datemvt;
                        echo "La date saisie n'est pas comprise dans la période séléctionnée. Veuillez corriger la ligne: ".$numLi[$k]." ";
                        exit;
                    }
                    else{ 
                        $vraie = TRUE;
                        $nbDep = 0;
                        for($w=1;$w<=3;$w++){                                                                                                                        
                            $modCat     = array();
//                                $reffrais   = array();
                            $modMontant = array();
                            $modDes     = array();
//                                $fraisRef   = 'reffrais_'.$w.$numLi[$i];
                            $catMod = 'modCat_'.$w.$numLi[$k];
                            $mtMod = 'modMontant_'.$w.$numLi[$k];
                            $desMod = 'modDes_'.$w.$numLi[$k];

                            $modCat     = $_POST[$catMod];          
//                                $reffrais   = $_POST[$fraisRef];                                                      
//                                $modMontant = $_POST[$mtMod];
                            $modMontant = str_replace(" ", "", $_POST[$mtMod]);
                            $modDes     = $_POST[$desMod];
                            
//                            echo 'w '.$w.' - ';

                            if(empty($modCat) && empty($modMontant) && empty($modDes)){
                                $vide = TRUE;
//                                echo 'vide';
                                break;
                            }
                            else if(!empty($modCat) || !empty($modMontant) || !empty($modDes)){                                                                                                                                                                                   
//                                if(!empty($modCat) || !empty($modMontant) || !empty($modDes)){                                    
                                    if(empty($modCat)){
                                        echo 'Veuillez choisir la catégorie de la dépense ( '.$w.') à la ligne: '.$numLi[$k].' ';                                        
                                        $mysqli->query("ROLLBACK");
                                        exit;
                                    }
                                    else if(empty($modMontant)){
                                        echo 'Veuillez ajouter le montant de la dépense ( '.$w.') à la ligne: '.$numLi[$k].' ';                                        
                                        $mysqli->query("ROLLBACK");
                                        exit;
                                    }
                                    else if(!is_numeric($modMontant)){
                                        echo 'Le montant de la dépense ( '.$w.') à la ligne: '.$numLi[$k].' doit être numérique!';                                                                                
                                        $mysqli->query("ROLLBACK");
                                        exit;
                                    }
                                    else if(empty($modDes)){
                                        echo 'Veuillez remplir la description de la dépense ( '.$w.') à la ligne: '.$numLi[$k].' ';                                        
                                        $mysqli->query("ROLLBACK");
                                        exit;
                                    }
                                    else{
//                                        echo ' OK ';
                                        $nbDep = $nbDep + 1;                                       
                                    }
//                                }                                
                            }
                        }  
                    }                                        
                }
            }
            
            if($vraie == TRUE && $nbDep == 0){
//                echo 'ts ins et dep 0 ';
                $employe = $_SESSION['username'];

                $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';                    
                $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                $refEmploye = $resultRefEmp['EMPLO'];

                $reqIdRefFP = 'select max(RefDetailFichePointage) as idFP from heuresfichepointage;';
                $rekIdRefFP = mysqli_query($connect,$reqIdRefFP) or exit(mysqli_error($connect));
                $resultIdRefFP = mysqli_fetch_assoc($rekIdRefFP);
                $IdRefFP = $resultIdRefFP['idFP'] + 1;

                $reqDateEntree = 'select periode.DateEntree as dte from periode '
                        . 'inner join fichepointage on (fichepointage.DateEntree = periode.DateEntree)'
                        . 'where periode.PERIODE = "'.$periodeTS.'"'
                        . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';
                $rekDteEntree = mysqli_query($connect,$reqDateEntree) or exit(mysqli_error($connect));
                $resultDteEntree = mysqli_fetch_assoc($rekDteEntree);
                $DteEntree = $resultDteEntree['dte'];

                $reqRefF = 'select fichepointage.RefFichePointage as RefF from fichepointage '
                        . 'inner join periode on (periode.DateEntree = fichepointage.DateEntree)'
                        . 'where periode.PERIODE = "'.$periodeTS.'"'
                        . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';
                $rekRefF = mysqli_query($connect,$reqRefF) or exit(mysqli_error($connect));
                $resultRefF = mysqli_fetch_assoc($rekRefF);
                $RefF = $resultRefF['RefF'];                        

                $reqInsertTS = 'INSERT INTO heuresfichepointage '
                        . '(RefDetailFichePointage, RefFichePointage, JourTravaille, RefProjet, Coddept, HeureFacturables, DescriptionTravail, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
                        . 'VALUES '
                        . '("'.$IdRefFP.'", "'.$RefF.'", "'.$datemvt.'", "'.$codemission.'", "'.$dptm.'", "'.$ora.'", "'.$desc.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
                $result = mysqli_query($connect,$reqInsertTS); // or exit(mysqli_error($connect)); //à decommenter pour verifier les erreurs 
                
                if($result){   
//                    echo ' INSERER OAAAA';
                    $mysqli->query("COMMIT");                
                }
                else{
                    echo 'Erreur sur l\'ajout de TS à la ligne: ' .$numLi[$k]. ' '.mysqli_error($connect).'';
                    $mysqli->query("ROLLBACK");
                    exit(1);
                }                
            }
            elseif($vraie == TRUE && $nbDep > 0){
//                echo 'ts ins et dep ins ';
//                echo 'nbDep '.$nbDep.' ';
                $employe = $_SESSION['username'];

                $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';                    
                $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                $refEmploye = $resultRefEmp['EMPLO'];

                $reqIdRefFP = 'select max(RefDetailFichePointage) as idFP from heuresfichepointage;';
                $rekIdRefFP = mysqli_query($connect,$reqIdRefFP) or exit(mysqli_error($connect));
                $resultIdRefFP = mysqli_fetch_assoc($rekIdRefFP);
                $IdRefFP = $resultIdRefFP['idFP'] + 1;

                $reqDateEntree = 'select periode.DateEntree as dte from periode '
                        . 'inner join fichepointage on (fichepointage.DateEntree = periode.DateEntree)'
                        . 'where periode.PERIODE = "'.$periodeTS.'"'
                        . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';
                $rekDteEntree = mysqli_query($connect,$reqDateEntree) or exit(mysqli_error($connect));
                $resultDteEntree = mysqli_fetch_assoc($rekDteEntree);
                $DteEntree = $resultDteEntree['dte'];

                $reqRefF = 'select fichepointage.RefFichePointage as RefF from fichepointage '
                        . 'inner join periode on (periode.DateEntree = fichepointage.DateEntree)'
                        . 'where periode.PERIODE = "'.$periodeTS.'"'
                        . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';
                $rekRefF = mysqli_query($connect,$reqRefF) or exit(mysqli_error($connect));
                $resultRefF = mysqli_fetch_assoc($rekRefF);
                $RefF = $resultRefF['RefF'];                        

                $reqInsertTS = 'INSERT INTO heuresfichepointage '
                        . '(RefDetailFichePointage, RefFichePointage, JourTravaille, RefProjet, Coddept, HeureFacturables, DescriptionTravail, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
                        . 'VALUES '
                        . '("'.$IdRefFP.'", "'.$RefF.'", "'.$datemvt.'", "'.$codemission.'", "'.$dptm.'", "'.$ora.'", "'.$desc.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
                $result = mysqli_query($connect,$reqInsertTS); // or exit(mysqli_error($connect)); //à decommenter pour verifier les erreurs 
                
                if($result){     
                    $mysqli->query("COMMIT");  
                    
                    for($w=1;$w<=$nbDep;$w++){
                        $modCat     = array();
                        $modMontant = array();
                        $modDes     = array();
                        $catMod = 'modCat_'.$w.$numLi[$k];
                        $mtMod = 'modMontant_'.$w.$numLi[$k];
                        $desMod = 'modDes_'.$w.$numLi[$k];

                        $modCat     = $_POST[$catMod];          
                        $modMontant = str_replace(" ", "", $_POST[$mtMod]);
                        $modDes     = $_POST[$desMod];
                        
                        $reqIdFrais = 'select max(RefFraisFichePresence) as Frais from fraisfichepointage;';
                        $rekIdFrais = mysqli_query($connect,$reqIdFrais) or exit(mysqli_error($connect));
                        $resultIdFrais = mysqli_fetch_assoc($rekIdFrais);
                        $IdFrais = $resultIdFrais['Frais'] + 1;
    //                                            echo ' numli ' .$numLi[$k] .'modCat : '.$modCat .' modMontant '.$modMontant . ' modDes '.$modDes .';'; 
    //                                            echo '$RefF: '.$RefF;                                                                                      

                        $mysqli->query("SET AUTOCOMMIT=0");
                        $insFactQ    = 'INSERT INTO fraisfichepointage '
                                . '(RefFraisFichePresence, RefDetailFichePointage, Categ, MontantDepense, DescriptionDepense, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
                                . 'VALUES("'.$IdFrais.'", "'.$IdRefFP.'", "'.$modCat.'", "'.$modMontant.'", "'.$modDes.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
                        $factResQ    = mysqli_query($connect,$insFactQ);
                        if($factResQ){
    //                                                echo 'qqqqqqqqqqq';
    //                                                $mysqli->query("COMMIT"); 
                        }
                        else{
                            echo 'Erreur sur l\'insertion des dépenses à la ligne ' .$numLi[$k]. '. '.mysqli_error($connect).'';
                            $mysqli->query("ROLLBACK");
                            exit(1);
                        }                                                
                    }                                                            
                }
                else{
                    echo 'Erreur sur l\'ajout de TS à la ligne: ' .$numLi[$k]. ' '.mysqli_error($connect).'';
                    $mysqli->query("ROLLBACK");
                    exit(1);
                }
            }                        
                        
        }
        $mysqli->query("SET AUTOCOMMIT=0");
        die("success");
    }
    else{                    
//        $ligneVide      = $ligneTotal-$ligneNonValide-$ligneValide;
        $ligneVide = 500;
        $nouveauLigne   = 0;   
                
//        echo 'ligne actif '.$nbLigneAct.' ';
//        echo '$ligneNonValide '.$ligneNonValide.' ';
//        echo '$ligneVide '.$ligneVide.' ';        
//        echo '$ligneValide '.$ligneValide.' ';
//        echo '$ligneTotal '.$ligneTotal.' ';
               
        for($i = 0; $i<$nbLigneAct; $i++){  
            $ref      = array();
            $nbFrais  = array();
            $ligneMAJ = 0;            
                        
            $numLi = $_POST['numli'];            

            $codemi = 'codeMission_'.$numLi[$i];
            $depart = 'departement_'.$numLi[$i];            

            $ref   = $_POST['ref'][$i];
            
            if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){
                $datemvt = $_POST['dateMvt'][$i];
                if(empty($datemvt)){                    
                }
                else{
                    $positionZ = strpos($datemvt, "-");                                
                    if($positionZ === false){
                        $datemvt = changeDate(str_replace("/", "-", $datemvt));
                    }
                }                
            }
            else{
                $datemvt = $_POST['dateMvt'][$i];
                if(empty($datemvt)){                    
                }
                else{
                    $positionZ = strpos($datemvt, "-");                                
                    if($positionZ === false){
                        $datemvt = changeDate(str_replace("/", "-", $datemvt));
                    }
                }
            }            
            
            $codemission = $_POST[$codemi];
            $dptm  = $_POST[$depart]; 
            $ora   = $_POST['ora'][$i];
            $desc  = $_POST['description'][$i];
            
//            echo ' AAAAA numLi: '.$numLi[$i] .' ref: '.$ref .' date: '.$datemvt .' mission: ' .$codemission .' dept: '.$dptm .' ora: '.$ora .' desc: '.$desc.' ';            
                                    
            if(empty($datemvt)){                
                echo "Veuillez sélectionner la date à la ligne: ".$numLi[$i]." ";
                exit;
            }
            if(empty($codemission)){                
                echo "Veuillez sélectionner le code mission à la ligne: ".$numLi[$i]." ";                
                exit;
            }            
            elseif(empty($ora)){
                echo "Veuillez saisir l'heure à la ligne: ".$numLi[$i]." ";
                exit;
            }
            elseif(!is_numeric ($ora)){
                echo "L'heure saisie à la ligne: ".$numLi[$i]." n'est pas correcte";
                exit;
            }
            elseif($ora > 8){
                echo "L'heure saisie à la ligne: ".$numLi[$i]." dépasse les 8 heures. Veuillez corriger.";
                exit;
            }
            elseif(empty($desc)){
                echo "Veuillez saisir la description à la ligne: ".$numLi[$i]." ";
                exit;
            }
            else{            
//                echo ' AAAAA numLi: '.$numLi[$i] .' ref: '.$ref .' date: '.$datemvt .' mission: ' .$codemission .' dept: '.$dptm .' ora: '.$ora .' desc: '.$desc;
                if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){                        
                        $date_explosee = explode("-", str_replace("/", "-", $datemvt));                                                
                }
                else{
//                    $date_explosee = explode("-", $datemvt);                        
                    $date_explosee = explode("-", str_replace("/", "-", $datemvt));                                                
                }
                
//                $date_explosee = explode("-", $datemvt);
                
                
                $jourSaisi = $date_explosee[2];
                $moisSaisi = $date_explosee[1];

                if($jourSaisi >= 1 && $jourSaisi <=15){
                    $plus = "01 au 15";
                }
                else if($jourSaisi >= 16 && $jourSaisi <= 31){
                    switch($moisSaisi){
                        case 1: $plus = "16 au 31";break;case 2: $plus = "16 au 28";break;case 3: $plus = "16 au 31";break;
                        case 4: $plus = "16 au 30";break;case 5: $plus = "16 au 31";break;case 6: $plus = "16 au 30";break;
                        case 7: $plus = "16 au 31";break;case 8: $plus = "16 au 31";break;case 9: $plus = "16 au 30";break;
                        case 10: $plus = "16 au 31";break;case 11: $plus = "16 au 30";break;case 12: $plus = "16 au 31";break;                        
                    }
                }

                setlocale(LC_TIME, 'fr', 'fr_FR', 'french', 'fra', 'fra_FRA', 'fr_FR.ISO_8859-1', 'fra_FRA.ISO_8859-1', 'fr_FR.utf8', 'fr_FR.utf-8', 'fra_FRA.utf8', 'fra_FRA.utf-8');
                $periodeSaisie = ucfirst(utf8_encode(strftime("%B %Y - du ".$plus, strtotime($datemvt))));  //OK pour Windows
//                    $periodeSaisie = ucfirst(strftime("%B %Y - du ".$plus, utf8_encode(strtotime($datemvt))));  // OK pour Linx

                $pS = preg_replace ("/\s+/", " ", $periodeSaisie);
                $pT = preg_replace ("/\s+/", " ", $periodeTS);

                if(strcmp($pS, $pT) !== 0){
//                        echo 'ps '.$pS .' pT '.$pT .' datemvt '.$datemvt;
                    echo "La date saisie n'est pas comprise dans la période séléctionnée. Veuillez corriger la ligne: ".$numLi[$i]." ";
                    exit;
                }
                else{
                    $reqnbModif = 'select max(nombremodification) as nb from heuresfichepointage where RefDetailFichePointage = "'.$ref.'"';
                    $resnbModif = mysqli_query($connect, $reqnbModif) or exit(mysqli_error($connect));
                    $resultnbModif = mysqli_fetch_assoc($resnbModif);
                    $nbModif = $resultnbModif['nb'];

                    $nb = $nbModif  + 1; 
                    
                    $mysqli->query("SET AUTOCOMMIT=0");
                    $reqModif = 'update heuresfichepointage set '
                        . 'JourTravaille = "'.$datemvt.'", '
                        . 'RefProjet = "'.$codemission.'", '
                        . 'Coddept = "'.$dptm.'", '
                        . 'HeureFacturables = "'.$ora.'", '
                        . 'DescriptionTravail = "'.$desc.'", '
                        . 'datemodification = NOW(), '
                        . 'nombremodification = "'.$nb.'", '
                        . 'usermodif = "'.$refEmploye.'" '
                        . 'where RefDetailFichePointage = "'.$ref.'"';
                    $resModif = mysqli_query($connect,$reqModif); //or exit(mysqli_error($connect)); //à decommenter pour verifier les erreurs 
                    if($resModif){                        
                        $ligneMAJ = $ligneMAJ + 1;
                        $mysqli->query("COMMIT");                                                                             
                        $cdindice = 'indice_'.$numLi[$i];                          
                        $indice   = $_POST[$cdindice];  
                        $fraisNb  = 'nbFrais_'.$numLi[$i];
                        $nbFrais  = $_POST[$fraisNb];                        
                        if($nbFrais==0){
//                            echo ' plim ';
                            for($w=1;$w<=3;$w++){
                                $modCat     = array();
//                                $reffrais   = array();
                                $modMontant = array();
                                $modDes     = array();
//                                $fraisRef   = 'reffrais_'.$w.$numLi[$i];
                                $catMod = 'modCat_'.$w.$numLi[$i];
                                $mtMod = 'modMontant_'.$w.$numLi[$i];
                                $desMod = 'modDes_'.$w.$numLi[$i];

                                $modCat     = $_POST[$catMod];          
//                                $reffrais   = $_POST[$fraisRef];                                                      
//                                $modMontant = $_POST[$mtMod];
                                $modMontant = str_replace(" ", "", $_POST[$mtMod]);
                                $modDes     = $_POST[$desMod];
                                if(empty($modCat) && empty($modMontant) && empty($modDes)){
                                    break;
                                }
                                else if(!empty($modCat) || !empty($modMontant) || !empty($modDes)){                                                                                                                                                                                   
                                    if(!empty($modCat) || !empty($modMontant) || !empty($modDes)){
                                        if(empty($modCat)){
                                            echo 'Veuillez choisir la catégorie de la dépense ( '.$w.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else if(empty($modMontant)){
                                            echo 'Veuillez ajouter le montant de la dépense ( '.$w.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else if(!is_numeric($modMontant)){
                                            echo 'Le montant de la dépense ( '.$w.') à la ligne: '.$numLi[$i].' doit être numérique!';
                                            exit;
                                        }
                                        else if(empty($modDes)){
                                            echo 'Veuillez remplir la description de la dépense ( '.$w.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else{
                                            $reqIdFrais = 'select max(RefFraisFichePresence) as Frais from fraisfichepointage;';
                                            $rekIdFrais = mysqli_query($connect,$reqIdFrais) or exit(mysqli_error($connect));
                                            $resultIdFrais = mysqli_fetch_assoc($rekIdFrais);
                                            $IdFrais = $resultIdFrais['Frais'] + 1;
//                                            echo ' numli ' .$numLi[$i] .'modCat : '.$modCat .' modMontant '.$modMontant . ' modDes '.$modDes .';'; 
//                                            echo '$RefF: '.$ref;

                                            $mysqli->query("SET AUTOCOMMIT=0");
                                            $insFact    = 'INSERT INTO fraisfichepointage '
                                                    . '(RefFraisFichePresence, RefDetailFichePointage, Categ, MontantDepense, DescriptionDepense, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
                                                    . 'VALUES("'.$IdFrais.'", "'.$ref.'", "'.$modCat.'", "'.$modMontant.'", "'.$modDes.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
                                            $factRes    = mysqli_query($connect,$insFact);
                                            if($factRes){
                                                $mysqli->query("COMMIT");                                                 
                                            }
                                            else{
                                                echo 'Erreur sur l\'insertion des dépenses à la ligne ' .$numLi[$i]. '. '.mysqli_error($connect).'';
                                                $mysqli->query("ROLLBACK");
                                                exit(1);
                                            }                                            
                                        }
                                    }
                                
                                }
                            }
                        }
                        else if($nbFrais>0 && $nbFrais<=3){
//                            echo ' gkjl';
                            if($indice==0){}
                            else{
//                                echo '**** numLigne: '.$numLi[$i] .' indice: '.$indice .' nbFrais: ' .$nbFrais .' ';
                                
                                for($l=1;$l<=$nbFrais;$l++){
                                    $modCat     = array();
                                    $reffrais   = array();
                                    $modMontant = array();
                                    $modDes     = array();
                                    $fraisRef   = 'reffrais_'.$l.$numLi[$i];
                                    $catMod = 'modCat_'.$l.$numLi[$i];
                                    $mtMod = 'modMontant_'.$l.$numLi[$i];
                                    $desMod = 'modDes_'.$l.$numLi[$i];

                                    $modCat     = $_POST[$catMod];          
                                    $reffrais   = $_POST[$fraisRef];                                                      
                                    $modMontant = str_replace(" ", "", $_POST[$mtMod]);
//                                            $_POST[$mtMod];
                                    
//                                    $montantHono = str_replace(" ", "", $_POST['montantHono']);
                                    
                                    $modDes     = $_POST[$desMod];
//                                    echo 'catMod: ' .$catMod .' reffrais '.$reffrais .' modCat : '.$modCat .' modMontant '.$modMontant . ' modDes '.$modDes .';';

                                    if(!empty($modCat) || !empty($modMontant) || !empty($modDes)){
                                        if(empty($modCat)){
                                            echo 'Veuillez choisir la catégorie de la dépense ( '.$l.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else if(empty($modMontant)){
                                            echo 'Veuillez ajouter le montant de la dépense ( '.$l.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else if(!is_numeric($modMontant)){
                                            echo 'Le montant de la dépense ( '.$l.') à la ligne: '.$numLi[$i].' doit être numérique!';
                                            exit;
                                        }
                                        else if(empty($modDes)){
                                            echo 'Veuillez remplir la description de la dépense ( '.$l.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else{
                                            
                                            $reqnbModifF = 'select max(nombremodification) as nbF from fraisfichepointage where RefFraisFichePresence = "'.$reffrais.'"';
                                            $resnbModifF = mysqli_query($connect, $reqnbModifF) or exit(mysqli_error($connect));
                                            $resultnbModifF = mysqli_fetch_assoc($resnbModifF);
                                            $nbModifF = $resultnbModifF['nbF'];

                                            $nbF = $nbModifF  + 1; 
                                            
                                            $mysqli->query("SET AUTOCOMMIT=0");                                                                                        
                                            $reqDep = 'update fraisfichepointage '
                                                    . 'inner join depense on (depense.Categ = fraisfichepointage.Categ) '
                                                    . 'set '
                                                    . 'fraisfichepointage.Categ = "'.$modCat.'", '
                                                    . 'MontantDepense = "'.$modMontant.'", '
                                                    . 'DescriptionDepense = "'.$modDes.'", '
                                                    . 'datemodification = NOW(), '
                                                    . 'nombremodification = "'.$nbF.'", '
                                                    . 'usermodif = "'.$refEmp.'" '
                                                    . 'where RefFraisFichePresence = "'.$reffrais.'"';
                                            $resDep = mysqli_query($connect,$reqDep); //// or exit(mysqli_error($connect)); //à decommenter pour verifier les erreurs
                                            if($resDep){
                                                $mysqli->query("COMMIT"); 
                                            }
                                            else{
                                                echo 'Erreur sur la modification des dépenses à la ligne.' .$numLi. '.'.mysqli_error($connect).'';
                                                $mysqli->query("ROLLBACK");
                                                exit(1);
                                            }
                                        }
                                    }
                                }
                                
                                if($nbFrais == 1){
                                    $go = $nbFrais + 1;
//                                    echo 'go '.$go;
                                    for($f=$go;$f<=$indice;$f++){
//                                    echo 'haha';
                                    $modCat     = array();
                                    $reffrais   = array();
                                    $modMontant = array();
                                    $modDes     = array();                                    
                                    $catMod = 'modCat_'.$f.$numLi[$i];
                                    $mtMod = 'modMontant_'.$f.$numLi[$i];
                                    $desMod = 'modDes_'.$f.$numLi[$i];

                                    $modCat     = $_POST[$catMod];                                                                                                   
//                                    $modMontant = $_POST[$mtMod];
                                    $modMontant = str_replace(" ", "", $_POST[$mtMod]);
                                    $modDes     = $_POST[$desMod];
//                                    echo ' modCat : '.$modCat .' modMontant '.$modMontant . ' modDes '.$modDes .';';                                                                        

                                    if(!empty($modCat) || !empty($modMontant) || !empty($modDes)){
                                        if(empty($modCat)){
                                            echo 'Veuillez choisir la catégorie de la dépense ( '.$f.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else if(empty($modMontant)){
                                            echo 'Veuillez ajouter le montant de la dépense ( '.$f.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else if(!is_numeric($modMontant)){
                                            echo 'Le montant de la dépense ( '.$f.') à la ligne: '.$numLi[$i].' doit être numérique!';
                                            exit;
                                        }
                                        else if(empty($modDes)){
                                            echo 'Veuillez remplir la description de la dépense ( '.$f.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else{
                                            $reqIdFrais = 'select max(RefFraisFichePresence) as Frais from fraisfichepointage;';
                                            $rekIdFrais = mysqli_query($connect,$reqIdFrais) or exit(mysqli_error($connect));
                                            $resultIdFrais = mysqli_fetch_assoc($rekIdFrais);
                                            $IdFrais = $resultIdFrais['Frais'] + 1;
                                            
//                                            echo '$RefF: '.$ref;

                                            $mysqli->query("SET AUTOCOMMIT=0");
                                            $insFact    = 'INSERT INTO fraisfichepointage '
                                                    . '(RefFraisFichePresence, RefDetailFichePointage, Categ, MontantDepense, DescriptionDepense, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
                                                    . 'VALUES("'.$IdFrais.'", "'.$ref.'", "'.$modCat.'", "'.$modMontant.'", "'.$modDes.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
                                            $factRes    = mysqli_query($connect,$insFact);
                                            if($factRes){
                                                $mysqli->query("COMMIT"); 
                                            }
                                            else{
                                                echo 'Erreur sur l\'insertion des dépenses à la ligne ' .$numLi[$i]. '. '.mysqli_error($connect).'';
                                                $mysqli->query("ROLLBACK");
                                                exit(1);
                                            }                                            
                                        }
                                    }
                                } 
                                }
                                else if($nbFrais == 2){
                                    $go = $nbFrais + 1;
//                                    echo 'go '.$go;
                                    for($f=$go;$f<=$indice;$f++){
//                                    echo 'haha';
                                    $modCat     = array();
                                    $reffrais   = array();
                                    $modMontant = array();
                                    $modDes     = array();                                    
                                    $catMod = 'modCat_'.$f.$numLi[$i];
                                    $mtMod = 'modMontant_'.$f.$numLi[$i];
                                    $desMod = 'modDes_'.$f.$numLi[$i];

                                    $modCat     = $_POST[$catMod];                                                                                                   
//                                    $modMontant = $_POST[$mtMod];
                                    $modMontant = str_replace(" ", "", $_POST[$mtMod]);
                                    $modDes     = $_POST[$desMod];
//                                    echo ' modCat : '.$modCat .' modMontant '.$modMontant . ' modDes '.$modDes .';';                                                                        
//                                    echo 'modCat_'.$f.$numLi[$i];

                                    if(!empty($modCat) || !empty($modMontant) || !empty($modDes)){
                                        if(empty($modCat)){
                                            echo 'Veuillez choisir la catégorie de la dépense ( '.$f.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else if(empty($modMontant)){
                                            echo 'Veuillez ajouter le montant de la dépense ( '.$f.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else if(!is_numeric($modMontant)){
                                            echo 'Le montant de la dépense ( '.$f.') à la ligne: '.$numLi[$i].' doit être numérique!';
                                            exit;
                                        }
                                        else if(empty($modDes)){
                                            echo 'Veuillez remplir la description de la dépense ( '.$f.') à la ligne: '.$numLi[$i].' ';
                                            exit;
                                        }
                                        else{
                                            $reqIdFrais = 'select max(RefFraisFichePresence) as Frais from fraisfichepointage;';
                                            $rekIdFrais = mysqli_query($connect,$reqIdFrais) or exit(mysqli_error($connect));
                                            $resultIdFrais = mysqli_fetch_assoc($rekIdFrais);
                                            $IdFrais = $resultIdFrais['Frais'] + 1;
                                            
//                                            echo '$RefF: '.$ref;

                                            $mysqli->query("SET AUTOCOMMIT=0");
                                            $insFact    = 'INSERT INTO fraisfichepointage '
                                                    . '(RefFraisFichePresence, RefDetailFichePointage, Categ, MontantDepense, DescriptionDepense, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
                                                    . 'VALUES("'.$IdFrais.'", "'.$ref.'", "'.$modCat.'", "'.$modMontant.'", "'.$modDes.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
                                            $factRes    = mysqli_query($connect,$insFact);
                                            if($factRes){
                                                $mysqli->query("COMMIT"); 
                                            }
                                            else{
                                                echo 'Erreur sur l\'insertion des dépenses à la ligne ' .$numLi[$i]. '. '.mysqli_error($connect).'';
                                                $mysqli->query("ROLLBACK");
                                                exit(1);
                                            }                                            
                                        }
                                    }
                                } 
                                }                                                                                                                                       
                            }
//                            continue; 
                        }                                                                                     
                    }
                    else{
                        echo 'Erreur sur la modification de la ligne.' .$numLi. '.'.mysqli_error($connect).'';
                        $mysqli->query("ROLLBACK");
                        exit(1);
                    }
                }
            }
        }                
//        echo ' nbLigneAct '.$nbLigneAct.' ';                
        
        $reqHrTravA = 'select H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
                . 'H.RefProjet as CodeMission , H.Coddept as Departement, '
                . 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, '
                . 'H.Facture as Validation,'
                . 'H.RefDetailFichePointage as RefFP '
                . 'from heuresfichepointage H '                                    
                . 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
                . 'inner join projets P on (P.RefProjet = H.RefProjet) '
                . 'where H.RefFichePointage = "'.$refFicheR.'" '
                . 'and H.Facture = 0 '
                . 'order by H.JourTravaille ASC, H.RefProjet';
            $resultA = mysqli_query($connect,$reqHrTravA) or exit(mysqli_error($connect));
            $kountyFinA = mysqli_num_rows($resultA);
            
//            echo 'kountyFinA '.$kountyFinA.' ';
        
        for($j=$kountyFinA;$j<$ligneVide;$j++){ 
            
//            echo 'j '.$j.' lignevide '.$ligneVide.' ';
//            $j = $kountyFinA;
            $numLi = $_POST['numli'];

            $codemi = 'codeMission_'.$numLi[$j];
            $depart = 'departement_'.$numLi[$j];   
            
            if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){
                $datemvt = $_POST['dateMvt'][$j];
                if(empty($datemvt)){
                    //echo 'vide';
                }
                else{
                    $positionF = strpos($_POST['dateMvt'][$j], "-");                                
                    if($positionF === false){
                        $datemvt = changeDate(str_replace("/", "-", $_POST['dateMvt'][$j]));
                    }
                }                
            }
            else{
                $datemvt = $_POST['dateMvt'][$j];
                if(empty($datemvt)){                    
                }
                else{
                    $positionF = strpos($_POST['dateMvt'][$j], "-");                                
                    if($positionF === false){
                        $datemvt = changeDate(str_replace("/", "-", $_POST['dateMvt'][$j]));
                    }
                } 
            }
            
            $codemission = $_POST[$codemi];
            $dptm  = $_POST[$depart]; 
            $ora   = $_POST['ora'][$j];
            $desc  = $_POST['description'][$j];
            
            if(empty($datemvt) && empty($codemission) && empty($ora) && empty($desc)){
//                echo 'Aucun enregistrement à insérer.';
                break;
            }
            else{                
//                echo 'BBBBB numLi: '.$numLi[$j] .' date: '.$datemvt .' mission: ' .$codemission .' dept: '.$dptm .' ora: '.$ora .' desc: '.$desc;
                if(empty($datemvt)){                
                    echo "Veuillez sélectionner la date à la ligne: ".$numLi[$j]." ";
                    exit;
                }
                elseif(empty($codemission)){                
                    echo "Veuillez sélectionner le code mission à la ligne: ".$numLi[$j]." ";                
                    exit;
                }            
                elseif(empty($ora)){
                    echo "Veuillez saisir l'heure à la ligne: ".$numLi[$j]." ";
                    exit;
                }
                elseif(!is_numeric ($ora)){
                    echo "L'heure saisie à la ligne: ".$numLi[$j]." n'est pas correcte.";
                    exit;
                }
                elseif($ora > 8){
                    echo "L'heure saisie à la ligne: ".$numLi[$j]." dépasse les 8 heures. Veuillez corriger.";
                    exit;
                }
                elseif(empty($desc)){
                    echo "Veuillez saisir la description à la ligne: ".$numLi[$j]." ";
                    exit;
                }
                else{
                    if($user_agent_name == 'Mozilla Firefox' or $user_agent_name == 'Internet Explorer' or $user_agent_name == 'navigateur inconnu'){                        
                        $date_explosee = explode("-", str_replace("/", "-", $datemvt));                                                
                    }
                    else{
//                        $date_explosee = explode("-", $datemvt);                        
                        $date_explosee = explode("-", str_replace("/", "-", $datemvt));   
                    } 
                    
//                    $date_explosee = explode("-", $datemvt);
                    $jourSaisi = $date_explosee[2];
                    $moisSaisi = $date_explosee[1];

                    if($jourSaisi >= 1 && $jourSaisi <=15){
                        $plus = "01 au 15";
                    }
                    else if($jourSaisi >= 16 && $jourSaisi <= 31){
                        switch($moisSaisi){
                            case 1: $plus = "16 au 31";break;case 2: $plus = "16 au 28";break;case 3: $plus = "16 au 31";break;
                            case 4: $plus = "16 au 30";break;case 5: $plus = "16 au 31";break;case 6: $plus = "16 au 30";break;
                            case 7: $plus = "16 au 31";break;case 8: $plus = "16 au 31";break;case 9: $plus = "16 au 30";break;
                            case 10: $plus = "16 au 31";break;case 11: $plus = "16 au 30";break;case 12: $plus = "16 au 31";break;                        
                        }
                    }

                    setlocale(LC_TIME, 'fr', 'fr_FR', 'french', 'fra', 'fra_FRA', 'fr_FR.ISO_8859-1', 'fra_FRA.ISO_8859-1', 'fr_FR.utf8', 'fr_FR.utf-8', 'fra_FRA.utf8', 'fra_FRA.utf-8');
                    $periodeSaisie = ucfirst(utf8_encode(strftime("%B %Y - du ".$plus, strtotime($datemvt))));  //OK pour Windows
//                        $periodeSaisie = ucfirst(strftime("%B %Y - du ".$plus, utf8_encode(strtotime($datemvt))));  // OK pour Linx

                    $pS = preg_replace ("/\s+/", " ", $periodeSaisie);
                    $pT = preg_replace ("/\s+/", " ", $periodeTS);
                    
                    if(strcmp($pS, $pT) !== 0){
    //                    echo 'ps '.$pS .' pT '.$pT .' datemvt '.$datemvt;
                        echo "La date saisie n'est pas comprise dans la période séléctionnée. Veuillez corriger la ligne: ".$numLi[$j]." ";
                        exit;
                    }
                    else{
                        $vraie = TRUE;
                        $nbDep = 0;
                        for($l=1;$l<=3;$l++){                                                                                                                        
                            $modCat     = array();
//                                $reffrais   = array();
                            $modMontant = array();
                            $modDes     = array();
//                                $fraisRef   = 'reffrais_'.$l.$numLi[$i];
                            $catMod = 'modCat_'.$l.$numLi[$j];
                            $mtMod = 'modMontant_'.$l.$numLi[$j];
                            $desMod = 'modDes_'.$l.$numLi[$j];

                            $modCat     = $_POST[$catMod];          
//                                $reffrais   = $_POST[$fraisRef];                                                      
//                                $modMontant = $_POST[$mtMod];
                            $modMontant = str_replace(" ", "", $_POST[$mtMod]);
                            $modDes     = $_POST[$desMod];
                            
//                            echo 'l '.$l.' - ';

                            if(empty($modCat) && empty($modMontant) && empty($modDes)){
                                $vide = TRUE;
//                                echo 'vide';
                                break;
                            }
                            else if(!empty($modCat) || !empty($modMontant) || !empty($modDes)){                                                                                                                                                                                   
//                                if(!empty($modCat) || !empty($modMontant) || !empty($modDes)){                                    
                                    if(empty($modCat)){
                                        echo 'Veuillez choisir la catégorie de la dépense ( '.$l.') à la ligne: '.$numLi[$j].' ';                                        
                                        $mysqli->query("ROLLBACK");
                                        exit;
                                    }
                                    else if(empty($modMontant)){
                                        echo 'Veuillez ajouter le montant de la dépense ( '.$l.') à la ligne: '.$numLi[$j].' ';                                        
                                        $mysqli->query("ROLLBACK");
                                        exit;
                                    }
                                    else if(!is_numeric($modMontant)){
                                        echo 'Le montant de la dépense ( '.$l.') à la ligne: '.$numLi[$j].' doit être numérique!';                                                                                
                                        $mysqli->query("ROLLBACK");
                                        exit;
                                    }
                                    else if(empty($modDes)){
                                        echo 'Veuillez remplir la description de la dépense ( '.$l.') à la ligne: '.$numLi[$j].' ';                                        
                                        $mysqli->query("ROLLBACK");
                                        exit;
                                    }
                                    else{
//                                        echo ' OK ';
                                        $nbDep = $nbDep + 1;                                       
                                    }
//                                }                                
                            }
                        }
                    }
                }
            }            
            
            if($vraie == TRUE && $nbDep == 0){
//                echo ' aaaaaa ';
//                echo 'CCC numLi: '.$numLi[$j] .' date: '.$datemvt .' mission: ' .$codemission .' dept: '.$dptm .' ora: '.$ora .' desc: '.$desc;
//                echo 'ts ins et dep 0 ';
                $employe = $_SESSION['username'];

                $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';                    
                $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                $refEmploye = $resultRefEmp['EMPLO'];

                $reqIdRefFP = 'select max(RefDetailFichePointage) as idFP from heuresfichepointage;';
                $rekIdRefFP = mysqli_query($connect,$reqIdRefFP) or exit(mysqli_error($connect));
                $resultIdRefFP = mysqli_fetch_assoc($rekIdRefFP);
                $IdRefFP = $resultIdRefFP['idFP'] + 1;
                
//                echo 'idreffp nbdep vide'.$IdRefFP;

                $reqDateEntree = 'select periode.DateEntree as dte from periode '
                        . 'inner join fichepointage on (fichepointage.DateEntree = periode.DateEntree)'
                        . 'where periode.PERIODE = "'.$periodeTS.'"'
                        . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';
                $rekDteEntree = mysqli_query($connect,$reqDateEntree) or exit(mysqli_error($connect));
                $resultDteEntree = mysqli_fetch_assoc($rekDteEntree);
                $DteEntree = $resultDteEntree['dte'];

                $reqRefF = 'select fichepointage.RefFichePointage as RefF from fichepointage '
                        . 'inner join periode on (periode.DateEntree = fichepointage.DateEntree)'
                        . 'where periode.PERIODE = "'.$periodeTS.'"'
                        . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';
                $rekRefF = mysqli_query($connect,$reqRefF) or exit(mysqli_error($connect));
                $resultRefF = mysqli_fetch_assoc($rekRefF);
                $RefF = $resultRefF['RefF'];                        

                $reqInsertTS = 'INSERT INTO heuresfichepointage '
                        . '(RefDetailFichePointage, RefFichePointage, JourTravaille, RefProjet, Coddept, HeureFacturables, DescriptionTravail, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
                        . 'VALUES '
                        . '("'.$IdRefFP.'", "'.$RefF.'", "'.$datemvt.'", "'.$codemission.'", "'.$dptm.'", "'.$ora.'", "'.$desc.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
                $result = mysqli_query($connect,$reqInsertTS); // or exit(mysqli_error($connect)); //à decommenter pour verifier les erreurs 
                
                if($result){   
//                    echo ' INSERER OAAAA';
                    $mysqli->query("COMMIT");                
                    continue;
                }
                else{
                    echo 'Erreur sur l\'ajout de TS à la ligne: ' .$numLi[$i]. ' '.mysqli_error($connect).'';
                    $mysqli->query("ROLLBACK");
                    exit(1);
                }                
            }
            elseif($vraie == TRUE && $nbDep > 0){
//                echo 'ts ins et dep ins ';
//                echo 'nbDep '.$nbDep.' ';
                $employe = $_SESSION['username'];

                $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';                    
                $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
                $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
                $refEmploye = $resultRefEmp['EMPLO'];

                $reqIdRefFP = 'select max(RefDetailFichePointage) as idFP from heuresfichepointage;';
                $rekIdRefFP = mysqli_query($connect,$reqIdRefFP) or exit(mysqli_error($connect));
                $resultIdRefFP = mysqli_fetch_assoc($rekIdRefFP);
                $IdRefFP = $resultIdRefFP['idFP'] + 1;
                
//                echo 'idreffp nbdep non vide '.$IdRefFP;

                $reqDateEntree = 'select periode.DateEntree as dte from periode '
                        . 'inner join fichepointage on (fichepointage.DateEntree = periode.DateEntree)'
                        . 'where periode.PERIODE = "'.$periodeTS.'"'
                        . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';
                $rekDteEntree = mysqli_query($connect,$reqDateEntree) or exit(mysqli_error($connect));
                $resultDteEntree = mysqli_fetch_assoc($rekDteEntree);
                $DteEntree = $resultDteEntree['dte'];

                $reqRefF = 'select fichepointage.RefFichePointage as RefF from fichepointage '
                        . 'inner join periode on (periode.DateEntree = fichepointage.DateEntree)'
                        . 'where periode.PERIODE = "'.$periodeTS.'"'
                        . 'and fichepointage.RefEmploye = "'.$refEmploye.'"';
                $rekRefF = mysqli_query($connect,$reqRefF) or exit(mysqli_error($connect));
                $resultRefF = mysqli_fetch_assoc($rekRefF);
                $RefF = $resultRefF['RefF'];                        

                $reqInsertTS = 'INSERT INTO heuresfichepointage '
                        . '(RefDetailFichePointage, RefFichePointage, JourTravaille, RefProjet, Coddept, HeureFacturables, DescriptionTravail, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
                        . 'VALUES '
                        . '("'.$IdRefFP.'", "'.$RefF.'", "'.$datemvt.'", "'.$codemission.'", "'.$dptm.'", "'.$ora.'", "'.$desc.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
                $result = mysqli_query($connect,$reqInsertTS); // or exit(mysqli_error($connect)); //à decommenter pour verifier les erreurs 
                
                if($result){     
                    $mysqli->query("COMMIT");  
                    
//                    echo ' OOOOOOOOOOOOOOO '.$IdRefFP;
                    
                    for($l=1;$l<=$nbDep;$l++){
                        $modCat     = array();
                        $modMontant = array();
                        $modDes     = array();
                        $catMod = 'modCat_'.$l.$numLi[$j];
                        $mtMod = 'modMontant_'.$l.$numLi[$j];
                        $desMod = 'modDes_'.$l.$numLi[$j];

                        $modCat     = $_POST[$catMod];          
                        $modMontant = str_replace(" ", "", $_POST[$mtMod]);
                        $modDes     = $_POST[$desMod];
                        
                        $reqIdFrais = 'select max(RefFraisFichePresence) as Frais from fraisfichepointage;';
                        $rekIdFrais = mysqli_query($connect,$reqIdFrais) or exit(mysqli_error($connect));
                        $resultIdFrais = mysqli_fetch_assoc($rekIdFrais);
                        $IdFrais = $resultIdFrais['Frais'] + 1;
//                        echo ' numli ' .$numLi[$i] .'modCat : '.$modCat .' modMontant '.$modMontant . ' modDes '.$modDes .';';     

                        $mysqli->query("SET AUTOCOMMIT=0");
                        $insFactQ    = 'INSERT INTO fraisfichepointage '
                                . '(RefFraisFichePresence, RefDetailFichePointage, Categ, MontantDepense, DescriptionDepense, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
                                . 'VALUES("'.$IdFrais.'", "'.$IdRefFP.'", "'.$modCat.'", "'.$modMontant.'", "'.$modDes.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
                        $factResQ    = mysqli_query($connect,$insFactQ);
                        if($factResQ){
//                            echo '-qqqqqqq-';
                            $mysqli->query("COMMIT"); 
                        }
                        else{
                            echo 'Erreur sur l\'insertion des dépenses à la ligne ' .$numLi[$j]. '. '.mysqli_error($connect).'';
                            $mysqli->query("ROLLBACK");
                            exit(1);
                        }                                                
                    }                                                            
                }
                else{
                    echo 'Erreur sur l\'ajout de TS à la ligne: ' .$numLi[$j]. ' '.mysqli_error($connect).'';
                    $mysqli->query("ROLLBACK");
                    exit(1);
                }
            }            
        }
        die("success");
//        echo ' periode: '.$periodeTS.' ; ligne totale: '.$ligneTotal .'; ligne totale dans la base: '.$kountyTS .' ; ligne valide: '.$ligneValide.' '
//            . ' ; ligne non validé: '.$ligneNonValide. ' ; ligneVide: '.$ligneVide;            
    }
        
        
    
    
