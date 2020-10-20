<?php
include("connection.php");

	if(isset($_GET['id']) && isset($_GET['id2']))
     {
       $sql =  mysqli_query($connection,"UPDATE donor_seeker_post set status = 'die' where id = '".$_GET['id']."'");
       $id = $_GET['id2'];
       if($sql)
       {
         /* Deleted */
         header("location:all_live_post_see_by_admin.php?success=success &id2=".$id);
       }
       else
       {
         /* Not Deleted */
         header("location:all_live_post_see_by_admin.php?error=error &id2=".$id);
       }
     }

    else if(isset($_GET['idd']))
     {
       $sql =  mysqli_query($connection,"UPDATE donor_seeker_post set status = 'die' where id = '".$_GET['idd']."'");
       if($sql)
       {
         /* Deleted */
         header("location:seeking_post_of_user.php?success=success");
       }
       else
       {
         /* Not Deleted */
         header("location:seeking_post_of_user.php?error=error");
       }
     }
?>