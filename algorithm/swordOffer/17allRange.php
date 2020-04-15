<?php
/**
 * 输出数组中元素的全排列
 */

function allRange($arr){
    $count = count($arr);
    if($count <= 0){
        throw new Exception("参数错误");
    }
    $visited = array();
    $result = array();
    for($i=0;$i<$count;$i++){
        $result[0] = $arr[$i];
        $visited[$i] = true;
        allRangeCore($arr,$count,$result,$visited,0);
        unset($visited[$i]);
    }
}

function allRangeCore($arr,$count,&$result,&$visited,$index){
    if($index == $count-1){
        printArr($result);
    }
    for($i=0;$i<$count;$i++){
        if($visited[$i]){
            continue;
        }
        $result[$index+1] = $arr[$i];
        $visited[$i] = true;
        allRangeCore($arr,$count,$result,$visited,$index+1);
        unset($visited[$i]);
    }
}

function printArr($arr){
    foreach ($arr as $v){
        echo $v;
    }
    echo "\t";
}

$arr = ['a','b','c','d'];
allRange($arr);