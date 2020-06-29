<?php
/**
 * 题目描述:输入一个数组,数组中存在重复数字,找出其中重复个数超过数组长度一半的数字
 */

//方法一:如果重复数字个数超过数组长度的一半,那么该数字一定是该数组排序后的中位数,转换为求中位数

function moreThanHalfNum1($arr){
    if(empty($arr)){
        throw new Exception('参数错误');
    }
    $length = count($arr);
    $mid = $length >> 1;
    $start = 0;
    $end = $length-1;
    $index = partition($arr,$start,$end);
    while($index != $mid){
        if($index > $mid){
            $index = partition($arr,$start,$index-1);
        }
        if($index < $mid){
            $index = partition($arr,$index+1,$end);
        }
    }
    $number = $arr[$index];
    if(!checkMoreThanHalfNum($arr,$number)){
        throw new Exception('数组不符合要求');
    }
    return $number;
}

function partition(&$arr,$start,$end){
    $index = rand($start,$end);
    $small = $start-1;
    swap($arr,$end,$index);
    for($i=$start;$i<$end;$i++){
        if($arr[$i] < $arr[$end]){
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

function swap(&$arr,$index1,$index2){
    $temp = $arr[$index1];
    $arr[$index1] = $arr[$index2];
    $arr[$index2] = $temp;
}

function checkMoreThanHalfNum($arr,$number){
    $isValid = false;
    if(empty($arr)){
        return $isValid;
    }
    $length = count($arr);
    $count = 0;
    foreach ($arr as $v){
        if($v == $number){
            $count++;
        }
    }
    if(2*$count > $length){
        $isValid = true;
    }
    return $isValid;
}

////方法二
function moreThanHalfNum2($arr){
    if(empty($arr)){
        throw new Exception('参数错误');
    }
    $result = $arr[0];
    $count = 1;
    for($i=1;$i<count($arr);$i++){
        if($count == 0){
            $result = $arr[$i];
            $count = 1;
        }elseif($result == $arr[$i]){
            $count++;
        }else{
            $count--;
        }
    }
    if(!checkMoreThanHalfNum($arr,$result)){
        throw new Exception('数组不符合要求');
    }
    return $result;
}



//方法三:利用hash表
function moreThanHalfNum3($arr){
    if(empty($arr)){
        throw new Exception('参数错误');
    }
    $length = count($arr);
    $counter = array();
    foreach ($arr as $value){
        if(!isset($counter[$value])){
            $counter[$value] = 1;
        }else{
            $counter[$value]++;
        }
        if($counter[$value]*2 > $length){
            return $value;
        }
    }
    throw new Exception('数组不符合要求');
}


$arr = [2,5,2,2,1,2];
var_dump(moreThanHalfNum1($arr));
var_dump(moreThanHalfNum2($arr));
var_dump(moreThanHalfNum3($arr));