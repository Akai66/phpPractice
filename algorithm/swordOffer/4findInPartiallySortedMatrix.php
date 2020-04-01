<?php

/**
 * 题目描述:二维数组中的查找
 * 在一个二维数组中,每一行都按照从左到右递增的顺序排序,每一列都按照从上到下递增的顺序排序,请完成一个函数,输入这样一个二维数组和一个整数,判断数组中是否含有该整数
 *
 */

function find($arr,$target){
    if(empty($arr) || empty($arr[0])){
        echo '参数错误:二维数组不能为空';
    }
    $row = 0;
    $column = count($arr[0]) - 1;
    while($row < count($arr) && $column >= 0){
        if($arr[$row][$column] == $target){
            return true;
        }elseif($arr[$row][$column] > $target){
            $column--;
        }else{
            $row++;
        }
    }
    return false;
}

$arr = array(array(1,2,8,9),array(2,4,9,12),array(4,7,10,13),array(6,8,11,15));
var_dump(find($arr,5));