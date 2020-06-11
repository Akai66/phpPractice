<?php

require_once './data/stackNode.php';

class stackWithMin{

    private $dataStack;

    private $minStack;

    public function __construct(){
        $this->dataStack = new stackNode();
        $this->minStack = new stackNode();
    }

    public function push($value){
        $this->dataStack->push($value);
        if($this->minStack->size() == 0 || $value < $this->minStack->top()){
            $this->minStack->push($value);
        }else{
            $this->minStack->push($this->minStack->top());
        }
    }

    public function pop(){
        $ret = null;
        if($this->dataStack->size() > 0){
            $ret = $this->dataStack->pop();
        }
        if($this->minStack->size() > 0){
            $this->minStack->pop();
        }
        return $ret;
    }

    public function min(){
        $ret = null;
        if($this->dataStack->size() > 0 && $this->minStack->size() > 0){
            $ret = $this->minStack->top();
        }
        return $ret;
    }
}

$minStack = new stackWithMin();
$minStack->push(4);
$minStack->push(5);
$minStack->push(6);
echo $minStack->min();
$minStack->push(3);
echo $minStack->min();
$minStack->push(5);
echo $minStack->min();
echo $minStack->pop();
echo $minStack->min();
echo $minStack->pop();
echo $minStack->min();

