<?php
    session_start();

    if(isset($_POST['submit'])){
        $servername = 'localhost';
        $username = 'root';
    
        $db = new mysqli($servername, $username,'', 'note_users')
            or die("Unable to connect. Check your connection parameters.");

        $email = $_POST['userid'];
        $pw = $_POST['userpw'];

        

        $query = "SELECT * FROM users WHERE u_email='$email'";
        $result = mysqli_query($db,$query);
        

        if(mysqli_num_rows($result)==1){


            $row = mysqli_fetch_assoc($result);
            $pwFromDB = $row['u_pw'];

            if(password_verify($pw, $pwFromDB)){
                $_SESSION['useremail'] = $email;
                $_SESSION['usernn'] = $row['u_nn'];
                $_SESSION['useruv'] = $row['u_uv'];
                $_SESSION['usergd'] = $row['u_gd'];
                

                if(isset($_SESSION['useremail'])){

?>
<script type="text/javascript">
    alert("You are logged in.");
    location.href="index.php";
</script>
<?php
                }
                else{
?>
<script type="text/javascript">
    alert("Login failed. If the error persists, please contact your administrator.");
    history.back();
</script>
<?php
                }

            }
            else{
?>
<script type="text/javascript">
    alert("Please enter a valid password.");
    history.back();
</script>
<?php
            echo $pw;
            echo $pwFromDB;
            }
        }
        else{
?>
<script type="text/javascript">
    alert("Please enter a valid ID.");
    history.back();
</script>
<?php
        }
    }
?>