<?php
require_once"vendor/autoload.php";
                  include_once('db.php');

global $conn;
                //   $sql = "SELECT * FROM `data_raw` ";
                //   $statement = $conn->prepare($sql);
                //   $statement->execute();
                //   $data = $statement->get_result()->num_rows;
              
                //   $position = $data+1;

                //   $sql = "INSERT INTO `data_raw` (`data`,`html`,`components`,`assets`,`css`,`styles`) VALUES (?,?,?,?,?,?)  ";
                //   $statement= $conn->prepare($sql);
                //   $empty = "hello";
                //   $statement->bind_param('ssssss',$empty,$empty,$empty,$empty,$empty,$empty);
                //   $statement->execute();
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

  ob_start();

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
//  //echo $response['gjs-assets'] ;
 $template = str_replace("[businessname]","Teleprinter",$template);
 $template = str_replace("[about]","Business Softwares",$template);
 $template = str_replace("[phone]","08068858953",$template);
 $template = str_replace("[email]","info@teleprintersoftwares.com",$template);
 $template = str_replace("[buyer]","Olawale",$template);
 $template = str_replace("[billstreet]","Iyana Ipaja",$template);
 $template = str_replace("[billphone]","080888666",$template);

 echo $template;

 $html=ob_get_clean();
 $dom = new DOMDocument();
 $dom->loadHTML($html);
 $xpath = new DOMXPath($dom);
 $table = $xpath->query('//table');
 $oddrow = $xpath->query('//table//tr[@class="odd"]');
 $evenrow = $xpath->query('//table//tr[@class="even"]');
echo $evenrow->item(0)->textContent;
function setNode($node, $a, $b, $c, $d){
    $node->childNodes[0]->nodeValue = $a ;
    $node->childNodes[1]->nodeValue = $b;
    $node->childNodes[2]->nodeValue = $c;
    $node->childNodes[3]->nodeValue = $d;
}
$even = false;
$name = ["rice","beans","yam","gaari","sugar"];
for ($i = 0; $i<5; $i++){
    if($even){
        $newrow = $evenrow->item(0)->cloneNode(true);
    }else{
        $newrow = $oddrow->item(0)->cloneNode(true);
      
    }
    setNode($newrow,"one",$name[$i],"three", "Four");
 $table->item(0)->appendChild($newrow);
 $even = !$even;
}
$oddrow->item(0)->parentNode->removeChild($oddrow->item(0));
$evenrow->item(0)->parentNode->removeChild($evenrow->item(0));



$html = @ $dom->saveHTML();
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();


?>