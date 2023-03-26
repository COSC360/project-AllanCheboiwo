<?php

if(empty($_POST["post_id"])){
    die("Post id is required");
}
$conn = require("dbconnect.php");
$sql = "SELECT * FROM Comment WHERE post_id='".$_POST["post_id"]."'";
$result =$conn->query($sql);

//encode result to json
$json = json_encode($result->fetch_all(MYSQLI_ASSOC));
echo $json;

?>