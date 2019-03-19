<?php
abstract class DisplayImpl
{
    public abstract function rawOpen();
    public abstract function rawPrint();
    public abstract function rawClose();
}


class StringDisplayImpl extends DisplayImpl
{
    private $str;
    private $width;

    public function __construct($str)
    {
        $this->str = $str;
        $this->width = mb_strlen($str);
    }

    public function rawOpen()
    {
        $this->printLine();
    }

    public function rawPrint()
    {
        echo "|".$this->str."|<br/>";
    }

    public function rawClose()
    {
        $this->printLine();
    }

    public function printLine(){
        $out_str="+";

        for($i=0; $i<$this->width; $i++){

            $out_str .= "-";
        }

        echo $out_str."+<br/>";
    }
}