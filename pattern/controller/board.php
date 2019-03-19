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
        require "views/_templates/header.php";
        require "views/board/list.php";
        require "views/_templates/footer.php";
    }

    public function view($idx){
        require "views/_templates/header.php";
        require "views/board/view.php";
        require "views/_templates/footer.php";
    }
}