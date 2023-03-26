<?php
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