<?php

/**
 * 题目描述:股票的最大利润
 * 假设把股票的价格按照时间先后顺序存储在数组中,请问买卖该次股票的最大利润是多少?
 * 例如:一只股票在某些时间节点的价格为{9,11,8,5,7,12,16,14},如果我们能在价格为5的时候买入并在价格为16的时候卖出,则能收获最大利润为11
 */

function maxDiff($arr){
    if(empty($arr)){
        throw new Exception('参数错误');
    }
    $min = $arr[0];
    $maxDiff = $arr[1]-$min;
    for($i=2;$i<count($arr);$i++){
        $min = $arr[$i-1] < $min ? $arr[$i-1] : $min;
        $maxDiff = ($arr[$i]-$min)>$maxDiff ? $arr[$i]-$min : $maxDiff;
    }
    return $maxDiff;
}

$arr = [9,11,8,5,7,12,16,14];
var_dump(maxDiff($arr));