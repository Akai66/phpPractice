<?php

class queueNode
{
    private $arr = array();
    
    public function __construct(){}

    function count(){
        return count($this->arr);
    }
    
    function isEmpty(){
        return empty($this->arr) ? true : false;
    }
    
    function push($value){
        array_push($this->arr,$value);
    }
    
    function pop(){
        return array_shift($this->arr);
    }

}