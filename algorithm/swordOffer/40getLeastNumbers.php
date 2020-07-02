<?php
require_once './data/maxHeap.php';

/**
 * 题目描述:输入一个数组,获取数组中最小的k个数
 */

//方法一:利用partition,时间复杂度O(n),会修改原始数组

function getLeastNumbers1($arr,$k){
    $length = count($arr);
    if($length <= 0 || $k > $length || $k <= 0){
        throw new Exception('参数错误');
    }
    $start = 0;
    $end = $length-1;
    $index = partition($arr,$start,$end);
    while($index != $k-1){
        if($index < $k-1){
            $index = partition($arr,$index+1,$end);
        }
        if($index > $k-1){
            $index = partition($arr,$start,$index-1);
        }
    }
    return array_slice($arr,0,$k);
}

function partition(&$arr,$start,$end){
    $index = rand($start,$end);
    swap($arr,$index,$end);
    $small = $start-1;
    for($i=$start;$i<$end;$i++){
        if($arr[$i] < $arr[$end]){
            $small++;
            if($small != $i){
                swap($arr,$i,$small);
            }
        }
    }
    $small++;
    swap($arr,$small,$end);
    return $small;
}

function swap(&$arr,$index1,$index2){
    $temp = $arr[$index1];
    $arr[$index1] = $arr[$index2];
    $arr[$index2] = $temp;
}


//方法二:利用大顶堆容器,适合海量数据处理,不用一次性将所有数据加载到内存,每次读取一个数字,时间复杂度O(n*logk)
function getleastNumber2($arr,$k){
    $length = count($arr);
    if($length <= 0 || $k > $length || $k <= 0 ){
        throw new Exception('参数错误');
    }
    $maxHeap = new maxHeap();
    foreach ($arr as $value){
        if($maxHeap->size() < $k){
            $maxHeap->push($value);
        }elseif($value < $maxHeap->peek()){
            $maxHeap->pop();
            $maxHeap->push($value);
        }
    }
    $result = array();
    while($maxHeap->size() > 0){
        $result[] = $maxHeap->pop();
    }
    return $result;
}

$arr = [4,3,5,8,2,1,1,9];
var_dump(getLeastNumbers1($arr,5));
var_dump(getleastNumber2($arr,5));


//$mh = new maxHeap();
//$mh->push(1);
//echo $mh->peek() . ' ';
//$mh->push(4);
//echo $mh->peek() . ' ';
//$mh->push(3);
//echo $mh->peek() . ' ';
//$mh->push(5);
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';
//$mh->push(-1);
//echo $mh->peek() . ' ';
//$mh->push(2);
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';