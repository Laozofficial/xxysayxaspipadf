<?php 

  require '../sqlconnect.php';
  
  session_start();

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


  $errors = '';
  $success = '';

  $product_name = '';
  $product_color = '';
  $product_price = '';
  $product_quantity = '';

  $errors = '';
  $success = '';

  if(isset($_REQUEST['post'])){

    $file = $_FILES['dp'];
    $file_name = $_FILES['dp']['name'];
    $file_Tmp_Name = $_FILES['dp']['tmp_name'];
    $file_size = $_FILES['dp']['size'];
    $file_error = $_FILES['dp']['error'];
    $file_type = $_FILES['dp']['type'];

    $fileExt = explode('.', $file_name);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg','jpeg','png');

    if (in_array($fileActualExt, $allowed)) {
          if ($file_error === 0) {
              if ($file_size < 100000000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $filelocation = 'uploads/'.$fileNameNew;
                move_uploaded_file($file_Tmp_Name, $filelocation);
                // echo "upload success";
      $initial_query = "UPDATE stores SET  
                  
                  store_logo = '$filelocation'

                  WHERE store_id = '$store_id'

                  ";
                $upload_query = mysqli_query($connection, $initial_query);
                if($upload_query){
                  $success .= '<div class="alert alert-success" role="alert">
                               File Uploaded Successfully !<br><br>
                              </div>';
                              // header("Location: dashboard:index.php");            
                }
                
                else{
                  echo mysqli_error($connection);
                }
              }else{
                    $errors .= '<div class="alert alert-danger" role="alert">
                    File too large !<br><br>
                  </div>';
              }
          }else{
            $errors .= '<div class="alert alert-danger" role="alert">
              There was an error uploading your file !<br><br>
            </div>';
          }
    }else{
      $errors .= '<div class="alert alert-danger" role="alert">
                    You cannot Upload this file !<br><br>
                  </div>';
    }




  }

  if(isset($_REQUEST['save_item'])){

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
            if(mysqli_num_rows($product_verify) >= 1 ) {
                $errors .= '<div class="alert alert-danger" role="alert">
                            Product with this name already exist
                        </div>';
            }else{

                $product_id = mt_rand(100000, 10000000);    
                $file = $_FILES['dp'];
                $file_name = $_FILES['dp']['name'];
                $file_Tmp_Name = $_FILES['dp']['tmp_name'];
                $file_size = $_FILES['dp']['size'];
                $file_error = $_FILES['dp']['error'];
                $file_type = $_FILES['dp']['type'];

               
            
                $fileExt = explode('.', $file_name);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg','jpeg','png');
            
                if (in_array($fileActualExt, $allowed)) {
                      if ($file_error === 0) {
                          if ($file_size < 100000000000) {
                            $fileNameNew = uniqid('', true).".".$fileActualExt;
                            $filelocation = 'uploads/'.$fileNameNew;
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
                            if($upload_query){
                              $success .= '<div class="alert alert-success" role="alert">
                                           Product Uploaded Successfully !
                                          </div>';
                                          // header("Location: dashboard:index.php");            
                            }
                            
                            else{
                              echo mysqli_error($connection);
                            }
                          }else{
                                $errors .= '<div class="alert alert-danger" role="alert">
                                File too large !<br><br>
                              </div>';
                          }
                      }else{
                        $errors .= '<div class="alert alert-danger" role="alert">
                          There was an error uploading your file !<br><br>
                        </div>';
                      }
                }else{
                  $errors .= '<div class="alert alert-danger" role="alert">
                                You cannot Upload this file !<br><br>
                              </div>' .mysqli_error($connection);
                }
            
            }
    }
 



  }



?>

<?php require 'sidebar.inc.php' ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
    <?php
    if ($store_logo == '') {
        echo '<div class="alert alert-warning" role="alert">
                         Upload store Logo and Attach a desciption for your store to be fully active and available for users to visit<br><br>
                         <a href="store-branding.php" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> Brand Your Store</a>
                     </div>';
    }
    ?>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
            <h1 class="h3 mb-0 text-gray-800">Store Settings</h1>
            <?php
              $store_check = mysqli_query($connection, "SELECT * FROM stores WHERE store_owner_token = '$token'");
              if(mysqli_num_rows($store_check) >= 1 ) {
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


        
        </div>
        <!-- /.container-fluid -->
        <div class="containe">
 <!-- Page Heading -->
 <!-- <h1 class="h3 mb-2 text-gray-800  uk-text-uppercase">Open New Store</h1>
          <p class="mb-4">Open a new store and start selling</p> -->

          <!-- DataTales Example -->
          <div class="card shadow uk-box-shadow-xlarge mb-5">
            <div class="card-header py-3">
                <!-- <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#additem"><i class="fas fa-fw fa-plus"></i> Add New items to your store </button> -->
              <!-- <h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6> -->
            </div>
            <div class="card-body ">
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
                        echo $errors;
                        echo $success;
                      ?>
                      
                        <br>
                        
                        <h2 class="uk-text-center uk-text-bold text-muted uk-text-uppercase" style="margin:0">Store Details <a href="edit-store.php?store_id=<?php  echo $store_id ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Store </a> </h2><br>
                        <div class="uk-grid-small uk-child-width-expand@s uk-text-center uk-grid-match" uk-grid>
                            <div>
                                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-xlarge">
                                     <!-- <h2 class="uk-text-center uk-text-bold text-muted" style="margin:0">Store Name</h2> -->
                                    <p class="uk-text-left uk-text-uppercase uk-text-bold"><?php echo $store_name.' '.$store_verify ?> </p>
                                    <p class="uk-text-left uk-text-uppercase" style="font-size:10px;">owned by: <a href="view-profile?user_token=<?php echo $token ?>"><?php echo $first_name.' '.$last_name ?></a></p>
                                    <hr>
                                    <h3 class="uk-text-left uk-text-bold text-muted uk-text-uppercase" style="font-size: 17px;margin:0">Store Status <?php
                                        if ($is_store_active == 'active') {
                                            echo '<span class="uk-text-left badge badge-success">Active</span>';
                                        }else{
                                            echo '<span class="badge badge-danger">Banned</span>';
                                        }
                                    ?> </h3>
                                    <hr>
                                    <a href="all-subscribers.php"><h3 class="uk-text-left uk-text-bold text-muted uk-text-uppercase" style="font-size: 17px;margin:0"> Subscribers  <?php
                                        $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `subscribers` WHERE store_id = '$store_id'");
                                        $row = mysqli_fetch_assoc($result);
                                        $count = $row['count'];
                                        ?>
                                           <span class="badge badge-secondary"><?php echo $count  ?></span>
                                        
                                    </h3></a>
                                    <?php
                                    $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `products` WHERE store_id = '$store_id'");
                                    $row = mysqli_fetch_assoc($result);
                                    $count = $row['count'];
                                    ?>
                                     <hr>
                                     <h3 class="uk-text-left uk-text-bold text-muted uk-text-uppercase" style="font-size: 17px;margin:0"> Items in Store  <span class="uk-text-left badge badge-secondary"><?php echo $count ?> </span></h3>
                                    
                                     <?php
                                      $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `orders` WHERE store_id = '$store_id'");
                                      $row = mysqli_fetch_assoc($result);
                                      $count = $row['count'];
                                    ?>
                                     <hr>
                                     <h3 class="uk-text-left uk-text-bold text-muted uk-text-uppercase" style="font-size: 17px;margin:0"> Order Placed  <span class="uk-text-left badge badge-secondary"><?php echo $count ?> </span></h3>

                                     <?php
                                    // $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `delivered` WHERE store_id = '$store_id'");
                                    // $row = mysqli_fetch_assoc($result);
                                    // $count = $row['count'];
                                    ?>
                                     <!-- <hr>
                                     <h3 class="uk-text-left uk-text-bold text-muted uk-text-uppercase" style="font-size: 17px;margin:0"> Items Delivered  <span class="uk-text-left badge badge-secondary"><?php echo $count ?> </span></h3> -->
                                </div>
                            </div>
                            <br>
                            <div>
                                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-xlarge">
                                <h3 class="uk-text-center uk-text-bold text-muted uk-text-uppercase" style="font-size: 17px;margin:0">Logo</h3>
                                <img src="<?php echo $store_logo ?>" class="uk-boreder-rounded">
                        <form action="store-branding.php" method="POST"  enctype="multipart/form-data">
                            <div class="form-group">
                                <!-- <label for="exampleFormControlFile1">Change Store Logo</label> -->
                                <input type="file" name="dp" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <button class="btn btn-primary" name="post"><i class="fa fa-upload"></i> Upload Store Logo</button>
                        </form>
                                </div>
                            </div><br><br>
                            <div>
                                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-xlarge">
                                    <h3 class="uk-text-left uk-text-bold uk-text-muted uk-text-uppercase" style="font-size: 17px;">Store Category</h3>
                                    <p class="uk-text-left uk-text-bold uk-text-muted"  style="font-size: 13px;">This Store specializes on <span class="text-primary"><?php echo $store_category ?></span> sales</p>
                                    <hr>
                                    <h3 class="uk-text-left uk-text-bold uk-text-muted uk-text-uppercase" style="font-size: 17px;">Store Description</h3>
                                    <p class="uk-text-left uk-text-bold uk-text-muted"  style="font-size: 13px;"><?php echo $store_description ?></p>
                                    <hr>
                                </div>
                                
                            </div>
                        </div>
                     
                      
                    </div>
                  </div>
                </div>
               
            </div> 
          </div>
<!-- 
</div>
      </div> -->
      <!-- End of Main Content -->




     <?php require 'sidebar-footer.inc.php' ?>