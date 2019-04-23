<?php

    include_once "Utilities.php";
    include_once "Application.php";

class TimeApp extends Application
{

    public  function requestData(){
        $weekday="";

        switch (intval(date("w"))){
            case 0:
                $weekday="zondag";
                break;
            case 1:
                $weekday="maandag";
                break;
            case 2:
                $weekday="dinsdag";
                break;
            case 3:
                $weekday="woensdag";
                break;
            case 4:
                $weekday="donderdag";
                break;
            case 5:
                $weekday="vrijdag";
                break;
            case 6:
                $weekday="zaterdag";
                break;
        }

        $this->setValue(sprintf("<h1>%s<br>%s</h1>",
            Utilities::capitalize($weekday),
            date("d-m-Y H:i")));
    }
}