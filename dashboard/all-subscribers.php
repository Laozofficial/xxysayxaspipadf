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


?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  <?php
    $store_check = mysqli_query($connection, "SELECT * FROM stores WHERE store_owner_token = '$token'");
    if(mysqli_num_rows($store_check) >= 1 ) {
      $results = mysqli_fetch_assoc($store_check);
      $store_id = $results['store_id'];
      
      echo '<a href="store-settings.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> View Store</a>';
    }else{
        echo '<a href="new-store.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Open Store</a>';
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
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">WALLET</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
            <?php 
              // if ($count < 1 || $count == NULL ){
              //   echo '0';
              // }else{
              //   echo $count;
              // }
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
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Subscribed Customers</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
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
            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
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
<div class="containe">
<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800  uk-text-uppercase">Open New Store</h1>
<p class="mb-4">Open a new store and start selling</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#additem"><i class="fas fa-fw fa-plus"></i> Email All Subscribers </button>
      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#additem"><i class="fas fa-fw fa-cog"></i> Configure Email Settings </button>
    <!-- <h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <div class="uk-container uk-caontainer-small">
            <?php
                $sql = "SELECT * FROM subscribers WHERE store_id = '$store_id '";
                $query = mysqli_query($connection, $sql);

                if (mysqli_num_rows($query) > 0) {
                    echo '<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Subscriber Name</th>
                        <th>Email</th>
                        <th>Action</th> 
                     </tr>
                    </thead>';
                    while($data = mysqli_fetch_assoc($query)){
                        $id = $data['id'];
                        $name = $data['subscriber_name'];
                        $email = $data['subscriber_email'];

                        echo '
                        <tbody>
                        <tr>
                            <td></td>
                          <td>'.$name.'</td>
                          <td>'.$email.'</td>
                          <td><button class="btn btn-primary"><i class="fa fa-envelope"></i> Email Subscriber</button> </td>
                        </tr>
                        </tbody>';
                    }
                    echo '   </table>';
                }else{
                    
                }
                

            ?>
        </div>
      </div>
  </div>
</div>

</div>
</div>
<!-- End of Main Content -->




<!-- all-subscribers.php -->
<?php require 'sidebar-footer.inc.php' ?>