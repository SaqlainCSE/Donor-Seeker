<?php 
   include("connection.php"); // home page e dekabe
   include("header.php");
   $id = $_SESSION['id'];


/* For checking any seeking request accept or seeking post posted */ 
  $query = mysqli_query($connection,"SELECT * FROM donor_confirmation WHERE status = 'true'");
  while($row = mysqli_fetch_array($query))
  {
    $donor_id = $row['donor_id'];
    $seeker_id = $row['seeker_id'];
    if($donor_id == $id || $seeker_id == $id)
    {
      header("location:donation_info_confirmation.php");
    }
  }
/* For checking any seeking request accept or seeking post posted */


   $query = mysqli_query($connection , "SELECT * from donor_infos where id = '$id'");
   $row = mysqli_fetch_array($query);
   $name = $row['First_Name']."  ".$row['Last_Name']." ";
?>
<!DOCTYPE html>
<html>
<head>
        <title>Post Show</title>
        <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
  <div class="container">
    <hr>
    <h4 style="text-align: center;">All Seeking Post Acording to <?php echo $name;?> Area</h4>
    <hr>
    <a href="search_post.inc.php" class="btn btn-info">Search Post</a>
    <hr>
    <?php

        $district = $row['District'];
        $sub_district = $row['Sub_District_or_Police_Station'];
        //$village = $row['Village_or_Area'];

        //$sql = mysqli_query($connection , "SELECT * from donor_seeker_post where district = '$district' AND sub_district_or_police_station = '$sub_district' AND village_or_area = '$village' AND status = 'live'");

        $sql = mysqli_query($connection , "SELECT * from donor_seeker_post where district = '$district' AND sub_district_or_police_station = '$sub_district' AND status = 'live'");
        
        while($row = mysqli_fetch_array($sql))
        {
           $message = "<br><br><p>New Blood Donation Request From:-<br>"."<strong>Donee Name: </strong>".$row['donee_name']."<br>"."<strong> Blood Group: </strong>".$row['blood_group']."<br>"."<strong>District: </strong>".$row['district']."<br>"."<strong>Sub-District/Police Station: </strong>".$row['sub_district_or_police_station']."<br>"."<strong>Area/Village: </strong>".$row['village_or_area']."<br>"."<strong>Donation Place/Hospital: </strong>".$row['details_of_your_area']."<br>"."<strong>Contact: </strong>".$row['donee_contact']."<br>"."<strong>Date: </strong>".$row['date']."<br>"."<strong>Time: </strong>".$row['time']."</p>"; //Post id print korte hbe.
           echo $message;
           $id = $row['id'];
           ?>
           <a href="donor_accept_request.php?id=<?php echo $id;?>" class="btn btn-info">I Want to Donate</a>
     <?php      
        }

         if(mysqli_num_rows($sql) == false)
          {
              echo "<h5 style='text-align:center;'>No result found</h5>";
          }     
    ?>
  </div>
</body>
</html>