<?php

class Message extends Model{

    public function save($data, $id = null){
/*        if (!isset($data['name']) || !isset($data['email']) || !isset($data['message'])) {
            return false;
        }*/

        /*if $data['message'] will contain " ' " SQL request will not working. But user will get session message that everything is OK*/
        if(empty($data['name']) || empty($data['email']) || empty($data['message'])) {
            return false;
        }
            $id = (int)$id;
            $name = $data['name'];
            $email = $data['email'];
            $message = $data['message'];

            if(!$id){ //Add new record
                $sql = "INSERT INTO `messages`(`name`,`email`,`message`) VALUES ('{$name}', '{$email}', '{$message}');";
            } else { //Update existing
                /*UPDATE DOESN'T WORKING BECAUSE $id ALWAYS HAVE A SAME VALUE '0'*/
                $sql = "UPDATE `messages` SET `name` = '{$name}', `email` = '{$email}', `message` = '{$message}' WHERE `id` = '{$id}';";
            }

        if(!$this->db->query($sql)) {
            return true;
        }
    }

    public function getList(){
        $sql = "SELECT * FROM `messages`  ORDER BY `id` DESC";
        return $this->db->query($sql);
    }
}