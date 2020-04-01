<?php

/*
 * 题目描述:
 * 实现单例模式,需要考虑并发的情况
 */

class Singleton{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(){
        if(self::$instance == null){
            //加锁操作很耗时，所以只有$instance为null时才执行加锁操作
            if(self::lock()){
                if(self::$instance == null){
                    self::$instance = new Singleton();
                }
            }
        }
        return self::$instance;
    }

    //伪代码,实现加锁功能
    private static function lock(){
        return true;
    }
}

