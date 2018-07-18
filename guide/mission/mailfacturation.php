<?php 
// FONCTION ENVOI DE MAIL FACTURATION LORS D'UN CLIC SUR LE CASE A COCHER  
	error_reporting(E_STRICT | E_ALL);
	date_default_timezone_set('Etc/UTC');
        
    header ('Content-type:text/html; charset=utf-8');
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';
	
    
    sec_session_start();    
    
	$idauto = $_POST['id'];    
	//$idauto = 2017;
	echo 'idauto = '.$idauto;
   $refmanager = $_POST['manager'];    
	//$refmanager  = "prakotomahandry";
	
    	echo 'refmanager = '.$refmanager;
		
    $requette = 'update facturation set Afacturer = 1, DateEnvoiFacture = "'.date("Y-m-d").'" ' // MAJ CASE A COCHER SI LE CHECKBOX A ETE COCHE
            . 'where Idauto = "'.$idauto.'"';
    $req = mysqli_query($connect, $requette) or exit(mysqli_error($connect));
    
     $reqMission = 'select F.Idauto as numbilling, F.Echeance as eche, F.RefProjet as code, F.Typefac as type, F.Libelle as libe, F.Montant as mont, P.NomProjet as nom, P.RefClient as Cli, P.GroupeCli as GrCli, F.Monnaie as devise, F.DateEnvoiFacture as datebilling 
                    from facturation F
                    inner join projets P on (P.RefProjet = F.RefProjet)
                    where Idauto = "'.$idauto.'"';
    $queMission = mysqli_query($connect, $reqMission) or exit(mysqli_error($connect));
    $resMission = mysqli_fetch_assoc($queMission);
	$numbilling = $resMission ['numbilling'];
    $Echeance =  $resMission['eche'];
    $RefProjet = $resMission['code'];
    $Typefac =  $resMission['type'];
    $Libelle =  $resMission['libe'];
    $Montant =  $resMission['mont'];
    $NomProjet  = $resMission['nom'];
	$Client  = $resMission['Cli'];
	$GrClient  = $resMission['GrCli'];
    $devise  = $resMission['devise'];
	$datebilling = $resMission ['datebilling'];
    $resManager = 'select Nomuser as user, Prenom as pre, Password as pass, NomFamille as fam '
            . 'from employes '
            . 'where RefEmploye = "'.$refmanager.'";';
    
   $queManager = mysqli_query($connect, $resManager) or exit(mysqli_error($connect));
   $resManager = mysqli_fetch_assoc($queManager);
   $nomUser = $resManager['user'];
   $pre = htmlspecialchars($resManager['pre'], ENT_QUOTES);
  // html_entity_decode($str, ENT_QUOTES,'UTF-8').
   $passManager = md5($resManager['pass']);
   $nomfami = $resManager['fam'];
   $user = $pre . ' ' . $nomfami;
   
   // echo  'Typefac = '.$Typefac ;
    /*************************************************************/
   
  mailFact($numbilling, $Echeance, $RefProjet, $Typefac, $Libelle, $Montant, $NomProjet, $Client, $GrClient,$passManager, $nomUser, $user, $devise, $datebilling);  // APPEL DE LA FONCTION
  
 // FIN MODIF RODDY
	
  ?>
<script>  
 alert ("mail envoyé avec succes");
 </script>
