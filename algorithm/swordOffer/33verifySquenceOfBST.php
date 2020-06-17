<?php

/**
 * 输入一个整数数组,判断该数组是否为某二叉搜索树的后序遍历结果,假设数组中没有重复的数字
 */

function verifySquenceOfBST($arr,$length){
    if(empty($arr) || $length <= 0 ){
        return false;
    }
    $root = $arr[$length-1];
    for($i=0;$i<$length-1;$i++){
        if($arr[$i] > $root){
            break;
        }
    }
    for($j=$i;$j<$length-1;$j++){
        if($arr[$j] < $root){
            return false;
        }
    }
    //递归判断左子树和右子树
    $left = true;
    if($i>0){
        $left = verifySquenceOfBST($arr,$i);
    }
    $right = true;
    if($i<$length-1){
        $right = verifySquenceOfBST(array_slice($arr,$i,$length-1-$i),$length-1-$i);
    }
    return $left && $right;
}

$arr = [5,7,6,9,11,10,8];
var_dump(verifySquenceOfBST($arr,7));
$arr = [7,4,6,5];
var_dump(verifySquenceOfBST($arr,4));
