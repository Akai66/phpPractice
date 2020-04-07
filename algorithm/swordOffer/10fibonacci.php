<?php

/**
 * 求斐波那契数列的第n项
 */

//使用递归实现,每个进程分配的栈空间有限,递归层级太多,容易导致栈溢出
function fibonacci1($n){
    if($n <= 0){
        return 0;
    }
    if($n == 1){
        return 1;
    }
    return fibonacci1($n-1) + fibonacci1($n-2);
}

//推荐使用循环的方式实现
function fibonacci2($n){
    if($n <= 0){
        return 0;
    }
    if($n == 1){
        return 1;
    }
    $num1 = 0;
    $num2 = 1;
    $numN = 0;
    for($i=2;$i<=$n;$i++){
        $numN = $num1+$num2;
        $num1 = $num2;
        $num2 = $numN;
    }
    return $numN;
}

var_dump(fibonacci1(6));
var_dump(fibonacci2(6));