<?php
require_once "linkNode.php";

/**
 * 向链表尾部添加节点
 */

function addToTail(&$head,$node){
    if(empty($head)){
        $head = $node;
        return;
    }
    $nd = $head;
    while(!empty($nd->next)){
        $nd = $nd->next;
    }
    $nd->next = $node;
}

$head = new linkNode(1);
$node2 = new linkNode(2);
$node3 = new linkNode(3);
$head->next = $node2;
$node2->next = $node3;
$node4 = new linkNode(4);
addToTail($head,$node4);

var_dump($head);
