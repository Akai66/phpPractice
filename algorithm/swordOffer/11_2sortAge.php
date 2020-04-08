<?php

/**
 * 对公司员工的年龄进行排序,要求时间复杂度是O(n)
 */

function sortAge($arr){
    if(empty($arr)){
        throw new Exception("参数错误");
    }
    $countOfAge = array();
    foreach ($arr as $v){
        if($v < 1 || $v > 99){
            throw new Exception("年龄异常");
        }
        $countOfAge[$v]++;
    }
    $sortArr = array();
    for($i=1;$i<=99;$i++){
        for($j=0;$j<$countOfAge[$i];$j++){
            $sortArr[] = $i;
        }
    }
    return $sortArr;
}

$arr = [1,5,3,2,8,2,4,88,3,10,66,99];
var_dump(sortAge($arr));