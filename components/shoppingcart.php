<?php
    session_start();
    include ('../database/database.php');
?>
<section style="margin-top: 90px;">
    <div class="bg-box-cart">
    <div class="box-cart">
        <div class="cart">
            <a href="index.php?act=menus" style="text-decoration: none;"><h3 class="ti-arrow-circle-left"> Continue shopping</h3></a>
            <hr style="margin: 10px 0;">


            <div class="cart-items" id="cartItems">
            <?php
                if(!isset($_SESSION["cart"])){
                    echo "<p>Shopping cart</p><br>
                    You have 0 items in your cart";
                }
                else{
                    echo '<p>Shopping cart</p><br>
                    You have '.count($_SESSION["cart"]).' items in your cart';
                    echo '<div class="main-box-cart">';
                    

                    foreach($_SESSION["cart"] as $index){
                        $item = showItem($index['product_id']);
                        echo '
                            <div class="item-of-cart" id="cartItem'.$item[0]["id"].'">
                                <div class="cart-items-img">
                                    <img src="../'.$item[0]["image"].'" alt="">
                                </div>
                                <div class="cart-items-name">
                                    <h3>'.$item[0]["name"].'</h3>
                                    <p>'.$item[0]["describtion"].'.</p>
                                </div>
                                <div class="cart-items-price">
                                    <h3>$'.$item[0]["price"]*$index['quantity'].'.00</h3>
                                </div>
                                <div class="cart-items-qty">
                                    <button onclick="reduceCart('.$item[0]['id'].')">-</button>
                                    <p>'.$index["quantity"].'</p>
                                    <button onclick="increaseCart('.$item[0]['id'].')">+</button>
                                </div>
                                <div class="cart-items-remove">
                                    <button onclick="remove('.$item[0]['id'].')">X</button>
                                </div>
                            </div>
                        ';

                    }
                    echo '</div>';

                }
            ?>
            </div>
        </div>
        <script>
            function increaseCart(id){
                $.post("components/increasecart.php",{'id':id}, function(data, status){
                    $("#qty").text(data);
                    window.scrollTo(0,0);
                    location.reload();
            });
            }
            function reduceCart(id){
                $.post("components/reducecart.php",{'id':id}, function(data, status){
                    window.scrollTo(0,0);
                    location.reload();

                });
            }
            function remove(id){
                $.post("components/removecart.php",{'id':id}, function(data, status){
                        $("#qty").text(data);
                        $('#cartItem'+id).css('display', 'none');
                        window.scrollTo(0,0);
                        location.reload();
                });
            }
        </script>
        <div class="pay">
            <div class="card-details">
                <h2>Card details</h2>
                <div class="card-details-img">
                    <?php
                        if(!isset($_SESSION['stateUser'])||$_SESSION['stateUser']==false){
                            echo '<img src="../image/avatar/avatar-credit-card.jpg" alt="">';
                        }
                        else{
                            echo "<img src=".$_SESSION['avatar'].">";
                        }
                    ?>
                    <!-- <img src="../image/avatar/avatar-63da10ec5db8c.jpg" alt=""> -->
                    
                </div>
            </div>
            <label for="">Card type</label>
            <div class="card-type">
                <img src="../image/cart-type-removebg-preview.png" alt="">
            </div>
            <input type="text" value="<?php
                if(!isset($_SESSION['stateUser'])||$_SESSION['stateUser']==false){
                    echo "Your Name";
                }
                else{
                    echo $_SESSION['name'];
                }
            ?>">
            <input type="text" value="<?php
                if(!isset($_SESSION['stateUser'])||$_SESSION['stateUser']==false){
                    echo "Your Number Card";
                }
                else{
                    echo "1234 5678 9012 3457";
                }
            ?>">
            <div class="expiration-cvv">
                <input type="text" value="01/22">
                <input type="text" value="01/22">
            </div>
            <hr>
            <div class="prepare-the-bill">
                <h3>Subtotal</h3>
                <h3>
                    
                    <?php
                        if(!isset($_SESSION['cart'])){
                            echo '$0.00';
                        }
                        else{
                            if(count($_SESSION['cart'])>=1){
                                $subtotal = 0;
                                foreach($_SESSION["cart"] as $index){
                                    $price = showItem($index['product_id']);
                                    $tam = $price[0]["price"]*$index['quantity'];
                                    $subtotal += $tam;
                                }
                                echo '$'.$subtotal.'.00';
                            }
                            else echo '$0.00';
                        }
                    ?>
                </h3>
            </div>
            <div class="prepare-the-bill">
                <h3>Shipping</h3>
                <h3>
                    <?php
                        if(!isset($_SESSION['cart'])){
                            echo '$0.00';
                        }
                        else{
                            if(count($_SESSION['cart'])>=1){
                                echo'$5.00';
                            }
                            else echo '$0.00';
                        }
                    ?>
                </h3>
            </div>
            <div class="prepare-the-bill">
                <h3>Total(Incl. taxes)</h3>
                <h3>
                    <?php
                        if(!isset($_SESSION['cart'])){
                            echo '$0.00';
                        }
                        else{
                            if(count($_SESSION['cart'])>=1){
                                $subtotal = 5;
                                foreach($_SESSION["cart"] as $index){
                                    $price = showItem($index['product_id']);
                                    $tam = $price[0]["price"]*$index['quantity'];
                                    $subtotal += $tam;
                                }
                                echo '$'.$subtotal.'.00';
                            }
                            else echo '$0.00';
                        }
                    ?>
                </h3>
            </div>

            <button>Pay Now</button>

        </div>
    </div>
    </div>
</section>