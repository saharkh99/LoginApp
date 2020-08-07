<?php
@session_start();
define("DB_LOCAL","localhost");
define("DB_NAME","wallet");
define("DB_USER","root");
define("DB_PASS","");
include_once("jdf.php");
function db_connect(){
    $link =@mysqli_connect(DB_LOCAL,DB_USER,DB_PASS,DB_NAME) or die(exit('مشکلی در برقراری ارتباط با دیتابیس به وجود امده است!!!'));
    if($link){
        // echo "true";
        mysqli_query($link , "SET NAME UTF8");
        mysqli_query($link  , "SET CHARACTER SET UTF8");
        mysqli_query($link , "SET character_set_connection='utf8'");
        return $link;
       // echo "connect";
    }
    else{
        // echo "error";
       return false;
    }
}
function getrecord($tblname,$limit=50,$where = 1){
    $link = db_connect();
    $tblname = sqi($tblname);
    $query = "SELECT * FROM $tblname WHERE $where order by id desc limit 0, $limit ";
    //echo $query;
    $r = mysqli_query($link,$query);
    if($r){

        $res = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($r)){
            $res[$i] = $row;
            $i++;
        }
      //  echo $r;
       return $res;
    }
    else{
        echo mysqli_error($query);
        //return false;
    }
}
function runsql($query){
    $link = db_connect();
    $r = mysqli_query($link,$query);
    if($r){

        $res = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($r)){
            $res[$i] = $row;
            $i++;
        }
        return $res;
    }
    else{
        echo mysqli_error($link);
        //return false;
    }
}
function sqi($value){
    $link = db_connect();
    if(get_magic_quotes_gpc()){
        $value = stripcslashes($value);
    }
    if(function_exists("mysqli_real_escape_string")){
        $value = mysqli_real_escape_string($link,$value);
    }
    else{
        $value = addcslashes($value);
    }
    return $value;
}
function addrecord($tblname,$values=NULL){
    $link    = db_connect();
    $tblname = sqi($tblname);
    if(is_array($values)){
        $key   = array_keys($values);
        $value = array_values($values);
        $i = 0;
        foreach($value as $row){
            $value[$i] = "'".sqi($row)."'";
            $i++;
        }
        $key = implode(',',$key);
        $value = implode(',',$value);
        $query = "INSERT INTO $tblname ($key) VALUES ($value)";
        $r = mysqli_query($link,$query);
        if($r){
            echo "true";
            return true;
        }
        else{
            mysqli_error($link);
            echo "false";
           // return false;
        }

    }
    else{
        echo "Error";
        return false;
    }
}

function updaterecord($tblname,$values,$where){
    $link    = db_connect();
    $tblname = sqi($tblname);
    if(is_array($values)){
        $key   = array_keys($values);
        $value = array_values($values);
        $i = 0;
        foreach ($value as $row) {
            $value[$i] = "`$key[$i]`='" .sqi($row)."'";
            $i++;
        }
        $value = implode(',',$value);
        $query ="UPDATE `$tblname` SET $value WHERE $where";
        //echo $query;
        $r = mysqli_query($link,$query);
        if($r){
            //echo "update true";
            return true;
        }
        else{
            //echo mysqli_error($link);
            return false;
        }
    }
    else{
        //echo "Error";
        return false;
    }
}
function delete_record($tblname,$where){
    $link    = db_connect();
    $tblname = sqi($tblname);
    $query = "DELETE FROM `$tblname` WHERE $where";
    $r = mysqli_query($link,$query);
    if($r){
        return true;
    }
    else{
        //echo mysqli_error($link);
        return false;
    }
}

function errorjson($error = 'error'){
    $json = array();
    $json['status'] = 'error';
    $json['error'] = $error;
    header("content-Type:application/json; charset=utf-8");
    echo json_encode($json,JSON_UNESCAPED_UNICODE);
    exit();
}


?>


