<?php require '../sqlconnect.php' ?>
<?php 

  session_start();

  $token = $_SESSION['token'];

 if(!isset($_SESSION['token'])){
    header("Location: ../login.php");
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
    $username = $results['username'];
    $image_name = $results['image_name'];
    $image_dir = $results['image_dir'];

    // echo $username;
    }

 }

?>
<?php 

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



<div class="jumbotron">

<h3 class="display-4 uk-text-left">Edit Profile</h3>
<img src="<?php echo $image_dir ?>" class="uk-border-rounded"  style="width: 190px; height: 100px">
<br>
<br>
<br>
<div class="">
    <?php
        echo $errors;
        echo $success;

?>
<form action="editprofile.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlFile1">Upload profile picture</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="dp"><br>
    <button class="btn btn-sm btn-primary" id="button" name="upload">Upload Image <i class="fa fa-spinner fa-spin"  style="display:none" id="spinner"></i></button>
  </div>
</form>
</div>

</div>
















<?php require 'sidebar-footer.inc.php' ?>