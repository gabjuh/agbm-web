<?php

	//include("error_reports.php");
	
	require("_path.php");

    require_once("header.php");
    require_once("navigation.php");

    // $adminText1 = "Hallo!";

    // $adtxt1 = new Textbox();
    // $adtxt1 -> insertText($adminText1);


    require_once($path ."/class/contentbox.class.php");


    $box = new ContentBox();
    $box -> openBox();
    
    
    echo "<h3 class=\"tableTitle\">MP3 Archive</h3>";


    require_once($path ."/class/archive.class.php");

    $arch = new Archive();

    $arch -> setException("Ralf Pietruska");

    $arch -> setException("Samuel Pietruska");

    $arch -> getNamesFromDb();

    
    $arch -> buildTable();
      
    
    
    $box -> closeBox();    



    require_once("footer.php");



?>