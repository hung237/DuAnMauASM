<?php
    session_start();
    $error = null;
    if(isset($_POST['submit'])){
        $user = htmlspecialchars_decode($_POST['user']);
        include '../database/database.php';

        $check = searchUser($user);
        if($check == 0){
            $error = "Tài khoản không tồn tại";
        }
        else{
            $error = "";
            $_SESSION['userForget'] = $user;
            header('location: handle_password.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html{
            font-family: Arial, Helvetica, sans-serif;
        }
        body{
            background-color: #f5f5f7;
        }
        .container{
            width: 100%;
            
        }
        .box{
            width: 40%;
            margin: 100px 30%;
            background-color: white;
            text-align: center;
            display: block;
            padding: 50px 0;
        }
        h2{
            font-size: 22px;
            line-height: 1.4;
        }
        p{
            height: 14px;
            width: 100%;
            color: red;
            margin: 30px 0 5px 0;
        }
        input{
            height: 44px;
            border: solid 2px #e6e6e9;
            width: 70%;
            margin: 5px 15% 0 15%;
            outline: none;
            padding-left: 24px;
            border-radius: 5px;
        }
        button{
            height: 44px;
            border: solid 2px rgb(17, 126, 97);
            width: 70%;
            margin: 30px 15%;
            background-color: rgb(17, 126, 97);
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
        }
        button:hover{
            cursor: pointer;
            border: solid 2px rgb(17, 126, 97);
            background-color: white;
            color: rgb(17, 126, 97);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h2>ENTER YOUR USER TO RESET <br> YOUR PASSWORD</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <p><?php echo $error; ?></p>
                <input name="user" type="text" placeholder="User name">
                <button name="submit" type="submit">Submit</button>
            </form>
            <p style="color: black; font-size: 18px;">Comeback to <a style="color: #117e61; text-decoration: none;" href="../index.php">home page</a></p>
        </div>
    </div>
</body>
</html>
