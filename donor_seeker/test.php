 <script src="sweetAlert/jquery-3.5.0.min.js"></script>
 <script src="sweetAlert/sweetalert2.all.min.js"></script>
 <script type="text/javascript">
 	const flashdata = $('.flash-data').data('flashdata')
 		if(flashdata){
 			swal.fire({
 				type:'success',
 				title:'Succes',
 				text:'record updated'
 			})
 		}
 </script>

 ORDER BY Division ASC



 								<?php 
                                    if(isset($_GET['success'])) { ?>
                                      <div class="add-district" data-added="<?= $_GET['success'];?>"></div>
                                      <?php }
                                        elseif(isset($_GET['error'])) { ?>
                                          <div class="not-added" data-wrong="<?= $_GET['error']; ?>"> 
                                          </div>
                              <?php 
                                  }
                                ?>

                                 <script src="sweetAlert/jquery-3.5.0.min.js"></script>
                                 <script src="sweetAlert/sweetalert2.all.min.js"></script>
                                 <script>
                                  const added = $('.add-district').data('added')
                                    if(added){
                                      Swal.fire(
                                        'Success!',
                                        'District was added!',
                                        'success'
                                      )
                                    }

                                    const wrong = $('.not-added').data('wrong')
                                    if(wrong){
                                      Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'District was not added...!!!'
                                          })
                                    }
                                 </script>