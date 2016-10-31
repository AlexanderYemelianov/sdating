<?php

class Registration1 extends Model{

    public function getNearestDateInformation(){
        $sql = "SELECT * FROM `dates` ORDER BY `dates`.`id` DESC LIMIT 1;";
        return $this->db->query($sql);
    }

    public function registration($name, $lastName, $email, $phone, $ageGroup, $sex, $idOfDate){
        $sql = "INSERT INTO `participants`(`name`, `last_name`, `email`, `phone`, `age_group`, `sex`, `id_of_date` ) VALUES ('{$name}', '{$lastName}', '{$email}', '{$phone}', '{$ageGroup}', '{$sex}', '{$idOfDate}');";
        return $this->db->query($sql);
    }

    /*SQL query below need to be optimized. In a result we have all information from `dates` table for every participants*/
    public function participantsList($id){
        $sql = "SELECT `t1`.*, `t2`.`date_name` FROM `participants` AS `t1` LEFT JOIN `dates` AS `t2` ON `t1`.`id_of_date` = `t2`.`id` WHERE `id_of_date` = '{$id}';";
        return $this->db->query($sql);
    }

    public function getAllParticiapnts(){
        $sql = "SELECT `t1`.*, `t2`.`date_name` FROM `participants` AS `t1` LEFT JOIN `dates` AS `t2` ON `t1`.`id_of_date` = `t2`.`id`;";
        return $this->db->query($sql);
    }

    public function getListOfDates(){
        $sql = "SELECT `dates`.`id`, `dates`.`date_name` FROM `photo` RIGHT JOIN `dates` ON `photo`.`dates_id` = `dates`.`date_name`;";
        return $this->db->query($sql);
    }
}


