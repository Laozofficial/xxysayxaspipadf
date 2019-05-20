<?php require '../sqlconnect.php' ?>
<?php 


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
 
//   session_start();

//   $token = $_SESSION['token'];

//  if(!isset($_SESSION['token'])){
//     header("Location: ../login.php");
//     exit();
//  }else{

//   $all_details = mysqli_query($connection, "SELECT * FROM users WHERE token = '$token'");

//   if(mysqli_num_rows($all_details)){

//     $results = mysqli_fetch_assoc($all_details);
//     $id = $results['id'];
//     $token = $results['token'];
//     $email = $results['email'];
//     $first_name = $results['first_name'];
//     $is_admin = $results['is_admin'];
//     $last_name = $results['last_name'];
//     $username = $results['username'];
//     $image_name = $results['image_name'];
//     $image_dir = $results['image_dir'];

//     // echo $username;
//     }

//  }

?>
<!DOCTYPE html>
<html lang="en">  

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $first_name.' '.$last_name ?> Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/uikit.css" rel="stylesheet">
  <link href="css/uikit.min.css" rel="stylesheet">
<style>
  input{
    border-radius: 0 !important;
  }
</style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
        <div class="sidebar-brand-icon rotate-n-15">
        <i class="fa fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Elite Stores </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>


      <!-- Nav Item - Pages Collapse Menu -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="profile.php" >
          <i class="fas fa-fw fa-cog"></i>
          <span>Profile</span>
        </a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="checkout.php" >
          <i class="fas fa-fw fa-cart-arrow-down"></i>
          <span>Check Out</span>
        </a>
</li>
        <?php
        $store_check = mysqli_query($connection, "SELECT * FROM stores WHERE store_owner_token = '$token'");
        if(mysqli_num_rows($store_check) >= 1 ) {
          $results = mysqli_fetch_assoc($store_check);
          $store_id = $results['store_id'];
          
          echo '<li class="nav-item">
                  <a class="nav-link collapsed" href="store-branding.php" >
                    <i class="fa fa-store"></i>
                    <span>Store Profile</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link collapsed" href="store-settings.php" >
                    <i class="fa fa-store"></i>
                    <span>View Store</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link collapsed" href="editprofile.php">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Edit Profile</span>
                  </a>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                  <a class="nav-link" href="settings.php">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Settings</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                  <a class="nav-link" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Logout</span></a>
                </li>
                          ';
        }

            if($is_admin > 0){
                echo '
      <hr class="sidebar-divider"><li class="nav-item">
                        <a class="nav-link collapsed" href="allstores.php" >
                          <i class="fas fa-fw fa-key"></i>
                          <span>stores</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link collapsed" href="allusers.php" >
                          <i class="fas fa-fw fa-key"></i>
                          <span>All Users</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link collapsed" href="allcontact.php" >
                          <i class="fas fa-fw fa-key"></i>
                          <span>Contacts Us - messages</span>
                        </a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link collapsed" href="subscribers.php" >
                        <i class="fas fa-fw fa-key"></i>
                        <span>Subscribers</span>
                      </a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link collapsed" href="allorders.php" >
                          <i class="fas fa-fw fa-key"></i>
                          <span>orders</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link collapsed" href="allmessages.php" >
                          <i class="fas fa-fw fa-key"></i>
                          <span>store messages</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link collapsed" href="allcontacts.php" >
                          <i class="fas fa-fw fa-key"></i>
                          <span>Contac Us- messages</span>
                        </a>
                      </li>
                      ';
            }


        ?>

     
      <!-- Divider -->



      <!-- Nav Item - Pages Collapse Menu -->
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
         

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $first_name.' '.$last_name ?></span>
                <img class="img-profile rounded-circle" src="<?php echo $image_dir ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->