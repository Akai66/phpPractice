<?php
require_once './treeNode.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/2
 * Time: 22:28
 */

//平衡二叉树
//1.是一棵二叉树 2..左右两边子节点层级数相差不大于1 (针对每一个非叶子节)

class Solution {
    private $isBalance = true;

    function isBalanceTree($root){
        $this->getDepth($root);
        return $this->isBalance;
    }

    function getDepth($node){
        if(empty($node)){
            return 0;
        }
        $left = $this->getDepth($node->left);
        $right = $this->getDepth($node->right);
        if(abs($left - $right) > 1){
            $this->isBalance = false;
        }
        return $left > $right ? $left + 1 : $right + 1;
    }
}

$node1 = new treeNode(10);
$node2 = new treeNode(6);
$node3 = new treeNode(20);
$node4 = new treeNode(4);
$node5 = new treeNode(7);
$node6 = new treeNode(8);

$node1->left = $node2;
$node1->right = $node3;
$node3->left = $node4;
$node3->right = $node5;
$node4->right = $node6;


$solution = new Solution();
var_dump($solution->isBalanceTree($node1));

