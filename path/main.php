 <!-- slide -->
 <?php
    $nav = $_GET['act'] ?: "home";
    switch($nav){
        case 'home':
            include "components/home.php";
            break;
        case 'about':
            include "components/about.php";
            break;
        case 'menus':
            include "components/menus.php";
            break;
        case 'contact':
            include "components/contact.php";
            break;
        case 'blog':
            include "components/blog.php";
            break;
        case 'cart':
            include "components/shoppingcart.php";
            break;
    }
    include 'components/form-login.php';
    
?>