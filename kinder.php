<?php

    require_once("class/accordion.class.php");

    $kl1 = new Accordion();
    $kl1->setId("001");
    $kl1->setDatum("05.09.2020");
    $kl1->setTitel("Mose führte Gottes Volk");
    $kl1->setVideo("yUsE_17yooo");
    $kl1->createAccordion();


    $kl2 = new Accordion();
    $kl2->setId("002");
    $kl2->setDatum("05.09.2020");
    $kl2->setTitel("Jesus kommt wieder");
    $kl2->setVideo("Hs56kRA3UDw");
    $kl2->createAccordion();


    $kl3 = new Accordion();
    $kl3->setId("003");
    $kl3->setDatum("26.09.2020");
    $kl3->setTitel("Kinderprogramm für Erntedankfest");
    $kl3->setVideo("v0AoxVHARfk");
    $kl3->createAccordion();



?>