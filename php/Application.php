<?php

abstract class Application
{
    private $htmlEnclosure='<div class="item"><div class="animate-box">
	        		<div class="fh5co-desc">%s</div>
        		</div></div>';
    private $htmlValue;
    private $id;

    public function __construct(){}

    public function setValue($s){
        $this->htmlValue=$s;
    }

    public function getText(){
        return $this->htmlValue;
    }

    public function getHtml(){

        return sprintf($this->htmlEnclosure, $this->htmlValue);
    }

    public abstract function requestData();
}