<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    $post_id = $_GET["post_id"];
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
        <title>Discuss</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="script/validation.js"></script>
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
        <br>
            <br>
            <form id="postForm" method="post" action="process-comments.php" class="form">
                <legend>Create Comment</legend>
                <fieldset>

                <label for="content">Content</label>
                <input type="text" id="content" name="content" placeholder="..." class="required">
                <input type="hidden" id="post_id" name="post_id" value="<?php echo $post_id?>">
                <input type="submit" value="Post">
                </fieldset>
            </form>
            <br>
            <br>
            <div id="sort">
                <p>Sort by:</p>
                <button>Top</button>
                <button>New</button>
                <button>Hot</button>
            </div>
  
            </div>
            <script>
            setInterval(comments, 1000);
            function comments(){
            var post_id='<?php echo $post_id;?>';
            $.ajax({
                dataType: "json",
                url: "getComments.php",
                type: "post",
                data:{post_id:post_id},
                success: function(data){
                    console.log(data);
                    $("#comments").empty();
                    for(var i = 0; i < data.length; i++){
                        var postBox= $("<div class='commentBox'></div>");
                        //var upDownVote = $("<div class='upDownVote'></div>");
                        //var upVote = $("<button>&uarr;</button>");
                        //var vote = $("<p>Vote</p>");
                        //var downVote = $("<button>&darr;</button>");
                        //postBox.append(upDownVote);
                        //upDownVote.append(upVote);
                        //upDownVote.append(vote);
                        //upDownVote.append(downVote);
                        var post = $("<div class='post'></div>");
                        var postedBy = $("<p>Posted by username 2 hours ago</p>");
                        var postContent = $("<p>"+data[i].content+"</p>");
                        postBox.append(post);
                        post.append(postedBy);
                        post.append(postContent);
                        $("#comments").append(postBox);
                    }
                }
                });
            };
            </script>
            <div id="comments">
            </div>


    

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