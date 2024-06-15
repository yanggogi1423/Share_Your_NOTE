<?php
    session_start();

    $types = array('full', 'math', 'arts', 'prog', 'free');
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Share your NOTE! - Upload</title>
        <link rel="icon" href="./source/title_logo.png" type="image/png">
        <link rel="stylesheet" href="uploadpage.css">
    </head>

    <body> 
    <?php include 'header.php';?>

        <div id="wrapper">
            <div id="tool">
                <div id="up-title-box">
                    <p id="up-title">To create a post</p>
                </div>
                <form action="uploadtool.php" method="post">

                    <div id="select-box">
                        <label for="select">Archive </label>
                        <select id="select" name="select" required>
                            <option value="">Select your archive</option>
                            <option value="11">Mathematics</option>
                            <option value="21">Liberal Arts</option>
                            <option value="31">Programming</option>
                            <option value="41">Free Forum</option>
                        </select>
                    </div>

                    <div id="title-box">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title" size="70" required>
                    </div>
                    <div id="content-box">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" rows="20" wrap="hard"></textarea>
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

        


