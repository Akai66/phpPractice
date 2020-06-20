<?php
/**
 * 题目描述:实现一个函数,复制一个复杂链表,在复杂链表中,每个节点除了有一个next指针,指向下一个节点,还有一个sibling指针指向链表中的任意其它节点或null
 */


function complexClone($head){
    //第一步,克隆每个节点,并将克隆的节点设置为原节点的下一个节点
    nodeClone($head);
    //第二步,设置克隆节点的sibling字段
    setSiblingNodes($head);
    //第三步,拆分链表,将克隆链表拆分出来
    splitLink($head);
}

//克隆每个节点,并将克隆的节点设置为原节点的下一个节点
function nodeClone($head){
    $node = $head;
    while($node != null){
        $cloneNode = new complexLinkNode($node->value);
        $cloneNode->next = $node->next;
        $node->next = $cloneNode;
        $node = $cloneNode->next;
    }
}

//设置克隆节点的sibling字段
function setSiblingNodes($head){
    $node = $head;
    while ($node != null){
        $cloneNode = $node->next;
        if($node->sibling != null){
            $cloneNode->sibling = $node->sibling->next;
        }
        $node = $cloneNode->next;
    }
}

//拆分链表,将克隆链表拆分出来
function splitLink($head){
    $node = $head;
    $headClone = null;
    $cloneNode = null;
    //先获取克隆链表的头节点
    if($node != null){
        $headClone = $cloneNode = $node->next;
        $node->next = $cloneNode->next;
        $node = $node->next;
    }
    while($node != null){
        $cloneNode->next = $node->next;
        $cloneNode = $cloneNode->next;
        $node->next = $cloneNode->next;
        $node = $node->next;
    }
    return $headClone;
}

