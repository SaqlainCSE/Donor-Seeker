<?php 
   include("connection.php"); // Admin Can delete any user by mail

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
         
        $date = date("y/m/d"); 
        $query_check2 = mysqli_query($connection, "UPDATE donor_infos set `status` = 'deleted'  , `deleted_at` = '$date' WHERE id = '$id'");

        if($query_check2)
        {
          /* Deleted */
          header("location:admin_taskbar.php?success=success");
          ob_end_flush();
        }
        else
        {
          /* Not Deleted */
          header("location:user_all_info_dashboard.php?error=error&id=".$id);
          ob_end_flush();
        }       
    }
?>