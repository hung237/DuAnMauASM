<?php
    // error_reporting(4) tắt thông báo lỗi(cảnh báo);
    session_start();
    include "database/database.php";
    $error = false;
    // xử lí khi đăng nhập
    $_SESSION['stateUser'];
    if(!isset($_SESSION['stateUser'])){
        $_SESSION['stateUser'] = false;
    };
    if(isset($_POST['submitLogin']) && isset($_POST['submitLogin'])){
        $user = htmlspecialchars_decode($_POST['userLogin']);
        $password = htmlspecialchars_decode($_POST['passwordLogin']);
        $role = checkUser($user,$password);

        if($role == 1){
            header('location: admin/admin.php');
        }
        if($role == 0){
            $_SESSION['name'] = checkName($user,$password);
            $_SESSION['avatar'] = showAvatar($user,$password);
            $_SESSION['stateUser'] = true;
            }
        if($role == 2) {
            $error = true;
            }
    }

    // xử lí khi đăng kí
    $clickRegister = false;
    $errorName = null; 
    $errorEmail = null; 
    $errorUser = null; 
    $errorPassword = null;
    $errorQuestion = null;
    $errorAnswer = null;
    $errorAvatar = null;
    use PHPMailer\PHPMailer\PHPMailer;
    if(isset($_POST['submitRegister']) && isset($_POST['submitRegister'])){
        $name = htmlspecialchars_decode($_POST['newName']);
        $email = htmlspecialchars_decode($_POST['newEmail']);
        $user = htmlspecialchars_decode($_POST['newUser']);
        $password = htmlspecialchars_decode($_POST['newPassword']);
        $question = $_POST['question'];
        $answer = htmlspecialchars_decode($_POST['answer']);
        $avatar =  basename($_FILES['avatar']['name']);
        $clickRegister = true;
        

        $role = checkUser($user,$password);

        
        if(empty(trim($name))){
            $errorName = 'Bạn chưa nhập tên!';
        }
        else $errorName = '';

        if(empty(trim($email))){
            $errorEmail = 'Bạn chưa nhập email!';
        }
        else $errorEmail = '';

        if(empty(trim($user))){
            $errorUser = 'Bạn chưa nhập tài khoản!';
        }
        else $errorUser = '';

        if(empty(trim($password))){
            $errorPassword = 'Bạn chưa nhập mật khẩu!';
        }
        else echo $errorPassword = '';

        if(empty(trim($answer))){
            $errorAnswer = 'Bạn chưa nhập câu trả lời!';
        }
        else $errorAnswer = '';

        if(empty(trim($avatar))){
            $errorAvatar = 'Bạn chưa chọn ảnh đại diện';
        }
        else $errorAvatar = '';

        if(!empty(trim($name)) && !empty(trim($email)) && !empty(trim($user)) && !empty(trim($password)) && !empty(trim($answer)) && !empty(trim($avatar))){
            $checkExistUser = checkExistUser($user);
            // echo "<script>alert($checkExistUser);</script>";
            if($checkExistUser==0 || $checkExistUser == 1){
                $errorUser = 'Tài khoản đã tồn tại!';
            }
                else{
                    $avatarArr = explode(".",$avatar); // tạo mảng gồm gác phần tủ cách nhau dấu.
                    $ext = end($avatarArr);       // Lấy phàn tử cuối mảng(png,jpg...)
                    $target_dir = "image/avatar/"; // Nơi lưu file khi upload

                    do{
                        $newAvatar = "avatar-".uniqid().".".$ext; //Tên mới= avatar-random chuỗi.phần tử cuối bên trên
                        $target_file = $target_dir . $newAvatar; // tên file upload
                        $checkUrl =  checkAvatar($target_file);  // kiểm tra file ảnh đã tồn tài trong data chưa
                    }
                    while($checkUrl!=1);
                    addUser($name,$email,$user,$password,$question,$answer,$target_file);
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file);

                    function sendEmail($email){
                        $name = "Bùi Phi Hùng";  // Name of your website or yours
                        $to = $email;  // mail of reciever
                        $subject = "Member registration successfully! Bevis-Store";
                        $body = "Chúc mừng bạn đã đăng kí trở thành thành viên của Bevis-Store thành công!";
                        $from = "hungdt2307@gmail.com";  // you mail

                        require 'PHPMailer/src/EXception.php';
                        require 'PHPMailer/src/PHPmailer.php';
                        require 'PHPMailer/src/SMTP.php';

                        $mail = new PHPMailer(true);


                        try{
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = $from;
                            $mail->Password = 'fkveonmsarceezfg';
                            $mail->SMTPSecure = "tls";
                            $mail->Port = '587';

                            $mail->setFrom($from);
                            $mail->addAddress($to);

                            $mail->isHTML(true);
                            $mail->Subject = $subject;
                            $mail->Body = $body;

                            $mail->send();
                            echo "
                            <script>alert('Đăng kí thành công');</script>
                            ";
                        }
                        catch(Exception $e){
                            
                        }

                    }
                    sendEmail($email);
                    header('location: index.php');

                }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/themify-icons/themify-icons.css">
    <link rel="icon" href="../image/favicon.png">
    
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Bevis-store</title>
</head>
<body>
    <header id="header">
        <div class="grid">
            <div class="row">
                <div class="col c-3 logo">
                    <img src="image/logokhongnen.png" alt="">
                </div>
                <div class="col c-5 menu">
                    <nav class="nav">
                        <li><a style="background-color: #FF6F00;" href="index.php?act=home">Home</a></li>
                        <li><a href="index.php?act=about">About-us</a></li>
                        <li><a href="index.php?act=menus">Menus</a></li>
                        <li><a href="index.php?act=contact">Contact</a></li>
                        <li><a href="index.php?act=blog">Blog</a></li>
                    </nav>
                </div>
                <div class="col c-4 user">
                    <i class="ti-search">
                        <div class="search">
                            <input type="text" placeholder="Tìm Kiếm">
                        </div>
                    </i>
                    <a style="text-decoration: none;" href="index.php?act=cart">
                        <i class="ti-shopping-cart"></i>
                    </a>
                    <?php
                        if(!$_SESSION['stateUser']){
                            $_SESSION['name'] = "";
                            echo '
                                <i onclick="login()" class="ti-user"></i>
                            ';
                        }
                    ?>
                    
                    <div class="box-user">
                        <?php
                            if($_SESSION['stateUser']) {
                                echo '
                                <i class="stateUser">'.$_SESSION['name'].'</i>
                                    <i class="loginAvatar"><img src="'.$_SESSION['avatar'].'" alt=""></i>
                                ';
                            }
                        ?>


                        <?php
                            if($_SESSION['stateUser']){
                                $iconlogout= '
                                <div>
                                    <a style="text-decoration: none;" href="components/logout.php">
                                        <i name="logout" class="ti-arrow-right">
                                            <div class="border-logout"></div>
                                        </i>
                                    </a>
                                </div>';
                                echo $iconlogout;
                            }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </header>

    