<?php

/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/2/24
 * Time: 21:50
 */
class myQueue
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