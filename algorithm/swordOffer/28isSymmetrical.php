<?php
require_once './data/treeNode.php';
/**
 * 题目描述:判断一棵二叉树是否对称
 */

function isSymmertical($root){
    if($root == null){
        return true;
    }
    return isSymmerticalCore($root->left,$root->right);
}

function isSymmerticalCore($node1,$node2){
    if($node1 == null && $node2 == null){
        return true;
    }
    if($node1 == null || $node2 == null){
        return false;
    }
    if($node1->value != $node2->value){
        return false;
    }
    return isSymmerticalCore($node1->left,$node2->right) && isSymmerticalCore($node1->right,$node2->left);
}

$root1 = new treeNode(1);
$node1 = new treeNode(2);
$node2 = new treeNode(2);
$node3 = new treeNode(4);
$node4 = new treeNode(5);
$node5 = new treeNode(5);
$node6 = new treeNode(4);
$root1->left = $node1;
$root1->right = $node2;
$node1->left = $node3;
$node1->right = $node4;
$node2->left = $node5;
$node2->right = $node6;

var_dump(isSymmertical($root1));
