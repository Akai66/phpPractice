<?php
require_once './data/maxHeap.php';
require_once './data/minHeap.php';

/**
 * 获取数据流中的中位数,如果数据流中读出奇数个数字,那么中位数是所有数字排序后,位于中间的数字,
 * 如果数据流中读出偶数个数字,那么中位数是所有数字排序后,中间两个数字的平均数
 */

class dynamicArray{
    private $min;
    private $max;

    function __construct(){
        $this->min = new minHeap();
        $this->max = new maxHeap();
    }

    public function insert($value){
        //偶数个时,往min中push,奇数个时往max中push
        if((($this->min->size() + $this->max->size()) & 1) == 0){
            //需要判断当前数字是否小于max中的最大值,如果是,则需要先交换出max中的最大值,然后将最大值push到min
            $targetValue = $value;
            if($this->max->size() > 0 && $value < $this->max->peek()){
                $targetValue = $this->max->pop();
                $this->max->push($value);
            }
            $this->min->push($targetValue);
        }else{
            //同理
            $targetValue = $value;
            if($this->min->size() > 0 && $value > $this->min->peek()){
                $targetValue = $this->min->pop();
                $this->min->push($value);
            }
            $this->max->push($targetValue);
        }
    }

    public function getMedian(){
        $size = $this->min->size()+$this->max->size();
        if($size <= 0){
            throw new Exception('stream is empty');
        }
        if(($size & 1) == 0){
            //偶数
            $result = ($this->min->peek()+$this->max->peek())/2;
        }else{
            //奇数
            $result = $this->min->peek();
        }
        return $result;
    }
}

$dyArr = new dynamicArray();
$dyArr->insert(3);
echo $dyArr->getMedian() . ' ';
$dyArr->insert(5);
echo $dyArr->getMedian() . ' ';
$dyArr->insert(2);
echo $dyArr->getMedian() . ' ';
$dyArr->insert(4);
echo $dyArr->getMedian() . ' ';

//$mh = new minHeap();
//$mh->push(5);
//echo $mh->peek() . ' ';
//$mh->push(4);
//echo $mh->peek() . ' ';
//$mh->push(3);
//echo $mh->peek() . ' ';
//$mh->push(4);
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';
//$mh->push(-1);
//echo $mh->peek() . ' ';
//$mh->push(2);
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';
//echo $mh->pop() . ' ';
//echo $mh->peek() . ' ';