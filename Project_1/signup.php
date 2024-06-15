<?php

    if(isset($_POST['submit'])){

        $servername = 'localhost';
        $username = 'root';
        
        // Create connection
        $db = new mysqli($servername, $username,'')
            or die("Unable to connect. Check your connection parameters.");

        $query = 'CREATE DATABASE IF NOT EXISTS note_users';
        mysqli_query($db,$query) or die(mysqli_error($db));

        mysqli_select_db($db, 'note_users') or die(mysqli_error($db));
        
        $query = 'CREATE TABLE IF NOT EXISTS users(
            u_id    INT UNSIGNED    NOT NULL AUTO_INCREMENT,
            u_email VARCHAR(50)     NOT NULL,
            u_pw    VARCHAR(100)     NOT NULL,
            u_nn    VARCHAR(10)     NOT NULL,
            u_uv    VARCHAR(30)     NOT NULL,
            u_gd    VARCHAR(10)     NOT NULL,
            u_gr    VARCHAR(20)     NOT NULL,
            PRIMARY KEY (u_id)
            )
            ENGINE=MyISAM';
        
        mysqli_query($db,$query) or die(mysqli_error($db));
    
        //  email == id
        $email = $_POST['userid'];
        //  비밀번호를 해쉬로 저장하여 보안
        $pw = password_hash($_POST['userpw'],PASSWORD_DEFAULT);

        $nn = $_POST['usernn'];
        $uv = $_POST['useruv'];
        $gd = $_POST['user-gd'];
        $gr = $_POST['user-gr'];
    
        $query = "INSERT INTO users 
                    (u_email, u_pw, u_nn, u_uv, u_gd, u_gr) 
                VALUES 
                    ('$email', '$pw', '$nn', '$uv', '$gd', '$gr')";

        mysqli_query($db, $query) or die(mysqli_error($db));

    }
?>
<script type="text/javascript">
    alert("Your account has been created.");
    location.href = "login.html";
</script>


<!--   
    id int auto_increment primary key,
    email varchar(100) not null,
    pw varchar(255) not null,
    nn varchar(100) not null,
    uv varchar(100) not null,
    gd varchar(100) not null,
    gr varchar(100) not null
-->