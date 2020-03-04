<?php
require_once 'treeNode.php';
require_once '../queue/myQueue.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/3
 * Time: 18:20
 */

//翻转二叉树

function turnTree($root){
    if(empty($root)){
        return;
    }
    swap($root->left,$root->right);
}

function swap(&$left,&$right){
    $temp = $left;
    $left = $right;
    $right = $temp;
    if(!empty($left)){
        swap($left->left,$left->right);
    }
    if(!empty($right)){
        swap($right->left,$right->right);
    }
}

function levelOrderTraverseTree($node){
    //利用队列,先进先出
    $mq = new myQueue();
    $mq->push($node);
    while(!$mq->isEmpty()){
        $nd = $mq->pop();
        echo $nd->value . " ";
        if(!empty($nd->left)){
            $mq->push($nd->left);
        }
        if(!empty($nd->right)){
            $mq->push($nd->right);
        }
    }
}

$node1 = new treeNode(1);
$node2 = new treeNode(2);
$node3 = new treeNode(3);
$node4 = new treeNode(4);
$node5 = new treeNode(5);
$node6 = new treeNode(6);
$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node3->left = $node5;
$node3->right = $node6;


turnTree($node1);
levelOrderTraverseTree($node1);


