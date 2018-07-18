<?php
    header ('Content-type:text/html; charset=utf-8');
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';

    ini_set('display_errors', 0);   
    ini_set('log_errors', 1);    
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');    
    //error_reporting(e_all);

sec_session_start();
    
    // à elle seule, la ligne suivante suffit à envoyer le résultat du script dans une feuille Excel    
    header("Content-type: application/vnd.ms-excel"); // WINDOWS
    //header("Content-Type: application/force-download");
    //header("Content-Type: application/octet-stream");
    //header("Content-Type: application/download");
    //header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); LINUX
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    // la ligne suivante est facultative, elle sert à donner un nom au fichier Excel
    header("Content-Disposition: attachment; filename=export_man_".date("Y-m-d").".xls");
    //header("Content-Transfer-Encoding: binary");
    
    
/**************************************************************************************************************/    
//POUR LE TEST: année 2014
    //$taona = "2015";    
    //echo 'taona: '.$taona;
/**************************************************************************************************************/        
    
    
/**************************************************************************************************************/    
//POUR LA MISE EN PROD
      
//    $reqYear  = 'select YEAR(CURRENT_DATE()) as taona ;';
//    $resYear  = mysqli_query($connect, $reqYear) or exit(mysqli_error($connect));
//    $resTaona = mysqli_fetch_assoc($resYear);
//    $taona = $resTaona['taona'];
//		echo 'taona: '.$taona;
/**************************************************************************************************************/      
    
    //$mois          = $_POST['periode'];
    $collaborateur = $_GET['collaborateur'];
    //echo 'mois '.$mois.' coll '.$collaborateur;
    
//    $reqRefCol = 'select RefEmploye as refCol from employes where Prenom = "'.$collaborateur.'"';                    
//    $rekRefCol = mysqli_query($connect,$reqRefCol) or exit(mysqli_error($connect));
//    $resultRefCol = mysqli_fetch_assoc($rekRefCol);
//    $refCol = $resultRefCol['refCol'];
//       echo 'HOHOHO '.$refCol;
    $refCol = $collaborateur;
    
    $mm = $_GET['daty'];
    $taona = $_GET['taona'];
    $mois = "%".$mm." ".$taona."%";
//    echo 'On a cliqué sur le bouton '.$mois;  
    
    //Recherche à partir de la session en cours du manager authentifié
    $employe = $_SESSION['username'];
    //echo 'employe '.$employe;
    $reqRefEmploye = 'select RefEmploye as EMPLO from employes where Nomuser = "'.$employe.'"';                    
    $rekRefEmp = mysqli_query($connect,$reqRefEmploye) or exit(mysqli_error($connect));
    $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
    $refEmploye = $resultRefEmp['EMPLO'];
    
    //echo 'HAHAHA '.$refEmploye;
	
// MODIF CODE LILIANE PAR RODDY : Expot TS d'un (01) consultant par un manager
//-- Recherche à partir du matricule de l'employe ou du consultant
$refCons = '';
$queryref = "select RefEmploye as EMPLO  from employes where RefEmploye is not null and actif = 0 and  RefEmploye not in ('Z05', 'Z06', 'Z07', 'ZA1', 'ZA2', 'ZA3', 'ZZZ') ORDER BY Prenom ASC";
$rekref = mysqli_query($connect,$queryref) or exit(mysqli_error($connect));
while($rowRefCons = mysqli_fetch_array($rekref, MYSQLI_BOTH)){
$refCons = strval($rowRefCons[0]);		// => MODIF RODDY car refCons doit être ce type pour être pris en compte par le valeur string 'avalider'
//echo  ' refCons ='.$refCons;
 if($refCol == $refCons){
	 $reqTSEx = 'select H.RefDetailFichePointage as Ref, concat(E.Prenom, " ", E.NomFamille) as Nom, H.JourTravaille as Date, 
		H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, 
		H.HeureFacturables as Heures, H.DescriptionTravail, H.Facture,
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
			where P.PERIODE like "'.$mois.'"                
		)        
		and F.RefEmploye = "'.$refCons.'"
		order by H.JourTravaille ASC, H.RefDetailFichePointage ;';
		  $resTSEx = mysqli_query($connect,$reqTSEx) or exit(mysqli_error($connect));
			 // on vérifie le contenu de  la requête ;
			if (mysqli_num_rows($resTSEx) == 0){   
				// si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
					print "<script> alert('Aucun enregistrement trouvé!')</script>";
			}
			else{

			$colonne = mysqli_num_fields($resTSEx); //col        
			//$ligne = mysqli_num_rows($resTSEx); //rows

		//    echo "ligne: ".$ligne;
		//    echo ' colonne: '.$colonne;

			// construction du tableau HTML
			echo '<div style="max-height: 400px;overflow: scroll;  ">';
			echo '<table border=1>
				<!-- impression des titres/entetes de colonnes -->
				 <TR>

					<TD><b>Consultant</b></TD>
					<TD><b>Date</b></TD>
					<TD><b>Code mission</b></TD>
					<TD><b>Code Client</b></TD>
					<TD><b>D&eacute;partement</b></TD>
					<TD><b>Heures</b></TD>            
					<TD><b>Description</b></TD>                                            
					<TD><b>Validation</b></TD>                                            
					<TD><b>Dépense</b></TD>                                            
					<TD><b>Justificatifs</b></TD>                                            
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
									case 9: echo '<td>'.$row[$j].'</td>';  
										break;
									case 10: echo '<td>'.$row[$j].'</td>';  
										break;
								}
							}
						}
		//                else{
		//                    echo '<td>'.$val[$linina][$j].'</td>';                                    
		//                }                
					}
					else{

						for($j=1; $j < $colonne ; $j++){
								switch($j){                             
									case $j >= 1 && $j <=7: echo '<td>'.$row[$j].'</td>';  
										break;                           
									case 8: if($row['Validation']==1){
												echo '<td>Validé</td>';  
											}
											else if($row['Validation']==0){
												echo '<td>Non Validé</td>';  
											}                                
										break;
									case 9: echo '<td>'.$row[$j].'</td>';  
										break;
									case 10: echo '<td>'.$row[$j].'</td>';  
										break;
								}
							}

						//echo '<td>'.$row[$j].'</td>';             
					}            
				}

				echo '</tr>';
				$linina = $linina + 1;        
			}        

			echo '</TABLE>';
			echo '</div>';
			//mysql_close();  
			?>
				<br/>
				<form action="exportTSMan.php?daty=<?php echo $mm;?>&collaborateur=<?php echo $collaborateur;?>&taona=<?php echo $taona;?>" method="POST">
					<!--<td><a href="./missionfiltre.php?test='.str_replace('+', '%2B', $result->codeProjet).'">'.$result->codeProjet.'</a></td>';-->
					<input type="submit" name="notifTS" id="notifTS" value="Export To Excel" />        
				</form> 
			<?php
			}
		  }

	 // echo  ' refCol ='.$refCol;
	// echo  ' refCons ='.$refCons;
}

// FIN MODIF CODE LILIANE PAR RODDY : Expot TS d'un (01) consultant par un manager
									
//  MODIF CODE LILIANE PAR RODDY : Expot TS des consultants du manager référant
		if ($refCol == 'avalider')
				{
				//echo 'avalider'; 

				//echo 'On a cliqué sur le bouton '.$mois;

				$truncateT = 'truncate table temptab;';
				$resTrun   = mysqli_query($connect, $truncateT)or exit(mysqli_error($connect));   
				echo '<div style="max-height: 400px;overflow: scroll;  ">';
				

				$reqDatEntre = 'select F.DateEntree as dte, F.RefEmploye '
						. 'from fichepointage F '
						. 'inner join periode P on (P.DateEntree = F.DateEntree) '
						. 'where P.PERIODE like "'.$mois.'"'
						. 'order by F.RefEmploye ASC';
				$rekDteEntre = mysqli_query($connect,$reqDatEntre);
				$resultDteEntre = mysqli_fetch_assoc($rekDteEntre);
				$dteEntre = $resultDteEntre['dte'];                            
				//echo '<br />date '.$dteEntre;   

				$reqRefEmploye = 'select RefEmploye as EMPLO, Profil as pro from employes where Nomuser = "'.$employe.'"';                    
				$rekRefEmp = mysqli_query($connect,$reqRefEmploye);
				$resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
				$refEmploye = $resultRefEmp['EMPLO'];
				$pro = $resultRefEmp['pro'];
				//echo '<br />refEmploye '.$refEmploye;                                   
				//echo '<br />profil: '.$pro;    

				$req = 'select DPT.RefProjet as projet, DPT.Coddept as code '
				. 'from projets P '
				. 'inner join deptprojet DPT on (P.RefProjet = DPT.RefProjet) '
				. 'inner join employes E on (E.RefEmploye = DPT.Respvalid) '
				. 'where DPT.Respvalid = "'.$refEmploye.'" ';
				$reqDept = mysqli_query($connect, $req);

				while ($res = mysqli_fetch_array($reqDept, MYSQLI_BOTH)) {                                
					$reqTS = 'insert into temptab (Colaborateur, Ref, Date, CodeMission, NomClient, Departement, Heures, Description, Validation, '
							. 'RefFP, Depense, Justificatifs ) '
							. 'select concat(E.Prenom, " ", E.NomFamille) as Colaborateur, H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
							. 'H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, '
							. 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, H.Facture as Validation, '
							. 'H.RefDetailFichePointage as RefFP, '
							. 'FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs '                    
							. 'from heuresfichepointage H '
							. 'left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage) '                    
							. 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
							. 'inner join periode Pe on (F.DateEntree = Pe.DateEntree) '
							. 'inner join employes E on (E.RefEmploye = F.RefEmploye) '
							. 'inner join projets P on (P.RefProjet = H.RefProjet) '
							. 'where Pe.PERIODE like "'.$mois.'" '
							. 'and H.RefProjet = "'.$res['projet'].'" '
							. 'and H.Coddept = "'.$res['code'].'" '
							//. 'and H.Facture = "0" '
							. 'and E.RefEmploye <> "'.$refEmploye.'"'
							. 'and E.Profil <> "Associé" '
							. 'ORDER BY H.JourTravaille ASC ;';
					$resTS = mysqli_query($connect, $reqTS)or exit(mysqli_error($connect));   

					//$colonne = mysqli_num_fields($resTS); //col        
					//$ligne = mysqli_num_rows($resTS); //rows            

		//            while ($rowTS = mysqli_fetch_array($resTS, MYSQL_BOTH)) {
		//                $GLOBALS['compte'] = $compte +1;
		//                //echo "<tr onclick=\"showFacturation('".$rowTS['Date']."', '".$rowTS['CodeMission']."', '".$rowTS['RefFP']."')\">";"<tr>";
		//                echo "<tr>";
		//                echo "<td>".$rowTS['Ref']."</td>"
		//                        . "<td>".$rowTS['Colaborateur']."</td>"
		//                        . "<td>".$rowTS['Date']."</td>"
		//                        . "<td>".$rowTS['CodeMission']."</td>"
		//                        . "<td>".$rowTS['NomClient']."</td>"
		//                        . "<td>".$rowTS['Departement']."</td>"
		//                        . "<td>".$rowTS['Heures']."</td>"
		//                        . "<td>".$rowTS['Description']."</td>"
		//                        . "<td>".$rowTS['Depense']."</td>"
		//                        . "<td>".$rowTS['Justificatifs']."</td>";
		//                echo '</tr>';                                    
		//            }
				}
				$reqTim = 'select Ref, Colaborateur, Date, CodeMission, NomClient, Departement, Heures, Description, Validation,  
					Depense, Justificatifs from temptab
					order by Colaborateur ASC, Date, Ref;';
				$resTim = mysqli_query($connect, $reqTim) or exit(mysqli_error($connect));
				if (mysqli_num_rows($resTim) == 0){   
				// si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
					print "<script> alert('Aucun enregistrement trouvé!')</script>";
				}
				else{
					echo '<table border=1>
					<!-- impression des titres/entetes de colonnes -->
					 <TR>                
						<TD><b>Nom</b></TD>
						<TD><b>Date</b></TD>
						<TD><b>Code mission</b></TD>
						<TD><b>Code Client</b></TD>
						<TD><b>D&eacute;partement</b></TD>
						<TD><b>Heures</b></TD>            
						<TD><b>Description</b></TD>   
						<TD><b>Validation</b></TD>   
						<TD><b>Dépense</b></TD>                                            
						<TD><b>Justificatifs</b></TD>     
					</TR>';
				
				$colon = mysqli_num_fields($resTim); //col 
				//echo 'colon: '.$colon;
				$linin = 0;   
				$valu = array();
				while ($rowTS = mysqli_fetch_array($resTim, MYSQLI_BOTH)) {            
					echo '<tr>';  
					for($j=0; $j < $colon ; $j++){            
						if($j == 0){
							$valu[$linin] = array($rowTS[$j]);
							if($valu[$linin-1][$j] == $valu[$linin][$j]){                    
								//echo '<td>'.$valu[$linin][$j].' biiii '.$linin.'</td>';  
								for($j=0; $j < $colon ; $j++){                     
									switch($j){                             
										case $j > 1 && $j <=8: echo '<td style="border:none"></td>'; 
											break;                           
										case 9: echo '<td>'.$rowTS[$j].'</td>';  
											break;
										case 10: echo '<td>'.$rowTS[$j].'</td>';  
											break;
									}
								}
							}
			//                else{
			//                    echo '<td>'.$valu[$linin][$j].'</td>';                                    
			//                }                
						}
						else{

							for($j=1; $j < $colon ; $j++){
								switch($j){                             
									case $j >= 1 && $j <=7: echo '<td>'.$rowTS[$j].'</td>';  
										break;                           
									case 8: if($rowTS['Validation']==1){
												echo '<td>Validé</td>';  
											}
											else if($rowTS['Validation']==0){
												echo '<td>Non Validé</td>';  
											}                                
										break;
									case 9: echo '<td>'.$rowTS[$j].'</td>';  
										break;
									case 10: echo '<td>'.$rowTS[$j].'</td>';  
										break;
								}
							}

							//echo '<td>'.$rowTS[$j].'</td>';             
						}            
					}

					echo '</tr>';
					$linin = $linin + 1;                                    
				}

				echo '</TABLE>';
				
			
			//--  FIN TS A VALIDER PAR LE MANAGER MODIF CODE LILIANE PAR RODDY			
							
		}

}
// FIN MODIF CODE LILIANE PAR RODDY : Expot TS des consultants du manager référant




//  CODE LILIANE : Expot TS des consultants du manager référant
    
    // if($refCol == $refEmploye){
     //   // echo 'col';
         // $reqTSEx = 'select H.RefDetailFichePointage as Ref, concat(E.Prenom, " ", E.NomFamille) as Nom, H.JourTravaille as Date, 
        // H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, 
        // H.HeureFacturables as Heures, H.DescriptionTravail, H.Facture,
        // FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs 
        // from heuresfichepointage H
        // left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage)     
        // inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) 
        // inner join employes E on (E.RefEmploye = F.RefEmploye)
        // inner join projets P on (P.RefProjet = H.RefProjet) 
        // where H.RefFichePointage in 
        // (
            // select RefFichePointage as refFiche 
            // from fichepointage 
            // inner join periode P on (fichepointage.DateEntree = P.DateEntree)
            // where P.PERIODE like "'.$mois.'"                
        // )        
        // and F.RefEmploye = "'.$refEmploye.'"
        // order by H.JourTravaille ASC, H.RefDetailFichePointage ;';
    
    // $resTSEx = mysqli_query($connect,$reqTSEx) or exit(mysqli_error($connect));
       
  //  // on vérifie le contenu de  la requête ;
    // if (mysqli_num_rows($resTSEx) == 0){   
      //  // si elle est vide, on en informe l'utilisateur à l'aide d'un Javascript 
            // print "<script> alert('La requête n\'a pas abouti !')</script>";
    // } 
    
    // $colonne = mysqli_num_fields($resTSEx); //col        
  //  //$ligne = mysqli_num_rows($resTSEx); //rows
    
// //   echo "ligne: ".$ligne;
//  //  echo ' colonne: '.$colonne;
    
  //  // construction du tableau HTML
    // echo '<table border=1>
        // <!-- impression des titres de colonnes -->
         // <TR>
            
            // <TD><b>Consultant</b></TD>
            // <TD><b>Date</b></TD>
            // <TD><b>Code mission</b></TD>
            // <TD><b>Code Client</b></TD>
            // <TD><b>D&eacute;partement</b></TD>
            // <TD><b>Heures</b></TD>            
            // <TD><b>Description</b></TD>                                            
            // <TD><b>Validation</b></TD>                                            
            // <TD><b>Dépense</b></TD>                                            
            // <TD><b>Justificatifs</b></TD>                                            
        // </TR>';
        
    // $val = array();
    // $linina = 0;
    // while($row = mysqli_fetch_array($resTSEx, MYSQLI_BOTH)){               
        // for($j=0; $j < $colonne ; $j++){            
            // if($j == 0){
                // $val[$linina] = array($row[$j]);
                // if($val[$linina-1][$j] == $val[$linina][$j]){                    
                   // // echo '<td>'.$val[$linina][$j].' biiii '.$linina.'</td>';  
                    // for($j=0; $j < $colonne ; $j++){                     
                        // switch($j){                             
                            // case $j > 1 && $j <=8: echo '<td style="border:none"></td>'; 
                                // break;                           
                            // case 9: echo '<td>'.$row[$j].'</td>';  
                                // break;
                            // case 10: echo '<td>'.$row[$j].'</td>';  
                                // break;
                        // }
                    // }
                // }
//    //            else{
//    //                echo '<td>'.$val[$linina][$j].'</td>';                                    
//     //           }                
         //   }
         //   else{
                
                // for($j=1; $j < $colonne ; $j++){
                        // switch($j){                             
                            // case $j >= 1 && $j <=7: echo '<td>'.$row[$j].'</td>';  
                                // break;                           
                            // case 8: if($row['Validation']==1){
                                        // echo '<td>Validé</td>';  
                                    // }
                                    // else if($row['Validation']==0){
                                        // echo '<td>Non Validé</td>';  
                                    // }                                
                                // break;
                            // case 9: echo '<td>'.$row[$j].'</td>';  
                                // break;
                            // case 10: echo '<td>'.$row[$j].'</td>';  
                                // break;
                        // }
                    // }
                
             //   //echo '<td>'.$row[$j].'</td>';             
            //}            
      //  }
        
        // echo '</tr>';
        // $linina = $linina + 1;        
    // }        
        
    // echo '</TABLE>';
    // //mysql_close();        
  //  }
    //else{
      //  //echo 'avalider'; 

        // //echo 'On a cliqué sur le bouton '.$mois;
        
        // $truncateT = 'truncate table temptab;';
        // $resTrun   = mysqli_query($connect, $truncateT)or exit(mysqli_error($connect));   
        
        // echo '<table border=1>
            // <!-- impression des titres de colonnes -->
             // <TR>                
                // <TD><b>Consultant</b></TD>
                // <TD><b>Date</b></TD>
                // <TD><b>Code mission</b></TD>
                // <TD><b>Code Client</b></TD>
                // <TD><b>D&eacute;partement</b></TD>
                // <TD><b>Heures</b></TD>            
                // <TD><b>Description</b></TD>   
                // <TD><b>Validation</b></TD>   
                // <TD><b>Dépense</b></TD>                                            
                // <TD><b>Justificatifs</b></TD>     
            // </TR>';
        
        // $reqDatEntre = 'select F.DateEntree as dte, F.RefEmploye '
                // . 'from fichepointage F '
                // . 'inner join periode P on (P.DateEntree = F.DateEntree) '
                // . 'where P.PERIODE like "'.$mois.'"'
                // . 'order by F.RefEmploye ASC';
        // $rekDteEntre = mysqli_query($connect,$reqDatEntre);
        // $resultDteEntre = mysqli_fetch_assoc($rekDteEntre);
        // $dteEntre = $resultDteEntre['dte'];                            
        ////echo '<br />date '.$dteEntre;   
        
        // $reqRefEmploye = 'select RefEmploye as EMPLO, Profil as pro from employes where Nomuser = "'.$employe.'"';                    
        // $rekRefEmp = mysqli_query($connect,$reqRefEmploye);
        // $resultRefEmp = mysqli_fetch_assoc($rekRefEmp);
        // $refEmploye = $resultRefEmp['EMPLO'];
        // $pro = $resultRefEmp['pro'];
       // //echo '<br />refEmploye '.$refEmploye;                                   
      //  //echo '<br />profil: '.$pro;    
        
        // $req = 'select DPT.RefProjet as projet, DPT.Coddept as code '
        // . 'from projets P '
        // . 'inner join deptprojet DPT on (P.RefProjet = DPT.RefProjet) '
        // . 'inner join employes E on (E.RefEmploye = DPT.Respvalid) '
        // . 'where DPT.Respvalid = "'.$refEmploye.'" ';
        // $reqDept = mysqli_query($connect, $req);
        
        // while ($res = mysqli_fetch_array($reqDept, MYSQLI_BOTH)) {                                
            // $reqTS = 'insert into temptab (Colaborateur, Ref, Date, CodeMission, NomClient, Departement, Heures, Description, Validation, '
                    // . 'RefFP, Depense, Justificatifs ) '
                    // . 'select concat(E.Prenom, " ", E.NomFamille) as Colaborateur, H.RefDetailFichePointage as Ref, H.JourTravaille as Date, '
                    // . 'H.RefProjet as CodeMission , P.RefClient as NomClient, H.Coddept as Departement, '
                    // . 'H.HeureFacturables as Heures, H.DescriptionTravail as Description, H.Facture as Validation, '
                    // . 'H.RefDetailFichePointage as RefFP, '
                    // . 'FP.MontantDepense as Depense, FP.DescriptionDepense as Justificatifs '                    
                    // . 'from heuresfichepointage H '
                    // . 'left join fraisfichepointage FP on (FP.RefDetailFichePointage = H.RefDetailFichePointage) '                    
                    // . 'inner join fichepointage F on (F.RefFichePointage = H.RefFichePointage) '
                    // . 'inner join periode Pe on (F.DateEntree = Pe.DateEntree) '
                    // . 'inner join employes E on (E.RefEmploye = F.RefEmploye) '
                    // . 'inner join projets P on (P.RefProjet = H.RefProjet) '
                    // . 'where Pe.PERIODE like "'.$mois.'" '
                    // . 'and H.RefProjet = "'.$res['projet'].'" '
                    // . 'and H.Coddept = "'.$res['code'].'" '
                   // //. 'and H.Facture = "0" '
                    // . 'and E.RefEmploye <> "'.$refEmploye.'"'
                    // . 'and E.Profil <> "Associé" '
                    // . 'ORDER BY H.JourTravaille ASC ;';
            // $resTS = mysqli_query($connect, $reqTS)or exit(mysqli_error($connect));   
            
         //   //$colonne = mysqli_num_fields($resTS); //col        
         //   //$ligne = mysqli_num_rows($resTS); //rows            

//    //        while ($rowTS = mysqli_fetch_array($resTS, MYSQL_BOTH)) {
//      //          $GLOBALS['compte'] = $compte +1;
//        //        //echo "<tr onclick=\"showFacturation('".$rowTS['Date']."', '".$rowTS['CodeMission']."', '".$rowTS['RefFP']."')\">";"<tr>";
//         //       echo "<tr>";
//           //     echo "<td>".$rowTS['Ref']."</td>"
//             //           . "<td>".$rowTS['Colaborateur']."</td>"
//               //         . "<td>".$rowTS['Date']."</td>"
//                 //       . "<td>".$rowTS['CodeMission']."</td>"
//                   //     . "<td>".$rowTS['NomClient']."</td>"
//                   //     . "<td>".$rowTS['Departement']."</td>"
//               //         . "<td>".$rowTS['Heures']."</td>"
//              //          . "<td>".$rowTS['Description']."</td>"
//             //           . "<td>".$rowTS['Depense']."</td>"
//             //           . "<td>".$rowTS['Justificatifs']."</td>";
//            //    echo '</tr>';                                    
//         //   }
        // }
        // $reqTim = 'select Ref, Colaborateur, Date, CodeMission, NomClient, Departement, Heures, Description, Validation,  
            // Depense, Justificatifs from temptab
            // order by Colaborateur ASC, Date, Ref;';
        // $resTim = mysqli_query($connect, $reqTim) or exit(mysqli_error($connect)); 
        // $colon = mysqli_num_fields($resTim); //col 
   //     //echo 'colon: '.$colon;
        // $linin = 0;   
        // $valu = array();
        // while ($rowTS = mysqli_fetch_array($resTim, MYSQLI_BOTH)) {            
            // echo '<tr>';  
            // for($j=0; $j < $colon ; $j++){            
                // if($j == 0){
                    // $valu[$linin] = array($rowTS[$j]);
                    // if($valu[$linin-1][$j] == $valu[$linin][$j]){                    
                    //    //echo '<td>'.$valu[$linin][$j].' biiii '.$linin.'</td>';  
                        // for($j=0; $j < $colon ; $j++){                     
                            // switch($j){                             
                                // case $j > 1 && $j <=8: echo '<td style="border:none"></td>'; 
                                    // break;                           
                                // case 9: echo '<td>'.$rowTS[$j].'</td>';  
                                    // break;
                                // case 10: echo '<td>'.$rowTS[$j].'</td>';  
                                    // break;
                            // }
                        // }
                    // }
    //         //       else{
    //          //          echo '<td>'.$valu[$linin][$j].'</td>';                                    
    //        //        }                
                // }
                // else{
                    
                    // for($j=1; $j < $colon ; $j++){
                        // switch($j){                             
                            // case $j >= 1 && $j <=7: echo '<td>'.$rowTS[$j].'</td>';  
                                // break;                           
                            // case 8: if($rowTS['Validation']==1){
                                        // echo '<td>Validé</td>';  
                                    // }
                                    // else if($rowTS['Validation']==0){
                                        // echo '<td>Non Validé</td>';  
                                    // }                                
                                // break;
                            // case 9: echo '<td>'.$rowTS[$j].'</td>';  
                                // break;
                            // case 10: echo '<td>'.$rowTS[$j].'</td>';  
                                // break;
                        // }
                    // }
                     
                //    //echo '<td>'.$rowTS[$j].'</td>';             
                // }            
            // }

            // echo '</tr>';
            // $linin = $linin + 1;                                    
        // }
        
        // echo '</TABLE>';
                
    // }       

// FIN CODE LILIANE : Expot TS des consultants du manager référant	
    
