<?php
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/5
 * Time: 18:11
 */

//将二叉树的每个节点值存储在数组中,索引从1开始
/*
 *        2
 *       / \
 *      4   1
 *     / \
 *    3   8
 */
//映射到数组为:[2,4,1,3,8] ,索引从0开始
//索引为i的节点的左孩子节点的索引为2*i+1,右孩子节点的索引为2*n+2
//节点总数为n,非叶子节点的个数n/2(向下取整),由于索引是从0开始,所以最后一个非叶子节点的索引为n/2(向下取整)-1

function heapSort(&$arr){
    if(empty($arr)){
        return;
    }
    //构造大顶堆
    buildMaxHeap($arr);
    $len = count($arr);
    for($i=$len-1;$i>0;$i--){
        $arr[$i] = $arr[$i] +$arr[0];
        $arr[0] = $arr[$i] - $arr[0];
        $arr[$i] = $arr[$i] - $arr[0];
        $len--;
        heapify($arr,0,$len);
    }
}

function buildMaxHeap(&$arr){
    $len = count($arr);
    for($i=ceil($len/2)-1;$i>=0;$i--){
        heapify($arr,$i,$len);
    }
}


function heapify(&$arr,$i,$len){
    $max = $left = $i*2+1;
    if($left >= $len){
        return;
    }
    $right = $i*2+2;
    if($right<$len && $arr[$right] > $arr[$left]){
        $max = $right;
    }
    if($arr[$max] > $arr[$i]){
        $arr[$max] = $arr[$max] + $arr[$i];
        $arr[$i] = $arr[$max] - $arr[$i];
        $arr[$max] = $arr[$max] - $arr[$i];
        //有交换时,才需要继续调整
        heapify($arr,$max,$len);
    }

}

$arr = array(2,4,1,3,8);
heapSort($arr);
print_r($arr);