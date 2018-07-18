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
    
    $refTS = array_keys($_POST["modif"]);
    $recherche=implode(",", $refTS);
    $mysqli->query("SET AUTOCOMMIT=0");
    $sql = "UPDATE heuresfichepointage SET Facture=1 WHERE RefDetailFichePointage IN ($recherche)";
    $res = mysqli_query($connect,$sql);

    if($res){
        $mysqli->query("COMMIT");
        $fraisUp = "update fraisfichepointage set Facture=1 where RefDetailFichePointage IN ($recherche)";
        $resUp = mysqli_query($connect,$fraisUp);
    }
    
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
                margin-right: 100px;
            }
            table{
                border-collapse: collapse;
            }
            #echeance td{
                border: 1px solid grey;                
                /*border-style: none;*/
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
                        <a href='index.php'><span style="width: 100px; text-align:center;">ALERT</span></a>   
                        <ul>
                            <li><a href='./alertcontrat.php'><span>Contrat non signé</span></a></li>
                            <li><a href='./alertfacturation.php'><span>Alerte Facturation</span></a></li>
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
            else if($prof == 'Assistant(e) Manager'  ){
                ?>
                <!-- tabs -->
                    <nav class="menu">  
                    <div>                                        
                        <a class='tab' href='../../guide/index.php'><span style="width: 100px; text-align:center;">GUIDE</span></a>
                    </div>
                    <div>                                        
                        <a href='../../guide/client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='../../guide/client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='../../guide/client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='../../guide/client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>    
                        <a class='tab selected' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='./nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='./missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='./missiondept.php'><span>Mission par département</span></a></li>
                            <li><a class='tab selected' href='./missioncloture.php'><span>Missions cloturées</span></a></li>
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
                        <a class='tab' href='../exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>LISTE DES MISSIONS CLOTURÉES</center></b></font>
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
                        <a href='../../guide/client/index.php'><span style="width: 100px; text-align:center;">CLIENTS</span></a>
                        <ul>
                            <li><a href='../../guide/client/ajoutclient.php'><span>Nouveau Client</span></a></li>
                            <li><a href='../../guide/client/listeclient.php'><span>Liste des Clients</span></a></li>                        
                            <li><a href='../../guide/client/modifclientcode.php'><span>Modification Client</span></a></li>                            
                        </ul>
                    </div>
                    <div>    
                        <a class='tab selected' href='../mission/index.php'><span style="width: 100px; text-align:center;">MISSION</span></a>
                        <ul>
                            <li><a href='./nouvellemission.php'><span>Nouvelle Mission</span></a></li>
                            <li><a href='./missioncode.php'><span>Modification Mission</span></a></li>                        
                            <li><a href='./missiondept.php'><span>Mission par département</span></a></li>
                            <li><a class='tab selected' href='./missioncloture.php'><span>Missions cloturées</span></a></li>
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
                        <a class='tab' href='../exportation/export_TS_Cons.php'><span style="width: 100px; text-align:center;">EXPORTATION</span></a>                                                            
                    </div>                
                    <!--<div class="header"><div class="bg-help"></div></div>-->
                    <br/><br/><br/>
                    <font style=" color: black"><b><center>LISTE DES MISSIONS CLOTURÉES</center></b></font>
                    <br/>
                    </nav>
                    <!-- /tabs --> 
                <?php
            }  
                        
        ?>
                      
        <div id="container" > 
            <center>
                <div>
                    <!-- /top -->                    
                    <div id="dp">
                        <?php
                            if($res) {echo '<font color="green"><b>Time Sheet valid&eacute;.</font></b>';}
                            else{  exit('<font color="red"><b>Erreur : '.mysqli_error($connect).'</font></b>');}
                        ?>
                    </div>               
                    <!-- bottom -->
                </div>            
            </center>
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
                var selected = '<?php echo $periode;?>'                
                document.getElementById('periode').value = selected;
               
                
                $("#cochetout").click(function(){

                   var cases = $("#cases").find(':checkbox');
                   nbCoche = cases.length;
//                   alert("nbCoche " +nbCoche);
                    if(this.checked){ 
                         cases.attr('checked', true); 
                         $('#cochetext').html('Tout decocher'); 
                     }
                     else{ // si on décoche 'cocheTout' 
                         cases.attr('checked', false);
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

