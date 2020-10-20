<?php
	include("connection.php");
	if($_POST)
	{
		$First_Name = $_POST['firstname'];
		$Last_Name = $_POST['lastname'];
		$Blood_Group = $_POST['blood_group'];
		$Gender = $_POST['gender'];
		$Date_of_Birth = $_POST['DoB'];
		$Weight = $_POST['weight'];
		$Division = $_POST['division'];
		$District = $_POST['district'];
		$Sub_District_or_Police_Station = $_POST['sub_district'];
		$Village_or_Area = $_POST['village'];
		$Details_of_Your_Area = $_POST['details_of_area'];
		$Phone = $_POST['phone'];
		$E_mail = $_POST['email'];
		$Password = $_POST['password']; 
		/* Insert Into donor_infos table */
		$query = "INSERT INTO donor_infos (`First_Name`, `Last_Name`, `Blood_Group`, `Gender`, `Date_of_Birth`, `Weight`, `Division`, `District`, `Sub_District_or_Police_Station`, `Village_or_Area`, `Details_of_Your_Area`, `Phone`, `E_mail`, `Password`) values('$First_Name', '$Last_Name', '$Blood_Group', '$Gender', '$Date_of_Birth', '$Weight', '$Division', '$District', '$Sub_District_or_Police_Station', '$Village_or_Area', '$Details_of_Your_Area', '$Phone', '$E_mail', '$Password')";
		//$sql=mysqli_query($connection , $query);
		if(!$sql=mysqli_query($connection , $query))
		{
			echo "Not Inserted";
			//header("location:registation.php");
		}
		else
		{
			/* Redirect (Go to the view Profile) */
		//header(location:)
			echo "Inserted Data";
		}

	}
?>