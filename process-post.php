<?php
session_start();

if(isset($_SESSION["user_id"])){
    $conn = require("dbconnect.php");
    if(empty($_POST["title"])){
        die("Title is required");
    }
    if(empty($_POST["content"])){
        die("Content is required");
    }
    if(empty($_POST["category"])){
        die("Category is required");
    }
    
    
    $sql = "INSERT INTO Post(title, content,user_id, category_name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
        die("SQL Error: ". $conn->error);
    }
    $stmt->bind_param("ssis", $_POST["title"], $_POST["content"], $_SESSION["user_id"], $_POST["category"]);
    if($stmt->execute()){
        header("Location: category.php?category=".$_POST["category"]."");
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