<?php
  $id = $_SESSION['id'];

  $sql = mysqli_query($connection , "SELECT * FROM donor_confirmation WHERE donor_id = '$id' AND status = 'true'");
  if(mysqli_num_rows($sql) == true)
  {
    $row = mysqli_fetch_array($sql);
    $post_id = $row['post_id'];
    header("location:.php?donor_id=".$id. "&post_id=".$post_id);//pop up menu confirm donation info
  }
?>



<?php
   include("connection.php"); // donor seeker post complete korar por eti info onujai search korbe,
   include("header.php");


        $id = $_GET['idd'];
        $post_id = $id;
        $id2 = $_SESSION['id'];
        $query = mysqli_query($connection , "SELECT * from donor_seeker_post where id = '$id' and seeker_id = '$id2' and status = 'live'");

        $row = mysqli_fetch_array($query);
        $date = $row['date']; //From donor_seeker_post.
        $check_date = date_create($date);
        date_modify($check_date , "-120 days");
        $eligible_date = date_format($check_date,"Y-m-d"); // final date
        $blood_group =  $row['blood_group'];
        $division =  $row['division'];
        $district =  $row['district'];
        $sub_district =  $row['sub_district_or_police_station'];
        $village_or_area =  $row['village_or_area'];

/* Query: Who are eligible to donate blood according to above info.*/

        //$sql = "SELECT * from donor_infos WHERE Blood_Group = '$blood_group' and Division = '$division' and District = '$district' and Sub_District_or_Police_Station = '$sub_district' and Village_or_Area = '$village_or_area' HAVING (select donation_infos.donor_id from donation_infos where donation_infos.Last_donate <= '$eligible_date' and donor_infos.id = donation_infos.donor_id)";


        $sql = "SELECT * from donor_infos WHERE  Division = '$division' and District = '$district'   HAVING (select donation_infos.donor_id from donation_infos where donation_infos.Last_donate <= '$eligible_date' and donor_infos.id = donation_infos.donor_id)";

         $result = mysqli_query($connection , $sql); 
?>  
<!DOCTYPE html>
<html>
<head>
        <title>Donor Seeker</title>
        <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <table class="table table-striped">
        <thead>
          <hr>
            <h4 style="text-align: center;">All Eligible Donor According to Your Information</h4>
            <hr>
         <tr>
           <th scope="col">First Name</th>
           <th scope="col">Last Name</th>
           <th scope="col">Blood Group</th>
           <th scope="col">Phone</th>
           <th scope="col">E-mail</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
        <?php     
            while($row2 = mysqli_fetch_array($result))
             {
        ?>
         
         <tr>
            <td>
                <?php echo $row2['First_Name']; ?>
            </td>
            <td>
                <?php echo $row2['Last_Name']; ?>
            </td>
            <td>
                <?php echo $row2['Blood_Group']; ?>
            </td>
            <td>
                <?php echo $row2['Phone']; ?>
            </td>
            <td>
                <?php echo $row2['E_mail']; ?>
            </td>
            <td>
                <a class="btn btn-info" href="search_eligible_donor.inc.php?id=<?php echo $row2['id'];?> &id2=<?php echo $post_id;?>">Send Mail</a>
                <?php 
                  if(isset($_GET['success']))
                  {
                    if($_GET['success'] == "mail" && $_GET['id'] == $row2['id'])
                    {
                       echo "<div class='error'>Mail Sent</div>";
                    }
                  }
                ?>
            </td>
        </tr>
            <?php
              } ?>
          <td></td>
          <td></td>
          <td>
          <?php
              if(mysqli_num_rows($result) == false)
                {
                    echo "<h5 style='text-align:center;'>No result found</h5>";
                } 
            ?> </td>
            <td></td>
            <td></td>
            <td></td>
        </tbody>
    </table>
    <div>
         <a class="btn btn-info" style="width: 100%;" href="search_eligible_donor.inc.php?id3=<?php echo $post_id;?>">Send Mail to All</a>
         <?php 
             if(isset($_GET['success']))
             {
               if($_GET['success'] == "mail" && $_GET['idd'] == $post_id)
               {
                  echo "<div class='error'>Mail Sent to</div>";
               }
             }
          ?>
    </div> 
</body>
</html>



 