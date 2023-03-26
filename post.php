<?php 
    session_set_cookie_params(0);
    session_start();
    $category=$_GET["category"];
    if(!isset($_SESSION["user_id"]))
    {
        header("Location: login.php");
        die();
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="script/validation.js"></script>
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
                    <li><a href="discuss.php">Discuss</a></li>
                    <li><a href="aboutUs.php">About Us</a></li>
                    <li><a href="contactUs.php">contactUs</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h1>Create Post</h1>
            <form id="postForm" method="post" action="process-post.php" class="form">
                <legend>Create Post</legend>
                <fieldset>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Title.." class="required">

                <label for="content">Content</label>
                <input type="text" id="content" name="content" placeholder="..." class="required" style="height:100px;width:200px;">
                <input type="hidden" id="category" name="category" value="<?php echo $category ?>">
                <input type="submit" value="Post">
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