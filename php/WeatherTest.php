<?php
    include_once "ApplicationManager.php";

    /*
    include_once "WeatherService.php";
    include_once "Utilities.php";

    function p($s){print($s."<br>");}

    $w = new WeatherService();
    $w->setCityId(2803451); //Aalst
    //$w->setCityId(2794167); //Koksijde
    $w->setLanguage("nl");
    $w->setUnits("metric");
    $w->refreshData();

    p("Weer in ".Utilities::capitalize($w->getCityName()));
    p("----------------------------");
    p("Beschrijving: ".Utilities::capitalize($w->getDescription()));
    p("Vochtigheid (%): ".$w->getHumidity());
    p("Temperatuur (°C): ".$w->getTemp());
    p("Min / max temperatuur (°C): ". $w->getTempMin() . " - " . $w->getTempMax());
    */

    $appManager = new ApplicationManager();
    echo $appManager->getAllHtml();

    //echo file_get_contents("./generalHtmlEnclosure");



?>

