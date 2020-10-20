<?php
	include("connection.php");
	//session_start();
	 if($_POST)
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $error_msg = array();
       // $sql = mysqli_query($connection , "select E_mail,Password from donor_infos where E_mail = $email and Password = $password ");
        $query = "SELECT * from donor_infos where E_mail ='$email' and Password = '$password' ";
        $sql2 = mysqli_query($connection ,$query);
        if($sql2)
        {
            if(mysqli_num_rows($sql2) < 1) //false hole
            {
                echo "Something went wrong..!!.Please try again..";
                //header("location:login.php");
            }
            else
                {
                    echo "Login Success";
                    //echo $sql2;
                    //$_SESSION['user'] = $sql2; //for first & last name.
                    //header(); //redirect to the any page.
                }
        }
    }
         
?>