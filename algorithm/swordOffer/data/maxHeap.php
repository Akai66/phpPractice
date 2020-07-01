<?php

/**
 * 利用php数组实现大顶堆
 */

class maxHeap{
    private $arr;
    private $size;

    function __construct(){
        $this->size = 0;
    }

    public function Size(){
        return $this->size;
    }

    public function push($value){
        $this->arr[$this->size] = $value;
        $this->size++;
        $this->upAdjust();
    }

    public function pop(){
        if($this->size <= 0){
            throw new Exception('heap is empty');
        }
        $max = $this->arr[0];
        $this->arr[0] = $this->arr[$this->size-1];
        $this->size--;
        $this->downAdjust(0);
        return $max;
    }

    public function peek(){
        if($this->size <= 0){
            throw new Exception('heap is empty');
        }
        return $this->arr[0];
    }

    private function upAdjust(){
        $childIndex = $this->size-1;
        $parentIndex = floor(($childIndex-1)/2);
        $temp = $this->arr[$childIndex];
        while($childIndex > 0 && $temp > $this->arr[$parentIndex]){
            $this->arr[$childIndex] = $this->arr[$parentIndex];
            $childIndex = $parentIndex;
            $parentIndex = floor(($parentIndex-1)/2);
        }
        $this->arr[$childIndex] = $temp;
    }

    private function downAdjust($index){
        $parentIndex = $index;
        $childIndex = $index*2+1;
        $temp = $this->arr[$parentIndex];
        while($childIndex < $this->size){
            if($childIndex+1<$this->size && $this->arr[$childIndex+1] > $this->arr[$childIndex]){
                $childIndex = $childIndex+1;
            }
            if($this->arr[$childIndex] < $temp){
                break;
            }
            $this->arr[$parentIndex] = $this->arr[$childIndex];
            $parentIndex = $childIndex;
            $childIndex = $childIndex*2+1;
        }
        $this->arr[$parentIndex] = $temp;
    }

}