<?php
function create_user(string $username, string $email, string $password,string $activation_code ,int $expiry = 1 * 24  * 60 * 60,int $user_level=0){
    $conn=require("dbconnect.php");
    $password_hash=password_hash($password,PASSWORD_DEFAULT);
    $activation_code=password_hash($activation_code,PASSWORD_DEFAULT);
    $activation_expiry = date("Y-m-d H:i:s",time()+$expiry);
    $sql="INSERT INTO User(username, email, password,user_level,activation_code,activation_expiry) VALUES (?, ?, ?, ?, ?,?)";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
        die("SQL Error: ". $conn->error);
    }
    $stmt->bind_param("sssiss",$username,$email, $password_hash,$user_level,$activation_code,$activation_expiry);
    return $stmt->execute();
}
function find_user_by_username(string $username){
    $conn=require("dbconnect.php");
    $sql="SELECT username,password,active,level,email FROM User WHERE $username=?";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
        die("SQL Error: ". $conn->error);
    }
    $stmt->bind_param("s",$username,);
    $stmt->execute();
    $result=$stmt->get_result();
    return $result->fetch_assoc();
}
function is_user_active($user){
    return (int)$user["active"]==1;
}

function login(string $username,string $password):bool{

    $user=find_user_by_username($username);

    if($user && is_user_active($user)&&password_verify($password,$user["password"])){
        session_regenerate_id();
        session_start();
        
        $_SESSION["username"]=$user["username"];
        $_SESSION["user_level"]=$user["user_level"];
        $_SESSION["user_id"]=$user["user_id"];
        return true;
    }

    return false;
}
function sort_hot(string $table){
    $conn=require("dbconnect.php");
    $sql="SELECT * FROM".$table."ORDER BY (votes/(TIMESTAMPDIFF(HOUR,created_at,NOW())+2)^1.8) DESC";
    $result=$conn->query($sql);
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;
    return $json;
}
function sort_new(string $table){
    $conn=require("dbconnect.php");
    $sql="SELECT * FROM".$table."ORDER BY created_at ASC";
    $result=$conn->query($sql);
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;
    return $json;
}

function sort_top(string $table){
    $conn=require("dbconnect.php");
    $sql="SELECT * FROM".$table."Post ORDER BY votes DESC";
    $result=$conn->query($sql);
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;
    return $json;
   
}
function logout(){
    session_start();
    session_destroy();
}

?>