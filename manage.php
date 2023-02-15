<?php
    include "index.php";
    if(!isset($_SESSION['id'])){
        echo "<script>window.location.href ='main.php'</script>";
    }
    else{
        if(isset($_POST['delete_trib_pb'])){
            $delete = $_POST['delete_trib_pb'];
            $sql = "DELETE FROM `pb_tribs` WHERE msgid='$delete'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $delete = "";
            }
            else{
                echo "<script>alert('some Problem while deleting public trib try again')</script>";
            }
        }
        if(isset($_POST['delete_trib_pr'])){
            $delete = $_POST['delete_trib_pr'];
            $sql = "DELETE FROM `pr_tribs` WHERE msgid='$delete'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $delete = "";
            }
            else{
            echo "<script>alert('some Problem while deleting private trib try again')</script>";
            }
        }
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM userinfo WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
            $sql = "SELECT * from pr_tribs where userid='$id'";
            $res = mysqli_query($conn, $sql);
            $prdata = mysqli_fetch_all($res,MYSQLI_ASSOC);
            $sql = "SELECT * from pb_tribs where userid='$id'";
            $res = mysqli_query($conn, $sql);
            $pbdata = mysqli_fetch_all($res,MYSQLI_ASSOC);
            $row_small = mysqli_fetch_assoc($result);
        }
        else{
            echo "<script>window.location.href ='userform.php'</script>";
        }

    }
?>
<html>
    <head>
        <title>Main page</title>
    </head>
    <body>
        <div id="main_div">
            <div id="left_nav">
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
                            <i class="material-symbols-outlined">manage_search</i>
                        </div>
                        <div class="nav__text_box">
                            <a href="manage.php">Manage trib</a>
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
                </ul>
            </div>
            <div id="main">
            </div>
            <div id="right_nav">
                <div class='titletext_manage'>
                    <span id='title_tribs'>YOUR TRIBS</span>
                </div>
                <div class='manage_pr_pb'>
                    <button id="pr_tribs_manage" onclick="pr_tribs_manage()">Private</button>
                    <button id="pb_tribs_manage" onclick="pb_tribs_manage()">Public</button>
                </div>
                <div class="list_for_tribs">
                    <div id="pb_manage">
                        <?php foreach($pbdata as $row){ ?>
                        <div class="per_display_box">
                            <div class="per_tribs_text">
                            <a><?php echo ($row['msgtext']); ?></a>
                            </div>
                            <div class="per_trib_photo">
                                <?php if($row['photo']){ ?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" />
                                <?php }?>
                            </div>
                            <div class='manage_buttons'>
                                <form method="post">
                                    <button type="submit" name="delete_trib_pb" value="<?php echo ($row['msgid']); ?>"><span class="material-symbols-outlined" style="font-size: 20px;">delete</span></button>
                                </form>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <div id='pr_manage'>
                        <?php foreach($prdata as $row){ ?>
                        <div class="per_display_box_pr">
                            <div class="per_tribs_text">
                            <a><?php echo ($row['msgtext']); ?></a>
                            </div>
                            <div class="per_trib_photo">
                                <?php if($row['photo']){ ?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" />
                                <?php }?>
                            </div>
                            <div class='manage_buttons'>
                                <form method="post">
                                    <button type="submit" name="delete_trib_pr" value="<?php echo ($row['msgid']); ?>"><span class="material-symbols-outlined" style="font-size: 20px;">delete</span></button>
                                </form>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <script src="scroll.js"></script>
        <script>
            function pb_tribs_manage(){
                document.getElementById('pr_manage').style.display="none";
                document.getElementById('pb_manage').style.display="flex";
            }
            function pr_tribs_manage(){
                document.getElementById('pb_manage').style.display="none";
                document.getElementById('pr_manage').style.display="flex";
            }
        </script>
    </body>
</html>