<?php 
	include("connection.php"); // Admin can see user profile
  include("header.php"); 
  $id = $_GET['id'];
  $query = mysqli_query($connection,"SELECT * from deleted_donor_infos where id = '$id'");
  $row = mysqli_fetch_array($query);
  $name = $row['First_Name']." ".$row['Last_Name'];
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
	 <div class="container">
           
    </div><p></p><p></p>
	<?php
    $id = $_GET['id'];
  	$query = mysqli_query($connection,"SELECT * from deleted_donor_infos where id = '$id'");
  	//$rowcount = mysqli_num_rows($query);
	?>
	
	 <div class="container">
         <table class="table table-striped">
          <hr>
              <h4 style="text-align: center;"><?php echo $name;?> Details Information</h4>
              <hr>
            <tbody>
              <?php 
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
               <tr>
                <td>Deleted Date</td>
                <td>
                  <?php echo $row['deleted_at'] ?>
                </td>
              </tr>
               <?php
                   }
                ?>
            </tbody>
         </table>
       </div>
</body>
</html>