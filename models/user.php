<?php

class User extends Model{

    public function getByLogin($login){
        $sql = "SELECT * FROM `users` where `login` = '{$login}' LIMIT 1;";
        $result = $this->db->query($sql);
        if ( isset($result[0])){
            return $result[0];
        }
        return false;
    }
}