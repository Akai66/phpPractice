<?php
require_once './data/treeNode.php';
/**
 * 输入两棵二叉树A和B,判断树B是不是树A的子结构
 */

function hasSubTree($root1,$root2){
    $result = false;
    if($root1 != null && $root2 != null){
        if($root1->value == $root2->value){
            $result = doesTree1HaveTree2($root1,$root2);
        }
        if(!$result){
            $result = hasSubTree($root1->left,$root2);
        }
        if(!$result){
            $result = hasSubTree($root1->right,$root2);
        }
    }
    return $result;
}

function doesTree1HaveTree2($root1,$root2){
    if($root2 == null){
        return true;
    }
    if($root1 == null){
        return false;
    }
    if(!($root1->value == $root2->value)){
        return false;
    }
    return doesTree1HaveTree2($root1->left,$root2->left) && doesTree1HaveTree2($root1->right,$root2->right);
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


$root2 = new treeNode(2);
$node1 = new treeNode(4);
$node2 = new treeNode(5);
$root2->left = $node1;
$root2->right = $node2;

var_dump(hasSubTree(null,$root2));
var_dump(hasSubTree($root1,null));
var_dump(hasSubTree($root1,$root2));