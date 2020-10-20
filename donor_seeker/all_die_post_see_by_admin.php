<?php 
    include("connection.php"); // Admin can see all die post
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
        if(isset($_GET['id3']))
        {
        ?>
        <table class="table table-striped">
       <thead>
        <hr>
         <h4 style="text-align: center;">All Die Post</h4>
         <hr> 
      <?php
          if(isset($_SESSION['user']) && $_SESSION['role'] == "admin"){ ?>
          <div class="container">
             <a class="btn btn-white" href="seeking_post_of_user.php?id=<?php echo $_SESSION['id'];?>">Own Post</a>
            <a class="btn btn-white" href="all_live_post_see_by_admin.php?id2=<?php echo $_SESSION['id'];?>">All Live Post</a>
            <a class="btn btn-white" href="all_die_post_see_by_admin.php?id3=<?php echo $_SESSION['id'];?>">All Die Post</a>
          </div>
          <?php
              }?>
         <tr>
           <th scope="col">Blood Group</th>
           <th scope="col">Donation Place</th>
           <th scope="col">Donee Name</th>
           <th scope="col">Donee Contact</th>
           <th scope="col">Donation Date</th>
           <th scope="col">How Much Needed</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody> 
        <?php
        $id = $_SESSION['id'];
        $query = mysqli_query($connection,"SELECT * from donor_seeker_post where status ='die'");
        while($row = mysqli_fetch_array($query))
        {
         
        ?>
         <tr>
            <td>
                <?php echo $row['blood_group']; ?>
            </td>
            <td>
                <?php echo $row['details_of_your_area']; ?>
            </td>
            <td>
                <?php echo $row['donee_name']; ?>
            </td>
            <td>
                <?php echo $row['donee_contact']; ?>
            </td>
            <td>
                <?php echo $row['date']; ?>
            </td>
            <td>
                 <?php echo $row['how_much_needed']; ?>
            </td>
             <td>
                <! toastr msg >
                <a class="btn btn-info" href="update_seeking_post.php?id=<?php echo $row['id'];?>">Update</a>
            </td>
          </tr>
            <?php
              }
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
  </body>
</html>