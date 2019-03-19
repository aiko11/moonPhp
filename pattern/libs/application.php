<?php
/**
 * Created by PhpStorm.
 * User: dev_5278
 * Date: 2019-03-19
 * Time: 오전 9:25
 */

class Application
{
    private $controller = null;
    private $action = null;

    public function __construct()
    {
        $cancontroll = false;
        $url="";

        // 아파치 .htaccess 설정에 따라 도메인 이름 뒤에 나오는 모든 것은 url 변수로 들어 오게 된다.
        print_r( $_GET);
        if(isset($_GET["url"])){
            $url = rtrim($_GET["url"], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
        }

        $params = explode("/", $url);
        $counts = count($params);
        $this->controller = "home"; // url이 없다면 기본 경로로 접속

        if(isset($params[0])){
            if($params[0]) $this->controller= $params[0];
        }

        // controller폴더안에 파일이 있는지 확인하고 있으면 있으면 include 하고 클래스를 실행 시킨다.
        $file_path = "./controller/". $this->controller.'.php';

        if( file_exists($file_path) ){
            require "./controller/". $this->controller . ".php";
            $this->controller = new $this->controller();
            $this->action = "index"; // 클래스 실행 후 기본 실행될 메소드 이름

            if(isset($params[1])){
                if($params[1]) $this->action=$params[1]; // 클래스 실행 후 실행될 메소드 적용
            }

            // 메소드 실행 및 인자 갯수에 따른 인자 값 적용
            if(method_exists($this->controller, $this->action)){
                $cancontroll = true;
                switch($counts){
                    case '0':
                    case '1':
                    case '2':
                        $this->controller->{$this->action}();
                        break;
                    case '3':
                        $this->controller->{$this->action}($params[2]);
                        break;
                    case '4':
                        $this->controller->{$this->action}($params[2],$params[3]);
                        break;
                    case '5':
                        $this->controller->{$this->action}($params[2],$params[3],$params[4]);
                        break;
                    case '6':
                        $this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5]);
                        break;
                    case '7':
                        $this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6]);
                        break;
                    case '8':
                        $this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7]);
                        break;
                    case '9':
                        $this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8]);
                        break;
                    case '10':
                        $this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9]);
                        break;
                }
            }
        }

        if( $cancontroll === false){ echo "<!DOCTYPE html><html><head><meta charset='utf-8'></head><body><h1>Oops!!! 잘못된 접근입니다.</h1></body></html>"; }
    }
}