<?php

    //include("error_reports.php");
	
	require("_path.php");

    require_once("header.php");
    require_once("navigation.admin.php");

    // $adminText1 = "Hallo!";

    // $adtxt1 = new Textbox();
    // $adtxt1 -> insertText($adminText1);


    // require_once("class/preachers.class.php");
    // require_once($path ."/class/sermons.class.php");
    require_once($path ."/class/contentbox.class.php");


    $box = new ContentBox();
    $box -> openBox();
    
    
    echo "<h3 class=\"tableTitle\">Lieder - Wir loben Gott</h3>";

    echo "<a href=\"songs.edit.php\">Neues Lied hinzufügen</a>";


    require_once("class/songs.class.php");

    $song = new Songs();

    // $song -> songsHeader();
    $song -> readFromDb();

    echo "<a href=\"songs.edit.php\">Neues Lied hinzufügen</a>";
    
    $box -> closeBox();    



    require_once("footer.php");



?>