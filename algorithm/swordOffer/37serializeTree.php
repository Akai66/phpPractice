<?php
require_once './data/treeNode.php';
require_once './data/queueNode.php';
/**
 * 请实现两个函数,分别用来序列化和反序列化二叉树
 */

function mySerialize($root){
    $arr = [];
    serializeCore($root,$arr);
    return implode(',',$arr);
}

function serializeCore($root,&$arr){
    if($root == null){
        $arr[] = '$';
    }else{
        $arr[] = $root->value;
        serializeCore($root->left,$arr);
        serializeCore($root->right,$arr);
    }
}

function myUnserialize($str){
    if(empty($str)){
        return null;
    }
    $root = null;
    $arr = explode(',',$str);
    unSerializeCore($root,$arr);
    return $root;
}

function unSerializeCore(&$root,&$arr){
    if(empty($arr)){
        return;
    }
    $value = array_shift($arr);
    if(is_numeric($value)){
        $root = new treeNode($value);
        unSerializeCore($root->left,$arr);
        unSerializeCore($root->right,$arr);
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

$str = mySerialize($node1);
echo $str . "\n";

$root = myUnserialize($str);
$root->levelOrderTraverseTree();
