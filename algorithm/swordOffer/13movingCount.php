<?php

/*
 * 机器人的运动范围,地上有一个m行n列的方格,一个机器人从坐标(0,0)的格子开始移动,每次可以向左,右,上,下移动一格
 * ,但不能进入行坐标和列坐标的数位之和大于k的格子,请问机器人能到达多少个格子
 */

function movingCount($k,$rows,$cols){
    if($k <= 0 || $rows <= 0 || $cols <= 0){
        throw new Exception("参数错误");
    }
    $visited = array();
    $count = movingCountCore($k,$rows,$cols,0,0,$visited);
    return $count;
}

function movingCountCore($k,$rows,$cols,$row,$col,&$visited){
    $count = 0;
    if($row >= 0 && $row < $rows && $col >= 0 && $col < $cols && getNumSum($row)+getNumSum($col) <= $k && !$visited[$row][$col]){
        if(!isset($visited[$row])){
            $visited[$row] = array();
        }
        $visited[$row][$col] = true;
        $count = 1 + movingCountCore($k,$rows,$cols,$row-1,$col,$visited)
            + movingCountCore($k,$rows,$cols,$row+1,$col,$visited)
            + movingCountCore($k,$rows,$cols,$row,$col-1,$visited)
            + movingCountCore($k,$rows,$cols,$row,$col+1,$visited);
    }
    return $count;
}

function getNumSum($num){
    $sum = 0;
    while($num > 0){
        $sum += $num%10;
        $num = floor($num/10);
    }
    return $sum;
}

var_dump(movingCount(18,20,20));
