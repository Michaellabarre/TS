<?php

function dateChange($date){
    $tab = explode("-", $date);
    $dateChangee = $tab[2]."-".$tab[1]."-".$tab[0];
    return $dateChangee;
}

function nbJours($fin, $debut) {
    //60 secondes X 60 minutes X 24 heures dans une journée
    $nbSecondes= 60*60*24;

    $debut_ts = strtotime($debut);
    $fin_ts = strtotime($fin);
    $diff = $fin_ts - $debut_ts;
    return round($diff / $nbSecondes);
}

function get_nb_open_days($date_start, $date_stop){ 
        $arr_bank_holidays = array(); // Tableau des jours fériés     
        $diff_year = date('Y', $date_stop) - date('Y', $date_start);
        //print 'diff_year = '.$diff_year;
        for ($i = 0; $i <= $diff_year; $i++) { 
        $year = (int)date('Y', $date_start) + $i;
        //var_dump($year);
        //echo 'year = '.$year;
        // au cas ou dans la demande l'ajout de jour ferie
        $arr_bank_holidays[] = '0_0_'.$year; // Jour de l'an 
        //var_dump($arr_bank_holidays);
        
        // Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecôte 
        //        $easter = easter_date($year);
        // $arr_bank_holidays[] = date('j_n_'.$year, $easter + 86400); // Paques
        // $arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*39)); // Ascension
        // $arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*50)); // Pentecote 
    }
           //print_r($arr_bank_holidays);

    $nb_days_open = 0;

    while ($date_start <= $date_stop) {
        // Si le jour suivant n'est ni un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés 
        if (!in_array(date('w', $date_start), array(0, 6)) && !in_array(date('j_n_'.date('Y', $date_start), $date_start), $arr_bank_holidays)){
            $nb_days_open++;            
        }
        $date_start = mktime(date('H', $date_start), date('i', $date_start), date('s', $date_start), date('m', $date_start), date('d', $date_start) + 1, date('Y', $date_start)); 
    }
    
    return $nb_days_open;
}

function getMonth($month) {
    $month_arr[1]=   "January";
    $month_arr[2]=   "February";
    $month_arr[3]=   "March";
    $month_arr[4]=   "April";
    $month_arr[5]=   "May";
    $month_arr[6]=   "June";
    $month_arr[7]=   "July";
    $month_arr[8]=   "August";
    $month_arr[9]=   "September";
    $month_arr[10]=  "October";
    $month_arr[11]=  "November";
    $month_arr[12]=  "December";

    return $month_arr[$month];
}

function tsmail($emp, $periode, $datedead){
        error_reporting(E_STRICT | E_ALL);

        date_default_timezone_set('Etc/UTC');

        require './phpmailer/PHPMailerAutoload.php';

        global $connect;
        $mail = new PHPMailer;

        $body = file_get_contents('contents.html');                

        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        
        // For most clients expecting the Priority header:
// 1 = High, 2 = Medium, 3 = Low
        $mail->Priority = 1;

        $mail->Host = gethostbyname('mx1.fthmconsulting.com');
        $mail->SMTPAuth = true;
        $mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
        $mail->Port = 587;
        $mail->Username = 'webmailer@fthmconsulting.com';
        $mail->Password = 'W3bM@1l3rM@t4nj@k@B3';
        $mail->setFrom('webmailer@fthmconsulting.com', 'TS notifier');
        //$mail->addReplyTo('list@example.com', 'List manager');        

        $mail->Subject = 'Missing Time Sheet Notification - ' .$periode .' - DEADLINE '.$datedead;

        //Same body for all messages, so set this before the sending loop
        //If you generate a different body for each recipient (e.g. you're using a templating system),
        //set it inside the loop
        $mail->msgHTML($body);
        //msgHTML also sets AltBody, but if you want a custom one, set it afterwards
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        
        $consultant = 'select E1.RefEmploye as ConsultEmp, E1.NomFamille as NomFamille, E1.Adresse as Adresse, E2.RefEmploye as ManRefEmp, E2.Adresse as manAdresse '
                . 'from employes E1, employes E2 '
                . 'where E1.RefEmploye in ('.$emp.') '
                . 'and E1.Manager = E2.RefEmploye;';
        
//        echo '<br/><br/>req: '.$consultant;
        $result = mysqli_query($connect, $consultant);
        $numRows = mysqli_num_rows($result);

        while ($row = mysqli_fetch_assoc($result)) { //This iterator syntax only works in PHP 5.4+  
            
//            echo 'refemp: '.$row['ConsultEmp'].', conAdresse: '.$row['Adresse'].', ManRefEmp: '.$row['ManRefEmp'].', manAdresse: '.$row['manAdresse'].'<br/>';
            $mail->addAddress($row['Adresse'], '');
            //            $mail->AddBCC($row['manAdresse'], '');   
//            $mail->AddCC($row['manAdresse'], '');    
            echo '<br><br>';

            if (!$mail->send()){
                echo "Mailer Error (" . str_replace("@", "&#64;", $row["Adresse"]) . ') ' . $mail->ErrorInfo . '<br />';
                break; //Abandon sending
            } 
            else{
                echo "Message sent to :" . $row['NomFamille'] . ' (' . str_replace("@", "&#64;", $row['Adresse']) . ')<br />';                      
            }
            // Clear all addresses and attachments for next loop
            $mail->clearAddresses();            
        }
    }
    
function datymiova($date){
    $tab = explode("-", $date);
    $dateChangee = $tab[2]."-".$tab[1]."-".$tab[0];
    return $dateChangee;        
}    
    
function mailFact($Echeance, $RefProjet, $Typefac, $Libelle, $Montant, $NomProjet, $passManager, $nomUser, $user, $devise){
        error_reporting(E_STRICT | E_ALL);

        date_default_timezone_set('Etc/UTC');

        require '../../phpmailer/PHPMailerAutoload.php';        
        global $connect;
        
        
        $mail = new PHPMailer;

        $body = file_get_contents('facturationContents.html');             
        $body = str_replace('[code_mission]', $RefProjet, $body);
        $body = str_replace('[titre_mission]', utf8_decode($NomProjet), $body);
        $body = str_replace('[libelle]', utf8_decode($Libelle), $body);
//        $body = str_replace('[montant]', $Montant, $body);
        $body = str_replace('[montant]', number_format((float)$Montant, 2, ".", ","), $body);
        $body = str_replace('[date]', datymiova($Echeance), $body);
        $body = str_replace('[type]', utf8_decode($Typefac), $body);
        $body = str_replace('[devise]', $devise, $body);
        
//        number_format((float)$rowFac[$p], 2, ".", " ")

        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        
        // For most clients expecting the Priority header:
// 1 = High, 2 = Medium, 3 = Low
        $mail->Priority = 1;

        $mail->Host = gethostbyname('mx1.fthmconsulting.com');
        $mail->SMTPAuth = true;
        $mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
        $mail->Port = 587;
        
       // $adresse = $nomUser . '@fthm.mg';       
        $mail->Username = 'webmailer@fthmconsulting.com';
        $mail->Password = 'W3bM@1l3rM@t4nj@k@B3';
        
        $mail->setFrom('webmailer@fthmconsulting.com', utf8_decode($user));                        
        
        $sub = 'Ordre de facturation sur la mission ' .$RefProjet;
        $mail->Subject = utf8_decode($sub);

        //Same body for all messages, so set this before the sending loop
        //If you generate a different body for each recipient (e.g. you're using a templating system),
        //set it inside the loop
        $mail->msgHTML($body);
        //msgHTML also sets AltBody, but if you want a custom one, set it afterwards
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        //$mail->addAddress('daf@fthm.mg', '');
        $mail->AddCC($adresse, ''); 
        
        echo '<br><br>';

        if (!$mail->send()){
            echo "Mailer Error (" . str_replace("@", "&#64;", 'daf@fthmconsulting.com' )  . $mail->ErrorInfo . '<br />';
//            break; //Abandon sending
        } 
        else{            
            echo "Message sent to :" . $user . ' (' . str_replace("@", "&#64;", 'daf@fthmconsulting.com') . ')<br />';                      
        }
        
        $mail->clearAddresses();                          
    }    
    
