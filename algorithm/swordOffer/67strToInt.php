<?php

/**
 * 题目描述:将字符串转换为整型
 */

/*
 * 1.校验参数是否为空,是否为'+'或'-'
 * 2.正负数处理
 * 3.字符是否合法,在'0'到'9'之间
 * 4.整数是否溢出,当整数溢出时,php会自动将变量类型从integer转换为double,所以可以通过判断变量类型,判断整数是否溢出
 * 5.对于返回值为0,区分正常的整数0和异常返回0的情况
 */

function strToInt($str,&$valid){
    if(empty($str) || $str == '+' || $str == '-'){
        $valid = false;
        return 0;
    }
    $result = 0;
    $isPositive = 1;
    if($str[0] == '-'){
        $isPositive = -1;
    }
    for($i=0;$i<strlen($str);$i++){
        if($i == 0 && ($str[$i] == '+' || $str[$i] == '-')){
            continue;
        }
        if(ord($str[$i]) < ord('0') || ord($str[$i]) > ord('9')){
            $result=0;
            $valid=false;
            break;
        }
        $result = $result*10 + $isPositive*(ord($str[$i]) - ord('0'));
        //判断是否溢出
        if(gettype($result) != 'integer'){
            $result=0;
            $valid=false;
            break;
        }
    }

    if($i == strlen($str)){
        $valid = true;
    }
    return $result;
}


$str = '-12345';
var_dump(strToInt($str,$valid),$valid);
