<?php
/**
 * 题目描述:输入一个矩阵,按照从外向里以顺时针的顺序依次打印出每一个数字
 */
function printMatrixClockwisely($matrix,$rows,$columns){
    if(empty($matrix) || $rows <= 0 || $columns <= 0){
        return;
    }
    $start = 0;
    while($rows > $start*2 && $columns > $start*2){
        printMatrixInCircle($matrix,$rows,$columns,$start);
        $start++;
    }
}

function printMatrixInCircle($matrix,$rows,$columns,$start){
    $endX = $columns-1-$start;
    $endY = $rows-1-$start;
    //从左到右打印一行
    for($i=$start;$i<=$endX;$i++){
        echo $matrix[$start][$i] . ' ';
    }
    //从上到下打印一列,条件是至少有两行
    if($start < $endY){
        for($i=$start+1;$i<=$endY;$i++){
            echo $matrix[$i][$endX] . ' ';
        }
    }
    //从右到左打印一行,条件是至少有两行两列
    if($start<$endX && $start<$endY){
        for($i=$endX-1;$i>=$start;$i--){
            echo $matrix[$endY][$i] . ' ';
        }
    }
    //从下到上打印一列,条件是至少有三行两列
    if($start < $endX && $start+1 < $endY){
        for($i=$endY-1;$i>$start;$i--){
            echo $matrix[$i][$start] . ' ';
        }
    }
}

$matrix = [
    [1,2,3,4],
    [5,6,7,8],
    [9,10,11,12],
    [13,14,15,16],
];

printMatrixClockwisely($matrix,4,4);