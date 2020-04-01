<?php
require_once "linkNode.php";

/**
 * 删除链表中第一个值为target的节点
 */

function removeNode(&$head,$target){
    if(empty($head)){
        echo "参数错误:链表为空";
        return;
    }
    $delNode = null;
    if($head->value == $target){
        $delNode = $head;
        $head = $head->next;
    }else{
        $node = $head;
        while(!empty($node->next) && $node->next->value != $target){
            $node = $node->next;
        }
        if(!empty($node->next)){
            $delNode = $node->next;
            $node->next = $node->next->next;
        }
    }
    if(!empty($delNode)){
        unset($delNode);
    }
}

$head = new linkNode(1);
$node2 = new linkNode(2);
$node3 = new linkNode(3);
$head->next = $node2;
$node2->next = $node3;
removeNode($head,2);
var_dump($head);
