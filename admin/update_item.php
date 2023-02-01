<?php
    session_start();
    $id = $_GET['this_id'];
    $_SESSION['this_id'] = $id;
    $item = showItem($id);
?>

<div id="update-item">
    <div class="box-update" id="box-update">
        <i class="ti-close" onclick="closeUpdate()"></i>
        <form action="check_update_item.php" method="POST" enctype="multipart/form-data">
            <div class="box-left">
                <div class="form-row">
                    <label for="">Loại sản phẩm</label>
                    <select name="kind" id="">
                        <option value= "<?php echo $item[0]['kind']; ?>"><?php echo $item[0]['kind']; ?></option>
                        <option value="ao">Áo</option>
                        <option value="quan">Quần</option>
                        <option value="giay">Giày</option>
                    </select>
                </div>

                <div class="form-row">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="name" value="<?php echo $item[0]['name']; ?>">
                </div>
                <div class="form-row">
                    <label for="">Mô tả</label>
                    <input type="text" name="describtion" value="<?php echo $item[0]['describtion']; ?>">
                </div>
            </div>

            <div class="box-right">
                <div class="form-row">
                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" accept="image/*" name="image" class="uploadfile" value="<?php echo $item[0]['image']; ?>">
                </div>
                <div class="form-row">
                    <label for="">Giá sản phẩm</label>
                    <input type="number" name="price" value="<?php echo $item[0]['price']; ?>">
                </div>
                <button type="submit" name="updateItem">update</button>
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
