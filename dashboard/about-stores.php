<?php

    require '../cart.php';
    require '../sqlconnect.php';
    $token = $_SESSION['token'];

 if(!isset($_SESSION['token'])){
    header("Location: ../index.php");
    exit();
 }else{

  $all_details = mysqli_query($connection, "SELECT * FROM users WHERE token = '$token'");

  if(mysqli_num_rows($all_details)){

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
     $store_description = $store_results['store_description'];
     $store_verify = $store_results['store_verify'];

 }   
    require 'sidebar.inc.php';


$errors = '';
$msg = '';
    if (isset($_GET['store_id'])) {
        $store_id = $_GET['store_id'];

        $sql = mysqli_query($connection, "SELECT * FROM stores WHERE store_id = '$store_id'");

        if (mysqli_num_rows($sql) > 0) {
            
           while( $store_results = mysqli_fetch_assoc($sql)){
            $store_id = $store_results['store_id'];
            $store_name = $store_results['store_name'];
            $store_category = $store_results['store_category'];
            $is_store_active = $store_results['store_active'];
            $store_logo = $store_results['store_logo'];
            $store_desc = $store_results['store_description'];
            $store_owner = $store_results['store_owner'];
            $store_verify = $store_results['store_verify'];
           }
        }

    }


    if (isset($_GET['verified'])) {
        $store_id = $_GET['verified'];

        $sql = mysqli_query($connection, "UPDATE `stores` SET `store_verify`= 'verified' WHERE store_id = '$store_id'");

        if($sql){
            $msg = '<div class="alert alert-success" role="alert">
                        Store Verified, Please Refresh the Page
                    </div>';
        }else{
            $msg = '<div class="alert alert-danger" role="alert">
                        something went wrong '.mysqli_error($connection).'
                    </div>';
        }
    }

    if (isset($_GET['unverified'])) {
        $store_id = $_GET['unverified'];

        $sql = mysqli_query($connection, "UPDATE `stores` SET `store_verify`= '' WHERE store_id = '$store_id'");

        if($sql){
            $msg = '<div class="alert alert-success" role="alert">
                        Store Verification Removed, Please Refresh the Page
                    </div>';
        }else{
            $msg = '<div class="alert alert-danger" role="alert">
                        something went wrong '.mysqli_error($connection).'
                    </div>';
        }
    }


    if (isset($_GET['ban'])) {
        $store_id = $_GET['ban'];

        $sql = mysqli_query($connection, "UPDATE  `stores` SET `store_active`= 'banned' WHERE store_id = '$store_id'");

        if($sql){
            $msg = '<div class="alert alert-success" role="alert">
                        Store Has Been Banned, Please Refresh the Page
                    </div>';
        }else{
            $msg = '<div class="alert alert-danger" role="alert">
                        something went wrong '.mysqli_error($connection).'
                    </div>';
        }
    }

    if (isset($_GET['activate'])) {
        $store_id = $_GET['activate'];

        $sql = mysqli_query($connection, "UPDATE  `stores` SET `store_active`= 'active' WHERE store_id = '$store_id'");

        if($sql){
            $msg = '<div class="alert alert-success" role="alert">
                        Store Has Been Activated, Please Refresh the Page
                    </div>';
        }else{
            $msg = '<div class="alert alert-danger" role="alert">
                        something went wrong '.mysqli_error($connection).'
                    </div>';
        }
    }
?>



        <div class="containe">
 <!-- Page Heading -->
 <!-- <h1 class="h3 mb-2 text-gray-800  uk-text-uppercase">Open New Store</h1>
          <p class="mb-4">Open a new store and start selling</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#additem"><i class="fas fa-fw fa-plus"></i> Add New item to your store </button>
              <!-- <h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6> -->
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <div class="">
                  <div class="uk-align-center">
    <div class="uk-container uk-container-expan">
        <div class="uk-card uk-card-body uk-card-default uk-box-shadow-xlarge">
            <div class="container">

                <?php echo $msg;
                ?>
                <img class="uk-border-rounded uk-margin-right uk-margin-large-right uk-margin-large-left  uk-align-left"
                    src="<?php echo $store_logo ?>" width="200" height="200" alt="<?php echo $store_name ?>">
                <h2 clas="display-4 uk-text-bold uk-text-uppercase text-uppercase text-dark"
                    style="text-transform: uppercase;font-weight:bold">
                   
                    <i class="fa fa-store"></i> <?php echo $store_name ?>
                        <?php
                        if ($is_store_active == "active") {
                            echo ' <span
                            class="badge uk-h6 text-light text-small badge-success">'.$is_store_active.'</span><br>';
                        }else{
                            echo ' <span
                            class="badge uk-h6 text-light text-small badge-danger">'.$is_store_active.'</span><br>'; 
                        }
                    ?>

                    <form action="elite-stores.php?store_name=<?php echo $store_name ?>&subscribe=subscribe" method="GET">
                    <?php

                   
                        if ($store_verify == "verified") {
                            echo '<a href="about-stores.php?store_id='.$store_id.'&store_name=' . $store_name . '&unverified=' . $store_id . '"
                            name="unverified"><button type="button" name="unverified"
                                class="btn btn-danger btn-sm">unverify <i class="fa fa-chevron-circle-right"></i> </button></a>';
                        }else{
                            echo '<a href="about-stores.php?store_id='.$store_id.'&store_name=' . $store_name . '&verified=' . $store_id . '"
                            name="verified"><button type="button" name="verified"
                                class="btn btn-success btn-sm">verify <i class="fa fa-chevron-circle-right"></i> </button></a>';
                        }

                        ?>
                       
                        <?php
                        $check = mysqli_query(
                            $connection,
                            "SELECT * FROM `stores` WHERE store_active = 'active' AND store_name = '$store_name' "
                        );

                        if (mysqli_num_rows($check) > 0) {
                            echo '<a href="about-stores.php?store_id='.$store_id.'store_name=' . $store_name . '&ban=' . $store_id . '""
                        name="ban"><button type="button" name="ban" class="btn btn-danger btn-sm">Ban Store
                            <i class="fas fa-warning"></i> </button></a>';
                        } else {
                            echo '<a
                            href="about-stores.php?store_id='.$store_id.'store_name=' . $store_name . '&activate=' . $store_id . '"
                            name="activate"><button type="button" name="activate"
                                class="btn btn-success btn-sm">Activate Store <i class="fa fa-check"></i> </button></a>';
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
                  </div>
                </div>
            </div>
          </div>

</div>



<?php require 'sidebar-footer.inc.php'; ?>