<?php
ini_set("mail.log", "/tmp/mail.log");
ini_set("mail.add_x_header", TRUE);
session_start();

if(isset($_SESSION["username"])){
    header("Location: login.php");
    exit;
}

if(empty($_POST["username"])){
    $_SESSION["error"]="Username is required";
    header("Location: signup.html");
    exit;
    
}

if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $_SESSION["error"]="Email is invalid";
    header("Location: signup.html");
    exit;
}   
if(strlen($_POST["password"]) < 8){
    $_SESSION["error"]="Password must be at least 8 characters long";
    header("Location: signup.html");
    exit;
}
if(! preg_match("/[A-Z]/", $_POST["password"])){
    $_SESSION["error"]="Password must contain at least one uppercase letter";
    header("Location: signup.html");
    exit;
}
if(! preg_match("/[a-z]/", $_POST["password"])){
    $_SESSION["error"]="Password must be at least 8 characters long";
    header("Location: signup.html");
    exit;
}
if(! preg_match("/[0-9]/", $_POST["password"])){
    $_SESSION["error"]="Password must contain at least one number";
    header("Location: signup.html");
    exit;
}
if(! preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $_POST["password"])){
    $_SESSION["error"]="Password must contain at least one special character";
    header("Location: signup.html");
    exit;
}

if($_POST["password"] !== $_POST["cpassword"]){
    $_SESSION["error"]="Passwords do not match";
    header("Location: signup.html");
    exit;
}

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/app.php';
require_once __DIR__ . '/bootstrap.php';
$activation_code = generate_activation_code();

$conn = require("dbconnect.php");
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$expiry = 1 * 24  * 60 * 60;
$user_level=0;
$activation_expiry = date("Y-m-d H:i:s",time()+$expiry);
$sql="INSERT INTO User(username, email, password,user_level,activation_code,activation_expiry) VALUES (?, ?, ?, ?, ?,?)";
$stmt = $conn->stmt_init();
if(!$stmt->prepare($sql)){
    die("SQL Error: ". $conn->error);
}

$stmt->bind_param("sssiss",$_POST["username"],$_POST["email"], $password_hash,$user_level,$activation_code,$activation_expiry);
if($stmt->execute()){
    $_SESSION["success"]="Account created successfully. Please check your email for activation link before signing in.";
    if(send_activation_email($_POST['email'], $activation_code)){
        header("Location: login.php");
        exit;
    }
    else
    {
        echo "Error sending email";
    }

}
else{
    $_SESSION["error"]="Username or email already exists";
    header("Location: signup.php");
    exit;

}


// if(create_user($_POST["username"],$_POST["email"],$_POST["password"],$activation_code)){
//     $_SESSION["success"]="Account created successfully. Please check your email for activation link before signing in.";
//     send_activation_email($_POST['email'], $activation_code);
//     header("Location: login.php");
//     exit;

// }
// else{
    //     $_SESSION["error"]="Username or email already exists";
//     header("Location: signup.php");
//     exit;


// }
?>