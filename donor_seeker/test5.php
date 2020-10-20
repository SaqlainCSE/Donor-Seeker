<!DOCTYPE html>
<html>
<head>
        <title>Update Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/app.css">
</head>
<body>
  <button id="btn-del">Click me!</button>

  <script src="sweetAlert/jquery-3.5.0.min.js"></script>
  <script src="sweetAlert/sweetalert2.all.min.js"></script>

  <script>
  $('#btn-del').on('click' , function(e){
    e.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'Registation completed and e-mail sent to the user.',
                              showConfirmButton: false,
                              timer: 4000
                            })
  })
  </script>
</body>
</html>