<?php

/**
 * 题目描述:给定一个数字,按照以下规则翻译为字符串,0翻译成'a',1翻译成'b',......25翻译成'z'
 * 一个数字可能有多种翻译,比如:12258有5中不同的翻译,'bccfi','bwfi','bczi','mcfi','mzi',实现一个函数,计算一个数字有多少种翻译的方法
 */

//方法一:使用递归,递归存在重复子问题,效率不高
function getTranslationCount1($number){
    if($number < 0){
        throw new Exception('参数错误');
    }
    $numberStr = strval($number);
    return getCountCore($numberStr,0);
}

function getCountCore($number,$index){
    $length = strlen($number);
    if($index >= $length-1){
        //>$length-1时也返回1,因为刚好=$length时,也需要计算一次,说明最后两位数组合在一起被翻译
        return 1;
    }
    $digit1 = ord($number[$index])-ord('0');
    $digit2 = ord($number[$index+1])-ord('0');
    $digit = $digit1*10 + $digit2;
    if($digit >= 10 && $digit <=25){
        return getCountCore($number,$index+1) + getCountCore($number,$index+2);
    }
    return getCountCore($number,$index+1);
}

//方法二:递归最大的问题是开始自上而下解决问题,会存在重复子问题的情况,采用从最小子问题开始自下而上解决问题,这样可以消除重复子问题,也就是我们从数字的末尾开始,从右到左翻译并计算不同翻译的数目
function getTranslationCount2($number){
    if($number < 0){
        throw new Exception('参数错误');
    }
    $numberStr = strval($number);
    $length = strlen($number);
    $counts = array();
    for($i=$length-1;$i>=0;$i--){
        if($i<$length-1){
            $count = $counts[$i+1];
            $digit1 = ord($numberStr[$i])-ord('0');
            $digit2 = ord($numberStr[$i+1])-ord('0');
            $digit = $digit1*10+$digit2;
            if($digit >=10 && $digit <=25){
                if($i<$length-2){
                    $count += $counts[$i+2];
                }else{
                    $count += 1;
                }
            }
        }else{
            $count = 1;
        }
        $counts[$i] = $count;
    }
    return $counts[0];
}


var_dump(getTranslationCount1(12258121));
var_dump(getTranslationCount2(12258121));