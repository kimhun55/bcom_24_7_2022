<?php 

//setup 
$localhost = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'bcom';

//connect db
$mysqli = new mysqli($localhost,$username,$password,$dbname);
$mysqli -> set_charset("utf8");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}


function sql_where($data){
    //$data = array('limit ' => 1);

    if( $data === false ){
        return false;
    }
    
    foreach($data as $key => $value){
        if(strpos($key," ") === false){
            $where[] = "`".$key."`='".$value."'"; 
        }else{
           $w =  explode(' ',$key);
            $where[] = "`".$w[0]."` ".$w[1]."'".$value."'"; 
        }
    }

    if(count($where) == 0) return false; 

    $text_where = " WHERE ".implode(' and ',$where);

    return $text_where;
}


function select($data){
    global $mysqli;
    /*requet
    $data['table'] = value
   // $data['limit'] = array('fil'=>val)
    $data['select']= array('f1','f2')
    $data['where'] = array('id'=> 1) // id = 1
    'id like' =>  'txt' // id like '%text%'
    */

    if(is_null($data['table']) || !isset($data['table'])){
        echo "error table";
        return false;
    }

    if(is_null(@$data['select'])){
        $data['select'] = array('*');
    }

    if(is_null(@$data['limti'])){
        $data['limti'] = false;
    }

    if(is_null(@$data['where'])){
        $data['where'] = false;
    }


    $where = sql_where(@$data['where']);

    $sql = "SELECT ".implode(',',$data['select'])." FROM ".$data['table'];

    if($where !== false){
        $sql = $sql." ".$where;
    }
    echo $sql."<br>";
    $result = $mysqli -> query($sql);

    if (!$result) {
        printf("Error message: %s\n", $mysqli->error);
        return false;
    }

    $row_data =$result->num_rows;

    unset($data);
    //check row data
    if($row_data == 0) return false;
    while($row = $result->fetch_array()){
        $data[] = $row;
    }
    return $data;
}
function query($sql){
    global $mysqli;
    $result = $mysqli -> query($sql);

    if (!$result) {
        printf("Error message: %s\n", $mysqli->error);
    }

    $row_data =$result->num_rows;
    //check row data
    if($row_data == 0) return false;
    while($row = $result->fetch_array()){
        $data[] = $row;
    }
    return $data;

}
function insert($data){
    global $mysqli;
    /*
    $data['table']
    $data['insert']
    $data['where']
    */

    if(is_null($data['table']) || !isset($data['table'])){
        echo "error table";
        return false;
    }


    if( !is_array($data['insert'])){
        echo 'error insert';
        return false;
    }

    foreach($data['insert'] as $key => $val){
        $k[] = '`'.$key.'`';
        $v[] = "'".$val."'";
    }



    
    $sql = "INSERT INTO ".$data['table']."(".implode(',',$k).") VALUES (".implode(',',$v).")";
    echo $sql;
    $result = $mysqli -> query($sql);

    if (!$result) {
        printf("Error message: %s\n", $mysqli->error);
        return false;
    }

    
    return true;

}

function update($data){
    global $mysqli;
     /*
    $data['table']
    $data['update']
    $data['where']
    */

    if(is_null($data['table']) || !isset($data['table'])){
        echo "error table";
        return false;
    }

    if( !is_array($data['update'])){
        echo "error update";
        return false;
    }

    foreach($data['update'] as $key => $val){
       $set[] = '`'.$key."`='".$val."'";

    }

    if(is_null(@$data['where'])){
        $data['where'] = false;
    }

    
    $sql = "UPDATE ".$data['table']." SET ".implode(',',$set);


    $where = sql_where(@$data['where']);

    if($where === false) return false; 

    $sql = $sql." ".$where;

    $result = $mysqli -> query($sql);

    if (!$result) {
        printf("Error message: %s\n", $mysqli->error);
    }

    
    return true;

}

function delete($data){
    global $mysqli;
  /*
    $data['table']
    $data['where']
    */

    if(is_null($data['table'])){
        return false;
    }



    if(is_null(@$data['where'])){
        echo "error where";
        $data['where'] = false;
    }



    
    $sql = "DELETE FROM ".$data['table'];

  

    $where = sql_where($data['where']);
    

    if($where === false) return false; 

    $sql = $sql." ".$where;
    echo $sql;
    $result = $mysqli -> query($sql);

    if (!$result) {
        printf("Error message: %s\n", $mysqli->error);
        return false;
    }

    
    return true;


}
