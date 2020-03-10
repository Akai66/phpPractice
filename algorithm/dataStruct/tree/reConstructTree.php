<?php
require_once 'treeNode.php';
require_once '../queue/myQueue.php';
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/3/9
 * Time: 21:59
 */

//输入某二叉树的前序遍历和中序遍历的结果，请重建出该二叉树。
//假设输入的前序遍历和中序遍历的结果中都不含重复的数字。
//例如输入前序遍历序列{1,2,4,7,3,5,6,8}和中序遍历序列{4,7,2,1,5,3,8,6}，则重建二叉树并返回.

//分析
//1.前序排列顺序为 根-左-右，中序排列为左-根-右。
//2.那么如题根为1。
//3.则根据中序遍历序列则可以得到左子树{4,7,2,}和右子树{5,3,8,6}。
//4.又根据前序遍历则可以得到左子树的根为2，右子树的根为3。
//5.重复3,4步
//6.直到左右子树皆为空时即可重建二叉树

function reConstructTree($preArr,$inArr){
    if(empty($preArr) || empty($inArr)){
        return null;
    }
    $root = getRoot($preArr,0,count($preArr)-1,$inArr,0,count($inArr)-1);
    return $root;
}

function getRoot($preArr,$preStart,$preEnd,$inArr,$inStart,$inEnd){
    if($preStart > $preEnd || $inStart > $inEnd){
        return null;
    }
    $root = new treeNode($preArr[$preStart]);
    for($i=$inStart;$i<=$inEnd;$i++){
        if($inArr[$i] == $preArr[$preStart]){
            //获取左子树的根节点,将中序遍历数组根据根节点分隔为左右两个子树,左子树的先序遍历数组为原始先序遍历数组索引起始值$preStart+1到结束值$preStart+$i-$inStart(可以理解成$preStart加上左子树的节点个数)的部分,
            //左子树的中序遍历数组即为原始中序遍历数组索引起始值$inStart到结束值$i-1的部分
            $root->left = getRoot($preArr,$preStart+1,$preStart+$i-$inStart,$inArr,$inStart,$i-1);
            //同理求得右子树的先序遍历数组和中序遍历数组
            $root->right = getRoot($preArr,$preStart+$i-$inStart+1,$preEnd,$inArr,$i+1,$inEnd);
            break;
        }
    }
    return $root;
}

//二叉树层次遍历
function levelTraverseTree($root){
    $mq = new myQueue();
    $mq->push($root);
    while(!$mq->isEmpty()){
        $node = $mq->pop();
        echo $node->value . ' ';
        if(!empty($node->left)){
            $mq->push($node->left);
        }
        if(!empty($node->right)){
            $mq->push($node->right);
        }
    }
}


$preArr = array(1,2,4,7,3,5,6,8);
$inArr = array(4,7,2,1,5,3,8,6);
$root = reConstructTree($preArr,$inArr);
levelTraverseTree($root);
var_dump($root->left->left->right->value);

