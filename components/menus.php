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
                    <h4>'.$item['price'].' vnđ</h4>
                    <p>'.$item['describtion'].'.</p>
                    <div class="box-add-cart">
                        <button onclick="addCart('.$item['id'].')" class="add-cart"><i class="ti-shopping-cart"></i></button>
                    </div>
                </div>
            ';
        }
    ?>   
    <script>
        function addCart(id){
            alert(id);
            $.post("components/shoppingcart.php?id="+id, function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
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