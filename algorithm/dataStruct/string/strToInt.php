<?php
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/2/20
 * Time: 17:56
 */

/*
 * 1.校验参数是否为空,是否为'+'或'-'
 * 2.正负数处理
 * 3.字符是否合法,在'0'到'9'之间
 * 4.整数是否溢出,当整数溢出时,php会自动将变量类型从integer转换为double,所以可以通过判断变量类型,判断整数是否溢出
 * 5.对于返回值为0,区分正常的整数0和异常返回0的情况
 */

$valid = false;
function strToInt($str,&$valid){
    $result = 0;
    //判断参数
    $len = strlen($str);
    if($len < 1 || in_array($str,array('+','-'))){
        echo "params error\n";
        return 0;
    }
    $isPositive = 1;
    if($str[0] == '-'){
        $isPositive = -1;
    }
    for($i=0;$i<$len;$i++){
        if($i == 0 && in_array($str[$i],array('+','-'))){
            continue;
        }
        if(ord($str[$i]) > ord('9') || ord($str[$i]) < ord('0')){
            return 0;
        }
        $result = $result*10 + $isPositive * (ord($str[$i]) - ord('0'));
        if(gettype($result) != 'integer'){
            //溢出
            echo "over flow\n";
            return 0;
        }
    }
    $valid = true;
    return $result;
}

$str = "-2939392929202920828";
var_dump(strToInt($str,$valid),$valid);


