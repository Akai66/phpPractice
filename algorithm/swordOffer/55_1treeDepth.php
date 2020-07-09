<?php
require_once './data/treeNode.php';

/**
 * 题目描述:二叉树的深度
 * 从根节点到叶节点依次经过的节点(含根节点,叶节点),形成一条路径,最长路径的长度为树的深度
 */

function treeDepth($root){
    if($root == null){
        return 0;
    }
    $leftDepth = treeDepth($root->left);
    $rightDepth = treeDepth($root->right);
    return $leftDepth > $rightDepth ? $leftDepth+1 : $rightDepth+1;
}

$root = new treeNode(1);
$node1 = new treeNode(2);
$node2 = new treeNode(3);
$node3 = new treeNode(4);
$node4 = new treeNode(5);
$node5 = new treeNode(6);
$node6 = new treeNode(7);
$root->left = $node1;
$root->right = $node2;
$node1->left = $node3;
$node1->right = $node4;
$node2->right = $node5;
$node4->left = $node6;

var_dump(treeDepth($root));