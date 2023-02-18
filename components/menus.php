<div class="menus-box">
    <?php
        $item_per_page =  8;
        $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;
        $menus = listItemsMenus($item_per_page,$offset);

        $totalItem = totalItem();
        $totalPage  = ceil($totalItem/$item_per_page);

        foreach($menus as $item){
            echo '
                <div class="menus-box-item">
                    <div class="box-item-img">
                        <img src="'.$item['image'].'" alt="">
                    </div>
                    <h3>'.$item['name'].'</h3>
                    <h4>$'.$item['price'].'.00</h4>
                    <p>'.$item['describtion'].'.</p>
                    <div class="box-add-cart">
                        <button  name="id" onclick="addCart('.$item['id'].')" class="add-cart"><i class="ti-shopping-cart"></i></button>
                    </div>
                </div>
            ';
        }
    ?>   
    <script>
        function addCart(id){
            alert("Đã thêm sản phẩm vào giỏ hàng");
            $.post("components/addtocart.php",{'id':id}, function(data, status){
                $("#qty").text(data);
            });
        }
    </script>
    
    
        
    <div class="page">
        <?php
            if($current_page > 1){
                echo '
                <a class="pagination" href="index.php?act=menus&page='.($current_page-1).'"><</a>
                ';
            }
            for($i=1;$i<=$totalPage;$i++){
                if($i != $current_page){
                    echo '
                        <a class="pagination" href="index.php?act=menus&page='.$i.'">'.$i.'</a>
                    ';
                }
                else echo '
                        <strong class="current-page">'.$i.'</strong>
                    ';
            }
            if($current_page < $totalPage){
                echo '
                <a class="pagination" href="index.php?act=menus&page='.($current_page+1).'">></a>
                ';
            }
        ?>
    </div>


</div>