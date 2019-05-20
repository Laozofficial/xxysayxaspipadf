<?php

    require 'sqlconnect.php';

    $errors = '';
    $success = '';
    $first_name = '';
    $last_name = '';
    $email = '';


    if(isset($_REQUEST['signup'])){
        $first_name = mysqli_real_escape_string($connection, $_REQUEST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_REQUEST['last_name']);
        $email = mysqli_real_escape_string($connection, $_REQUEST['email']);
        $password = mysqli_real_escape_string($connection, $_REQUEST['password']);
        $cpassword = mysqli_real_escape_string($connection, $_REQUEST['cpassword']);

        if (empty($first_name)) {
            $errors .= '<div class="alert alert-danger" role="alert">
                            First Name field is empty
                        </div>' ;    
        }
        if(empty($last_name)) {
            $errors .= '<div class="alert alert-danger" role="alert">
                            Last Name field is empty
                        </div>';
        }
        if(empty($email)) {
            $errors .= '<div class="alert alert-danger" role="alert">
                            Email field is empty
                        </div>';
        }
        if (empty($password)) {
            $errors .= '<div class="alert alert-danger" role="alert">
                            Password field is empty
                        </div>';
        }
        if (empty($cpassword)) {
            $errors .= '<div class="alert alert-danger" role="alert">
                            Confirm password field is empty
                        </div>';
        }
        if ( $password != $cpassword) {
            $errors .= '<div class="alert alert-danger" role="alert">
                            Passwords does not match
                        </div>';
        }else{
            

        if (!empty($first_name) and !empty($last_name) and !empty($email) and !empty($password)) {
            $user_verify = mysqli_query($connection, "SELECT * FROM users where email = '$email'");
            if(mysqli_num_rows($user_verify) >= 1 ) {
                $errors .= '<div class="alert alert-danger" role="alert">
                            User with this email already exist
                        </div>';
            }else{
                $token = md5($email);
                $user_id = mt_rand(100, 10000);
                $hashpassword = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO users SET
                    id = '',
                    first_name = '$first_name',
                    last_name = '$last_name',
                    email = '$email',
                    password = '$hashpassword',
                    token = '$token',
                    user_id = '$user_id',
                    date_joined = NOW()
                
                ";

                if (mysqli_query($connection, $query)) {
                                                            
                    $success .= '<div class="alert alert-success" role="alert">
                        Registration successfully
                    </div>';
                    header("Location: login.php?usertaken=Registration successful , please login");
                } else {
                    $errors .= '<div class="alert alert-danger" role="alert">
                    Something went wrong , Please try again after some time
                </div>' . mysqli_error($connection, $query);
                }
            }
            if (!$connection) {
                echo $errors .= '<div class="alert alert-danger" role="alert">
                Something went wrong , Please try again after some time
            </div>' . mysqli_error($connection, $query);
            }
        }
        
    }
    }



?>
<?php require 'nav.inc.php' ?>
<br><br>
<!-- Modal2 -->

<div class="uk-container uk-container-small">
<div class="">
				<!-- Modal content-->
				<div class="uk-card uk-card-body uk-card-default">
						<div class="modal-body modal-body-sub_agile">
						<div class="col-md-8 ">
						<h3 class="agileinfo_sign">Sign Up <span>Now</span></h3>
						 <form action="signup.php" method="post">
                             <?php
                                echo $errors;
                                echo $success

                                    ?>
							<div class="styled-input agile-styled-input-top">
								<input type="text" name="first_name" required="" value="<?php echo $first_name ?>">
								<label>First Name</label>
								<span></span>
							</div>
							<div class="styled-input agile-styled-input-top">
								<input type="text" name="last_name" required="" value="<?php echo $last_name ?>">
								<label>Last Name</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="email" name="email" required="" value="<?php echo $email ?>"> 
								<label>Email</label>
								<span></span>
							</div> 
							<div class="styled-input">
								<input type="password" name="password" required=""> 
								<label>Password</label>
								<span></span>
							</div> 
							<div class="styled-input">
								<input type="password" name="cpassword" required=""> 
								<label>Confirm Password</label>
								<span></span>
							</div> 
							<input type="submit" name="signup" value="Sign Up">
                        <div class="clearfix"></div><br>
                        <p><a href="Terms.php">By clicking signup, I agree to your terms</a></p>
						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>




<?php require 'footer.inc.php' ?>