<?php
$conn= require("dbconnect.php");
$sql="SELECT username FROM User WHERE id='".$_POST["user_id"]."'";
$result = $conn->query($sql);
if($result->num_rows == 0){
    die("No results found");
}
//encode result to json
$json = json_encode($result->fetch_all(MYSQLI_ASSOC));
echo $json
?>