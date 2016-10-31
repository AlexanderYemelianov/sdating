<?php

class Photo extends Model{

    /*You should do something with this because if there are less then 4 records in t1 this request will multiply results with a same id*/

    public function getPhotoForMainPage(){
        $sql = "SELECT `t1`.`id`, `t2`.`name`, `t2`.`imgDir` FROM `dates` AS `t1` INNER JOIN `photo` AS `t2` ON `t1`.`id` = `t2`.`dates_id` ORDER BY `t1`.`id` DESC LIMIT 4;";
        return $this->db->query($sql);
    }

    public function getDateId(){
        $sql = "SELECT `dates`.`id`, `dates`.`date_name` FROM `photo` RIGHT JOIN `dates` ON `photo`.`dates_id` = `dates`.`date_name`";
        return $this->db->query($sql);
    }

    public function addImgPathToDB($name, $path, $dateId){
        $sql = "INSERT INTO `photo`(`name`, `imgDir`, `dates_id`) VALUES ('{$name}', '{$path}', '{$dateId}')";
        return $this->db->query($sql);
    }

    public function getAllPhotoArchives(){
        $sql = "SELECT `t1`.`id`, `t1`.`date_name`, `t2`.`imgDir`, `t2`.`name` FROM `dates` AS `t1` INNER JOIN `photo` AS `t2` ON `t1`.`id` = `t2`.`dates_id` GROUP BY `t1`.`id`;";
        return $this->db->query($sql);
    }

    public function getAllPhotoFromArchive($id){
        $sql = "SELECT * FROM `photo` WHERE `dates_id` = '{$id}';";
        return $this->db->query($sql);
    }

    public function delete($id){
        $id = (int)$id;
        $sql = "DELETE FROM `photo` WHERE `id` = '{$id}';";
        return $this->db->query($sql);
    }
}