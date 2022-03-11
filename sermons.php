<?php


	//include("error_reports.php");
	
	require("_path.php");

    $size = " width=\"800\" height=\"500\" ";

    require_once("header.php");
    require_once("navigation.php");

    require_once($path ."/class/sermons.class.php");
    require_once($path ."/class/textbox.class.php");
    require_once($path ."/class/contentbox.class.php");

    $helpText = "<i>Hier findest du die Videos der neusten Predigten, die jüngste zuoberst.<br /><br /><strong>Die Predigten werden nach der Aufnahme 6 bis 24 Stunden <br />für die Veröffentlichung brauchen.</strong><br /><br />Danke für Euer Geduld.</i>";

    $help = new Textbox();
    $help->insertText($helpText);


    $box = new ContentBox();
    $box -> openBox();


    $header = new Sermon();
    $header->preacherHeader();


    $sermons = new Sermon();

    $sermons->readFromDb();

    // $sermon2 = new Sermon();
    // $sermon2->readFromDb();

    require_once("class/accordion.class.php");

    // $trial = new Accordion();
    // // $trial->readAccordionFromDB();


    $box -> closeBox();

    require_once("footer.php");


?>