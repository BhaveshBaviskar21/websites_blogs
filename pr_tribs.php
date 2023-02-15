<?php
    session_start();
    include "db_conn.php";
    $id = $_SESSION['id'];
    $page = $_POST['page_pr'];
    $limit = 5;
    $sub = ($page-1)*$limit;
    $sql = "SELECT pr_tribs.msgtext, pr_tribs.photo, userinfo.name, userinfo.id, userinfo.surname, userinfo.photo_user from pr_tribs, userinfo, friends where friends.userid='$id' and userinfo.id=friends.friendid and pr_tribs.userid=friends.friendid limit $sub,$limit";
    //$sql = "SELECT pr_tribs.msgtext, pr_tribs.photo, pr_tribs.likes , userinfo.name, userinfo.surname, userinfo.photo_user from pr_tribs JOIN userinfo on userinfo.id=pr_tribs.userid order by pr_tribs.likes DESC limit $sub,$limit";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($data as $row){?>        
        <div class="pr_tribs_display_box">
            <div class="pr_tribs_header">
                <div class="user_photo">
                    <?php if(!$row['photo_user']){?>
                        <img src="def_prof.jpeg"/>
                    <?php } else{?>
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo_user']);?>" />
                    <?php }?>
                </div>
                <div class="username">
                    <a><?php echo ($row['name'])." ".($row['surname'])?></a>
                </div>
                <div class="show_more_info_pr_simple">
                    <form method="post" action="user_info_display.php">
                        <button type="submit" name="show_more" value="<?php echo ($row['id']); ?>">Show Profile</button>
                    </form>
                </div>
            </div>
            <div class="pr_tribs_text">
            <a><?php echo ($row['msgtext'])?></a>
            </div>
            <div class="pb_trib_photo">
                <?php if($row['photo']){?>
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']);?>" />
                <?php }?>
            </div>
        </div>
        <?php } ?>