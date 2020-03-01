<?php

/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/2/23
 * Time: 22:30
 */

//php数组实现栈,后进先出

class myStack
{
    private $arr = array();
    
    public function __construct(){}
    
    public function count(){
        return count($this->arr);
    }
    
    public function isEmpty(){
        return empty($this->arr) ? true : false;
    }
    
    public function push($value){
        array_unshift($this->arr,$value);
    }
    
    public function pop(){
        $ret = array_shift($this->arr);
        return $ret;
    }

}