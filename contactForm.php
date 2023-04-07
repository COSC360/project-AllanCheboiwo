<?php
$conn = require("dbconnect.php");
if(!preg_match("/^([a-zA-Z' ]+)$/",$_POST["fname"])){
    die("valid name is required");
}
if(!preg_match("/^([a-zA-Z' ]+)$/",$_POST["sname"])){
    die("valid name is required");
}
if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Email is invalid");
} 
if(empty($_POST["message"])){
    die("Message is required");
}
if(strlen($_POST["message"]) < 10){
    die("Message must be at least 10 characters");
}

$email_to="allangabz@gmail.com";
$email_subject="Contact Form Message";
$email_message="First Name: " . $_POST["fname"] . "\n";
$email_message.="Last Name: " . $_POST["sname"] . "\n";
$email_message.="Message: " . $_POST["message"] . "\n";

$headers = 'From: ' . $_POST["email"] . "\r\n" .
'Reply-To: ' . $_POST["email"] . "\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Message Sent</title>
</head>
<body>
    <h1>Message Sent</h1>
    <p>Thank you for your message. We will get back to you shortly.</p>
    <a href="index.php">Return to Home</a>
</body>
</html>