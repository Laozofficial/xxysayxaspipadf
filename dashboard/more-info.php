<?php


require '../sqlconnect.php';

session_start();

$token = $_SESSION['token'];

if (!isset($_SESSION['token'])) {
  header("Location: ../index.php");
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


$store_details = mysqli_query($connection, "SELECT * FROM stores WHERE store_owner_token = '$token'");
if (mysqli_num_rows($store_details)) {

  $store_results = mysqli_fetch_assoc($store_details);
  $store_id = $store_results['store_id'];
  $store_name = $store_results['store_name'];
  $store_category = $store_results['store_category'];
  $is_store_active = $store_results['store_active'];
  $store_logo = $store_results['store_logo'];
}


if (isset($_GET['orders_product_id'])) {

  $p_id = $_GET['orders_product_id'];

  $query = "SELECT * FROM products WHERE product_id = '$p_id'";
  $product_query = mysqli_query($connection, $sql);

  if (mysqli_num_rows($product_query) > 0) {

    $results = mysqli_fetch_assoc($product_query);

    $product =  $results['product_name'];
  }

  $sql = "SELECT * FROM orders WHERE order_id = '$p_id'";
  $order_query = mysqli_query($connection, $sql);

  if (mysqli_num_rows($order_query) > 0) {

    $results = mysqli_fetch_assoc($order_query);
    // echo 
    echo $results['order_name'];
  } else {
    header("Location: store-settings.php?order-errors= this item has not been ordered");
  }
}


if (isset($_GET['delete_product_id'])) {

  $p_id = $_GET['delete_product_id'];

  $sql = "DELETE FROM products WHERE product_id = '$p_id'";
  $order_query = mysqli_query($connection, $sql);

  if ($order_query) {
    header("Location: store-settings.php?success=product Deleted Successfully");
  } else {
    header("Location: store-settings.php?errors=something went wrong");
  }
}


?>
<?php

$errors = '';
$success = '';
if (isset($_REQUEST['save_item'])) {

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


    // $product_id = mt_rand(100000, 10000000);    
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
          $initial_query = "UPDATE products SET  
                              id = '',
                              product_image = '$filelocation',
                              price = '$product_price',
                              quantity = '$product_quantity',
                              color = '$product_color',
                              date_posted = NOW()
             
                            WHERE product_id = $p_id
                            ";
          $upload_query = mysqli_query($connection, $initial_query);
          if ($upload_query) {
            $success .= '<div class="alert alert-success" role="alert">
                                           Product Uploaded Successfully !<br><br>
                                          </div>';
            header("Location: store-settings.php?success=product Chnaged Successfully");
          } else {
            echo mysqli_error($connection);
          }
        } else {
          $errors .= '<div class="alert alert-danger" role="alert">
                                File too large !<br><br>
                              </div>';
          header("Location: store-settings.php?errors=file too large");
        }
      } else {
        $errors .= '<div class="alert alert-danger" role="alert">
                          There was an error uploading your file !<br><br>
                        </div>';
        header("Location: store-settings.php?errors=There was an error uploading your file");
      }
    } else {
      $errors .= '<div class="alert alert-danger" role="alert">
                                You cannot Upload this file !<br><br>
                              </div>' . mysqli_error($connection);
      header("Location: store-settings.php?errors=You cannot upload this file");
    }
  }
}







?>

<?php


if (isset($_GET['edit_product_id'])) {
  require 'sidebar.inc.php';

  $p_id = $_GET['edit_product_id'];

  $sql = "SELECT * FROM products WHERE product_id = '$p_id'";
  $order_query = mysqli_query($connection, $sql);

  if (mysqli_num_rows($order_query) > 0) {
    $is_results = mysqli_fetch_assoc($order_query);
    $p_name = $is_results['product_name'];
    $p_cat = $is_results['product_category'];
    $p_id = $is_results['product_id'];
    $p_image = $is_results['product_image'];
    $p_price = $is_results['price'];
    $p_rating = $is_results['rating'];
    $p_quantity = $is_results['quantity'];
    $p_color = $is_results['color'];
    $p_date_posted = $is_results['date_posted'];


    echo '
    <div class="uk-container uk-container-small">
     <div class="form-group">
            <label for="exampleFormControlFile1">Product Image</label>
            <input type="file" name="dp" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <form action="more-info.php" method="POST"  enctype="multipart/form-data">
        
        <img src="' . $p_image . '" class="uk-border-rounded">
        <div class="form-group">
        <label for="productname">Product Name</label>
        <input type="text" class="form-control" name="product_name" id="productname" aria-describedby="emailHelp" placeholder="Product Name" value="' . $p_name . '">
      </div>
      <div class="form-group">
        <label for="productprice">Product Price</label>
        <input type="number" class="form-control" name="product_price" id="productprice" aria-describedby="emailHelp" placeholder="Product Price" value="' . $p_price . '">
      </div>
      <div class="form-group">
        <label for="productquan">Product Quantity</label>
        <input type="number" class="form-control" name="product_quantity" id="productquan" aria-describedby="emailHelp" placeholder="Product Quantity Available" value="' . $p_quantity . '">
      </div>
      <div class="form-group">
        <label for="product_color">Product Color</label>
        <input type="color" class="form-control" name="product_color" id="product_color" placeholder="Product Color" value="' . $p_color . '">
      </div>
     
    <button type="submit" name="save_item" class="btn btn-primary">Save Item </button>
        </form>
    
    </div>


    ';
  }

  require 'sidebar-footer.inc.php';
}

?>

<?php  ?>