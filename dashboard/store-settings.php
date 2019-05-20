<?php


session_start();

require '../sqlconnect.php';

$token = $_SESSION['token'];

if (!isset($_SESSION['token'])) {
    header("Location: ../index.php");
    exit();
} else {

    $all_details = mysqli_query($connection, "SELECT * FROM users WHERE token = '$token'");

    if (mysqli_num_rows($all_details)) {

        $results = mysqli_fetch_assoc($all_details);
        $id = $results['id'];
        $token = $results['token'];
        $email = $results['email'];
        $first_name = $results['first_name'];
        $is_admin = $results['is_admin'];
        $last_name = $results['last_name'];
        $image_dir = $results['image_dir'];

        // echo $username;
    }
}

$store_details = mysqli_query($connection, "SELECT * FROM stores WHERE store_owner_token = '$token'");
if (mysqli_num_rows($store_details)) {

    $store_results = mysqli_fetch_assoc($store_details);
    $store_id = $store_results['store_id'];
    $store_name = $store_results['store_name'];
    $store_category = $store_results['store_category'];
    $is_store_active = $store_results['store_active'];
    $store_logo = $store_results['store_logo'];
}



$errors = '';
$success = '';

$product_name = '';
$product_color = '';
$product_price = '';
$product_quantity = '';

//   if (isset($_REQUEST['save_item'])) {
//     $product_name = mysqli_real_escape_string($connection, $_REQUEST['product_name']);
//     $product_price = mysqli_real_escape_string($connection, $_REQUEST['product_price']);
//     $product_quantity = mysqli_real_escape_string($connection, $_REQUEST['product_quantity']);
//     $product_color = mysqli_real_escape_string($connection, $_REQUEST['product_color']);


//     if (empty($product_name)) {
//         $errors .= '<div class="alert alert-danger" role="alert">
//                         Product Name Field is Empty !<br><br>
//                     </div>';
//     }
//     if (empty($product_price)) {
//         $errors .= '<div class="alert alert-danger" role="alert">
//                         Product Price Field is Empty !<br><br>
//                     </div>';
//     }
//     if (empty($product_quantity)) {
//         $errors .= '<div class="alert alert-danger" role="alert">
//                         Product Quantity Field is Empty !<br><br>
//                     </div>';
//     }
//     if (empty($product_color)) {
//         $errors .= '<div class="alert alert-danger" role="alert">
//                         Product color Field is Empty !<br><br>
//                     </div>';
//     }

//     if (!empty($product_name) and !empty($product_price) and !empty($product_color) and !empty($product_quantity)) {
//         $product_verify = mysqli_query($connection, "SELECT * FROM products where product_name = '$product_name'");
//             if(mysqli_num_rows($product_verify) >= 1 ) {
//                 $errors .= '<div class="alert alert-danger" role="alert">
//                             Product with this name already exist
//                         </div>';
//             }else{

//             }
//   }


// }

if (isset($_REQUEST['save_item'])) {

    $product_name = mysqli_real_escape_string($connection, $_REQUEST['product_name']);
    $product_price = mysqli_real_escape_string($connection, $_REQUEST['product_price']);
    $product_quantity = mysqli_real_escape_string($connection, $_REQUEST['product_quantity']);
    $product_color = mysqli_real_escape_string($connection, $_REQUEST['product_color']);


    if (empty($product_name)) {
        $errors .= '<div class="alert alert-danger" role="alert">
                        Product Name Field is Empty !<br><br>
                    </div>';
    }
    if (empty($product_price)) {
        $errors .= '<div class="alert alert-danger" role="alert">
                        Product Price Field is Empty !<br><br>
                    </div>';
    }
    if (empty($product_quantity)) {
        $errors .= '<div class="alert alert-danger" role="alert">
                        Product Quantity Field is Empty !<br><br>
                    </div>';
    }
    if (empty($product_color)) {
        $errors .= '<div class="alert alert-danger" role="alert">
                        Product color Field is Empty !<br><br>
                    </div>';
    }

    if (!empty($product_name) and !empty($product_price) and !empty($product_color) and !empty($product_quantity)) {
        $product_verify = mysqli_query($connection, "SELECT * FROM products where product_name = '$product_name'");
        if (mysqli_num_rows($product_verify) >= 1) {
            $errors .= '<div class="alert alert-danger" role="alert">
                            Product with this name already exist
                        </div>';
        } else {

            $product_id = mt_rand(100000, 10000000);
            $file = $_FILES['dp'];
            $file_name = $_FILES['dp']['name'];
            $file_Tmp_Name = $_FILES['dp']['tmp_name'];
            $file_size = $_FILES['dp']['size'];
            $file_error = $_FILES['dp']['error'];
            $file_type = $_FILES['dp']['type'];



            $fileExt = explode('.', $file_name);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileActualExt, $allowed)) {
                if ($file_error === 0) {
                    if ($file_size < 100000000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $filelocation = 'uploads/' . $fileNameNew;
                        move_uploaded_file($file_Tmp_Name, $filelocation);
                        // echo "upload success";
                        $initial_query = "INSERT INTO products SET  
                              id = '',
                              product_name = '$product_name',
                              product_category = '$store_category',
                              product_id ='$product_id',
                              product_image = '$filelocation',
                              price = '$product_price',
                              rating = '',
                              quantity = '$product_quantity',
                              color = '$product_color',
                              store_id = '$store_id',
                              store_name = '$store_name',
                              date_posted = NOW()
             
                            ";
                        $upload_query = mysqli_query($connection, $initial_query);
                        if ($upload_query) {
                            $success .= '<div class="alert alert-success" role="alert">
                                           Product Uploaded Successfully !
                                          </div>';
                            // header("Location: dashboard:index.php");            
                        } else {
                            echo mysqli_error($connection);
                        }
                    } else {
                        $errors .= '<div class="alert alert-danger" role="alert">
                                File too large !<br><br>
                              </div>';
                    }
                } else {
                    $errors .= '<div class="alert alert-danger" role="alert">
                          There was an error uploading your file !<br><br>
                        </div>';
                }
            } else {
                $errors .= '<div class="alert alert-danger" role="alert">
                                You cannot Upload this file !<br><br>
                              </div>' . mysqli_error($connection);
            }
        }
    }
}



?>

<?php require 'sidebar.inc.php' ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Store Settings</h1>
        <?php
        $store_check = mysqli_query($connection, "SELECT * FROM stores WHERE store_owner_token = '$token'");
        if (mysqli_num_rows($store_check) >= 1) {
            $results = mysqli_fetch_assoc($store_check);
            $store_id = $results['store_id'];

            echo '<a href="store-branding.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> Brand Your Store</a>';
        }
        ?>

    </div>
    <?php
    //  $store_check = mysqli_query($connection, "SELECT * FROM stores WHERE store_owner_token = '$token'");
    //  if(mysqli_num_rows($store_check) >= 1 ) {
    //    $results = mysqli_fetch_assoc($store_check);
    //    $store_id = $results['store_id'];
    //  }
    //    $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `orders` WHERE store_id = '$store_id'");
    //    $row = mysqli_fetch_assoc($result);
    //    $count = $row['store_id'];

    //   //  echo $count;
    ?>
    <!-- Content Row -->
    <?php
    if ($store_logo == '') {
        echo '<div class="alert alert-warning" role="alert">
                         Upload store Logo and Attach a desciption for your store to be fully active and available for users to visit<br><br>
                         <a href="store-branding.php" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> Brand Your Store</a>
                     </div>';
    }
    ?>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Store Subscribers
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `subscribers` WHERE store_id = '$store_id'");
                                $row = mysqli_fetch_assoc($result);
                                echo $count = $row['count'];
                                ?>


                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Money spent</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">&#8358; 215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-money-bill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Messages
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php
                                        $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `messages` WHERE store_id = '$store_id'");
                                        $row = mysqli_fetch_assoc($result);
                                        echo $count = $row['count'];
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `orders` WHERE store_id = '$store_id'");
                                $row = mysqli_fetch_assoc($result);
                                echo $count = $row['count'];
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->


</div>
<!-- /.container-fluid -->
<div class="container">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800  uk-text-uppercase">Open New Store</h1>
          <p class="mb-4">Open a new store and start selling</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#additem"><i
                    class="fas fa-fw fa-plus"></i> Add New items to your store </button>
            <!-- <h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="uk-container uk-caontainer-small">
                    <?php

                    if (isset($_GET['success'])) {
                        $success = '<div class="alert alert-success" role="alert">
                                        Product successfully Deleted
                                    </div>';
                    }
                    if (isset($_GET['errors'])) {
                        $errors = '<div class="alert alert-danger" role="alert">
                                      something went wrong
                                  </div>';
                    }
                    if (isset($_GET['order-errors'])) {
                        $errors = '<div class="alert alert-danger" role="alert">
                                      ' . $_GET['order-errors'] . '
                                  </div>';
                    }
                    echo $errors;
                    echo $success;
                    ?>
                    <?php

                    $sql = "SELECT * FROM products WHERE store_id = '$store_id'";
                    $fetch_product = mysqli_query($connection, $sql);

                    if (mysqli_num_rows($fetch_product) > 0) {
                        echo ' ';

                        while ($fetch_result = mysqli_fetch_assoc($fetch_product)) {
                            $p_name = $fetch_result['product_name'];
                            $p_cat = $fetch_result['product_category'];
                            $p_id = $fetch_result['product_id'];
                            $p_image = $fetch_result['product_image'];
                            $p_price = $fetch_result['price'];
                            $p_rating = $fetch_result['rating'];
                            $p_quantity = $fetch_result['quantity'];
                            $p_color = $fetch_result['color'];
                            $p_date_posted = $fetch_result['date_posted'];


                            $is_result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `orders` WHERE product_id = '$p_id'");
                            $row = mysqli_fetch_assoc($is_result);
                            $count = $row['count'];

                            echo '<div class="uk-child-width-expand@s uk-text-center" uk-grid>  
                                         <div>
                                            <div class="">
                                                <img src="' . $p_image . '" class="uk-border-round" style="height:112px;">
                                                <p class="text-dark uk-text-bold uk-text-uppercase">' . $p_name . '</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                            
                                              <p class="text-dark uk-text-bold uk-text-lef">Price: &#8358; ' . number_format($p_price, 2) . '</p>
                                              <p class="text-dark uk-text-bold uk-text-lef">Highest Rating: ' . $p_rating . '</p>
                                              <p class="text-dark uk-text-bold uk-text-let">Color: <input class="form-control uk-align-center form-control-sm" type="color"  value="' . $p_color . '" style="width: 110px;" readonly></p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                              <a href="more-info.php?orders_product_id=' . $p_id . '" class="btn btn-primary uk-align-lef"><i class="fa fa-users"></i> Orders (' . $count . ')</a>
                                             
                                              <a href="more-info.php?delete_product_id=' . $p_id . '" class="btn btn-danger uk-align-lef"><i class="fa fa-trash"></i> Delete</a>
                                            </div>
                                            </div>
                                            </div>
                                            <hr>
                          <br>  
                                        ';
                        }
                    }
                    echo '
                          ';
                    ?>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
</div>
      </div> -->
<!-- End of Main Content -->



<!-- Add item to store modal -->
<div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add item to your store</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="store-settings.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="productname">Product Name</label>
                        <input type="text" class="form-control" name="product_name" id="productname"
                            aria-describedby="emailHelp" placeholder="Product Name" value="<?php echo $product_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="productprice">Product Price</label>
                        <input type="number" class="form-control" name="product_price" id="productprice"
                            aria-describedby="emailHelp" placeholder="Product Price"
                            value="<?php echo $product_price ?>">
                        <small id="emailHelp" class="form-text text-dark">Just Type in the Price - Example: 6000</small>
                    </div>
                    <div class="form-group">
                        <label for="productquan">Product Quantity</label>
                        <input type="number" class="form-control" name="product_quantity" id="productquan"
                            aria-describedby="emailHelp" placeholder="Product Quantity Available"
                            value="<?php echo $product_quantity ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_color">Product Color</label>
                        <input type="color" class="form-control" name="product_color" id="product_color"
                            placeholder="Product Color" value="<?php echo $product_color ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Product Image</label>
                        <input type="file" name="dp" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" name="save_item" class="btn btn-primary">Save Item To Store</button>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="save_item" class="btn btn-primary">Save Item To Store</button> -->
            </div>

        </div>
    </div>
</div>
<?php require 'sidebar-footer.inc.php' ?>