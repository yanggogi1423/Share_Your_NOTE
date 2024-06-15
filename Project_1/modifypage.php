<?php
    session_start();

    $types = array('full', 'math', 'arts', 'prog', 'free');

    $servername = 'localhost';
    $username = 'root';

    $id = $_GET['id'];
    $pagetype = $_GET['bull'];
        
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
    alert("오류 : non - Login");
    location.href = "login.php";
</script>
<?php
    }
    else if($_SESSION['useremail'] != $dataemail){
?>
<script>
    alert("권한이 없습니다.");
    location.href = "viewpage.php?id=<?php echo $id ?>";
</script>
<?php
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Share your NOTE! - Modify</title>
        <link rel="icon" href="./source/title_logo.png" type="image/png">
<!--업로드 툴과 같은 css 사용-->
        <link rel="stylesheet" href="uploadpage.css">

    </head>

    <body> 
    <?php include 'header.php';?>

        <div id="wrapper">
            <div id="tool">
                <div id="up-title-box">
                    <p id="up-title">To modify a post</p>
                </div>
                <form action="modifytool.php?bull=<?php echo $pagetype; ?>&id=<?php echo $id; ?>" method="post">
                <!--게시판은 수정 불가-->
                    <!-- <div id="select-box">
                        <label for="select">Archive </label>
                        <select id="select" name="select" required>
                            <option value="">Select your archive</option>
                            <option value="11">Mathematics</option>
                            <option value="21">Liberal Arts</option>
                            <option value="31">Programming</option>
                            <option value="41">Free Forum</option>
                        </select>
                    </div> -->

                    <div id="title-box">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title" value="<?php echo $row['title'] ?>" required>
                    </div>
                    <div id="content-box">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" cols="75" rows="20"><?php echo $row['content'] ?></textarea>
                    </div>

                    <div id="button-box">
                        <button id="submit-button" type="submit" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <?php include 'footer.php';?>

    </body>
</html>

        


