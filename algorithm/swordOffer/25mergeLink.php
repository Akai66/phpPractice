<?php
require_once './data/linkNode.php';
/**
 * 题目描述:输入两个递增排序的链表,合并这两个链表并使新链表中的节点仍然是递增排序的
 *
 */

function mergeLink($head1,$head2){
    if($head1 == null){
        return $head2;
    }elseif($head2 == null){
        return $head1;
    }
    $newHead = null;
    if($head1->value < $head2->value){
        $newHead = $head1;
        $newHead->next = mergeLink($head1->next,$head2);
    }else{
        $newHead = $head2;
        $newHead->next = mergeLink($head1,$head2->next);
    }
    return $newHead;
}

$head1 = new linkNode(1);
$node2 = new linkNode(3);
$node3 = new linkNode(5);
$node4 = new linkNode(7);
$head1->next = $node2;
$node2->next = $node3;
$node3->next = $node4;

$head2 = new linkNode(2);
$node5 = new linkNode(4);
$node6 = new linkNode(6);
$node7 = new linkNode(8);
$node8 = new linkNode(9);
$node9 = new linkNode(10);
$head2->next = $node5;
$node5->next = $node6;
$node6->next = $node7;
$node7->next = $node8;
$node8->next = $node9;

$head = mergeLink($head1,$head2);

//$head = mergeLink(null,null);
//$head = mergeLink(null,$head2);
//$head = mergeLink($head1,null);
if($head != null){
    $head->printLink();
}else{
    var_dump($head);
}