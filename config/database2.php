<?php
class Database{
    private $appName;
    private $connStr;
    private $conn;

    public function connect(){
        $this->appName= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->connStr="host=localhost port=5432 dbname=oferta-sv user=postgres password=maya123";

$this->conn= pg_connect($this->connStr);
if($this->conn){
        //no error in connection
        return $this->conn;
        // print_r($this->conn);
        // echo "connection established";
}else{
    //error in connection
    
    exit;
}
    }

}
// $db=new Database();
// $db->connect();



?>