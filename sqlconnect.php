<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'elitestores';

    $connection = mysqli_connect($host , $username, $password , $database);
    
    $naira = '&#8358;' ;
    $shipping_cost      = 1000.50; //shipping cost
    $taxes              = array( //List your Taxes percent here.
                            'VAT' => 12, 
                            'Service Tax' => 5
                            );
    // if($connection){
    //     echo 'connection successful';
    // }else{
    //     echo 'something went wrong';
    // }

?>