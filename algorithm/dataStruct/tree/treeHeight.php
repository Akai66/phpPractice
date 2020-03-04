<?php
require_once './treeNode.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/4
 * Time: 17:42
 */

//寻找二叉树的高度,所有叶子节点到根节点的路径中,最大的节点个数

function getTreeHeight($root){
    return !empty($root) ? max(getTreeHeight($root->left),getTreeHeight($root->right))+1 : 0;
}

$node1 = new treeNode(1);
$node2 = new treeNode(2);
$node3 = new treeNode(3);
$node4 = new treeNode(4);
$node5 = new treeNode(5);
$node6 = new treeNode(6);
$node7 = new treeNode(7);
$node8 = new treeNode(8);
$node9 = new treeNode(9);
$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;
$node3->left = $node6;
$node3->right = $node7;
$node4->right = $node8;
$node8->left = $node9;

var_dump(getTreeHeight($node1));