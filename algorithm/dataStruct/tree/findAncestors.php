<?php
require_once 'treeNode.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/8
 * Time: 19:47
 */

//寻找二叉树给定节点的祖先

//分析:从上到下进行递归,左子树或右子树中有任意一个包含给定节点,则该节点是给定节点的祖先

function findAncestors($root,$target,&$result){
    if(empty($root) || empty($target)){
        return false;
    }
    //当使用比较运算符（==）比较两个对象变量时，比较的原则是：如果两个对象的属性和属性值 都相等，而且两个对象是同一个类的实例，那么这两个对象变量相等
    //而如果使用全等运算符（===），这两个对象变量一定要指向某个类的同一个实例（即同一个对象)
    if($root === $target){
        return true;
    }
    if(findAncestors($root->left,$target,$result) || findAncestors($root->right,$target,$result)){
        $result[] = $root->value;
        return true;
    }
    return false;
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

$result = array();
findAncestors($node1,$node8,$result);
print_r($result);