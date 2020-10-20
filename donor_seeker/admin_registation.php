<?php 
   include("connection.php");
   ob_start();
   include("header.php");
    if($_POST)
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $weight = $_POST['weight'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $admin_key = $_POST['admin_key'];
        $password_confirmation = $_POST['password_confirmation'];
        $error_msg = array();
        $query = "SELECT * from donor_infos where E_mail = '$email'";
        $query_check = mysqli_query($connection,$query);
        if(empty($_POST['firstname']))
        {
         $error_msg['firstname1'] = "First Name is Required.";
        }
        if(!preg_match("/^[a-zA-Z\s]*$/", $firstname)) 
        {
         $error_msg['firstname2'] = "Only letters and white space allowed";
        }
        if(empty($_POST['lastname']))
        {
         $error_msg['lastname1'] = "Last Name is Required.";
        }
        if(!preg_match("/^[a-zA-Z\s]*$/", $lastname)) 
        {
         $error_msg['lastname2'] = "Only letters and white space allowed";
        }
        if($_POST['blood_group'] == "NULL")
        {
         $error_msg['blood_group1'] = "Blood Group is Required.";
        }
        if($_POST['gender'] == "NULL")
        {
         $error_msg['gender1'] = "Gender is Required.";
        }
        if(empty($_POST['DoB']))
        {
         $error_msg['DoB1'] = "Date of Birth is Required.";
        }
        if(empty($_POST['weight']))
        {
         $error_msg['weight1'] = "Weight is Required.";
        }
        if( !is_numeric($weight))
        {
         $error_msg['weight2'] = "Only Number input";
        }
        if($_POST['division'] == "NULL")
        {
         $error_msg['division1'] = "Division is Required.";
        }
        if($_POST['district'] == "NULL")
        {
         $error_msg['district1'] = "District is Required.";
        }
        if($_POST['sub_district'] == "NULL")
        {
         $error_msg['sub_district1'] = "Sub-district/Police Station is Required.";
        }
        if($_POST['village'] == "NULL")
        {
         $error_msg['village1'] = "Village/Area is Required.";
        }
        if(empty($_POST['phone']))
        {
         $error_msg['phone1'] = "Phone Number is Required.";
        }
        if( !is_numeric($phone))
        {
         $error_msg['phone2'] = "Only Number input";
        }
        else if( strlen($phone) < 11)
        {
         $error_msg['phone2'] = "Number Should Contain at lest 11 digit.";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
         $error_msg['email1'] = "E-mail Address is Required.";
        }
        if ($query_check)
        {
            if(mysqli_num_rows($query_check) > 0)
            {
                $error_msg['email2'] = "E-mail is already exist.Please try another.";
            }
        }
        if(empty($_POST['admin_key']))
        {
         $error_msg['admin_key1'] = "Admin Key is Required.";   
        }
        if($_POST['admin_key'] != 'admin' && !empty($_POST['admin_key']))
        {
         $error_msg['admin_key2'] = "You Entered Wrong Admin Key/You are not to eligible as a admin...!!";
        }
        
        if(empty($_POST['password']))
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
        if(!isset($_POST['remember']))
        {
           $error_msg['remember'] = "Please Click On Terms & Condition."; 
        }
        if(count($error_msg) == 0)
        {
            $First_Name = $_POST['firstname'];
            $Last_Name = $_POST['lastname'];
            $Blood_Group = $_POST['blood_group'];
            $Gender = $_POST['gender'];
            $Date_of_Birth = $_POST['DoB'];
            $Weight = $_POST['weight'];
            $Division = $_POST['division'];
            $sql1 = mysqli_query($connection , "SELECT * from division_infos where id = '$Division'");
            $Division_sql = mysqli_fetch_array($sql1);
            $division = $Division_sql['Division'];
            $District = $_POST['district'];
            $sql2 = mysqli_query($connection , "SELECT * from district_infos where id = '$District'");
            $District_sql = mysqli_fetch_array($sql2);
            $district = $District_sql['District'];
            $Sub_District_or_Police_Station = $_POST['sub_district'];
            $sql3 = mysqli_query($connection , "SELECT * from sub_district_infos where id = '$Sub_District_or_Police_Station'");
            $Sub_District_or_Police_Station_sql = mysqli_fetch_array($sql3);
            $sub_district = $Sub_District_or_Police_Station_sql['Sub_District_or_Police_Station'];


            $Village_or_Area = $_POST['village'];
            $sql4 = mysqli_query($connection , "SELECT * from area_or_village_infos where id = '$Village_or_Area'");
            $Village_or_Area_sql = mysqli_fetch_array($sql4);
            $village = $Village_or_Area_sql['Area_or_Village'];

            
            $Details_of_Your_Area = $_POST['details_of_area'];
            $Phone = $_POST['phone'];
            $E_mail = $_POST['email'];
            $admin_key = $_POST['admin_key'];
            $Password = $_POST['password']; 
        /* Insert Into donor_infos table */
        $query = "INSERT INTO donor_infos (`First_Name`, `Last_Name`, `Blood_Group`, `Gender`, `Date_of_Birth`, `Weight`, `Division`, `District`, `Sub_District_or_Police_Station`, `Village_or_Area`, `Details_of_Your_Area`, `Phone`, `E_mail`, `Role`, `Password` , `status`) values('$First_Name', '$Last_Name', '$Blood_Group', '$Gender', '$Date_of_Birth', '$Weight', '$division', '$district', '$sub_district', '$village', '$Details_of_Your_Area', '$Phone', '$E_mail', '$admin_key', '$Password' , 'active')";
        $sql=mysqli_query($connection , $query);
            if(!$sql)
            {
                //echo "Not Inserted";
                header("location:admin_registation.php?error=error");
                ob_end_flush();
            }
            else
            {
                /* Redirect (Go to the view Profile) */
                 $to = $email;

                 $subject = "Admin Confirmation";

                 $header = "Donor Seeker";

                  
                 $url = "http://localhost/donor_seeker/admin_login.php";
                            

                 $message = "<p>Dear ".$firstname." ".$lastname." ,hope you are well. You are registation was completed at Donor Seeker. Now you can sereve as a admin at Donor Seeker.</p>";

                 $message .= "<br><p> Your email: ".$to."<br>Temporary Password: ".$password_confirmation."</p>";
                 $message .= "<p>You are requested to change password after first login.</p>";

                 $message .= '<p>Here is login link: <br>';
                 $message .= '<a href=" '.$url.' ">' .$url. '</a></p>';

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
                      //$status = "success";
                      //$response = "Email is sent!";

                      ?>
                      <div class="error2" data-wrong="<?= ?>"> 
                      </div>
                      <script src="sweetAlert/jquery-3.5.0.min.js"></script>
                      <script src="sweetAlert/sweetalert2.all.min.js"></script>
                      <script>
                         const wrong = $('.error2').data('wrong')
                         if(wrong){
                            Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'Registation completed and e-mail sent to the user.',
                              showConfirmButton: false,
                              timer: 4000
                            })
                         }
                       </script>
                  <?php
                  } else {
                      $status = "failed";
                      //$response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
                      echo $status;
                      header("location:admin_registation.php?error=error");
                      ob_end_flush();
                  }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
        <title>Registation</title>
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
        <!--jQuery Library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!--Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <!-- Latest Compiled JavaScript -->
        <script src="css/bootstrap.min.js"></script>

        <script src="jquery.js"></script>
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
                <div class="card-header"><h5>Admin Sign Up Form</h5></div>
                 

                <div class="card-body">
                    <form method="POST" action="">
                        
                        <! First Name >
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name:</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" autofocus placeholder="First Name" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
                               <p> 
                                <?php
                                    if(isset($error_msg['firstname1'])) 
                                        echo "<div class='error'>" . $error_msg['firstname1']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['firstname2'])) 
                                        echo "<div class='error'>" . $error_msg['firstname2']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>




                         <! Last Name >
                         <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">Last Name:</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control " name="lastname"autofocus placeholder="Last Name" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
                                <p>
                                    <?php
                                    if(isset($error_msg['lastname1'])) 
                                        echo "<div class='error'>" . $error_msg['lastname1']. "</div>";
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    if(isset($error_msg['lastname2'])) 
                                        echo "<div class='error'>" . $error_msg['lastname2']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>


                         <! Blood Group >
                        <div class="form-group row">
                            <label for="blood_group" class="col-md-4 col-form-label text-md-right">Blood Group:</label>

                            <div class="col-md-6">
                               <select  id="blood_group" class="form-control" name="blood_group"autofocus>
                                        <option value="NULL">-Select Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                </select> 
                                <p>
                                    <?php
                                    if(isset($error_msg['blood_group1'])) 
                                        echo "<div class='error'>" . $error_msg['blood_group1']. "</div>";
                                     ?>
                                </p>
                            </div>
                        </div>

                        <! Gender >
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender:</label>

                            <div class="col-md-6">
                               <select  id="gender" class="form-control" name="gender"autofocus>
                                        <option value="NULL">-Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                </select> 
                                <p>
                                    <?php
                                    if(isset($error_msg['gender1'])) 
                                        echo "<div class='error'>" . $error_msg['gender1']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>

                         <! Date of Birth >
 
                         <div class="form-group row">
                            <label for="DoB" class="col-md-4 col-form-label text-md-right">Date of Birth:</label>

                            <div class="col-md-6">
                                <input id="DoB" type="Date" class="form-control" name="DoB"autofocus value="<?php if(isset($_POST['DoB'])) echo $_POST['DoB']; ?>">
                                <p>
                                    <?php
                                    if(isset($error_msg['DoB1'])) 
                                        echo "<div class='error'>" . $error_msg['DoB1']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>
 
                        <! Weight >
                        <div class="form-group row">
                            <label for="weight" class="col-md-4 col-form-label text-md-right">Weight:</label>

                            <div class="col-md-6">
                                <input id="weight" type="number" class="form-control" name="weight"autofocus placeholder="Weight(kg)" value="<?php if(isset($_POST['weight'])) echo $_POST['weight']; ?>">
                                 <p>
                                     <?php
                                    if(isset($error_msg['weight1'])) 
                                        echo "<div class='error'>" . $error_msg['weight1']. "</div>";
                                     ?>
                                 </p>
                                 <p>
                                     <?php
                                    if(isset($error_msg['weight2'])) 
                                        echo "<div class='error'>" . $error_msg['weight2']. "</div>";
                                     ?>
                                 </p>
                            </div>
                        </div>



                        <! Division (from database) >
                        <div class="form-group row">
                            <label for="division" class="col-md-4 col-form-label text-md-right">Division:</label>
                            <?php 
                                
                              ?>
                            <div class="col-md-6">
                               <select  id="division" class="form-control" name="division"autofocus  >
                                        <option value="NULL">-Select Division</option>
                                   <?php 
                                        $query = mysqli_query($connection , "SELECT * from division_infos ORDER BY Division ASC");
                                        $rowcount = mysqli_num_rows($query);
                                          for($i=1;$i<=$rowcount;$i++)
                                          {
                                            $row = mysqli_fetch_array($query);
                                    ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['Division'];?></option>
                                    <?php 
                                          }
                                     ?>
                                </select>
                                <p>
                                    <?php
                                    if(isset($error_msg['division1'])) 
                                        echo "<div class='error'>" . $error_msg['division1']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>
                         <! District (from database) >
                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">District:</label>

                            <div class="col-md-6">
                               <select  id="district" class="form-control" name="district"autofocus  >
                                        <option value="NULL">-Select District</option>
                                </select> 
                                 <p>
                                     <?php
                                    if(isset($error_msg['district1'])) 
                                        echo "<div class='error'>" . $error_msg['district1']. "</div>";
                                    ?>
                                 </p>
                            </div>
                        </div>
                        <! Sub-district >
                        <div class="form-group row">
                            <label for="sub_district" class="col-md-4 col-form-label text-md-right">Police Station/Sub-district:</label>

                            <div class="col-md-6">
                               <select  id="sub_district" class="form-control" name="sub_district"autofocus>
                                        <option value="NULL">-Select Sub-district</option>
                                </select> 
                                <p>
                                    <?php
                                    if(isset($error_msg['sub_district1'])) 
                                        echo "<div class='error'>" . $error_msg['sub_district1']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>

                        <! Village (from database) >
                        <div class="form-group row">
                            <label for="village" class="col-md-4 col-form-label text-md-right">Village/Area:</label>

                            <div class="col-md-6">
                               <select  id="village" class="form-control"name="village"autofocus  >
                                        <option value="NULL">-Select Your Area</option>
                                </select>
                                <p>
                                    <?php
                                    if(isset($error_msg['village1'])) 
                                        echo "<div class='error'>" . $error_msg['village1']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>

                         <! Details of Your Area >
                         <div class="form-group row">
                            <label for="details_of_area" class="col-md-4 col-form-label text-md-right">Details of Your Area:</label>

                            <div class="col-md-6">
                                <input id="details_of_area" type="text" class="form-control" name="details_of_area"autofocus placeholder="Example@ #House No.#Road No.etc" value="<?php if(isset($_POST['details_of_area'])) echo $_POST['details_of_area']; ?>">
                            </div>
                        </div>

                        <! phone >
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone:</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control" name="phone"autofocus placeholder="Phone Number" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                                 <p>
                                     <?php
                                    if(isset($error_msg['phone1'])) 
                                        echo "<div class='error'>" . $error_msg['phone1']. "</div>";
                                    ?>
                                 </p>
                                 <p>
                                     <?php
                                    if(isset($error_msg['phone2'])) 
                                        echo "<div class='error'>" . $error_msg['phone2']. "</div>";
                                    ?>
                                 </p>
                            </div>
                        </div>



                        <! E-mail >
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"placeholder="Example@name.com" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
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

                        <! Admin Role >
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Admin Key:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="admin_key"placeholder="Please Enter Your Admin Key">
                                
                                <p>
                                    <?php
                                    if(isset($error_msg['admin_key1'])) 
                                        echo "<div class='error'>" . $error_msg['admin_key1']. "</div>";
                                    ?>
                                </p>
                                    <p>
                                    <?php
                                        if(isset($error_msg['admin_key2'])) 
                                            echo "<div class='error'>" . $error_msg['admin_key2']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>


                        <! Password >
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password"placeholder="Password">
                                
                                <p>
                                    <?php
                                    if(isset($error_msg['password1'])) 
                                        echo "<div class='error'>" . $error_msg['password1']. "</div>";
                                    ?>
                                </p>
                                <p>
                                    <p>
                                    <?php
                                        if(isset($error_msg['password2'])) { 
                                            echo "<div class='error'>" . $error_msg['password2']. "</div>";?>
                                           <div class="password_preg1" data-password_preg="<?= $error_msg['password2']; ?>"> 
                                          </div> 
                                    <?php }
                                    ?>
                                </p>
                                </p>
                            </div>
                        </div>

                        <! Confirm Password >
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password:</label>

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
                            </div>
                        </div>


                        <! Terms & Condition >
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        <a href="#">
                                            I agree with tearms and conditions
                                        </a>
                                    </label>
                                     <p>
                                         <?php
                                            if(isset($error_msg['remember'])) 
                                                echo "<div class='error'>" . $error_msg['remember']. "</div>";
                                        ?>
                                     </p>
                                </div>
                            </div>
                        </div>


                        <! Submit Button >
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>

                            <?php
                                if(isset($_GET['error'])) { ?>
                                    <div class="error" data-wrong="<?= $_GET['error']; ?>"> 
                                    </div>
                            <?php
                                  }
                                  else if(!empty($error_msg)) { ?>
                                    <div class="error2" data-wrong2="<?= $error_msg; ?>"> 
                                    </div>
                              <?php }
                                ?>

                                <script src="sweetAlert/jquery-3.5.0.min.js"></script>
                                 <script src="sweetAlert/sweetalert2.all.min.js"></script>
                                 <script>
                                    const wrong = $('.error').data('wrong')
                                    if(wrong){
                                      Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Registation failed.Something went wrong...!!!'
                                          })
                                    }
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