<?php
//limit program php 
ini_set("memory_limit", "-1");
set_time_limit(0);

//show error 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('function.php');

//selete 

 $select['table'] = 'home';
 $data = select($select);
echo "<pre>";
 //var_dump($data);
echo "\n";
 foreach($data as $key => $val){
    echo "key : ".$key."\n";
    //var_dump($val);
    echo "name : ". $val['name']."\n";
    echo "========= \n";
 }
