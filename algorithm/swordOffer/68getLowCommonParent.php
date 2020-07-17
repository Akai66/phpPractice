<?php
require_once './data/treeNode.php';

/**
 * 题目描述:获取树中两个节点的最低公共祖先
 */

//题目一:如果是二叉搜索树,从树的根节点开始遍历,如果根节点的值大于两个节点的值,则继续遍历根节点的左孩子,如果根节点的值小于两个节点的值,则继续遍历根节点的右孩子
//直到遍历到第一个节点,该节点的值在两个节点之间,则该节点为这两个节点的最低公共祖先


//题目二:如果不是二叉搜索树,也不是二叉树,但是每个节点有指向其父节点的指针,那么可以将问题转化为求两个链表的第一个公共节点,先分别计算连个链表的长度,然后计算长度
//的差值d,长链表先往前走d步,然后两个链表同时往前走,第一个相同的节点即为第一个公共节点


//题目三:如果不是二叉搜索树,也不是二叉树,节点也没有指向其父节点的指针,那么可以将问题转化为求两个链表的最后一个公共节点,先寻找根节点分别到这两个节点的路径,然后
//遍历这两个路径,寻找最后一个相同的节点


function getLowCommonParent($root,$node1,$node2){
    if($root == null || $node1 == null || $node2 == null){
        return null;
    }
    $path1 = $path2 = array();
    $result1 = getNodePath($root,$node1,$path1);
    $result2 = getNodePath($root,$node2,$path2);
    if(!($result1 && $result2)){
        return null;
    }
    $node = getCommonNode($path1,$path2);
    return $node;
}

function getNodePath($root,$node,&$path){
    if($root == $node){
        return true;
    }
    $found = false;
    $path[] = $root;
    if($root->left != null){
        $found = getNodePath($root->left,$node,$path);
    }
    if(!$found && $root->right != null){
        $found = getNodePath($root->right,$node,$path);
    }
    if(!$found){
        array_pop($path);
    }
    return $found;
}

function getCommonNode($path1,$path2){
    $node = null;
    for($i=0;$i<count($path1) && $i<count($path2);$i++){
        if($path1[$i] == $path2[$i]){
            $node = $path1[$i];
        }else{
            break;
        }
    }
    return $node;
}

$node1 = new treeNode('A');
$node2 = new treeNode('B');
$node3 = new treeNode('C');
$node4 = new treeNode('D');
$node5 = new treeNode('E');
$node6 = new treeNode('F');
$node7 = new treeNode('G');
$node8 = new treeNode('H');
$node9 = new treeNode('I');
$node10 = new treeNode('J');
$node1->left = $node2;
$node1->right = $node3;
$node2->left = $node4;
$node2->right = $node5;
$node4->left = $node6;
$node4->right = $node7;
$node5->left = $node8;
$node5->right = $node9;
var_dump(getLowCommonParent($node1,$node6,$node7));