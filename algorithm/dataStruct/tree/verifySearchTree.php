<?php
require_once './treeNode.php';
require_once '../stack/myStack.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/1
 * Time: 17:14
 */

//验证二叉搜索树
//方法一:根据二叉搜索树的中序遍历是有序的,进行判断
function verifySearchTree($root){
    if(empty($root)){
        return true;
    }
    $cur = $root;
    $pre = null;
    $ms = new myStack();
    while($cur != null || !$ms->isEmpty()){
        if(!empty($cur)){
            $ms->push($cur);
            $cur = $cur->left;
        }else{
            $node = $ms->pop();
            if(!empty($pre) && $pre->value >= $node->value){
                return false;
            }
            $pre = $node;
            $cur = $node->right;
        }
    }
    return true;
}


//方法二:通过递归判断
function verifySearchTree2($root,$left=null,$right=null){
    if(empty($root)){
        return true;
    }
    if(!empty($left) && $left->value >= $root->value){
        return false;
    }
    if(!empty($right) && $right->value <= $root->value){
        return false;
    }
    //$root->left一定小于$root,$root->right一定大于$root,还有保证左边所有子树的节点值小于root,右边所有子树的节点值大于root
    return verifySearchTree2($root->left,$left,$root) && verifySearchTree2($root->right,$root,$right);
}


$node1 = new treeNode(10);
$node2 = new treeNode(6);
$node3 = new treeNode(20);
$node4 = new treeNode(4);
$node5 = new treeNode(8);
$node6 = new treeNode(15);
$node7 = new treeNode(22);
$node8 = new treeNode(5);
$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;
$node3->left = $node6;
$node3->right = $node7;
$node4->right = $node8;

var_dump(verifySearchTree($node1));
var_dump(verifySearchTree2($node1));