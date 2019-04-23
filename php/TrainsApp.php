<?php

include_once "Application.php";

class TrainsApp extends Application
{

    const STATION_URL = "https://irail.be/stations/NMBS?q=";
    const TRAVEL_URL = "https://api.irail.be/connections/?";

    private $travelParameters = array();


    public  function requestData()
    {

        $station = $this->getPossibleStations("Aalst")[0];



        $this->setValue($this->getFirstTrip("Leuven","Aalst"));
    }


    public function getPossibleStations($station){
        //Using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this::STATION_URL . $station);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //output verkregen in json
        $output = curl_exec($ch);
        curl_close($ch);

        //...[index]['name'] om de naam te verkrijgen
        $stationsRaw = json_decode($output,true)['@graph'];

        $stations = array();
        foreach($stationsRaw as $stationName){
            $stations[] = $stationName['name'];
        }

        return $stations;

        //printable: implode(",", $stations);
    }

    public function getFirstTrip($from, $to){
        //https://api.irail.be/connections/?to=aalst&from=leuven&date=050817&time=1200&timeSel=arrive

        $this->travelParameters=array();
        $date=date("dmy");
        $time=date("Hi");

        $this->addTravelParameter("from",$from);
        $this->addTravelParameter("to",$to);
        $this->addTravelParameter("date",$date);
        $this->addTravelParameter("time",$time);
        $this->addTravelParameter("timeSel","depart");

        //return $this->getTravelUrl();
        $xmlResponse = file_get_contents($this->getTravelUrl());
        $arrayResponse = simplexml_load_string($xmlResponse);

        //TODO verder afwerken
        return strval($xmlResponse);

    }

    private function addTravelParameter($key, $value){
        $this->travelParameters[$key]=$value;
    }

    private function getTravelUrl(){
        $newUrl = $this::TRAVEL_URL;

        foreach($this->travelParameters as $key => $value){
            $newUrl .= sprintf("%s=%s&",$key,$value);
        }

        return $newUrl;
    }
}