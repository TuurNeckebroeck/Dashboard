<?php
include_once "creds.php";

class Database{
    private $link;

    function connect(){
        $this->link=mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die("\nVerbinding met de database mislukt.");
    }

    function close(){
        mysqli_close($this->link);
    }

    function query($queryValue){
        //$value=mysqli_prepare($this->link,$queryValue);
        $value=$queryValue;
        if($result=mysqli_query($this->link,$value)){
            return $result;
        }else{
            echo "Query gefaald.";
            return false;
        }
    }

    /*/function __sleep(){
        return array('link');
    }

    function __wakeup(){
        $this->connect();
    }*/
}
