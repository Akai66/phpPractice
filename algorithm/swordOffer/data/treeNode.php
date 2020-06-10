<?php

class treeNode{

    public $value;

    public $left;

    public $right;

    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * 层级遍历二叉树
     */
    function levelOrderTraverseTree(){
        $mq = new myQueue();
        $mq->push($this);
        while(!$mq->isEmpty()){
            $node = $mq->pop();
            echo $node->value . ' ';
            if($node->left != null){
                $mq->push($node->left);
            }
            if($node->right != null){
                $mq->push($node->right);
            }
        }
        echo "\n";
    }
}