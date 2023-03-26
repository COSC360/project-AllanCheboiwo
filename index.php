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

<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript" src="script/image.js"></script>
    <style> 
            .dropbtn {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            }

            .dropbtn:hover, .dropbtn:focus {
            background-color: #2980B9;
            }

            .dropdown {
            position: relative;
            display: inline-block;
            }

            .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            }

            .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            }

            .dropdown-content a:hover {background-color: #ddd;}


            .show {display:block;}
    </style>
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
        <main>
            <section>
                <h1>Brief Introduction</h1>
                <p>
                Welcome to our discussion forum! This is a space for individuals to come together and exchange ideas, opinions, and knowledge on various topics of interest. Our goal is to facilitate respectful and constructive conversations that promote learning and understanding. We encourage participants to share their diverse perspectives and engage in open-minded dialogue. Let's have a productive and enjoyable discussion!
                </p>
            </section>
            <section>
                <h1>Mission Statement</h1>
                <p>
                Our mission is to create a positive and inclusive community that fosters open and honest communication, mutual respect, and collaborative learning. We believe in the power of dialogue to broaden perspectives, challenge assumptions, and inspire growth. Through our forum, we strive to provide a platform for individuals from diverse backgrounds and experiences to share their insights, ask questions, and engage in meaningful conversations. We are committed to upholding the values of civility, empathy, and intellectual curiosity, and to promoting a culture of lifelong learning and personal development.
                </p>
            </section>
        </main>

        <footer>
            <p>
                <a href="index.php">Home</a> |
                <a href="discuss.html">Discuss</a> |
                <a href="aboutUs.html">About Us</a> |
                <a href="contactUs.html">contactUs</a> 
            </p>
            <p>
                &copy; 2019 Discuss
            <p>
        </footer>
    </body>
</html>