<?php

        session_start();

        $servername = 'localhost';
        $username = 'root';
            
        $db = new mysqli($servername, $username,'')
        or die("Unable to connect. Check your connection parameters.");

        $query = 'CREATE DATABASE IF NOT EXISTS note_users';
        mysqli_query($db,$query) or die(mysqli_error($db));

        mysqli_select_db($db, 'note_users') or die(mysqli_error($db));

        // 유저 정보
        $query = 'CREATE TABLE IF NOT EXISTS users(
            u_id    INT UNSIGNED    NOT NULL AUTO_INCREMENT,
            u_email VARCHAR(50)     NOT NULL,
            u_pw    VARCHAR(100)     NOT NULL,
            u_nn    VARCHAR(30)     NOT NULL,
            u_uv    VARCHAR(30)     NOT NULL,
            u_gd    VARCHAR(10)     NOT NULL,
            u_gr    VARCHAR(20)     NOT NULL,
            PRIMARY KEY (u_id)
            )
            ENGINE=MyISAM';
        
        mysqli_query($db,$query) or die(mysqli_error($db));

        // 게시글
        $query = 'CREATE TABLE IF NOT EXISTS list(
            id    INT UNSIGNED    NOT NULL AUTO_INCREMENT,
            email VARCHAR(50)     NOT NULL,
            nn    VARCHAR(30)     NOT NULL,
            uv    VARCHAR(30)     NOT NULL,
            gr    VARCHAR(20)     NOT NULL,
            title VARCHAR(70)     NOT NULL,
            content TEXT          NOT NULL,
            con_type INT UNSIGNED NOT NULL,
            save_time VARCHAR(30)  NOT NULL,
            view INT UNSIGNED     NOT NULL,
            PRIMARY KEY (id)
            )
            ENGINE=MyISAM';
        mysqli_query($db,$query) or die(mysqli_error($db));

        // 댓글
        $query = 'CREATE TABLE IF NOT EXISTS comment(
            id INT UNSIGNED     NOT NULL AUTO_INCREMENT,
            content TEXT        NOT NULL,
            email VARCHAR(50)   NOT NULL,
            nn VARCHAR(30)      NOT NULL,
            save_time VARCHAR(30)   NOT NULL,
            thispath INT UNSIGNED NOT NULL,
            PRIMARY KEY (id)
            )
            ENGINE=MyISAM';
        mysqli_query($db,$query) or die(mysqli_error($db));

        // about types
        $types = array('full', 'math', 'arts', 'prog', 'free');

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Share your NOTE! - main</title>
        <link rel="icon" href="./source/title_logo.png" type="image/png">
        <link rel="stylesheet" href="index.css">
    </head>

    <body>
        
        
    <?php include 'header.php';?>

        <!--여기가 메인입니다.-->
        <section id="all">

            <!--전체 게시판-->
            <div id="left-main">
                <?php
                    // $servername = 'localhost';
                    // $username = 'root';
                        
                    // $db = new mysqli($servername, $username,'')
                    // or die("Unable to connect. Check your connection parameters.");
        
                    // mysqli_select_db($db, 'note_users') or die(mysqli_error($db));

                    $query = 'SELECT * FROM list order by id desc';
                    $result = mysqli_query($db, $query);

                    $total = 4;
                ?>

                    <table class="read-table" align=center>
                        <thead align="center">
                                <p class="left-title">Latest post</p>
                        </thead>
                        <tbody>
                            <?php
                            if(mysqli_num_rows($result)==0){
                                ?>
                                <p style="font-size: 18px; font-weight:bold; text-align:center;">
                                <?php
                                echo "There are no posts.";
                                ?>
                                </p>
                                <?php
                            }
                                while ($rows = mysqli_fetch_assoc($result)) { 

                                    $type = $rows['con_type'];
                                    $pagetype = $types[$type/10];

                                if($total==0){
                                    break;
                                }
                                
                                if ($total % 2 == 0) {
                            ?>
                            <tr class="even">
                                <!--배경색 진하게-->
                            <?php } else {
                            ?>
                            <tr>
                                    <!--배경색 그냥-->
                                <?php } ?>

                                <td class="view-content"">
                                    <a href="viewpage.php?bull=<?php echo $pagetype?>&id=<?php echo $rows['id'] ?>">
                                        <?php echo $rows['content'] ?>
                                    </a>
                                </td>

                                <td class="view-time" align="center"><?php echo $rows['save_time'] ?></td>
                            </tr>
                            <?php
                                    $total--;
                                }
                            ?>
                        </tbody>
                    </table>
            </div>

            <!--오늘의 명언-->
            <div id="middle-main">
                <div id="today-saying">
                    <p id="ts-title">Today's wise saying</p>
                    
                    <article id="ts-content">
                        The early bird is more tired.
                    </article>
                    
                    <p id="ts-name"> - Hyunsuk Yang</p>
                </div>
            </div>
            
            <div id="right-main">
                <!--내가 쓴 글, 내가 스크랩한 글-->
                <div id="me-in-all">
                    <div id="hello">
                            <!--여기에 "Hello, (username)" 출력-->
                            <p><?php
                            if(isset($_SESSION['useremail'])){
                                echo "Hello, ".$_SESSION['usernn'].".";
                            }
                            else{
                                echo "Please, Login.";
                            }
                            ?>
                            </p>
                    </div>
                </div>
                
                <?php
                    // $servername = 'localhost';
                    // $username = 'root';
                        
                    // $db = new mysqli($servername, $username,'')
                    // or die("Unable to connect. Check your connection parameters.");
        
                    // mysqli_select_db($db, 'note_users') or die(mysqli_error($db));
                    
                    // freeforum id 값
                    $finder = 41;
                    $query = "SELECT * FROM list WHERE con_type='$finder' order by view desc";
                    $result = mysqli_query($db, $query);
                    
                    $row = mysqli_fetch_assoc($result);
                    
                ?>
                <!--자유 토론장-->
                <div id="free-forum">
                    <p id="hotest-title"></p>
                    <table class="read-table" style="width: 500px;" align=center>
                        <thead align="center">
                            <tr>
                                <th class="left-title">Hottest post</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="view-content" style="text-align: center;">
                                <a href="<?php
                                if(isset($row)){
                                    echo "viewpage.php?bull=".$pagetype."&id=".$row['id'];?>
                                <?php

                                }
                                else{
                                    echo "index.php";
                                }
                                 ?>
                                 ">
                                    <?php 
                                        if(isset($row)){
                                            echo $row['content'];
                                        }
                                        else{
                                            echo "There are no posts.";
                                        }
                                    ?>
                                </a>
                            </td>
                        </tbody>
                    </table>
                </div>

                <div id="main-ads">
                    <a><img src="./source/ads_sample_1.png" alt="ads" style="width: 100%; height:auto;"></a>
                    <a><img src="./source/ads_sample_2.png" alt="ads" style="width: 100%; height:auto;"></a>
                    <a><img src="./source/ads_sample_3.png" alt="ads" style="width: 100%; height:auto;"></a>
                </div>
            </div>
            

        </section>

    <?php include 'footer.php';?>
    </body>

</html>