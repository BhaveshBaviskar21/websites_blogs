<?php
    include "db_conn.php";
    $page = $_POST['page'];
    $limit = 5;
    $sub = ($page-1)*$limit;
    $sql = "SELECT pb_tribs.msgtext, pb_tribs.photo, userinfo.name,userinfo.id, userinfo.surname, userinfo.photo_user from pb_tribs JOIN userinfo on userinfo.id=pb_tribs.userid ORDER BY RAND() DESC limit $sub,$limit";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($data as $row){?>        
        <div class="pb_tribs_display_box">
            <div class="pb_tribs_header">
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
                <div class="show_more_info_pb_simple">
                    <form method="post" action="user_info_display.php">
                        <button type="submit" name="show_more" value="<?php echo ($row['id']); ?>">Show Profile</button>
                    </form>
                </div>
            </div>
            <div class="pb_tribs_text">
            <a><?php echo ($row['msgtext'])?></a>
            </div>
            <div class="pb_trib_photo">
                <?php if($row['photo']){?>
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']);?>" />
                <?php }?>
            </div>
        </div>
        <?php } ?>
    