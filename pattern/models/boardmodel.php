<?php
/**
 * Created by PhpStorm.
 * User: moonok29@gmail.com
 * Date: 2019-03-19
 */

class BoardModel
{
    function __construct($db){
        try{
            $this->db = $db;
        }catch(PDOException $e){
            exit("DB connection error!");
        }
    }

    public function getBoardList(){
        $sql = "select dl_number, dm_id, dl_createAt from daily_log";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getBoardView($idx){
        $sql = "select dl_number, dm_id, dl_content, dl_createAt from daily_log where dl_number=".$idx;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}