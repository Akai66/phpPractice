<?php

/**
 * 题目描述:圆圈中最后剩下的数字
 * 0,1,...n-1 这n个数字排成一个圆圈,从数字0开始,每次从这个圆圈里删除第m个数字,求圆圈中剩下的最后一个数字
 */

//方法一:利用环形链表,用数组实现
function lastRemaining1($n,$m){
    if($n<=0 || $m <= 0){
        throw new Exception('参数错误');
    }
    $arr = array();
    for($i=0;$i<$n;$i++){
        $arr[] = $i;
    }
    $index = 0;
    while(count($arr)>1){
        $value = array_shift($arr);
        $index++;
        if($index%$m != 0){
            array_push($arr,$value);
        }
    }
    return array_shift($arr);
}

//方法二:利用公式f(n,m)=(f(n-1,m)+m)%n
function lastRemaining2($n,$m){
    if($n<=0 || $m<=0){
        throw new Exception('参数错误');
    }
    $last = 0;
    for($i=2;$i<=$n;$i++){
        $last = ($last+$m)%$i;
    }
    return $last;
}



var_dump(lastRemaining1(5,3));
var_dump(lastRemaining2(5,3));