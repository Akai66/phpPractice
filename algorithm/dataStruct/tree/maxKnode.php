<?php
require_once 'treeNode.php';
require_once '../stack/myStack.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/6
 * Time: 16:09
 */

//寻找二叉搜索树中第k大的值

//分析:中序遍历二叉搜索树,结果是有序的(从小到大),索引从0开始将遍历结果依次存储在hash表中,总数为n,第k大的值的索引为n-k

function findKmaxNode($root,$k){
    $sortedArr = array();
    $cur = $root;
    $ms = new myStack();
    while(!empty($cur) || !$ms->isEmpty()){
        if(!empty($cur)){
            $ms->push($cur);
            $cur = $cur->left;
        }else{
            $node = $ms->pop();
            $sortedArr[] = $node->value;
            $cur = $node->right;
        }
    }
    $len = count($sortedArr);
    if($k > $len){
        echo "params error\n";
        return false;
    }
    $ret = $sortedArr[$len-$k];
    return $ret;
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

var_dump(findKmaxNode($node1,6));
