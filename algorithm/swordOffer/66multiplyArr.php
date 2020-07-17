<?php

/**
 * 题目描述:给定一个数组A[0,1,...n-1],请构建一个数组B[0,1,...n-1],其中B[i]=A[0]*A[1]*...A[i-1]*A[i+1]*...*A[n-1]
 * 不能使用除法
 */

//思路一:双重循环,时间复杂度为O(n^2)

//思路二:将B[i]分成两部分C和D,C[i]=A[0]*A[1]*...A[i-1]=C[i-1]*A[i-1] D[i]=A[i+1]*A[i+2]...*A[n-1]=D[i+1]*A[i+1]

function multiplyArr($arr){
    if(empty($arr)){
        throw new Exception('参数错误');
    }
    $length = count($arr);
    $resultArr = array();
    $resultArr[0] = 1;
    //先计算C的部分
    for($i=1;$i<$length;$i++){
        $resultArr[$i] = $resultArr[$i-1]*$arr[$i-1];
    }
    //再计算D的部分
    $temp =1;
    for($i=$length-2;$i>=0;$i--){
        $temp *= $arr[$i+1];
        $resultArr[$i] *= $temp;
    }
    return $resultArr;
}

$arr = [-1,2,0,1];
var_dump(multiplyArr($arr));