<?php
/**
 * Created by PhpStorm.
 * User: moonok29@gmail.com
 * Date: 2019-03-19
 */

class Board extends Controller
{
    public function index(){
        $this->list();
    }

    public function list(){

        $board_model = $this->loadModel('BoardModel');
        $board_list = $board_model->getBoardList();

        require "views/_templates/header.php";
        require "views/board/list.php";
        require "views/_templates/footer.php";
    }

    public function view($idx){

        $board_model = $this->loadModel('BoardModel');
        $board_view = $board_model->getBoardView($idx);

        require "views/_templates/header.php";
        require "views/board/view.php";
        require "views/_templates/footer.php";
    }
}