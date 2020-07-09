<?php

/**
 * 题目描述:数组中数值和下标相等的元素
 * 假设一个单调递增的数组中每个元素都是整数且是唯一的,请实现一个函数,找出任意一个数值等于其下标的元素
 */


//思路一:遍历数组,时间复杂度O(N)

//思路二:二分查找,时间复杂度O(logN)

function getNumberSameAsIndex($arr){
    if(empty($arr)){
        return -1;
    }
    $length = count($arr);
    $start = 0;
    $end = $length-1;
    while($start<=$end){
        $mid = ($start+$end) >> 1;
        if($arr[$mid] == $mid){
            return $mid;
        }elseif($arr[$mid] > $mid){
            //说明mid右边元素都比其对应的下标大,目标元素在mid的左边
            $end = $mid-1;
        }else{
            $start = $start+1;
        }
    }
    return -1;
}

$arr = [-3,-1,1,2,4];
var_dump(getNumberSameAsIndex($arr));