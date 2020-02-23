<?php
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/2/21
 * Time: 12:57
 */


function kmpSearch($str,$needle){
    $sLen = strlen($str);
    $nLen = strlen($needle);
    if($sLen < 1 || $nLen < 1){
        return -1;
    }
    $i = 0;
    $j = 0;
    $next = buildNext($needle);
    while($i < $sLen && $j < $nLen){
        if($j == -1 || $str[$i] == $needle[$j]){
            $i++;
            $j++;
        }else{
            $j = $next[$j];
        }
    }
    if($j == $nLen){
        return $i - $j;
    }
    return -1;
}


function buildNext($needle){
    $next = array();
    $next[0] = -1;
    $k = -1;
    $j = 0;
    $nLen = strlen($needle);
    while ($j < $nLen -1){
        if($k == -1 || $needle[$k] == $needle[$j]){
            $k++;
            $j++;
            $next[$j] = $k;
        }else{
            $k = $next[$k];
        }
    }
    return $next;
}

$str = "adfeababcbcab";
$needle = "ababc";
echo kmpSearch($str,$needle);