<?php

session_start();

$product_ids = array();

//session_destroy(); 

//check if items are added to cart
if(filter_input(INPUT_POST, 'submit')){
    if(isset($_SESSION['shopping_cart'])){
        $count = count($_SESSION['shopping_cart']);
        
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        
        //pre_r($product_ids);
        if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
                $_SESSION['shopping_cart'][$count] = array(
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );
        }else{
            for($i = 0 ; $i < count($product_ids); $i++){
                if($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                        $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
    }else{
        $_SESSION['shopping_cart'][0] = array(
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
    
header("Location: all-products.php");
}


// pre_r($_SESSION);
// //
// ////
// function pre_r($array){
//     echo '<pre>';
//     print_r($array);
//     echo '</pre>';
    
// }


?>