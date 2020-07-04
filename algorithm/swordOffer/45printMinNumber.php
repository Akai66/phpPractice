<?php

/**
 * 输入一个正整数数组,把数组里所有数字拼接起来排成一个数,打印能拼接出的所有数字中最小的一个
 * 例如:数组[3,32,321],能拼接的最小数字为321323
 */

//思路:定义两个数字m和n,如果mn>nm则表示m>n,mn<nm则表示m<n,mn==nm则m==n
//注意:在拼接m和n时,如果使用整型进行比较,有可能会溢出,由于mn和nm的位数肯定相同,所以可以采用字符串比较

function getMinNumber($arr){
    if(empty($arr)){
        throw new Exception('参数错误');
    }
    usort($arr,function($value1,$value2){
        $str1 = strval($value1);
        $str2 = strval($value2);
        $combineStr1 = $str1 . $str2;
        $combineStr2 = $str2 . $str1;
        return strcmp($combineStr1,$combineStr2);
    });
    return implode('',$arr);
}

$arr = [3,12,321];
var_dump(getMinNumber($arr));