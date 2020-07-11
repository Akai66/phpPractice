<?php

/**
 * 题目描述:和为s的两个数字
 * 输入一个递增排序的数组和一个数字s,在数组中查找两个数字,使它们的和为s,如果数组中有多对数字的和为s,输出任意一对即可
 */

//思路一:双指针,时间复杂度为O(n),没有额外空间
function findNumberWithSum1($arr,$s,&$num1,&$num2){
    $found = false;
    if(empty($arr)){
        return $found;
    }
    $start = 0;
    $end = count($arr)-1;
    while($start < $end){
        $sum = $arr[$start]+$arr[$end];
        if($sum == $s){
            $num1 = $arr[$start];
            $num2 = $arr[$end];
            $found = true;
            break;
        }elseif($sum > $s){
            $end--;
        }else{
            $start++;
        }
    }
    return $found;
}

//思路二:利用hash表,时间复杂度O(n),空间复杂度O(n),适用于未排序的数组
function findNumberWithSum2($arr,$s,&$num1,&$num2){
    $found = false;
    if(empty($arr)){
        return $found;
    }
    $hashTb = array();
    foreach ($arr as $value){
        if(isset($hashTb[$value])){
            $num1 = $hashTb[$value];
            $num2 = $value;
            $found = true;
            break;
        }
        $hashTb[$s-$value] = $value;
    }
    return $found;
}


$arr = [1,2,4,7,11,15];
var_dump(findNumberWithSum1($arr,19,$num1,$num2),$num1,$num2);
var_dump(findNumberWithSum2($arr,19,$num1,$num2),$num1,$num2);








