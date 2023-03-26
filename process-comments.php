<?php
session_start();

if(isset($_SESSION["user_id"])){
    $conn = require("dbconnect.php");
    if(empty($_POST["content"])){
        die("Title is required");
    }
    
    
    $sql = "INSERT INTO Comment(content,post_id,user_id) VALUES (?, ?, ?)";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
        die("SQL Error: ". $conn->error);
    }
    $stmt->bind_param("sii", $_POST["content"], $_POST["post_id"], $_SESSION["user_id"]);
    if($stmt->execute()){
        header("Location: comments.php?post_id=".$_POST["post_id"]."");
        exit;
    }
    else{
        die($conn->errno);
    }
    

}
else{
    header("Location: login.php");
    die();
}

?>