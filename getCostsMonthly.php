<?php
include_once("config_api.php");
if(isset($_REQUEST['month'])){
    $json['status']='ok';
    $date = sqi($_REQUEST['month']);
    $p=getAllMonthly('cost',$date);
    $json['cost']=$p;
    header("content-Type:application/json; charset=utf-8");
    echo json_encode($json,JSON_UNESCAPED_UNICODE);
}
?>