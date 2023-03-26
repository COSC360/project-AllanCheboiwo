<!DOCTYPE html>
<?php
session_set_cookie_params(0);
session_start();

if (isset($_SESSION["user_id"])) {
    $conn = require("dbconnect.php");
    $sql = "SELECT * FROM User WHERE id ={$_SESSION["user_id"]}";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

}
?>
<html>
    <head>
        <title>About Us</title>
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
                                <?php if (isset($user)): ?>
                                    <span><?php echo "<span>".$user["username"]."</span>"; ?></span>
                                <?php else: ?>

                                    <a href="login.php">Login</a>

                                <?php endif; ?>
                                <span></span>
                                <img src="img/icons8-user-default-64.png" height="64" width="64" class="newUser" ></img>
                                <div id ="myDropdown" class="dropdown-content">
                                <?php if (isset($user)): ?>
                                    <a href="profile.php">Profile</a>
                                    <a href="logout.php">Logout</a>
                                <?php endif; ?>
                                    
                                </div>
                            </div>   
                        </ul>
            </nav >
        </header >
        <div id="category">
            <h1>About Us</h1>
        </div>
        <main>
            <section class="profile">
                <figure>
                    <img src="img/spongebob.jpeg" alt="John Doe" height="200" width="200">
                    <figcaption>John Doe</figcaption>
                </figure>
                <h2>John Doe</h2>
                <p>
                John Doe is one of the creators of this website/forum, and he brings his passion for creating meaningful conversations to the community. With his background in [insert relevant background or experience], John helps shape the direction of the website/forum. He believes in fostering an open, respectful, and inclusive community where everyone feels welcome and valued. John is committed to improving the user experience and making this site a valuable resource for all members. As a creator, he is always available to answer questions and listen to suggestions on how to make the site even better. Thank you for being a part of our community, and we look forward to your continued engagement.
                </p>
            </section>
            <section class="profile">
                <img src="img/patrick.jpeg" alt="John Doe" height="200" width="200">
                <figcaption>Jane Doe</figcaption>
            </figure>
            <h2>Jane Doe</h2>
            <p>
            Jane Doe is a passionate member and creator of this website/forum. With her expertise in [insert relevant experience], Jane helps shape the direction of the community to ensure it remains a welcoming and inclusive space for all members. She believes in open and respectful dialogue and is committed to promoting understanding and growth through meaningful conversations. As a member of this community, Jane aims to contribute in a positive way and learn from the perspectives of others. She is dedicated to upholding the community standards of the website/forum and fostering a safe and supportive environment for all. Thank you for being a part of our community, and we're excited to hear your thoughts and ideas!
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
    </body>
</html>