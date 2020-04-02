<?php
require_once "../dataStruct/queue/myQueue.php";

/**
 * 利用两个队列实现栈
 */

class diyStack{
    private $queue;
    private $helpQueue;

    public function __construct()
    {
        $this->queue = new myQueue();
        $this->helpQueue = new myQueue();
    }

    public function push($value){
        $this->queue->push($value);
    }

    public function pop(){
        $ret = null;
        if(!$this->queue->isEmpty()){
            while($this->queue->count() > 1){
                $value = $this->queue->pop();
                $this->helpQueue->push($value);
            }
            $ret = $this->queue->pop();
            $this->swap();
        }
        return $ret;
    }

    private function swap(){
        $tmp = $this->queue;
        $this->queue = $this->helpQueue;
        $this->helpQueue = $tmp;
    }
}

$stack = new diyStack();
$stack->push(1);
$stack->push(2);
$stack->push(3);
var_dump($stack->pop());
$stack->push(4);
var_dump($stack->pop());
var_dump($stack->pop());
$stack->push(5);
var_dump($stack->pop());
var_dump($stack->pop());
var_dump($stack->pop());