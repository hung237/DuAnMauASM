<?php
    session_start();
    $id = $_GET['this_user'];
    $_SESSION['this_user'] = $id;
    $user = showUser($id);

    // $_SESSION['avatar'] = $user[0]['avatar'];
    
?>
<script>
    function chooseFile(){
        var fileSelected = document.getElementById('imageFile').files;
        if(fileSelected.length > 0){
            var fileToLoad = fileSelected[0];
            var fileReader = new FileReader();
            fileReader.onload = function(fileLoaderEvent){
                var srcData = fileLoaderEvent.target.result;
                var newImage = document.getElementById('newAvt');
                newImage.src = srcData;
            }
            fileReader.readAsDataURL(fileToLoad);
        }

    }
</script>
<div id="update-item">
    <div class="box-update box-update-user" id="box-update">
        <i class="ti-close" onclick="closeUpdate()"></i>
        <form action="check_update_user.php" method="POST" enctype="multipart/form-data">
            <div class="box-left-user">
                <div class="box-user-avatar">
                    <img id="newAvt" src="../<?php echo $user[0]['avatar'];?>" alt="">
                </div>
                <div class="box-user-avatar">
                    <input onchange="chooseFile()" id="imageFile" name="newAvt" accept="image/*" type="file" value="<?php echo $user[0]['avatar'];?>">
                </div>
                <div class="box-user-name">
                    <input name="newName" type="text" value="<?php echo $user[0]['name'];?>">
                </div>
                <div class="box-user-email">
                    <input name="newEmail" type="text" value="<?php echo $user[0]['email'];?>">
                </div>
            </div>

            <div class="box-right-user">
                <div class="box-user-username">
                    <label for="">username: </label> 
                    <input readonly="true" type="text" value="<?php echo $user[0]['username'];?>"></input>
                </div>
                <div class="box-user-password">
                    <label for="">password: </label> 
                    <input name="newPass" type="text" value="<?php echo $user[0]['password'];?>">
                </div>
                <div class="box-user-quyen">
                    <label for="">quyền user: </label>
                    <select name="newRole" name="" id="">
                        <?php 
                            if($user[0]['role'] == 0){
                                echo '
                                <option value="0">user</option>
                                <option value="1">admin</option>
                                ';
                            }
                            else {
                                echo '
                                <option value="1">admin</option>
                                <option value="0">user</option>
                                ';
                            }
                        ?>
                    </select>
                </div>
                <div class="box-user-quyen">
                    <label for="">câu hỏi: </label>
                    <select name="newQuestion" id="">
                        <?php
                            if($user[0]['question']=="hobbie"){
                                echo '
                                    <option value="hobbie">Sở thích của bạn là gì?</option>
                                    <option value="friend">Tên người bạn thân của bạn?</option>
                                    <option value="pet">Tên con vật nuôi của bạn</option>
                                ';
                            }
                            if($user[0]['question']=="friend"){
                                echo '
                                    <option value="friend">Tên người bạn thân của bạn?</option>
                                    <option value="hobbie">Sở thích của bạn là gì?</option>
                                    <option value="pet">Tên con vật nuôi của bạn</option>
                                ';
                            }
                            if($user[0]['question']=="pet"){
                                echo '
                                    <option value="pet">Tên con vật nuôi của bạn</option>
                                    <option value="hobbie">Sở thích của bạn là gì?</option>
                                    <option value="friend">Tên người bạn thân của bạn?</option>
                                ';
                            }
                        ?>
                        
                    </select>
                </div>
                <div class="box-user-password">
                    <label for="">Answer: </label> 
                    <input name="newAnswer" type="text" value="<?php echo $user[0]['answer'];?>">
                </div>
                <div class="btn-uploaduser">
                    <button type="submit" name="updateUser">update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('update-item').style.display = 'block'
    document.getElementById('box-update').style.display = 'flex';
    function closeUpdate(){
            document.getElementById('update-item').style.display = 'none'
            document.getElementById('box-update').style.display = 'none';
    }
</script>