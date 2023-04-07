<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["username"])){
        die("Please enter your username");
    }
    if(empty($_POST["oldPassword"])){
        die("Please enter your password");
    }
    if(empty($_POST["newPassword"])){
        die("Please enter your new password");
    }
    if(empty($_POST["cpassword"])){
        die("Please enter your confirm password");
    }
    if(strcmp($_POST["newPassword"],$_POST["cpassword"])!=0){
        die("Passwords do not match");
    }
    
    $connection = require("dbconnect.php");

    $password=password_hash($_POST["oldPassword"],PASSWORD_DEFAULT);
    $newpassword=password_hash($_POST["newPassword"],PASSWORD_DEFAULT);

    $sql=sprintf("SELECT * FROM User WHERE username = '%s'",$connection->real_escape_string($_POST["username"]));
    $result = $connection->query($sql);
    $user = $result->fetch_assoc();

    if($user){
  
            if(password_verify($_POST["oldPassword"], $user["password"])){
                $sql = sprintf("UPDATE User SET password = '%s' WHERE username = '%s'",$newpassword,$connection->real_escape_string($_POST["username"]));
                $result = $connection->query($sql);
                if($result){
                    $_SESSION["success"]="Password updated successfully";
                    header("Location: ".$_SERVER['HTTP_REFERER']);
                    exit;
                }
                else{
                    $_SESSION["fail"]="Unable to update password";
                    header("Location: ".$_SERVER['HTTP_REFERER']);
                    exit;
                }
            }
        

}

else{

    }

}
else{
    die("Invalid request");
}
?>