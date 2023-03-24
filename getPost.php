<?php

//fetch data from database for post
// if(empty($_GET["category"])){
//     die("Category is required");
// }
    $conn= require("dbconnect.php");
    $sql = "SELECT * FROM Post WHERE category_name='".$_POST["category"]."'";
    $result = $conn->query($sql);
    //encode result to json
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;
?>