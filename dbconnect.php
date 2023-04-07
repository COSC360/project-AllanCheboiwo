<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "DiscussionForum";

    $conn = mysqli_connect($servername, $username, $password, $database);
    
    if($conn->connect_errno){
        die("Sorry we failed to connect: ". $mysqli->connect_error);
    }

    return $conn;

?>