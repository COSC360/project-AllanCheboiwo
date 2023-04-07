<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
if(empty($_POST["id"])){
    die("Comment id is required");  
}
$conn= require("dbconnect.php");
$sql="DELETE FROM Comment WHERE id='".$_POST["id"]."'";
$conn->query($sql);
$conn->close();
?>