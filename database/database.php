<?php
    
    function connectdb(){
        $servername = "localhost:3308";
        $user = "root";
        $pass = "Hung2307";
        $dbName = "asmphp";
        $conn = new PDO("mysql:host=$servername;dbname=$dbName", $user, $pass);
        return  $conn;
    }

    function checkUser($user,$password){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM user WHERE username=? AND password =?");
        $stmt -> bindParam(1,$user);
        $stmt -> bindParam(2,$password);
        $stmt -> execute();
        $kq = $stmt -> fetchAll();
        if(count($kq)>0){

            
            return $kq[0]['role'];
        }
        else return 2;
    }

    function searchUser($user){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM user WHERE username=?");
        $stmt -> bindParam(1,$user);
        $stmt -> execute();
        $kq = $stmt -> fetchAll();
        if(count($kq)>0){

            
            return 1;
        }
        else return 0;
    }
    function checkForget($user,$question,$answer){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM user 
        WHERE username=? AND question=? AND answer=?");
        $stmt -> bindParam(1,$user);
        $stmt -> bindParam(2,$question);
        $stmt -> bindParam(3,$answer);
        $stmt -> execute();
        $kq = $stmt -> fetchAll();
        if(count($kq)>0){

            
            return 1;
        }
        else return 0;
    }
    function resetPassword($user,$pass){
        $conn = connectdb();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $sql = "UPDATE user SET password='$pass' WHERE username='$user'";
        // Prepare statement
        $stmt = $conn->prepare($sql);
      
        // execute the query
        $stmt->execute();
    }

    function checkName($user,$password){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM user WHERE username='".$user."' AND password = '".$password."'");
        $stmt -> execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt -> fetchAll();
        return $kq[0]['name'];
    }
    function showAvatar($user,$password){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM user WHERE username='".$user."' AND password = '".$password."'");
        $stmt -> execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt -> fetchAll();
        return $kq[0]['avatar'];
    }
    

    function checkExistUser($user){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM user WHERE username='".$user."'");
        $stmt -> execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt -> fetchAll();
        if(count($kq)>0){
            return $kq[0]['role'];
        }
        else return 2;
    }

    function addUser($name, $email, $user, $pass, $question, $answer, $avatar){
        $conn = connectdb();
        $sql = $conn -> prepare("INSERT INTO user (name, email, username, password, question, answer, avatar)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql -> bindParam(1,$name);
        $sql -> bindParam(2,$email);
        $sql -> bindParam(3,$user);
        $sql -> bindParam(4,$pass);
        $sql -> bindParam(5,$question);
        $sql -> bindParam(6,$answer);
        $sql -> bindParam(7,$avatar);
        $sql->execute();
    }

    function checkItems($file){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM products WHERE image='".$file."'");
        $stmt -> execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt -> fetchAll();
        if(count($kq)>0){
            return 0;
        }
        else return 1;
    }
    function checkAvatar($file){
        $conn = connectdb();
        $stmt = $conn -> prepare("SELECT * FROM user WHERE avatar='".$file."'");
        $stmt -> execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt -> fetchAll();
        if(count($kq)>0){
            return 0;
        }
        else return 1;
    }

    function addItem($kind, $name, $describtion, $img, $price){
        $conn = connectdb();
        $sql = "INSERT INTO products (kind, name, describtion, image, price)
        VALUES ('$kind', '$name', '$describtion', '$img', '$price')";
        $conn->exec($sql);
    }

    function listItems(){
        $conn = connectdb();
        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq;
    }

    function showItem($id){
        $conn = connectdb();
        $sql = "SELECT * FROM products WHERE id='".$id."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq;
    }

    function deleteItem($this_id){
        $conn = connectdb();
      
        // sql to delete a record
        $sql = "DELETE FROM products WHERE id='$this_id'";
      
        // use exec() because no results are returned
        $conn->exec($sql);
    }


    function updateItem($kind,$name,$describtion,$price,$id){
        $conn = connectdb();
        // set the PDO error mode to exception
      
        $sql = "UPDATE products SET id='$id' , kind='$kind' , describtion='$describtion'
        , name='$name' , price='$price' WHERE id='$id'";
        // Prepare statement
        $stmt = $conn->prepare($sql);
      
        // execute the query
        $stmt->execute();
    }



    function listItemsMenus($item_per_page,$offset){
        $conn = connectdb();
        $sql = "SELECT * FROM products ORDER BY id ASC LIMIT $item_per_page OFFSET $offset";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq;
    }
    function totalItem(){
        $conn = connectdb();
        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return count($kq);
    }





    // user
    function listUser(){
        $conn = connectdb();
        $sql = "SELECT * FROM user";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
        return $kq;
    }


    function deleteUser($this_user){
        $conn = connectdb();
      
        // sql to delete a record
        $sql = "DELETE FROM user WHERE username='$this_user'";
      
        // use exec() because no results are returned
        $conn->exec($sql);
    }

    function showUser($user){
        $conn = connectdb();
        $sql = "SELECT * FROM user WHERE username='".$user."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $kq = $stmt->fetchAll();
        return $kq;
    }


    function updateUser($newName,$newEmail,$user,$newPass,$newRole,$newQuestion,$newAnswer,$target_file){
        $conn = connectdb();
        // set the PDO error mode to exception
      
        $sql = "UPDATE user SET name='$newName' , email='$newEmail' , password='$newPass'
        , role='$newRole' , question='$newQuestion' , answer='$newAnswer' , avatar='$target_file' WHERE username='$user'";
        // Prepare statement
        $stmt = $conn->prepare($sql);
      
        // execute the query
        $stmt->execute();
    }

    function updateUserNotAvt($newName,$newEmail,$user,$newPass,$newRole,$newQuestion,$newAnswer){
        $conn = connectdb();
        // set the PDO error mode to exception
      
        $sql = "UPDATE user SET name='$newName' , email='$newEmail' , password='$newPass'
        , role='$newRole' , question='$newQuestion' , answer='$newAnswer' WHERE username='$user'";
        // Prepare statement
        $stmt = $conn->prepare($sql);
      
        // execute the query
        $stmt->execute();
    }
?>