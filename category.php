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
    
    
    $conn = require("dbconnect.php");
     $category=$_GET["category"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $category ?></title>
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

                                    <a style="margin-top:1.5em" href="login.php">Login</a>

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
            <h1><?php echo $category ?></h1>
        </div>
        <div class="layout">
            <main>
            <a href="post.php?category=<?php echo $category ?>">
                <textarea  id="createPost" placeholder="Create Post"></textarea>
            </a>
            <div id="sort">
                <p>Sort by:</p>
                <button>Top</button>
                <button>New</button>
                <button>Hot</button>
            </div>
            <script>
            setInterval(post, 1000);
            function post(){
                var category='<?php echo $category; ?>';
                $.ajax({
                    dataType: "json",
                    url: "getPost.php",
                    type: "post",
                    data:{category:category},
                    success: function(data){
                        $("#posts").empty();
                        for(var i = 0; i < data.length; i++){
                            var postBox= $("<div class='postBox'></div>");
                            var upDownVote = $("<div class='upDownVote'></div>");
                            var upVote = $("<button>&uarr;</button>");
                            var vote = $("<p>"+data[i].votes+"</p>");
                            var downVote = $("<button>&darr;</button>");
                            postBox.append(upDownVote);
                            upDownVote.append(upVote);
                            upDownVote.append(vote);
                            upDownVote.append(downVote);
                            var post = $("<div class='post'></div>");
                            // var user_id=data[i].user_id;
                            // var username="";
                            // $.ajax({
                            // dataType: "json",
                            // url: "getUsername.php",
                            // type: "POST",
                            // data: {user_id:user_id},
                            // success: function(data){
                            //     console.log(data);
                            //     username=data[0].username;
                            // },     
                            // });
                            var postedBy = $("<p>Posted by allan</p>");
                            var title = $("<h2>"+data[i].title+"</h2>");
                            var postContent = $("<p>"+data[i].content+"</p>");
                            postBox.append(post);
                            post.append(postedBy);
                            post.append(title);
                            post.append(postContent);
                            var comments = $("<div class='comments'></div>");
                            var commentButton = $("<button>Comments</button>");
                            var post_id = data[i].id;
                            postBox.append(comments);
                            comments.append(commentButton);
                            $("#posts").append(postBox);
                            
                            commentButton.click(function(){
                                document.location="comments.php?post_id="+post_id;
                                    });

                            var votes= 1;
                            upVote.click(function(){
                                $.ajax({
                                    url: "updateVotes.php",
                                    type: "post",
                                    data:{votes:votes},
                                    success:function(){
                                        console.log("successsful!");
                                    }
                                });
                            })

                            downVote.click(function(){
                                $.ajax({
                                    url: "updateVotes.php",
                                    type:"post",
                                    data:{votes:votes},
                                    success:function(){
                                        console.log("successsful!");
                                    }
                                });
                                
                            })
                            
                        }
                    }
                    });
                };

            </script>
            <div id=posts>
            </div>
            </main>
            <aside>
                <h1>General Community Guildlines</h1>
            <ul>
                <li>Be respectful of others and their opinions.</li>
                <li>Keep discussions civil and constructive.</li>
                <li>Avoid personal attacks, harassment, and hate speech.</li>
                <li>Do not post spam or irrelevant content.</li>
                <li>Stay on topic and avoid derailing conversations.</li>
                <li>Respect the privacy of others and do not share personal information without consent.</li>
                <li>Report any inappropriate behavior or content to the forum moderators.</li>
                <li>Do not engage in any illegal activities or encourage others to do so.</li>
                <li>Follow the rules and guidelines set by the forum administrators.</li>
            </ul>
            </aside>
        </div>

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