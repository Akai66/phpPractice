<?php

//利用数组实现小顶堆

class minHeap{
    private $arr;
    private $size;
    
    function __construct(){
        $this->size = 0;
    }
    
    function size(){
        return $this->size;
    }
    
    function push($value){
        $this->arr[$this->size] = $value;
        $this->size++;
        $this->upAdjust();
    }
    
    function pop(){
        if($this->size <= 0){
            throw new Exception('heap is empty');
        }
        $min = $this->arr[0];
        $this->arr[0] = $this->arr[$this->size-1];
        $this->size--;
        $this->downAdjust(0);
        return $min;
    }
    
    function peek(){
        if($this->size <= 0){
            throw new Exception('heap is empty');
        }
        return $this->arr[0];
    }
    
    function upAdjust(){
        $childIndex = $this->size-1;
        $parentIndex = floor(($childIndex-1)/2);
        $temp = $this->arr[$childIndex];
        while($childIndex > 0 && $temp < $this->arr[$parentIndex]){
            $this->arr[$childIndex] = $this->arr[$parentIndex];
            $childIndex = $parentIndex;
            $parentIndex = floor(($parentIndex-1)/2);
        }
        $this->arr[$childIndex] = $temp;
    }

    function downAdjust($index){
        $parentIndex = $index;
        $childIndex = $parentIndex*2+1;
        $temp = $this->arr[$parentIndex];
        while($childIndex < $this->size){
            if($childIndex+1 < $this->size && $this->arr[$childIndex+1] < $this->arr[$childIndex]){
                $childIndex = $childIndex+1;
            }
            if($this->arr[$childIndex] > $temp){
                break;
            }
            $this->arr[$parentIndex] = $this->arr[$childIndex];
            $parentIndex = $childIndex;
            $childIndex = $childIndex*2+1;
        }
        $this->arr[$parentIndex] = $temp;
    }
}