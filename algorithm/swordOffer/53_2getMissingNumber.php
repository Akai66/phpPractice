<?php
/**
 * 题目描述:0~n-1中缺失的数字,一个长度为n-1的递增排序数组中所有数字都是唯一的,并且数字都在范围0~n-1之内,即在范围0~n-1内的n个数字中有且只有一个数字不在该数组中,请找出这个数字
 */

//思路一:缺失的数字是0~n-1所有数字之和(n*(n-1)/2)减去长度为n-1的数组中所有数字之和,由于要遍历数组求和,时间复杂度为O(n)


//思路二:利用二分查找,由于是排序数组,假设缺失的数字是m,那么m之前的数字和其在数组中的下标一致,m之后的数字和其下标不一致,转化为寻找第一个数字和其下标不一致的下标即为数字m


function getMissingNumber($arr){
    if(empty($arr)){
        throw new Exception('参数错误');
    }
    $length = count($arr);
    $start = 0;
    $end = $length-1;
    while($start <= $end){
        $mid = ($start+$end) >> 1;
        if($arr[$mid] != $mid){
            if($mid == 0 || $arr[$mid-1] == ($mid-1)){
                return $mid;
            }else{
                //说明m在mid的左边
                $end = $mid-1;
            }
        }else{
            //说明m在mid的右边
            $start = $mid+1;
        }
    }
    //注意,如果m为n-1要特殊判断
    if($start == $length){
        return $length;
    }
    return -1;
}

$arr = [0,1,2,3,4];
var_dump(getMissingNumber($arr));

