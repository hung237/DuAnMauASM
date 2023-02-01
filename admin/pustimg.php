<?php
    if(isset($_POST['submit']) && isset($_POST['submit'])){
        $kind = $_POST['kind'];
        $name = $_POST['name'];
        $describtion = $_POST['describtion'];
        $price = $_POST['price'];

        // lấy tên file imgae
        $image =  basename($_FILES['image']['name']);

        // Đổi tên file
        $imageArr = explode(".",$image); // tạo mảng gồm gác phần tủ cách nhau dấu.
        $ext = end($imageArr);        // Lấy phàn tử cuối mảng(png,jpg...)
        $newimage = $kind."-".uniqid().".".$ext; // tạo tên file mới
                             //Tên mới= loại-random chuỗi.phần tử cuối bên trên
        
        $target_dir = "imagedemo/"; // Nơi lưu file khi upload
        $target_file = $target_dir . $newimage; // tên file upload
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file); // upload


         echo "<br>loại: ".$kind;
         echo "<br>tên: ".$name;
         echo "<br>mô tả: ".$describtion;
         echo "<br>giá: ".$price;
         echo "<br>url img: ".$newimage;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
        kind<select name="kind" id="">
                <option value="ao">Áo</option>
                <option value="quan">Quần</option>
                <option value="giay">Giày</option>
            </select>
        name<input type="text" name="name"><br><br>
        describtion<input type="text" name="describtion"><br><br>
        image<input type="file" accept="image/*" name="image"><br><br>
        price<input type="number" name="price"><br><br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>