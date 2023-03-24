<?php 
    $category=$_GET["category"];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
            <h1>Create Post</h1>
            <form id="postForm" method="post" action="process-post.php">
                <legend>Create Post</legend>
                <fieldset>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Title.." class="required">

                <label for="content">Content</label>
                <input type="text" id="content" name="content" placeholder="..." class="required">
                <input type="hidden" id="category" name="category" value="<?php echo $category ?>">
                <input type="submit" value="Post">
                </fieldset>
            </form>
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