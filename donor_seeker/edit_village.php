<?php
    include("connection.php");
    ob_start();
    include("header.php");
     if($_POST)
    {
        $division = $_POST['division'];
        $district = $_POST['district'];
        $sub_district = $_POST['sub_district'];
        $village = $_POST['village'];
        $edit_village = $_POST['edit_village'];
        $error_msg = array();
        $query = "SELECT * from area_or_village_infos where Area_or_Village = '$edit_village'";
        $query_check = mysqli_query($connection,$query);
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
         $error_msg['village1'] = "Area/Village is Required.";
        }
        if(empty($_POST['edit_village']))
        {
         $error_msg['edit_village1'] = "Area/Village is Required.";
        }
        if(!preg_match("/^[a-zA-Z]*$/", $edit_village)) 
        {
         $error_msg['edit_village2'] = "Only letters allowed";
        }
        if(count($error_msg) == 0)
        {
			$sub_district = $_POST['sub_district'];
			$edit_village = $_POST['edit_village'];
			$village = $_POST['village'];
            $sql=mysqli_query($connection , "UPDATE area_or_village_infos set Area_or_Village = '$edit_sub_district'where sub_district_id = '$edit_village' and id = '$village'");
            if(!$sql)
            {
                 /* Not Updated */
                header("location:edit_village.php?error=error");
                ob_end_flush();
            }
            else
            {
                 /* Updated */
                header("location:edit_village.php?success=success");
                ob_end_flush();
            }  
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
          <title>Add Village</title>
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
                <div class="card-header"><h5>Update Area/Village</h5></div>
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

                         <! village >
                        <div class="form-group row">
                            <label for="village" class="col-md-4 col-form-label text-md-right">Area/Village:</label>

                            <div class="col-md-6">
                               <select  id="village" class="form-control" name="village"autofocus>
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
                         
                    	<! edit_village >
                        <div class="form-group row">
                            <label for="edit_village" class="col-md-4 col-form-label text-md-right">Replace Area/Village:</label>
                            <div class="col-md-6">
                                <input id="edit_village" type="text" class="form-control" name="edit_village"  autofocus placeholder="Replace Area/Village">
                                <p> 
                                <?php
                                    if(isset($error_msg['edit_village1'])) 
                                        echo "<div class='error'>" . $error_msg['edit_village1']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['edit_village2'])) 
                                        echo "<div class='error'>" . $error_msg['edit_village2']. "</div>";
                                ?>
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['edit_village3'])) 
                                        echo "<div class='error'>" . $error_msg['edit_village3']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>

                        <! Edit village >
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Area/Village
                                </button>

                                <?php 
                                    if(isset($_GET['success'])) { ?>
                                      <div class="edit-village" data-edit="<?= $_GET['success'];?>"></div>
                                      <?php }
                                        elseif(isset($_GET['error'])) { ?>
                                          <div class="not-edited" data-wrong="<?= $_GET['error']; ?>"> 
                                          </div>
                              <?php 
                                  }
                                ?>

                                 <script src="sweetAlert/jquery-3.5.0.min.js"></script>
                                 <script src="sweetAlert/sweetalert2.all.min.js"></script>
                                 <script>
                                  const edit = $('.edit-village').data('edit')
                                    if(edit){
                                      Swal.fire(
                                        'Success!',
                                        'Area/Village was updated!',
                                        'success'
                                      )
                                    }

                                    const wrong = $('.not-edited').data('wrong')
                                    if(wrong){
                                      Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Area/Village was not updated...!!!'
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