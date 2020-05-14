<?php
require_once "./data/linkNode.php";

/**
 * 要求O(1)时间复杂度删除单链表中的指定节点
 */


function deleteNode(&$head,$target){
   if(!empty($target->next)){
       $next = $target->next;
       $target->value = $next->value;
       $target->next= $next->next;
   }elseif($head == $target){
       //链表只有一个节点,删除头结点
       $head = null;
   }else{
       //链表中有多个节点,删除尾结点
       $node = $head;
       while($node->next != $target){
           $node = $node->next;
       }
       $node->next = null;
   }
}

$head = new linkNode(1);
$node2 = new linkNode(2);
$node3 = new linkNode(3);
$head->next = $node2;
$node2->next = $node3;
deleteNode($head,$node2);
var_dump($head);