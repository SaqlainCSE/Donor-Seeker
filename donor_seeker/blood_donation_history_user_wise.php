<?php 
    include("connection.php");
    include("header.php"); 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
    <?php
        $id = $_SESSION['id'];
        $query = mysqli_query($connection,"SELECT * from donation_infos where donor_id = '$id'");
        $sql = mysqli_query($connection , "SELECT * from donor_infos where id ='$id'");
        $rowName = mysqli_fetch_array($sql);
        $name = $rowName['First_Name']."  ".$rowName['Last_Name']." ";
        $rowcount = mysqli_num_rows($query);
    ?>
     <table class="table table-striped">
       <thead>
        <hr>
       <h4 style="text-align: center;">
          <?php echo $name;?>Blood Donation History
        </h4>
        
         <tr>
           <th scope="col">Donee Name</th>
           <th scope="col">Donation Place</th>
           <th scope="col">Donee Contact</th>
           <th scope="col">Donation Date</th>
           <th scope="col">Reference</th>
         </tr>
       </thead>
       <tbody>
        <?php 
                for($i = 1; $i <= $rowcount; $i++)
                {
                  $row = mysqli_fetch_array($query);
        ?>
         
         <tr>
            <td>
                <?php echo $row['donee_name'] ?>
            </td>
            <td>
            <a href="post_details.php?id=<?php echo $row['post_id'];?>" class="btn btn-link">
                <?php echo $row['donee_location']; ?>
            </a>
            </td>
            <td>
                <?php echo $row['donee_contact']; ?>
            </td>
            <td>
                <?php echo $row['Last_donate']; ?>
            </td>
             <td>
                <a class="btn btn-white" href="reference.php?id=<?php echo $row['post_id'];?>">View Profile</a>
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
  </body>
</html>