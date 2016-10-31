<?php

class DB {

    protected $connection;

    public function __construct($host, $user, $password){
        try {
            $this->connection = new PDO($host, $user, $password);
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function query($sql){
        if(!$this->connection){
            return false;
        }

        $data = $this->connection->prepare($sql);
        $data->execute();
        if(is_bool($data)){
            return array();
        }
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
}