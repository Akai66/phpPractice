<?php

function match($str,$pattern){
    if(empty($str) || empty($pattern)){
        throw new Exception('参数为空');
    }
    return matchCore(0,0,$str,$pattern);
}

function matchCore($strIndex,$patternIndex,$str,$pattern){
    $strLen = strlen($str);
    $patternLen = strlen($pattern);
    if($strIndex == $strLen && $patternIndex == $patternLen){
        return true;
    }
    if($strIndex < $strLen && $patternIndex == $patternLen){
        return false;
    }
    //pattern下一个是*
    if($patternIndex+1 < $patternLen && $pattern[$patternIndex+1] == '*'){
        if($strIndex < $strLen && ($str[$strIndex] == $pattern[$patternIndex] || $pattern[$patternIndex] == '.')){
            //*前面一个匹配上
            //将*按匹配0次,1次,多次计算
            return matchCore($strIndex,$patternIndex+2,$str,$pattern) || matchCore($strIndex+1,$patternIndex+2,$str,$pattern) || matchCore($strIndex+1,$patternIndex,$str,$pattern);
        }else{
            //*前面一个没匹配上,直接将*按匹配0次计算
            return matchCore($strIndex,$patternIndex+2,$str,$pattern);
        }
    }
    //pattern下一个不是*,那当前位置必须要能匹配上
    if($strIndex < $strLen && ($str[$strIndex] == $pattern[$patternIndex] || $pattern[$patternIndex] == '.')){
        return matchCore($strIndex+1,$patternIndex+1,$str,$pattern);
    }
    return false;
}

$str = 'abcda';
$pattern = 'a.*.d.';
var_dump(match($str,$pattern));