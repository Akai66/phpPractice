<?php

/**
 * 题目描述:数字以01234567891011121314.....的格式序列化到一个字符序列中,在这个序列中第5位是5(从0开始计算),第13位是1
 * 请写一个函数,求任意第n位对应的数字
 */

function digitAtIndex($index){
    if($index < 0){
        return -1;
    }
    $digit = 1;
    while(true){
        $numbers = countOfDigits($digit);
        if($index < $digit*$numbers){
            return digitAtIndexCore($digit,$index);
        }else{
            $index -= $digit*$numbers;
        }
        $digit++;
    }
}

function countOfDigits($digit){
    if($digit == 1){
        return 10;
    }
    return 9*pow(10,$digit-1);
}

function digitAtIndexCore($digit,$index){
    $number = beginNumber($digit) + floor($index/$digit);
    $indexFromRight = $digit - $index%$digit;
    for($i=1;$i<$indexFromRight;$i++){
        $number = floor($number/10);
    }
    return $number%10;
}

function beginNumber($digit){
    if($digit == 1){
        return 0;
    }
    return pow(10,$digit-1);
}

var_dump(digitAtIndex(1001));