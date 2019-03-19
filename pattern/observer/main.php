<?php
/**
 * Created by PhpStorm.
 * User: moonok29
 */

include "Publisher.php";
include "Observer.php";
$run_flag=1;

$sendServer = new sendServer();


if($run_flag==1)
{
    echo "실행 1번<br/>";
    $a_ob = new Aobserver($sendServer);
    $b_ob = new Bobserver($sendServer);
}else {
    echo "실행 2번<br/>";
    $a_ob = new Aobserver();
    $b_ob = new Bobserver();
    $sendServer->add($a_ob);
    $sendServer->add($b_ob);
}

$sendServer->setNewsInfo("오늘 한파","전국 영하 18도 입니다");
$sendServer->setNewsInfo("벛꽃 축제합니다","다 같이 벚꽃 보로 고고");