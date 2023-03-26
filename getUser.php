<?php 
// Path: getUser.php
if(empty($_POST["search"])){
    die("Search term is required");
}
$conn= require("dbconnect.php");
$sql="SELECT * FROM User WHERE username LIKE '%".$_POST["search"]."%'";
$result = $conn->query($sql);
//encode result to json
$json = json_encode($result->fetch_all(MYSQLI_ASSOC));
echo $json;


?>