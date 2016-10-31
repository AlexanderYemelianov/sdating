<?php

class Emailing extends Model{

    public function informed($id, $admin){
        $sql = "UPDATE `participants` SET `informed` = '{$admin}' WHERE `participants`.`id` = '{$id}';";
        return $this->db->query($sql);
    }

    public function result($id, $admin){
        $sql = "UPDATE `participants` SET `dates_results` = '{$admin}' WHERE `participants`.`id` = '{$id}';";
        return $this->db->query($sql);
    }

    /*This method is duplicate from main_page.*/
    public function getParticipants($id){
        $sql = "SELECT `t1`.`name`, `t1`.`last_name`, `t1`.`sex`, `t1`.`email`, `t1`.`id_of_date`, `t2`.`date_name`, `t2`.`date`, `t2`.`location` FROM `participants` AS `t1` RIGHT JOIN `dates` AS `t2` ON `t1`.`id_of_date` = `t2`.`id` WHERE `t1`.`id` = '{$id}';";
        return $this->db->query($sql);
    }

    public function getAllParticipants($idOfDate, $sex){
        $sql = "SELECT `t1`.`id`, `t1`.`id_of_date`, `t1`.`name`, `t1`.`last_name`, `t1`.`sex`, `t1`.`email`, `t1`.`phone` FROM `participants` AS `t1` WHERE `t1`.`id_of_date` = '{$idOfDate}' AND `t1`.`sex` <> '{$sex}';";
        return $this->db->query($sql);
    }

    public function save($name, $email, $datesId, $subject, $message, $admin){
        $sql = "INSERT INTO `emails`(`name`, `email`, `dates_id`, `subject`, `message`, `admin`) VALUES ('{$name}', '{$email}', '{$datesId}', '{$subject}', '{$message}', '{$admin}');";
        return $this->db->query($sql);
    }

    public function getMessageInfo($id){
        $sql = "SELECT `t1`.`name`, `t1`.`email` FROM `messages` AS `t1` WHERE `t1`.`id` = '{$id}';";
        return $this->db->query($sql);
    }

    public function changeReplyStatus($id){
        $sql = "UPDATE `messages` SET `replyStatus` = 1 WHERE `messages`.`id` = '{$id}';";
        return $this->db->query($sql);
    }
}
?>