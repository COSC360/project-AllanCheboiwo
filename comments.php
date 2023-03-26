<?php
    session_set_cookie_params(0);
    session_start();
    $post_id = $_GET["post_id"];
    
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
        <main>
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
            <div id="sort">
                <p>Sort by:</p>
                <button>Top</button>
                <button>New</button>
                <button>Hot</button>
            </div>
            <form id="postForm" method="post" action="process-comments.php" class="form">
                <legend>Create Comment</legend>
                <fieldset>

                <label for="content">Content</label>
                <input type="text" id="content" name="content" placeholder="..." class="required">
                <input type="hidden" id="post_id" name="post_id" value="<?php echo $post_id?>">
                <input type="submit" value="Post">
                </fieldset>
            </form>
  
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