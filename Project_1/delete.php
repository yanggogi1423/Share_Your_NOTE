<?php
    session_start();

    $id = $_GET['id'];
    $pagetype = $_GET['bull'];

?>
<!-- <script>

    var res;
    res = confirm("Are you sure you want to delete it?");

    if(res==false){
        // alert("Stop deleting posts.");
        location.href = "viewpage.php?bull=<?php echo $pagetype?>&id=<?php echo $id ?>";
        
    }

</script> -->
<?php

    $servername = 'localhost';
    $username = 'root';

    $db = new mysqli($servername, $username,'')
    or die("Unable to connect. Check your connection parameters.");

    mysqli_select_db($db, 'note_users') or die(mysqli_error($db));

    $query = "SELECT * FROM list WHERE id=$id";

    $result = mysqli_query($db, $query);
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
    location.href = "viewpage.php?bull=<?php echo $pagetype?>&id=<?php echo $id ?>";
</script>
<?php
    }
    else{
        $query1 = "DELETE FROM list WHERE id=$id";
        $result1 = mysqli_query($db, $query1);

        $query1 = "DELETE FROM comment WHERE thispath='$id'";
        $result1 = mysqli_query($db, $query1);
?>
<script>
    alert("Your post has been deleted.");
    location.href = "free_bull.php?bull=<?php echo $pagetype ?>";
    
</script>
<?php
    }
?>