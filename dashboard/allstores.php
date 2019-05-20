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

 if(isset($_GET['store_id'])){
   $store_id = $_GET['store_id'];

   $the_query = mysqli_query($connection, "UPDATE `stores` SET `store_verify`= '../assets/images/verified.png'");
   if($the_query){
     $msg = '<div class="alert alert-success" role="alert">
              verification successful
            </div>';
   }else{
     $msg = '<div class="alert alert-danger" role="alert">
     Something went wrong ! '.mysqli_error($connection).'
   </div>';
   }
 }
require 'sidebar.inc.php';



?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">All Stores</h1>
  <?php
    // $store_check = mysqli_query($connection, "SELECT * FROM stores WHERE store_owner_token = '$token'");
    // if(mysqli_num_rows($store_check) >= 1 ) {
    //   $results = mysqli_fetch_assoc($store_check);
    //   $store_id = $results['store_id'];
      
    //   echo '<a href="store-settings.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> View Store</a>';
    // }else{
    //     echo '<a href="new-store.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Open Store</a>';
    // }
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
<!--  -->


</div>
<!-- /.container-fluid -->
<div class="uk-container uk-container-expand">
  
<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800  uk-text-uppercase">Open New Store</h1>
<p class="mb-4">Open a new store and start selling</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#additem"><i class="fas fa-fw fa-plus"></i> Add New store </button>
    <!-- <h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <div class="uk-container uk-caontainer-small">
           
    <h3 class="uk-text-center text-dark uk-text-bold">All Stores </h3>  
    
    <?php
      $sql = "SELECT * FROM stores";
      $query = mysqli_query($connection, $sql);

      if(mysqli_num_rows($query) > 0){
          echo '<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Store Name</th>
              <th>Store Owner Name</th>
              <th>Category</th>
              <th>status</th>
              <th>logo</th>
              <th>Description</th>
              <th>verification</th>
            </tr>
          </thead>';
          while($results = mysqli_fetch_assoc($query)){
            $id = $results['id'];
            $store_id = $results['store_id'];
            $store_name = $results['store_name'];
            $store_category = $results['store_category'];
            $is_store_active = $results['store_active'];
            $store_logo = $results['store_logo'];
            $store_owner = $results['store_owner'];
            $store_description = $results['store_description'];
            $store_verify = $results['store_verify'];
            $date_opened = $results['date_opened'];

            echo ' 
            <tbody>
              <tr>
                <td>'.$id.'</td>
                <td>'.$store_name.'</td>
                <td>'.$store_owner.'</td>
                <td>'.$store_category.'</td>
                <td>'.$is_store_active.'</td>
                <td><img src="'.$store_logo.'" class="uk-height-small uk-border-rounded"></td>
                <td>'.$store_description.'</td>
                <td>'.$store_verify.'</td>
                 <td><a href="about-stores.php?store_id='.$store_id.'"><i class="fa fa-eye fa-2x text-primary"></i></a> </td>
              </tr>
            </tbody>';
          }
          echo '</table>';
        }
        
    
    ?>
        </div>
      </div>
  </div>
</div>
</div>
</div>
<!-- End of Main Content -->





<?php  require 'sidebar-footer.inc.php'; ?>