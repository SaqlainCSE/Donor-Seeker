<?php 
   include("connection.php"); // Admin can update profile by mail
   include("header.php");
   function send_mail($message,$id)
                {
                    include("connection.php");
                    $query =  mysqli_query($connection , "SELECT * from donor_infos where id = '$id'");
                    $row = mysqli_fetch_array($query);
                    echo $row['E_mail'];
                    //echo $message;
                    echo " --Mail Sent-- ";
                    echo $id;
                    /*Mail Sent According to ID*/
                }
   
            $blood_group = $_GET['blood_group'];
            $Division = $_GET['division'];
            $sql1 = mysqli_query($connection , "SELECT * from division_infos where id = '$Division'");
            $Division_sql = mysqli_fetch_array($sql1);
            $division = $Division_sql['Division'];
            $District = $_GET['district'];
            $sql2 = mysqli_query($connection , "SELECT * from district_infos where id = '$District'");
            $District_sql = mysqli_fetch_array($sql2);
            $district = $District_sql['District'];

            $date = date("y-m-d"); //From donor_seeker_post.
            $check_date = date_create($date);
            date_modify($check_date , "-120 days");
            $eligible_date = date_format($check_date,"Y-m-d"); // final date
    
            $sql = "SELECT * from donor_infos WHERE  Blood_Group =  '$blood_group' AND Division = '$division' AND District = '$district' HAVING (select donation_infos.donor_id from donation_infos where donation_infos.Last_donate <= '$eligible_date' and donor_infos.id = donation_infos.donor_id)";
                $result = mysqli_query($connection , $sql);
                
               /* if($row2 = mysqli_fetch_array($result))
                {
                    //echo "ok";
                $rowcount = mysqli_num_rows($result);*/
?>  
 
    <table class="table table-striped">
        <thead>
            <h4 style="text-align: center;">All Eligible Donor According to <?php echo $district;?> District</h4>
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
                //$row2 = mysqli_fetch_array($result);
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
                <a class="btn btn-info" href="district_wise_seeking_post.inc.php?id=<?php echo $row2['id'];?>">Send Mail</a>
                <?php 
                    $message = array();
                    //$id = $_SESSION['id'];
                    //$query = mysqli_query($connection , "SELECT * from donor_seeker_post where seeker_id = '$id' and status = 'live'");
                    //$row = mysqli_fetch_array($query);
                    //$bag = $row['how_much_needed']; post id o msg te jbe
                    //$message['msg'] = "Dear Donor,hope you are well. You are requested to donate blood to:-"."<br>"."<strong>Post ID: </strong>".$row['id']."<br>"."<strong>Donee Name: </strong>".$row['donee_name']."<br>"."<strong> Blood Group: </strong>".$row['blood_group']."<br>"."<strong>Hospital/Donate Place: </strong>".$row['details_of_your_area']."<br>"."<strong>District: </strong>".$row['district']."<br>"."<strong>Sub-District/Police Station: </strong>".$row['sub_district_or_police_station']."<br>"."<strong>Area/Village: </strong>".$row['village_or_area']."<br>"."<strong>Donation Place/Hospital: </strong>".$row['details_of_your_area']."<br>"."<strong>Contact: </strong>".$row['donee_contact']."<br>"."<strong>Date: </strong>".$row['date']."<br>"."<strong>Time: </strong>".$row['time'];
                    //echo $message['msg']; 
                      //echo $row2['E_mail'];// Mail Korbo Eikhane.
                    //send_mail($row2['E_mail'],$message['msg']);
                   /* if(isset($_GET['id']))
                    {
                        send_mail($row2['E_mail'],$message['msg']);
                    }*/
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
        <?php

              if(isset($_GET['id']))
                    {
                        send_mail($message['msg'],$_GET['id']);//individual
                    }



                if(isset($_GET['id2']))
                {
                    $result = mysqli_query($connection , $sql);
                  for($i = 1; $i <= $rowcount; $i++)
                    {
                      $row = mysqli_fetch_array($result);
                      ?>
                       
                        <td>
                            <?php echo $row['id'];
                            //echo $row['E_mail'];
                            //echo $message['msg'];
                            //send_mail($row2['E_mail'],$message['msg']);
                            send_mail($message['msg'],$row['id']);//all id
                            ?>
                        </td>
                      
            <?php 

                  }
              }
          ?>
    </table>
    <div>
         <a class="btn btn-info" style="width: 100%;" href="district_wise_seeking_post.inc.php?id2=<?php echo $row2['id'];?>">Send Mail to All</a>
    </div> 
<!DOCTYPE html>
<html>
<head>
        <title>Division Wise Donor</title>
        <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
          
</head>
<body>
 
</body>
</html>