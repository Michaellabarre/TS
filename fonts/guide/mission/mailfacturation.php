<?php   
        
    header ('Content-type:text/html; charset=utf-8');
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';
    
    sec_session_start();    
    
    $idauto = $_POST['id'];    
    $refmanager = $_POST['manager'];    
    
    $requette = 'update facturation set Afacturer = 1, DateEnvoiFacture = "'.date("Y-m-d H:i:s").'" '
            . 'where Idauto = "'.$idauto.'"';
    $req = mysqli_query($connect, $requette) or exit(mysqli_error($connect));
    
    $reqMission = 'select F.Echeance as eche, F.RefProjet as code, F.Typefac as type, F.Libelle as libe, F.Montant as mont, P.NomProjet as nom, F.Monnaie as devise 
                    from facturation F
                    inner join projets P on (P.RefProjet = F.RefProjet)
                    where Idauto = "'.$idauto.'"';
    $queMission = mysqli_query($connect, $reqMission) or exit(mysqli_error($connect));
    $resMission = mysqli_fetch_assoc($queMission);
    $Echeance =  $resMission['eche'];
    $RefProjet = $resMission['code'];
    $Typefac =  $resMission['type'];
    $Libelle =  $resMission['libe'];
    $Montant =  $resMission['mont'];
    $NomProjet  = $resMission['nom'];
    $devise  = $resMission['devise'];
    
    $resManager = 'select Nomuser as user, Prenom as pre, Password as pass, NomFamille as fam '
            . 'from employes '
            . 'where RefEmploye = "'.$refmanager.'";';
    
   $queManager = mysqli_query($connect, $resManager) or exit(mysqli_error($connect));
   $resManager = mysqli_fetch_assoc($queManager);
   $nomUser = $resManager['user'];
   $pre = htmlspecialchars($resManager['pre'], ENT_QUOTES);
//   html_entity_decode($str, ENT_QUOTES,'UTF-8').
   $passManager = md5($resManager['pass']);
   $nomfami = $resManager['fam'];
   $user = $pre . ' ' . $nomfami;
   
    
    /*************************************************************/
   
   mailFact($Echeance, $RefProjet, $Typefac, $Libelle, $Montant, $NomProjet, $passManager, $nomUser, $user, $devise);    