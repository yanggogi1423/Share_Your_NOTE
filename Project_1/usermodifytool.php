<?php
    session_start();

    $curEmail = $_SESSION['useremail'];

    if(!isset($_POST['email'])){
        ?>
        <script>
            alert("Invalid access.")
            location.href = "index.php";
        </script>
        <?php
    }

    $email = $_POST['email'];
    $nickname = $_POST['nickname'];
    $gender = $_POST['gender'];
    $university = $_POST['university'];
    $grade = $_POST['grade'];
    $temp = $_POST['newPass'];

    $password = password_hash($temp,PASSWORD_DEFAULT);

    $servername = 'localhost';
    $username = 'root';

    $db = new mysqli($servername, $username,'', 'note_users')
        or die("Unable to connect. Check your connection parameters.");

    $query = "UPDATE users SET u_email ='$email', u_pw='$password',
                u_nn='$nickname', u_uv='$university',u_gd='$gender',u_gr='$grade' WHERE u_email = '$curEmail'";
    $result = mysqli_query($db,$query);

    // data update
    $_SESSION['useremail'] = $email;
    $_SESSION['usernn'] = $nickname;
    $_SESSION['useruv'] = $university;
    $_SESSION['usergd'] = $grade;

?>
<script>
    alert("The modification has been completed.");
    location.href = "mypage.php";
</script>