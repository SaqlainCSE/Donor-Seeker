<?php 
   include("connection.php"); // home page e dekabe
?>
<!DOCTYPE html>
<html>
<head>
        <title>Post Show At Home Page</title>
        <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
  <div class="container">
    <?php
        $date = date("Y-M-D");
        $query = mysqli_query($connection , "SELECT * FROM donor_seeker_post WHERE `date` = '$date' AND status = 'live'");
        
        while($row = mysqli_fetch_array($query))
        {
           $message = "<br><br><p>New Blood Donation Request From:-<br>"."<strong>Donee Name: </strong>".$row['donee_name']."<br>"."<strong> Blood Group: </strong>".$row['blood_group']."<br>"."<strong>District: </strong>".$row['district']."<br>"."<strong>Sub-District/Police Station: </strong>".$row['sub_district_or_police_station']."<br>"."<strong>Area/Village: </strong>".$row['village_or_area']."<br>"."<strong>Donation Place/Hospital: </strong>".$row['details_of_your_area']."<br>"."<strong>Contact: </strong>".$row['donee_contact']."<br>"."<strong>Date: </strong>".$row['date']."<br>"."<strong>Time: </strong>".$row['time']."</p>"; //Post id print korte hbe.
           echo $message;
           $id = $row['id'];
           ?>
           <a href="donor_accept_request.php?id=<?php echo $id;?>" class="btn btn-info" style="background-color:;">I Want to Donate</a>
     <?php      
        }    
    ?> 
    <div style="margin-top: 70px;">
      <hr>
      <?php
          if(mysqli_num_rows($query) == false)
          {
            echo "<h4 style='text-align: center;'>No seeking post found for today</h4>";
          }
        ?>
    </div>

    <hr style="margin-bottom: 200px;">
  </div>
</body>
</html>