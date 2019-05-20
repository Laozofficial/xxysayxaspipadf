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
            <h1 class="h3 mb-0 text-gray-800">Edit <?php echo $store_name ?></h1>
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


        
        </div>
        <!-- /.container-fluid -->
        <div class="container">
 <!-- Page Heading -->
 <!-- <h1 class="h3 mb-2 text-gray-800  uk-text-uppercase">Open New Store</h1>
          <p class="mb-4">Open a new store and start selling</p> -->
<?php
if (isset($_GET['store_id'])) {
    $is_store_id = $_GET['store_id'];

    $sql = "SELECT * FROM stores WHERE store_id = '$is_store_id'";
    $query = mysqli_query($connection, $sql);
     
    if (mysqli_num_rows($query) >= 1) {
        $is_results = mysqli_fetch_assoc($query);

        $is_store_name = $is_results['store_name'];
         $is_description = $is_results['store_description'];
         $is_cat = $is_results['store_category'];
    }
}




$storename_errors = '';
$category_errors = '';
$description_error = '';
if(isset($_REQUEST['update-store'])){

      $store_name = mysqli_real_escape_string($connection, $_REQUEST['store_name']);
      $category = mysqli_real_escape_string($connection, $_REQUEST['category']);
      $description = mysqli_real_escape_string($connection, $_REQUEST['description']);

      if(empty($store_name)){
          $storename_errors .= '
                                    <i class="fa fa-warning"></i><span class="text-danger">Store name field is empty</span>
                                ';
      }
      if(empty($category)){   
          $category_errors .= '
                                    <i class="fas fa-warning"></i><span class="text-danger">Select a category !</span>
                              ';
      }
      if(empty($description)){
        $description_error .= '
                                  <i class="fas fa-warning"></i><span class="text-danger">Select a category !</span>
                            ';
    }
      if (!empty($store_name) and !empty($category)) {
        $store_name_verify = mysqli_query($connection, "SELECT * FROM stores where store_name = '$store_name'");
        if(mysqli_num_rows($store_name_verify) >= 1 ) {
            $errors .= '<div class="alert alert-danger" role="alert">
                        A Store with this name already exist
                    </div>';
        }else{
            if(!empty($store_name) and !empty($category)){
           

              

            $query = "UPDATE stores SET
            store_name = '$store_name',
            store_category = '$category',
            store_description = '$description'

            WHERE store_id = '$is_store_id'
            ";

        if (mysqli_query($connection, $query)) {
                            
            $success .= '<div class="alert alert-success" role="alert">
                Store Created Successfuly
            </div>';
            header("Location: store-branding.php");
        } else {
            $errors .= '<div class="alert alert-danger" role="alert">
                something went wrong! <br>please try again after some time
            </div>' . mysqli_error($connection);
        }
      
    }
    
 }
    }if (!$connection) {
          echo $errors .= '<div class="alert alert-danger" role="alert">
                  something went wrong! <br>please try again after some time
              </div>' . mysqli_error($connection);
      }
   
}



?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#additem"><i class="fas fa-fw fa-plus"></i> Add New item to your store </button> -->
              <!-- <h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6> -->
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div class="uk-container uk-caontainer-small">
                        <form action="" method="post">
                            <?php

                              echo $storename_errors ;
                              echo $category_errors ;
                              echo $description_error;   

                              ?>
                        <div class="form-group">
                            <label for="storename"> Store Name </label>
                            <input type="text" class="form-control" name="store_name" id="storename" aria-describedby="emailHelp" placeholder="store name" value="<?php echo $is_store_name ?>">
                            <?php echo $storename_errors;  ?>
                        </div>
                        <div class="form-group">
                            <label for="description">Store Description</label>
                            <textarea class="form-control" name="description" id="description" rows="5" max="100"><?php echo  $is_description?></textarea>
                        </div>
                        <?php  
                        $sql = "SELECT store_category_name FROM store_categories ";
                        $results_query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($results_query) > 0) {
                                    echo ' <div class="form-group">
                                    <label >Category</label>
                                    <select class="uk-select" name="category">
                                    <option selected value="'.$is_cat.'">'.$is_cat.'</option>';
                                while($results = mysqli_fetch_array($results_query)) {
                                        $data = $results['store_category_name'];
                                echo '<option value="'.$data.'">'.$data.'</option>   ';
                                }
                                echo ' </select>
                                </div>';
                            }
                        ?> 
                             <button type="submit" name="update-store" class="btn btn-primary">Update Store</button>
                        </form> 
                </div>
                </div>
            </div>
          </div>

</div>
      </div>
      <!-- End of Main Content -->

     <?php require 'sidebar-footer.inc.php' ?>