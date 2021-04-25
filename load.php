<?php
// this code has not been edited, just pure copy and paste
header('Content-type: application/json');
if (isset($_GET['id']) && $_GET['id']!=""){
  include('db.php');
  $id = $_GET['id'];
  $result = mysqli_query(
  $con,
  "SELECT * FROM `pages` WHERE  id=$id");
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    $assets = $row['assets'];
    $components = $row['components'];
    $css = $row['css'];
    $html = $row['html'];
    $styles = $row['styles'];
    response($id, $assets, $components, $css, $html, $styles);
    mysqli_close($con);
  }else{

    response(NULL, NULL,NULL,NULL, 200,"No Record Found");
  }
}else{

    response(NULL, NULL,NULL,NULL, 200,"No Record Found");
}
 
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