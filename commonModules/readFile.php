<?php
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 18/5/22
 * Time: 17:04
 */
$ditchs = array();
for($i=12031;$i<=12075;$i++){
    $ditchs[] = "'$i'";
}
$lines = file('./data/nums.txt');
foreach ($lines as &$line){
    $line = str_replace("\n",'',$line);
    $line = "'$line'";
}
$ditchs = array_merge($ditchs,$lines);
echo implode(",\n",$ditchs);

