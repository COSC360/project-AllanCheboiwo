<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_set_cookie_params(0);
session_start();

if(isset($_SESSION["user_id"])){
    $conn = require("dbconnect.php");
    $sql = "UPDATE Comment SET votes=votes+1 WHERE id='".$_POST["id"]."'";
    $conn->query($sql);
    $conn->close();
    

}
else{
    header("Location: login.php");
    die();
}

?>