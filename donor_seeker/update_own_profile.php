<?php 
   include("connection.php"); // Any user can update his/her own profile
   include("header.php");
   $id = $_SESSION['id'];
        $two_mail_in_same_table = mysqli_query($connection , "SELECT `E_mail` from donor_infos where id = '$id'");
        $email_check = mysqli_fetch_array($two_mail_in_same_table);
    if($_POST)
    {
        $id = $_SESSION['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $weight = $_POST['weight'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
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
            if(mysqli_num_rows($query_check) > 0 AND ($email_check['E_mail'] != $email))
            {
                $error_msg['email2'] = "E-mail is already exist.Please try another.";
            }
        }
         
        if(count($error_msg) == 0)
        {
            $id = $_SESSION['id'];
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
            $village_or_area = $_POST['village'];


            $sql4 = mysqli_query($connection , "SELECT * from area_or_village_infos where id = '$Village_or_Area'");
            $Village_or_Area_sql = mysqli_fetch_array($sql4);
            $village = $Village_or_Area_sql['Area_or_Village'];


            $Details_of_Your_Area = $_POST['details_of_area'];
            $Phone = $_POST['phone'];
            $E_mail = $_POST['email']; 
        /* Update donor_infos table by ID */
        $query = "UPDATE donor_infos set 
              First_Name = '$First_Name', 
              Last_Name = '$Last_Name', 
              Blood_Group = '$Blood_Group', 
              Gender = '$Gender', 
              Date_of_Birth = '$Date_of_Birth', 
              Weight = '$Weight', 
              Division = '$division', 
              District = '$district', 
              Sub_District_or_Police_Station = '$sub_district', 
              Village_or_Area = '$village', 
              Details_of_Your_Area = '$Details_of_Your_Area', 
              Phone = '$Phone', 
              E_mail = '$E_mail' 
                where id = '$id' ";

        $sql=mysqli_query($connection , $query);
        if(!$sql)
        {
            echo "Not Updated";
            //header("location:registation.php");
        }
        else
        {
            /* Redirect (Go to the view Profile) */
        //header(location:)
            echo "Updated Data";
            header("location:view_own_profile.php");
        }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
        <title>Update Profile</title>
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
  <?php 
    $id = $_SESSION['id'];
    $query = mysqli_query($connection , "SELECT * from donor_infos where id = '$id'");
    $rowcount = mysqli_num_rows($query);
  ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Profile</div>

                <div class="card-body">
                    <form method="POST" action="">
                        <?php 
                            for($i=1;$i<=$rowcount;$i++)
                            {
                                $row = mysqli_fetch_array($query);
                        ?>
                        <! First Name >
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name:</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" autofocus placeholder="First Name" value="<?php  echo $row['First_Name']; ?>">
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
                                <input id="lastname" type="text" class="form-control " name="lastname"autofocus placeholder="Last Name" value="<?php  echo $row['Last_Name']; ?>">
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
                                        <option value="<?php  echo $row['Blood_Group']; ?>"><?php  echo $row['Blood_Group']; ?></option>
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
                                        <option value="<?php  echo $row['Gender']; ?>"><?php  echo $row['Gender']; ?></option>
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
                                <input id="DoB" type="Date" class="form-control" name="DoB"autofocus value="<?php  echo $row['Date_of_Birth']; ?>">
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
                                <input id="weight" type="number" class="form-control" name="weight"autofocus placeholder="Weight(kg)" value="<?php  echo $row['Weight']; ?>">
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
                             
                            <div class="col-md-6">
                               <select  id="division" class="form-control" name="division"autofocus  >
                                        <option value="<?php  echo $row['Division']; ?>"><?php  echo $row['Division']; ?></option>
                                   <?php 
                                        $query = mysqli_query($connection , "SELECT * from division_infos ORDER BY Division ASC");
                                        $rowcount = mysqli_num_rows($query);
                                          for($i=1;$i<=$rowcount;$i++)
                                          {
                                          $row2 = mysqli_fetch_array($query);
                                    ?>
                                        <option value="<?php echo $row2['id'];?>"><?php echo $row2['Division'];?></option>
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
                                         <option value="<?php  echo $row['District']; ?>"><?php  echo $row['District']; ?></option>
                                </select> 
                                 <p>
                                     <?php
                                    if(isset($error_msg['district1'])) 
                                        echo "<div class='error'>" . $error_msg['district1']. "</div>";
                                    ?>
                                 </p>
                            </div>
                        </div>
                        <! Sub-district (from database)>
                        <div class="form-group row">
                            <label for="sub_district" class="col-md-4 col-form-label text-md-right">Police Station/Sub-district:</label>

                            <div class="col-md-6">
                               <select  id="sub_district" class="form-control" name="sub_district"autofocus>
                                        <option value="<?php  echo $row['Sub_District_or_Police_Station']; ?>"><?php  echo $row['Sub_District_or_Police_Station']; ?></option>
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
                                         <option value="<?php  echo $row['Village_or_Area']; ?>"><?php  echo $row['Village_or_Area']; ?></option>
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
                                <input id="details_of_area" type="text" class="form-control" name="details_of_area"autofocus placeholder="Example@ #House No.#Road No.etc" value="<?php  echo $row['Details_of_Your_Area']; ?>">
                            </div>
                        </div>

                        <! phone >
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone:</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control" name="phone"autofocus placeholder="Phone Number" value="<?php  echo $row['Phone']; ?>">
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
                                <input id="email" type="email" class="form-control" name="email"placeholder="Example@name.com"value="<?php  echo $row['E_mail']; ?>">
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

                         
                        <?php 
                            }
                        ?>

                        <!  Update Button >
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Update
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