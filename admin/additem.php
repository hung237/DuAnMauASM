<!-- sử lí khi thêm sản phẩm -->
<?php
    if(isset($_POST['addProducts']) && isset($_POST['addProducts'])){
        echo "<script>alert('hello');</script>";
        $kind = $_POST['kind'];
        $name = $_POST['name'];
        $describtion= $_POST['describtion'];
        $price= $_POST['price'];

        // lấy tên file imgae
        $image =  basename($_FILES['image']['name']);
        include '../database/database.php';

        
        if(!empty(trim($kind)) && !empty(trim($name)) && !empty(trim($describtion)) && !empty(trim($price)) && !empty(trim($image))){
            // $checkUrl = 1;
            // Đổi tên file
            $imageArr = explode(".",$image); // tạo mảng gồm gác phần tủ cách nhau dấu.
            $ext = end($imageArr);        // Lấy phàn tử cuối mảng(png,jpg...)
            $newimage = $kind."-".uniqid().".".$ext; // tạo tên file mới
                                //Tên mới= loại-random chuỗi.phần tử cuối bên trên
            
            $target_dir = "image/products/".$kind."/"; // Nơi lưu file khi upload
            $target_file = $target_dir . $newimage; // tên file upload
            do{
                $newimage = $kind."-".uniqid().".".$ext;
                $target_file = $target_dir . $newimage;
                $checkUrl =  checkItems($target_file);
            }
            while($checkUrl!=1);
            addItem($kind,$name,$describtion,$target_file,$price);
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            echo "<script>
                alert('Thêm sản phẩm thành công');
            </script>";
        }
        else
            echo "<script>alert('Nhập và điền đầy đủ thông tin');</script>";
        // echo "<script>
        //         document.getElementById('manager').style.backgroundImage = 'none';
        // </script>";
        header('location: admin.php?act=items');
    }
?>