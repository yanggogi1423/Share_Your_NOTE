<?php
    session_start();
    if(!isset($_SESSION['useremail'])){
?>
<script>
    alert("You can use it after logging in.");
    location.href = "login.html";
</script>
<?php
    }
    $types = array('full', 'math', 'arts', 'prog', 'free');
    $pagetype = $_GET['bull'];
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Share your NOTE! - View</title>
        <link rel="icon" href="./source/title_logo.png" type="image/png">
        <link rel="stylesheet" href="viewpage.css">
    </head>

    <body>
        
    <?php include 'header.php';?>
        
        <?php
            $servername = 'localhost';
            $username = 'root';
                
            $db = new mysqli($servername, $username,'')
            or die("Unable to connect. Check your connection parameters.");

            mysqli_select_db($db, 'note_users') or die(mysqli_error($db));
            
            // 조회수
            $viewupdate = "UPDATE list SET view = view + 1 WHERE id='$id'";
            mysqli_query($db,$viewupdate);
            
            // 원하는 자료 뽑아오기
            $query = "SELECT * FROM list where id='$id'";

            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);

            if(mysqli_num_rows($result)){
        ?>
        <div id="wrapper">
            <table class="read-table" align=center>
                <tr>
                    <td colspan="4" class="read-title"><?php echo $row['title'] ?></td>
                </tr>
                <tr>
                    <td class="read-id">Writer</td>
                    <td class="read-id2"><?php echo $row['nn'] ?></td>
                    <td class="read-view">Hits</td>
                    <td class="read-view2"><?php echo $row['view'] ?></td>
                </tr>


                <tr>
                    <td colspan="4" class="read-content" valign="top">
                        <!-- pre 태그를 이용해서 입력 받은대로 출력 -->
                        <pre style="font-family: Helvetica, sans-serif; font-size: 15px;"><?php echo $row['content'] ?></pre>
                    </td>
                </tr>
            </table>

            <!-- 삭제여부를 재차 확인하기 위한 함수 -->
            <script type="text/javascript">
                function del_post(){
                    var res;
                    res = confirm("Are you sure you want to delete it?");

                    if(res==true){
                        location.href = 'delete.php?bull=<?php echo $pagetype?>&id=<?php echo $id?>';
                    }
                }

                function del_comment(id){
                    var res;
                    res = confirm("Are you sure you want to delete it?");

                    if(res==true){
                        location.href = 'commentdelete.php?bull=<?php echo $pagetype?>&id='+ id;
                    }
                }
            </script>

            <div class="button-box">
                    <button class="read-button" onclick="location.href='free_bull.php?bull=<?php echo $pagetype?>'">List</button>
                
                    <button class="read-button" onclick="location.href='modifypage.php?bull=<?php echo $pagetype?>&id=<?php echo $id?>'">Modify</button>
                
                    <button class="read-button" onclick="del_post()">Delete</button>
            </div>
                <?php
                }
                else{
                    ?>

                    <script>
                        alert("ERROR : Post access failed.");
                        location.href="free_bull.php?bull=<?php echo $pagetype; ?>";
                    </script>
                    
                    <?php
                }
                ?>
            
            <?php
                $query = "SELECT * FROM comment WHERE thispath='$id' order by id";

                $result = mysqli_query($db, $query);
            ?>

            <div class="comment-box">
                <table class="read-comment" align="center">
                        <tbody>
                            <?php
                                while ($rows = mysqli_fetch_assoc($result)) { //result set에서 레코드(행)를 1개씩 리턴
                                ?>
                                <tr class="comment-row">
                                    <td class="comment-id" width="60"><?php echo $rows['nn']; ?></td>
                                    <td class="comment-content" width="300"><?php echo $rows['content']; ?></td>
                                    <td class="comment-delete-box" width="50"><button class="delete-comment" onclick="del_comment(<?php echo $rows['id'];?>)">
                                        Delete</button></td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                
                <form id="input-comment" action="commenttool.php?bull=<?php echo $pagetype;?>&id=<?php echo $id;?>" method="post">
                    <label style="color: gray; margin: auto 0; font-size: 18px; font-weight:bold; text-align:center;" for="comment" style=""><?php echo $_SESSION['usernn'];?></label>
                    <textarea id="comment" name="comment" cols="60" rows="3" placeholder="input your comments" required></textarea>

                    <button id="submit-button" type="submit" name="submit">Submit</button>

                </form>

            </div>
        </div>
        
        <?php include 'footer.php';?>

    </body>
</html>