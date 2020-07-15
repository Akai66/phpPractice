<?php
require_once './data/queueNode.php';
/**
 * 题目描述:滑动窗口的最大值
 * 给定一个数组和滑动窗口的大小,请找出所有滑动窗口中的最大值
 * 例如输入数组[2,3,4,2,6,2,5,1]及滑动窗口的大小3,那么一共存在6个滑动窗口,它们的最大值分别为[4,4,6,6,6,5]
 */


function maxInWindow($arr,$size){
    $length = count($arr);
    if(empty($arr) || $size < 1 || $size > $length){
        throw new Exception('参数错误');
    }
    $mq = new queueNode();
    for($i=0;$i<$size;$i++){
        while(!$mq->isEmpty() && $arr[$i]>$arr[$mq->back()]){
            $mq->pop_back();
        }
        $mq->push($i);
    }
    $maxArr = array();
    for($j=$size;$j<$length;$j++){
        $maxArr[] = $arr[$mq->front()];
        while(!$mq->isEmpty() && $arr[$j]>$arr[$mq->back()]){
            $mq->pop_back();
        }
        while(!$mq->isEmpty() && ($j-$mq->front())>=$size){
            $mq->pop();
        }
        $mq->push($j);
    }
    $maxArr[] = $arr[$mq->front()];
    return $maxArr;
}

$arr = [2,3,4,2,6,2,5,1];
var_dump(maxInWindow($arr,3));

