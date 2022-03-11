<?php

	//include("error_reports.php");
	
	require("_path.php");

    require_once("header.php");
    require_once("navigation.admin.php");

    // $adminText1 = "Hallo!";

    // $adtxt1 = new Textbox();
    // $adtxt1 -> insertText($adminText1);


    require_once("class/preachers.class.php");
    require_once($path ."/class/sermons.class.php");
    require_once($path ."/class/contentbox.class.php");


    $box = new ContentBox();
    $box -> openBox();
    
    
    echo "<h3 class=\"tableTitle\">Prediger</h3>";


    $preachersTable = new Preacher();
    $preachersTable -> readAllDataFromTable();


    echo "<h3 class=\"tableTitle\">Predigten</h3>";


    $sermonsTable = new Sermon();
    $sermonsTable -> readAllDataFromTable();
    
    
    $box -> closeBox();    



    require_once("footer.php");



?>