<?php
$form = filter_input(INPUT_POST, 'ok');
if($form){
        foreach ($_POST['date'] as $key => $date){
                try{
                        if(trim($date) == false){
                                throw new Exception('Date_Vide');
                        }
                        $d = new DateTime($date);
                        $d = $d->format('Y-m-d');
                        echo 'date '.$key.' = '. $d;
                        echo '<br>';
                }
                catch(Exception $e){
                        $erreur = $e->getMessage();
                        echo $erreur == 'Date_Vide' ? 'date '.$key.' = Date vide' : 'date '.$key.' = Erreur de date';
                        echo '<br>';
                }
        }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>jQuery UI Datepicker - French calendar</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.11.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
$(function(){            
        var datepicker = function(saisie,envoi){
                saisie.datepicker({
                monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
                dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
                dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
                dateFormat: "DD d MM yy"
                })
                .on('change', function(){
                        var date = $(this).datepicker( "getDate" );
                        date = $.datepicker.formatDate("yy-mm-dd", date);
                        envoi.val(date);
                })
        }
        var form = $('#form1').find("form");
        var saisie = form.find("input[data-picker=picker]");
        var envoi = form.find("input[data-picker=date]");
        if(saisie.length == envoi.length){
                saisie.each(function(i){
                        datepicker($(this),$(envoi[i]));
                });
        }
        else{
                alert('Le nombre de champs de saisie ayant l\'attribut data-picker="picker" est différent du nombre de champs d\'envoi des données ayant l\'attribut data-picker="date"')
        }
});
</script>
</head>
<body>
    <div id = "form1">
        <form ation = "#" method="post">
            <label><span style=" text-decoration:underline">Date 0</span> <input type="text" data-picker="picker" style="width:180px"></label>
            <input name="date[]" data-picker="date" type="hidden"  value="">
            <label><span style=" text-decoration:underline">Date 1</span> <input type="text" data-picker="picker" style="width:180px"></label>
            <input name="date[]" data-picker="date" type="hidden"  value="">
             <label><span style=" text-decoration:underline">Date 2</span> <input type="text" data-picker="picker" style="width:180px"></label>
            <input name="date[]" data-picker="date" type="hidden"  value="">
           <input name="ok" type="submit" value = "envoyer">
       </form>
   </div>
</body>
</html>