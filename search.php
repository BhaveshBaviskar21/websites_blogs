<?php
    include "index.php";
    if (isset($_POST['submit']) && !empty($_POST['Search_bar_friends'])) {
        if(preg_match ('/[^a-zA-Z0-9]/i', $_POST['Search_bar_friends'])) {
            list($n_sear1, $n_sear2) = explode(" ",$_POST['Search_bar_friends']);
        }
        else{
            $n_sear1 = $_POST['Search_bar_friends'];
            $n_sear2 = $_POST['Search_bar_friends'];
        }
        $sql = "SELECT * FROM userinfo WHERE name like '%$n_sear1%' or surname like '%$n_sear2%'";
        $result = mysqli_query($conn, $sql);
    } else {
        echo "<script>window.location.href ='main.php'</script>";
    }
?>
<html>
    <head>
        <title>Search page</title>
    </head>
    <body>
        <div id="main_div">
            <div id="left_nav">
                <?php if(isset($_SESSION['id'])) { 
                    $id = $_SESSION['id'];
                    $sql_small = "SELECT * FROM userinfo WHERE id='$id'";
                    $result_small = mysqli_query($conn, $sql_small);
                    if(!(mysqli_num_rows($result_small) > 0)){
                        echo "<script>window.location.href ='userform.php'</script>";
                    } 
                    else {
                        $row_small = mysqli_fetch_assoc($result_small);
                    }?>
                <div class="small_user_info_for_easy">
                    <div class="small_user_profile_photo">
                        <?php if(!$row_small['photo_user']){?>
                            <img src="def_prof.jpeg"/>
                        <?php } 
                            else{?>
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row_small['photo_user']);?>" />
                        <?php }?>
                    </div>
                    <div class="small_user_profile_name_surname">
                        <a><?php echo ($row_small['name'])." ".($row_small['surname']);?></a>
                    </div>
                </div>
                <?php }?>
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
                <?php if (isset($_SESSION['id'])) { ?>
                <li>
                    <div class="nav__box">
                        <div class="nav__iconBox">
                            <i class="material-symbols-outlined">manage_search</i>
                        </div>
                        <div class="nav__text_box">
                            <a href="manage.php">Manage trib</a>
                            </div>
    			        <div class="clr"></div>
                    </div>
                </li>
                <?php }?>
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
                <?php if (isset($_SESSION['id'])) { ?>
                    <li>
                    <div class="nav__box">
                        <div class="nav__iconBox">
                            <i class="material-symbols-outlined">group</i>
                        </div>
                        <div class="nav__text_box">
                            <a href="friends.php">Follow</a>
                            </div>
    			        <div class="clr"></div>
                    </div>
                </li>
                <li>
                    <div class="nav__box">
                        <div class="nav__iconBox">
                            <i class="material-symbols-outlined">edit_square</i>
                        </div>
                        <div class="nav__text_box">
                            <a href="tribs_insert.php">Create trib</a>
                            </div>
    			        <div class="clr"></div>
                    </div>
                </li>
                <li>
                    <div class="nav__box">
                        <div class="nav__iconBox">
                            <i class="material-symbols-outlined">logout</i>
                        </div>
                        <div class="nav__text_box">
                            <a href="logout.php">Log out</a>
                            </div>
    			        <div class="clr"></div>
                    </div>
                </li>
                <?php }?>
                </ul>
            </div>
            <div id="main">
            </div>
            <div id="right_nav">
                <?php 
                    if($result){
                        foreach($result as $row){?>
                            <div class="sear_display_box">
                                <div class="sear_user_photo">
                                    <?php if(!$row['photo_user']){?>
                                        <img src="def_prof.jpeg"/>
                                    <?php } 
                                        else{?>
                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo_user']);?>" />
                                    <?php }?>
                                </div>
                                <div class="sear_user_name">
                                    <a><?php echo ($row['name'])." ".($row['surname']);?></a>
                                </div>
                                <div class="sear_more_info">
                                    <form method="post" action="user_info_display.php">
                                        <button type="submit" name="show_more" value="<?php echo ($row['id']); ?>">Show Profile</button>
                                    </form>
                                </div>
                            </div>
                        <?php
                        }
                    }
                ?>
            </div>
        </div>        
        <script src="scroll.js"></script>
    </body>
</html>