<?php
    session_start();

    $pagetype = $_GET['bull'];

    $comid = $_GET['id'];
    $email = $_SESSION['useremail'];

    $servername = 'localhost';
    $username = 'root';

    $db = new mysqli($servername,$username,'') or die(mysqli_error($db));
    mysqli_select_db($db, 'note_users');

    $query = "SELECT * FROM comment WHERE id ='$comid'";

    $result = mysqli_query($db,$query) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);

    $dataemail = $row['email'];

    

    if(!isset($_SESSION['useremail'])){
?>
<script>
    alert("ERROR : non - Login");
    location.href = "login.php";
</script>
<?php
    }
    else if($_SESSION['useremail'] != $dataemail){
?>
<script>
    alert("You do not have permission.");
    location.href = "viewpage.php?bull=<?php echo $pagetype?>&id=<?php echo $row['thispath'] ?>";
</script>
<?php
    }
    else{
        $query1 = "DELETE FROM comment WHERE id='$comid'";
        $result1 = mysqli_query($db, $query1);
?>
<script>
    alert("Your comment has been deleted.");
    location.href = "viewpage.php?bull=<?php echo $pagetype?>&id=<?php echo $row['thispath'] ?>";
</script>
<?php
    }
?>