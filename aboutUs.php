<!DOCTYPE html>
<html>
    <head>
        <title>About Us</title>
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
        <div id="category">
            <h1>About Us</h1>
        </div>
        <main>
            <section class="profile">
                <figure>
                    <img src="img/spongebob.jpeg" alt="John Doe" height="200" width="200">
                    <figcaption>John Doe</figcaption>
                </figure>
                <h2>John Doe</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Sed euismod, nunc ut aliquam tincidunt, nunc nisl aliquet 
                    nunc, eget aliquam nisl nisl sit amet nisl. 
                    Sed euismod, nunc ut aliquam tincidunt, nunc nisl aliquet 
                    nunc, eget aliquam nisl nisl sit amet nisl.
                </p>
            </section>
            <section class="profile">
                <img src="img/patrick.jpeg" alt="John Doe" height="200" width="200">
                <figcaption>John Doe</figcaption>
            </figure>
            <h2>Jane Doe</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Sed euismod, nunc ut aliquam tincidunt, nunc nisl aliquet 
                nunc, eget aliquam nisl nisl sit amet nisl. 
                Sed euismod, nunc ut aliquam tincidunt, nunc nisl aliquet 
                nunc, eget aliquam nisl nisl sit amet nisl.
            </p>

            </section>

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