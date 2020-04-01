<?php

class ptreeNode{
    public $value;
    public $left;
    public $right;
    public $parent;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

/**
 * 给定一棵二叉树和其中一个节点,如何找出中序遍历序列的下一个节点,树中的节点除了有两个分别指向左右子节点的指针,还有一个指向父节点的指针
 * 如果该节点有右子树,那么它的下一个节点是它的右子树中的最左子节点
 * 如果该子节点没有右子树:
 *      如果该节点是其父节点的左子节点,那么它的下一个节点就是它的父节点
 *      如果该节点是其父节点的右子节点,那么它的下一个节点是其第一个祖先节点的父节点,前提是该祖先节点是其父节点的左子节点
 */

function getNextNode($node){
    if(empty($node)){
        echo "参数错误:节点为空";
        return null;
    }
    $next = null;
    if(!empty($node->right)){
        $nd = $node->right;
        while(!empty($nd->left)){
            $nd = $nd->left;
        }
        $next = $nd;
    }else{
        $cur = $node;
        $parent = $node->parent;
        while(!empty($parent) && $parent->left != $cur){
            $cur = $parent;
            $parent = $parent->parent;
        }
        $next = $parent;
    }
    return $next;
}

$root = new ptreeNode('a');
$b = new ptreeNode('b');
$c = new ptreeNode('c');
$d = new ptreeNode('d');
$e = new ptreeNode('e');
$f = new ptreeNode('f');
$g = new ptreeNode('g');
$h = new ptreeNode('h');
$i = new ptreeNode('i');

$root->left = $b;
$root->right = $c;
$b->left = $d;
$b->right = $e;
$b->parent = $root;
$c->left = $f;
$c->right = $g;
$c->parent = $root;
$e->left = $h;
$e->right = $i;
$d->parent = $b;
$e->parent = $b;
$f->parent = $c;
$g->parent = $c;
$h->parent = $e;
$i->parent = $e;


$next = getNextNode($b);
var_dump($next->value);
$next = getNextNode($d);
var_dump($next->value);
$next = getNextNode($h);
var_dump($next->value);
$next = getNextNode($i);
var_dump($next->value);
$next = getNextNode($root);
var_dump($next->value);
$next = getNextNode($g);
var_dump($next->value);