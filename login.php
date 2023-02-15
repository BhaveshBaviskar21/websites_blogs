<?php
    include "index.php";
    if(isset($_POST["login"]) && !empty($_POST["lusername"]) && !empty($_POST["lpassword"])){
        $username = $_POST["lusername"];
        $password = $_POST["lpassword"];
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $password) {
                $_SESSION['id'] = $row['id'];
                $start = time();
                $_SESSION['expire'] = $start + 1800;
                echo "<script>window.location.href ='home.php'</script>";
                exit();
            }
        }
        else{
            echo "<script>alert('Input details Incorrect')</script>";
        }
    }
    if(isset($_POST["signup"]) && !empty($_POST["susername"]) && !empty($_POST["spassword"]) && !empty($_POST["semail"])&& !empty($_POST["c_password"])){
        $username = $_POST["susername"];
        $password = $_POST["spassword"];
        $email = $_POST["semail"];
        $c_password = $_POST["c_password"];
        $url = "login.php";
        $c = uniqid (rand (),true);
        $md5c = md5($c);
        if($password === $c_password){
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            if(!(mysqli_num_rows($result) > 0)){
                $sql = "SELECT * FROM users WHERE username='$username'";
                $result = mysqli_query($conn, $sql);
                if (!(mysqli_num_rows($result) > 0)) {
                    $sql = "INSERT INTO users (username ,password,email, id) VALUES ('$username','$password','$email','$md5c')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $_SESSION['id'] = $md5c;
                        $start = time();
                        $_SESSION['expire'] = $start + 1800;
                        echo "<script>window.location.href ='userform.php'</script>";
                    } else {
                        echo "<script>alert('some Problem while inserting data try again')</script>";
                    }
                }else {
                    echo "<script>alert('useraname alreay in use')</script>";
                }
            } else {
                echo "<script>alert('user email alreay exists')</script>";
            }
        }
        else{
            echo "<script>alert('Passwords dont match try again')</script>";
        }
    }
?>

<html>
    <head>
        <title>login page</title>
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
                <div class="form_log">
                    <input type="checkbox" id="chk" aria-hidden="true">
                    <div id="login_main">
                        <form method="post">
                            <br><input type="text" placeholder="Username"  pattern="^\w*$" name="lusername" required=""/>
                            <br>Username
                            <div class="clr"></div>
                            <br><input type="password" placeholder="Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*\W)(?=.*[A-Z]).{8,}$" name="lpassword" required=""/>
                            <br>Password
                            <div class="clr"></div>
                            <br><button type="submit" name="login">LOG IN</button>
                            <br><label for="chk" aria-hidden="true">sign up</label>
                            <br><p style="font-size: smaller;">
                                password must contain lowercase
                                <br>
                                password must contain upercase
                                <br>
                                password must contain symbol
                                <br>
                                password must contain number
                            </p>
                        </form>

                    </div>
                    <div id="signup_main">
                        <form method="post" >
                            <br><input type="text" placeholder="Username" pattern="^\w*$" name="susername" required/>
                            <br>Username
                            <div class="clr"></div>
                            <br><input type="text" placeholder="Email" name="semail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required/>
                            <br>Email
                            <div class="clr"></div>
                            <br><input type="password" placeholder="Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*\W)(?=.*[A-Z]).{8,}$" name="spassword" required/>
                            <br>Password
                            <div class="clr"></div>
                            <br><input type="password" placeholder="Confirm Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*\W)(?=.*[A-Z]).{8,}$" name="c_password" required/>
                            <br>confirm Password
                            <div class="clr"></div>
                            <br><button type="submit" name="signup">SIGN UP</button>
                            <br><label for="chk" aria-hidden="true">log in</label>
                            <br><p style="font-size: smaller;">
                                password must contain lowercase
                                <br>
                                password must contain upercase
                                <br>
                                password must contain symbol
                                <br>
                                password must contain number
                            </p>
                        </form>
                    </div>
                    </input>
                </div>
            </div>
        </div>
        <script src="scroll.js"></script>
    </body>
</html>