<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(empty($_POST["username"])){
    die("Username is required");
}

if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Email is invalid");
}   
if(strlen($_POST["password"]) < 8){
    die("Password must be at least 8 characters");
}
if(! preg_match("/[A-Z]/", $_POST["password"])){
    die("Password must contain at least one uppercase letter");
}
if(! preg_match("/[a-z]/", $_POST["password"])){
    die("Password must contain at least one lowercase letter");
}
if(! preg_match("/[0-9]/", $_POST["password"])){
    die("Password must contain at least one number");
}
if(! preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $_POST["password"])){
    die("Password must contain at least one special character");
}

if($_POST["password"] !== $_POST["cpassword"]){
    die("Passwords do not match");
}
echo "yessir";
// $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// $conn=require("dbconnect.php");

// $sql = "INSERT INTO User(username, email, password) VALUES (?, ?, ?)";
// $stmt = $conn->stmt_init();
// if(!$stmt->prepare($sql)){
//     die("SQL Error: ". $conn->error);
// }
// $stmt->bind_param("sss", $_POST["username"], $_POST["email"], $password_hash);
// if($stmt->execute()){
//     header("Location: signup-success.html");
//     exit;
// }
// else{
//     die($conn->errno);
// }


// $sql = "SELECT username FROM User WHERE username = ?";
// $stmt = $conn->stmt_init();
// if(!$stmt->prepare($sql)){
//     die("SQL Error: ". $conn->error);
// }
// $stmt->bind_param("s", $_POST["username"]);

// $stmt->execute();

// $result = $stmt->get_result();

// $count = mysqli_num_rows($result);

// if($count==0){
//     $sql = "INSERT INTO User(username, email, password_hash) VALUES (?, ?, ?)";
//     $stmt = $conn->stmt_init();
//     if(!$stmt->prepare($sql)){
//         die("SQL Error: ". $conn->error);
//     }
//     $stmt->bind_param("sss", $_POST["username"], $_POST["email"], $password_hash);

//     $stmt->execute();
//     header("Location: login.html");
//     die();
// }
// else{
//     die("Username already exists");
// }

?>
