<?php

    session_start();

    if(isset($_POST['submit'])&&isset($_SESSION['useremail'])){

        $servername = 'localhost';
        $username = 'root';
    
    // Create connection
        $db = new mysqli($servername, $username,'')
            or die("Unable to connect. Check your connection parameters.");

        $query = 'CREATE DATABASE IF NOT EXISTS note_users';
        mysqli_query($db,$query) or die(mysqli_error($db));

        mysqli_select_db($db, 'note_users') or die(mysqli_error($db));

        mysqli_query($db,$query) or die(mysqli_error($db));
        

        $date = date('Y-m-d H:i:s');
        $title = $_POST['title'];
        $content = $_POST['content'];
        $con_t = $_POST['select'];

        $email = $_SESSION['useremail'];
        $nickname = $_SESSION['usernn'];
        $useruniv = $_SESSION['useruv'];
        $grade = $_SESSION['usergd'];
        
        
        
        $query = "INSERT INTO list 
                    (email, nn, uv, gr, title, content, con_type, save_time, view)
                VALUES 
                    ('$email', '$nickname', '$useruniv', '$grade',
                     '$title', '$content', '$con_t', '$date', 0)";

        mysqli_query($db, $query) or die(mysqli_error($db));


        $query = "SELECT * FROM list WHERE save_time='$date'";

        $result = mysqli_query($db, $query);

        $row = mysqli_fetch_assoc($result);

        // find
        $types = array('full', 'math', 'arts', 'prog', 'free');
        $pagetype = $types[$row['con_type']/10];

?>
<script>
    alert("Your post has been registered.");
    location.href = "viewpage.php?bull=<?php echo $pagetype ?>&id=<?php echo $row['id'] ?>";
</script>
<?php
    }
    else{
?>
<script>
    alert("ERROR : Your post is not registered.");
    location.href = "index.php";
</script>
<?php
    }
?>