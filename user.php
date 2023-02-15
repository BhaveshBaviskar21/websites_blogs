<?php
    include "index.php";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM userinfo WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $surname = $row['surname'];
            $phoneno = $row['phoneno'];
            $dob = $row['dob'];
            $photo_user = $row['photo_user'];
            $bio = $row['bio'];
            $gender = $row['gender'];
        }
        else{
            echo "<script>window.location.href ='userform.php'</script>";
            exit();
        }
        if (isset($_POST["Submit"])){
            $photo_user_update = "";
            if(!empty($_FILES['photo']['name'])){
                $image = $_FILES['photo']['tmp_name']; 
                $photo_user_update = addslashes(file_get_contents($image));
                $sql = "UPDATE userinfo SET `photo_user`='$photo_user_update' WHERE id='$id'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>window.location.href ='user.php'</script>";
                }
                else{
                    echo "<script>alert('some Problem while uploading photo try again')</script>";
                }
            }
            if(!empty($_POST['bio'])) {
                $bio = $_POST['bio'];
                $sql = "UPDATE userinfo SET `bio`='$bio' WHERE id='$id'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>window.location.href ='user.php'</script>";
                }
                else{
                    echo "<script>alert('some Problem while uploading bio try again')</script>";
                }
            }
        }
    }
    else{
        echo "<script>window.location.href ='login.php'</script>";
    }
?>
<html>
    <head>
        <title>User page</title>
    </head>
    <body>
        <div id="main_div">
            <div id="left_nav">
                <div class="small_user_info_for_easy">
                    <div class="small_user_profile_photo">
                        <?php if(!$photo_user){?>
                            <img src="def_prof.jpeg"/>
                        <?php } 
                            else{?>
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($photo_user);?>" />
                        <?php }?>
                    </div>
                    <div class="small_user_profile_name_surname">
                        <a><?php echo ($name)." ".($surname);?></a>
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
                <form method="post" enctype='multipart/form-data'>
                    <div id="prof_display_box">
                        <?php if ($photo_user == null) {?>
                            <img id="def_img" src="def_prof.jpeg"></img>
                        <?php }
                        else{?>
                            <img id="def_img_dbs" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($photo_user);?>"></img>
                        <?php }?>
                    </div>
                    <div class="prof_image">
                            <label for="upload">
                                <a>Upload Image</a>
                            </label>
                            <input type="file" name="photo" id="upload" />
                    </div>
                    <div class="pr_userinfo">
                        <div class="box">
                            <label for="name" class="fontLabel">Name (*): </label>
                            <div class="new iconBox">
                                <i class="material-symbols-outlined">person</i>
                            </div>
                            <div class="inputbox">
                                <input type="text" name="name" placeholder="<?php echo $name;?>" class="textBox"/>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="box">
                            <label for="surname" class="fontLabel">Surname (*): </label>
                            <div class="new iconBox">
                                <i class="material-symbols-outlined">person</i>
                            </div>
                            <div class="inputbox">
                                <input type="text" name="surname" placeholder="<?php echo $surname;?>" class="textBox"/>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="box">
                            <label for="dob" class="fontLabel">Date of Birth (*): </label>
                            <div class="new iconBox">
                                <i class="material-symbols-outlined">calendar_month</i>
                            </div>
                            <div class="inputbox">
                                <input type="date" name="dob" class="textBox" value="<?php echo $dob;?>"/>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <?php if ($phoneno == null) {?>
                        <div class="box">
                            <label for="phoneno" class="fontLabel">Phone No.: </label>
                            <div class="new iconBox">
                                <i class="material-symbols-outlined">call</i>
                            </div>
                            <div class="inputbox">
                                <input type="text" name="phoneno" placeholder="Phone No." class="textBox" style="pointer-events: visible;"/>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <?php }
                        else{?>
                        <div class="box">
                            <label for="phoneno" class="fontLabel">Phone No.: </label>
                            <div class="new iconBox">
                                <i class="material-symbols-outlined">call</i>
                            </div>
                            <div class="inputbox">
                                <input type="text" name="phoneno" placeholder="<?php echo $phoneno;?>" class="textBox""/>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <?php }?>
                        <div class="box">
                            <label for="gender" class="fontLabel"> Gender (*): </label>
                            <div class="inputbox">
                                <input type="text" name="gender" placeholder="<?php echo $gender;?>" class="genderBox""/>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="box">
                            <label for="bio" class="fontLabel"> bio : </label>
                            <div class="inputbox">
                                <textarea name="bio" class="bioBox" placeholder="<?php echo $bio;?>" cols="40" rows="5"></textarea>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="Sub">
                            <input type="Submit" name="Submit" class="submit" value="SUBMIT">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="scroll.js"></script>
        <script>
        const image_input = document.querySelector("#upload");
        var displayimage = "";
        image_input.addEventListener("change",function(){
            const reader = new FileReader();
            reader.addEventListener("load",()=>{
                displayimage = reader.result;
                <?php if ($photo_user == null) {?>
                document.getElementById("def_img").style.display = "none";
                <?php }
                else{?>
                document.getElementById("def_img_dbs").style.display = "none";
                <?php }?>
                document.querySelector("#prof_display_box").style.backgroundImage = `url(${displayimage})`;
            })
            reader.readAsDataURL(this.files[0]);
        })
        </script>
    </body>
</html>