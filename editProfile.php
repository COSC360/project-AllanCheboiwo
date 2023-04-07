<?php
session_set_cookie_params(0);
session_start();

    if (isset($_SESSION["user_id"])) {
        $conn = require("dbconnect.php");
        $sql = "SELECT * FROM User WHERE id ={$_SESSION["user_id"]}";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        
    
    }

else
{
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit profile</title>
        <link rel="stylesheet" href="css/styles.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    </head>
    <body>
    <header>
            <figure>
                <img src=" img/discuss.png" alt="logo" height="50" width="65">
                    <figcaption></figcaption>
            </figure >
                        <nav>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="discuss.php">Discuss</a></li>
                                <li><a href="aboutUs.php">About Us</a></li>
                                <li><a href="contactUs.php">contactUs</a></li>
                                <?php if (isset($user)&&$user["user_level"]==1): ?>
                                    <li><a href="admin.php">admin</a></li>
                                <?php endif; ?>


                               
                                <div class="dropdown" >
                                <span></span>
                                <img src="img/icons8-user-default-64.png" height="64" width="64" class="newUser" ></img>
                                <div id ="myDropdown" class="dropdown-content">
                                <?php if (isset($user)): ?>
                                    <span><?php echo "<span>".$user["username"]."</span>"; ?></span>
                                    <a href="profile.php">Profile</a>
                                    <a href="logout.php">Logout</a>
                                <?php else: ?>
                                    <a style="margin-top:1.5em" href="login.php">Login</a>
                                <?php endif; ?>
                                    
                                </div>
                            </div>  
                        </ul>
            </nav >
        </header >
        <main>
            <section>
            <h1>Change email</h1>
            <form action="changeEmail.php" method="post">
                <p><?php echo"Current Email: ".$user["email"]?></p>
                <label for="email">New email</label>
                <input type="text" name="email" id="email" ?>
                <input type="hidden" id="username" name="username" value="<?php echo $user["username"] ?>">
                <br>
                <input type="submit" value="Change Email">
            </form>
            <p>
            <?php 
            if(isset($_SESSION["success"])){
                echo $_SESSION["success"];
                unset($_SESSION["success"]);
            }
            if(isset($_SESSION["fail"])){
                echo $_SESSION["fail"];
                unset($_SESSION["fail"]);
            }
            ?>
            </p>
            </section>
    
            <h1>Change password</h1>
            <section>
            <form action="changePassword.php" method="post">
            <label for="oldPassword">Enter Current Password</label>
            <input type="password" name="oldPassword" id="oldPassword" class="required">
            <label for="password">Enter New Password</label>
            <input type="password" name="newPassword" id="newPassword" class="required">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" class="required">
            <input type="hidden" id="username" name="username" value="<?php echo $user["username"] ?>">
            <br>
            <input type="submit" value="Change Password">

            </form>
            <p>
            <?php 
            if(isset($_SESSION["success"])){
                echo $_SESSION["success"];
                unset($_SESSION["success"]);
            }
            if(isset($_SESSION["fail"])){
                echo $_SESSION["fail"];
                unset($_SESSION["fail"]);
            }
            ?>
            </p>


            </section>
        </main>

        <footer>
            <p>
                <a href="index.php">Home</a> |
                <a href="discuss.php">Discuss</a> |
                <a href="aboutUs.php">About Us</a> |
                <a href="contactUs.php">contactUs</a> 
            </p>
            <p>
                &copy; 2019 Discuss
            <p>
        </footer>
    <body>
</html>