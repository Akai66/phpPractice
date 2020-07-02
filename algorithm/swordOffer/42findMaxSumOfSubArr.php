<?php
/**
 * 输入一个整数数组,数组里有正数和负数,数组中一个或连续多个整数组成一个子数组,求所有子数组的和的最大值,要求时间负责度O(n)
 */

function findMaxSumOfSubArr($arr){
    if(empty($arr)){
        throw new Exception('参数错误');
    }

    $curSum = $maxSum = $arr[0];
    for($i=1;$i<count($arr);$i++){
        if($curSum <= 0){
            $curSum = $arr[$i];
        }else{
            $curSum += $arr[$i];
        }
        if($curSum > $maxSum){
            $maxSum = $curSum;
        }
    }
    return $maxSum;
}

$arr = [1,-2,3,10,-4,7,2,-5];
var_dump(findMaxSumOfSubArr($arr));