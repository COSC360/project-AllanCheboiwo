<?php
session_set_cookie_params(0);
session_start();

if(isset($_SESSION["user_id"])){
    $conn = require("dbconnect.php");
    $sql = "UPDATE Post SET votes=".$_POST["votes"]."' WHERE id='".$_SESSION["user_id"]."'";
    $conn->query($sql);
    $conn->close();
    

}
else{
    header("Location: login.php");
    die();
}

?>