<?php
/**
 * Created by PhpStorm.
 * User: moonok29@gmail.com
 * Date: 2019-03-19
 */

class About extends Controller
{
    public function index(){
        $this->intro();
    }

    public function intro(){
        require "views/_templates/header.php";
        require "views/_templates/intro.php";
        require "views/_templates/footer.php";
    }

    public function history(){
        require "views/_templates/header.php";
        require "views/_templates/history.php";
        require "views/_templates/footer.php";
    }
}