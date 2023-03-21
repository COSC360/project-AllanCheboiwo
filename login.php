
<?php

$is_invalid=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn = require("dbconnect.php");
    $sql =sprintf( "SELECT * FROM User WHERE username = '%s'",$conn->real_escape_string($_POST["username"]));

    $result = $conn->query($sql);

    $user = $result->fetch_assoc();

    if($user){
       if(password_verify($_POST["password"], $user["password"]))
         {
              session_start();

              session_regenerate_id();
              $_SESSION["user_id"] = $user["id"];
              header("Location: index.php");
              exit;
         }
            
    }
    $is_invalid=true;
}
?>
<!DOCTYPE html>
<html>  
    <head>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
    </head>
    <body>
        <h1>Login</h1>
        <?php if($is_invalid): ?>
            <em>Invalid login</em>
        <?php endif; ?>
        <form method="post">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" value="<?=htmlspecialchars($_POST["username"] ?? "" )?>">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password">

            <input type="submit" value="Log in">
        </form>
        </div>
    </body>
</html>