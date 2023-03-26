<?php
    session_set_cookie_params(0);
    session_start();
    $conn = require("dbconnect.php");
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
        <title>Profile</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#profPic").click(function(){
                    document.location="uploadImage.php";
                });
            });
        </script>
        <style>
    
        </style>

    </head>
    <body>
        <header>
            <figure>
                <img src="img/discuss.png" alt="logo" height="50" width="65">
                <figcaption></figcaption>
            </figure>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="discuss.html">Discuss</a></li>
                    <li><a href="aboutUs.html">About Us</a></li>
                    <li><a href="contactUs.html">contactUs</a></li>
                </ul>
            </nav>

        </header>
        
        <main>
        <h1>Profile</h1>
        <div id="profile">
        <?php if($result->num_rows > 0){ ?> 
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($user['image']); ?>" height="200" width="200" alt="Profile Picture"/> 
        <?php }else{ ?> 
            <img src="#" alt="default" height="200" width="200">
        <?php } ?>
        <br>
        <button id='profPic'>Change Profile Picture</button>
        <p>Username: <?php echo $user['username']; ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
        </div>

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