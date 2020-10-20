<?php 
   include("connection.php");
   ob_start();
   include("header.php");
   if($_POST)
   {
        $error_msg = array();
        $phone = $_POST['phone'];
        $bag_needed = $_POST['bag_needed'];
        $donee_name = $_POST['donee_name'];
        $email = $_POST['email'];
         if($_POST['blood_group'] == "NULL")
         {
          $error_msg['blood_group1'] = "Blood Group is Required.";
         }
         if($_POST['division'] == "NULL")
         {
          $error_msg['division1'] = "Division is Required.";
         }
         if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
         $error_msg['email1'] = "E-mail Address is Required.";
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
         if(empty($_POST['details_of_area']))
         {
          $error_msg['details_of_area'] = "Details of Your Area is Required.";
         }
         if(empty($_POST['donee_name']))
         {
          $error_msg['donee_name'] = "Donee Name is Required.";
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
         if(empty($_POST['donation_date']))
         {
          $error_msg['donation_date'] = "Donation Date is Required.";
         }
         if(empty($_POST['donation_time']))
         {
          $error_msg['donation_time'] = "Donation Time is Required.";
         }
         if(empty($_POST['bag_needed']))
         {
          $error_msg['bag_needed'] = "This Field is Required.";
         }
         if(!is_numeric($bag_needed))
         {
          $error_msg['bag_needed1'] = "Only Number input";
         }
         if(empty($_POST['donee_name']))
        {
         $error_msg['donee_name1'] = "Donee Name is Required.";
        }
        if(!preg_match("/^[a-zA-Z\s]*$/", $donee_name)) 
        {
         $error_msg['donee_name2'] = "Only letters and white space allowed";
        }
        if(count($error_msg) == 0)
        {
            //Go to the other page or search donor who available

            $seeker_id = $_SESSION['id'];
            $blood_group = $_POST['blood_group'];
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

            
            $details_of_your_area = $_POST['details_of_area'];
            $donee_name = $_POST['donee_name'];
            $donee_contact = $_POST['phone'];
            $date = $_POST['donation_date'];
            $time = $_POST['donation_time'];
            $how_much_needed = $_POST['bag_needed'];
            $email = $_POST['email']; 
            $post_at = date("U") + 30; // 30 sec.
        /* Insert Into donor_seeker_post table */
         $query = "INSERT INTO `donor_seeker_post`(`seeker_id`, `blood_group`, `division`, `district`, `sub_district_or_police_station`, `village_or_area`, `details_of_your_area`, `donee_name`, `donee_contact`, `donee_mail`, `date`, `time`, `how_much_needed`, `status`, `post_at` , `bag`) VALUES ('$seeker_id' , '$blood_group' , '$division' , '$district' , '$sub_district' , '$village' , '$details_of_your_area' , '$donee_name' , '$donee_contact' , '$email' , '$date' , '$time' , '$how_much_needed' , 'live' , '$post_at' , '$how_much_needed');";
         $sql=mysqli_query($connection , $query);
            if($sql)
            {
                //Show the all available donor according to avobe information.
                //echo "Insert";
                $current_time = date("U");
                $sql=mysqli_query($connection , "SELECT * FROM `donor_seeker_post` WHERE `seeker_id` ='$seeker_id' AND post_at >= '$current_time' AND status = 'live'");
                $row = mysqli_fetch_array($sql);// duplicate post jate na ase
                $id = $row['id'];
                header("location:search_eligible_donor.php?idd=$id");
                ob_end_flush();
            }
            else
            {
               /* <script>
                alert redirect to donor seeker window.
                </script>*/
                echo "Problem";
            }

        }   
   }
     
?>
<!DOCTYPE html>
<html>
<head>
        <title>Donor Seeker</title>
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
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 style="text-align: center;">Donor Search</h5>
                    <?php
                        if(isset($_SESSION['user']) && $_SESSION['role'] == "admin") { 
                    ?>
                  <hr>
                    <a class="btn btn-link" href="division_wise_seeking_post.php">Division Wise</a>
                    <a class="btn btn-link" href="district_wise_seeking_post.php">District Wise</a>
                    <a class="btn btn-link" href="sub_district_wise_seeking_post.php">Sub-District Wise</a>
                <?php } ?>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        
                        
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
                                        <option value="value">-Select Your Area</option>
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
                            <label for="details_of_area" class="col-md-4 col-form-label text-md-right">Donation Place:</label>

                            <div class="col-md-6">
                                <input id="details_of_area" type="text" class="form-control" name="details_of_area"autofocus placeholder="#House.#Road.#Hospital Name.etc" value="<?php if(isset($_POST['details_of_area'])) echo $_POST['details_of_area']; ?>">
                                <p>
                                     <?php
                                    if(isset($error_msg['details_of_area'])) 
                                        echo "<div class='error'>" . $error_msg['details_of_area']. "</div>";
                                    ?>
                                 </p>
                            </div>
                        </div>

                         <! Donee Name >
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">Donee Name:</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="donee_name" autofocus placeholder="Donee Name" value="<?php if(isset($_POST['donee_name'])) echo $_POST['donee_name']; ?>">
                               <p> 
                                <?php
                                    if(isset($error_msg['donee_name1'])) 
                                        echo "<div class='error'>" . $error_msg['donee_name1']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['donee_name2'])) 
                                        echo "<div class='error'>" . $error_msg['donee_name2']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>

                        <! Donee Contact >
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Donee Contact:</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">Donee E-Mail:</label>

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

                        <! Donation Date >
 
                         <div class="form-group row">
                            <label for="donation_date" class="col-md-4 col-form-label text-md-right">Donation Date:</label>

                            <div class="col-md-6">
                                <input id="donation_date" type="Date" class="form-control" name="donation_date"autofocus value="<?php if(isset($_POST['donation_date'])) echo $_POST['donation_date']; ?>">
                                <p>
                                    <?php
                                    if(isset($error_msg['donation_date'])) 
                                        echo "<div class='error'>" . $error_msg['donation_date']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>

                        <! Donation Time >
 
                         <div class="form-group row">
                            <label for="donation_time" class="col-md-4 col-form-label text-md-right">Donation Time:</label>

                            <div class="col-md-6">
                                <input id="donation_time" type="Time" class="form-control" name="donation_time"autofocus value="<?php if(isset($_POST['donation_time'])) echo $_POST['donation_time']; ?>">
                                <p>
                                    <?php
                                    if(isset($error_msg['donation_time'])) 
                                        echo "<div class='error'>" . $error_msg['donation_time']. "</div>";
                                    ?>
                                </p>
                            </div>
                        </div>

                        <! How Much Blood Needed >
                        <div class="form-group row">
                            <label for="bag_needed" class="col-md-4 col-form-label text-md-right">How Much Blood Needed:</label>

                            <div class="col-md-6">
                                <input id="bag_needed" type="number" class="form-control" name="bag_needed"autofocus placeholder="In Terms of Bag" value="<?php if(isset($_POST['bag_needed'])) echo $_POST['bag_needed']; ?>">
                                 <p>
                                     <?php
                                    if(isset($error_msg['bag_needed'])) 
                                        echo "<div class='error'>" . $error_msg['bag_needed']. "</div>";
                                     ?>
                                 </p>
                                 <p>
                                     <?php
                                    if(isset($error_msg['bag_needed1'])) 
                                        echo "<div class='error'>" . $error_msg['bag_needed1']. "</div>";
                                     ?>
                                 </p>
                            </div>
                        </div>

                            <?php
                               if(!empty($error_msg)) { ?>
                                <div class="not-added" data-wrong="<?= $error_msg; ?>"> 
                                </div>
                                <?php }
                                    ?>

                                     <script src="sweetAlert/jquery-3.5.0.min.js"></script>
                                     <script src="sweetAlert/sweetalert2.all.min.js"></script>
                                     <script>
                                        const wrong = $('.not-added').data('wrong')
                                        if(wrong){
                                          Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: 'Something went wrong...!!!'
                                              })
                                        }
                                     </script>



                        <! Submit Button >
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Search Now
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