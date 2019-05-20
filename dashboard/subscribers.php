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
 <!-- Page Heading -->
 <h1 class="h3 mb-2 text-gray-800">Subscribers</h1>
          <p class="mb-4">This is a list of all the Subscribers</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Subscribers Database</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                <?php 
                        $sql = "SELECT * FROM subscribers";
                        $subscribers_query = mysqli_query($connection, $sql);
                        
                            if (mysqli_num_rows($subscribers_query) > 0) {
                                    echo '<table class="table table-bordered table-dark table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                      </tr>
                                    </thead>';
                                while($results = mysqli_fetch_assoc($subscribers_query)) {
                                    $id = $results['id'];
                                    $email = $results['email'];
                                    $date = $results['date_sent'];



                                echo '
                                <tbody>
                                <tr>
                                  <td>'.$results['id'].'</td>
                                  <td>'.$results['email'].'</td>
                                  <td>'.$results['date_sent'].'</td>
                                </tr>
                                </tbody>

                             
                                ';
                                }
                                echo '   </table>';
                            }else{
                                echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <tr>
                                  <td>no Results</td>
                                  <td>no Results</td>
                                  <td>no Results</td>
                                </tr>
                                </tbody>

                                </table>
                                ';
                            }

                    ?>

                </div>
            </div>
          </div>




<?php require 'sidebar-footer.inc.php' ?>