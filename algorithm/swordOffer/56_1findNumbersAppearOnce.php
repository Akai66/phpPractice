<?php

/**
 * 题目描述:数组中只出现了一次的两个数字
 * 一个整型数组中,除了两个数字外,其它数字都出现了两次,请实现一个函数找出这两个只出现了一次的数字
 * 要求时间复杂度O(n),空间复杂度O(1)
 */

//异或:相同为0,不同为1

function findNumbersAppearOnce($arr,&$num1,&$num2){
    $length = count($arr);
    if($length < 2){
        return;
    }
    //先将所有数字进行异或处理,相同的数字异或结果为0,所以最终得到的结果为两个只出现一次的数字的异或值
    $resultExclusiveOr = 0;
    for($i=0;$i<$length;$i++){
        $resultExclusiveOr ^= $arr[$i];
    }
    //获取异或结果中第一个为1的位数,说明该位两个只出现一次的数字是不同的
    //然后将该位为1和0的拆分为两个子数组,这样就能保证将两个只出现一次的数字分开到两个子数组中
    //最后再分别对两个子数组进行异或操作,得到的结果就是两个只出现了一次的数字
    $index = findFirstBitIs1($resultExclusiveOr);
    for($j=0;$j<$length;$j++){
        if(isBit1($arr[$j],$index)){
            $num1 ^= $arr[$j];
        }else{
            $num2 ^= $arr[$j];
        }
    }
}

function findFirstBitIs1($result){
    $index = 0;
    while(($result & 1) == 0){
        $index++;
        $result >>= 1;
    }
    return $index;
}

function isBit1($num,$index){
    return ($num >> $index) & 1;
}

$arr = [1,2,3,5,2,1,4,5,3,6];
findNumbersAppearOnce($arr,$num1,$num2);
var_dump($num1,$num2);