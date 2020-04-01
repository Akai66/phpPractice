<?php

/**
 * 题目描述：不修改数组找出重复的数字
 * 在一个长度为n+1的数组里，所有数字都在1~n范围内，所以数组中至少有一个数字是重复的，请找出数组中任意一个重复的数字，但不能修改输入的数组
 * 使用二分法
 */

function duplicate2($arr){
    $arrLen = count($arr);
    if($arrLen <= 1){
        echo "参数错误:数组长度必须大于1\n";
        return -1;
    }
    foreach ($arr as $v){
        if($v < 1 || $v > $arrLen -1){
            echo "参数错误:元素必须在1~n范围内\n";
            return -1;
        }
    }
    $low = 1;
    $high = $arrLen -1;
    while($low <= $high){
        $mid = floor(($low+$high)/2);
        $count = countRange($arr,$low,$mid);
        if($low == $high){
            if($count > 1){
                return $low;
            }else{
                break;
            }
        }
        if($count > $mid-$low+1){
            $high = $mid;
        }else{
            $low = $mid+1;
        }
    }
    return -1;
}

function countRange($arr,$low,$mid){
    $count = 0;
    foreach ($arr as $v){
        if($v >= $low && $v <= $mid){
            $count++;
        }
    }
    return $count;
}

$arr = [1,2,3,3,2];
var_dump(duplicate2($arr));
