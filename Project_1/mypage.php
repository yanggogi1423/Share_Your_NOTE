<?php
    session_start();

    if(!isset($_SESSION['useremail'])){
        ?>
        <script>
            alert("Invalid access.")
            location.href = "index.php";
        </script>
        <?php
    }

    $servername = 'localhost';
    $username = 'root';

    $db = new mysqli($servername, $username,'', 'note_users')
        or die("Unable to connect. Check your connection parameters.");

    $email = $_SESSION['useremail'];

    $query = "SELECT * FROM users WHERE u_email='$email'";
    $result = mysqli_query($db,$query);
    
    $row = mysqli_fetch_assoc($result);

    // data
    $nickname = $_SESSION['usernn'];
    $grade = $row['u_gr'];
    $gender = $row['u_gd'];
    $university =$row['u_uv'];

    $types = array('full', 'math', 'arts', 'prog', 'free');
    $contypes = array(11, 21, 31, 41);

    $pagetype = 'full';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Share your NOTE! - My page</title>
        <link rel="icon" href="./source/title_logo.png" type="image/png">
        <link rel="stylesheet" href="mypage.css">
    </head>

    <body> 
    <?php include 'header.php';?>
        
        <div id="wrapper">
            
            <div id="view-user-box">
                <p id="mypage-title">My Page</p>
                <!-- email -->
                <div class="user-view"> 
                    <p class="left">Email</p>
                    <p class="right"><?php echo $email;?></p>
                </div>
                <!-- nickname -->
                <div class="user-view">
                    <p class="left">Nickname</p>
                    <p class="right"><?php echo $nickname;?></p>
                </div>
                <!-- gender -->
                <div class="user-view">
                    <p class="left">Gender</p>
                    <p class="right"><?php echo $gender;?></p>
                </div>
                <!-- university -->
                <div class="user-view">
                    <p class="left">University</p>
                    <p class="right"><?php echo $university;?></p>
                </div>
                <!-- grade -->
                <div class="user-view">
                    <p class="left">Grade</p>
                    <p class="right"><?php echo $grade;?></p>
                </div>

                <div id="modify-box">
                <form method="post" action="usermodify.php">
                    <p id="ask-pass">If you modify your membership information, please enter your password.</p>
                    <input type="password" id="input-pw" name="password">
                    <div id="button-box">
                        <button id="modify-button" type="submit">Modify</button>
                    </div>
                </form>
            </div>
            </div>
            
            
            

            <?php
                $servername = 'localhost';
                $username = 'root';
                    
                $db = new mysqli($servername, $username,'')
                or die("Unable to connect. Check your connection parameters.");

                mysqli_select_db($db, 'note_users') or die(mysqli_error($db));

                $query= "SELECT * FROM list WHERE email='$email'";
                
                $result = mysqli_query($db, $query);

                $total = mysqli_num_rows($result);
            ?>

                        <div id="title-box">
                            <p id="title" style="font-size: 20px;">My post</p>
                        </div>
                    <table align="center">
                        <thead align="center">
                            <tr>
                                <td width="100" align="center">Index</td>
                                <td width="500" align="center">Title</td>
                                <td width="100" align="center">Writer</td>
                                <td width="200" align="center">Upload Time</td>
                                <td width="100" align="center">Hits</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                while ($rows = mysqli_fetch_assoc($result)) { //result set에서 레코드(행)를 1개씩 리턴
                                if ($total % 2 == 0) {
                            ?>
                                <tr class="even">
                                    <!--배경색 진하게-->
                                <?php } else {
                                ?>
                                <tr>
                                    <!--배경색 그냥-->
                                <?php } ?>

                                <td width="50" align="center"><?php echo $total ?></td>

                                <td width="500" align="center">
                                    <a href="viewpage.php?bull=<?php echo $pagetype?>&id=<?php echo $rows['id'] ?>">
                                        <?php echo $rows['title'] ?>
                                    </a>
                                </td>

                                    <td width="100" align="center"><?php echo $rows['nn'] ?></td>
                                    <td width="200" align="center"><?php echo $rows['save_time'] ?></td>
                                    <td width="50" align="center"><?php echo $rows['view'] ?></td>
                                </tr>
                            <?php
                                    $total--;
                                }
                            ?>
                        </tbody>
                    </table>
            </div>


        <?php include 'footer.php';?>

    </body>
</html>

        


