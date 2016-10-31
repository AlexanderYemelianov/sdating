<?php

class Rule extends Model{

    public function getRules(){
        $sql = "SELECT * FROM `rules`";
        return $this->db->query($sql);
    }

}
