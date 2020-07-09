<?php

/**
 * 题目描述:获取数字在排序数组中出现的次数
 */

//最高效率解法,时间复杂度O(logN)
function getNumberOfK($arr,$k){
    $result = 0;
    if(!empty($arr)){
        $length = count($arr);
        $first = getFirstK($arr,$k,0,$length-1);
        $last = getLastK($arr,$length,$k,0,$length-1);
        if($first != -1 && $last != -1){
            $result = $last-$first+1;
        }
    }
    return $result;
}

function getFirstK($arr,$k,$start,$end){
    if($start > $end){
        return -1;
    }
    $mid = ($start+$end) >> 1;
    if($arr[$mid] == $k){
        if(($mid > 0 && $arr[$mid-1] != $k) || $mid == 0){
            return $mid;
        }else{
            //说明第一个k在mid的左边
            $end = $mid-1;
        }
    }elseif($arr[$mid] > $k){
        //说明k在mid的左边
        $end = $mid-1;
    }else{
        //说明k在mid的右边
        $start = $mid+1;
    }
    return getFirstK($arr,$k,$start,$end);
}

function getLastK($arr,$length,$k,$start,$end){
    if($start > $end){
        return -1;
    }
    $mid = ($start+$end) >> 1;
    if($arr[$mid] == $k){
        if(($mid < $length-1 && $arr[$mid+1] != $k) || $mid == $length-1){
            return $mid;
        }else{
            //说明最后一个k在mid的右边
            $start = $mid+1;
        }
    }elseif($arr[$mid] > $k){
        //说明k在mid的左边
        $end = $mid-1;
    }else{
        //说明k在mid右边
        $start = $mid+1;
    }
    return getLastK($arr,$length,$k,$start,$end);
}

$arr = [1,2,3,3,3,3,4,5];
var_dump(getNumberOfK($arr,3));
