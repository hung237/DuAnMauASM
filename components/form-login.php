    <!-- form đăng nhập -->
    <div id="login">
        <div id="form-login">
            <h2>Đăng Nhập</h2>
            <i onclick="close_login()" class="ti-close"></i>
            <form id="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <input type="text" placeholder="Tài Khoản" name="userLogin">
                <input type="password" placeholder="Mật khẩu" name="passwordLogin">
                <p style="color: red;" onchange="login()">
                    <?php
                        if($error){
                            echo 'Sai tài khoản hoặc mật khẩu';
                            echo "<script>
                                document.getElementById('login').style.display = 'block';
                                document.getElementById('form-login').style.display = 'block';
                            </script>";
                        }
                    ?>
                    
                </p>
                <button type="submit" name="submitLogin">Đăng nhập</button>
            </form>
            <a href="../components/forgot_password.php" style="color: #2ea0e6;">Quên Mật khẩu</a>
            <p>Bạn chưa có tài khoản? <a onclick="register()">Đăng kí</a></p>
        </div>

        <div id="form-register">
            <h2>Đăng Kí</h2>
            <i onclick="close_login()" class="ti-close"></i>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <div class="box-register">
                    <div class="box-left">
                        <label for="">Họ & Tên <span class="error-register">
                            <?php echo $errorName; ?>
                        </span></label>
                        <input name="newName" type="text">


                        <label for="">Email<span class="error-register">
                            <?php echo $errorEmail; ?>
                        </span></label>
                        <input name="newEmail" type="email">


                        <label for="">Tài khoản<span" class="error-register">
                            <?php echo $errorUser; ?>
                        </span></label>
                        <input name="newUser" type="text">


                        <label for="">password<span class="error-register">
                            <?php echo $errorPassword; ?>
                        </span></label>
                        <input name="newPassword" type="password">
                    </div>

                    <div class="box-right">
                        <label for="">Câu hỏi bí mật<span" class="error-register">
                            <?php echo $errorQuestion; ?>
                        </span></label>
                        <select name="question" id="">
                            <option value="hobbie">Sở thích của bạn là gì?</option>
                            <option value="frend">Tên người bạn thân của bạn?</option>
                            <option value="pet">Tên con vật nuôi của bạn?</option>
                        </select>

                        <label for="">Câu trả lời<span class="error-register">
                            <?php echo $errorAnswer; ?>
                        </span>
                        <input name="answer" type="text">

                        <label for="">Chọn ảnh đại diện<span class="error-register">
                            <?php echo $errorAvatar; ?>
                        </span>
                        <input onchange="chooseFile()" id="imageFile" name="avatar" type="file" accept="image/*" class="avatar">

                        <div class="box-avatar">
                            <img id="newAvt" src="../image/avatar/avatarRegister.jpg" alt="">
                        </div>
                    </div>

                </div>

                

                <div class="btn-register" style="text-align: center; width: 100%;">
                    <button type="submit" name="submitRegister">Đăng kí</button>
                </div>
            </form>
            <p>Bạn đã có tài khoản? <a onclick="login()">Đăng nhập</a></p>
        </div>
        <?php
            if($clickRegister){
                echo "<script>
                        document.getElementById('form-login').style.display = 'none';
                        document.getElementById('login').style.display = 'block';
                        document.getElementById('form-register').style.display = 'block';
                    </script>";
            }
        ?> 


    </div>