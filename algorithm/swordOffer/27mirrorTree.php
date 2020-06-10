<?php
require_once './data/treeNode.php';
require_once '../dataStruct/queue/myQueue.php';
/**
 * 题目描述:输入一棵二叉树,输出它的镜像二叉树
 */

function mirrorTree($root){
    if($root == null){
        return;
    }
    if($root->left == null && $root->right == null){
        return;
    }
    $temp = $root->left;
    $root->left = $root->right;
    $root->right = $temp;
    if($root->left != null){
        mirrorTree($root->left);
    }
    if($root->right != null){
        mirrorTree($root->right);
    }
}

$root1 = new treeNode(1);
$node1 = new treeNode(2);
$node2 = new treeNode(3);
$node3 = new treeNode(4);
$node4 = new treeNode(5);
$root1->left = $node1;
$root1->right = $node2;
$node1->left = $node3;
$node1->right = $node4;

$root1->levelOrderTraverseTree();
mirrorTree($root1);
$root1->levelOrderTraverseTree();
