<?php
require_once 'treeNode.php';
require_once '../queue/myQueue.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/6
 * Time: 18:02
 */

//寻找二叉树中距离根节点k个距离的节点集合

//分析:利用二叉树层次遍历,第一层的距离为0,第二层的距离为1,...

function findDistanceKnode($root,$k){
    $i = 0;
    $mq = new myQueue();
    $mq->push($root);
    $result = array();
    while(!$mq->isEmpty() && $i <= $k){
        $count = $mq->count();
        while ($count > 0){
            $node = $mq->pop();
            if($i == $k){
                $result[] = $node->value;
            }
            if(!empty($node->left)){
                $mq->push($node->left);
            }
            if(!empty($node->right)){
                $mq->push($node->right);
            }
            $count--;
        }
        $i++;
    }
    return $result;
}

$node1 = new treeNode(1);
$node2 = new treeNode(2);
$node3 = new treeNode(3);
$node4 = new treeNode(4);
$node5 = new treeNode(5);
$node6 = new treeNode(6);
$node7 = new treeNode(7);
$node8 = new treeNode(8);
$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;
$node3->left = $node6;
$node3->right = $node7;
$node4->right = $node8;

print_r(findDistanceKnode($node1,2));