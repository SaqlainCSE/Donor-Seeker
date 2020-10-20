<?php
    include("connection.php");
     if($_POST)
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $error_msg = array();
        $sql = "SELECT * from donor_infos where E_mail = '$email'";
        $sql2 = "SELECT * from donor_infos where Password = '$password'";
        $query = mysqli_query($connection,$sql);
        $query2 = mysqli_query($connection,$sql2);
        if($query)
        {
            if(mysqli_num_rows($query) < 1) //false hole
            {
                 $error_msg['email1'] = "E-mail  doesn't exist.Please try again.";
            }
        }
        if($query2)
        {
            if (mysqli_num_rows($query2) < 1) //false hole
            {
             $error_msg['password1'] = "Password don't match";
            }
        }
        if(count($error_msg) == 0)
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query3 = "SELECT * from donor_infos where E_mail ='$email' and Password = '$password' ";
            $sql3 = mysqli_query($connection ,$query3);
            if($sql3)
            {
                if(mysqli_num_rows($sql3) < 1) //false hole
                {
                    echo "Something went wrong..!!.Please try again..";
                }
                else
                    {
                        echo "Login Success";
                    }
            }
        
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
          <title>Login</title>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/app.css">
          <! Link For Font Awesome>
          <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus placeholder="E-mail">
                                <p> 
                                <?php
                                    if(isset($error_msg['email1'])) 
                                        echo "<div class='error'>" . $error_msg['email1']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Password">
                                <p> 
                                <?php
                                    if(isset($error_msg['password1'])) 
                                        echo "<div class='error'>" . $error_msg['password1']. "</div>";
                                ?> 
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>