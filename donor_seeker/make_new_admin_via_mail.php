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
            if(mysqli_num_rows($query) == true) //false hole
            {
                 $error_msg['email1'] = "E-mail already exist.Please try another..";
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
          $expires = date("U") + 1800; //after 0.5 hour
          $url = "http://localhost/donor_seeker/make_new_admin_via_mail.inc.php?selector=" .$selector. "&validator=".bin2hex($token)."&expires=".$expires;
          


          $to = $userEmail;

          $subject = "New Admin Registation Form";

          $message = '<p>You are requested to fill up registation form (link given below) and serve as a admin at Donor Seeker. The link will disabled after 30 minute from Now!</p>';
          $message .= '<p>Here is admin registation form link: <br>';
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
              header("location:make_new_admin_via_mail.php?reset=success");
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
          <title>New admin make</title>
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
<div class="row">
    <?php
        if(isset($_SESSION['user']) && $_SESSION['role'] == "admin") { 
          ?>
          <div class="col-sm-3">
               <div class="card">
                <div class="card-header"><h5>Aministration Task</h5></div>
                 <div class="card-body"> <?php include('left_side_bar.php');?>
                 </div>
             </div>
         </div> <?php } ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h5 style="text-align: center;">New Admin Make by E-mail</h5></div>
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
                                    Send Mail
                                </button>
                                <?php 
                                  if(isset($_GET['reset']))
                                  {
                                    if($_GET['reset'] == "success")
                                    {
                                       echo "<div class='error'>Check e-mail..</div>";
                                       ?>
                                        <div class="error2" data-wrong="<?= $_GET['reset'];?>"> 
                                        </div>
                              <?php
                                    }
                                  }
                               ?>
                            </div>

                            <script src="sweetAlert/jquery-3.5.0.min.js"></script>
                                 <script src="sweetAlert/sweetalert2.all.min.js"></script>
                                 <script>
                                     const wrong = $('.error2').data('wrong')
                                         if(wrong){
                                            Swal.fire({
                                              position: 'top-end',
                                              icon: 'success',
                                              title: 'Check e-mail',
                                              showConfirmButton: false,
                                              timer: 4000
                                            })
                                         }
                                 </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['user']) && $_SESSION['role'] == "admin") { 
          ?>
          <div class="col-sm-3">
               <div class="card">
                <div class="card-header"><h5>Aministration Task</h5></div>
                 <div class="card-body"> <?php include('right_side_bar.php');?>
                 </div>
             </div>
         </div> <?php } ?>
    </div>
</body>
</html>