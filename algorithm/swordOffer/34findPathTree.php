<?php
require_once './data/treeNode.php';

/**
 * 输入一棵二叉树和一个整数,打印二叉树中节点值的和为输入整数的所有路径,从根节点开始往下一直到叶节点所经过的节点形成一条路径
 */

function findPath($root,$target){
    if($root == null){
        return;
    }
    $path = array();
    $sum = 0;
    findPathCore($root,$target,$path,$sum);
}

function findPathCore($root,$target,&$path,$sum){
    $sum += $root->value;
    array_push($path,$root->value);
    //判断是否为叶子节点
    $isLeaf = $root->left == null && $root->right == null;
    if($isLeaf && $sum == $target){
        //打印路径
        foreach ($path as $node){
            echo $node . ' ';
        }
        echo "\n";
    }
    if($root->left != null){
        findPathCore($root->left,$target,$path,$sum);
    }
    if($root->right != null){
        findPathCore($root->right,$target,$path,$sum);
    }
    array_pop($path);
}

$node1 = new treeNode(1);
$node2 = new treeNode(2);
$node3 = new treeNode(6);
$node4 = new treeNode(4);
$node5 = new treeNode(5);


$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;


findPath($node1,7);