<?php

class complexLinkNode{

    public $value;

    public $next;

    public $sibling;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function printLink(){
        echo $this->value;
        $node = $this->next;
        while($node != null){
            echo '->' . $node->value;
            $node = $node->next;
        }
        echo "\n";
    }
}