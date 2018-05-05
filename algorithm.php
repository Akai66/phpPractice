<?php
//冒泡排序
function bubbleSort($arr){
    $count = count($arr);
    if($count <= 1){
        return $arr;
    }
    for($i=0;$i<$count;$i++){
        for($j=0;$j<$count-$i-1;$j++){
            if($arr[$j] > $arr[$j+1]){
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $tmp;
            }
        }
    }
    return $arr;
}


//选择排序
function selectSort($arr){
    $count = count($arr);
    if($count <= 1){
        return $arr;
    }
    for($i=0;$i<$count;$i++){
        for($j=$i+1;$j<$count;$j++){
            if($arr[$j] > $arr[$i]){
                $tmp = $arr[$j];
                $arr[$j] = $arr[$i];
                $arr[$i] = $tmp;
            }
        }
    }
    return $arr;
}



//快速排序
function quickSort($arr){
    $count = count($arr);
    if($count <= 1){
        return $arr;
    }
    $left = [];
    $right = [];
    $mid = $arr[0];
    for($i=1;$i<$count;$i++){
        if($arr[$i] <= $mid){
            $left[] = $arr[$i];
        }else{
            $right[] = $arr[$i];
        }
    }
    $left = quickSort($left);
    $right = quickSort($right);
    return array_merge($left,[$mid],$right);
}



//插入排序
function InsertSort($arr){
    $length = count($arr);
    if($length <=1){
        return $arr;
    }
    for($i=1;$i<$length;$i++){
        $x = $arr[$i];
        $j = $i-1;
        while($x<$arr[$j] && $j>=0){
            $arr[$j+1] = $arr[$j];
            $j--;
        }
        $arr[$j+1] = $x;
    }
    return $arr;
}



//二分法递归
function binary_search_dg($arr,$key,$low,$high){
    $mid = intval(($low+$high)/2);
    if($key == $arr[$mid]){
        return $mid;
    }elseif($key<$arr[$mid]){
        binary_search_dg($arr,$key,$low,$mid-1);
    }elseif($key>$arr[$mid]){
        binary_search_dg($arr,$key,$mid+1,$high);
    }
    return -1;
}



//二分法非递归
function binary_search($arr,$key){
    $low = 0;
    $high = count($arr);
    while($low<=$high){
        $mid = intval(($low+$high)/2);
        if($key == $arr[$mid]){
            return $mid;
        }elseif($key<$arr[$mid]){
            $high = $mid-1;
        }elseif($key>$arr[$mid]){
            $low = $mid+1;
        }
    }
    return -1;
}



//顺序查找
function SqSearch($arr,$key){
    $length = count($arr);
    for($i=0;$i<$length;$i++){
        if($key == $arr[$i]){
            return $i+1;
        }
    }
    return -1;
}


//斐波拉契数列递归法
function findN_dg($n){
    if($n <=2){
        return 1;
    }
    return findN_dg($n-2)+findN_dg(n-1);
}




//斐波拉契数列非递归
function findN($n){
    $arr = [1,1];
    if($n <= 2){
        return $arr;
    }
    for ($i=2;$i<$n;$i++){
        $arr[] = $arr[$i-2] + $arr[$i-1];
    }
    return $arr;
}



//字符串匹配,回溯法
function find_str($str,$substr) {
    $i = 0;
    $j =0 ;
    while($i<strlen($str) && $j<strlen($substr)) {
        if($str[$i]==$substr[$j]) {
            $i++;
            $j++;
        } else {
            $i = $i - $j +1; // 不相等的情况下，i是要向前走的哦！
            $j = 0;
        }
    }
    if($j == strlen($substr)){
        return true; 
    } 
    return false;
}




//计算相对路径
function getRelativePath ($a, $b)
{
    $patha = explode('/', $a);
    $pathb = explode('/', $b);

    $counta = count($patha) - 1;
    $countb = count($pathb) - 1;

    $path = "../";
    if ($countb > $counta) {
        while ($countb > $counta) {
            $path .= "../";
            $countb --;
        }
    }

    // 寻找第一个公共结点 
    for ($i = $countb - 1; $i >= 0;) {
        if ($patha[$i] != $pathb[$i]) {
            $path .= "../";
            $i --;
        } else { // 判断是否为真正的第一个公共结点，防止出现子目录重名情况 
            for ($j = $i - 1, $flag = 1; $j >= 0; $j --) {
                if ($patha[$j] == $pathb[$j]) {
                    continue;
                } else {
                    $flag = 0;
                    break;
                }
            }

            if ($flag)
                break;
            else
                $i ++;
        }
    }

    for ($i += 1; $i <= $counta; $i ++) {
        $path .= $patha[$i] . "/";
    }

    return $path;
}


//无限极分类,数据库:三个字段,id,name,pid
//递归


function tree($list,$pid){
    $tree = [];
    foreach ($list as $value){
        if($value['pid'] == $pid){
            $value['children'] = tree($list,$value['id']);
            $tree[] = $value;
        }
    }
    return $tree;
}

$list = [];
tree($list,0);

function tree2($list,$pid=0,$level=0,$html='--'){
    static $tree=array();//采用静态，递归调用也不会将其重置
    foreach($list as $value){
        if($value['pid']==$pid){
            $value['level']=$level;
            $value['html']=str_repeat($html,$level);
            $tree[]=$value;
            tree2($list,$value['id'],$level+1,$html);
        }
    }
    return $tree;
}


//约瑟夫环的问题
//PHP解决约瑟夫环问题
//方法一
function joseph_ring($n,$m){
    $arr = range(1,$n);
    $i = 0;
    while(count($arr)>1){
        $i=$i+1;
        $head = array_shift($arr);
        if($i%$m != 0){ //如果不是则重新压入数组
            array_push($arr,$head);
        }
    }
    return $arr[0];
}


//杨辉三角,递归



//走楼梯问题,递归




//转椅圆盘问题,递归










