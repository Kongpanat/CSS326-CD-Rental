<?php 
session_start();
	$rental_id=$_GET['rental_id'];
	require_once('connect.php');
	if (isset($rental_id)) {
		//delete in rental
		$q1="DELETE FROM payment where rental_id='$rental_id'";
		$result=$mysqli->query($q1);
		$q="DELETE FROM rental where rental_id='$rental_id'";
		$result=$mysqli->query($q);
		
		
		//redirect
		header("Location: inventory.php");
	}
?>