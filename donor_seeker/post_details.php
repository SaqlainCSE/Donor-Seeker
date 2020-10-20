 <?php 
  include("connection.php"); // Admin can see post details of any user
  include("header.php"); 
?>
<!DOCTYPE html>
<html>
<head>
        <title>Post Details</title>
        <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>  
  <?php
    $id = $_GET['id'];
    $query = mysqli_query($connection,"SELECT * FROM `donor_seeker_post` WHERE id = '$id'");
  ?>
  <hr>
  <h4 style="text-align: center;">Post Details</h4>
  <hr>
   <div class="container">
    
         <table class="table table-striped">
          
        
            <tbody>
              <?php 
               while($row = mysqli_fetch_array($query))
                {
                  
              ?>
             <tr>
                <td>Blood Group</td>
                <td>
                  <?php echo $row['blood_group'] ?>
                </td>
              </tr>
              <tr>
                <td>Division</td>
                <td>
                  <?php echo $row['division'] ?>
                </td>
              </tr>
              <tr>
                <td>District</td>
                <td>
                  <?php echo $row['district']?>
                </td>
              </tr>
              <tr>
                <td>Police Station/Sub-district</td>
                <td>
                  <?php echo $row['sub_district_or_police_station'] ?>
                </td>
              </tr>
               <tr>
                <td>Area/Village</td>
                <td>
                  <?php echo $row['village_or_area'] ?>
                </td>
              </tr>
              <tr>
                <td>Donation Place</td>
                <td>
                  <?php echo $row['details_of_your_area'] ?>
                </td>
              </tr>
              <tr>
                <td>Donee Name</td>
                <td>
                  <?php echo $row['donee_name'] ?>
                </td>
              </tr>
              <tr>
                <td>Donee Contact</td>
                <td>
                  <?php echo $row['donee_contact'] ?>
                </td>
              </tr>
              <tr>
                <td>Donee E-mail</td>
                <td>
                  <?php echo $row['donee_mail'] ?>
                </td>
              </tr>
              <tr>
                <td>Donation Date</td>
                <td>
                  <?php echo $row['date'] ?>
                </td>
              </tr>
              <tr>
                <td>Donation Time</td>
                <td>
                  <?php echo $row['time'] ?>
                </td>
              </tr>
             <tr>
                <td>How Much Needed</td>
                <td>
                  <?php echo $row['how_much_needed'] ?>
                </td>
              </tr>
              <tr>
                <td>Post Status</td>
                <td>
                  <?php echo $row['status'] ?>
                </td>
              </tr>
               <?php
                   }
                ?>
             <td></td>
             <td></td>
             <td>
            <?php
              if(mysqli_num_rows($query) == false)
                {
                    echo "<h5 style='text-align:center;'>No result found</h5>";
                } 
            ?> </td>
              <td></td>
              <td></td>
              <td></td>
            </tbody>
         </table>
       </div>
</body>
</html>