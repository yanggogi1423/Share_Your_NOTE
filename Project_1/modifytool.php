<?php
    $servername = 'localhost';
    $username = 'root';

    $id = $_GET['id'];
    $pagetype = $_GET['bull'];
        
    $db = new mysqli($servername, $username,'')
    or die("Unable to connect. Check your connection parameters.");

    mysqli_select_db($db, 'note_users') or die(mysqli_error($db));

    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s');

    $query = "UPDATE list SET title = '$title', content='$content', save_time ='$date' WHERE id='$id'";
    $result = mysqli_query($db,$query);

    if($result){
?>
<script>
    alert("Your post has been modified.");
    location.href = "viewpage.php?bull=<?php echo $pagetype?>&id=<?php echo $id ?>";
</script>
<?php
    }
    else{
?>
<script>
    alert("ERROR : Unable to modify post");
    location.href = "viewpage.php?bull=<?php echo $pagetype?>&id=<?php echo $id ?>";
</script>
<?php
    }
?>