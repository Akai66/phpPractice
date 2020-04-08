<?php

/**
 * 把一个数组最开始的若干个元素搬到数组的末尾,我们称之为数组的旋转.
 * 输入一个递增排序的数组的一个旋转,输出旋转数组的最小元素
 * 例如:数组[3,4,5,1,2]为[1,2,3,4,5]的一个旋转,该数组的最小元素为1
 *
 * 采用二分法,时间复杂度O(logn)
 */



function spinMin($arr){
    if(empty($arr)){
        throw new Exception("参数错误");
    }
    $low = 0;
    $high = count($arr)-1;
    $index = $low;
    while($arr[$low]>=$arr[$high]){
        if($high-$low == 1){
            $index = $high;
            break;
        }
        $mid = floor(($low+$high)/2);
        //有一种情况比较特殊,比如:[1,0,1,1,1]和[1,1,1,0,1]都是[0,1,1,1,1]的旋转数组,所以需要考虑$arr[mid]==$arr[$low]==$arr[high]的情况,遇到这种情况只能遍历寻找最小元素
        if($arr[$mid] == $arr[$high] && $arr[$mid] == $arr[$high]){
            $index = findMinIndex($arr,$low,$high);
            break;
        }
        if($arr[$mid]>=$arr[$low]){
            //说明最小元素在mid的右边
            $low = $mid;
        }elseif($arr[$mid]<=$arr[$high]){
            //说明最小元素在mid的左边
            $high = $mid;
        }
    }
    return $arr[$index];
}

function findMinIndex($arr,$low,$high){
    if(empty($arr)){
        throw new Exception("参数错误");
    }
    $index = $low;
    for($i=$low+1;$i<=$high;$i++){
        $index = $arr[$i]<$arr[$index] ? $i : $index;
    }
    return $index;
}

$arr = [3,4,5,1,2];
var_dump(spinMin($arr));
$arr = [1,0,1,1,1];
var_dump(spinMin($arr));
$arr = [1,1,1,0,1];
var_dump(spinMin($arr));
