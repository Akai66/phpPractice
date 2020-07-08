<?php
require_once './data/linkNode.php';
require_once './data/stackNode.php';

/**
 * 题目描述:输入两个链表,找出它们的第一个公共节点
 */

//方法一:利用栈,后进先出,先遍历链表将节点依次插入栈,从尾部开始比较,最后一个相同的节点即为第一个公共节点
function findFirstCommonNode1($head1,$head2){
    $resultNode = null;
    $stack1 = new stackNode();
    $stack2 = new stackNode();
    $node1 = $head1;
    $node2 = $head2;
    while($node1 != null || $node2 != null){
        if($node1 != null){
            $stack1->push($node1);
            $node1 = $node1->next;
        }
        if($node2 != null){
            $stack2->push($node2);
            $node2 = $node2->next;
        }
    }
    while(!$stack1->isEmpty() && !$stack2->isEmpty()){
        $tailNode1 = $stack1->pop();
        $tailNode2 = $stack2->pop();
        if($tailNode1 == $tailNode2){
            $resultNode = $tailNode1;
        }else{
            break;
        }
    }
    return $resultNode;
}


//方法二:计算两个链表的长度的差值d,长链表先走d步,然后两个链表一起往前走,遇到的第一个相同的节点就是第一个相同的公共节点
function findFirstCommonNode2($head1,$head2){
    $len1 = getLinkLength($head1);
    $len2 = getLinkLength($head2);
    if($len1 > $len2){
        $longLinkNode = $head1;
        $shortLinkNode = $head2;
        $diff = $len1-$len2;
    }else{
        $longLinkNode = $head2;
        $shortLinkNode = $head1;
        $diff = $len2-$len1;
    }
    //长链表先走diff步
    for($i=0;$i<$diff;$i++){
        $longLinkNode = $longLinkNode->next;
    }
    //两个链表一起往前走
    while($longLinkNode != null && $shortLinkNode != null && $longLinkNode != $shortLinkNode){
        $longLinkNode = $longLinkNode->next;
        $shortLinkNode = $shortLinkNode->next;
    }
    return $longLinkNode;
}

function getLinkLength($head){
    $length = 0;
    $node = $head;
    while($node != null){
        $length++;
        $node = $node->next;
    }
    return $length;
}


$head1 = new linkNode(1);
$node2 = new linkNode(2);
$node3 = new linkNode(3);
$head2 = new linkNode(4);
$node5 = new linkNode(5);
$node6 = new linkNode(6);
$node7 = new linkNode(7);
$head1->next = $node2;
$node2->next = $node3;
$node3->next = $node6;
$node6->next = $node7;
$head2->next = $node5;
$node5->next = $node6;

var_dump(findFirstCommonNode1($head1,$head2));
var_dump(findFirstCommonNode2($head1,$head2));



