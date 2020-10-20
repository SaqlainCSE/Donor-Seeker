<?php
   use PHPMailer\PHPMailer\PHPMailer;
   include("connection.php"); // donor seeker post complete korar por eti info onujai search korbe,
   include("header.php");

    if(isset($_GET['id']) && isset($_GET['id2'])) // id2 = post id
    {
        $count = 1;
        send_mail($_GET['id'] , $_GET['id2']);// individual mail
    }

    if(isset($_GET['id3'])) //id3 = post id
    {
        $id = $_GET['id3'];

        $post_id = $id;
        $id2 = $_SESSION['id'];
        $query = mysqli_query($connection , "SELECT * from donor_seeker_post where id = '$id' and seeker_id = '$id2' and status = 'live'");

        
        $date = $row['date']; //From donor_seeker_post.
        $check_date = date_create($date);
        date_modify($check_date , "-120 days");
        $eligible_date = date_format($check_date,"Y-m-d"); // final date

        /* For age >= 18 and age <= 60 */
        $today = $date;
        $check_18 = date_create($today);
        date_modify($check_18 , "-18 years");
        $eighten = date_format($check_18 , "Y-m-d");

        $check_60 = date_create($eighten);
        date_modify($check_60 , "+60 years");
        $sixty = date_format($check_60 , "Y-m-d");
        /* For age >= 18 and age <= 60 */

        
        $blood_group =  $row['blood_group'];
        $division =  $row['division'];
        $district =  $row['district'];
        $sub_district =  $row['sub_district_or_police_station'];
        $village_or_area =  $row['village_or_area'];
       

        /* Query: Who are eligible to donate blood according to above info.*/

        $sql = "SELECT * from donor_infos WHERE Blood_Group = '$blood_group' and Division = '$division' and District = '$district' and Sub_District_or_Police_Station = '$sub_district' and Date_of_Birth >= '$eighten' and Date_of_Birth <= '$sixty' and Weight >= 50 HAVING (select donation_infos.donor_id from donation_infos where donation_infos.Last_donate <= '$eligible_date' and donor_infos.id = donation_infos.donor_id)";



        //$sql = "SELECT * from donor_infos WHERE  Division = '$division' and District = '$district'   HAVING (select donation_infos.donor_id from donation_infos where donation_infos.Last_donate <= '$eligible_date' and donor_infos.id = donation_infos.donor_id)";

        $result = mysqli_query($connection , $sql);


          while($row = mysqli_fetch_array($result))
          {
            send_mail($row['id'] , $post_id); // All id mail
          }             
    }


    function send_mail($id , $id2)
    {
         
         include("connection.php");
         $query =  mysqli_query($connection , "SELECT * from donor_infos where id = '$id'");
         $row = mysqli_fetch_array($query);
         $email = $row['E_mail'];


         $to = $email;

         $subject = "Blood Donation Request";

         $header = "Donor Seeker";

         $query =  mysqli_query($connection , "SELECT * from donor_seeker_post where id = '$id2'");
         $row = mysqli_fetch_array($query);


         $selector = bin2hex(random_bytes(8));
         $token = random_bytes(32);
         $url = "http://localhost/donor_seeker/donor_accept_request.php?selector=".$selector."&validator=".bin2hex($token)."&id=".$row['id'];
         //$expires = date("U") + 1800; //after 0.5 hour
                    

         $message = "Dear Donor,hope you are well. You are requested to donate blood to:-<br>"."<strong>Donee Name: </strong>".$row['donee_name']."<br>"."<strong> Blood Group: </strong>".$row['blood_group']."<br>"."<strong>District: </strong>".$row['district']."<br>"."<strong>Sub-District/Police Station: </strong>".$row['sub_district_or_police_station']."<br>"."<strong>Area/Village: </strong>".$row['village_or_area']."<br>"."<strong>Donation Place/Hospital: </strong>".$row['details_of_your_area']."<br>"."<strong>Contact: </strong>".$row['donee_contact']."<br>"."<strong>Date: </strong>".$row['date']."<br>"."<strong>Time: </strong>".$row['time'];

         $message .= '<p>Here is confirmation link: <br>';
         $message .= '<a href=" '.$url.' ">' .$url. '</a></p>';

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
              //echo $status;
              header("location:search_eligible_donor.php?idd=".$id2."&id=".$id); //$id2 = post_id
          } else {
              $status = "failed";
              //$response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
              echo $status;
          }
    }
?>