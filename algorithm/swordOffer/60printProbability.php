<?php

/**
 * 题目描述:n个骰子的点数
 * 把n个骰子扔在地上,所有骰子朝上的一面的点数之和为s,输入n,打印出s所有可能的值出现的概率
 */

$maxValue = 6;

//思路一:使用递归,存在重复子问题,计算效率低
function printProbability1($num){
    if($num<=0){
        return;
    }
    global $maxValue;
    $probabilities = array();
    $maxSum = $maxValue*$num;
    for($i=$num;$i<=$maxSum;$i++){
        $probabilities[$i-$num] = 0;
    }
    for($i=1;$i<=$maxValue;$i++){
        probability($num,$num,$i,$probabilities);
    }
    $total = pow($maxValue,$num);
    for($i=$num;$i<=$maxSum;$i++){
        $ratio = round($probabilities[$i-$num]/$total,5);
        echo sprintf("%d:%f\n",$i,$ratio);
    }
}

function probability($original,$current,$sum,&$probabilities){
    global $maxValue;
    if($current == 1){
        $probabilities[$sum-$original]++;
    }else{
        for($i=1;$i<=$maxValue;$i++){
            probability($original,$current-1,$sum+$i,$probabilities);
        }
    }
}

//思路二:基于循环求骰子点数,效率高,利用两个数组,把一个数组的第n项等与另一个数组的第n-1,n-2,n-3,n-4,n-5,n-6项的和
function printProbability2($num){
    if($num<=0){
        return;
    }
    global $maxValue;
    $probabilities = array(array(),array());
    for($i=0;$i<=$maxValue*$num;$i++){
        $probabilities[0][$i] = 0;
        $probabilities[1][$i] = 0;
    }
    $flag = 0;
    for($i=1;$i<=$maxValue;$i++){
        $probabilities[$flag][$i] = 1;
    }
    for($i=2;$i<=$num;$i++){
        for($j=0;$j<$i;$j++){
            //例如:num=2,那么和为0或者1的次数均为0,和的最小值为2
            $probabilities[1-$flag][$j]=0;
        }
        for($k=$i;$k<=$i*$maxValue;$k++){
            $probabilities[1-$flag][$k] = 0;
            for($m=1;$m<$k && $m<=$maxValue;$m++){
                $probabilities[1-$flag][$k] += $probabilities[$flag][$k-$m];
            }
        }
        $flag = 1-$flag;
    }
    $total = pow($maxValue,$num);
    for($i=$num;$i<=$num*$maxValue;$i++){
        $ratio = round($probabilities[$flag][$i]/$total,5);
        echo sprintf("%d:%f\n",$i,$ratio);
    }
}

printProbability1(2);
printProbability2(2);

