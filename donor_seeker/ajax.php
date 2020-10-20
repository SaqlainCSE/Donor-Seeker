<?php
	include("connection.php");
	/* For Dynamic District DropDown */
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
		$query = mysqli_query($connection , "SELECT * from  district_infos where division_id = '$id' ORDER BY District ASC");
		$rowcount = mysqli_num_rows($query);
		echo "<option value= 'NULL'>-Select District</option>";
		for($i=1;$i<=$rowcount;$i++)
		{
			$row = mysqli_fetch_array($query);
			$id = $row['id'];
			$district = $row['District'];
			echo "<option value='$id'> $district </option>";
		}
	}
	/* For Dynamic Sub-District DropDown */
	if(isset($_POST['districtId']))
	  {
	    $id = $_POST['districtId'];
	    $query = mysqli_query($connection , "SELECT * from sub_district_infos where district_id = '$id' ORDER BY Sub_District_or_Police_Station ASC");
	    $rowcount = mysqli_num_rows($query);
	    echo "<option value= 'NULL'>-Select Sub-district</option>";
		for($i=1;$i<=$rowcount;$i++)
		{
		  $row = mysqli_fetch_array($query);
	      $id = $row['id'];
	      $sub_district = $row['Sub_District_or_Police_Station'];
	      echo "<option value = '$id'> $sub_district </option>";
	    }
	  }
	  /* For Dynamic Area/Village DropDown */
	 if(isset($_POST['sub_districtId']))
	  {
	    $id = $_POST['sub_districtId'];
	    $query = mysqli_query($connection , "SELECT * from area_or_village_infos where 	sub_district_id = '$id' ORDER BY Area_or_Village ASC");
	    $rowcount = mysqli_num_rows($query);
	    echo "<option value= 'NULL'>-Select Your Area</option>";
		for($i=1;$i<=$rowcount;$i++)
		{
		  $row = mysqli_fetch_array($query);
	      $id = $row['id'];
	      $village = $row['Area_or_Village'];
	      echo "<option value = '$id'> $village </option>";
	    }
	  } 
	 
                                        
                                          
                                          
 ?>