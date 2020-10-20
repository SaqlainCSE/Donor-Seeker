<?php
    include("connection.php");
    ob_start();
    include("header.php");
     if($_POST)
    {
        $division = $_POST['division'];
        $edit_division = $_POST['edit_division'];
        $error_msg = array();
        if($_POST['division'] == "NULL")
        {
         $error_msg['division1'] = "Division is Required.";
        }
        if(empty($_POST['edit_division']))
        {
         $error_msg['edit_division1'] = "Division Field Can't be empty.";
        }
        if(!preg_match("/^[a-zA-Z]*$/", $edit_division)) 
        {
         $error_msg['edit_division2'] = "Only letters allowed";
        }

        if(count($error_msg) == 0)
        {
			$edit_division = $_POST['edit_division'];
			$division = $_POST['division'];
            $sql=mysqli_query($connection , "UPDATE   division_infos set Division = '$edit_division'where id = '$division'");
            if(!$sql)
            {
                 /* Not Updated */
                header("location:edit_division.php?error=error");
                ob_end_flush();
            }
            else
            {
                /* Updated */
                header("location:edit_division.php?success=success");
                ob_end_flush();
            }  
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
          <title>Upadate Division</title>
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
                <div class="card-header"><h5>Upadate Division</h5></div>
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

                          
                    	<! Update Division >
                        <div class="form-group row">
                            <label for="edit_division" class="col-md-4 col-form-label text-md-right">Replace Division:</label>
                            <div class="col-md-6">
                                <input id="edit_division" type="text" class="form-control" name="edit_division"  autofocus placeholder="Replce Division">
                                <p> 
                                <?php
                                    if(isset($error_msg['edit_division1'])) 
                                        echo "<div class='error'>" . $error_msg['edit_division1']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['edit_division2'])) 
                                        echo "<div class='error'>" . $error_msg['edit_division2']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>

                        <! Update Division >
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Division
                                </button>

                                <?php 
                                    if(isset($_GET['success'])) { ?>
                                      <div class="edit-division" data-edit="<?= $_GET['success'];?>"></div>
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
                                  const edit = $('.edit-division').data('edit')
                                    if(edit){
                                      Swal.fire(
                                        'Success!',
                                        'Division was updated!',
                                        'success'
                                      )
                                    }

                                    const wrong = $('.not-edited').data('wrong')
                                    if(wrong){
                                      Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Division was not updated...!!!'
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