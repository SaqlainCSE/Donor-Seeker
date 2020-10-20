<?php 
   include("connection.php"); //Date Wise Donation Info.
   ob_start();
   include("header.php");
    if($_POST)
    {
        $place = $_POST['place'];
        $error_msg = array();
        if(empty($place))
        {
            $error_msg['place'] = "Donation Place is Required";
        }
        if(count($error_msg) == 0)
        {
          header("location:place_wise_donation_info.inc.php?place=".$place);
          ob_end_flush();
        }
     }
        
?>
<!DOCTYPE html>
<html>
<head>
        <title>Date Wise Donation Info</title>
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
                <div class="card-header"><h5>Place Wise Donation Info</h5></div>
                <div class="card-body">
                    <form method="POST" action="">
                        <! Place >
                        <div class="form-group row">
                            <label for="place" class="col-md-4 col-form-label text-md-right">Donation Place:</label>

                            <div class="col-md-6">
                                <input id="place" type="text" class="form-control" name="place"placeholder="Donation Place" value="<?php if(isset($_POST['place'])) echo $_POST['place']; ?>">
                                <p>
                                    <?php
                                    if(isset($error_msg['place'])) {
                                        echo "<div class='error'>" . $error_msg['place']. "</div>";
                                        ?>
                                        <div class="not-added" data-wrong="<?= $error_msg['place']; ?>"> 
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
                                                text: 'Place  was not submitted...!!!'
                                              })
                                        }
                                     </script>
                                    ?>
                                </p>
                            </div>
                        </div>

                        <! Search Button >
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Search
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