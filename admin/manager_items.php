<div class="manager-items" id="manager-items">
    <h1>Quản Lí Sản Phẩm</h1>
    <button  onclick="addProducts()">Thêm Sản Phẩm</button>
    <div id="title-items">
        <div class="stt-items">STT</div>
        <div class="image-items">Hình Ảnh</div>
        <div class="name-items">Tên Sản Phẩm</div>
        <div class="price-items">Giá Tiền</div>
        <div class="setting-items">Sửa</div>
        <div class="remove-items">Xóa</div>
    </div>
    <div id='main_items'>
        <!-- hiển thị danh sách items -->
        <?php
            $index = 1;
            $listItems = listItems();
            foreach($listItems as $item){
                echo '
                <div class="item">
                    <div class="stt-item">'.$index.'</div>
                    <div class="image-item">
                        <img src="../'.$item["image"].'">
                    </div>
                    <div class="name-item">'.$item["name"].'</div>
                    <div class="price-item">$'.$item["price"].'.00</div>
                    <div class="setting-item"><a href="admin.php?act=items&event=update_item&this_id='.$item["id"].'&url='.$item["image"].'"><img src="../image/setting.png"></a></div>
                    <div class="remove-item"><a href="delete_item.php?this_id='.$item["id"].'&url='.$item["image"].'"><img src="../image/remove.png"></a></div>
                </div>
                ';
                $index ++;
            }
        ?>
    </div>
</div>

    <?php
        $update = $_GET['event'] ?: "";
        switch($update){
            case 'update_item':
                include "update_item.php";
                break;
        }
    ?>

<script>
    document.getElementById('manager').style.backgroundImage = 'none';

</script>


