
<?php

$disabled=false;
$invalid=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn = require("dbconnect.php");
    $sql =sprintf( "SELECT * FROM User WHERE username = '%s'",$conn->real_escape_string($_POST["username"]));

    $result = $conn->query($sql);

    $user = $result->fetch_assoc();

    if($user){
        if($user["user_level"]==2){
            $disabled=true;
        }
        else{
            if(password_verify($_POST["password"], $user["password"])){
                session_start();
                session_regenerate_id();
                $_SESSION["user_id"] = $user["id"];
                header("Location: index.php");
                exit;
            }
        }

}
$invalid=true;
}
?>
<!DOCTYPE html>
<html>  
    <head>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
        <script src="script/validation.js"></script>
    </head>
    <body>
        <h1>Login</h1>
        <?php if($disabled): ?>
            <em>Account has been temporarily disabled. Contact <a href="contactUs.html">Support</a> for more information</em>
        <?php elseif($invalid):?>
            <em>Invalid login</em>    
        <?php endif; ?>
        <form method="post" class="form">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" value="<?=htmlspecialchars($_POST["username"] ?? "" )?>" class="required">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" class="required">
            <input type="submit" value="Log in">
        </form>
        <p>Not a User? <a href="signup.html">SIGN UP</a></p>
         </div>
    </body>
</html>