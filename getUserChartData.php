<?php
$conn = require("dbconnect.php");

if(empty($_GET["value"])){
    die("value is required");  
}

$period=$_GET["value"];



if($period==7){
    $sql = "SELECT COUNT(*) AS num_registrations,WEEK(DATE(created_at)) AS registration_date
    FROM User
    WHERE created_at >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 2 MONTH))
    GROUP BY registration_date;
    ";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
else if($period==1){
    $sql = "SELECT COUNT(*) AS num_registrations, DATE(created_at) AS registration_date
    FROM User
    WHERE created_at >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 DAY))
    GROUP BY registration_date;
    ";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);

}


else if($period==30){
    $sql = "SELECT COUNT(*) AS num_registrations, DATE_FORMAT((created_at),'%Y-%m') AS registration_date
    FROM User
    WHERE created_at >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 YEAR))
    GROUP BY registration_date;
    ";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
else{
    $sql = "SELECT COUNT(*) AS num_registrations, DATE_FORMAT((created_at),'%Y') AS registration_date
    FROM User
    WHERE created_at >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 5 YEAR))
    GROUP BY registration_date;
    ";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}


?>