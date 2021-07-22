<?php

	global $con;

	$con = mysqli_connect('localhost','root','','db2');

	if(!$con)
	{
		echo 'unable to connect with db';
		die();
	}