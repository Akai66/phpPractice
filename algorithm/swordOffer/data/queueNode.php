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

    /**
     * 从队列尾部添加
     * @param $value
     */
    function push($value){
        array_push($this->arr,$value);
    }

    /**
     * 删除队列头部元素
     * @return bool|mixed
     */
    function pop(){
        $length = $this->count();
        if($length <= 0){
            return false;
        }
        return array_shift($this->arr);
    }

    /**
     * 删除队列尾部元素
     * @return bool|mixed
     */
    function pop_back(){
        $length = $this->count();
        if($length <= 0){
            return false;
        }
        return array_pop($this->arr);
    }

    /**
     * 获取队列头部元素
     * @return bool|mixed
     */
    function front(){
        $length = $this->count();
        if($length <= 0){
            return false;
        }
        return $this->arr[0];
    }

    /**
     * 获取队列尾部元素
     * @return bool|mixed
     */
    function back(){
        $length = $this->count();
        if($length <= 0){
            return false;
        }
        return $this->arr[$length-1];
    }
}