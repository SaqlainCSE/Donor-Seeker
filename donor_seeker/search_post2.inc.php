<?php 
   include("connection.php"); // home page e dekabe
   include("header.php");
   $id = $_SESSION['id'];
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
    <h4 style="text-align: center;">All Seeking Post Acording to <?php echo $name;?> Search</h4>
    <hr>
    <a href="search_post.php" class="btn btn-info"><?php echo $name;?> Area's Post</a>
    <hr>
    <?php

        $blood_group = $_GET['blood_group'];
        $Division = $_GET['division'];
        $sql1 = mysqli_query($connection , "SELECT * from division_infos where id = '$Division'");
        $Division_sql = mysqli_fetch_array($sql1);
        $division = $Division_sql['Division'];
        $District = $_GET['district'];
        $sql2 = mysqli_query($connection , "SELECT * from district_infos where id = '$District'");
        $District_sql = mysqli_fetch_array($sql2);
        $district = $District_sql['District'];
        $Sub_District_or_Police_Station = $_GET['sub_district'];
        $sql3 = mysqli_query($connection , "SELECT * from sub_district_infos where id = '$Sub_District_or_Police_Station'");
        $Sub_District_or_Police_Station_sql = mysqli_fetch_array($sql3);
        $sub_district = $Sub_District_or_Police_Station_sql['Sub_District_or_Police_Station'];

        $sql = mysqli_query($connection , "SELECT * from donor_seeker_post where blood_group = '$blood_group' AND district = '$district' AND sub_district_or_police_station = '$sub_district' AND status = 'live'");

        
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