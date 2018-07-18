<?php									
											header ('Content-type:text/html; charset=utf-8');
											require_once '../../includes/db_connect.php';
											require_once '../../includes/fonction.php';
											require_once '../../includes/functions.php';
											
											date_default_timezone_set('UTC');
											//require_once ("excel_reader.php");
											require_once '../../includes/Classes//PHPExcel.php';
											require_once '../../includes/Classes/PHPExcel/IOFactory.php';
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
	 
											$periodeTS  = $_POST['periode'];  
											$Nomuser = $_SESSION['username'];  
											$employe = $Nomuser; 
											
										//	$excel_file = "ef_test_roddy.xls";
											
										if(isset($_POST['importer'])){
											//$mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];
											$extensions_valides = array( 'xls' , 'xlsx' );  
											$extension_upload = strtolower(  substr(  strrchr($_FILES['myFile']['name'], '.')  ,1)  );

											if ( in_array($extension_upload,$extensions_valides) ){ // FILTRAGE FORMAT
														//if(in_array($nom_fichier, $extensions)){	
														// Dossier de destination
														$target_path = 'uploads/'; // UPLOAD = FICHIER TEMPORAIRE A CREER DANS LE SERVEUR WAMP ET AVEC DROIT D'ACCES = 777 LORS DE LA CREATION DU REPERTOIRE 
														// FICHIER A CREER DANS DANS LE REPERTOIRE CONTENANT upload.php
														/* Resultat sous la forme "uploads/filename.extension" */
														$target_file = $target_path.basename( $_FILES['myFile']['name']);										
														$res = move_uploaded_file($_FILES['myFile']['tmp_name'], $target_file); // DEPLACEMENT DU FICHIER TEMPORAIRE
														//var_dump ($res);
														// $uploadFilePath = 'ef_test_roddy.xls';

														//  Read your Excel workbook
															try
															{
																$inputfiletype = PHPExcel_IOFactory::identify($target_file);
																$objReader = PHPExcel_IOFactory::createReader($inputfiletype);
																$objPHPExcel = $objReader->load($target_file);
															}
															catch(Exception $e)
															{
																die('Error loading file "'.pathinfo($target_file,PATHINFO_BASENAME).'": '.$e->getMessage());
															}
															
															//  Get worksheet dimensions
															$sheet = $objPHPExcel->getSheet(0); 
															$highestRow = $sheet->getHighestRow(); 
															$highestColumn = $sheet->getHighestColumn();
															
														// $data = new PhpExcelReader($uploadFilePath);
														// $data->setOutputEncoding('UTF-8'); // ici il faut mettre UTF-8 autrement affichage avec des symbôles
														 $fichier=$_FILES["myFile"]["tmp_name"]; //recupere le nom du fichier indiqué par l'user
														// $data->read($_FILES["myFile"]["tmp_name"]);
														//$data->read($excel_file);
														$conn = mysqli_connect("localhost","manager","eKcGZr59zAa2BEWUp");
														mysqli_select_db($conn, "basets");
														
														$req = "SET FOREIGN_KEY_CHECKS = 0"; // Desactivation temporaire des clés étrangères
														$result2 = mysqli_query($conn,$req) or exit(mysqli_error($conn));
														//var_dump ($result2);
														//echo 'okokkokooko';
														//$CodeMi_error = 'DISO ny CodeMi';
														//$date_actuel = date("d-m-Y");
														//Septembre 2014 - du 01 au 15
													//	$date_TS = date ($periodeTS);
													//	echo "date_TS = ".$date_TS;
														$pTS   = explode(" ", $periodeTS);
														$anneeTS = $pTS[1];
														$moisTS = $pTS[0];
														$jourTS1 = $pTS[4];
														$jourTS2 = $pTS[5];
														$jourTS3 = $pTS[6];
														
														if($moisTS == "Janvier") {$moisTS = "January";}else if($moisTS == "Février") {$moisTS = "February";}
														if($moisTS == "Mars") {$moisTS = "March";}else if($moisTS == "Avril") {$moisTS = "April";}
														if($moisTS == "Mai") {$moisTS = "May";}else if($moisTS == "Juin") {$moisTS = "June";}
														if($moisTS == "Juillet") {$moisTS = "July";}else if($moisTS == "Août") {$moisTS = "August";}
														if($moisTS == "Septembre") {$moisTS = "September";}else if($moisTS == "Octobre") {$moisTS = "October";}
														if($moisTS == "Novembre") {$moisTS = "November";}else if($moisTS == "Décembre") {$moisTS = "December";}
											
														$numMoisTS = date('m', strtotime($moisTS));      
											
															for ($row = 2; $row <= $highestRow; $row++){
															
															// $datee = $data->sheets[0]["cells"][$x][1];
															//  Read a row of data into an array
																$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
																$datee = $rowData[0][0];
																$CodeMissionn = $rowData[0][1];
																$Departementt = $rowData[0][2];
																$Heuree = $rowData[0][3];
																$Descriptionn = $rowData[0][4];
																
															$date_exp_excel = explode("-", $datee);
															$jour_Ex   = $date_exp_excel[2];
															$mois_Ex   = $date_exp_excel[1];
															$annee_Ex  = $date_exp_excel[0];
													
															$time_datee = strtotime($datee);
															$datee_format= date('Y-m-d',$time_datee);
				
									
															$time_Heuree = floatval ($time_Heureee);
															// $Descriptionn = $data->sheets[0]["cells"][$x][5];
															$reqCdeMission = 'select DISTINCT PP.RefProjet, PP.RefClient, PP.NomProjet nomProjet 
															from deptprojet DD
															inner join projets PP on (PP.RefProjet = DD.RefProjet)
															inner join client CC on (CC.RefClient = PP.RefClient)
															where PP.cloture <> "1"
															and PP.TypeProjet not in ("EXTRA")
															order by 1;';
															$codeDeptTS = 'select Coddept from departement order by Coddept ASC';
															$reqCdeMissionList = mysqli_query($conn,$reqCdeMission) or exit(mysqli_error($conn));       
															$reqcodeDeptTS = mysqli_query($conn,$codeDeptTS) or exit(mysqli_error($conn));
															 
														  $reqFichePointage = 'select FP.RefFichePointage from fichepointage FP
														  Inner join employes EP on (EP.RefEmploye = FP.RefEmploye)
														  where EP.Nomuser = "'.$Nomuser.'"';     
																											  
															 $rekRefFichepointage    = mysqli_query($conn,$reqFichePointage) or exit(mysqli_error($conn));
															 $resultRefFichepointage = mysqli_fetch_assoc($rekRefFichepointage);
															 
															 $refFichepointage    = $resultRefFichepointage['RefFichePointage'];
															
															$Departement_base = '';
															$CodeMission_base = '';
															 $cdmi = '';
															$n=0;
															while($r2 = mysqli_fetch_array($reqCdeMissionList, MYSQLI_BOTH)){

																   if ($CodeMissionn == $r2[0] )
																   {
																	   //$CodeMission_base = $r2[0].' --- '.$r2[2].' --- '.$r2[1];
																	   $CodeMission_base = $r2[0];
																   }
																   else
																   {
																	 
																   //Afficher un message indiquant que le code est erroné
																   //indiquer le code mission incorrecte
																   // empêcher son insertion dans la base
																	   
																	}
															while($r1 = mysqli_fetch_array($reqcodeDeptTS, MYSQLI_BOTH)){
																if ($Departementt == $r1[0])
															   {
																   $Departement_base = $r1[0];

															   }
															   else
															   {
						
															   }
															}		
													}
				
														// echo 'date = '.$datee.'</br>';
														// echo 'CodeMission_base = '.$CodeMission_base.'</br>';
														// echo 'Departement_base = '.$Departement_base.'</br>';
														// echo 'Description = '.$Descriptionn.'</br>';
														// echo 'Heure = '.$time_Heuree.'</br></br>';

													$reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';                    
													$rekRefEmp = mysqli_query($conn,$reqRefEmploye) or exit(mysqli_error($conn));
													$resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
													$refEmploye = $resultRefEmp['EMPLO'];

													$reqIdRefFP = 'select max(RefDetailFichePointage) as idFP from heuresfichepointage;';
													$rekIdRefFP = mysqli_query($conn,$reqIdRefFP) or exit(mysqli_error($conn));
													$resultIdRefFP = mysqli_fetch_assoc($rekIdRefFP);
													$IdRefFP = $resultIdRefFP['idFP'] + 1;
													//echo 'IdRefFP = '.$IdRefFP.'</br>';;

													$reqRefF = 'select fichepointage.RefFichePointage as RefF from fichepointage '
															. 'inner join periode on (periode.DateEntree = fichepointage.DateEntree)'
															. 'where periode.PERIODE = "'.$periodeTS.'"'
															. 'and fichepointage.RefEmploye = "'.$refEmploye.'"';
													$rekRefF = mysqli_query($conn,$reqRefF) or exit(mysqli_error($conn));
													$resultRefF = mysqli_fetch_assoc($rekRefF);
													$RefF = $resultRefF['RefF'];                        
													//echo 'RefF = '.$RefF.'</br>';
													$req_non_commit = "SET AUTOCOMMIT=0";
													$req_commit = "SET AUTOCOMMIT=1";
													$result_non_commit =  mysqli_query($conn,$req_non_commit) or exit(mysqli_error($conn));
													$reqInsertTS = 'INSERT INTO heuresfichepointage '
															. '(RefDetailFichePointage, RefFichePointage, JourTravaille, RefProjet, Coddept, HeureFacturables, DescriptionTravail, Facture, AFact, FFT_FLAG, FFT_AFAC, datemodification, nombremodification, usermodif, UT) '
															. 'VALUES '
															. '("'.$IdRefFP.'", "'.$RefF.'", "'.$datee.'", "'.$CodeMission_base.'", "'.$Departement_base.'", "'.$Heuree.'", "'.$Descriptionn.'", 0, 0, 0, 0, NOW(), 0, "'.$refEmploye.'", NOW())';
													$result = mysqli_query($conn,$reqInsertTS); //or exit(mysqli_error($conn)); //à decommenter pour verifier les erreurs
													// header("refresh:2;url=saisits.php"); 
													// ob_flush();
													$result2 = mysqli_query($conn,$req) or exit(mysqli_error($conn));
													

													//--------------------------------------------------------------------------------------------
													//	VERIFICATION DE LA VALIDITE DES DONNEES A IMPORTER
													//--------------------------------------------------------------------------------------------
													if ($datee != "" &&  $numMoisTS == $mois_Ex)
													{				
														if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$datee))
															{
																$date = $datee;
																
																// echo 'date = '.$datee.'</br>';
																
															}
														else
															{
																?>
															 <script type = "text/javascript">
															 var date_form1='<?PHP echo $datee;?>';
															 alert ("Date = " + date_form1 + " ;" + "Format invalide. Format acceptable est AAAA-MM-JJ");
															 </script>
															 <?php
																header("refresh:0.5;url=saisits.php"); 
																ob_flush();
																//break;
																exit; // arrêt direct du programme
															}
																
													}
													elseif ($datee != "" &&  $numMoisTS != $mois_Ex)
													{
														?>
														<script type = "text/javascript">
														var mois_act = '<?PHP echo $numMoisTS;?>';
														var annee_act = '<?PHP echo $anneeTS;?>'; 
														var date_form2='<?PHP echo $datee;?>';
														var annee_ex='<?PHP echo $annee_Ex;?>';
														var mois_ex='<?PHP echo $mois_Ex;?>';
														alert ("Insertion impossible car date du fichier Excel = " + annee_ex + "-" +  mois_ex + " différente de la date TS = " + annee_act + "-" + mois_act);
														</script>
														<?php
														header("refresh:0.5;url=saisits.php"); 
														ob_flush();
														exit; // arrêt direct du programme
													}
												
													else 
													{
														?>
														<script type = "text/javascript">
														var date_t='<?PHP echo $datee;?>';
														alert ("Vérifier Date =  "+ date_t + " car vide");
														</script>
														<?php
														mysqli_query($conn,$req_non_commit) or exit(mysqli_error($conn));
														header("refresh:0.5;url=saisits.php"); 
														ob_flush();
														//break;
														exit;
													}		
													
												if ($datee != "" &&  $numMoisTS == $mois_Ex && (!(($jourTS1 <= $jour_Ex) && ($jour_Ex <= $jourTS3))))
													{ 
														?>
														<script type = "text/javascript">
														var jour_act = '<?PHP echo $jourTS1 . " à " .$jourTS3;?>';
														var jour_ex = '<?PHP echo $jour_Ex;?>';
														var annee_act = '<?PHP echo $anneeTS;?>'; 
														var date_form2='<?PHP echo $datee;?>';
														alert ("Insertion impossible car date jour Excel = " + jour_ex + " n'est pas comprise entre = " + jour_act + " de la date jour TS");
														</script>
														<?php
														header("refresh:0.5;url=saisits.php"); 
														ob_flush();
														exit; // arrêt direct du programme
													}
																
												if ($CodeMission_base != "" )
													{ 			
														$CodeMission = $CodeMission_base;
														// echo 'CodeMission_base = '.$CodeMission_base.'</br>';											
													}
												else 
													{
													?>
													 <script type = "text/javascript">
													alert ("Vérifier Code Mission si vide ou faute de saisie ou n'existe pas dans la base");
													</script>
													 <?php
													header("refresh:0.5;url=saisits.php"); 
													ob_flush();
													//break;
													exit;
													}		
																
												if ($Departement_base != "")
													{
														$Departement = $Departement_base;		
														// echo 'Departement_base = '.$Departement_base.'</br>';
													}	
													
													else 
													{
														?>
														<script type = "text/javascript">
														alert ("Vérifier Département si faute de saisie ou vide ou n'existe pas dans la base");
														</script>
														<?php
														header("refresh:0.5;url=saisits.php"); 
														ob_flush();
														//break;
														exit;
													}												
														
												if ($Heuree != "")
													{
														if (is_numeric($Heuree))
														{
															if ($Heuree <=8)
															$Heure = $Heuree;	
															else
															{
																?>
																<script type = "text/javascript">
																var heure='<?PHP echo $Heuree;?>';
																alert ("Heure = " + heure + ". Cette valeur ne doit pas dépasser 8 heures");
																</script>
																<?php
																header("refresh:0.5;url=saisits.php"); 
																ob_flush();
																//break;
																exit;
															}
														}
														else
														{
															?>
																<script type = "text/javascript">
																var heure='<?PHP echo $Heuree;?>';
																alert ("Vérifier Heure = " + heure + " car son format est non numérique");
																</script>
																<?php
																header("refresh:0.5;url=saisits.php"); 
																ob_flush();
																//break;
																exit;
														}
													}
												else
													{
															
													?>
													<script type = "text/javascript">
													var heure='<?PHP echo $Heuree;?>';
													alert ("Vérifier Heure car c'est vide ");
													</script>
													<?php
													header("refresh:0.5;url=saisits.php"); 
													ob_flush();
													//break;
													exit;
													}
																		
												if ($Descriptionn != "")
												{
													$Description = $Descriptionn;
													// echo 'Descriptionn = '.$Descriptionn.'</br>';
												}
												else
												{
													?>
													 <script type = "text/javascript">
													alert ("Vérifier si Description est vide");
													</script>
													 <?php
													header("refresh:0.5;url=saisits.php"); 
													ob_flush();
													//break;
													exit;
												}
																				
												//--------------------------------------------------------------------------------------------
												//	FIN VERIFICATION DE LA VALIDITE DES DONNEES A IMPORTER
												//------------------------------------------------------------------------------------------
											}			
											
												//--------------------------------------------------------------------------------------------
												//	INSERTION SI LES DONNEES A IMPORTER SON VALIDE
												//------------------------------------------------------------------------------------------
												if (($date  && $CodeMission  && $Departement && $Heure  && $Description) == TRUE)
												{
													mysqli_query($conn,$req_commit) or exit(mysqli_error($conn));
													echo("<br/><center><font style='color: green'><b>Datas have being imported with success</b></font></center>"); 
													header("refresh:2;url=saisits.php"); // redirection automatique de la page upload.php vers la page saisiets.php après un temps = 5 seconde
													ob_flush();
												}
												//--------------------------------------------------------------------------------------------
												//	FIN INSERTION SI LES DONNEES A IMPORTER SON VALIDE
												//------------------------------------------------------------------------------------------
											
						}
								else 
								{ 
								echo("<br/><center><font style='color: red'><b>Sorry, File type is not allowed. Only Excel file</b></font></center>"); 
								header("refresh:2;url=saisits.php"); 
								ob_flush();								
								}
						}
						
  

//--------------------------------------------------------------------------------------------
//	TEST EXEMPLE DE FONCTION DE GESTION DE DATES
//-----------------------------------------------------------------------------------------



  function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') == $date;
}

function verifdate($date)
{
	$tmp=false;
	// cas de la date vide 
	if($date == '') return $tmp;
	// choix du traitement de la date suivant son format
	// 2 possibilité pour le format : AAAA-MM-JJ ou JJ/MM/AAAA
	$tab = explode('-', $date, 3);
	// 1ère possibilité : on vérifie s'il y a des tirets dans la date.
	if((!isset($tab[1])) && (!isset($tab[2]))) {
		$trad = $date;
	} else {
	// la seconde : il s'agit d'un date au format fr.
		$trad = $tab[2].'/'.$tab[1].'/'.$tab[0];
	}
	// séparation des jours, mois et année pour la vérification de la date
	$tab = explode('/', $trad, 3);
	// on traite l'annÈe qui doit Ítre contenu dans un entier simple,
	// il n'y a pas de chiffre nÈgatif.
	if((!isset($tab[1])) || (!isset($tab[2]))) return $tmp;
	if(($tab[2] >= 1) && ($tab[2] <= 32767)) {
		$tmp = true;
	} else {
		$tmp = false;
		return $tmp;
	}
	// en fonction du mois on dÈtermine si le nombre de jour est correct.
	switch ($tab[1])
	{
		case (1) :		// janvier
		case (3) :		// mars
		case (5) :		// mai
		case (7) :		// juillet
		case (8) :		// ao&#730;t
		case (10) :		// octobre
		case (12) :		// dÈcembre
			// ces 7 mois ont 31 jours
			if(($tab[0] >= 1) && ($tab[0] <= 31)) {
				$tmp = true;		// le numÈro du jour est contenu entre 1 et 31
			} else {
				$tmp = false;		// le numÈro du jour n'est pas contenu entre 1 et 31
				return $tmp;		// renvoie de la valeur 'faux', il n'est pas nÈcÈssaire de continuer les tests
			}
			break;
		case (4) :		// avril
		case (6) :		// juin
		case (9) :		//  septembre
		case (11) :		// novembre
			// ces 4 mois ont 30 jours
			if(($tab[0] >= 1) && ($tab[0] <= 30)) {
				$tmp = true;		// le numÈro du jour est contenu entre 1 et 30
			} else {
				$tmp = false;		// le numÈro du jour n'est pas contenu entre 1 et 30
				return $tmp;		// renvoie de la valeur 'faux', il n'est pas nÈcÈssaire de continuer les tests
			}
			break;
		case 2 :		// fÈvrier
			if($tab[2]%4 == 0){		// On regarde s'il s'agit d'une annÈe bixetile ou non en regardant le modulo de la division du nombre d'annÈe par 4
				if(($tab[0] >= 1) && ($tab[0] <= 29)) {		// 
					$tmp = true;	
				} else {
					$tmp = false;
					return $tmp;
				}
			} else {
				if(($tab[0] >= 1) && ($tab[0] <= 28)) {
					$tmp = true;
				} else {
					$tmp = false;
					return $tmp;
				}
			}
			break;
		default :
			$tmp = false;
			return $tmp;
			break;
	}
	
	if ($tmp) {
		return true;
	} else {
		return false;
	}
}



 			
