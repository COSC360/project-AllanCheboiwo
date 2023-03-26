<?php
$conn = require("dbconnect.php");
$sql = "UPDATE User SET user_level='".$_POST["enable"]."' WHERE id='".$_POST["user_id"]."'";
$conn->query($sql);
$conn->close();

?>