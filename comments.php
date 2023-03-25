<?php
   
    $post_id = $_GET["post_id"];
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Discuss</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
            <form id="postForm" method="post" action="process-comments.php">
                <legend>Create Comment</legend>
                <fieldset>

                <label for="content">Content</label>
                <input type="text" id="content" name="content" placeholder="..." class="required">
                <input type="hidden" id="post_id" name="post_id" value="<?php echo $post_id?>">
                <input type="submit" value="Post">
                </fieldset>
            </form>
            <!-- <div class="postBox">
                <div class="upDownVote">
                    <button>&uarr;</button>
                    <p>Vote</p>
                    <button>&darr;</button>
                </div>
                <div class="post">
                    <p>Posted by username 2 hours ago</p>
                    <h2>Lorem Ipsum</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ornare lectus sit amet est placerat in egestas erat. Aliquet porttitor lacus luctus accumsan tortor posuere ac ut consequat.
                        Quam pellentesque nec nam aliquam sem. Amet cursus sit amet dictum. Sed vulputate odio ut enim blandit volutpat maecenas volutpat blandit.
                         Adipiscing diam donec adipiscing tristique risus nec feugiat. Euismod in pellentesque massa placerat duis ultricies lacus sed turpis. 
                         Enim facilisis gravida neque convallis a cras semper auctor neque. Nisl suscipit adipiscing bibendum est ultricies integer quis. Ut etiam sit amet nisl.
                         Netus et malesuada fames ac turpis egestas sed. Pharetra et ultrices neque ornare aenean euismod elementum.</p>
                </div>
                <div class="comments">
    
                </div> -->
            </div>
            <script>
            setInterval(comments, 5000);
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