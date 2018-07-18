<!DOCTYPE html>

<?php
date_default_timezone_set('Etc/UTC');
    header ('Content-type:text/html; charset=utf-8');
    require_once '../../includes/db_connect.php';
    require_once '../../includes/fonction.php';
    require_once '../../includes/functions.php';
    
    sec_session_start();
        
    ini_set('display_errors', 0);    
    ini_set('log_errors', 1);    
    ini_set('error_log', 'C:\www\TS\log_error_php.txt');    
//    error_reporting(e_all);     
    
    $ligne = $_GET['ligne'];
//    $datemvt = $_GET['datemvt'];
//    $codemission  = $_GET['codemission'];
//    $dptm  = $_GET['dptm'];
//    $heure  = $_GET['heure'];
//    $desp = $_GET['desp'];
    
//    echo 'ligne: '.$ligne.' datemvt: '.$datemvt.' codemission: '.$codemission.' dptm: '.$dptm.' heure: '.$heure.' desp: '.$desp;
?>



<html>
    <head>
        <title>Saisi Time Sheet</title>
        <link rel="shortcut icon" href="../../logo/fthm.ico" type="image/x-icon" />
            <!-- head -->
        <meta charset="utf-8">  
        <!--dialog-->
        <script type="text/javascript" src="../../jquery/jquery.js"></script>        
        <script src="../../jquery/jquery-1.8.1.min.js" type="text/javascript"></script>        
        <script src="../../jquery/jquery-ui-1.11.2/jquery-ui.js"></script>                
        <!--<link rel="stylesheet" href="../../jquery/jquery-ui-1.11.2/jquery-ui.css" />-->
        <link rel="stylesheet" href="../../jquery/jquery-ui-1.11.2/sssh.css" />
        
        <!-- demo stylesheet -->  
        <link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=1783" />
        <link type="text/css" rel="stylesheet" href="../../includes/db_connect.php"
        

        <!-- helper libraries -->
        <!--<script src="../helpers/jquery-1.9.1.min.js" type="text/javascript"></script>-->

        <!-- daypilot libraries -->
        <script src="../js/daypilot-all.min.js?v=1783" type="text/javascript"></script>

          
	<!-- /head -->
        <style type="text/css">    
            table{
                border-collapse: collapse;
            }
            #echeance td{
                border: 1px solid grey;                
                /*border-style: none;*/
            }
            
            #echeance input, input[type='textarea']{
                border-color: transparent;
            }            
            
            .trans {
                border-style: none;
            }
            
            input[type='submit'] {
                /*width: 100px!important;*/    
                float: right;
                margin-right: 80px;            
            }
        </style>
    </head>
    <body>


  <!-- top -->
    <?php if (login_check($mysqli) == true) : ?>
        <div id="header">            
            
            
        </div>   
        
      

    <div id="main">
        
                      
        <div id="container" >
            <div id="left" class="menu">
                
            </div>
            
            <div>
                <div>
                    <!-- /top -->                    
                    <div id="dp">
                        
                        <div id="alert" title="Détails des dépenses">
                            <p> 
                            <ul><ul>
                                <form name="ajoutDep" id="ajoutDep"> 
                                <table id="echeance">
                                <thead>
                                <caption>Dépense liées au TS de la ligne <?php echo $ligne;?></caption>                               
                                    <tr>                                        
                                        <td>Cat&eacute;gorie</td>
                                        <td>Montant MGA</td>
                                        <td>Description</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for($i=0;$i<3;$i++){
                                    ?>
                                    <tr>                                        
                                        <td>
                                            <select id="modCat[]" name="modCat[] ">
                                            <?php
                                                $reqCateg = 'select Categ from depense order by Categ ASC;';
                                                $resultCateg = mysqli_query($connect,$reqCateg) or exit(mysqli_error($connect));
                                            ?>
                                                <option selected=""></option>
                                            <?php
                                                while($r = mysqli_fetch_array($resultCateg, MYSQLI_BOTH)){
                                                    echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                                }
                                            ?>
                                        </select>
                                        </td>
                                        <td><input id="modMontant[]" type="text" name="modMontant[]" /></td>
                                        <td><input id="modDes[]" type="text" name="modDes[]"></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                            </form>
                            </ul></ul>
                            </p>
                        </div>
                    </div>               
                    <!-- bottom -->
                </div>
            </div>
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
            $(document).ready(function(){
                for(i=0;i<3;i++){
                    //var 
                }
            });                                
            
            function saisieDesc(select){
                if(select.value === 'Saisir Manuellement'){
                    //<input id="description" type="text" name="description" />
                    var description = document.createElement('input');
                    description.setAttribute("id", "description");
                    description.setAttribute("name", "description");
                    description.setAttribute("type", "text");                    
                    select.parentNode.replaceChild(description, select);                    
                }
            }
        </script>
    </body>
</html>

