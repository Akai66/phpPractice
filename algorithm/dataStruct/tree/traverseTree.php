<?php
require_once './treeNode.php';
require_once '../stack/myStack.php';
require_once '../queue/myQueue.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/2/23
 * Time: 19:39
 */
//均是站在根节点的角度命名
//先序遍历:先访问根节点，然后访问左节点，最后访问右节点(根->左->右)
//中序遍历:先访问左节点，然后访问根节点，最后访问右节点(左->根->右)
//后序遍历:先访问左节点，然后访问右节点，最后访问根节点(左->右->根)

//遍历的实现有两种
//1.递归
//2.非递归,利用栈实现

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

//先序遍历
function preTraverseTree($node){
    //递归
    if(!empty($node)){
        echo $node->value . " ";
        preTraverseTree($node->left);
        preTraverseTree($node->right);
    }
}

function preTraverseTree2($node){
    //非递归,利用栈
    $mt = new myStack();
    $mt->push($node);
    while (!$mt->isEmpty()){
        $nd = $mt->pop();
        echo $nd->value . " ";
        if(!empty($nd->right)){
            $mt->push($nd->right);
        }
        if(!empty($nd->left)){
            $mt->push($nd->left);
        }
    }
}

preTraverseTree($node1);
echo "\n";
preTraverseTree2($node1);
echo "\n";

//中序遍历
function inorderTraverseTree($node){
    //递归
    if(!empty($node)){
        inorderTraverseTree($node->left);
        echo $node->value . " ";
        inorderTraverseTree($node->right);
    }
}


function inorderTraverseTree2($node){
    $mt = new myStack();
    $cur = $node;
    while(!empty($cur) || !$mt->isEmpty()){
        if(!empty($cur)){
            $mt->push($cur);
            $cur = $cur->left;
        }else{
            $nd = $mt->pop();
            echo $nd->value . " ";
            $cur = $nd->right;
        }
    }
}

inorderTraverseTree($node1);
echo "\n";
inorderTraverseTree2($node1);
echo "\n";


//后序遍历
function postOrderTraverseTree($node){
    //递归
    if(!empty($node)){
        postOrderTraverseTree($node->left);
        postOrderTraverseTree($node->right);
        echo $node->value . " ";
    }
}

function postOrderTraverseTree2($node){
    //利用双栈,利用左右中的相反是中右左,按照中右左遍历,将结果添加到栈中,根据栈后进先出的特点,实现左右中
    $mt1 = new myStack();
    $mt2 = new myStack();
    $mt1->push($node);
    while (!$mt1->isEmpty()){
        $nd = $mt1->pop();
        $mt2->push($nd);
        if(!empty($nd->left)){
            $mt1->push($nd->left);
        }
        if(!empty($nd->right)){
            $mt1->push($nd->right);
        }
    }
    while(!$mt2->isEmpty()){
        $nd = $mt2->pop();
        echo $nd->value . " ";
    }
}

postOrderTraverseTree($node1);
echo "\n";
postOrderTraverseTree2($node1);
echo "\n";

//层次遍历
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

//给定一个二叉树，返回其按层次遍历的节点值。 （即逐层地，从左到右访问所有节点）
//    3
//    / \
//    9  20
//    /  \
//    15   7
//[
//    [3],
//    [9,20],
//    [15,7]
//]
function levelOrderTraverseTree2($node){
    $mq = new myQueue();
    $res = array();
    $mq->push($node);
    while(!$mq->isEmpty()){
        $count = $mq->count();
        $levelRes = array();
        while($count > 0){
            $nd = $mq->pop();
            $levelRes[] = $nd->value;
            if(!empty($nd->left)){
                $mq->push($nd->left);
            }
            if(!empty($nd->right)){
                $mq->push($nd->right);
            }
            $count--;
        }
        $res[] = $levelRes;
    }
    return $res;
}

levelOrderTraverseTree($node1);

echo "\n";

echo json_encode(levelOrderTraverseTree2($node1));