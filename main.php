<?php
    include "index.php";
    if(isset($_SESSION['id'])){
        echo "<script>window.location.href ='home.php'</script>";
    }
?>
<html>
    <head>
        <title>Main page</title>
    </head>
    <body>
        <div id="main_div">
            <div id="left_nav">
                <ul>
                <li>
                    <div class="nav__box">
                        <div class="nav__iconBox">
                            <i class="material-symbols-outlined">home</i>
                        </div>
                        <div class="nav__text_box">
                            <a href="home.php">Home</a>
                        </div>
    			        <div class="clr"></div>
                    </div>
                </li>
                <li>
                    <div class="nav__box">
                        <div class="nav__iconBox">
                            <i class="material-symbols-outlined">person</i>
                        </div>
                        <div class="nav__text_box">
                            <a href="user.php">User</a>
                        </div>
    			        <div class="clr"></div>
                    </div>
                </li>
                </ul>
            </div>
            <div id="main">
            </div>
            <div id="right_nav">
                <div class="nav__box">
                    <div class="nav__iconBox">
                        <i class="material-symbols-outlined">login</i>
                    </div>
                    <div class="nav__text_box">
                        <a href="login.php">Log-in</a><br>
                        <a href="login.php">Sign-up</a>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
        <script src="scroll.js"></script>
    </body>
</html>