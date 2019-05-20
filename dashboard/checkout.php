<?php

require '../cart.php';

require '../sqlconnect.php';

$token = $_SESSION['token'];

if (!isset($_SESSION['token'])) {
    header("Location: ../login.php");
    exit();
} else {

    if (empty($_SESSION['shopping_cart'])) {
        header("Location: ../all-products.php");
    }

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

$sqll = '';
$email_err = '';
$name_err = '';
$address1_err = '';
$address2_err = '';
$state_err = '';
$LG_err = '';
$number_err = '';
$message = '';



require 'sidebar.inc.php';


?>







<div class="container">

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <!--<tr>-->
                <!--      <br>-->
                <!--           <td> </td>-->
                <!--   </tr> -->
                <tr>
                    <!--<th scope="col">#</th>-->
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (!empty($_SESSION['shopping_cart'])) :
                    $total = 0;
                    foreach ($_SESSION['shopping_cart'] as $key => $product) :

                        ?>
                        <!--<th scope="row">1</th>-->

                        <tr>
                            <!--<td></td>-->

                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['quantity'];  ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><?php echo $naira ?> <?php echo  number_format($product['quantity'] * $product['price'], 2) ?>
                            </td>
                            <td><a class="btn btn-danger" href="../remove-items.php?action=delete&id=<?php echo $product['id']; ?>"><i class=" fa fa-trash"></i></a></td>
                        </tr>
                        <?php
                        $total = $total + ($product['quantity'] * $product['price']);
                    endforeach;
                    ?>
                    <tr>
                        <td colspan='3' align="center"><b>Total</b></td>
                        <td><?php echo $naira ?> <?php echo number_format($total, 2)   ?>

                        </td>
                    </tr>


                    <tr>
                        <?php
                        if (isset($_SESSION['shopping_cart'])) :
                            if (count($_SESSION['shopping_cart']) > 0) :
                                ?>
                                <!--   <td align="left"><a href="dashboard/checkout.php" class='btn btn-success btn-lg '>Check Out <i class="fa fa-money"></i></a></td>-->
                            <?php
                        endif;
                    endif;
                    ?>
                    </tr>
                <?php
            endif;
            ?>

            </tbody>
        </table>
    </div>

    <?php

    if (isset($_REQUEST['checkout'])) {
        //if(!empty($_SESSION['shopping_cart'])){
        $email = mysqli_real_escape_string($connection, $_REQUEST['email']);
        $name = mysqli_real_escape_string($connection, $_REQUEST['name']);
        $address1 = mysqli_real_escape_string($connection, $_REQUEST['address1']);
        $address2 = mysqli_real_escape_string($connection, $_REQUEST['address2']);
        $state = mysqli_real_escape_string($connection, $_REQUEST['state']);
        $LG = mysqli_real_escape_string($connection, $_REQUEST['lg']);
        $number = mysqli_real_escape_string($connection, $_REQUEST['number']);

        if (empty($email)) {
            $email_err = '<div class="alert alert-danger" role="alert">
                          Email is compulsory!
                      </div>';
        }
        if (empty($name)) {
            $name_err = '<div class="alert alert-danger" role="alert">
                          Name is compulsory!
                      </div>';
        }
        if (empty($address1)) {
            $address1_err = '<div class="alert alert-danger" role="alert">
                          Address is compulsory!
                      </div>';
        }
        if (empty($address2)) {
            $address2_err = '<div class="alert alert-danger" role="alert">
                          Second Address is compulsory!
                      </div>';
        }
        if (empty($state)) {
            $state_err = '<div class="alert alert-danger" role="alert">
                          state field is needed !
                      </div>';
        }
        if (empty($LG)) {
            $LG_err = '<div class="alert alert-danger" role="alert">
                          Pick a local Government!
                      </div>';
        }
        if (empty($number)) {
            $number_err = '<div class="alert alert-danger" role="alert">
                          input phone number!
                      </div>';
        }
        if (!empty($email) and !empty($name) and !empty($adress1) and !empty($address2) and !empty($state) and !empty($LG) and !empty($number)) {
            foreach ($_SESSION['shopping_cart'] as $key => $product) :
                $product_id = $product['id'];
                $product_name = $product['name'];
                $product_price = $product['price'];
                $product_qun = $product['quantity'];

                $order_id = mt_rand(100000, 10000000);

                $sql =  mysqli_query($connection, "INSERT INTO `orders`(`id`, `order_email`, `order_name`, `order_quantity`, `order_price`, `order_id`, `product_id`, `order_by`, `order_total`, `order_date`, `delivery_report`, `is_order_active`, `order_by_token`, `address1`, `address2`, `state`, `lg`, `phone_number`) VALUES ('', '$email', '$product_name', '$product_qun', '$product_price', '$order_id', '$product_id', '$name', '$total', NOW(), 'not delivered', 'yes', '$token', '$address1', '$address2', '$state', '$LG', '$number')");

            // mysqli_query($connection, $sql);
            endforeach;
            if (mysqli_query($sql)) {
                $message .= '<div class="alert alert-success" role="alert">
                                Order Successfully Made!
                            </div>';
            } else {
                $message .= '<div class="alert alert-danger" role="alert">
                                something went wrong
                            </div>' . mysqli_error($connection);
            }
        }
        // if (mysqli_query($sql)) {
        //     $message .= '<div class="alert alert-success" role="alert">
        //                         Order Successfully Made!
        //                     </div>';
        // } else {
        //     $message .= '<div class="alert alert-danger" role="alert">
        //                         something went wrong
        //                     </div>' . mysqli_error($connection);
        // }
        if (!$connection) {
            $message .= '<div class="alert alert-danger" role="alert">
                            something went wrong! <br>please try again after some time
                        </div>' . mysqli_error($connection);
        }
    }
    if (!$connection) {
        $message .= '<div class="alert alert-danger" role="alert">
                            something went wrong! <br>please try again after some time
                        </div>' . mysqli_error($connection);
    }


    //}

    // foreach ($_SESSION['shopping_cart'] as $key => $product) :
    //     $product_id = $product['id'];
    //     $product_name = $product['name'];
    //     $product_price = $product['price'];
    //     $product_qun = $product['quantity'];

    //     $order_id = mt_rand(100000, 10000000);

    //     echo   $sql = "INSERT INTO `orders`(`id`, `order_email`, `order_name`, `order_quantity`, `order_price`, `order_id`, `product_id`, `order_by`, `order_total`, `order_date`, `delivery_report`, `is_order_active`, `order_by_token`, `address1`, `address2`, `state`, `lg`, `phone_number`) VALUES ('', '$email', '$product_name', '$product_qun', '$product_price', '$order_id', '$product_id', '$name', '$total', NOW(), 'not delivered', 'yes', '$token', '$address1', '$address2', '$state', '$LG', '$number')";

    //     mysqli_query($connection, $sql);
    // endforeach;
    ?>
    <!--    user Details-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="../all-products.php" class="btn btn-info btn-sm">Back To Shop <i class="fa fa-cart-arrow-down"></i></a>
            <!-- <h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <div class="uk-container uk-caontainer-small">
                    <div class="">
                        <form action="checkout.php" method="post">

                            <h3 class="uk-text-center uk-text-bold text-dark">Shipping Details</h3>
                            <?php
                            echo $message;
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="text-dark">Email address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $email ?>" value="<?php echo $email ?>">
                                <small id="emailHelp" class="form-text"><?php echo $email_err ?></small>
                            </div>
                            <div class="form-group">
                                <label for="name" class="text-dark">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="<?php echo $first_name ?>" value="<?php echo $first_name . ' ' . $last_name ?>">
                                <small id="emailHelp" class="form-text"><?php echo $name_err ?></small>
                            </div>
                            <div class="form-group">
                                <label for="address1" class="text-dark">Address 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address1" id="address1" aria-describedby="emailHelp" placeholder="Delivery Address" value="">
                                <small id="emailHelp" class="form-text"><?php echo $address1_err ?></small>
                            </div>
                            <div class="form-group">
                                <label for="address2" class="text-dark">Address 2 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address2" id="address2" aria-describedby="emailHelp" placeholder="Delivery Address" value="">
                                <small id="emailHelp" class="form-text"><?php echo $address2_err ?></small>
                            </div>
                            <?php
                            $sql = "SELECT name FROM states  ";
                            $results_query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($results_query) > 0) {
                                echo ' <div class="form-group">
                                    <label for="state" class="text-dark">State <span class="text-danger">*</span></label>
                                    <select class="uk-select" name="state">
                                    <option selected value="">choose...</option>';
                                while ($results = mysqli_fetch_array($results_query)) {
                                    $data = $results['name'];
                                    echo '<option value="' . $data . '">' . $data . '</option>   ';
                                }
                                echo ' </select>
                                </div>';
                            }
                            echo $state_err;
                            ?>
                            <?php
                            $sql = "SELECT name FROM local_governments  ";
                            $results_query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($results_query) > 0) {
                                echo ' <div class="form-group">
                                    <label for="lg" class="text-dark">Local Government <span class="text-danger">*</span></label>
                                    <select class="uk-select" name="lg">
                                    <option selected value="">choose...</option>';
                                while ($results = mysqli_fetch_array($results_query)) {
                                    $data = $results['name'];
                                    echo '<option value="' . $data . '">' . $data . '</option>   ';
                                }
                                echo ' </select>
                                </div>';
                            }
                            echo $LG_err;
                            ?>
                            <div class="form-group">
                                <label for="phonenumber" class="text-dark">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="number" class="form-control" id="phonenumber" aria-describedby="emailHelp" placeholder="Phone Number" value="">
                                <small id="emailHelp" class="form-text"><?php echo $number_err ?></small>
                            </div>
                            <button type="submit" name="checkout" class="btn btn-primary btn-block">check out <i class="fas fa-fw fa-cart-arrow-down"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Your Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>



<?php require 'sidebar-footer.inc.php' ?>