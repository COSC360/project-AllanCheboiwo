<?php
    $conn= require("dbconnect.php");
    $sql="SELECT * FROM Post WHERE category_name='Education' AND title LIKE '%e%'";
    $result = $conn->query($sql);
    //encode result to json
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;

?>