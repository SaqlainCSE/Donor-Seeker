<?php
    include("connection.php");
    ob_start();
    include("header.php");
     if($_POST)
    {
        $division = $_POST['division'];
        $error_msg = array();
        $query = "SELECT * from division_infos where Division = '$division'";
        $query_check = mysqli_query($connection,$query);
        if(empty($_POST['division']))
        {
         $error_msg['division1'] = "Division is Required.";
        }
        if(!preg_match("/^[a-zA-Z]*$/", $division)) 
        {
         $error_msg['division2'] = "Only letters allowed";
        }
        if ($query_check)
        {
            if(mysqli_num_rows($query_check) > 0)
            {
                $error_msg['division3'] = "Division is already exist.Please try another.";
            }
        }
         
        if(count($error_msg) == 0)
        {
            $division = $_POST['division'];
            $sql=mysqli_query($connection , "INSERT into division_infos (`Division`) values('$division')");
            if(!$sql)
            {
               /* Not Insert */
                header("location:add_division.php?error=error");
                ob_end_flush();
            }
            else
            {
               /* Insert */
                header("location:add_division.php?success=success");
                ob_end_flush();
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
          <title>Add Division</title>
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
                <div class="card-header"><h5>Add Division</h5></div>
                <div class="card-body">
                    <form method="POST" action="">
                    	<! Add Division >
                        <div class="form-group row">
                            <label for="division" class="col-md-4 col-form-label text-md-right">Division:</label>
                            <div class="col-md-6">
                                <input id="division" type="text" class="form-control" name="division"  autofocus placeholder="Enter New Division">
                                <p> 
                                <?php
                                    if(isset($error_msg['division1'])) 
                                        echo "<div class='error'>" . $error_msg['division1']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['division2'])) 
                                        echo "<div class='error'>" . $error_msg['division2']. "</div>";
                                ?> 
                                </p>
                                <p> 
                                <?php
                                    if(isset($error_msg['division3'])) 
                                        echo "<div class='error'>" . $error_msg['division3']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>

                        <! Add Division >
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Division
                                </button>

                                <?php 
                                    if(isset($_GET['success'])) { ?>
                                      <div class="add-division" data-added="<?= $_GET['success'];?>"></div>
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
                                  const added = $('.add-division').data('added')
                                    if(added){
                                      Swal.fire(
                                        'Success!',
                                        'Division was added!',
                                        'success'
                                      )
                                    }

                                    const wrong = $('.not-added').data('wrong')
                                    if(wrong){
                                      Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Division was not added...!!!'
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