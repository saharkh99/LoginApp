<?php
include_once("config_api.php");
$json = array();
$json['status'] = 'ok';
$limit = 5;
$p = getrecord("income",$limit );
$json['income'] = $p;
header("content-Type:application/json; charset=utf-8");
echo json_encode($json, JSON_UNESCAPED_UNICODE);
?>

