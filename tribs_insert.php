<?php
    include "index.php";
    if(!isset($_SESSION['id'])){
        echo "<script>window.location.href ='main.php'</script>";
    }
    else{
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM userinfo WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $row_small = mysqli_fetch_assoc($result);
            if(isset($_POST["Submit"]) && !empty($_POST["tribtext"]) && !empty($_POST["type_trib"])){
                $text = $_POST["tribtext"];
                $typetrib = $_POST["type_trib"];
                $tribphoto = "";
                if(!empty($_FILES['tribsphoto']['name'])){
                    $image = $_FILES['tribsphoto']['tmp_name']; 
                    $tribphoto = addslashes(file_get_contents($image));
                }
                $c = uniqid (rand (),true);
                $md5c = md5($c);
                $date=date_create();
                $tstamp = date_format($date,"Y-m-d H:i:s");
                if ($typetrib == "1"){
                    $sql = "INSERT INTO pb_tribs (msgid,userid,msgtext,photo,tstamp) VALUES ('$md5c','$id','$text','$tribphoto','$tstamp')";
                }
                else{
                    $sql = "INSERT INTO pr_tribs (msgid,userid,msgtext,photo,tstamp) VALUES ('$md5c','$id','$text','$tribphoto','$tstamp')";
                }
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>alert('Trib upload succesfull')</script>";
                }
                else{
                    echo "<script>alert('some Problem while uploading trib try again')</script>";
                }
            }            
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
                <div class="trib_ins">
                    <form enctype='multipart/form-data' method="post">
                        <textarea name="tribtext" id="tribtext" placeholder="Your text goes here" cols="40" rows="5" required></textarea>
                        <div id="display_box">
                        </div>
                        <div class="clr"></div>
                        <div class="tribimage">
                            <label for="tribphoto">
                                <a class='trib_photo_btn'>upload photo</a>
                            </label>
                            <input type="file" name="tribsphoto" id="tribphoto" accept="image/*"/>
                        </div>
                        <div class="clr"></div>
                        <div class="type_trib_box">
                            <input type="radio" name="type_trib" value="1" required> Public Trib
                            <input type="radio" name="type_trib" value="2" required> Private trib
                        <div class="clr"></div>
                        </div>
                        <input type="Submit" name="Submit" class="tribsubmit" value="SUBMIT"/>
                    </form>
                </div>
            </div>
        </div>
        <script src="display.js"></script>
        <script src="scroll.js"></script>
    </body>
</html>