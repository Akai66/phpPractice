<?php
/**
 * 题目描述:输入一个字符串,打印出该字符串中字符的所有排列
 */

//思路:每次把字符串分为两部分,第一部分是一个字符

function permutation($str){
    if(empty($str)){
        return;
    }
    permutationCore($str,0,strlen($str));
}

function permutationCore(&$str,$start,$length){
    if($start >= $length){
        echo $str . "\n";
    }else{
        for($i=$start;$i<$length;$i++){
            swap($str,$start,$i);
            permutationCore($str,$start+1,$length);
            swap($str,$start,$i);
        }
    }

}

function swap(&$arr,$index1,$index2){
    $temp = $arr[$index1];
    $arr[$index1] = $arr[$index2];
    $arr[$index2] = $temp;
}

$str = 'abcd';
permutation($str);

//扩展
/**
 * 题目描述:输入一组字符,求该组字符所有的组合,例如,输入[a,b,c],所有组合情况为:a,ab,ac,abc
 */

function combination($arr){
    if(empty($arr)){
        return;
    }
    $length = count($arr);
    for($i=1;$i<=$length;$i++){
        $result = array();
        combinationCore($arr,$result,$i,0);
    }
}

function combinationCore($arr,$result,$total,$index){
    if(count($result) >= $total){
        echo implode('',$result) . ' ';
        return;
    }
    if($index >= count($arr)){
        return;
    }
    //该字符在组合中
    $ch = $arr[$index];
    $result[] = $ch;
    combinationCore($arr,$result,$total,$index+1);
    //该字符不在组合中
    array_pop($result);
    combinationCore($arr,$result,$total,$index+1);
}

$arr = ['a','b','c','d','e'];
combination($arr);

/**
 * 八皇后问题,8x8棋牌上摆放8个皇后,任意两个不能属于同一行,同一列,同一对角线,一共有多少种摆法
 */

//利用一个长度为8的数组columnIndex,columnIndex[i]表示第i行皇后的列数
//对数组columnIndex进行全排列,判断每一个排列对应的8皇后是否存在任意两个在同一条对角线上,其实就是判断是否存在两个下标i和j(i!=j),让i-j=columnIndex[i]-columnIndex[j]


function eightQueens(){
    $columnIndex = [0,1,2,3,4,5,6,7];
    $result = 0;
    qplSort($columnIndex,0,$result);
    return $result;
}

function qplSort($columnIndex,$index,&$result){
    if($index >= 8 && !isHasDj($columnIndex)) {
        $result++;
    }
    for($i=$index;$i<8;$i++){
        swap($columnIndex,$index,$i);
        qplSort($columnIndex,$index+1,$result);
        swap($columnIndex,$index,$i);
    }
}

function isHasDj($arr){
    $result = false;
    if(empty($arr)){
        return $result;
    }
    $length = count($arr);
    for($i=0;$i<$length;$i++){
        for($j=$i+1;$j<$length;$j++){
            if(abs($i-$j) == abs($arr[$i]-$arr[$j])){
                $result = true;
                break;
            }
        }
    }
    return $result;
}

var_dump(eightQueens());



