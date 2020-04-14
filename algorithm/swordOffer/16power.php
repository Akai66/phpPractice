<?php
/**
 * 实现pow(base,exp)函数,求base的exp次方,exp为整数(负数,0,正数),不考虑大数问题
 */

function power($base,$exp){
    if($base == 0 && $exp < 0){
        throw new Exception('参数错误');
    }
    $absExp = $exp;
    if($exp < 0){
        $absExp = abs($exp);
    }
    $result = powerCore2($base,$absExp);
    if($exp < 0){
        $result = 1/$result;
    }
    return $result;
}

//基础版,遍历求解,细节:位运算比*,/,%效率高
function powerCore1($base,$exp){
    $result = 1;
    for($i=1;$i<=$exp;$i++){
        $result *= $base;
    }
    return $result;
}

//升级版,递归,减少遍历次数
function powerCore2($base,$exp){
    if($exp == 0){
        return 1;
    }
    if($exp == 1){
        return $base;
    }
    $result = powerCore2($base,$exp>>1);
    $result *= $result;
    //当exp为奇数时,需要多乘以一次base
    if($exp & 1){
        $result *= $base;
    }
    return $result;
}

var_dump(power(2,2));
var_dump(power(2,-2));
var_dump(power(2,0));
var_dump(power(-2,0));
var_dump(power(-2,2));
var_dump(power(-2,-3));
//var_dump(power(0,-3));
