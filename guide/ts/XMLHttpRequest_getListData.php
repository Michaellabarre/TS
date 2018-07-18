<?php
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
echo "<list>";
// require_once '../../includes/db_connect.php';
// require_once '../../includes/psl-config.php';

    $codeMi = (isset($_POST["codeMission"])) ? htmlentities($_POST["codeMission"]) : NULL;    
    //$codeMi = 'AQUALMA0215';
    // $codeMi = 'ADM';
    //$codeMi = 'CANAL+0315';
    //$codeMi = 'lili';
    //$codeMi = 'CANAL%2B0112';
   //echo "222";
   //echo "codeMi = ".$codeMi;

   if ($codeMi) {       
       //$codeMi = urldecode($codeMi);
        //echo "codeMi = ".$codeMi;
       // mysql_connect("localhost", "manager", "eKcGZr59zAa2BEWUp");
       //mysql_connect("localhost", "root", "root");

			
      // mysqli_connect("localhost", "root", "29janvier1986", "basets");
      // mysqli_select_db("basets");
      
      /*MODIF RODDY ------------------*/
      //$mysqli = new mysqli("localhost", "root", "29janvier1986", "basets");
      $mysqli = new mysqli("localhost", "manager", "eKcGZr59zAa2BEWUp", "basets");
		if ($mysqli->connect_error) {
			die('Erreur de connexion ('.$mysqli->connect_errno.')'. $mysqli->connect_error);
			}
		else
		{
		/*MODIF RODDY ------------------*/
		
			//echo "ok";
			// echo $codeMi;
			$query = mysqli_query($mysqli, 'SELECT Coddept as Coddept FROM deptprojet WHERE RefProjet= "'.$codeMi.'" ORDER BY Coddept'); //=> selection Coddep qui dépend uniquement des code missions
			//$query = mysqli_query($mysqli, 'SELECT JH.Refprojet, CodDep.Coddept  FROM employes CodDep INNER JOIN jhprevu JH ON (CodDep.RefEmploye = JH.RefEmploye) WHERE JH.RefProjet = "'.$codeMi.'" ORDER BY CodDep.Coddept'); //=> selection Coddept qui dépend des intervenants de la mission
				if($query){
					//echo '<br/>haha';
					while ($back = mysqli_fetch_assoc($query)) {
						  //$str = $back["Coddept"];
						  //echo "str = ". $str;                               
						$str = "<item id=\"" . $back["Coddept"] . "\" name=\"" . $back["Coddept"] . "\" />";
						$xmlStr = str_replace("&", "&amp;", $str);
						echo $xmlStr;
						// echo "222";            
					}
				}
				else{
					?>
					<script type = "javascript">
					alert ("Désolé, vous n'appartenez pas à cette mission");
					</script>
					<?php
					//echo '<br/>aaaa';
				} 
		}
		
		
        //$query = mysqli_query('SELECT Coddept as Coddept FROM deptprojet WHERE RefProjet= "'.$codeMi.'"  ORDER BY Coddept');
        //$query = mysqli_query($connect, "SELECT Coddept FROM deptprojet WHERE RefProjet='ACCB0115' ORDER BY Coddept");
        //echo "222";
        /*if($query){
            echo '<br/>haha';
            while ($back = mysqli_fetch_assoc($query)) {
				  $str = $back["Coddept"];
				  echo "str = ". $str;                               
                $str = "<item id=\"" . $back["Coddept"] . "\" name=\"" . $back["Coddept"] . "\" />";
                $xmlStr = str_replace("&", "&amp;", $str);
                echo $xmlStr;
                echo "222";            
            }
        }
        else{
            echo '<br/>aaaa';
        } */
    }

    echo "</list>";


?>

