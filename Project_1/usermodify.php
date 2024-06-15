<?php
    session_start();

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
    $curPass = $row['u_pw'];

    $getPass = $_POST['password'];

    $types = array('full', 'math', 'arts', 'prog', 'free');
    $contypes = array(11, 21, 31, 41);

    if(password_verify($getPass,$curPass)){
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Share your NOTE! - User modification</title>
        <link rel="icon" href="./source/title_logo.png" type="image/png">
        <link rel="stylesheet" href="usermodify.css">
    </head>

    <body> 
    <?php include 'header.php';?>
        
        <div id="wrapper">
            <p id="mypage-title">My Page</p>
            <div id="view-user-box">
                
                 <form action="usermodifytool.php" method="post">
                    <!-- email -->
                    <div class="user-view"> 
                        <p class="left">Email</p>
                        <input type="text" name="email" class="right" value="<?php echo $email;?>" required>
                    </div>
                    <!-- nickname -->
                    <div class="user-view">
                        <p class="left">Nickname</p>
                        <input type="text" name="nickname" class="right" value="<?php echo $nickname;?>" required>
                    </div>
                    <!-- gender -->
                    <div class="user-view">
                        <p class="left">Gender</p>
                        <div class="right">
                            <label for="male" style="font-size: 100%;">Male</label>
                            <input type="radio" id="male" name="gender" value="male" required>
                            <span id="gender-inner-box"></span>
                            <label for="female" style="font-size: 100%;">Female</label>
                            <input type="radio" id="female" name="gender" value="female" required>
                        </div>
                    </div>
                    <!-- university -->
                    <div class="user-view">
                        <p class="left">University</p>
                        <input type="text" name="university" class="right" value="<?php echo $university;?>" required>
                    </div>
                    <!-- grade -->
                    <div class="user-view">
                        <p class="left">Grade</p>
                        <select name="grade" class="right" required>
                            <option value="">Select your grade</option>
                            <option value="1">1st Grade</option>
                            <option value="2">2nd Grade</option>
                            <option value="3">3rd Grade</option>
                            <option value="4">4th Grade</option>
                        </select>
                    </div>
                    <!-- password -->
                    <div class="user-view">
                        <p class="left">Password</p>
                        <input type="password" name="newPass" class="right" value="<?php echo $getPass;?>" required>
                    </div>

                    <div id="button-box">
                        <button id="modify-button" type="submit">Modify</button>
                    </div>
                </form>
            </div>
        </div>
        <?php include 'footer.php';?>
    </body>
</html>
<?php
}
else{
?>
<script>
    alert("Invalid password.");
    location.href="mypage.php";
</script>
<?php
}

?>
        


