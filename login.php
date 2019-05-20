<?php

session_start();

 require 'sqlconnect.php';

 $errors = '';
 $success = '';
 $login = '';

 if(isset($_GET['usertaken'])){
     $login .= '<div class="alert alert-success" role="alert">
                    '.$_GET['usertaken'].'<br>
                </div>';
 }
 
 $email = '';
 $password = '';
if (isset($_REQUEST['login'])) {
    $email = mysqli_real_escape_string($connection, $_REQUEST['email']);
    $password = mysqli_real_escape_string($connection, $_REQUEST['password']);

    if (empty($email)) {
        $errors .= '<div class="alert alert-danger" role="alert">
                        Email field is empty.
                    </div>';
    }
    if (empty($password)) {
        $errors .= '<div class="alert alert-danger" role="alert">
                        password field is empty.
                    </div>';
    }

    if (!empty($email) and !empty($password)) {
        $confirm_user = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");

        if(mysqli_num_rows($confirm_user) >= 1){
            $results = mysqli_fetch_assoc($confirm_user);
            $verify_password = password_verify($password , $results['password']);
                if( $verify_password == false ){
                     $errors .= '<div class="alert alert-danger" role="alert">
                     Incorrect passwsord.<br>
                 </div>'  ; 
                }elseif( $verify_password == true ){
                    $_SESSION['token'] = $results['token'];
                    header("Location: dashboard/index.php");
                }
                
    }else{
        $errors .= '<div class="alert alert-danger" role="alert">
                        Login credentials doesn\'nt exist is our database.<br>
                    </div>';
    }
}
}
// else{
//     $errors .= '<div class="alert alert-danger" role="alert">
//                         Something is wrong<br>
//                     </div>';
// }

?>
<?php require 'nav.inc.php' ?>
<br><br><br><br>
<div >
<div class="uk-container">

			<div class="uk-card uk-card-body uk-card-default">
				<!-- Modal content-->
                <!-- <div class="col-md-4 logo_agile uk-align-center">
				<h1><a href="index.html"><span>E</span>lite Shoppy <i class="fa fa-shopping-bag top_logo_agile_bag" aria-hidden="true"></i></a></h1>
			</div> -->
				<div>
						<div class="modal-body modal-body-sub_agile">
						<div class="col-md-9 modal_body_left modal_body_left1">
						<h3 class="agileinfo_sign uk-text-center">Sign In <span>Now</span></h3>
									<form action="login.php" method="post">
                                    <?php
                                        echo $errors;
                                        echo $success;
                                        echo $login;
                                    ?>
							<div class="styled-input agile-styled-input-top">
								<input type="email" name="email" required="">
								<label>Email</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="password" name="password" required=""> 
								<label>Password</label>
								<span></span>
							</div> 
                            <br><br>
							<input type="submit" name="login" value="Sign In">
						</form>
                    <div class="clearfix"></div>
                    <p><a href="signup.php" > Don't have an account?</a></p>
                    <p><a href="forget-password.php" > Forget password?</a></p>
        <!-- <div class="clearfix"></div> -->
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>
</div>
</div>
<br><br><br><br><br><br><br><br>




<?php require 'footer.inc.php' ?>