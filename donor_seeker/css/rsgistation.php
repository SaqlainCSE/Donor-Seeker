<?php 
   include("connection.php");
    if($_POST)
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $weight = $_POST['weight'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];
        $error_msg = array();
        $query = "SELECT * from donor_infos where E_mail = '$email'";
        $query_check = mysqli_query($connection,$query);
        if(empty($_POST['firstname']))
        {
         $error_msg['firstname1'] = "First Name is Required.";
        }
        if(!preg_match("/^[a-zA-Z]*$/", $firstname)) 
        {
         $error_msg['firstname2'] = "Only letters and white space allowed";
        }
        if(empty($_POST['lastname']))
        {
         $error_msg['lastname1'] = "Last Name is Required.";
        }
        if(!preg_match("/^[a-zA-Z]*$/", $lastname)) 
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
        $District = $_POST['district'];
        $Sub_District_or_Police_Station = $_POST['sub_district'];
        $Village_or_Area = $_POST['village'];
        $Details_of_Your_Area = $_POST['details_of_area'];
        $Phone = $_POST['phone'];
        $E_mail = $_POST['email'];
        $Password = $_POST['password']; 
        /* Insert Into donor_infos table */
        $query = "INSERT INTO donor_infos (`First_Name`, `Last_Name`, `Blood_Group`, `Gender`, `Date_of_Birth`, `Weight`, `Division`, `District`, `Sub_District_or_Police_Station`, `Village_or_Area`, `Details_of_Your_Area`, `Phone`, `E_mail`, `Password`) values('$First_Name', '$Last_Name', '$Blood_Group', '$Gender', '$Date_of_Birth', '$Weight', '$Division', '$District', '$Sub_District_or_Police_Station', '$Village_or_Area', '$Details_of_Your_Area', '$Phone', '$E_mail', '$Password')";
        //$sql=mysqli_query($connection , $query);
        if(!$sql=mysqli_query($connection , $query))
        {
            echo "Not Inserted";
            //header("location:registation.php");
        }
        else
        {
            /* Redirect (Go to the view Profile) */
        //header(location:)
            echo "Inserted Data";
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
</head>
<body>
  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

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
                            <label for="division" class="col-md-4 col-form-label text-md-right">District:</label>

                            <div class="col-md-6">
                               <select  id="division" class="form-control" name="division"autofocus  >
                                        <option value="NULL">-Select Division</option>
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="Cumilla">Cumilla</option>
                                        <option value="Sylhet">Sylhet</option>
                                        <option value="Khulna">Khulna</option>
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
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="Cumilla">Cumilla</option>
                                        <option value="Sylhet">Sylhet</option>
                                        <option value="Khulna">Khulna</option>
                                </select> 
                                 <p>
                                     <?php
                                    if(isset($error_msg['district1'])) 
                                        echo "<div class='error'>" . $error_msg['district1']. "</div>";
                                    ?>
                                 </p>
                            </div>
                        </div>

                        <! Sub-district (from database) >
                        <div class="form-group row">
                            <label for="sub_district" class="col-md-4 col-form-label text-md-right">Police Station/Sub-district:</label>

                            <div class="col-md-6">
                               <select  id="sub_district" class="form-control       " name="sub_district"autofocus  >
                                        <option value="NULL">-Select Sub-district</option>
                                        <option value="Rampura">Rampura</option>
                                        <option value="Uttara">Uttara</option>
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
                                        <option value="Rampura">Rampura</option>
                                        <option value="Uttara">Uttara</option>
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
                                        if(isset($error_msg['password2'])) 
                                            echo "<div class='error'>" . $error_msg['password2']. "</div>";
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
                </div>
            </div>
        </div>
    </div>
</div> 
</body>
</html>