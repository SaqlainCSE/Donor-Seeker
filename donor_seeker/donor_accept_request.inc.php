<?php
  use PHPMailer\PHPMailer\PHPMailer;
  include("connection.php");
  //include("header.php");
  session_start();
      if(isset($_GET['id']))
      {
        $id = $_GET['id']; //post id
        //echo "send mail to donne mail: ".$id;
        $id2 = $_SESSION['id'];

        $sql = mysqli_query($connection , "SELECT * FROM donor_confirmation WHERE post_id = '$id' AND donor_id = '$id2' AND status = 'true'");

        
        if(mysqli_num_rows($sql) == false)
        {
          //header("location:donor_accept_request.php?succ=succ&id=".$id);

          $sql3 = mysqli_query($connection , "SELECT * FROM donor_seeker_post WHERE id = '$id' AND status = 'live'");// for decrement one blood bag
          $row3 = mysqli_fetch_array($sql3);
          $seeker_id = $row3['seeker_id'];

          $sql2 = mysqli_query($connection , "INSERT INTO `donor_confirmation`(`post_id`, `donor_id`, `status` ,`seeker_id`) VALUES ('$id' , '$id2' , 'true' , '$seeker_id')"); // bar bar mail jate send na korte pare.

          $bag = $row3['bag'];
          $bag = $bag - 1;

          $sql4 = mysqli_query($connection , "UPDATE `donor_seeker_post` SET  `bag`= '$bag' WHERE id = '$id'");


          $sql5 = mysqli_query($connection , "SELECT * FROM donor_seeker_post WHERE id = '$id'");

          $row5 = mysqli_fetch_array($sql5);

          if($row5['bag'] == 0)
          {
            $id = $row3['id'];
            $sql6 = mysqli_query($connection , "UPDATE `donor_seeker_post` SET  `status`= 'die' WHERE id = '$id'"); 
          }
          send_mail($id2 , $id);
        }
        elseif (mysqli_num_rows($sql) == true) {
           header("location:donor_accept_request.php?mail=sent&id=".$id);
         } 
      }


      function send_mail($id , $id2)
      {
         
         include("connection.php");
         $query =  mysqli_query($connection , "SELECT * from donor_infos where id = '$id'");
         $row = mysqli_fetch_array($query);


         $message = "<p>Dear Donor Seeker, your request is accepted and you are requested to contact: <br>";
         $message .= "<strong>Donor Name: </Strong>".$row['First_Name']." ".$row['Last_Name']."<br>";
         $message .= "<strong>Blood Group: </Strong>".$row['Blood_Group']."<br>";
         $message .= "<strong>Donor Contact: </Strong>".$row['Phone']."<br>";
         $message .= "<strong>Donor E-mail: </Strong>".$row['E_mail']."<br>";
         $message .= "<strong>Donor District: </Strong>".$row['District']."<br>";
         $message .= "<strong>Donor Sub-District/Police Station: </Strong>".$row['Sub_District_or_Police_Station']."<br>";


         

         $query =  mysqli_query($connection , "SELECT * from donor_seeker_post where id = '$id2'");
         $row = mysqli_fetch_array($query);
         $email = $row['donee_mail'];


         $to = $email;

         $subject = "Donor Found";

         $header = "Donor Seeker";

          


         /* This actual msg */

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

          $mail = new PHPMailer();

          //SMTP Settings
          $mail->isSMTP();
          $mail->Host = "smtp.gmail.com";
          $mail->SMTPAuth = true;
          $mail->Username = "donor.seeker.all@gmail.com";// sender
          $mail->Password = 'Mf@073952';
          $mail->Port = 465; //587
          $mail->SMTPSecure = "ssl"; //tls

          //Email Settings
          $mail->isHTML(true);
          $mail->setFrom($to, $header);
          $mail->addAddress($to); // receiver
          $mail->Subject = $subject;
          $mail->Body = $message;

          if ($mail->send()) {
              $status = "success";
              $response = "Email is sent!";
              echo $status;
              header("location:donor_accept_request.php?mail=mail&id=".$id2); //$id2 = post_id.
          } else {
              $status = "failed";
              //$response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
              echo $status;
              header("location:donor_accept_request.php?fail=fail&id=".$id2);
          }
    }
?>  
?>
</body>
</html>



 


 