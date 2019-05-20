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


  $errors = '';
  $success = '';

  if(isset($_REQUEST['upload'])){

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
      $initial_query = "UPDATE users SET  
                  image_name= '$fileNameNew',
                  image_dir = '$filelocation'

                  WHERE token='$token' 
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



?>

<?php require 'sidebar.inc.php' ?>

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
        <div class="container">
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
                  <div class="uk-container uk-caontainer-small">
                          
                  </div>
                </div>
            </div>
          </div>

</div>
      </div>
      <!-- End of Main Content -->



      <!-- Add item to store modal -->
      <div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="GET">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
     <?php require 'sidebar-footer.inc.php' ?>