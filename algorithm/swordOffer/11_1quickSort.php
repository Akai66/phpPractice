<?php

/**
 * 快速排序
 */

function quickSort(&$arr,$start,$end){
    $arrLen = count($arr);
    if($arrLen <= 0 || $start < 0 || $end < $start || $end >= $arrLen){
        throw new Exception("参数错误");
    }
    if($start == $end){
        return;
    }
    //分边,将大于某个数字的元素放在该数字的右边,将小于某个数字的元素放在该数字的左边,返回该数字的索引
    $index = partition($arr,$start,$end);
    if($index > $start){
        quickSort($arr,$start,$index-1);
    }
    if($index < $end){
        quickSort($arr,$index+1,$end);
    }
}

function partition(&$arr,$start,$end){
    $arrLen = count($arr);
    if($arrLen <= 0 || $start < 0 || $end < $start || $end >= $arrLen){
        throw new Exception("参数错误");
    }
    //先随机出一个数字,和下标为end的数字进行交换
    $index = rand($start,$end);
    swap($arr,$index,$end);
    $small = $start-1;
    for($i=$start;$i<$end;$i++){
        if($arr[$i]<$arr[$end]){
            $small++;
            if($small != $i){
                swap($arr,$small,$i);
            }
        }
    }
    $small++;
    swap($arr,$small,$end);
    return $small;
}

function swap(&$arr,$index,$end){
    $temp = $arr[$index];
    $arr[$index] = $arr[$end];
    $arr[$end] = $temp;
}

$arr=[1,4,3,5,8,7,6,2];
quickSort($arr,0,7);
var_dump($arr);