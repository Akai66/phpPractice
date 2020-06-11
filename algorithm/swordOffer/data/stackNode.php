<?php

class stackNode{

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

    public function size(){
        return count($this->arr);
    }

    public function top(){
        if(!$this->isEmpty()){
            return $this->arr[0];
        }
        return null;
    }
}