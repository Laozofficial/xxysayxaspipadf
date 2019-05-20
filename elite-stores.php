<?php
require 'cart.php';

require 'sqlconnect.php';
$token = $_SESSION['token'];

if (!isset($_SESSION['token'])) {
    header("Location: login.php");
    exit();
}


$errors = '';
if (isset($_GET['store_name'])) {
    $store_name = $_GET['store_name'];

    $sql = "SELECT * FROM stores WHERE  store_name = '$store_name'";
    $query = mysqli_query($connection, $sql);

    if (mysqli_num_rows($query) > 0) {

        while ($store_results = mysqli_fetch_assoc($query)) {
            $id = $store_results['id'];
            $store_id = $store_results['store_id'];
           $store_name = $store_results['store_name'];
            $store_category = $store_results['store_category'];
            $is_store_active = $store_results['store_active'];
            $store_logo = $store_results['store_logo'];
            $store_owner = $store_results['store_owner'];
            $store_verify = $store_results['store_verify'];
            $store_desc = $store_results['store_description'];
        }
    }
} else {
    //        add a message to show if the store is not available or active

}

$errors = '';

if (isset($_GET['unsubscribe'])) {
    if ($_SESSION['token']) {
        $token = $_SESSION['token'];
        $token = $_GET['unsubscribe'];

        $sql = mysqli_query($connection, "DELETE FROM `subscribers` WHERE subscriber_token = '$token'  AND store_subscribed_to = '$store_name'");

        if ($sql) {
            $errors .= '<div class="alert alert-success" role="alert">
                            you have successfully unsubscribed to the ' . $store_name . ' store
                        </div>';
        } else {
            $errors .= '<div class="alert alert-danger" role="alert">
                            something went wrong' . mysqli_error($connection) . '
                        </div>';
        }
    }
}

if (isset($_GET['subscribe'])) {
    if ($_SESSION['token']) {
        $token = $_SESSION['token'];
        $token = $_GET['subscribe'];


        $all_details = mysqli_query($connection, "SELECT * FROM users WHERE token = '$token' ");

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

        $confirm = mysqli_query(
            $connection,
            "SELECT * FROM `subscribers` WHERE subscriber_token = '$token'  AND store_subscribed_to = '$store_name' "
        );

        if (mysqli_num_rows($confirm) >= 1) {
            $errors .= '<div class="alert alert-warning" role="alert">
                            You are already subscribed to the ' . $store_name . '
                        </div>';
        } else {
            // $sql = "INSERT INTO `subscribers`
            //     id = '',
            //     subscriber_name = '$first_name',
            //     subscriber_token = '$is_token',
            //     subscriber_email = '$email',
            //     store_subscribed_to = '$store_name',
            //     store_id = '$store_id',
            //     date = NOW()
            // ";
            $sql = "INSERT INTO `subscribers`(`id`, `subscriber_name`, `subscriber_token`, `subscriber_email`, `store_subscribed_to`, `store_id`, `date`) VALUES ('', '$first_name', '$token', '$email', '$store_name', '$store_id', NOW())";

            $query = mysqli_query($connection, $sql);

            if ($query) {
                $errors .= '<div class="alert alert-success" role="alert">
                            you have successfully subscribed to the ' . $store_name . ' store
                        </div>';
            } else {
                $errors .= '<div class="alert alert-danger" role="alert">
                            something went wrong' . mysqli_error($connection) . '
                        </div>';
            }
        }
    } else {
        header("Location: login.php");
    }
}

?>
<?php require 'nav.inc.php';  ?>
<div class="page-head_agile_info_w3l uk-box-shadow-xlarge">
    <div class="container">
        <h3><?php echo $store_name  ?> <span>Store </span></h3>
        <!--/w3_short-->
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">

                <ul class="w3_short">
                    <li><a href="stores.php">Stores</a><i>|</i></li>
                    <li><?php echo $store_name  ?></li>
                </ul>
            </div>
        </div>
        <!--//w3_short-->
    </div>
</div>
<div class="uk-align-center">
    <div class="uk-container uk-container-expan">
        <div class="uk-card uk-card-body uk-card-default uk-box-shadow-xlarge">
            <div class="container">

                <?php echo $errors;
                if ($is_store_active == "banned") {
                    echo '<div class="alert alert-danger" role="alert">
                                   This store has been banned by the management , Please You are Advised not to shop from this store until the issue has been resolved
                                </div>';
                }
                ?>
                <img class="uk-border-rounded uk-margin-right uk-margin-large-right uk-margin-large-left  uk-align-left"
                    src="dashboard/<?php echo $store_logo ?>" width="200" height="200" alt="<?php echo $store_name ?>">
                <h2 clas="display-4 uk-text-bold uk-text-uppercase text-uppercase text-dark"
                    style="text-transform: uppercase;font-weight:bold">
                    <i class="fa fa-store"></i> <?php echo $store_name ?> <?php 
                            if ($is_store_active == "banned") {
                                echo '<span class="badge badge-danger">'.$is_store_active.'</span>';
                            }else{
                                echo '<span class="badge badge-success">'.$is_store_active.'</span>';
                            }
                        ?></span><br>

                    <form action="elite-stores.php?store_name=<?php echo $store_name ?>&subscribe=subscribe" method="GET">
                        <a href="#"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#exampleModal">Contact us <i class="fa fa-envelope"></i></button></a>
                        <?php
                        $check = mysqli_query(
                            $connection,
                            "SELECT * FROM `subscribers` WHERE subscriber_token = '$token' AND store_subscribed_to = '$store_name' "
                        );

                        if (mysqli_num_rows($check) > 0) {
                            echo '<a href="elite-stores.php?store_name=' . $store_name . '&unsubscribe=' . $token . '""
                        name="subscribe"><button type="button" name="subscribe" class="btn btn-danger btn-sm">Unsubscribe
                            <i class="fa fa-check"></i> </button></a>';
                        } else {
                            echo '<a
                            href="elite-stores.php?store_name=' . $store_name . '&subscribe=' . $token . '"
                            name="subscribe"><button type="button" name="subscribe"
                                class="btn btn-danger btn-sm">Subscribe <i class="fa fa-bell-o"></i> </button></a>';
                        }
                        ?>


                    </form>

                </h2>
                <hr>
                <p><br>
                    <span class="text-danger" style="font-weight:bold">Opened By :</span> <?php echo $store_owner ?>
                </p>
                <hr>
                <span class="text-danger" style="font-weight:bold">Store Description :</span> <?php echo $store_desc ?>
                </p>

            </div>
        </div>
        <br>
        <div class="uk-container uk-container-expan">
            <div class="">
                <?php

                if ($is_store_active == "banned") {
                    echo '<div class="alert alert-danger" role="alert">
                                   This store has been banned by the management , Please You are Advised not to shop from this store until the issue has been resolved
                                </div>';
                }else{
                    $sql = mysqli_query($connection, "SELECT * FROM products WHERE store_id = '$store_id' ORDER BY price ASC LIMIT 12");

                if (mysqli_num_rows($sql) > 0) {

                    while ($results = mysqli_fetch_assoc($sql)) {
                        $id = $results['id'];
                        $product_name = $results['product_name'];
                        $product_category = $results['product_category'];
                        $product_id = $results['product_id'];
                        $product_image = $results['product_image'];
                        $product_price = $results['price'];


                        echo '<div class="col-md-3 product-men "><div class="men-pro-item simpleCart_shelfItem ">
									<div class="men-thumb-item ">
										<img src="dashboard/' . $product_image . '" alt="' . $product_name . '" class="pro-image-front uk-height-medium">
										<img src="dashboard/' . $product_image . '" alt="' . $product_name . '" class="pro-image-back uk-height-medium">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="single.php?p_id=' . $product_id . '" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
											
									</div>
									<div class="item-info-product ">
										<h4><a href="single.php?' . $product_id . '">' . $product_name . '</a></h4>
										<div class="info-product-price">
											<span class="item_price"> ' . $naira . ' ' . number_format($product_price, 2) . '</span>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
															<form action="cart.php?action=add&id=' . $product_id . '" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="quantity" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="name" value="' . $product_name . '" />
																	<input type="hidden" name="price" value="' . $product_price . '" />
																	<input type="hidden" name="currency_code" value="Naira" />
																	<input type="hidden" name="return" value=" " />
																	<input type="hidden" name="cancel_return" value=" " />
																	<input type="submit" name="submit" value="Add to cart" class="button" />
																</fieldset>
															</form>
														</div>
																			
									</div>
								</div>
							</div>';
                    }
                }
                }
                



                ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<?php

if (isset($_REQUEST['contact'])) {

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
    $subject = mysqli_real_escape_string($connection, $_REQUEST['subject']);
    $message = mysqli_real_escape_string($connection, $_REQUEST['message']);

    if (empty($subject)) {
        $errors .= '<div class="alert alert-danger" role="alert">
                            Subject is empty
                        </div>';
    }
    if (empty($message)) {
        $errors .= '<div class="alert alert-danger" role="alert">
                            Message field is empty
                        </div>';
    }
    if (!empty($subject) and !empty($message)) {
        $sql = "INSERT INTO `messages`(`id`, `from_email`, `from_name`, `store_id`, `store_name`, `subject`, `message`, `date`) VALUES ('', '$email', '$first_name', '$store_id', '$store_name', '$subject', '$message', NOW() )";

        if (mysqli_query($connection, $sql)) {
            $errors .= '<div class="alert alert-success" role="alert">
                           message sent
                        </div>';
        } else {
            $errors .= '<div class="alert alert-danger" role="alert">
                            something went wrong ' . mysqli_error($connection) . '
                        </div>';
        }
    }
}

?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send message to <?php echo $store_name ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="elite-stores.php?store_name=<?php echo $store_name ?>" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Subject</label>
                        <input type="text" class="form-control" name="subject" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email">
                    </div <div class="form-group">
                    <label for=" exampleFormControlTextarea1">Message</label>
                    <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button name="contact" class="btn btn-primary btn-block btn-lg">Send Message</button>

        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
    </div><br><br>
</div>
<br><br><br>
</div>










<?php require 'footer.inc.php' ?>