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
    /* Dropdown Button */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
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
                                <li><a href="discuss.html">Discuss</a></li>
                                <li><a href="aboutUs.html">About Us</a></li>
                                <li><a href="contactUs.html">contactUs</a></li>
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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisi vitae suscipit tellus mauris. Nunc mi ipsum faucibus vitae aliquet. Sit amet cursus sit amet dictum sit amet justo donec. Id consectetur purus ut faucibus pulvinar. Egestas tellus rutrum tellus pellentesque eu tincidunt. Accumsan tortor posuere ac ut consequat semper viverra. Eleifend donec pretium vulputate sapien. Cursus mattis molestie a iaculis at erat pellentesque adipiscing. Ipsum dolor sit amet consectetur adipiscing elit pellentesque.
                </p>
            </section>
            <section>
                <h1>Mission Statement</h1>
                <p>
                    Viverra adipiscing at in tellus integer feugiat scelerisque. Et netus et malesuada fames. Tincidunt id aliquet risus feugiat in. Odio ut sem nulla pharetra diam. Nisi porta lorem mollis aliquam ut. Elementum integer enim neque volutpat ac tincidunt vitae semper. Dignissim cras tincidunt lobortis feugiat vivamus at. Eget dolor morbi non arcu risus quis. Felis donec et odio pellentesque diam volutpat commodo. Molestie nunc non blandit massa enim nec dui nunc. Nunc lobortis mattis aliquam faucibus purus in massa tempor nec. Sem nulla pharetra diam sit amet nisl suscipit. Orci a scelerisque purus semper eget. Id consectetur purus ut faucibus. Eget sit amet tellus cras adipiscing enim eu. Purus non enim praesent elementum. Posuere urna nec tincidunt praesent semper feugiat nibh. In dictum non consectetur a erat nam at lectus. Faucibus turpis in eu mi bibendum neque.
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