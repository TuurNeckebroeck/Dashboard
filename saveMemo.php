<?php
    include_once "./php/Database.php";
    include_once "./php/creds.php";

    session_start();

    /*echo sprintf("%s<br>%s<br>",
        $_POST['memo'],
        $_SESSION['uID']
    );*/
    if(isset($_POST['memo'],$_SESSION['uID'])){
        $db = new Database();
        $db->connect();
        $query="INSERT INTO %s (posted_by,visible_by,message) VALUES ('%s','%s','%s')";

        $query = sprintf($query,
            MEMO_TABLE,
            $_SESSION['uID'],
            $_SESSION['uID'],
            str_replace("\n","\\n",$_POST['memo'])
            );

        $result = $db->query($query);
        header("location:index.php");
    }