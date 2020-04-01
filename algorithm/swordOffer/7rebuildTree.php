<?php
require_once "../dataStruct/tree/treeNode.php";

/**
 * 输入二叉树前序遍历和中序遍历的结果,请重建该二叉树,假设输入的前序遍历和中序遍历结果中不包含重复的数字
 */

function rebuildTree($preArr,$inArr){
    if(empty($preArr) || empty($inArr)){
        echo '参数错误:数组为空';
        return false;
    }
    $preCount = count($preArr);
    $inCount = count($inArr);
    if($preCount != $inCount){
        echo "参数错误:数组个数不一致";
        return false;
    }
    $root = getRoot($preArr,0,$preCount-1,$inArr,0,$inCount-1);
    return $root;
}

function getRoot($preArr,$preStart,$preEnd,$inArr,$inStart,$inEnd){
    if($preStart > $preEnd || $inStart > $inEnd){
        return null;
    }
    $root = new treeNode($preArr[$preStart]);
    for($i=$inStart;$i<=$inEnd;$i++){
        if($inArr[$i] == $preArr[$preStart]){
            $root->left = getRoot($preArr,$preStart+1,$preStart+$i-$inStart,$inArr,$inStart,$i-1);
            $root->right = getRoot($preArr,$preStart+$i-$inStart+1,$preEnd,$inArr,$i+1,$inEnd);
            break;
        }
    }
    return $root;
}
