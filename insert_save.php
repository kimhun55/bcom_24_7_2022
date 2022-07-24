<?php 


// data post

echo "<pre>";
var_dump($_POST);

echo 1;

include('function.php');

$data['table'] = 'home';

//set datetime
$_POST['datetime'] = date("Y-m-d H:i:s");

$data['insert'] = $_POST;

$insert = insert($data);

echo 2;

echo "<hr>";
var_dump($insert);