<?php

	require_once('dbconfig.php');
	global $con;

	
	$name = $_POST['name'];
	$age = $_POST['age'];
	$address = $_POST['address'];
	$nic = $_POST['nic'];

	if(!empty($name) && !empty($age) && !empty($address) && !empty($nic) )
	{
		$query = $con->prepare("INSERT into students (name,age,address,nic) VALUES (?,?,?,?)");

		$query->bind_param('ssss',$name,$age,$address,$nic);

		$result = $query->execute();

		if($result) 
		{
	        echo '<div class="col-md-offset-4 col-md-5 text-center alert alert-success">1 Record Added!</div>';
	    }
	    else
	    	exit(mysqli_error($con));    
	}





	    