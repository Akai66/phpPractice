<?php

function isNumeric($str){
    if(empty($str)){
        throw new Exception("参数错误");
    }
    $index = 0;
    $strLen = strlen($str);
    $numeric = scanInteger($str,$index,$strLen);
    if($index != $strLen && $str[$index] == '.'){
        $index++;
        $numeric = scanUnsignedInteger($str,$index,$strLen) || $numeric;
    }
    if($index != $strLen && in_array($str[$index],array('e','E'))){
        $index++;
        $numeric = $numeric && scanInteger($str,$index,$strLen);
    }
    return $numeric && $index == $strLen;
}

function scanInteger($str,&$index,$strLen){
    if(in_array($str[$index],array('+','-'))){
        $index++;
    }
    return scanUnsignedInteger($str,$index,$strLen);
}

function scanUnsignedInteger($str,&$index,$strLen){
    $basic = $index;
    while($index < $strLen && $str[$index] >= '0' && $str[$index] <= '9'){
        $index++;
    }
    return $index > $basic;
}

var_dump(isNumeric('1.E+10'));
var_dump(isNumeric('.12E+10'));
var_dump(isNumeric('1.3E-2'));
var_dump(isNumeric('1.3E-2.1'));
var_dump(isNumeric('1'));