<?php
     $conn = require("dbconnect.php");
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

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/admin.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            $(document).ready(function(){
                // //on click user
                $("#users").click(function(){
                
                $("main").empty();
                var h1=$("<h2>Search for User</h2>");
                var input=$("<input type='text' placeholder='Search..' id='search' name='search'>");
                var button=$("<button type='submit' id='searchButton'>Search</button>");
                var h2=$("<h2>Users</h2>");
                var div=$("<div class='user'></div")
                $("main").append(h1);
                $("main").append(input);
                $("main").append(button);
                $("main").append(h2);
                $("main").append(div);
                $.ajax({
                        dataType: "json",
                        url: "getUser.php",
                        type: "POST",
                        success: function(data){
                            $(".user").empty();

                            var table=$("<table></table>");
                            var header=$("<tr><th>Username</th><th>Email</th><th>User Level</th><th>Enable/Disable</th><th>Delete</th></tr>");
                            table.append(header);
                            for(var i = 0; i < data.length; i++){

                                //DISPLAY RESULT AS A TABLE


                                var tr=$("<tr></tr>");
                                var td=$("<td>"+data[i].username+"</td>");
                                var td1=$("<td>"+data[i].email+"</td>");
                                var td2=$("<td>"+data[i].user_level+"</td>");
                                var enable=1;
                                var td3;
                                if(data[i].user_level==2){
                                    td3=$("<td><button class='de'>Enable User</button></td>");
                                }
                                else{
                                    td3=$("<td><button class='de'>Disable User</button></td>"); 
                                    enable=2;
                                }
                                var td4=$("<td><button class='delete'>Delete User</button></td>");
                                var tr2=$("<tr></tr>");
                                table.append(tr);
                                tr.append(td);
                                tr.append(td1);
                                tr.append(td2);
                                tr.append(td3);
                                tr.append(td4);
                                table.append(tr2);
                                $(".user").append(table);
                                var user_id = data[i].id;
    
                                $(".delete").click(function(){
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
                                $(".de").click(function(){
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
                               // $(".user").append(userBox);

                            }
                        }
                       
                    });

                $("#searchButton").click(function(){
                    var search = $("#search").val();
                    $.ajax({
                        dataType: "json",
                        url: "getUser.php",
                        type: "POST",
                        data: {search: search},
                        success: function(data){
                            $(".user").empty();

                            var table=$("<table></table>");
                            var header=$("<tr><th>Username</th><th>Email</th><th>User Level</th><th>Enable/Disable</th><th>Delete</th></tr>");
                            table.append(header);
                            for(var i = 0; i < data.length; i++){

                                //DISPLAY RESULT AS A TABLE


                                var tr=$("<tr></tr>");
                                var td=$("<td>"+data[i].username+"</td>");
                                var td1=$("<td>"+data[i].email+"</td>");
                                var td2=$("<td>"+data[i].user_level+"</td>");
                                var enable=1;
                                var td3;
                                if(data[i].user_level==2){
                                    td3=$("<td><button class='de'>Enable User</button></td>");
                                }
                                else{
                                    td3=$("<td><button class='de'>Disable User</button></td>"); 
                                    enable=2;
                                }
                                var td4=$("<td><button class='delete' id='"+data[i].id+"'>Delete User</button></td>");
                                var tr2=$("<tr></tr>");
                                table.append(tr);
                                tr.append(td);
                                tr.append(td1);
                                tr.append(td2);
                                tr.append(td3);
                                tr.append(td4);
                                table.append(tr2);
                                $(".user").append(table);
                                var user_id = data[i].id;
                                $(".delete").mousemove(function(){
                                   user_id=$(this).attr("id");
                                   console.log(user_id);
                                });
                                (".delete").click(function(){
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
                                ("de").click(function(){
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
                                //$(".user").append(userBox);

                            }
                        }
                       
                    });
                });



                });
        
        $("#report").click(function(){
            $("main").empty();
            var h1=$("<h2>Reports<h2>");
            var h2=$("<h3>User Registration Reports</h3>")
            var form=$("<form method='post' action='getUserChartData.php'></form>");
            var label=$("<label for='registration'>Filter according to: </label>");
            var select=$("<select name='registration' id='registration'></select>");
            var option1=$("<option value='1' selected>day</option>");
            var option2=$("<option value='7'>week</option>");
            var option3=$("<option value='30'>month</option>");
            var option4=$("<option value='365'>year</option>");
            select.append(option1);
            select.append(option2);
            select.append(option3);
            select.append(option4);
            form.append(label);
            form.append(select);
            $("main").append(h1);
            $("main").append(h2);
            $("main").append(form);

            var chartdiv=$("<div class='charts'></div>");
            var canvas =$("<canvas id='myChart'></canvas>");
            chartdiv.append(canvas);
            $("main").append(chartdiv);
            var value=1;
            var change=false;
            var labels = [];
            var dataValues= [];

            const ctx = document.getElementById('myChart');
            var chart;
            function chart(){
                    //registration chart
                    $.ajax({
                        dataType: "json",
                        url: "getUserChartData.php",
                        type: "GET",
                        data: {value: value},
                        success: function(data){
                            addData(data);
                        }
                    });
                    
                    chart=new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                            label: 'Number of registered users',
                            data: dataValues,
                            borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                            y: {
                                beginAtZero: true
                            }
                            }
                        }
                        });
            }
            function addData(data) {
            
            for (var i = 0; i < data.length; i++) {

                labels.push(data[i].registration_date);
                dataValues.push(data[i].num_registrations);

            }


        }

            chart();
            $( "#registration" ).change(function() {
                value=$('#registration').find(":selected").val();
                // change=true;
                chart.destroy();
                labels = [];
                dataValues= [];
                $.ajax({
                        dataType: "json",
                        url: "getUserChartData.php",
                        type: "GET",
                        data: {value: value},
                        success: function(data){
                            addData(data);
                        }
                    });
                    
                    chart=new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                            label: 'Number of registered users',
                            data: dataValues,
                            borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                            y: {
                                beginAtZero: true
                            }
                            }
                        }
                        });
                
                 
                
            });

            //activity chart    
            var chartdiv1=$("<div class='charts'></div>");
            var canvas1=$("<canvas id='myChart1'></canvas>");
            chartdiv1.append(canvas1);
            var h3=$("<h3>Activity Report</h3>");
            $("main").append(h3);
            $("main").append(chartdiv1);
            var labels1 = [];
            var dataValues1= [];
            const ctx1 = document.getElementById('myChart1');
            var chart1;
            function chart1(){
                    //registration chart
                    $.ajax({
                        dataType: "json",
                        url: "activity.php",
                        type: "GET",
                        success: function(data){
                            addData1(data);
                        }
                    });
                    
                    chart1=new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: labels1,
                            datasets: [{
                            label: 'Activity',
                            data: dataValues1,
                            borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                            y: {
                                beginAtZero: true
                            }
                            }
                        }
                        });
            }
            function addData1(data) {
                for (var i = 0; i < data.length; i++) {

                labels1.push(data[i].post_date);
                dataValues1.push(data[i].total);

                }


            }
            chart1();
            //
           





          


        });

                
                   



            });
        </script>

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
                                <span></span>
                                <img src="img/icons8-user-default-64.png" height="64" width="64" class="newUser" ></img>
                                <div id ="myDropdown" class="dropdown-content">
                                <?php if (isset($user)): ?>
                                    <span><?php echo "<span>".$user["username"]."</span>"; ?></span>
                                    <a href="profile.php">Profile</a>
                                    <a href="logout.php">Logout</a>
                                <?php else: ?>
                                    <a style="margin-top:1.5em" href="login.php">Login</a>
                                <?php endif; ?>
                                    
                                </div>
                            </div>  
                        </ul>
            </nav >
        </header >
        <div id="category">
        <h1>Administrator</h1>        
        </div>
        <div class="body">
        <div class="sidebar">
            <button id="users">Users</button>
            <button id="report">Report</button>
        </div>
        <main>
            <!-- <h2>Search for user</h2>
            <input type="text" placeholder="Search.." id="search" name="search">
            <button type="submit" id="searchButton">Search</button>
            <h2>Users</h2>
            <div class="user">
            </div>
            <h2>Reports<h2>
            <h3>User Registration Reports</h3>
            <label for="registration">Get user registration for the past: </label>
            <select name="registration" id="registration">
                <option value="1">day</option>
                <option value="7" selected>week</option>
                <option value="30">month</option>
                <option value="365">year</option>
            </select> -->
         </main>
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
<.php>