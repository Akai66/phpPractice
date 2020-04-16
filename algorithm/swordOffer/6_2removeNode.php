<?php
require_once "linkNode.php";

/**
 * 删除链表中第一个值为target的节点
 */

function removeNode(&$head,$target){
    if(empty($head)){
        throw new Exception("参数错误:链表为空");
    }
    if($head == $target){
        $head = $head->next;
    }else{
        $node = $head;
        while(!empty($node->next) && $node->next != $target){
            $node = $node->next;
        }
        if(!empty($node->next)){
            $node->next = $node->next->next;
        }
    }
}

$head = new linkNode(1);
$node2 = new linkNode(2);
$node3 = new linkNode(3);
$head->next = $node2;
$node2->next = $node3;
removeNode($head,$node2);
var_dump($head);
