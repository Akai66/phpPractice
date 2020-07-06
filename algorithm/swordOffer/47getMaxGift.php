<?php

/**
 * 题目描述:在一个m*n的棋盘中的每一格都放有一个礼物,每个礼物都有一定的价值(价值>0),你可以每次从棋盘的左上角开始拿格子的礼物
 * 并每次向右或者向下移动一格,直到达到棋盘的右下角,请计算最多能拿到多少价值的礼物
 */

//方法一:递归,递归存在大量重复子问题
function getMaxGift1($arr,$rows,$columns){
    if(empty($arr)){
        throw new Exception('参数错误');
    }
    if($rows <= 0 || $columns <= 0){
        return 0;
    }
    return max(getMaxGift1($arr,$rows-1,$columns),getMaxGift1($arr,$rows,$columns-1)) + $arr[$rows-1][$columns-1];
}

//方法二:循环,不存在重复子问题
function getMaxGift2($arr,$rows,$columns){
    if(empty($arr) || $rows <= 0 || $columns <= 0){
        throw new Exception('参数错误');
    }
    $maxGifts = array();
    for($i=0;$i<$rows;$i++){
        for($j=0;$j<$columns;$j++){
            $up = $left = 0;
            if($i>0){
                $up = $maxGifts[$i-1][$j];
            }
            if($j>0){
                $left = $maxGifts[$i][$j-1];
            }
            if(!isset($maxGifts[$i])){
                $maxGifts[$i] = array();
            }
            $maxGifts[$i][$j] = max($up,$left) + $arr[$i][$j];
        }
    }
    return $maxGifts[$rows-1][$columns-1];
}

//方法三:循环,优化,使用一维数组存放,长度为$columns,每次先从0-j存放上一行,然后替换下一行从0-j的数据
function getMaxGift3($arr,$rows,$columns){
    if(empty($arr) || $rows <= 0 || $columns <= 0){
        throw new Exception('参数错误');
    }
    $maxGifts = array();
    for($i=0;$i<$rows;$i++){
        for($j=0;$j<$columns;$j++){
            $up = $left = 0;
            if($i>0){
                $up = $maxGifts[$j];
            }
            if($j>0){
                $left = $maxGifts[$j-1];
            }
            $maxGifts[$j] = max($up,$left) + $arr[$i][$j];
        }
    }
    return $maxGifts[$columns-1];
}

$arr = [
        [1,10,3,8],
        [12,2,9,6],
        [5,7,4,11,],
        [3,7,16,5],
    ];

var_dump(getMaxGift1($arr,4,4));
var_dump(getMaxGift2($arr,4,4));
var_dump(getMaxGift3($arr,4,4));