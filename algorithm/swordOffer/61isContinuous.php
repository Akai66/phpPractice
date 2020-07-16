<?php

/**
 * 题目描述:扑克牌中的顺子
 * 从扑克牌中随机抽取5张牌,判断是不是一个顺子,即是不是连续的,2~10位数字本身,A为1,J为11,Q为12,K为13,大小王可以看成任意值
 * 如果有重复数字,则不为顺子
 */

function isContinuous($arr){
    if(empty($arr)){
        return false;
    }
    //先进行排序
    sort($arr);
    //统计大小王的个数(将大小王认为是数字0)
    $length = count($arr);
    $zeroCount = 0;
    $gapCount = 0;//间隙的个数
    for($i=0;$i<$length;$i++){
        if($arr[$i] == 0){
            $zeroCount++;
        }
    }
    //统计间隙的个数
    for($i=$zeroCount;$i<$length-1;$i++){
        if($arr[$i] == $arr[$i+1]){
            return false;
        }
        $gapCount += $arr[$i+1]-$arr[$i]-1;
    }
    return $zeroCount >= $gapCount ? true : false;
}

$arr = [0,0,2,3,6];
var_dump(isContinuous($arr));