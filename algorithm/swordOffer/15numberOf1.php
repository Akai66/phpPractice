<?php
/**
 * 二进制中1的个数
 */

//利用flag=1,不断左移flag,和n进行&操作,根据结果判断该位是否为1
function numberOf1($num){
    if(!is_integer($num)){
        throw new Exception('参数错误');
    }
    $flag = 1;
    $count = 0;
    while($flag){
        if($num & $flag){
            $count++;
        }
        $flag <<= 1;
    }
    return $count;
}

//升级版,巧用n & n-1 会将最左边的1变为0,比如:1100减一后为1011,1100 & 1011 = 1000,这样可以减少遍历的次数,有几个1遍历几次
function numberOf1Up($num){
    if(!is_integer($num)){
        throw new Exception('参数错误');
    }
    $count = 0;
    while($num){
        $count++;
        $num = $num & ($num-1);
    }
    return $count;
}

var_dump(numberOf1(7));
var_dump(numberOf1Up(7));