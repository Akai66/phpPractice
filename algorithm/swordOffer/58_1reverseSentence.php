<?php

/**
 * 题目描述:翻转单词顺序
 * 输入一个英文句子,翻转句子中单词的顺序,但单词内字符的顺序不变,为简单起见,标点符号和普通字母一样处理
 * 例如输入字符串"I am a student.",输出"student. a am I"
 */

function reverseSentence($str){
    if(empty($str)){
        return;
    }
    $length = strlen($str);
    //先将整个字符串翻转
    reverse($str,0,$length-1);
    //然后再依次翻转字符串内部的单词
    $start = 0;
    $end = 0;
    while($start<$length){
        if($str[$start] == ' '){
            $start++;
            $end++;
        }elseif($end == $length || $str[$end] == ' '){
            reverse($str,$start,$end-1);
            $start = $end;
        }else{
            $end++;
        }
    }
    return $str;
}


function reverse(&$str,$start,$end){
    if(empty($str) || $start < 0 || $end >= strlen($str)){
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

$str = 'I am a student, thanks.';
var_dump(reverseSentence($str));