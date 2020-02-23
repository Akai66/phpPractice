<?php
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/2/23
 * Time: 16:12
 */

//获取无序数组的中位数,假设数组长度为奇数
//利用二分法,随机取数组中的一个数key,将数组中小于key的数交换到左边,大于key的数交换到右边,判断交换结束后,
//中间的索引div==(n-1)/2,则此时arr[div]为中位数
//div>(n-1)/2,则中位数在div的左边
//div<(n-1)/2,则中位数在div的右边

function findMedian($arr){
    $arrLen = count($arr);
    if($arrLen < 1){
        echo "params invalid";
        return false;
    }
    $low = 0;
    $high = $arrLen - 1;
    $mid = ($arrLen - 1)/2;
    $div = findPart($arr,$low,$high);
    while ($div != $mid){
        if($mid > $div){
            //中位数在右边
            $div = findPart($arr,$div+1,$high);
        }else{
            //中位数在左边
            $div = findPart($arr,$low,$div-1);
        }
    }
    return $arr[$mid];
}

function findPart(&$arr,$low,$high){
    $end = $high;
    $key = $arr[$end];
    while ($low < $high){
        while ($low < $high && $arr[$low] <= $key){
            $low++;
        }
        while ($low < $high && $arr[$high] >= $key){
            $high--;
        }
        if($low < $high){
            swap($arr,$low,$high);
        }
    }
    swap($arr,$high,$end);
    return $high;
}

function swap(&$arr,$i,$j){
    $temp = $arr[$j];
    $arr[$j] = $arr[$i];
    $arr[$i] = $temp;
}

$arr = array(3,2,5,9,0,8,7,12,10);
var_dump(findMedian($arr));