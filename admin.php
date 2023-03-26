<?php
     $conn = require("dbconnect.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
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
                                var username = $("<p>Username: "+data[i].username+"</p>");
                                var email = $("<p>Email: "+data[i].email+"</p>");
                                var role = $("<p> User level: "+data[i].user_level+"</p>");
                                var deleteButton = $("<button class='delete'>Delete User</button>");
                                var enable=1;
                                if(data[i].user_level==2){
                                    var disableButton = $("<button class='disable'>Enable User</button>");
                                }
                                else{
                                    var disableButton = $("<button class='enable'>Disable User</button>");
                                    enable=2;
                                }
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
                                            alert("User Deleted");


                                        }
                                    });
                                    alert("User Deleted!");
                                    location.reload();
                                });
                                disableButton.click(function(){
                                    $.ajax({
                                        dataType: "json",
                                        url: "disableUser.php",
                                        type: "POST",
                                        data: {user_id: user_id,enable:enable},
                                        success: function(data){
                                            document.location="admin.php";
                                        }

                                    });
                                    alert("Action successful!");
                                    location.reload();

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
                    <li><a href="discuss.php">Discuss</a></li>
                    <li><a href="aboutUs.php">About Us</a></li>
                    <li><a href="contactUs.php">contactUs</a></li>
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
                <a href="discuss.php">Discuss</a> |
                <a href="aboutUs.php">About Us</a> |
                <a href="contactUs.php">contactUs</a> 
            </p>
            <p>
                &copy; 2019 Discuss
            <p>

        </footer>
    </body>
<.php>