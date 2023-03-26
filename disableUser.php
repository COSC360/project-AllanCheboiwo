<?php
$conn = require("dbconnect.php");
$sql = "UPDATE User SET user_level=2 WHERE id='".$_POST["user_id"]."'";
$conn->query($sql);
$conn->close();

?>