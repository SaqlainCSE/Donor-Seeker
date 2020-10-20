<?php 
    include("connection.php");
    include("header.php"); 
?>
<!DOCTYPE html>
<html>
<head>
        <title>Accept request</title>
        <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
 <?php 
    if(!isset($_SESSION['user']))
    {
      $id = $_GET['id'];
      header("location:login2.php?id=".$id);
    }
 ?>
 <div class="container">
         <table class="table table-striped">
          <hr>
          <h4 style="text-align: center;">Blood Seeking Post</h4>
          <hr>
            <tbody>
              <?php 
              $id = $_GET['id'];
              $sql = mysqli_query($connection , "SELECT * from donor_seeker_post where id = '$id' AND status = 'live'");
               while($row = mysqli_fetch_array($sql))
                {
                  
              ?>
              <tr>
                <td>District</td>
                <td>
                  <?php echo $row['district']; ?>
                </td>
              </tr>
              <tr>
                <td>Police Station/Sub-district</td>
                <td>
                  <?php echo $row['sub_district_or_police_station']; ?>
                </td>
              </tr>
              <tr>
                <td>Area/Village</td>
                <td>
                  <?php echo $row['village_or_area']; ?>
                </td>
              </tr>
              <tr>
                <td>Donation Place</td>
                <td>
                  <?php echo $row['details_of_your_area']; ?>
                </td>
              </tr>
              <tr>
                <td>Donee Name</td>
                <td>
                  <?php echo $row['donee_name']; ?>
                </td>
              </tr>
              <tr>
                <td>Donee Contact</td>
                <td>
                  <?php echo $row['donee_contact']; ?>
                </td>
              </tr>
              <tr>
                <td>Donee E-mail</td>
                <td>
                  <?php echo $row['donee_mail']; ?>
                </td>
              </tr>
              <tr>
                <td>Donation Date</td>
                <td>
                  <?php echo $row['date']; ?>
                </td>
              </tr>
              <tr>
                <td>Donation Time</td>
                <td>
                  <?php echo $row['time']; ?>
                </td>
              </tr>
              <tr>
                <td>Total Blood Neede(Bag/s)</td>
                <td>
                  <?php echo $row['bag']; ?>
                </td>
              </tr>
               <?php
                   }
                ?>
                <div style="align-content: center;">
                  
                <?php
                      if(mysqli_num_rows($sql) == false)
                        {
                            echo "<h5 style='text-align:center;'>No result found</h5>";
                        } 
                  ?> 
                </div>
       </tbody>
     </table>
         <div class="form-row text-center">
           <div class="col-12">
              <a href="donor_accept_request.inc.php?id=<?php echo $id;?>" class="btn btn-info">Donate Now</a>
              <?php
                if(isset($_GET['mail']))
                {
                  if($_GET['mail'] == "mail")
                  {
                    echo "<h5 style='text-align:center;'>Mail Sent</h5>";
                    ?>
                    <div class="mail" data-sent="<?= $_GET['mail']; ?>"> 
                    </div>
              <?php
                  }
                  elseif($_GET['mail'] == "sent")
                  {
                    echo "<h5 style='text-align:center;'>Mail Already Sent</h5>";
                    ?>
                    <div class="mail2" data-wrong="<?= $_GET['mail']; ?>"> 
                    </div>
              <?php
                  }
                }
                  if($_GET['fail'])
                  { ?>
                    <div class="fail" data-wrong2="<?= $_GET['fail']; ?>"> 
                    </div>
                <?php
                  }
                
                ?>
           </div>

                     <script src="sweetAlert/jquery-3.5.0.min.js"></script>
                      <script src="sweetAlert/sweetalert2.all.min.js"></script>
                      <script>
                         const sent = $('.mail').data('sent')
                         if(sent){
                            Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'Mail sent successfully.',
                              showConfirmButton: false,
                              timer: 4000
                            })
                         }
                         const wrong = $('.mail2').data('wrong')
                            if(wrong){
                              Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Mail already sent...!!!'
                                  })
                            }
                          const wrong2 = $('.fail').data('wrong2')
                          if(wrong2){
                            Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: 'Something went wrong...!!!'
                                })
                          }
                       </script>


         </div> 
   </div> <!-- End Of the page -->
</body>
</html>



 


 