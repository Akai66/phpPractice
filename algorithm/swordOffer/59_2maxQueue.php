<?php
require_once './data/queueNode.php';

/**
 * 实现一个带最大值方法的队列
 */

class maxQueue{

    private $dataQueue;

    private $maxQueue;

    private $curIndex;

    function __construct()
    {
        $this->dataQueue = new queueNode();
        $this->maxQueue = new queueNode();
        $this->curIndex = 0;
    }

    function push($value){
        $node = new Node($value,$this->curIndex);
        while(!$this->maxQueue->isEmpty() && $value > $this->maxQueue->back()->value){
            $this->maxQueue->pop_back();
        }
        $this->dataQueue->push($node);
        $this->maxQueue->push($node);
        $this->curIndex++;
    }

    function pop(){
        if($this->maxQueue->isEmpty()){
            throw new Exception('queue is empty');
        }
        if($this->dataQueue->front()->index == $this->maxQueue->front()->index){
            $this->maxQueue->pop();
        }
        return $this->dataQueue->pop()->value;
    }

    function max(){
        if($this->maxQueue->isEmpty()){
            throw new Exception('queue is empty');
        }
        return $this->maxQueue->front()->value;
    }
}

class Node{
    public $value;
    public $index;

    function __construct($value,$index)
    {
        $this->value = $value;
        $this->index = $index;
    }
}

$maxQ = new maxQueue();
$maxQ->push(1);
$maxQ->push(3);
$maxQ->push(2);
echo $maxQ->max() . ' ';
echo $maxQ->pop() . ' ';
echo $maxQ->max() . ' ';
echo $maxQ->pop() . ' ';
echo $maxQ->max() . ' ';
