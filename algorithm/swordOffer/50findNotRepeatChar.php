<?php

/**
 * 题目描述:寻找字符串中第一个只出现一次的字符
 */


//利用hash表
function findNotRepeatChar($str){
    if(empty($str)){
        return false;
    }
    $hashTable = array();
    for($i=0;$i<strlen($str);$i++){
        if(!isset($hashTable[$str[$i]])){
            $hashTable[$str[$i]] = 1;
        }else{
            $hashTable[$str[$i]]++;
        }
    }
    for($i=0;$i<strlen($str);$i++){
        if($hashTable[$str[$i]] == 1){
            return $str[$i];
        }
    }
    return false;
}


/**
 * 题目描述:数据流中第一个只出现一次的字符
 */
class charStream{
    private $index;
    private $hashTable;

    function __construct(){
        $this->index = 0;
        $this->hashTable = array();
    }

    function insert($char){
        if(!isset($this->hashTable[$char])){
            $this->hashTable[$char] = $this->index;
        }else{
            $this->hashTable[$char] = -1;//重复后,设置为-1
        }
        $this->index++;
    }

    function getFirstNotRepeatChar(){
        $result = false;
        $min = $this->index;
        foreach ($this->hashTable as $char => $index){
            if($index >= 0 && $index < $min){
                $result = $char;
                $min = $index;
            }
        }
        return $result;
    }
}


$str = 'acdgeidgaec';
var_dump(findNotRepeatChar($str));

$stream = new charStream();
$stream->insert('a');
var_dump($stream->getFirstNotRepeatChar());
$stream->insert('b');
var_dump($stream->getFirstNotRepeatChar());
$stream->insert('c');
var_dump($stream->getFirstNotRepeatChar());
$stream->insert('a');
var_dump($stream->getFirstNotRepeatChar());
$stream->insert('b');
var_dump($stream->getFirstNotRepeatChar());
$stream->insert('c');
var_dump($stream->getFirstNotRepeatChar());
$stream->insert('d');
var_dump($stream->getFirstNotRepeatChar());