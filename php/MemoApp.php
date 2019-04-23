<?php

include_once "Application.php";
include_once "Database.php";
include_once "creds.php";

class MemoApp extends Application{

    private $message="";
    private $userId;
    private $db;
    const GET_MEMO_QUERY = "SELECT message FROM %s WHERE FIND_IN_SET(%d,visible_by)>0;";

    public function __construct(){
        parent::__construct();
        $this->db = new Database();
        $this->db->connect();
    }

    public function setUserId($id){
        $this->userId=$id;
    }

    public function requestData() {
        if($this->db == null || $this->userId == null) return;

        $query = sprintf(
            $this::GET_MEMO_QUERY,
            MEMO_TABLE,
            intval($this->userId)
        );
        $result = $this->db->query($query);

        if(mysqli_num_rows($result) > 0){
            //enkel de laatste boodschap
            while($data=mysqli_fetch_array($result)){
                $this->setValue(sprintf(
                    "<h1>Boodschap:</h1>%s",
                    nl2br($data[0])));
                $this->message=$data[0];
            }

        }else{
            $this->setValue("Geen boodschap");
        }
        //$this->setValue($query);

    }

    public function getMessage(){
        return $this->message;
    }


}