<?php
require_once"vendor/autoload.php";
include_once('db.php');

global $conn;
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator("Wael Salah");
$pdf->SetAuthor('Wael Salah');
$pdf->SetTitle('Demonstrating pdf with php');

$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 6, 255), array(0, 64, 128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set default font subsetting mode

$pdf->setFont('dejavusans', '', 14, '', true);

$pdf->AddPage();

$html = <<<EOD
<h1 style="text-decoration:none;background-color:#CC0000;color:black;">Demonstrating pdf with php</h1>
<p>In this simple example i show how to generate pdf documents using TCPDF</p>
EOD;

$id = 40;
                $sql = "SELECT * FROM `data_raw` WHERE `id`= ?";
$statement = $conn->prepare($sql);
$statement->bind_param('i',$id);
$statement->execute();
$result = $statement->get_result();
$data = $result->fetch_assoc();


 //$response['id'] = $id;
 $response['gjs-assets'] = $data['assets'] ;
 $response['gjs-components'] = $data['components'];
 $response['gjs-css'] = $data['css'];
 $response['gjs-html'] = $data['html'];
 $response['gjs-styles'] = $data['styles'];

//  echo $response['gjs-css'];
//  echo "<br/>";
//  echo $response['gjs-html'];

//  ob_start();

 $template = "
 <html>
 <head>
 <style>"
 .$response['gjs-css']."
 </style>
 </head>
 <body>"
 .$response['gjs-html']."

 </body>
 </html>
 ";
$pdf->writeHTML($template);

$pdf->Output('test.pdf', 'I');

?>