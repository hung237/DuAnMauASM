<?php
    include "../database/database.php";
    session_start();
    error_reporting(4); //tắt thông báo lỗi(cảnh báo)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bevis-Sever</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/themify-icons/themify-icons.css">
    <link rel="icon" href="../../image/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>
<body>
    <header>
        <div class="grid">
            <div class="row">
                <div class="col c-4 logo">
                    <img src="../image/logokhongnen.png" alt="" srcset="">
                    <h2>Bevis-store Sever</h2>
                </div>
                <div class="col c-4 title">
                </div>
                <div class="col c-4 logout" style="text-align: right;">
                    <h2><img style="color: white;" src="../image/personal-security.png" alt=""> Admin</h2> 
                    <a href="../index.php">
                        <img src="../image/logout.png" alt="">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="box">
            <div class="menubar">
                <nav class="nav">
                    <li onclick="managerItems()">
                        <img src="../image/right.png" alt="">
                        <a href="admin.php?act=items">Quản lí sản phẩm</a></li>
                    <li>
                        <img src="../image/right.png" alt="">
                        <a href="admin.php?act=invoice">Quản lí hóa đơn</a></li>
                    <li>
                        <img src="../image/right.png" alt="">
                        <a href="admin.php?act=user">Quản lí người dùng</a></li>
                    <li>
                        <img src="../image/right.png" alt="">
                        <a href="admin.php?act=feedback">Quản lí doanh thu</a></li>
                </nav>
            </div>

            <div id="manager">
                <?php
                    $menusManager = $_GET['act'] ?: "";
                    if($menusManager){
                        echo "<script>
                                document.getElementById('manager').style.backgroundImage = 'url('../../image/backgroundadmin3.jpg')';
                        </script>";
                    }
                    switch($_GET['act']){
                        case 'items':
                            include "manager_items.php";
                            break;
                        case 'invoice':
                            include "manager_invoice.php";
                            break;
                        case 'user':
                            include "manager_user.php";
                            break;
                        case 'feedback':
                            include "manager_feedback.php";
                            break;
                    }
                ?>
                

            </div>
        </div>
    </section>

    <div id="container">
        <div class="box-products" id="box-products">
            <i class="ti-close" onclick="closeProducts()"></i>
            <form action="additem.php" method="POST" enctype="multipart/form-data">
                <div class="box-left">
                    <div class="form-row">
                        <label for="">Loại sản phẩm</label>
                        <select name="kind" id="">
                            <option value="">--Loại--</option>
                            <option value="ao">Áo</option>
                            <option value="quan">Quần</option>
                            <option value="giay">Giày</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="name">
                    </div>
                    <div class="form-row">
                        <label for="">Mô tả</label>
                        <input type="text" name="describtion">
                    </div>
                </div>

                <div class="box-right">
                    <div class="form-row">
                        <label for="">Ảnh sản phẩm</label>
                        <input type="file" accept="../image/*" name="image" class="uploadfile">
                    </div>
                    <div class="form-row">
                        <label for="">Giá sản phẩm</label>
                        <input type="number" name="price">
                    </div>
                    <button type="submit" name="addProducts">thêm sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function addProducts(){
            document.getElementById('container').style.display = 'block';
            document.getElementById('box-products').style.display = 'block'
        }
        function closeProducts(){
            document.getElementById('box-products').style.display = 'none'
            document.getElementById('container').style.display = 'none';
        }
        function managerItems(){
            document.getElementById('manager').style.backgroundImage = 'none';
            document.getElementById('manager-items').style.display = 'block'
        }
    </script>

</body>
</html>


<!-- sử lí khi thêm sản phẩm -->
