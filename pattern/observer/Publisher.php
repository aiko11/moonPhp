<?php
/**
 * Created by PhpStorm.
 * User: moonok29
 * date : 2019-03-17
 */

interface Publisher
{
    public function add(Observer $observer);
    public function delete(Observer $observer);
    public function notifyObserver();
}


class sendServer implements Publisher{
    protected $observers;
    private $title;
    private $news;

    function __construct(){
        $this->observers = array();
    }

    public function add(Observer $observer){
        $this->observers[]=$observer;
    }

    public function delete(Observer $observer){
        echo "delete";
    }

    public function notifyObserver()
    {
        $iterator = $this->observers;
        $count = count($iterator);

        for($i=0; $i < $count ; $i++){
            $iterator[$i]->update($this->title, $this->news);
        }
        echo "<br/>------------------- 전달 끝 ----------------------<br/>";
    }

    public function setNewsInfo($title, $news){
        $this->title = $title;
        $this->news = $news;
        $this->notifyObserver();
    }

    public function getTitle(){
        return $this->title;
    }

    public function getNews(){
        return $this->news;
    }
}
