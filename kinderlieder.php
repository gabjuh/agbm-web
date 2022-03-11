

<?php

$size = " width=\"800\" height=\"500\" ";

require_once("header.inc.php");


?>




<div class="container">
  <div id="accordion">



<?php

require_once("class/accordion.class.php");


require_once("kinder.obj.php");


$accordion = new Accordion();
$accordion->readAccordionFromDB();


?>


</div>


</div>

<?php 

require_once("footer.inc.php");


?>

  


