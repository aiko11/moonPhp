<?php
/**
 * Created by PhpStorm.
 * User: 문정구
 * Date: 2019-03-20
 * Time: 오후 10:36
 */

function view($template, $data=[])
{
    if(is_file($template)){
        ob_start();
        extract($data);
        include $template;
        return ob_get_clean();
    }
    return new Exception("Template file not found");
}

$user =[
    'nickname'=> 'testman',
    'id' => 'hohoho'
];

$top = view("hello_top.html");
$body = view("hello_body.html", $user);
$footer = view("hello_footer.html");


echo $top.$body.$footer;