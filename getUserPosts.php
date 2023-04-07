<?php

    if(empty($_POST["user_id"])){
        die("user id required");
    }
    $conn= require("dbconnect.php");
    $sql = "SELECT * FROM Post WHERE user_id='".$_POST["user_id"]."'";
    $result = $conn->query($sql);
    //encode result to json
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;
?>