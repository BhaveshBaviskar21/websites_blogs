<?php
    include "index.php";
    if (isset($_POST['show_more'])) {
        $follower_no = 0;
        $following_no = 0;
        $user_id = $_POST['show_more'];
        $sql1 = "SELECT * from pb_tribs where userid='$user_id'";
        $res1 = mysqli_query($conn,$sql1);
        $sql6 = "SELECT * from pr_tribs where userid='$user_id'";
        $res6 = mysqli_query($conn,$sql6);
        $sql2 = "SELECT * from userinfo where id='$user_id'";
        $res2 = mysqli_query($conn,$sql2);
        $res2_data = mysqli_fetch_assoc($res2);
        $sql3 = "SELECT * from friends where friendid='$user_id'";
        $res3 = mysqli_query($conn, $sql3);
        $follower_no = mysqli_num_rows($res3);
        $sql4 = "SELECT * from friends where userid='$user_id'";
        $res4 = mysqli_query($conn, $sql4);
        $following_no = mysqli_num_rows($res4);
        if (isset($_SESSION['id'])) {
            $id_sess = $_SESSION['id'];
            $id_sear = $res2_data['id'];
            $sql5 = "SELECT * from friends where userid='$id_sess' and friendid='$id_sear'";
            $res5 = mysqli_query($conn, $sql5);
        }
    } 
    else {
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
                    $sql = "SELECT * FROM userinfo WHERE id='$id'";
                    $result = mysqli_query($conn, $sql);
                    if(!(mysqli_num_rows($result) > 0)){
                        echo "<script>window.location.href ='userform.php'</script>";
                    } 
                    else {
                        $row_small = mysqli_fetch_assoc($result);
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
                <div class="user_details_pb">
                    <?php if($res2_data){?>
                        <div class="userinfo_display_box">
                            <div class="userinfo_user_photo">
                                <?php if(!$res2_data['photo_user']){?>
                                    <img src="def_prof.jpeg"/>
                                <?php }
                                    else{?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($res2_data['photo_user']);?>" />
                                <?php }?>
                            </div>
                            <div class="userinfo_user_name">
                                <a><?php echo ($res2_data['name'])." ".($res2_data['surname']);?></a>
                            </div>
                            <div class="userinfo_user_bio">
                                <a><?php echo $res2_data['bio'];?></a>
                            </div>
                        </div>
                    <?php }?>
                    <div class="follow_following">
                        <div class="user_followers">
                            <span class="f_nummber"><?php echo $follower_no?></span>
                            <div><span>Followers</span></div>
                        </div>
                        <div class="user_following">
                            <span class="f_nummber"><?php echo $following_no?></span>
                            <div><span>Following</span></div>
                        </div>
                    </div>
                    <div class="clr"></div>
                    <div class="user_details_follow_unfollow">
                        <form method="post" action="follow_user.php">
                        <?php if(isset($_SESSION['id'])){
                                if(($_SESSION['id'])!=$res2_data['id']){
                                if(mysqli_num_rows($res5)===1){?>
                                    <div>
                                        <button type="submit" name="unfollow_user" value="<?php echo $res2_data['id'];?>">Un-Follow</button>
                                    </div>
                                <?php } else { ?>
                                <div>
                                    <button type="submit" name="follow_user" value="<?php echo $res2_data['id']; ?>">Follow</button>
                                </div>
                        <?php } } }?>
                        </form>
                    </div>
                </div>

                <div id="pb_trib_users">
                <?php if ($res1) {
                        foreach ($res1 as $row) { ?>
                        <div class="pb_tribs_userinfo_display_box">
                            <div class="pb_tribs_userinfo_msgtext">
                                <a><?php echo $row['msgtext'];?></a>
                            </div>
                            <div class="pb_tribs_userinfo_msg_photo">
                                <?php if($row['photo']){?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']);?>" />
                                <?php }?>
                            </div>
                        </div>
                    <?php }
                    }?>
                </div>
                <div id="pr_trib_users">
                <?php if(isset($_SESSION['id'])){
                    if (mysqli_num_rows($res5) === 1) { 
                        if ($res6) {
                            foreach ($res6 as $row) { ?>
                                <div class="pb_tribs_userinfo_display_box">
                                    <div class="pb_tribs_userinfo_msgtext">
                                        <a><?php echo $row['msgtext']; ?></a>
                                    </div>
                                    <div class="pb_tribs_userinfo_msg_photo">
                                        <?php if ($row['photo']) { ?>
                                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" />
                                        <?php } ?>
                                    </div>
                                </div>
                <?php } } } }?>
            </div>
        </div>        
        <script src="scroll.js"></script>
    </body>
</html>