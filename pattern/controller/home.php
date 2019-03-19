<?php
class Home extends Controller
{
    public function index()
    {
        require "views/_templates/header.php";
        require "views/_templates/index.php";
        require "views/_templates/footer.php";
        //config 파일에서 기본 템플릿값을 주고 값에 따라 다른 대렉토리의 템블릿을 사용하게 할 수 있다.
    }
}