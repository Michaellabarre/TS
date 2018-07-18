<?php

//require_once '../../includes/db_connect.php';
    require_once '../../fpdf17/fpdf.php';
    
ini_set('display_errors', 0);    
ini_set('log_errors', 1);    
ini_set('error_log', 'C:\www\TS\log_error_php.txt');    

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10);
//    $pdf->Cell(400,10,'E006');
    $pdf->Cell(400,10,'E006 - Fiche d\'ouverture de mission');
    $pdf->Output();
?>