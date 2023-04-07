<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_set_cookie_params(0);
session_start();

if (isset($_SESSION["user_id"])) {
    $conn = require("dbconnect.php");
    $sql = "SELECT * FROM User WHERE id ={$_SESSION["user_id"]}";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contact Us</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="script/validation.js"></script>
        <script src="https://smtpjs.com/v3/smtp.js"></script>
        <script src="script/sendEmail.js"></script>
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
        <div id="category">
            <h1>Contact Us</h1>
        </div>
        <main>
            <h2>Contacts</h2>
            <p>
                Email: johndoe@gmail
                <br>
                Phone: 0123456789 
            </p>
            <form class="form" id="contactForm" action="contactForm.php" method="post">
                <legend>Contact Form</legend>
                <fieldset>
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" placeholder="Your First Name.." class="required">
                <br>
                <label for="sname">Second Name:</label>
                <input type="text" id="sname" name="sname" placeholder="Your Second Name.." class="required">
                <br>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Your email.." class="required">
                <br>
                <label for="messgage">Subject:</label>
                <textarea id="message" name="message" placeholder="Write something.." style="height:100px" class="required"></textarea>
                <br>
                <input type="submit" value="Submit">
                </fieldset>
            </form>

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
    </body>
</html>