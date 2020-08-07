<?php
include_once("config_api.php");
    $json = array();
    $json['status'] = 'ok';
    $limit = 5;
    $p = getrecord("cost",$limit );
    $json['costs'] = $p;
    header("content-Type:application/json; charset=utf-8");
    echo json_encode($json, JSON_UNESCAPED_UNICODE);
?>

