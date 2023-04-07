<?php
require_once __DIR__ . '/functions.php';
if(empty($_GET['activation_code']))
{
    exit("Activation code is missing");
}
if(empty($_GET['email']))
{
    exit("Email is missing");
}
$activation_code = $_GET['activation_code'];
$email = $_GET['email'];

$user = find_unverififed_user($activation_code,$email);
if(!$user){
    exit("Invalid activation code or email");
}
else{
    activate_user($user["id"]);
    header("Location: login.php");

}


?>
