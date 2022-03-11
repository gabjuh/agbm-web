<?php

    require_once("header.php");
    require_once("navigation.php");

    require_once("class/contentbox.class.php");


    $box = new ContentBox();
    $box -> openBox();


    require_once("class/input.class.php");
    $input = new Input();
    $input->openForm(true);




    $box -> closeBox();

    require_once("footer.php");






?>