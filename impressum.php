<?php

include("error_reports.php");

require("_path.php");

require_once("header.php");
require_once("navigation.php");

require_once($path ."/class/contentbox.class.php");

$box = new ContentBox();
$box -> openBox();

?>


<div id="impressum">
    <h1>IMPRESSUM</h1>
    <h2>Herausgeber:</h2>
    <p>Freikirche der Siebenten-Tags-Adventisten
    im Land Bremen - Körperschaft des öffentlichen Rechts</p>
    <p>Fischerstraße 19</p>
    <p>30167 Hannover </p>

    <h2>Vertretungsberechtigte:</h2>
    <p>Ralf Schönfeld, Vorsitzender</p>
    <p>Jan Kozak, stellvertretender Vorsitzender</p>
    <p>Steffen Entrich, Finanzvorstand</p>

    <h2>Kontakt:</h2>
    <p><a href="nib@adventisten.de">nib(at)adventisten(dot)de</a></p>

    <h2>Verantwortlich i.S. des § 5 TMG / § 55 RStV</h2>
    <h3>Redaktionsleitung</h3>
    <p>Juri Gaus <a href="mailto:Juri.Gaus@adventisten.de">Juri.Gaus(at)adventisten(dot)de</a></p>
</div>


 
<?php


$box -> closeBox(); 





require_once("footer.php");

?>