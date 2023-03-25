<?php
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
        <div id="category">
            <h1><?php echo $category ?></h1>
        </div>
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
        setInterval(post, 2000);
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
                        var vote = $("<p>Vote</p>");
                        var downVote = $("<button>&darr;</button>");
                        postBox.append(upDownVote);
                        upDownVote.append(upVote);
                        upDownVote.append(vote);
                        upDownVote.append(downVote);
                        var post = $("<div class='post'></div>");
                        var postedBy = $("<p>Posted by username 2 hours ago</p>");
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
                        
                    }
                }
                });
            };

</script>
        <div id=posts>
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