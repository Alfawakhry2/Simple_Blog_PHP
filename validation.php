<?php
function check_empty($value){
    if(empty($value)){
        return "Please Fill The Input";
    }else{
        return false;
    }
}
function check_string($value){
    if(preg_match("/[0-9!@#$%^&*()]/",$value)){
        return "Please enter string type only";
    }else{
        return false;
    }
}

function check_email($value){
    if(!filter_var($value , FILTER_VALIDATE_EMAIL)){
        return "invalid Email try as 'example@xyz.com'";
    }else{
        return false ; 
    }
}
?>