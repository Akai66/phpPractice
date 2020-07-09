<?php
require_once './data/treeNode.php';
/**
 * 题目描述:二叉搜索树的第k小节点
 */

//二叉搜索树的中序遍历是有序的,根据该特性获取第k小节点
function getTreeKthNode($root,$k){
    if(empty($root) || $k <= 0){
        return null;
    }
    return getTreeKthNodeCore($root,$k);
}

function getTreeKthNodeCore($root,&$k){
    $node = null;
    if($root->left != null){
        $node = getTreeKthNodeCore($root->left,$k);
    }
    if($node == null){
        if($k == 1){
            $node = $root;
        }
        $k--;
    }
    if($node == null && $root->right != null){
        $node = getTreeKthNodeCore($root->right,$k);
    }
    return $node;
}

$root = new treeNode(5);
$node1 = new treeNode(3);
$node2 = new treeNode(7);
$node3 = new treeNode(2);
$node4 = new treeNode(4);
$node5 = new treeNode(6);
$node6 = new treeNode(8);
$root->left = $node1;
$root->right = $node2;
$node1->left = $node3;
$node1->right = $node4;
$node2->left = $node5;
$node2->right = $node6;

var_dump(getTreeKthNode($root,5));