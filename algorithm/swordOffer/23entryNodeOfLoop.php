<?php
require_once ('./data/linkNode.php');
/**
 * 题目描述:如果一个链表中包含环,如何找出环的入口节点
 */

//快慢指针解法,先利用快慢指针找出相遇节点,如果存在环,相遇节点一定在环中
//让后根据相遇节点,计算环中节点个数n
//再次利用快慢指针,快指针先走n步,然后快慢指针一起每次走1步,当慢指针走到环的入口时,此时快指针已经绕环一圈,同时也会走到环的入口

function entryNodeOfLoop($head){
    if($head == null){
        return null;
    }
    //获取相遇节点
    $meetNode = meetingNode($head);
    if($meetNode == null){
        return null;
    }
    //计算环中节点个数
    $countInLoop = 1;
    $pNode = $meetNode;
    while($pNode->next != $meetNode){
        $pNode = $pNode->next;
        $countInLoop++;
    }
    //快慢指针获取环入口节点
    $pSlow = $head;
    $pFast = $head;
    for($i=0;$i<$countInLoop;$i++){
        $pFast = $pFast->next;
    }
    while($pSlow != $pFast){
        $pSlow = $pSlow->next;
        $pFast = $pFast->next;
    }
    return $pFast;
}

function meetingNode($head){
    if($head == null){
        return null;
    }
    $pSlow = $head->next;
    if($pSlow == null){
        return null;
    }
    $pFast = $pSlow->next;
    while($pFast != null && $pSlow != null){
        if($pSlow == $pFast){
            return $pFast;
        }
        $pSlow = $pSlow->next;
        $pFast = $pFast->next;
        if($pFast != null){
            $pFast = $pFast->next;
        }
    }
    return null;
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
$node6->next = $node3;

$node = entryNodeOfLoop($head);
echo $node->value;