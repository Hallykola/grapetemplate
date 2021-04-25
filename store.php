<?php
//this code has been edited but is not working 
//header("Content-Type:application/json");
header('Content-type: application/json');
include_once('db.php');
$data = json_decode(file_get_contents("php://input"));
$assets = $data['gjs-assets'];
$components = $data['gjs-components'];
$css = $data['gjs-css'];
$html = $data['gjs-html'];
$styles = $data['gjs-style'];
$id = $data['id'];
// $json = file_get_contents('php://input');
// echo $json;

// $post = file_get_contents('php://input');
// print_r($post);
function addTemplate($assets, $components, $css, $html, $styles){
    global $conn;
    
    $sql_putTransactions = "INSERT INTO `pages` (`assets`, `components`, `css`, `html`, `styles`) VALUES (?,?,?,?,?)";

    $statement_putTransactions = $conn->prepare($sql_putTransactions);
    echo $conn->error;
    $statement_putTransactions->bind_param("sssss",$assets, $components, $css, $html, $styles);
    echo $conn->error;
    if($statement_putTransactions->execute()==TRUE){
        echo $conn->error;
        return TRUE;
    }else{
        return FALSE;
        echo $conn->error;
    }
    $statement_putTransactions->free_result();
    $statement_putTransactions->close();
    
   
    $conn->close();
}
function updateTemplate ($id,$assets, $components, $css, $html, $styles){
    global $conn;
    $sql_putTransactions =
    "UPDATE `pages` SET `assets`= ?,`components`=?,`css`= ?,`html`=?,`styles`=? WHERE `id` = ?";
    $statement_putTransactions = $conn->prepare($sql_putTransactions);
    echo $conn->error;
    $statement_putTransactions->bind_param("sssssi", $assets, $components, $css, $html, $styles,$id);
    $statement_putTransactions->execute();
    echo $conn->error;
    if($statement_putTransactions->execute()==TRUE){
       
        return TRUE;
    }else{
        return FALSE;
    }
    
    $statement_putTransactions->close();
    $conn->close();
}

if (isset($id) && $id!="") { //isset($_POST['id']) && $_POST['id']!=""
    updateTemplate($id, $assets, $components, $css, $html, $styles);
}else{
    addTemplate($assets, $components, $css, $html, $styles);
}
response($id, $assets, $components, $css, $html, $styles);
 
function response($id, $assets, $components, $css, $html, $styles){
 $response['id'] = $id;
 $response['gjs-assets'] = $assets;
 $response['gjs-components'] = $components;
 $response['gjs-css'] = $css;
 $response['gjs-html'] = $html;
 $response['gjs-styles'] = $styles;
 
 $json_response = json_encode($response);
 echo $json_response;
 
}
?>