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
        $sql = "select idx,title,writer, createAt from moon_board";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getBoardView($idx){
        $sql = "select idx,title,content, writer, createAt from moon_board where idx=".$idx;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}