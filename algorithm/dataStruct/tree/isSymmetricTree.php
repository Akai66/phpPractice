<?php
require_once './treeNode.php';
require_once '../stack/myStack.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/2
 * Time: 23:00
 */

//方法一:递归
function isSymmetricTree($root){
    if(empty($root)){
        return true;
    }
    return isSym($root->left,$root->right);
}

function isSym($left,$right){
    if(empty($left) && empty($right)){
        return true;
    }
    if(empty($left) || empty($right)){
        return false;
    }
    return $left->value == $right->value && isSym($left->left,$right->right) && isSym($left->right,$right->left);
}

//方法二:迭代,利用栈
function isSymmetricTree2($root){
    if(empty($root)){
        return true;
    }
    $left = $root->left;
    $right = $root->right;
    $ms = new myStack();
    $ms->push($left);
    $ms->push($right);
    while(!$ms->isEmpty()){
        $node1 = $ms->pop();
        $node2 = $ms->pop();
        if(empty($node1) && empty($node2)){
            continue;
        }
        if(empty($node1) || empty($node2)){
            return false;
        }
        if($node1->value != $node2->value){
            return false;
        }
        $ms->push($node1->left);
        $ms->push($node2->right);
        $ms->push($node1->right);
        $ms->push($node2->left);
    }
    return true;
}

$node1 = new treeNode(1);
$node2 = new treeNode(2);
$node3 = new treeNode(2);
$node4 = new treeNode(4);
$node5 = new treeNode(3);
$node6 = new treeNode(3);
$node7 = new treeNode(4);

$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;
$node3->left = $node6;
$node3->right = $node7;

/*
 *        1
 *       / \
 *      2   2
 *     / \ / \
 *    4  3 3  4
 */

var_dump(isSymmetricTree($node1));
var_dump(isSymmetricTree2($node1));