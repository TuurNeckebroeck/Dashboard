<?php

include_once "TimeApp.php";
include_once "GeneralApp.php";
include_once "WeatherService.php";
include_once "Utilities.php";
include_once "BibApp.php";
include_once "TrainsApp.php";
include_once "MemoApp.php";

class ApplicationManager
{
    private $apps = array();
    private  $htmlEnclosure;

    public function __construct(){
        $this->htmlEnclosure=file_get_contents(dirname(__FILE__)."/generalHtmlEnclosure");

        $app=new TimeApp();
        $app->requestData();
        $this->apps[]=$app;

        $app=new GeneralApp();
        $app->setValue('<iframe src="https://gadgets.buienradar.nl/gadget/zoommap/?lat=50.94&lng=4.07&overname=2&zoom=10&naam=Aalst Oost-Vlaanderen&size=2&voor=1" scrolling=yes width=256 height=256 frameborder=no></iframe>');
        $this->apps[] = $app;


        $w = new WeatherService();
        $w->setUnits("metric");
        $w->setLanguage("nl");
        //$w->setCityId(2794167); //Koksijde
        $w->setCityId(2803451); //Aalst
        $w->requestData();
        $weatherText = "<h2>Het weer in %s</h2>%s<br>%s °C<br>Min: %s °C<br>Max: %s °C";
        $weatherText = sprintf(
            $weatherText,
            $w->getCityName(),
            Utilities::capitalize($w->getDescription()),
            $w->getTemp(),
            $w->getTempMin(),
            $w->getTempMax());

        $app=new GeneralApp();
        $app->setValue($weatherText);
        $this->apps[] = $app;

        $app = new BibApp();
        $app->requestData();
        $this->apps[]=$app;

        $app = new MemoApp();
        $app->setUserId(2);
        $app->requestData();
        $this->apps[] = $app;

        /*
        $app = new TrainsApp();
        $app->requestData();
        $this->apps[]=$app;
        */
    }


    public function getAllHtml(){
        $elementsHtml="";

        foreach($this->apps as $app) {
            if ($app instanceof Application) {
                $elementsHtml = $elementsHtml . $app->getHtml();
            }
        }

        return sprintf($this->htmlEnclosure,$elementsHtml);
    }

}