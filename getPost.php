<?php

    $conn= require("dbconnect.php");

    if($_POST["search"]==""){
      

        if($_POST["sort"]=="hot"){

            $sql = "SELECT * FROM Post WHERE category_name='".$_POST["category"]."' ORDER BY (votes/(TIMESTAMPDIFF(HOUR,created_at,NOW())+2)^1.8) DESC";
            $result = $conn->query($sql);
            //encode result to json
            $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
            echo $json;
    
        }
        else if($_POST["sort"]=="new"){
            $sql = "SELECT * FROM Post WHERE category_name='".$_POST["category"]."' ORDER BY created_at DESC";
            $result = $conn->query($sql);
            //encode result to json
            $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
            echo $json;
    
        }
        else{
            $sql = "SELECT * FROM Post WHERE category_name='".$_POST["category"]."' ORDER BY votes DESC";
            $result = $conn->query($sql);
            //encode result to json
            $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
            echo $json;
    
        }
}
else
{
    $sql = "SELECT * FROM Post WHERE category_name='".$_POST["category"]."' AND title LIKE '%".$_POST["search"]."%'";
    $result = $conn->query($sql);
    //encode result to json
    $json = json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;

}

?>
