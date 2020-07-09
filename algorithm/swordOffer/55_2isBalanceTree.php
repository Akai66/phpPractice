<?php
require_once './data/treeNode.php';
/**
 * 题目描述:平衡二叉树
 * 判断一棵二叉树是否为平衡二叉树,如果某二叉树中任意节点的左,右子树的深度相差不超过1,那么它就是一棵平衡二叉树
 */

//方法一:利用递归和获取二叉树深度的方法,遍历二叉树的每一个节点进行判断,存在重复节点判断
function isBalanceTree1($root){
    if($root == null){
        return true;
    }
    $left = treeDepth($root->left);
    $right = treeDepth($root->right);
    if(abs($left-$right) > 1){
        return false;
    }
    return isBalanceTree1($root->left) && isBalanceTree1($root->right);
}

function treeDepth($root){
    if($root == null){
        return 0;
    }
    $leftDepth = treeDepth($root->left);
    $rightDepth = treeDepth($root->right);
    return $leftDepth > $rightDepth ? $leftDepth+1 : $rightDepth+1;
}

//方法二:边计算左右子树深度,边判断是否平衡,避免重复判断节点
function isBalanceTree2($root,&$depth){
    if($root == null){
        $depth = 0;
        return true;
    }
    if(isBalanceTree2($root->left,$left) && isBalanceTree2($root->right,$right)){
        if(abs($left-$right) <= 1){
            $depth = $left > $right ? $left+1 : $right+1;
            return true;
        }
    }
    return false;
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

var_dump(isBalanceTree1($root));
var_dump(isBalanceTree2($root,$depth));