<?php

/**
 * 题目描述:左旋转字符串
 * 字符串的左旋转操作是把字符串前面的若干个字符转移到字符串的尾部
 * 例如输入字符串abcdefg和2,返回左旋转2位的结果cdefgab
 */


function leftRotateStr($str,$n){
    $length = strlen($str);
    if(empty($str) || $n <= 0 || $n >= $length){
        return $str;
    }
    $start = 0;
    reverse($str,$start,$n-1);
    reverse($str,$n,$length-1);
    reverse($str,$start,$length-1);
    return $str;
}

function reverse(&$str,$start,$end){
    $length = strlen($str);
    if(empty($str) || $start < 0 || $end >= $length){
        return;
    }
    while($start < $end){
        $temp = $str[$start];
        $str[$start] = $str[$end];
        $str[$end] = $temp;
        $start++;
        $end--;
    }
}

$str = 'abcdefg';
var_dump(leftRotateStr($str,2));