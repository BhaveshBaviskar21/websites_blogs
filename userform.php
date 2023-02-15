<?php
    include "index.php";
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM userinfo WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
            echo "<script>window.location.href ='user.php'</script>";
        } else {
            if (isset($_POST["Submit"]) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["dob"]) && !empty($_POST["Gender"])) {
                $name = $_POST["name"];
                $surname = $_POST["surname"];
                $dob = $_POST['dob'];
                $gender = $_POST['Gender'];
                $phoneno = $_POST['phoneno'];
                $bio = $_POST['bio'];
                $userphoto = "";
                if (!empty($_FILES['photo']['name'])) {
                    $image = $_FILES['photo']['tmp_name'];
                    $userphoto = addslashes(file_get_contents($image));
                }
                $sql = "INSERT INTO userinfo (id,name,surname,phoneno,dob,gender,bio,photo_user) VALUES ('$id','$name','$surname','$phoneno','$dob','$gender','$bio','$userphoto')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>window.location.href ='home.php'</script>";
                } else {
                    echo "<script>alert('some Problem while inserting data try again')</script>";
                }
            }
        }
    } else {
        echo "<script>window.location.href ='login.php'</script>";
    }
?>
<html>
    <head>
        <title>login page</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
                        <img id="def_img" src="def_prof.jpeg"></img>
                    </div>
                    <div class="prof_image">
                            <label for="upload">
                                <a>Upload Image</a>
                            </label>
                            <input type="file" name="photo" id="upload" />
                    </div>
                    <div class="box">
                        <label for="name" class="fontLabel">Name (*): </label>
                        <div class="new iconBox">
                        <i class="material-symbols-outlined">person</i>
                        </div>
                        <div class="inputbox">
                            <input type="text" name="name" placeholder="Name" pattern="^\w*$" class="textBox" required/>
                        </div>
    			    <div class="clr"></div>
    		        </div>
                    <div class="box">
                        <label for="surname" class="fontLabel">Surname (*): </label>
                        <div class="new iconBox">
                        <i class="material-symbols-outlined">person</i>
                        </div>
                        <div class="inputbox">
                            <input type="text" name="surname" placeholder="Surname" pattern="^\w*" class="textBox" required/>
                        </div>
    			    <div class="clr"></div>
    		        </div>
                    <div class="box">
                        <label for="dob" class="fontLabel">Date of Birth (*): </label>
                        <div class="new iconBox">
                        <i class="material-symbols-outlined">calendar_month</i>
                        </div>
                        <div class="inputbox">
                            <input type="date" name="dob" min='1905-01-01' max='2005-01-01' class="textBox" required/>
                        </div>
    			    <div class="clr"></div>
    		        </div>
                    <div class="box">
                        <label for="phoneno" class="fontLabel">Phone No.: </label>
                        <div class="new iconBox">
                        <i class="material-symbols-outlined">call</i>
                        </div>
                        <div class="inputbox">
                            <input type="text" name="phoneno" placeholder="9876543210" pattern="^[0-9]\d*.{9,12}$" class="textBox"/>
                        </div>
    			    <div class="clr"></div>
    		        </div>
                    <div class="box">
                        <label for="gender" class="fontLabel" aria-required="true"> Gender (*): </label>
                        <div class="radio">
                            <input type="radio" name="Gender" value="male" required> Male 
                            <input type="radio" name="Gender" value="female" required> Female
                            <input type="radio" name="Gender" value="other" required> Other
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="box">
                        <label for="bio" class="fontLabel"> bio : </label>
                        <div class="inputbox">
                            <textarea name="bio" class="bioBox" placeholder="Write something about yourself," cols="40" rows="5" pattern="^(?=.*\d)(?=.*[a-z])(?=.*\W)(?=.*[A-Z]).{,400}$"></textarea>
                        </div>
    			    <div class="clr"></div>
    		        </div>
                    <div class="clr"></div>
                    <div class="Sub">
                        <input type="Submit" name="Submit" class="submit" value="SUBMIT">
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
                document.getElementById("def_img").style.display = "none";
                document.querySelector("#prof_display_box").style.backgroundImage = `url(${displayimage})`;
            })
            reader.readAsDataURL(this.files[0]);
        })
        </script>
    </body>
</html>