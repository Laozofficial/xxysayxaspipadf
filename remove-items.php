<?php
    
    require 'cart.php';
    require 'sqlconnect.php';
    
if(filter_input(INPUT_GET, 'action') == 'delete'){
    foreach ($_SESSION['shopping_cart'] as $key => $product){
        if( $product['id'] == filter_input(INPUT_GET, 'id')){
                unset($_SESSION['shopping_cart'][$key]);
        }
    }
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

header("Location: view-cart.php");


?>