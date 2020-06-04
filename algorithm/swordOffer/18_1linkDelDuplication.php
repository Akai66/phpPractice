<?php
require_once './data/linkNode.php';

function delDuplication(&$head){
    if(empty($head)){
        throw new Exception('头指针为空');
    }
    $preNode = null;
    $pNode = $head;
    while($pNode != null){
        $pNext = $pNode->next;
        $isDel = false;
        if($pNext != null && $pNode->value == $pNext->value){
            $isDel = true;
        }
        if(!$isDel){
            $preNode = $pNode;
            $pNode = $pNext;
        }else{
            $pValue = $pNode->value;
            $toBeDelNode = $pNode;
            while($toBeDelNode != null && $toBeDelNode->value == $pValue){
                $pNext = $toBeDelNode->next;
                $toBeDelNode = $pNext;
            }
            if($preNode == null){
                $head = $pNext;
            }else{
                $preNode->next = $pNext;
            }
            $pNode = $pNext;
        }
    }
}

$head = new linkNode(2);
$node2 = new linkNode(2);
$node3 = new linkNode(3);
$node4 = new linkNode(3);
$node5 = new linkNode(4);
$node6 = new linkNode(4);
$node7 = new linkNode(5);
$head->next = $node2;
$node2->next = $node3;
$node3->next = $node4;
$node4->next = $node5;
$node5->next = $node6;
$node6->next = $node7;

delDuplication($head);
var_dump($head);