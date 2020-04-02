<?php
require_once "../dataStruct/stack/myStack.php";

/**
 * 使用两个栈实现队列,栈的特点是后进先出,队列的特点是先进先出
 */

class diyQueue{
    private $inStack;
    private $outStack;

    public function __construct()
    {
        $this->inStack = new myStack();
        $this->outStack = new myStack();
    }

    function push($value){
        $this->inStack->push($value);
    }

    function pop(){
        if($this->outStack->isEmpty()){
            while(!$this->inStack->isEmpty()){
                $value = $this->inStack->pop();
                $this->outStack->push($value);
            }
        }
        if(!$this->outStack->isEmpty()){
            $value = $this->outStack->pop();
            return $value;
        }
        return null;
    }
}

$queue = new diyQueue();
$queue->push(1);
$queue->push(2);
$queue->push(3);
var_dump($queue->pop());
$queue->push(4);
var_dump($queue->pop());
var_dump($queue->pop());
var_dump($queue->pop());
$queue->push(5);
var_dump($queue->pop());
