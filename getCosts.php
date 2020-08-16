<?php
include_once("config_api.php");
$json = array();
$json['status'] = 'ok';
if(isset($_REQUEST['limit'])){
    $limit = sqi($_REQUEST['limit']);
    $p = getrecord("income",$limit );
    $json['income'] = $p;
    header("content-Type:application/json; charset=utf-8");
    echo json_encode($json,JSON_UNESCAPED_UNICODE);
}
else {
    $p = getrecord("income");
    $json['income'] = $p;
    header("content-Type:application/json; charset=utf-8");
    echo json_encode($json, JSON_UNESCAPED_UNICODE);
}
?>

