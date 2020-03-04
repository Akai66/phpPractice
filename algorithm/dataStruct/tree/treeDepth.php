<?php
require_once './treeNode.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/4
 * Time: 18:16
 */

//二叉树的最大和最小深度
//根节点到所有叶子节点的最长路径上的节点个数为树最大深度
//根节点到所有叶子节点的最短路径上的节点个数为树最小深度


function maxDepth($root){
    return !empty($root) ? max(maxDepth($root->left),maxDepth($root->right))+1 : 0;
}

function minDepth($root){
    if(empty($root)){
        return 0;
    }
    if(empty($root->left) && empty($root->right)){
        return 1;
    }
    //对于左子树和右子树,其中只有一个为空的情况需要特殊处理,需要继续计算不为空的子树的长度,因为该节点不是叶子节点
    if(!empty($root->left) && empty($root->right)){
        return minDepth($root->left) + 1;
    }
    if(empty($root->left) && !empty($root->right)){
        return minDepth($root->right) + 1;
    }
    return min(minDepth($root->left),minDepth($root->right))+1;
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

var_dump(maxDepth($node1),minDepth($node1));