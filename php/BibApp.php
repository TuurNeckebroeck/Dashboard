<?php
    include_once "Application.php";

class BibApp extends Application
{
    const BIBNAME = "cba";
    const URL = "https://bib.kuleuven.be/apps/ub/blokkeninleuven/api/libraries/";

    public function __construct(){
        parent::__construct();
    }

    private function getJson(){
        $newUrl=$this::URL . $this::BIBNAME;
        $jsonData = json_decode(utf8_encode(file_get_contents($newUrl)), true);
        return $jsonData;
    }

    public function requestData()
    {
        $jsonData = $this->getJson();
        $zitjes=floatval($jsonData['zitjes']);
        $occupancy=floatval($jsonData['occupancy']);

        $weekday = date("w"); if ($weekday==0){$weekday=7;}
        $begin = $jsonData['hours'][$weekday]['begin'];
        $einde = $jsonData['hours'][$weekday]['einde'];

        if(boolval($jsonData['gesloten'])==false) {
            $this->setValue(sprintf(
                "<h2>Bibmonitor: %s</h2>%s - %s<br>%s/%s<br>%s",
                $jsonData['afk'],
                $begin,
                $einde,
                strval($occupancy),
                strval($zitjes),
                sprintf('<div id="occupancy" style="width:%s%%;"><div id="zitjes"></div></div>',
                    strval(100 * $occupancy / $zitjes))));

            //CSS Toegevoegd !!
        }else{
            $this->setValue(sprintf(
                '<h2>Bibmonitor: %s</h2>%s - %s<br>gesloten',
                $jsonData['afk'],
                $begin,
                $einde));
        }

    }
}