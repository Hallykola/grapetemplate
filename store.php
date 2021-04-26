<?php
//this code has been edited but is not working 
//header("Content-Type:application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-type: application/json');
include_once('db.php');
$rawdata = file_get_contents("php://input");
$data = json_encode($rawdata);

$cleandata = json_decode($rawdata,true);
print_r($cleandata);
if(isset($cleandata['id'])){
$id = $cleandata['id'];
}
$assets = $cleandata['gjs-assets'] ;
$components = $cleandata['gjs-components'] ;
$css =  $cleandata['gjs-css'] ;
$html = $cleandata['gjs-html'] ;
$styles =  $cleandata['gjs-styles'];
 
if (isset($id)){
    $sql = 
    "UPDATE `data_raw` SET `data`= ?,`assets`= ?,`components`=?,`css`= ?,`html`=?,`styles`=? WHERE `id` = ?";
    $statement= $conn->prepare($sql);
    $statement->bind_param('ssssssi',$rawdata,$assets,$components,$css,$html,$styles,$id);
    $statement->execute();
}else{
    $sql = "INSERT INTO `data_raw` (`data`,`html`,`components`,`assets`,`css`,`styles`) VALUES (?,?,?,?,?,?)  ";
    $statement= $conn->prepare($sql);
    $statement->bind_param('ssssss',$rawdata,$html,$components,$assets,$css,$styles);
    $statement->execute();
}

// $assets = $data['gjs-assets'];
// $components = $data['gjs-components'];
// $css = $data['gjs-css'];
// $html = $data['gjs-html'];
// $styles = $data['gjs-style'];
// $id = $data['id'];
// $json = file_get_contents('php://input');
// print_r($json);

// $post = file_get_contents('php://input');
// print_r($post);
// function addTemplate($assets, $components, $css, $html, $styles){
//     global $conn;
    
//     $sql_putTransactions = "INSERT INTO `pages` (`assets`, `components`, `css`, `html`, `styles`) VALUES (?,?,?,?,?)";

//     $statement_putTransactions = $conn->prepare($sql_putTransactions);
//     echo $conn->error;
//     $statement_putTransactions->bind_param("sssss",$assets, $components, $css, $html, $styles);
//     echo $conn->error;
//     if($statement_putTransactions->execute()==TRUE){
//         echo $conn->error;
//         return TRUE;
//     }else{
//         return FALSE;
//         echo $conn->error;
//     }
//     $statement_putTransactions->free_result();
//     $statement_putTransactions->close();
    
   
//     $conn->close();
// }
// function updateTemplate ($id,$assets, $components, $css, $html, $styles){
//     global $conn;
//     $sql_putTransactions =
//     "UPDATE `pages` SET `assets`= ?,`components`=?,`css`= ?,`html`=?,`styles`=? WHERE `id` = ?";
//     $statement_putTransactions = $conn->prepare($sql_putTransactions);
//     echo $conn->error;
//     $statement_putTransactions->bind_param("sssssi", $assets, $components, $css, $html, $styles,$id);
//     $statement_putTransactions->execute();
//     echo $conn->error;
//     if($statement_putTransactions->execute()==TRUE){
       
//         return TRUE;
//     }else{
//         return FALSE;
//     }
    
//     $statement_putTransactions->close();
//     $conn->close();
// }

// if (isset($id) && $id!="") { //isset($_POST['id']) && $_POST['id']!=""
//     updateTemplate($id, $assets, $components, $css, $html, $styles);
// }else{
//     addTemplate($assets, $components, $css, $html, $styles);
// }
// response($id, $assets, $components, $css, $html, $styles);
 
// function response($id, $assets, $components, $css, $html, $styles){
//  $response['id'] = $id;
//  $response['gjs-assets'] = $assets;
//  $response['gjs-components'] = $components;
//  $response['gjs-css'] = $css;
//  $response['gjs-html'] = $html;
//  $response['gjs-styles'] = $styles;
 
//  $json_response = json_encode($response);
//  echo $json_response;
 
// }
?>