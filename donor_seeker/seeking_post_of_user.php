<?php 
    include("connection.php"); // own post see by any user
    include("header.php");

/* For checking any seeking request accept or seeking post posted */
  $id = $_SESSION['id']; 
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
        $query = mysqli_query($connection,"SELECT * from donor_seeker_post where seeker_id = '$id' and status ='live'");
        $sql = mysqli_query($connection , "SELECT * from donor_infos where id ='$id'");
        $rowName = mysqli_fetch_array($sql);
        $name = $rowName['First_Name']."  ".$rowName['Last_Name']." ";
      if(isset($_SESSION['user']))
      {
        ?>
        <table class="table table-striped">
       <thead>
        <hr>
        <h4 style="text-align: center;"><?php echo $name;?>Live Post</h4>
        
        <?php
      if(isset($_SESSION['user']) && $_SESSION['role'] == "admin"){ ?>
        <hr>
          <div class="container">
            <a class="btn btn-white" href="all_live_post_see_by_admin.php?id2=<?php echo $_SESSION['id'];?>">All Live Post</a>
            <a class="btn btn-white" href="all_die_post_see_by_admin.php?id3=<?php echo $_SESSION['id'];?>">All Die Post</a>
          </div>
          <?php
              }
            ?>

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
        //$id = $_SESSION['id'];
        //$query = mysqli_query($connection,"SELECT * from donor_seeker_post where seeker_id = '$id' and status ='live'");
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
                <a class="btn btn-danger btn-del" href="delete_seeking_post.php?idd=<?php echo $row['id'];?>">Delete</a>
              
                <a class="btn btn-info" href="update_seeking_post.php?id=<?php echo $row['id'];?>">Update</a>
            </td>
          </tr>
            <?php
              }
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

          <?php
              if(isset($_GET['error'])) { ?>
               <div class="not-delete" data-wrong="<?= $_GET['error']; ?>"> 
               </div>
          <?php 
              } ?>

           <?php
           /* Delete Sweet Alert Start */
             if(isset($_GET['success'])) { ?>
              <div class="delete-confirm" data-deleted="<?= $_GET['success']; ?>">
              
              </div>
             <?php } ?>

           <!-- Delete Sweet Alert Start  -->
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
                 const wrong = $('.not-delete').data('wrong')
                  if(wrong){
                    Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Post was not deleted...!!!'
                        })
                  }
            </script>

</html>