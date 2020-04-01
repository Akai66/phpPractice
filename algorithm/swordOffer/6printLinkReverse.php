<?php
require_once "linkNode.php";
require_once "../dataStruct/stack/myStack.php";

/**
 * 反向打印链表
 */

//利用栈实现,优于递归,因为如果链表太长,递归容易导致栈溢出
function printLinkReverse1($head){
    if(empty($head)){
        echo "参数错误:链表为空";
        return;
    }
    $ms = new myStack();
    $node = $head;
    $ms->push($node);
    while(!empty($node->next)){
        $node = $node->next;
        $ms->push($node);
    }
    while(!$ms->isEmpty()){
        echo $ms->pop()->value . " ";
    }
}

//递归实现,递归的本质就是栈调用
function printLinkReverse2($head){
    if(empty($head)){
        echo "参数错误:链表为空";
        return;
    }
    if(!empty($head->next)){
        printLinkReverse2($head->next);
    }
    echo $head->value . " ";
}

$head = new linkNode(1);
$node2 = new linkNode(2);
$node3 = new linkNode(3);
$head->next = $node2;
$node2->next = $node3;
printLinkReverse1($head);
echo "\n";
printLinkReverse2($head);