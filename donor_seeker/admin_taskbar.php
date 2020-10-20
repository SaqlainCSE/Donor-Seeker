<?php
    include("connection.php");
    include("header.php");

    /* For deleted specific user */
    if(isset($_GET['success'])) { ?>
      <div class="delete-confirm" data-deleted="<?= $_GET['success']; ?>">
              
      </div>

      <!-- Delete Sweet Alert Start  -->
            <script src="sweetAlert/jquery-3.5.0.min.js"></script>
            <script src="sweetAlert/sweetalert2.all.min.js"></script>
            <script>
             const deleted = $('.delete-confirm').data('deleted')
                   if(deleted){
                       Swal.fire(
                      'Deleted!',
                      'Your profile has been deleted.',
                      'success'
                    )
                 }
            </script>


<?php }
?>


<!DOCTYPE html>
<html>
<head>
          <title>Add District</title>
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
                <div class="card-header">Add District</div>
                <div class="card-body">
                  
                   <table class="table table-striped">
         <thead>
          <hr>
        <h4 style="text-align: center;">All Active Admin
        </h4>
         <tr>
           <th scope="col">Name</th>
           <th scope="col">District</th>
           <th scope="col">Police Station</th>
           <th scope="col">Blood Group</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
         <?php
        $query = mysqli_query($connection,"SELECT * from donor_infos where Role = 'admin' AND status = 'active'");
        while($row = mysqli_fetch_array($query))
        {
        ?>
        <tr>
            <td>
                 <?php echo $row['First_Name']." ".$row['Last_Name']; ?>
            </td>
            <td>
                <?php echo $row['District']; ?>
            </td>
            <td>
                <?php echo $row['Sub_District_or_Police_Station']; ?>
            </td>
            <td>
                <?php echo $row['Blood_Group']; ?>
            </td>
            <td>
            <a href="view_user_full_profile_by_admin.php?id=<?php echo $row['id'];?>" class="btn btn-link">
                View Profile
            </a>
            </td>
          </tr>
            <?php 
                }
              ?>     
             </tbody> 
             </table>
             <?php
              if(mysqli_num_rows($query) == false)
                {
                    echo "<h5 style='text-align:center;'>No result found</h5>";
                } 
                ?>

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