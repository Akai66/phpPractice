<?php
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/2/21
 * Time: 12:58
 */

function sunday($str,$needle){
    $sLen = strlen($str);
    $nLen = strlen($needle);
    if($sLen < 1 || $nLen < 1){
        return -1;
    }
    //构造move数组,后面判断move数组中key不存在的,移动$nLen+1
    $move = array();
    for($i = 0;$i < $nLen;$i++){
        $move[$needle[$i]] = $nLen - $i;
    }
    $s = 0;//模式串头部在主字符串中的位置
    while ($s <= $sLen - $nLen){
        $j = 0;//已匹配字符串的长度
        while ($str[$s+$j] == $needle[$j]){
            $j++;
            if($j>=$nLen){
                return $s;
            }
        }
        if($s < $sLen - $nLen){
            $next = $str[$s+$nLen];
            $mLen = !empty($move[$next]) ? $move[$next] : $nLen + 1;
            $s += $mLen;
        }
    }
    return -1;
}

$str = "jdjdiedaaesadiedd";
$needle = "diedd";
var_dump(sunday($str,$needle));



