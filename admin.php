<?php
     $conn = require("dbconnect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#searchButton").click(function(){
                    var search = $("#search").val();
                    $.ajax({
                        dataType: "json",
                        url: "getUser.php",
                        type: "POST",
                        data: {search: search},
                        success: function(data){
                            $(".user").empty();
                            for(var i = 0; i < data.length; i++){
                                var userBox = $("<div class='userBox'></div>");
                                var username = $("<p>"+data[i].username+"</p>");
                                var email = $("<p>"+data[i].email+"</p>");
                                var role = $("<p>"+data[i].user_level+"</p>");
                                var deleteButton = $("<button class='delete'>Delete</button>");
                                var disableButton = $("<button class='disable'>Disable</button>");
                                userBox.append(username);
                                userBox.append(email);
                                userBox.append(role);
                                userBox.append(deleteButton);
                                userBox.append(disableButton);
                                var user_id = data[i].id;
    
                                deleteButton.click(function(){
                                    $.ajax({
                                        dataType: "json",
                                        url: "deleteUser.php",
                                        type: "POST",
                                        data: {user_id: user_id},
                                        success: function(data){
                                            alert("User successfully deleted");
                                            // document.location="admin.php";


                                        }
                                    });
                                });
                                disableButton.click(function(){
                                    $.ajax({
                                        dataType: "json",
                                        url: "disableUser.php",
                                        type: "POST",
                                        data: {user_id: user_id},
                                        success: function(data){
                                            alert("User successfully disabled");
                                            // document.location="admin.php";
                                        }
                                    });
                                });
                                $(".user").append(userBox);

                            }
                        }
                       
                    });
                });
            });
        </script>

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
        <h1>Administrator</h1>
        
            
        </div>
        <main>
            <h2>Search</h2>
            <input type="text" placeholder="Search.." id="search" name="search">
            <button type="submit" id="searchButton">Search</button>
            <h2>Users</h2>
            <div class="user">
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