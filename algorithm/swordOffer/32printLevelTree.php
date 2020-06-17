<?php
require_once './data/treeNode.php';
require_once './data/queueNode.php';
require_once './data/stackNode.php';

/**
 * 从上到下打印二叉树，同一层级的节点按照从左到右的顺序打印
 */
function printFromTopToBottom($root){
    if($root == null){
        return;
    }
    $mq = new queueNode();
    $mq->push($root);
    while(!$mq->isEmpty()){
        $pNode = $mq->pop();
        echo $pNode->value . ' ';
        if($pNode->left != null){
            $mq->push($pNode->left);
        }
        if($pNode->right != null){
            $mq->push($pNode->right);
        }
    }
    echo "\n";
}

/**
 * 按层级从上到下打印二叉树，同一层级的节点按照从左到右的顺序打印，每个层级打印在一行
 */
function printLevelTree($root){
    if($root == null){
        return;
    }
    $mq = new queueNode();
    $mq->push($root);
    $count = 1;
    $nextCount = 0;
    while(!$mq->isEmpty()){
        $pNode = $mq->pop();
        echo $pNode->value . ' ';
        $count--;
        if($pNode->left != null){
            $mq->push($pNode->left);
            $nextCount++;
        }
        if($pNode->right != null){
            $mq->push($pNode->right);
            $nextCount++;
        }
        if($count == 0){
            echo "\n";
            $count = $nextCount;
            $nextCount = 0;
        }
    }
}

/**
 * "之"字行打印,第一行从左到右打印,第二行从右到左打印,第三行从左到右打印,以此类推...
 */

function printCycleTree($root){
    if($root == null){
        return;
    }
    //利用双栈,后进先出
    $current = 0;
    $next = 1;
    $stack1 = new stackNode();
    $stack2 = new stackNode();
    $stack1->push($root);
    $stackArr = array($stack1,$stack2);
    while(!$stackArr[$current]->isEmpty() || !$stackArr[$next]->isEmpty()){
        $pNode = $stackArr[$current]->pop();
        echo $pNode->value . ' ';
        if($current == 0){
            //push的时候先左后右,pop的时候先右后左
            if($pNode->left != null){
                $stackArr[$next]->push($pNode->left);
            }
            if($pNode->right != null){
                $stackArr[$next]->push($pNode->right);
            }
        }else{
            //push的时候先右后左,pop的时候先左后右
            if($pNode->right != null){
                $stackArr[$next]->push($pNode->right);
            }
            if($pNode->left != null){
                $stackArr[$next]->push($pNode->left);
            }
        }
        if($stackArr[$current]->isEmpty()){
            echo "\n";
            $current = 1-$current;
            $next = 1-$next;
        }
    }
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
$node10 = new treeNode(10);
$node11 = new treeNode(11);
$node12 = new treeNode(12);
$node13 = new treeNode(13);
$node14 = new treeNode(14);
$node15 = new treeNode(15);

$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;
$node3->left = $node6;
$node3->right = $node7;
$node4->left = $node8;
$node4->right = $node9;
$node5->left = $node10;
$node5->right = $node11;
$node6->left = $node12;
$node6->right = $node13;
$node7->left = $node14;
$node7->right = $node15;

printFromTopToBottom($node1);
printLevelTree($node1);
printCycleTree($node1);