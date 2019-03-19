<?php
class Display
{
    private $impl;

    public function __construct(DisplayImpl $impl){
        $this->impl = $impl;
    }

    public function open(){
        $this->impl->rawOpen();
    }

    public function print(){
        $this->impl->rawPrint();
    }

    public function close(){
        $this->impl->rawClose();
    }

    public final function display(){
        $this->open();
        $this->print();
        $this->close();
    }
}


class CountDisplay extends Display
{
    public function __construct(DisplayImpl $impl)
    {
        parent::__construct($impl);
    }

    public function multiDisplay($times){
        $this->open();
        for($i=0; $i<$times; $i++){
            $this->print();
        }
        $this->close();
    }
}