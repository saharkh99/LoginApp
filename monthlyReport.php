<?php
include_once("config_api.php");
if(isset($_REQUEST['month'])){
    $json['status']='ok';
    $date = sqi($_REQUEST['month']);
    $sumCost=getDataMonthly('cost',$date);
    $sumIncome=getDataMonthly('income',$date);
    $json['sumCost']=$sumCost;
    $json['sumIncome']=$sumIncome;
    header("content-Type:application/json; charset=utf-8");
    echo json_encode($json,JSON_UNESCAPED_UNICODE);
}
?>