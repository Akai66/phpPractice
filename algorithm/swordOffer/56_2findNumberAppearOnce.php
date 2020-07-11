<?php

/**
 * 题目描述:数组中唯一出现一次的数字
 * 在一个数组中除一个数字只出现一次之外,其它数字都出现了三次,请找出那个只出现了一次的数字
 */

//思路一:对数组进行排序,然后遍历排序后的数组,时间复杂度为O(n*logn)


//思路二:利用hash表,遍历数组统计每个数字出现的次数,时间复杂度为O(n),空间复杂度O(n)(因为数组的长度为n)


//思路三:把所有数字二进制每一位的值相加,被3整除则表示目标数字该位为0,否则为1,时间复杂度为O(n),空间复杂度为O(1) 因为64(跟整数的位数有关系)是一个常数
function findNumberAppearOnce($arr){
    if(empty($arr)){
        throw new Exception('参数错误');
    }
    $bitSum = array();
    for($i=0;$i<count($arr);$i++){
        $bitMask = 1;
        for($j=63;$j>=0;$j--){
            $bit = $arr[$i] & $bitMask;
            if(!isset($bitSum[$j])){
               $bitSum[$j] = 0;
            }
            if($bit != 0){
                $bitSum[$j] += 1;
            }
            $bitMask <<= 1;
        }
    }
    $result = 0;
    for($i=0;$i<=63;$i++){
        //一定要先左移,再加,否则可能会产生进位
        $result <<= 1;
        $result += $bitSum[$i]%3;
    }
    return $result;
}

$arr = [-5,2,-3,3,2,-5,-5,2,3,3];
var_dump(findNumberAppearOnce($arr));