<?php


    require_once("header.php");
    require_once("navigation.php");

    require_once("class/sermons.class.php");
    require_once("class/contentbox.class.php");
    require_once("class/preachers.class.php");

    $box = new ContentBox();
    $box -> openBox();

    if (isset($_GET["id"])) {
        $preacher = new Preacher();
        $preacher -> deleteDataLine($_GET["id"]);
        echo "<h2 class=\"green\">Prediger wurde gelöscht.</h2>\n";
    }

    header("refresh:2; url=admin.php");


    $box -> closeBox();


?>