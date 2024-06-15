<?php
    session_start();

    $types = array('full', 'math', 'arts', 'prog', 'free');
    $contypes = array(11, 21, 31, 41);
    $pagetype = $_GET['bull'];

    $i = 4;

    while($i!=-1){
        if($pagetype==$types[$i]){
            break;
        }
        $i--;
    }

    $titles = array('Full Bulletin','Mathematics','Liberal Arts','Programming','Free Forum');
    
    $pagetitle = $titles[$i];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Share your NOTE! - <?php echo $pagetitle; ?></title>
        <link rel="icon" href="./source/title_logo.png" type="image/png">
        <link rel="stylesheet" href="free_bull.css">
    </head>

    <body> 
    <?php include 'header.php';?>

        <?php
            $servername = 'localhost';
            $username = 'root';
                
            $db = new mysqli($servername, $username,'')
            or die("Unable to connect. Check your connection parameters.");

            mysqli_select_db($db, 'note_users') or die(mysqli_error($db));

            if($pagetype == $types[0]){   //  full
                $query = 'SELECT * FROM list order by id desc';
            }
            else if($pagetype == $types[1]){  //  math
                $query = "SELECT * FROM list WHERE con_type=$contypes[0] order by id desc";
            }
            else if($pagetype == $types[2]){  //  arts
                $query = "SELECT * FROM list WHERE con_type=$contypes[1] order by id desc";
            }
            else if($pagetype == $types[3]){  //  prog
                $query = "SELECT * FROM list WHERE con_type=$contypes[2] order by id desc";
            }
            else if($pagetype == $types[4]){  //  free
                $query = "SELECT * FROM list WHERE con_type=$contypes[3] order by id desc";
            }
            
            $result = mysqli_query($db, $query);

            $total = mysqli_num_rows($result);
        ?>
        <div id="wrapper">
            <div id="title-box">
                <p id="title"><?php echo $pagetitle; ?></p>
            </div>
            
                <table align="center">
                    <thead align="center">
                        <tr>
                            <td width="100" align="center">Index</td>
                            <td width="500" align="center">Title</td>
                            <td width="100" align="center">Writer</td>
                            <td width="200" align="center">Upload Time</td>
                            <td width="100" align="center">Hits</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            while ($rows = mysqli_fetch_assoc($result)) { //result set에서 레코드(행)를 1개씩 리턴
                            if ($total % 2 == 0) {
                        ?>
                            <tr class="even">
                                <!--배경색 진하게-->
                            <?php } else {
                            ?>
                            <tr>
                                <!--배경색 그냥-->
                            <?php } ?>

                            <td width="50" align="center"><?php echo $total ?></td>

                            <td width="500" align="center">
                                <a href="viewpage.php?bull=<?php echo $pagetype?>&id=<?php echo $rows['id'] ?>">
                                    <?php echo $rows['title'] ?>
                                </a>
                            </td>

                                <td width="100" align="center"><?php echo $rows['nn'] ?></td>
                                <td width="200" align="center"><?php echo $rows['save_time'] ?></td>
                                <td width="50" align="center"><?php echo $rows['view'] ?></td>
                            </tr>
                        <?php
                                $total--;
                            }
                        ?>
                    </tbody>
                </table>

            <div id="upload-box">
                <p><a href="uploadpage.php">Create a post</a></p>
            </div>
        
        </div>

        <?php include 'footer.php';?>

    </body>
</html>