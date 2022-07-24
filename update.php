<?php 


// data post

echo "<pre>";

$update['table'] = 'home';
$update['update'] = array('name'=>'kimhun55');
$update['where'] = array('id'=> 1);
var_dump($_POST);

include('function.php');



$total = update($update);

echo "<hr>";
var_dump($total);