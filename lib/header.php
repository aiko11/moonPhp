<?php
$my_id="127.0.0.1";
$ip = $_SERVER['REMOTE_ADDR'];
if($ip !== $my_id ){
    header('Location: http://192.168.1.111/daily/index.php');
}