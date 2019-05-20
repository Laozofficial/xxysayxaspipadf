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
    $usernam = $results['username'];
    $image_name = $results['image_name'];
    $image_dir = $results['image_dir'];

    // echo $username;
    }

 }

?>

<?php require 'sidebar.inc.php' ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Personal Profile</h1>
    <div class="jumbotron">
       <img src="<?php echo $image_dir ?>" style="width: 200px; height: 200px; margin-right: 30px;" class="uk-border-rounded">
      <h1 class="uk-h4 uk-text-uppercase"><?php echo $first_name.' '.$last_name ?></h1>
      <p class="lead"><span class="uk-h5">Username : </span><?php echo '@'.$usernam ?></p>

      <p class="lead"><span class="uk-h5">Email : </span><?php echo $email ?></p>
      <hr class="my-4">
      <a class="btn btn-primary btn-lg" href="editprofile.php" role="button">Edit Profile <i class="fa fa-edit"></i></a>
    </div>

    <?php
       $artisans_details = mysqli_query($connection, "SELECT * FROM artisans WHERE token = '$token'");

       if(mysqli_num_rows($artisans_details)){
     
         $results = mysqli_fetch_assoc($artisans_details);
         $id = $results['id'];
         $first_name = $results['first_name'];
         $last_name = $results['last_name'];
         $email = $results['email'];
         $status = $results['status'];
         $age = $results['age'];
         $phone_no = $results['phone_number'];
         $image = $results['image_dir'];
         $pay_type = $results['pay_type'];
         $job_title = $results['job_title'];
         $company = $results['company'];
         $job_type = $results['job_type'];
         $location = $results['location'];
         $date = $results['date_applied'];
         // echo $username;
         }

         if(mysqli_fetch_assoc($artisans_details) < 1){

          echo '<div class="alert alert-dark" role="alert">
          Not an Artisan Yet!

          <br>
          <a href="new-post.php" class="btn btn-success">Register</a>
        </div>';
         }else{
           echo '<div class="alert alert-dark" role="alert">
           <a href="artisans.php" class="btn btn-success">Check your artisans profile</a>
         </div>';
         }

?>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->




      


<?php require 'sidebar-footer.inc.php' ?>