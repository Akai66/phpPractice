<?php

/**
 * 题目描述:在数组中的两个数字,如果前面一个数字大于后面的数字,则这两个数字组成一个逆序对,输入一个数组,求这个数组中逆序对的总数
 * 例如:数组[7,5,6,4] 一共存在5个逆序对,分别是[7,5],[7,6],[7,4],[5,4],[6,4]
 */

function inversePairs($arr){
    if(empty($arr)){
        return 0;
    }
    $copyArr = $arr;
    $result = inversePairsCore($arr,$copyArr,0,count($arr)-1);
    return $result;
}

function inversePairsCore(&$arr,&$copyArr,$start,$end){
    if($start == $end){
        return 0;
    }
    $mid = ($start+$end) >> 1;
    $left = inversePairsCore($copyArr,$arr,$start,$mid);
    $right = inversePairsCore($copyArr,$arr,$mid+1,$end);
    //左边一半的最大值索引
    $i = $mid;
    //右边一半的最大值索引
    $j = $end;
    //归并的起始索引
    $mergeIndex = $end;
    //逆序对数目
    $count = 0;
    while($i>=$start && $j >= $mid+1){
        if($arr[$i] > $arr[$j]){
            $count += $j-$mid;
            $copyArr[$mergeIndex--] = $arr[$i--];
        }else{
            $copyArr[$mergeIndex--] = $arr[$j--];
        }
    }
    while($i>=$start){
        $copyArr[$mergeIndex--] = $arr[$i--];
    }
    while($j>=$mid+1){
        $copyArr[$mergeIndex--] = $arr[$j--];
    }
    return $count+$left+$right;
}


$arr = [7,5,6,4,1,0];
var_dump(inversePairs($arr));


