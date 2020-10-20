<?php 
	include("connection.php"); // Any user can see refernce/seeker (jare blod dice)
  include("header.php"); 
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
  	$query = mysqli_query($connection,"SELECT * from donor_seeker_post where id = '$id'");
    $row = mysqli_fetch_array($query);
    $sql = mysqli_query($connection,"SELECT * from donor_infos where id = '".$row['seeker_id']."'");
    $rowcount = mysqli_num_rows($sql);
    $rowName = mysqli_fetch_array($sql);
    $name = $rowName['First_Name']." ".$rowName['Last_Name']." ";
	?>
	
	 <div class="container">
         <table class="table table-striped">
          <hr>
          <h4 style="text-align: center;"><?php echo $name; ?> was requested to donate blood to <?php echo $row['donee_name'];?></h4>
          <hr>
            <tbody>
              <?php
              $sql = mysqli_query($connection,"SELECT * from donor_infos where id = '".$row['seeker_id']."'");
              $rowcount = mysqli_num_rows($sql);

                for($i = 1; $i <= $rowcount; $i++)
                {
                  $row = mysqli_fetch_array($sql);
              ?>
              <tr>
                <td>First Name</td>
                <td>
                  <?php echo $row['First_Name']; ?>
                </td>
              </tr>
              <tr>
                <td>Last Name</td>
                <td>
                  <?php echo $row['Last_Name']; ?>
                </td>
              </tr>
              <tr>
                <td>Blood Group</td>
                <td>
                  <?php echo $row['Blood_Group']; ?>
                </td>
              </tr>
              <tr>
                <td>District</td>
                <td>
                  <?php echo $row['District']; ?>
                </td>
              </tr>
              <tr>
                <td>Police Station/Sub-district</td>
                <td>
                  <?php echo $row['Sub_District_or_Police_Station']; ?>
                </td>
              </tr>
              <tr>
                <td>Area/Village</td>
                <td>
                  <?php echo $row['Village_or_Area']; ?>
                </td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>
                  <?php echo $row['Phone']; ?>
                </td>
              </tr>
              <tr>
                <td>E-mail</td>
                <td>
                  <?php echo $row['E_mail']; ?>
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