<?php 
   include("connection.php"); //Date Wise Donation Info.
   ob_start();
   include("header.php");
    if($_POST)
    {
        $email = $_POST['email'];
        $error_msg = array();
        $query = "SELECT * from donor_infos where E_mail = '$email'";
        $query_check = mysqli_query($connection,$query);
        $row = mysqli_fetch_array($query_check);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
         $error_msg['email1'] = "E-mail Address is Required.";
        }
        if ($query_check)
        {
            if(mysqli_num_rows($query_check) == false)
            {
                $error_msg['email2'] = "E-mail does not exist.Please try again...";
            }
        }
        if(count($error_msg) == 0)
        {
          header("location:donor_mail_wise_donation_info.inc.php?email=".$email);
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
                <div class="card-header"><h5>Donor E-mail Wise Donation Info</h5></div>
                <div class="card-body">
                    <form method="POST" action="">
                        <! Date >
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Donor E-mail:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"placeholder="example@example.com" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
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