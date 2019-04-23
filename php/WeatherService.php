<?php
    class WeatherService {

        const API_KEY = "3e549cada1df78109c719abe70c06dc3";
        const URL = "http://api.openweathermap.org/data/2.5/weather?";

        private $parameters = array();
        private $data = null;


        public function __construct(){
            $this->addParameter("appid", $this::API_KEY);
        }



        public function requestData(){
            $this->data = json_decode(utf8_encode($this->getJson()), true);
        }



        public function getDescription(){
            $data=$this->data;

            if($data == null){
                return null;
            }

            return $data['weather'][0]['description'];
        }

        public function getTemp(){
            $data=$this->data;

            if($data == null){
                return null;
            }

            return $data['main']['temp'];
        }

        public function getTempMax(){
            $data=$this->data;

            if($data == null){
                return null;
            }

            return $data['main']['temp_max'];
        }

        public function getTempMin(){
            $data=$this->data;

            if($data == null){
                return null;
            }

            return $data['main']['temp_min'];
        }

        public function getHumidity(){
            $data=$this->data;

            if($data == null){
                return null;
            }

            return $data['main']['humidity'];
        }

        public function getCityName(){
            $data=$this->data;

            if($data == null){
                return null;
            }

            return $data['name'];
        }

        public function getWindSpeed(){
            $data=$this->data;

            if($data == null){
                return null;
            }

            return $data['wind']['speed'];
        }



        public function setLanguage($lang){
            $this->addParameter("lang",$lang);
        }

        public function setCityId($id){
            $this->addParameter("id",$id);
        }

        public function setUnits($unit){
            $this->addParameter("units",$unit);
        }



        private function addParameter($key, $value){
            //checken of parameter al bestaat
            $this->parameters += array($key => $value);
        }

        private function getUrl(){
            $newUrl = $this::URL;

            foreach ($this->getParameters() as $key => $value) {
                $newUrl = $newUrl.sprintf("%s=%s&",$key,$value);
            }

            return $newUrl;
        }

        private function getJson(){
            return file_get_contents($this->getUrl());
        }

        private function getParameters(){
            return $this->parameters;
        }



        private function setMode($mode){
            $this->addParameter("mode", $mode);
        }



        public static function kelvinToCelcius($degK){
            return intval($degK)-273.15;
        }

    }
