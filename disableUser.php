<?php
$conn = require("dbconnect.php");
$sql = "UPDATE User SET user_level=2 WHERE id='12';
$conn->query($sql);
$conn->close();

?>