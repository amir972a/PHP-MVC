<?php

class Model{
    private $host="localhost";
    private $username="root";
    private $password="";
    private $dbname="register";
    private $connection;
    #prepared statement
    private $pd_st;
    public function __construct()
    {
        $dsn="mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        #create new PDO and connection to database
        try{
            $this->connection=new PDO($dsn,$this->username,$this->password);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    #create prepared statement
    public function query($query){
        $this->pd_st=$this->connection->prepare($query);
    }
    #initialization to prepared statement parameter
    public function bind($param,$value,$type=null){
        #find type of param
        if(is_null($type)){
            switch($value){
                case is_int($value):
                    $type=PDO::PARAM_INT;
                    break;
                case is_string($value):
                    $type=PDO::PARAM_STR;
                    break;
                case is_bool($value):
                    $type=PDO::PARAM_BOOL;
                    break;
                default:
                $type=PDO::PARAM_NULL;
            }
        }
        #bind
        $this->pd_st->bindvalue($param,$value,$type);
    }
    public function execute(){
        $this->pd_st->execute();
    }
    public function result(){
        $this->execute();
        return $this->pd_st->fetchAll(PDO::FETCH_ASSOC);
    }



}



?>