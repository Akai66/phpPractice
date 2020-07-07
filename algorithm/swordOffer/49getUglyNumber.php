<?php

/**
 * 我们把只包含因子2,3或5的数称作丑数,求从小到大的顺序的第1500个丑数
 * 例如:6和8是丑数,但14不是,因为它包含因子7,习惯上我们把1当做第一个丑数
 */


//方法一:采用循环依次判断

function getUglyNumber1($index){
    if($index <= 0){
        return 0;
    }
    $uglyCount = 0;
    $number = 0;
    while($uglyCount < $index){
        $number++;
        if(isUgly($number)){
            $uglyCount++;
        }
    }
    return $number;
}

function isUgly($number){
    while($number%2 == 0){
        $number = $number/2;
    }
    while($number%3 == 0){
        $number = $number/3;
    }
    while($number%5 == 0){
        $number = $number/5;
    }
    return $number == 1;
}

//方法二:每次只计算丑数

function getUglyNumber2($index){
    if($index <= 0){
        return 0;
    }
    $uglyNumbers = array(1);
    $nextUglyIndex = 1;
    $pIndex2 = $pIndex3 = $pIndex5 = 0;
    while($nextUglyIndex < $index){
        $uglyNumbers[$nextUglyIndex] = min($uglyNumbers[$pIndex2]*2,$uglyNumbers[$pIndex3]*3,$uglyNumbers[$pIndex5]*5);
        while($uglyNumbers[$pIndex2]*2 <= $uglyNumbers[$nextUglyIndex]){
            $pIndex2++;
        }
        while($uglyNumbers[$pIndex3]*3 <= $uglyNumbers[$nextUglyIndex]){
            $pIndex3++;
        }
        while($uglyNumbers[$pIndex5]*5 <= $uglyNumbers[$nextUglyIndex]){
            $pIndex5++;
        }
        $nextUglyIndex++;
    }
    return $uglyNumbers[$nextUglyIndex-1];
}


var_dump(getUglyNumber1(100));
var_dump(getUglyNumber2(100));

