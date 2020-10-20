<?php
  use PHPMailer\PHPMailer\PHPMailer;
  include("connection.php");
  include("header.php");
  if($_POST)
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $error_msg = array();
       if(empty($_POST['name']))
        {
         $error_msg['name1'] = "Your Name is Required.";
        }
        if(!preg_match("/^[a-zA-Z\s]*$/", $name)) 
        {
         $error_msg['name2'] = "Only letters and white space allowed";
        }
        if(empty($_POST['subject']))
        {
         $error_msg['subject1'] = "Subject is Required.";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
         $error_msg['email1'] = "E-mail Address is Required.";
        }
        if(empty($_POST['message']))
        {
         $error_msg['message1'] = "Your have to write something in this field.";
        }
        if(count($error_msg) == 0)
        {
          $name = $_POST['name'];
          $email = $_POST['email'];
          $subject = $_POST['subject'];
          $message = $_POST['message'];
          $header = "From: ".$email;
           

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
          $mail->setFrom($email, $name);
          $mail->addAddress("donor.seeker.all@gmail.com"); // receiver
          $mail->Subject = $subject;
          $mail->Body = "You have received an e-mail from: ".$name."<br> E-mail Address: ".$email."<p>".$message."</p>";

          if ($mail->send()) {
              //$status = "success";
              //$response = "Email is sent!";
              ?>
              <script src="sweetAlert/jquery-3.5.0.min.js"></script>
              <script src="sweetAlert/sweetalert2.all.min.js"></script>
              <script>
                 const wrong = $('.error').data('wrong')
                 if(wrong){
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Message sent successfully.',
                      showConfirmButton: false,
                      timer: 4000
                    })
                 }
               </script>
        <?php
          } else {
              //$status = "failed";
            ?>
            <script src="sweetAlert/jquery-3.5.0.min.js"></script>
              <script src="sweetAlert/sweetalert2.all.min.js"></script>
              <script>
                 const wrong = $('.error').data('wrong')
                 if(wrong){
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong...!!!'
                    })
                 }
               </script>
       <?php
          }
        }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <title>Contact Us</title>
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
          <div class="col-sm-3">
               <div class="card">
                <div class="card-header"><h5>Follow Us on</h5></div>
                 <div class="card-body">
                  <a href="" class="btn btn-link">Facebook</a>
                  <a href="" class="btn btn-link">Twiter</a>
                  <a href="" class="btn btn-link">Instagram</a>
                 </div>
             </div>
         </div> 
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h5 style="text-align: center;">Send Your Complain/Suggestion</h5></div>
                <div class="card-body">
                    <form method="POST" action="">
                        
                        <! Full Name >
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Full Name:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" autofocus placeholder="Full Name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
                               <p> 
                                <?php
                                    if(isset($error_msg['name1'])) 
                                        echo "<div class='error'>" . $error_msg['name1']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['name2'])) 
                                        echo "<div class='error'>" . $error_msg['name2']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>


                        <! Subject Name >
                        <div class="form-group row">
                            <label for="subject" class="col-md-4 col-form-label text-md-right">Subject:</label>

                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control" name="subject" autofocus placeholder="Subject" value="<?php if(isset($_POST['subject'])) echo $_POST['subject']; ?>">
                               <p> 
                                <?php
                                    if(isset($error_msg['subject1'])) 
                                        echo "<div class='error'>" . $error_msg['subject1']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>

                         <! E-mail >
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Your E-Mail:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"placeholder="example@example.com" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                                <p>
                                    <?php
                                    if(isset($error_msg['email1'])) 
                                        echo "<div class='error'>" . $error_msg['email1']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>


                        <! Message Area >
                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">Your Message:</label>

                            <div class="col-md-6">
                                <textarea id="message" type="text" class="form-control" name="message" autofocus placeholder="Write your message...." value="<?php if(isset($_POST['message'])) echo $_POST['message']; ?>"></textarea>
                               <p> 
                                <?php
                                    if(isset($error_msg['message1'])) 
                                        echo "<div class='error'>" . $error_msg['message1']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>

                         <! Submit Button >
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            <div class="col-sm-3">
              <div class="card">
               <div class="card-header"><h5>Contact Us</h5></div>
                <div class="card-body">
                  Phone:
                </div>    
            </div>
         </div> 
        </div>
</body>
</html>