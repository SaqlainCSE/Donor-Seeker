<?php
    include("connection.php");
    ob_start();
    include("header.php");
     if($_POST)
    {
        $division = $_POST['division'];
        $district = $_POST['district'];
        $sub_district = $_POST['sub_district'];
        $error_msg = array();
        $query = "SELECT * from sub_district_infos where Sub_District_or_Police_Station = '$sub_district'";
        $query_check = mysqli_query($connection,$query);
        if($_POST['division'] == "NULL")
        {
         $error_msg['division1'] = "Division is Required.";
        }
        if($_POST['district'] == "NULL")
        {
         $error_msg['district1'] = "District is Required.";
        }
        if(empty($_POST['sub_district']))
        {
         $error_msg['sub_district1'] = "Sub-District/Police Station is Required.";
        }
        if(!preg_match("/^[a-zA-Z]*$/", $sub_district)) 
        {
         $error_msg['sub_district2'] = "Only letters allowed";
        }
        if($query_check)
        {
            if(mysqli_num_rows($query_check) > 0)
            {
             $error_msg['sub_district3'] = "Sub-District/Police Station is already exist.Please try another.";
            }
        }
         
        if(count($error_msg) == 0)
        {
      			$division = $_POST['division'];
      			$district = $_POST['district'];
      			$sub_district = $_POST['sub_district'];
            $sql=mysqli_query($connection , "INSERT into sub_district_infos (`district_id`, `Sub_District_or_Police_Station`) values('$district', '$sub_district')");
            if(!$sql)
            {
                /* Not Insert */
                header("location:add_sub_district.php?error=error");
                ob_end_flush();
            }
            else
            {
                /* Insert */
                header("location:add_sub_district.php?success=success");
                ob_end_flush();
            }  
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
          <title>Add Sub-District</title>
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
                <div class="card-header"><h5>Add Sub-District</h5></div>
                <div class="card-body">
                    <form method="POST" action="">

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
                         
                    	<! Add Sub-District >
                        <div class="form-group row">
                            <label for="sub_district" class="col-md-4 col-form-label text-md-right">Police Station/Sub-district:</label>
                            <div class="col-md-6">
                                <input id="sub_district" type="text" class="form-control" name="sub_district"  autofocus placeholder="Enter New Sub-District/Police Station">
                                <p> 
                                <?php
                                    if(isset($error_msg['sub_district1'])) 
                                        echo "<div class='error'>" . $error_msg['sub_district1']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['sub_district2'])) 
                                        echo "<div class='error'>" . $error_msg['sub_district2']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['sub_district3'])) 
                                        echo "<div class='error'>" . $error_msg['sub_district3']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>

                        <! Add District >
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Sub-District
                                </button>

                                <?php 
                                    if(isset($_GET['success'])) { ?>
                                      <div class="add-sub-district" data-added="<?= $_GET['success'];?>"></div>
                                      <?php }
                                        elseif(isset($_GET['error'])) { ?>
                                          <div class="not-added" data-wrong="<?= $_GET['error']; ?>"> 
                                          </div>
                              <?php 
                                  }
                                ?>

                                 <script src="sweetAlert/jquery-3.5.0.min.js"></script>
                                 <script src="sweetAlert/sweetalert2.all.min.js"></script>
                                 <script>
                                  const added = $('.add-sub-district').data('added')
                                    if(added){
                                      Swal.fire(
                                        'Success!',
                                        'Police Station/Sub-District was added!',
                                        'success'
                                      )
                                    }

                                    const wrong = $('.not-added').data('wrong')
                                    if(wrong){
                                      Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Police Station/Sub-District was not added...!!!'
                                          })
                                    }
                                 </script>


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