<?php
if(empty($_POST["post_id"])){
    die("post_id is required");  
}
$conn= require("dbconnect.php");
$sql="DELETE FROM Post WHERE id='".$_POST["post_id"]."'";
$conn->query($sql);
$conn->close();
?>