<div class="manager-items">
    <h1>Quản Lí Người Dùng</h1>
    <br><br>
    <div id="title-user">
        <div class="stt-user">STT</div>
        <div class="user-avatar">Avatar</div>
        <div class="user-Name">Name</div>
        <div class="user-userName">User Name</div>
        <div class="user-passWord">Password</div>
        <div class="user-permission">Quyền User</div>
        <div class="decentralization">chỉnh sửa</div>
        <div class="remove-user">Xóa User</div>
    </div>
    <div id='main_items'>
        <?php
            $index = 1;
            $listUser = listUser();
            foreach($listUser as $user){
                echo '
                <div class="user">
                    <div class="sttUser">'.$index.'</div>
                    <div class="imageUser">
                        <img src="../'.$user["avatar"].'">
                    </div>
                    <div class="nameUser">'.$user["name"].'</div>
                    <div class="userName">'.$user["username"].'</div>
                    <div class="userPassword">'.$user["password"].'</div>
                ';

                if($user["role"] == 1){
                    echo'
                    <div class="userPermission">admin</div>
                    ';
                }
                else echo'
                    <div class="userPermission">user</div>
                    ';

                echo'
                    <div class="settingUser"><a href="admin.php?act=user&event=update_user&this_user='.$user["username"].'&url='.$user["avatar"].'"><img src="../image/setting.png"></a></div>
                    <div class="removeUser"><a href="delete_user.php?this_user='.$user["username"].'&url='.$user["avatar"].'"><img src="../image/remove.png"></a></div>
                </div>
                ';
                $index ++;
            }
        ?>
    </div>
</div>
<?php
    $update = $_GET['event'] ?: "";
    switch($update){
        case 'update_user':
            include "update_user.php";
            break;
    }
 ?>
<script>document.getElementById('manager').style.backgroundImage = 'none';
    
</script>



