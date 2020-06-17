<?php
require_once './data/stackNode.php';
/**
 * 题目描述:输入两个整数序列,第一个序列标识栈的压入顺序,请判断第二序列是否为栈的弹出顺序,假设压入栈的全部数字均不相等
 */

function isPopOrder($pushArr,$popArr){
    $isOk = false;
    if(!empty($pushArr) && !empty($pushArr) && count($pushArr) == count($popArr)){
        $length = count($pushArr);
        $pushIndex = 0;
        $popIndex = 0;
        $myStack = new stackNode();
        while ($popIndex < $length){
            while($myStack->isEmpty() || $myStack->top() != $popArr[$popIndex]){
                if($pushIndex >= $length){
                    break;
                }
                $myStack->push($pushArr[$pushIndex]);
                $pushIndex++;
            }
            if($myStack->top() != $popArr[$popIndex]){
                break;
            }
            $myStack->pop();
            $popIndex++;
        }
        if($myStack->isEmpty() && $popIndex >= $length){
            $isOk = true;
        }
    }
    return $isOk;
}

$pushArr = [1,2,3,4,5];
$popArr = [4,5,3,2,1];
var_dump(isPopOrder($pushArr,$popArr));