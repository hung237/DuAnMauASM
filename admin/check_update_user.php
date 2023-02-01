<?php
    session_start();
    include '../database.php';
    if(isset($_POST['updateUser'])){
        $user = $_SESSION['this_user'];
        $newName = $_POST['newName'];
        $newEmail = $_POST['newEmail'];
        $newPass = $_POST['newPass'];
        $newRole = $_POST['newRole'];
        $newQuestion = $_POST['newQuestion'];
        $newAnswer = $_POST['newAnswer'];
        
        $userArr = showUser($user);
        $newAvatar = $_FILES['newAvt']['name'] ?: false;

        echo $newAvatar . "<br>";
        echo $newName . "<br>";
        echo $newEmail . "<br>";
        echo $newPass . "<br>";
        echo $newRole . "<br>";
        echo $newQuestion . "<br>";
        echo $newAnswer . "<br>";

        if($newAvatar){
            $avatarArr = explode(".",$newAvatar); // tạo mảng gồm gác phần tủ cách nhau dấu.
            $ext = end($avatarArr);       // Lấy phàn tử cuối mảng(png,jpg...)
            $target_dir = "../image/avatar/"; // Nơi lưu file khi upload
            unlink($userArr[0]['avatar']);
            do{
                $newAvatar = "avatar-".uniqid().".".$ext; //Tên mới= avatar-random chuỗi.phần tử cuối bên trên
                $target_file = $target_dir . $newAvatar; // tên file upload
                $checkUrl =  checkAvatar($target_file);  // kiểm tra file ảnh đã tồn tài trong data chưa
            }
            while($checkUrl!=1);
            updateUser($newName,$newEmail,$user,$newPass,$newRole,$newQuestion,$newAnswer,$target_file);
            move_uploaded_file($_FILES['newAvt']['tmp_name'], $target_file);
        }
        else{
            updateUserNotAvt($newName,$newEmail,$user,$newPass,$newRole,$newQuestion,$newAnswer);
        }
        header('location: admin.php?act=user');

    }
?>