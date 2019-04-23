<?php

class Utilities
{

    static function capitalize($s){
        return strtoupper($s[0]).substr($s,1);
    }
}

?>