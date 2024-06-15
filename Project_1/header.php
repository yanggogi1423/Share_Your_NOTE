<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <link rel="icon" href="./source/title_logo.png" type="image/png">
        <link rel="stylesheet" href="header.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>

    <body>
        
        
        <header>
            <section id="upper-bar">
                <div id="main_logo">
                    <a href="index.php"><img src="./source/main_logo.png" alt="main_logo"></a>
                </div>

                <div class="Nav">
                    <nav>
                        <ul>
                            <li><a href="free_bull.php?bull=<?php echo $types[0]; ?>">Full Bulletin</a></li>
                            <li><a href="free_bull.php?bull=<?php echo $types[1]; ?>">Mathematics</a></li>
                            <li><a href="free_bull.php?bull=<?php echo $types[2]; ?>">Liberal Arts</a></li>
                            <li><a href="free_bull.php?bull=<?php echo $types[3]; ?>">Programming</a></li>
                            <li><a href="free_bull.php?bull=<?php echo $types[4]; ?>">Free Forum</a></li>
                        </ul>
                    </nav>
                </div>

                <div id="emptybox"></div>

                <?php
                if(isset($_SESSION['useremail'])){
                ?>
                <div id="mypage">
                    <a href="mypage.php"><img src="./source/userimg.png" alt="userimg"></a>
                    <form id="logout-box">
                        <a href="logout.php"><button class="btn btn-primary" type="button">Logout</button></a>
                    </form>
                </div>
                <?php
                }
                
                else{
                ?>
                <form id="login-box">
                    <a href="login.html"><button class="btn btn-outline-primary me-2" type="button">Login</button></a>
                    <a href="signup.html"><button class="btn btn-primary" type="button">Sign up</button></a>
                </form>
                <?php
                }
                ?>
                
            </section>
            
            
        </header>
    </body>
</html>