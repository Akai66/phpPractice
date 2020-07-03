<?php
/**
 * 输入一个整数n,求1~n这n个整数的十进制表示中1出现的次数
 */

function numberOf1Between1AndN($number){
    if(!is_integer($number) || $number <= 0){
        return 0;
    }
    $strNumber = strval($number);
    $result = numberOf1($strNumber);
    return $result;
}

function numberOf1($strNumber){
    $first = intval($strNumber[0]);
    $length = strlen($strNumber);
    if($length == 1 && $first == 0){
        return 0;
    }
    if($length == 1 && $first > 0){
        return 1;
    }
    $strRecursiveNumber = substr($strNumber,1);
    $recursiveNumber = intval($strRecursiveNumber);

    //先计算最高位为1的情况

    if($first > 1){
        $numFirst1 = pow(10,$length-1);
    }else{
        $numFirst1 = $recursiveNumber+1;
    }

    //在计算其它位为1的情况
    $numOther1 = $first * ($length-1) * pow(10,$length-2);

    //递归计算去除最高位的情况
    $numRecursive1 = numberOf1($strRecursiveNumber);
    return $numFirst1+$numOther1+$numRecursive1;
}

var_dump(numberOf1Between1AndN(21345));
var_dump(numberOf1Between1AndN(1345));


