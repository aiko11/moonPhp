<?php
/**
 * Created by PhpStorm.
 * User: dev_5278
 * Date: 2019-03-19
 */

class Controller
{
    public $db = null;

    function __construct(){
        $this->dbconnect();
    }

    private function dbconnect(){
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS, $options);
    }
//    위 설정은 db에서 select 된 값을 fetch 할 때 적용하는 모드이다.
//    여기서는 FETCH_OBJ로 설정했다. FETCH_OBJ는 $row->title 과 같이 데이터를 출력할 수 있는 모드이다.
//
//    PDO의 fetch 모드에 대해 간단히 살펴보면 아래와 같은 것들이 있다.
//    PDO::FETCH_ASSOC : 추출된 데이터를 칼럼명으로 구분하는 배열로 반환($row[‘title’])
//    PDO::FETCH_NUM : 추출된 데이터를 칼럼 번호로 구분하는 배열로 반환, 첫 번째 칼럼은 0 ($row[0])
//    PDO::FETCH_BOTH : 칼럼명과 번호로 모두 접근 가능한 배열 반환
//    PDO::FETCH_OBJ : 레코드 셋을 객체로 반환하며 $row->title 과 같이 접근가능
//    이 외에서 몇 가지 모드가 더 있다. 기타 fetch 스타일에 관한 정보는 아래 링크를 통해 알아보자.
//    http://php.net/manual/en/pdostatement.fetch.php

//    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING 이 부분은 에러가 발생할 때 어떻게 처리할 지를 정하는 부분인데
//    PDO::ERRMODE_WARNING은 에러가 발생하면 이를 표시해주도록 하고 있다.
//    ATTR_ERRMODE의 값으로는 PDO::ERRMODE_WARNING 외에도
//    PDO::ERRMODE_SILENT, PDO::ERRMODE_EXCEPTION 이 있다.
//    PDO::ERRMODE_SILENT는 에러가 발생해도 이를 표시하지 않도록 하며
//    PDO::ERRMODE_EXCEPTION는 예외처리 설정에 따르도록 하고 있다.



    public function loadModel($model_name){
        require 'models/'.strtolower($model_name). ".php";
        return new $model_name($this->db);
    }

    function __destruct(){
    }
}