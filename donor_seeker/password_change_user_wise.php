<?php 
   include("connection.php");
   include("header.php");
   $id = $_SESSION['id'];
    if($_POST)
    {
        $query = mysqli_query($connection , "SELECT * from donor_infos where id = '$id'");
          $password_check = mysqli_fetch_array($query);
        $pre_password = $_POST['pre_password'];
        $password = $_POST['new_password'];
        $password_confirmation = $_POST['password_confirmation'];
        $error_msg = array();
        if($password_check['Password'] != $pre_password)
        {
          $error_msg['pre_password1'] = "You type wrong password...!!!";
        }
        if(empty($_POST['new_password']))
        {
         $error_msg['password1'] = "Password is Required.";
        }
        else if(!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,16}/' , $password))
        {
         $error_msg['password2'] = "Password don't meat requirement.";
        }
        if(empty($_POST['password_confirmation']))
        {
         $error_msg['password_confirmation'] = "Confirm Password is Required.";
        }
        else if($password != $password_confirmation)
        {
         $error_msg['password_confirmation1'] = "Password don't match";
        }
        if(count($error_msg) == 0)
        {
          $query = "UPDATE donor_infos set Password = '$password_confirmation' where id = '$id' ";
          $sql=mysqli_query($connection , $query);
        if(!$sql)
        {
            echo "Password Not Change";
            //header("location:registation.php");
        }
        else
        {
            /* Redirect (Go to the view Profile) */
        //header(location:)
            echo "Updated Password";
            //header("location:viewProfile.php");
        }
        }
    }


 ?>
<!DOCTYPE html>
<html>
<head>
        <title>Change Password</title>
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
                <div class="card-header">Change Password</div>

                <div class="card-body">
                    <form method="POST" action="">
                        
                        <! Previous Password >
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Previous Password:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="pre_password"placeholder="Previous Password">
                                
                                <p>
                                    <?php
                                    if(isset($error_msg['pre_password1'])) 
                                        echo "<div class='error'>" . $error_msg['pre_password1']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>

                        <! New Password >
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="new_password"placeholder="New Password">
                                
                                <p>
                                    <?php
                                    if(isset($error_msg['password1'])) 
                                        echo "<div class='error'>" . $error_msg['password1']. "</div>";
                                    ?>
                                </p>
                                <p>
                                    <p>
                                    <?php
                                        if(isset($error_msg['password2'])) 
                                            echo "<div class='error'>" . $error_msg['password2']. "</div>";
                                    ?>
                                </p>
                                </p>
                            </div>
                        </div>


                        <! Confirm Password >
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm New Password:</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-type Password">
                               
                               <p>
                                    <?php
                                    if(isset($error_msg['password_confirmation'])) 
                                        echo "<div class='error'>" . $error_msg['password_confirmation']. "</div>";
                                    ?>
                               </p>
                               <p>
                                    <?php
                                    if(isset($error_msg['password_confirmation1'])) {
                                        echo "<div class='error'>" . $error_msg['password_confirmation1']. "</div>";
                                        ?>
                                        <div class="password_preg1" data-password_preg="<?= $error_msg['password2']; ?>"> 
                                          </div>
                                <?php
                                      }
                                    ?>
                               </p>
                                 
                            </div>

                            <?php
                                   if(!empty($error_msg)) { ?>
                                    <div class="error2" data-wrong2="<?= $error_msg; ?>"> 
                                    </div>
                              <?php }
                                ?>

                                <script src="sweetAlert/jquery-3.5.0.min.js"></script>
                                 <script src="sweetAlert/sweetalert2.all.min.js"></script>
                                 <script>
                                    const wrong2 = $('.error2').data('wrong2')
                                    if(wrong2){
                                      Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Something went wrong...!!!'
                                          })
                                    }
                                    const password_preg = $('.password_preg1').data('password_preg')
                                    if(password_preg){
                                      Swal.fire({
                                          title: '<h3><strong>Password Should Contain:</strong></h3>',
                                          icon: 'info',
                                          html:
                                            "<ul> <li> Password must be at least 8 characters in length and max length is 16.<li>Password must include at least one upper case letter and include at least one number.<li>Password must include at least one special character (e.g:~!@#$% etc).</ul>",
                                          showCloseButton: true,
                                          showCancelButton: true,
                                          focusConfirm: false,
                                        })
                                      }
                                 </script>




                        </div>

                        <! Submit Button >
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Change Password
                                </button>
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