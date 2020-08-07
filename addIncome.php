<?php
include_once("config_api.php");
if(isset($_REQUEST['amount']) and isset($_REQUEST['color']) and isset($_REQUEST['type'])){
    $json['status']='ok';
    $amount = sqi($_REQUEST['amount']);
    $color = sqi($_REQUEST['color']);
    $type = sqi($_REQUEST['type']);
    $add = addrecord("income",array("amount"=>$amount,"color"=>$color,"type"=>$type));
    if($add){
        $json['add']='true';
    }
    else{
        errorjson("هزینه به درستی اضافه نشد دوباره امتحان کنید");
    }
    header("content-Type:application/json; charset=utf-8");
    echo json_encode($json,JSON_UNESCAPED_UNICODE);
}
?>