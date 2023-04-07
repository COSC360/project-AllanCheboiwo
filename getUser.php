<?php
$conn= require("dbconnect.php");
if(empty($_POST["search"])){
    $sql="SELECT id,username,user_level,email,created_at FROM User";
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        die("No results found");
    }
    //encode result to json
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;

}
else{

    $sql="SELECT id,username,user_level,email,created_at FROM User WHERE username LIKE '%".$_POST["search"]."%' OR email LIKE '%".$_POST["search"]."%'";
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        die("No results found");
    }
    //encode result to json
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;

}

?>