<?php
    use PHPMailer\PHPMailer\PHPMailer;
    include("connection.php");
    include("header.php");
     if($_POST)
    {
        $userEmail = $_POST['email'];
        $error_msg = array();
        $sql = "SELECT * from donor_infos where E_mail = '$userEmail'";
        $query = mysqli_query($connection,$sql);
       
        if($query)
        {
            if(mysqli_num_rows($query) == false) //false hole
            {
                 $error_msg['email1'] = "E-mail  doesn't exist.Please try again.";
            }
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
         {
          $error_msg['email2'] = "E-mail Address is Required.";
         }
        if(count($error_msg) == 0)
        {
          //Mail send check your mail
          //header("location:reset_password.php?email=$email");
          $selector = bin2hex(random_bytes(8));
          $token = random_bytes(32);
          $url = "http://localhost/donor_seeker/reset_password.inc.php?selector=" .$selector. "&validator=".bin2hex($token);
          $expires = date("U") + 1800; //after 0.5 hour
          $hashedToken = password_hash($token, PASSWORD_DEFAULT);


          $sql = mysqli_query($connection , "DELETE FROM reset_paasword WHERE request_mail = '$userEmail'");
          if(!$sql)
          {
            echo "There was an error.";
            exit();
          }
          else
          {
              //////
          }
          $query = mysqli_query($connection , "INSERT INTO `reset_paasword`(`request_mail`, `selector`, `token`, `reset_expire`) VALUES ('$userEmail' , '$selector' , '$hashedToken' , '$expires');");
          if(!$query)
          {
            echo "There was an error.";
          }


          $to = $userEmail;

          $subject = "Reset your password";

          $message = '<p>We recieved a password reset request. The link to reset your password make this request, you can ignore this email</p>';
          $message .= '<p>Here is your password reset link: <br>';
          $message .= '<a href=" '.$url.' ">' .$url. '</a></p>';


          $header = "Donor Seeker";

          /* This actual msg */

          require_once "PHPMailer/PHPMailer.php";
          require_once "PHPMailer/SMTP.php";
          require_once "PHPMailer/Exception.php";

          $mail = new PHPMailer();

          //SMTP Settings
          $mail->isSMTP();
          $mail->Host = "smtp.gmail.com";
          $mail->SMTPAuth = true;
          $mail->Username = "donor.seeker.all@gmail.com";// sender
          $mail->Password = 'Mf@073952';
          $mail->Port = 465; //587
          $mail->SMTPSecure = "ssl"; //tls

          //Email Settings
          $mail->isHTML(true);
          $mail->setFrom($to, $header);
          $mail->addAddress($to); // receiver
          $mail->Subject = $subject;
          $mail->Body = $message;

          if ($mail->send()) {
              $status = "success";
              $response = "Email is sent!";
              //echo $status;
              header("location:reset_password.php?reset=success");
          } else {
              $status = "failed";
              //$response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
              echo $status;
          }

        }
    }
?>

<!DOCTYPE html>
<html>
<head>
          <title>Login</title>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
          <style type="text/css">
              .error{
                color: #cc0000;
                padding-top: 5px;
                float: left;
                width: 100%;
                font-style: bold;
              }
          </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Password Recovery</div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address:</label>
                            <! E-mail >
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus placeholder="Enter Your E-mail Address">
                                <p> 
                                <?php
                                    if(isset($error_msg['email1'])) 
                                        echo "<div class='error'>" . $error_msg['email1']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['email2'])) 
                                        echo "<div class='error'>" . $error_msg['email2']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>
                         
                        <! Log In >
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Recover New Password
                                </button>
                                <?php 
                                  if(isset($_GET['reset']))
                                  {
                                    if($_GET['reset'] == "success")
                                    {
                                       echo "<div class='error'>Check your e-mail..</div>";
                                    }
                                  }
                               ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>