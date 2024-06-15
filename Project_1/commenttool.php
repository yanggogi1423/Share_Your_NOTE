<?php
    session_start();

    $pagetype = $_GET['bull'];
    $thispath = $_GET['id'];

    $servername = 'localhost';
    $username = 'root';
    
    $db = new mysqli($servername, $username) or die(mysqli_error($db));

    mysqli_select_db($db, 'note_users') or die(mysqli_error($db));

    $email = $_SESSION['useremail'];
    $content = $_POST['comment'];
    $nn = $_SESSION['usernn'];

    $date = date("Y-M-D h:i:s");

    $query = "INSERT INTO comment
            (content, email, nn, save_time, thispath)
            VALUES
            ('$content','$email','$nn','$date', '$thispath')";

    mysqli_query($db,$query) or die(mysqli_error($db));

?>
<script>
    alert("Your comment has been registered.");
    location.href = "viewpage.php?bull=<?php echo $pagetype; ?>&id=<?php echo $thispath; ?>";
</script>