<?php
require_once('vendor/autoload.php');
use Dompdf\Dompdf;


include ("config.php");

$dompdf = new Dompdf();
$html = file_get_contents('src\pdfs\invoice.html');
header("Content-type: application/pdf");
$dompdf->loadHtml($html);
$dompdf->render();
echo $dompdf->output();
if (isset($_POST["addDraft"]))
{
    // TODO : write insert query for  invoice after inset  display the pdf 
}


?>