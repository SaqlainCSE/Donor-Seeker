<?php 
    include("connection.php");
    ob_start();
    include("header.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="css/app.css">

    <title>Donation Confirmation</title>
  </head>
  <body>
        <table class="table table-striped">
       <thead>
        <hr>
         <h4 style="text-align: center;">You are Suppose to Donate Blood to Below Information.Please Check-out for get further blood donation notification.</h4> 
         <tr>
           <th scope="col">Blood Group</th>
           <th scope="col">Donation Place</th>
           <th scope="col">Donee Name</th>
           <th scope="col">Donee Contact</th>
           <th scope="col">Donation Date</th>
           <th scope="col">How Much Needed</th>
           <th scope="col">Check Out</th>
         </tr>
       </thead>
       <tbody> 
        <?php
        $id = $_SESSION['id'];
        $query = mysqli_query($connection,"SELECT * FROM donor_confirmation WHERE donor_id = '$id' OR seeker_id = '$id'");
        while($row = mysqli_fetch_array($query))
        {
          $post_id = $row['post_id'];
          $query2 = mysqli_query($connection,"SELECT * FROM donor_seeker_post WHERE id ='$post_id'");
          $row2 = mysqli_fetch_array($query2);
         
        ?>
         <tr>
            <td>
                <?php echo $row2['blood_group']; ?>
            </td>
            <td>
                <a href="post_details.php?id=<?php echo $row2['id'];?>" class="btn btn-link">
                  <?php echo $row2['details_of_your_area']; ?>
                </a>
            </td>
            <td>
                <?php echo $row2['donee_name']; ?>
            </td>
            <td>
                <?php echo $row2['donee_contact']; ?>
            </td>
            <td>
                <?php echo $row2['date']; ?>
            </td>
            <td>
                 <?php echo $row2['how_much_needed']; ?>
            </td>
             <td>
                <a class="btn btn-info" href="donation_info_confirmation.php?id=<?php echo $row['post_id'];?> &id2=<?php echo $row['donor_id'];?>">Donation Completed</a>
                <a class="btn btn-info btn-del" href="donation_info_confirmation.php?id3=<?php echo $row['post_id'];?>">Donee Cancel Request</a>
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
     <?php
        if(isset($_GET['id']) && isset($_GET['id2']))
        {
          $post_id = $_GET['id'];
          $donor_id = $_GET['id2'];

          $sql = mysqli_query($connection,"SELECT * FROM donor_seeker_post WHERE id = '$post_id'");
          $row = mysqli_fetch_array($sql);
          $donation_date = $row['date'];
          $donation_place = $row['details_of_your_area'];
          $donee_name = $row['donee_name'];
          $donee_contact = $row['donee_contact'];

          $sql2 = mysqli_query($connection,"INSERT INTO `donation_infos`(`post_id`, `donor_id`, `Last_donate`, `donee_location`, `donee_name`, `donee_contact`) VALUES ('$post_id' , '$donor_id' , '$donation_date' , '$donation_place' , '$donee_name' , '$donee_contact');");

          if($sql2)
          {
            $sql3 = mysqli_query($connection , "DELETE FROM `donor_confirmation` WHERE `post_id` = '$post_id'");
            if($sql3)
            {
              echo "delete";
              header("location:donation_info_confirmation.php?success=success");
              ob_end_flush();
            }
          }   
        }

        if(isset($_GET['id3']))
        {
          $post_id = $_GET['id3'];
          $sql3 = mysqli_query($connection , "DELETE FROM `donor_confirmation` WHERE `post_id` = '$post_id'");
          if($sql3)
            {
              echo "delete";
              header("location:donation_info_confirmation.php?delete=delete");
              ob_end_flush();
            }
        }
     ?>

          <?php
            if(isset($_GET['delete'])) { ?>
              <div class="delete-confirm" data-deleted="<?= $_GET['delete']; ?>">
              </div>
          <?php } 
                elseif(isset($_GET['success'])) { ?>
                  <div class="add-donation" data-added="<?= $_GET['success'];?>"></div>
                 <?php }
          ?>

            <script src="sweetAlert/jquery-3.5.0.min.js"></script>
            <script src="sweetAlert/sweetalert2.all.min.js"></script>

            <script>
            $('.btn-del').on('click' , function(e){
              e.preventDefault();
              const href = $(this).attr('href')
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                      document.location.href = href;
                    }
                })
            })
             const deleted = $('.delete-confirm').data('deleted')
                   if(deleted){
                       Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                 }
                const added = $('.add-donation').data('added')
                    if(added){
                      Swal.fire(
                        'Success!',
                        'Successfully added your donation info!',
                        'success'
                       )
                    }
               </script>


  </body>
</html>