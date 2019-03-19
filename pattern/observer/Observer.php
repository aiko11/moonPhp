<?php
/**
 * Created by PhpStorm.
 * User: dev_5278
 * Date: 2019-03-18
 * Time: 오후 1:15
 */

interface Observer
{
    public function update($title, $news);
}


class Aobserver implements Observer
{
    private $title;
    private $news;
    private $publisher;

    function __construct(Publisher $publisher=null){
        if ( !is_null($publisher) ){
            $this->publisher = $publisher;
            $publisher->add($this);
        }
    }

    public function update($title, $news){
        $this->title = $title;
        $this->news = $news;
        $this->display();
    }

    public function display(){
        echo("<br/>옵저버 A 전달 : ".$this->title.$this->news);
    }
}



class Bobserver implements Observer
{
    private $title;
    private $news;
    private $publisher;

    function __construct(Publisher $publisher=null){
        if ( !is_null($publisher) ){
            $this->publisher = $publisher;
            $publisher->add($this);
        }
    }

    public function update($title, $news){
        $this->title = $title;
        $this->news = $news;
        $this->display();
    }

    public function display(){
        echo("<br/>옵저버 B 전달 : ".$this->title. $this-> news );
    }
}
