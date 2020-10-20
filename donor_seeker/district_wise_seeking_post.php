<?php 
   include("connection.php"); // Admin can update profile by mail
   ob_start();
   include("header.php");
   if($_POST)
   {
        $error_msg = array();
        if($_POST['blood_group'] == "NULL")
         {
          $error_msg['blood_group1'] = "Blood Group is Required.";
         }
         if($_POST['division'] == "NULL")
         {
          $error_msg['division1'] = "Division is Required.";
         }
        if($_POST['district'] == "NULL")
         {
          $error_msg['district1'] = "District is Required.";
         }
         if(count($error_msg) == 0)
         {
            $blood_group = $_POST['blood_group'];
            $division = $_POST['division'];
            $district = $_POST['district'];
            header("location:district_wise_seeking_post.inc.php?blood_group=".$blood_group."&division=".$division."&district=".$district);
            ob_end_flush(); 
         }
   }
?>
<!DOCTYPE html>
<html>
<head>
        <title>District Wise Donor</title>
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
                <div class="card-header"><h5 style="text-align: center;">District Wise Donor Search</h5>
                  <hr>
                  <?php
                        if(isset($_SESSION['user']) && $_SESSION['role'] == "admin") { 
                    ?>
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
                                        <option value="NULL" disabled selected>-Select Blood Group</option>
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
                            <div class="col-md-6">
                               <select  id="division" class="form-control" name="division"autofocus  >
                                        <option value="NULL" disabled selected>-Select Division</option>
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
                                        <option value="NULL" disabled selected>-Select District</option>
                                </select> 
                                 <p>
                                     <?php
                                    if(isset($error_msg['district1'])) 
                                        echo "<div class='error'>" . $error_msg['district1']. "</div>";
                                    ?>
                                 </p>

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

                                     
                            </div>
                        </div>

                        <! Search Button >
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