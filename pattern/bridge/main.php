<?php
include_once "Display.php";
include_once "DisplayImpl.php";

$d1 = new Display(new StringDisplayImpl("Hello, Korea"));
$d2 = new CountDisplay(new StringDisplayImpl("Hello, World."));
$d3 = new CountDisplay(new StringDisplayImpl("Hello, Universe."));

$d1->display();
$d2->display();
$d3->display();
$d3->multiDisplay(3);
