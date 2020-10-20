<?php 
   include("connection.php");
   include("header.php");

    if($_POST)
    {
        $selector = $_POST['selector'];
        $validator = $_POST['validator'];
        $password = $_POST['new_password'];
        $password_confirmation = $_POST['password_confirmation'];
        $error_msg = array();

         
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
         $current_date = date("U");

        $sql = mysqli_query($connection , "SELECT * FROM `reset_paasword` WHERE `selector` = '$selector' AND `reset_expire` >= '$current_date'");
        if(!$row = mysqli_fetch_array($sql))
        {
          echo "You need to re-submit your reset request.";
        }
        else
        {
          $tokenBin = hex2bin($validator);
          $tokenChecck = password_verify($tokenBin, $row['token']);

          if($tokenChecck === false)
          {
            echo "You need to re-submit your reset request.";
          }
          elseif($tokenChecck === true)
          {
            $userEmail = $row['request_mail'];
            $query = mysqli_query($connection , "SELECT * FROM donor_infos WHERE    E_mail = '$userEmail'");
            if(!$query)
            {
              echo "There was an error";
            }
            else
            {
              $row = mysqli_fetch_array($query);
              $email = $row['E_mail'];
              $update_query = mysqli_query($connection , "UPDATE donor_infos SET Password = '$password_confirmation' WHERE E_mail = '$email'");
            }
          }
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
                   <?php 
                          $selector = $_GET['selector'];

                          $validator = $_GET['validator'];

                          if(empty($selector) || empty($validator))
                          {
                            echo "Could not validate your request!";
                          }
                          else
                          {
                            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){ ?>
                    <form method="POST" action="">
                        <! To Get Selector & Validator >
                        <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                        <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                          
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
                                    if(isset($error_msg['password_confirmation1'])) 
                                        echo "<div class='error'>" . $error_msg['password_confirmation1']. "</div>";
                                    ?>
                               </p>
                                <p>
                                    <h5>Password Should Contain:</h5>
                                      <ul>
                                          <li>
                                          Password must be at least 8 characters in length and max length is 16.
                                          <li>
                                          Password must include at least one upper case letter.
                                          <li>
                                          Password must include at least one number.
                                          <li>
                                          Password must include at least one special character (e.g:~!@#$% etc).
                                      </ul>
                                </p>
                            </div>
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
                    <?php   
                          }
                        }
                      ?>
                </div>
            </div>
        </div>
    </div>
</div> 
</body>
</html>