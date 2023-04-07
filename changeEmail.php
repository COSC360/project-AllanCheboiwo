<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["username"])){
        die("Please enter your username");
    }
    if(empty($_POST["email"])){
        die("Please enter your username");
    }

    $connection = require("dbconnect.php");

    $sql=sprintf("SELECT * FROM User WHERE username = '%s'",$connection->real_escape_string($_POST["username"]));
    $result = $connection->query($sql);
    $user = $result->fetch_assoc();

    if($user){
        $sql = sprintf("UPDATE User SET email = '%s' WHERE username = '%s'",$_POST["email"],$connection->real_escape_string($_POST["username"]));
        $result = $connection->query($sql);
            if($result){
               $_SESSION["success"]="Email updated successfully";
               header("Location: ".$_SERVER['HTTP_REFERER']);
               exit;
               
            }
            else{
                $_SESSION["fail"]="Unable to update email";
                header("Location: ".$_SERVER['HTTP_REFERER']);
                exit;
            }

    }
    else{
    }

    

}
else{
    die("Invalid request");
}
?>