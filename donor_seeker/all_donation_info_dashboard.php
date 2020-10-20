 <?php
    include("connection.php");
    include("header.php");
?>

<!DOCTYPE html>
<html>
<head>
          <title>All Donation</title>
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
                 <div class="card-header">
                    <a class="btn btn-link" href="date_wise_donation_info_see_by_admin.php">Date Wise Info</a>
                    <a class="btn btn-link" href="place_wise_donation_info.php">Place Wise Info</a>
                    <a class="btn btn-link" href="donor_mail_wise_donation_info.php">Donor E-mail Wise Info</a>
                    <a class="btn btn-link" href="donee_mail_wise_donation_info.php">Donee E-mail Wise Info</a>
                </div>
                <div class="card-body">
         <table class="table table-striped">
         <thead>
          <hr>
        <h4 style="text-align: center;">All Donation Info
        </h4>
         <tr>
           <th scope="col">Donor Name</th>
           <th scope="col">Donation Date</th>
           <th scope="col">Donation Place</th>
           <th scope="col">Donee Name</th>
           <th scope="col">Post Details</th>
         </tr>
       </thead>
       <tbody>
         <?php
        $query = mysqli_query($connection,"SELECT * from donation_infos ");
        while($row = mysqli_fetch_array($query))
        {
            $id = $row['donor_id'];
            $id2 = $row['post_id'];
            $sql = mysqli_query($connection , "SELECT * from donor_infos where id ='$id'");
            $sql2 = mysqli_query($connection , "SELECT * from donor_seeker_post where id ='$id2'");
            $rowName = mysqli_fetch_array($sql);
            $name = $rowName['First_Name']."  ".$rowName['Last_Name']." ";
            $row2 = mysqli_fetch_array($sql2);
            $id3 = $row2['seeker_id'];
        ?>
        <tr>
            <td>
                <a class="btn btn-link" href="view_user_full_profile_by_admin.php?id=<?php echo $id;?>">
                <?php echo $name; ?>
                </a>
            </td>
            <td>
                <?php echo $row['Last_donate']; ?>
            </td>
            <td>
                <?php echo $row['donee_location']; ?>
            </td>
            <td>
            <a href="reference.php?id=<?php echo $id3;?>">
                <?php echo $row['donee_name']; ?>
            </a>
            </td>
            <td>
            <a href="post_details.php?id=<?php echo $id2;?>" class="btn btn-link">
                View Post
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