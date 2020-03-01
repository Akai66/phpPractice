<?php

/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/2/23
 * Time: 19:30
 */
class treeNode
{
    public $left;
    
    public $right;
    
    public $value;
    
    public function __construct($value)
    {   
        $this->value = $value;
    }
}