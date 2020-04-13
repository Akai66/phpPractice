<?php

/*
 * 判断矩阵中是否包含某字符串所有字符的路径,路径可以从矩阵中的任意一格开始,每一步可以在矩阵中向左,右,上,下移动一格,
 * 如果一条路径经过了矩阵的某一格,那么该路径不能再进入该格子.
 */


function hasPath($matrix,$rows,$cols,$str){
    $strLen = strlen($str);
    if($rows <=0 || $cols <= 0 || $strLen <= 0){
        throw new Exception("参数错误");
    }
    $visited = array();
    $pathLen = 0;
    for($i=0;$i<$rows;$i++){
        for($j=0;$j<$cols;$j++){
            if(hasPathCore($matrix,$rows,$cols,$i,$j,$pathLen,$strLen,$str,$visited)){
                return true;
            }
        }
    }
    return false;
}

function hasPathCore($matrix,$rows,$cols,$row,$col,$pathLen,$strLen,$str,&$visited){
    if($pathLen == $strLen){
        return true;
    }
    $hasPath = false;
    if($row >= 0 && $row < $rows && $col >= 0 && $col < $cols && !$visited[$row][$col] && $str[$pathLen] == $matrix[$row][$col]){
        $pathLen++;
        if(!isset($visited[$row])){
            $visited[$row] = array();
        }
        $visited[$row][$col] = true;
        $hasPath = hasPathCore($matrix,$rows,$cols,$row,$col-1,$pathLen,$strLen,$str,$visited)
            || hasPathCore($matrix,$rows,$cols,$row,$col+1,$pathLen,$strLen,$str,$visited)
            || hasPathCore($matrix,$rows,$cols,$row-1,$col,$pathLen,$strLen,$str,$visited)
            || hasPathCore($matrix,$rows,$cols,$row+1,$col,$pathLen,$strLen,$str,$visited);
        if(!$hasPath){
            $pathLen--;
            $visited[$row][$col] = false;
        }
    }
    return $hasPath;
}

$matrix = [
    ['a','b','t','g'],
    ['c','f','c','s'],
    ['j','d','e','h'],
];

var_dump(hasPath($matrix,3,4,'abfb'));
var_dump(hasPath($matrix,3,4,'bfce'));