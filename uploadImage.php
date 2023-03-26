<?php

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
    <title>Home Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript" src="script/image.js"></script>
  
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
                               
                            <div class="dropdown" >
                                <?php
                                    if(isset($user)){
                                        echo "<span>".$user["username"]."</span>";
                                    }
                                ?>
                                <span></span>
                                <img src="#" class="newUser" ></img>

                                <div id ="myDropdown" class="dropdown-content">
                                <?php if (isset($user)): ?>
                                    <a><?= htmlspecialchars($user["username"]) ?></a>
                                    <a href="logout.php">Logout</a><
                                <?php else: ?>

                                    <a href="login.php">Login</a>

                            <?php endif; ?>
                                    
                                </div>
                            </div>   
                        </ul>
            </nav >
        </header >
        <main>
        <h1>Upload Image</h1>
        <img href="#" height =100>
        <form action="uploadImage.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="image" id="image">
        <input type="submit" value="Upload Image" name="submit">
        </form>

        <?php
        if(isset($_POST["submit"])){
       $file =basename($_FILES["image"]["name"]);
       
       $fileType =pathinfo($file,PATHINFO_EXTENSION);
       
      
        if($_FILES["image"]["error"]!=UPLOAD_ERR_OK){
            die("file has error");
        }
       
       // Check file size
       $max_file_size=10000000;
       if ($_FILES["image"]["size"] > $max_file_size) {
        die("Sorry, your file is too large.");
       }
       
       // Allow certain file formats
       if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
         die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
         
       }
       
       //get image
       $image=$_FILES["image"]["tmp_name"];
       $imgContent=addslashes(file_get_contents($image));

       $sql= "UPDATE User SET image=('$imgContent') WHERE id='".$_SESSION["user_id"]."'";

       $result=$conn -> query($sql);

       if(!$result){
       die("File not uploaded successfully"); 
       }
       else{
        header("Location: profile.php");
        exit;
       }
    }
        ?>
        
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
