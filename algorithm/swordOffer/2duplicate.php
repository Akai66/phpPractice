<?php

/**
 * 题目描述:找出数组中的重复数字
 * 在一个长度为n的数组里的所有数字都在0~n-1的范围内，数组中某些数字是重复的，找出数组中任意一个重复的数字
 */

function duplicate($arr){
    if(empty($arr)){
        echo "参数错误:数组不能为空\n";
        return -1;
    }
    $arrLen = count($arr);
    foreach ($arr as $v){
        if($v < 0 || $v > $arrLen-1){
            echo "参数错误:元素必须在0~n-1范围内\n";
            return -1;
        }
    }
    for($i=0;$i<$arrLen;$i++){
        while ($i != $arr[$i]){
            if($arr[$arr[$i]] == $arr[$i]){
                return $arr[$i];
            }else{
                //交换数字到指定位置,如:将数字2交换到下标为2的位置
                $temp = $arr[$i];
                $arr[$i] = $arr[$temp];
                $arr[$temp] = $temp;
            }
        }
    }
    return -1;
}

$arr = [1,2,4,0,2];
var_dump(duplicate($arr));