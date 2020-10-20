 <script src="sweetAlert/jquery-3.5.0.min.js"></script>
 <script src="sweetAlert/sweetalert2.all.min.js"></script>
 <script>
		
	$('.btn-del').on('click' , function(e) {
		e.prventDefault();
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





           Swal.fire({
            title: '<h5>Password Should Contain:</h5>',
            icon: 'info',
            html:
              '<ul> <li>Password must be at least 8 characters in length and max length is 16.'+
              '<li>Password must include at least one upper case letter.'+
              '<li>Password must include at least one number.'+
              '<li>Password must include at least one special character (e.g:~!@#$% etc). </ul>',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:
              '<i class="fa fa-thumbs-up"></i> Great!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText:
              '<i class="fa fa-thumbs-down"></i>',
            cancelButtonAriaLabel: 'Thumbs down'
          })
      }

 </script>
 


 <div class="delete-confirm" data-deleted="<?= $_GET['success']; ?>">
 	<?php header("location:home.php"); ?>
 </div>
                 }









                 /* Delete Sweet Alert Start */
           if(isset($_GET['success'])) { ?>
            <div class="delete-confirm" data-deleted="<?= $_GET['success']; ?>">
            <?php header("location:home.php");
                  ob_end_flush();
             ?>
            </div>
          <?php } ?>


           