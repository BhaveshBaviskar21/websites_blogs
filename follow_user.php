<?php
    session_start();
    include "db_conn.php";
    $user_id = $_SESSION['id'];
    if (isset($_POST['follow_user'])) {
        $friend_id = $_POST['follow_user'];
        $sql = "INSERT into friends (userid, friendid) values ('$user_id','$friend_id')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>window.location.href ='home.php'</script>";
        }
        else {
        echo "some problem1";
        }
    }
    if (isset($_POST['unfollow_user'])) {
        $friend_id = $_POST['unfollow_user'];
        $sql = "DELETE FROM `friends` WHERE userid='$user_id' and friendid='$friend_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>window.location.href ='home.php'</script>";
        }
        else {
        echo "some problem2";
        }
    }
?>