<?php

    $conn= require("dbconnect.php");
    $sql = "SELECT * FROM Post";
    $result = $conn->query($sql);
    //encode result to json
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;
?>