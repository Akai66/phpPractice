<?php
/**
 * 题目描述:
 * 输入一个整数数组,实现一个函数来调整该数组中数字的顺序,使得所有奇数位于数组的前半部分,所有偶数位于数组的后半部分
 */

function reOrder(&$arr,$func){
    if(empty($arr)){
        throw new Exception('数组为空');
    }
    $low = 0;
    $high = count($arr)-1;
    while($low < $high){
        while($low < $high && !$func($arr[$low])){
            $low++;
        }
        while ($low < $high && $func($arr[$high])){
            $high--;
        }
        //当$low为偶数,$high为奇数,且$low<$high时,交换数字
        if($low < $high){
            $temp = $arr[$low];
            $arr[$low] = $arr[$high];
            $arr[$high] = $temp;
        }
    }
}

function isEven($number){
    return ($number & 1) == 0;
}

$arr = [1,2,3,4,5,6];
reOrder($arr,'isEven');
echo json_encode($arr);
//可以扩展为负数在前,正数在后
function isPositive($number){
    return $number >=0;
}
$arr = [1,-1,2,-2,3,-4];
reOrder($arr,'isPositive');
echo json_encode($arr);

//可以扩展为不能被3整除的在前,能被3整除的在后
function isDivide3($number){
 return $number % 3 == 0;
}
$arr = [1,3,6,9,2,4];
reOrder($arr,'isDivide3');
echo json_encode($arr);