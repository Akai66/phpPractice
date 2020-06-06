<?php
require_once './data/linkNode.php';
/**
 * 题目描述:输入一个单链表,输出链表的倒数第k个节点
 */

function findKthToTail($head,$k){
    //校验$head不能为空,$k不能<=0
    if(empty($head) || $k <= 0){
        return null;
    }
    $pAhead = $head;
    $pBehind = $head;
    //$pAhead先走k-1步
    for($i=1;$i<=$k-1;$i++){
        //校验链表长度不能小于k
        if($pAhead->next != null){
            $pAhead = $pAhead->next;
        }else{
            return null;
        }
    }
    //$pAhead和$pBehind每次同时往前走1步
    while($pAhead->next != null){
        $pAhead = $pAhead->next;
        $pBehind = $pBehind->next;
    }
    return $pBehind;
}

$head = new linkNode(1);
$node2 = new linkNode(2);
$node3 = new linkNode(3);
$node4 = new linkNode(4);
$node5 = new linkNode(5);
$head->next = $node2;
$node2->next = $node3;
$node3->next = $node4;
$node4->next = $node5;

$node = findKthToTail($head,4);
var_dump($node->value);