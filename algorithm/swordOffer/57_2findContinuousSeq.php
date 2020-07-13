<?php

/**
 * 题目描述:和为s的连续正数序列
 * 输入一个正数s,打印出所有和为s的连续正数序列(至少含有两个数)
 * 例如输入15,由于1+2+3+4+5=4+5+6=7+8=15,所以打印出3个连续序列1~5,4~6,7~8
 */

function findContinuousSeq($s){
    if($s<=0){
        return;
    }

    $min = 1;
    $max = 2;
    $mid = ($s+1)>>1;
    $total = $min+$max;
    while($min < $mid){
        if($total == $s){
            printContinuousSeq($min,$max);
        }
        //小技巧:避免每次循环计算min~max的和
        while($total>$s && $min<$mid){
            $total -= $min;
            $min++;
            if($total == $s){
                printContinuousSeq($min,$max);
            }
        }
        $max++;
        $total+=$max;
    }
}

function printContinuousSeq($min,$max){
    for($i=$min;$i<=$max;$i++){
        echo $i . ' ';
    }
    echo "\n";
}

findContinuousSeq(15);
