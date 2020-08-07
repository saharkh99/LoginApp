<?php
include_once("config_api.php");
if(isset($_REQUEST['amount']) and isset($_REQUEST['color'])
    and isset($_REQUEST['type']) and isset($_REQUEST['idAccount'])){
    $json['status']='ok';
    $amount = sqi($_REQUEST['amount']);
    $color = sqi($_REQUEST['color']);
    $type = sqi($_REQUEST['type']);
    $idAccount = sqi($_REQUEST['idAccount']);
    $add = addrecord("cost",array("amount"=>$amount,"color"=>$color,"type"=>$type,"idAccount"=>$idAccount));
    if($add){
        $json['add']='true';
    }
    else{
        $json['add']='false';
    }
    header("content-Type:application/json; charset=utf-8");
    echo json_encode($json,JSON_UNESCAPED_UNICODE);
}
?>