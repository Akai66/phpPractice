<?php
require_once './data/linkNode.php';
/**
 * 题目描述:输入一个单链表,输出链表的中间节点,如果节点总数为奇数,则返回中间节点,如果节点的总数为偶数,则返回中间两个节点的任意一个
 */

function findMidNode($head){
    if($head == null){
        return null;
    }
    $pAhead = $head;
    $pBehind = $head;
    while(true){
        //$pAhead每次走2步
        for($i=1;$i<=2;$i++){
            if($pAhead->next != null){
                $pAhead = $pAhead->next;
            }else{
                return $pBehind;
            }
        }
        //$pBehind每次走1步
        $pBehind = $pBehind->next;
    }
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

$node = findMidNode($head);
echo $node->value;