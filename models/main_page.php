<?php

class Main_page extends Model {

    public function getNearestSD(){
        $sql = "SELECT * FROM `dates` ORDER BY `id` DESC LIMIT 1;";
        return $this->db->query($sql);
    }

    /*I don`t like this solution*/
    public function getCurrentParticipants(){
        $sql = "SELECT `dates`.`id`  FROM `dates` ORDER BY `id` DESC LIMIT 1;";
        $result = $this->db->query($sql);
        $dates_id = array_shift($result[0]);
        $sql = "SELECT *  FROM `participants` WHERE `id_of_date` = '{$dates_id}';";
        return $this->db->query($sql);
    }

    public function getPhotoForMainPage(){
        $sql = "SELECT `t1`.`id`, `t1`.`date_name`, `t2`.`name`, `t2`.`imgDir` FROM `dates` AS `t1` INNER JOIN `photo` AS `t2` ON `t1`.`id` = `t2`.`dates_id` ORDER BY `t1`.`id` DESC LIMIT 4;";
        return $this->db->query($sql);
    }

    public function prepayment($id, $admin){
        $sql = "UPDATE `participants` SET `pre_payment_status` = '{$admin}' WHERE `participants`.`id` = '{$id}';";
        return $this->db->query($sql);
    }

    public function admin_addDate($data){
        if(!isset($data['date_name']) || !isset($data['description']) || !isset($data['date']) || !isset($data['link']) || !isset($data['location'])){
            return false;
        }

        $dateName = $data['date_name'];
        $description = $data['description'];
        $date = $data['date'];
        $link = $data['link'];
        $location = $data['location'];

        $sql = "INSERT INTO `dates` SET `date_name` = '{$dateName}', `description` = '{$description}', `date` = '{$date}', `link` = '{$link}', `location` = '{$location}';";
        return $this->db->query($sql);
    }

    public function admin_delete($id){
        $id = (int)$id;
        $sql = "DELETE FROM `dates` WHERE `id` = '{$id}';";
        return $this->db->query($sql);
    }

    public function admin_getAllDates(){
        $sql = "SELECT * FROM `dates`;";
        return $this->db->query($sql);

    }

    public function save($data){
        if (!isset($data['id']) || !isset($data['date_name']) || !isset($data['description']) || !isset($data['date']) || !isset($data['link']) || !isset($data['location'])) {
            return false;
        }

        $id = $data['id'];
        $date_name = $data['date_name'];
        $description = $data['description'];
        $date = $data['date'];
        $link = $data['link'];
        $location = $data['location'];

        $sql = "UPDATE `dates` SET `date_name` = '{$date_name}', `description` = '{$description}', `date` = '{$date}', `link` = '{$link}', `location` = '{$location}' WHERE `id` = '{$id}';";

        return $this->db->query($sql);
    }

    public function getParticipants($id){
        $sql = "SELECT * FROM `participants` WHERE `id` = '{$id}';";
        return $this->db->query($sql);
    }

}

