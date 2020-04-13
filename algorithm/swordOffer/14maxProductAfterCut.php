<?php

/*
 * 给你一根长度为n的绳子,请把绳子剪成m段(m,n都是整数,且m>1,n>1),求剪后每段绳子长度乘积的最大值
 * 例如长度为8,剪成2,3,3后,最大乘积为18
 */

//利用动态规划,动态规划问题的特点:
//1.求一个问题的最优解
//2.整体问题的最优解依赖各个子问题的最优解
//3.把大问题分解成若干个小问题后,这些小问题之间还有相互重叠的更小的子问题


function maxProductAfterCut($len){
    if($len < 2){
        return 0;
    }
    if($len == 2){
        return 1;
    }
    if($len == 3){
        return 2;
    }
    $product = array();
    $product[1] = 1;
    $product[2] = 2;
    $product[3] = 3;
    //从4开始,所以前三个元素本身作为乘数
    for($i=4;$i<=$len;$i++){
        $max = 0;
        for($j=1;$j<=floor($i/2);$j++){
            $max = $product[$j]*$product[$i-$j] > $max ? $product[$j]*$product[$i-$j] : $max;
        }
        $product[$i] = $max;
    }
    return $product[$len];
}

var_dump(maxProductAfterCut(10));