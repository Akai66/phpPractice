<?php

/**
 * 题目描述:请从字符串中找出一个最长的不包含重复字符的子字符串
 */

function longestSubstringWithoutDuplication($str){
    if(empty($str)){
        return 0;
    }
    $indexArr = array();
    $curLength = 0;
    $maxLength = 0;
    for($i=0;$i<strlen($str);$i++){
        $preIndex = isset($indexArr[$str[$i]]) ? $indexArr[$str[$i]] : -1;
        if($preIndex < 0 || $i-$preIndex>$curLength){
            $curLength++;
        }else{
            if($curLength > $maxLength){
                $maxLength = $curLength;
            }
            $curLength = $i - $preIndex;
        }
        $indexArr[$str[$i]] = $i;
    }
    if($curLength > $maxLength){
        $maxLength = $curLength;
    }
    return $maxLength;
}

$str = 'arabcacfr';
var_dump(longestSubstringWithoutDuplication($str));
$str = 'abcdeabcabcdef';
var_dump(longestSubstringWithoutDuplication($str));
