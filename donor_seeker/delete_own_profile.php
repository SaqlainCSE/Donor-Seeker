 <?php 
    include("connection.php");// Any User Can Delete His/Her Account
    session_start(); 
    $id = $_SESSION['id'];
    $date = date("y/m/d");

  /* Insert Deleted Data First */

    $query_check = mysqli_query($connection, "UPDATE donor_infos set `status` = 'deleted'  , `deleted_at` = '$date' WHERE id = '$id'");
     
     if($query_check)
     {
        session_destroy();
        /* Deleted */
        header("location:home.php?success=success");     
     else
     {
       /* Not Deleted */
       header("location:view_own_profile.php?error=error");
     }
 
   }
?>