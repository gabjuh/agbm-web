
<?php 

include("error_reports.php");

require("_path.php");

require_once("header.php");
require_once("navigation.php");
require_once($path ."/class/textbox.class.php");
require_once($path ."/class/contentbox.class.php");




$welcomeText = "<span id=\"welcomeText\"><i>Herzlich Willkommen auf der neuen <br><strong>Webseite der Adventgemeinde Bremen-Mitte</strong>. <br>Bei Fragen oder Fehlern melde dich unter <a href=\"mailto:adgbe@yahoo.de\" target:\"_blank\">adgbe@yahoo.de</a>.<br>
Viel Freude und Gottes Segen wünscht dir <br><br>das <b>Technik-Team</b> der Gemeinde Bremen-Mitte.</i></span>";



$welcome = new Textbox();
$welcome->insertText($welcomeText);


$box = new ContentBox();
$box -> openBox();

require_once("class/carussel.class.php");

$carussel = new Carussel();
$carussel->createCarussel();

$box -> closeBox();

require_once("footer.php");


?>