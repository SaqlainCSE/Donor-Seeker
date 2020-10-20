<?php 
   include("connection.php"); // all info dash board see by admin of specific user
   include("header.php");
   $id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
        <title>User</title>
        <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
                <div class="card-header"><h5>User Details</h5></div>
                <div class="card-body">
                    <form method="POST" action="">
                         
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                 <div>
                                     <a class="btn btn-white" href="view_user_full_profile_by_admin.php?id=<?php echo $id;?>">View Full Profile</a>
                                 </div>
                                 <div>
                                     <a class="btn btn-white" href="blood_donation_history_see_by_admin.php?id=<?php echo $id;?>">Blood Donation History</a>
                                 </div>
                                 <div>
                                     <a class="btn btn-white" href="blood_taken_history_see_by_admin.php?id=<?php echo $id;?>">Blood Taken History</a>
                                 </div>
                                 <div>
                                     <a class="btn btn-white" href="user_all_post_see_by_admin.php?id=<?php echo $id;?>">Seeking Post Details</a>
                                 </div>
                                 <div>
                                     <a class="btn btn-white" href="update_user_profile_by_admin.php?id=<?php echo $id;?>">Update Profile</a>
                                 </div>
                                 <div>
                                     <a class="btn btn-white btn-del" href="delete_user_by_admin.php?id=<?php echo $id;?>">Delete Profile</a>
                                 </div>
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

    <?php
           /* Delete Sweet Alert Start */
               if(isset($_GET['error'])) { ?>
               <div class="not-delete" data-wrong="<?= $_GET['error']; ?>"> 
               </div>
        <?php }
            
        ?>


          <!-- Delete Sweet Alert Start  -->
            <script src="sweetAlert/jquery-3.5.0.min.js"></script>
            <script src="sweetAlert/sweetalert2.all.min.js"></script>

            <script>
            $('.btn-del').on('click' , function(e){
              e.preventDefault();
              const href = $(this).attr('href')
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                      document.location.href = href;
                    }
                })
            })
             const deleted = $('.delete-confirm').data('deleted')
                   if(deleted){
                       Swal.fire(
                      'Deleted!',
                      'Your profile has been deleted.',
                      'success'
                    )
                 }
             const wrong = $('.not-delete').data('wrong')
              if(wrong){
                Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Profile was not delete...!!!'
                    })
              }
            </script>


</body>
</html>