<?php

require 'sqlconnect.php';
require 'nav.inc.php';

$errors = '';
if (isset($_REQUEST['reset'])) {
    $email = mysqli_real_escape_string($connection, $_REQUEST['email']);

    if (empty($email)) {
        $errors .= '<div class="alert alert-danger" role="alert">
                        Enter Email<br>
                    </div>';
    }
    if (!empty($email)) {
        $query = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($query) > 0) {
            $result = mysqli_fetch_assoc($query);
            $token = $result['token'];

            if ($result['email'] == $email) {
                require 'phpmailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;

                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Username = 'laozofficial@gmail.com';
                $mail->Password = 'L!M12345';

                $mail->setFrom($email);
                $mail->addAddress('livingintunes@gmail.com');
                $mail->addReplyTo($email);

                $mail->isHTML(true);
                $mail->Subject = 'Reset Password';
                $mail->Body = '<p>please click on this link to reset your password</p><br><a href="http://www.elitestores.com/reset-password?reset=' . $token . '">click here to reset password</a>';


                if (!$mail->send()) {
                    $errors .= '<div class="alert alert-danger" role="alert">
                                    no internet connection
                                </div>';
                } else {
                    $errors .= '<div class="alert alert-success" role="alert">
                                    Go to Your Email
                                </div>';
                }
                // echo 'true';
                // echo $token = $result['token'];
            }
        } else {
            $errors .= '<div class="alert alert-danger" role="alert">
                                    Your Email credentials is not in our database
                                </div>';
        }
    }
}
?>

<br><br>
<div class="uk-align-center">
    <div class="uk-container uk-container-small">
        <div class="uk-card uk-card-body uk-card-default">
            <form action="forget-password.php" method="POST">
                <?php echo $errors;  ?>
                <div class="form-group">
                    <label for="exampleInputEmail1" style="color: #2fdab8;">Enter Your Email</label>
                    <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted"><?php   ?></small>
                </div>
                <button name="reset" class="btn btn-block" style="background-color: #2fdab8; color: white">RESET
                    PASSWORD</button>
            </form>
        </div>
    </div>
</div>






<?php require 'footer.inc.php';  ?>