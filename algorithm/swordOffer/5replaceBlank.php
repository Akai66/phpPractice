<?php

/**
 * 题目描述:将字符串中的空格替换为%20
 * 从前往后替换,涉及元素的移动,时间负责度为O(n2),从后往前替换,时间复杂度为
 */

function replaceBlank(&$str){ 
    if(empty($str)){
        echo "参数错误:字符串不能为空";
        return;
    }
    $oriLastIndex = strlen($str) -1;
    $finLastIndex = $oriLastIndex;
    $blankCount = 0;
    for($i=0;$i<=$oriLastIndex;$i++){
        if($str[$i] == ' '){
            $blankCount++;
        }
    }
    $finLastIndex += $blankCount*2;
    while($oriLastIndex >= 0 && $finLastIndex > $oriLastIndex){
        if($str[$oriLastIndex] == ' '){
            $str[$finLastIndex--] = '0';
            $str[$finLastIndex--] = '2';
            $str[$finLastIndex--] = '%';
        }else{
            $str[$finLastIndex--] = $str[$oriLastIndex];
        }
        $oriLastIndex--;
    }
}

$str = " ";

replaceBlank($str);

var_dump($str);