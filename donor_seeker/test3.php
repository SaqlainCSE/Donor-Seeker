<?php 
  include("connection.php"); // any user can see his/her profile
  include("header.php");
  $id = $_SESSION['id'];
  $query = mysqli_query($connection,"SELECT * from donor_infos where id = '$id'");
  $rowName = mysqli_fetch_array($query);
  $name = $rowName['First_Name']." ".$rowName['Last_Name']; 
?>
<!DOCTYPE html>
<html>
<head>
        <title>Profile</title>
        <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

  <hr>
    <h4 style="text-align: center;"><?php echo $name;?> Full Profile</h4>
    <hr style="margin-bottom: 50px;">
    <div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="card">
      <div class="card-header"><h5 style="text-align: center;">Full Details of <?php echo $name;?></h5></div>
        <div class="card-body">
           <table class="table table-striped">
            <tbody>
              <?php 
              $query = mysqli_query($connection,"SELECT * from donor_infos where id = '$id'");
               while($row = mysqli_fetch_array($query))
                {
                  
              ?>
              <tr>
                <td>First Name</td>
                <td>
                  <?php echo $row['First_Name'] ?>
                </td>
              </tr>
              <tr>
                <td>Last Name</td>
                <td>
                  <?php echo $row['Last_Name'] ?>
                </td>
              </tr>
              <tr>
                <td>Blood Group</td>
                <td>
                  <?php echo $row['Blood_Group'] ?>
                </td>
              </tr>
              <tr>
                <td>Gender</td>
                <td>
                  <?php echo $row['Gender'] ?>
                </td>
              </tr>
              <tr>
                <td>Date of Birth</td>
                <td>
                  <?php echo $row['Date_of_Birth'] ?>
                </td>
              </tr>
              <tr>
                <td>Weight</td>
                <td>
                  <?php echo $row['Weight'] ?>
                </td>
              </tr>
              <tr>
                <td>Division</td>
                <td>
                  <?php echo $row['Division'] ?>
                </td>
              </tr>
              <tr>
                <td>District</td>
                <td>
                  <?php echo $row['District'] ?>
                </td>
              </tr>
              <tr>
                <td>Sub-district/Police Station</td>
                <td>
                  <?php echo $row['Sub_District_or_Police_Station'] ?>
                </td>
              </tr>
              <tr>
                <td>Village/Area</td>
                <td>
                  <?php echo $row['Village_or_Area'] ?>
                </td>
              </tr>
              <tr>
                <td>Details of Your Area</td>
                <td>
                  <?php echo $row['Details_of_Your_Area'] ?>
                </td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>
                  <?php echo $row['Phone'] ?>
                </td>
              </tr>
              <tr>
                <td>E-mail</td>
                <td>
                  <?php echo $row['E_mail'] ?>
                </td>
              </tr>
              <tr>
                <td>Role</td>
                <td>
                  <?php echo $row['Role'] ?>
                </td>
              </tr>
               <?php
                   }
                ?>
            </tbody>
         </table>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
      <div class="card-header"><h5 style="text-align: center;">User Panel</h5></div>
        <div class="card-body">

          <a href="delete_own_profile.php" class="btn btn-link">Delete Profile</a>
          <a href="update_own_profile.php" class="btn btn-link">Update Profile</a>
          <a href="blood_donation_history_user_wise.php" class="btn btn-link">Blood Donation History</a>
          <a href="blood_taken_history_user_wise.php" class="btn btn-link">Blood Taken History</a>
          <a href="password_change_user_wise.php" class="btn btn-link">Change Password</a>

        </div>
      </div>
    </div>
  </div>
</div>
    
</body>
</html>