<?php
require_once 'treeNode.php';
require_once '../stack/myStack.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/8
 * Time: 20:40
 */

//寻找二叉树给定两个节点的最近公共祖先
//分析,利用栈分别记录节点到根节点的路径,遍历两个数组,获取路径中第一个相同的节点即为最近公共祖先
//时间复杂度是O(n)
function getAncestor($root,$target,&$stack){
    if(empty($root) || empty($target)){
        return false;
    }
    if($root === $target){
        $stack->push($target);
        return true;
    }
    if(getAncestor($root->left,$target,$stack) || getAncestor($root->right,$target,$stack)){
        $stack->push($root);
        return true;
    }
    return false;
}

function findLCA($root,$node1,$node2){
    if(empty($root) || empty($node1) || empty($node2)){
        return false;
    }
    $stack1 = new myStack();
    $stack2 = new myStack();
    getAncestor($root,$node1,$stack1);
    getAncestor($root,$node2,$stack2);
    $ret = false;
    while(!$stack1->isEmpty() && !$stack2->isEmpty()){
        $nd1 = $stack1->pop();
        $nd2 = $stack2->pop();
        if($nd1 === $nd2){
            $ret = $nd1;
        }else{
            break;
        }
    }
    return $ret;
}


$node1 = new treeNode(1);
$node2 = new treeNode(2);
$node3 = new treeNode(3);
$node4 = new treeNode(4);
$node5 = new treeNode(5);
$node6 = new treeNode(8);
$node7 = new treeNode(7);
$node8 = new treeNode(8);
$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;
$node3->left = $node6;
$node3->right = $node7;
$node4->right = $node8;

$ret = findLCA($node1,$node4,$node5);
var_dump($ret->value);
$ret = findLCA($node1,$node4,$node8);
var_dump($ret->value);


//变种1,寻找二叉搜索树给定两个节点的最近公共祖先
//分析:对于二叉搜索树,节点左子树的值一定小于该节点,右子树的值一定大于该节点,从根节点开始寻找,如果给定两个节点的值均大于根节点的值,那么两个节点一定都在右子树,如果给定两个节点的值均小于根节点的值,那么两个节点一定都在左子树
//一个大于,一个小于,该节点即为最近公共祖先
//时间复杂度O(n)

function findSearchLCA($root,$node1,$node2){
    if(empty($root) || empty($node1) || empty($node2)){
        return false;
    }
    if($root->value > $node1->value && $root->value > $node2->value){
        return findSearchLCA($root->left,$node1,$node2);
    }
    if($root->value < $node1->value && $root->value < $node2->value){
        return findSearchLCA($root->right,$node1,$node2);
    }
    return $root;
}

$node1 = new treeNode(8);
$node2 = new treeNode(5);
$node3 = new treeNode(15);
$node4 = new treeNode(3);
$node5 = new treeNode(6);
$node6 = new treeNode(10);
$node7 = new treeNode(20);
$node8 = new treeNode(9);
$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;
$node3->left = $node6;
$node3->right = $node7;
$node6->left = $node8;

$ret = findSearchLCA($node1,$node6,$node8);
var_dump($ret->value);


//变种2,寻找普通树给定两个节点的最近公共祖先
//分析:node对象新增记录父节点的字段,转换为两个单向链表求交点的问题






