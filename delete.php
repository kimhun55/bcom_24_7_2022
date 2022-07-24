<?php 


// data post

 echo "<pre>";

 $data['table'] = 'home';
 $data['where'] = array('id'=> 1);


 include('function.php');

 $total = delete($data);

 echo "<hr>";
 var_dump($total);
