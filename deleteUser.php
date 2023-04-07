<?php
if(empty($_POST["user_id"])){
    die("user_id is required");  
}
$conn= require("dbconnect.php");
$sql="DELETE FROM User WHERE id='".$_POST["user_id"]."'";
$conn->query($sql);
$conn->close();
?>