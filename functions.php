<?php
ini_set("mail.log", "/tmp/mail.log");
ini_set("mail.add_x_header", TRUE);
session_start();

require_once __DIR__ . '/app.php';
// require_once __DIR__ . '/../config/database.php';
// require_once __DIR__ . '/libs/helpers.php';
// require_once __DIR__ . '/libs/flash.php';
// require_once __DIR__ . '/libs/sanitization.php';
// require_once __DIR__ . '/libs/validation.php';
// require_once __DIR__ . '/libs/filter.php';
// require_once __DIR__ . '/libs/connection.php';
require_once __DIR__ . '/auth.php';

function generate_activation_code(){
    return bin2hex(random_bytes(16));
}

function send_activation_email(string $email,string $activation_code){
    $subject="Activate your account";
    $message="Please click the link below to activate your account:\n\n";
    $activation_link ="http://cosc360.ok.ubc.ca/allank02/project-AllanCheboiwo/activate.php?email=$email&activation_code=$activation_code";
    $message.=$activation_link;
    $headers = array("From: kiplongeiallan@gmail.com",
    "Reply-To: kiplongeiallan@gmail.com",
    "X-Mailer: PHP/" . PHP_VERSION
    );
    $headers = implode("\r\n", $headers);
    //$email = "$email";
    return mail($email,$subject,$message,$headers);//true or false
}
function delete_user_by_id(int $id,int $active=0){
    $conn=require("dbconnect.php");
    $sql="DELETE FROM User WHERE id=? and active=?";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
        die("SQL Error: ". $conn->error);
    }
    $stmt->bind_param("ii",$id,$active);
    return $stmt->execute();
}
function find_unverififed_user(string $activation_code,string $email){
    $conn=require("dbconnect.php");
    $sql="SELECT id,activation_code,activation_expiry<now() as expired FROM User WHERE email=? and active=0";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
        die("SQL Error: ". $conn->error);
    }
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result=$stmt->get_result();
    $result->fetch_assoc();
    if($user){
       if((int)$user["expired"]===1){
           delete_user_by_id($user["id"]);
           return null;
       }
       if(password_verify($activation_code,$user["activation_code"])){
           return $user;
       }

    }
    return null;
}
function activate_user(int $user_id){
    $conn=require("dbconnect.php");
    $sql="UPDATE User SET active=1,activated_at=CURRENT_TIMESTAMP WHERE id=?";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
        die("SQL Error: ". $conn->error);
    }
    $stmt->bind_param("i",$user_id);
    return $stmt->execute();
}

?>
