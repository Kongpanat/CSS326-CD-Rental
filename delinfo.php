<?php 
session_start();
	$rental_id=$_GET['rental_id'];
	require_once('connect.php');
	if (isset($rental_id)) {
		$q="DELETE FROM rental where rental_id=$rental_id";
			if(!$mysqli->query($q)){
				echo "DELETE failed. Error: ".$mysqli->error ;
		   }
		   $mysqli->close();
		   //redirect
		   header("Location: inventory.php");
	}
?>