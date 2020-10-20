<?php
 /* Delete Sweet Alert Start */
   if(isset($_GET['success'])) { ?>
    <div class="delete-confirm" data-deleted="<?= $_GET['success']; ?>">
    
    </div>
  <?php } ?>

<script src="sweetAlert/jquery-3.5.0.min.js"></script>
 <script src="sweetAlert/sweetalert2.all.min.js"></script>
 <script>
	const deleted = $('.delete-confirm').data('deleted')
         if(deleted){
	           Swal.fire(
			      'Deleted!',
			      'Your file has been deleted.',
			      'success'
			    )
	       }

 </script>


<?php 
	include("connection.php");
	include("header.php");

/* For checking any seeking request accept or seeking post posted */
 if(isset($_SESSION['user'])) {
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
}
/* For checking any seeking request accept or seeking post posted */ 

?>
<div style="margin-bottom: 150px;">
	
</div>
<?php
	include("content.php");
?>
<?php
	if(isset($_SESSION['user']))
	{
		include("all_seeking_post.php");
	}
	else{
		//echo "<h5 style='text-align:center;'>No post found yet</h5>";
	}
?>
<?php
	include("footer.php");
?>
 