<?php
require_once './data/treeNode.php';

/**
 * 题目描述:输入一棵二叉搜索树,将该二叉搜索树转换为一个排序的双向链表,要求不能创建任何节点,只能调整树中节点指针的指向
 */

function treeConvertLink($root){
    if($root == null){
        return null;
    }
    $linkLastNode = null;
    convertCore($root,$linkLastNode);
    $linkHead = $linkLastNode;
    while($linkHead != null && $linkHead->left != null){
        $linkHead = $linkHead->left;
    }
    return $linkHead;
}

function convertCore($root,&$linkLastNode){
    if($root == null){
        return;
    }
    $current = $root;
    if($current->left != null){
        convertCore($current->left,$linkLastNode);
    }
    $current->left = $linkLastNode;
    if($linkLastNode != null){
        $linkLastNode->right = $current;
    }
    $linkLastNode = $current;
    if($current->right != null){
        convertCore($current->right,$linkLastNode);
    }
}

$node1 = new treeNode(4);
$node2 = new treeNode(2);
$node3 = new treeNode(6);
$node4 = new treeNode(1);
$node5 = new treeNode(3);
$node6 = new treeNode(5);
$node7 = new treeNode(7);

$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;
$node3->left = $node6;
$node3->right = $node7;

$head = treeConvertLink($node1);
$node = $head;
while($node != null){
    echo $node->value . ' ';
    if($node->right == null){
        break;
    }
    $node = $node->right;
}

echo "\n";

while ($node != null){
    echo $node->value . ' ';
    $node = $node->left;
}
