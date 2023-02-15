<?php
    session_start();
    include "db_conn.php";
    $currenttime = time();
    if(isset($_SESSION['id'])){
        if($currenttime > $_SESSION['expire']){
            session_unset();
            session_destroy();
            echo "<script>window.location.href ='main.php'</script>";
        } 
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Template</title>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <div id="head_page">
            <a href="home.php"><img src="mainhead.webp" alt="TRIBBIANI"/></a>
            <div class="search_action">
                <form method="post" action="search.php">
                    <input type="text" name="Search_bar_friends" pattern="^(\w*)|(\w* \w*)$" placeholder="Search users"/>
                    <button type="submit" name="submit"><i class="material-symbols-outlined">Search</i></button>
                </form>
            </div>
        </div>
    </body>
</html>