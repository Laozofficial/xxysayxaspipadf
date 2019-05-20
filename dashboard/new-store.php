<?php require '../sqlconnect.php';

session_start();

$token = $_SESSION['token'];

if (!isset($_SESSION['token'])) {
  header("Location: ../login.php");
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



$errors = '';
$success = '';

if (isset($_REQUEST['post'])) {

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
        //   $initial_query = "UPDATE blog SET  

        //               image_dir = '$filelocation'

        //               ";
        //             $upload_query = mysqli_query($connection, $initial_query);
        //             if($upload_query){
        //               $success .= '<div class="alert alert-success" role="alert">
        //                            File Uploaded Successfully !<br><br>
        //                           </div>';
        //                           // header("Location: dashboard:index.php");            
        //             }

        //             else{
        //               echo mysqli_error($connection);
        //             }
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
                  </div>';
  }
}

$storename_errors = '';
$category_errors = '';
if (isset($_REQUEST['create-store'])) {

  $store_name = mysqli_real_escape_string($connection, $_REQUEST['store_name']);
  $category = mysqli_real_escape_string($connection, $_REQUEST['category']);

  if (empty($store_name)) {
    $storename_errors .= '
                                      <i class="fa fa-warning"></i><span class="text-danger">Store name field is empty</span>
                                  ';
  }
  if (empty($category)) {
    $category_errors .= '
                                      <i class="fas fa-warning"></i><span class="text-danger">Select a category !</span>
                                ';
  }
  if (!empty($store_name) and !empty($category)) {
    $store_name_verify = mysqli_query($connection, "SELECT * FROM stores where store_name = '$store_name'");
    if (mysqli_num_rows($store_name_verify) >= 1) {
      $errors .= '<div class="alert alert-danger" role="alert">
                          A Store with this name already exist
                      </div>';
    } else {
      if (!empty($store_name) and !empty($category)) {
        $store_id = mt_rand(1000, 100000);
        $store_id_verify = mysqli_query($connection, "SELECT * FROM stores where store_id = '$store_id'");
        if (mysqli_num_rows($store_id_verify) >= 1) {
          $store_id = mt_rand(100000, 10000000);
        } else {

          $query = "INSERT INTO `stores`(`id`, `store_name`, `store_category`, `store_owner`, `store_id`, `store_owner_token`, `store_active`, `store_logo`, `store_verify`, `store_description`, `date_opened`) VALUES ('', '$store_name', '$category', '$first_name $last_name'  ,'$store_id', '$token', 'active' , '', '', '', NOW() )";

          if (mysqli_query($connection, $query)) {

            $success .= '<div class="alert alert-success" role="alert">
                  Store Created Successfuly
              </div>';
            header("Location: index.php");
          } else {
            $errors .= '<div class="alert alert-danger" role="alert">
                  something went wrong! <br>please try again after some time
              </div>' . mysqli_error($connection);
          }
        }
      }
    }
  }
  if (!$connection) {
    echo $errors .= '<div class="alert alert-danger" role="alert">
                    something went wrong! <br>please try again after some time
                </div>' . mysqli_error($connection);
  }
}



?>
<?php require 'sidebar.inc.php' ?>
<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800  uk-text-uppercase">Open New Store</h1>
    <p class="mb-4">Open a new store and start selling</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-fw fa-plus"></i> Add New Posts </button> -->
            <!-- <h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="h3 mb-2 text-gray-800 uk-text-center uk-text-uppercase">Fill the following information</h1>
                <div class="uk-container uk-caontainer-small">
                    <form action="new-store.php" method="POST">
                        <?php
            echo $errors;
            echo $success;
            ?>
                        <div class="form-group">
                            <label for="storename">Store Name</label>
                            <?php echo  $storename_errors; ?>
                            <input type="text" class="form-control" id="storename" name="store_name"
                                aria-describedby="emailHelp" placeholder="Store Name">
                            <small id="emailHelp" class="form-text text-primary">This is your store name and it should
                                be unique</small>
                        </div>

                        <?php
            $sql = "SELECT store_category_name FROM store_categories ";
            $results_query = mysqli_query($connection, $sql);

            if (mysqli_num_rows($results_query) > 0) {
              echo ' <div class="form-group">
                                    <label >Category</label>
                                             ' . $category_errors . '
                                    <select class="uk-select" name="category">
                                    <option selected value="">Choose...</option>';
              while ($results = mysqli_fetch_array($results_query)) {
                $data = $results['store_category_name'];
                echo   '<option  value="' . $data . '">' . $data . '</option>   ';
              }
              echo ' </select>
                                </div>';
            }
            ?>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Terms and condition <a href="../terms.php"><i class="fa fa-link"></i></a>
                            </label>
                        </div>

                        <br>
                        <button class="btn btn-primary " name="create-store">Create store</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<?php require 'sidebar-footer.inc.php' ?>