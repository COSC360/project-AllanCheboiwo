<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    $servername = "cosc360.ok.ubc.ca";
    $username = "73661290";
    $password = "73661290";
    $database = "db_73661290";

    $conn = mysqli_connect($servername, $username, $password, $database);
    
    if($conn->connect_errno){
        die("Sorry we failed to connect: ". $mysqli->connect_error);
    }

    return $conn;

?>
