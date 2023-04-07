<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(empty($_POST["user_id"])){
    die("user_id is required");  
}
$conn = require("dbconnect.php");
$sql = "SELECT * FROM Comment WHERE user_id='".$_POST["user_id"]."'";
$result =$conn->query($sql);

//encode result to json
$json = json_encode($result->fetch_all(MYSQLI_ASSOC));
echo $json;

?>