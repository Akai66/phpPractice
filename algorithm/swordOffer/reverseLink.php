<?php
require_once './data/linkNode.php';
/**
 * 反转链表
 */

function reverseLink($head){
    if($head == null){
        return null;
    }
    $reverseHead = null;
    $preNode = null;
    $pNode = $head;
    while($pNode != null){
        $next = $pNode->next;
        if($next == null){
            $reverseHead = $pNode;
        }
        $pNode->next = $preNode;
        $preNode = $pNode;
        $pNode = $next;
    }
    return $reverseHead;
}

$head = new linkNode(1);
$node2 = new linkNode(2);
$node3 = new linkNode(3);
$node4 = new linkNode(4);
$node5 = new linkNode(5);
$node6 = new linkNode(6);
$head->next = $node2;
$node2->next = $node3;
$node3->next = $node4;
$node4->next = $node5;
$node5->next = $node6;

$newhead = reverseLink($head);
var_dump($newhead);
