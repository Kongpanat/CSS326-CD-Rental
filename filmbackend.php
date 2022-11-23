<?php require_once('connect.php');
	session_start();
		
		$rent_duration=$_POST['duration'];
		$amount=$_POST['amount'];
		$x=0;
		$film_id=$_SESSION['film_id'];
		$user_id=$_SESSION['user_id'];
		
		if(empty($rent_duration)){
			$x=1;
		}elseif(empty($amount)){
			$x=1;
		}elseif(empty($film_id)){
			$x=1;
		}
		if($x==1){
			echo ("<script LANGUAGE='JavaScript'>
					window.alert('This Movie already exist or filled the form incorrectly');
					window.location.href='home.php';
					</script>");
		}
		$rental_date=date('Y/m/d');//define rental date
		$return_date=date('Y-m-d', strtotime($rental_date. ' + '.$rent_duration.' days'));//define return date
		$customer_id=$_SESSION['user_id'];
		//calculate cost of film
			$q1="SELECT * FROM film WHERE film_id='$film_id'";
			$sel1= mysqli_query($mysqli,$q1);
			if(mysqli_num_rows($sel1)>0){
				 $row = mysqli_fetch_assoc($sel1);
				 $x=$amount*$rent_duration*$row['rental_rate'];
			}
		//check already have this film_id in inventory of rental(customer_id) or not
		
			//add detial to inv
			$q="INSERT INTO inventory (amount,film_id)
				VALUES ('$amount','$film_id')";
			$result=$mysqli->query($q);//execute $q
			

			//update film
			$selq="SELECT * FROM inventory WHERE film_id='$film_id'";
			$sel= mysqli_query($mysqli,$selq);
			if(mysqli_num_rows($sel)>0){
				$row = mysqli_fetch_assoc($sel);
				$inv_id=$row['inventory_id'];//define $inv_id = inventory_id
				$q2="UPDATE film SET inventory_id = '$inv_id', rental_duration='$rent_duration' WHERE film_id='$film_id'";
				$upd= mysqli_query($mysqli,$q2);//execute $q2
			}else{
				echo "error";
			}
			
			//customer_id=user_id
			
			$q2="INSERT INTO rental (customer_id,inventory_id,rental_date,return_date,amount)
				VALUES ('$customer_id','$inv_id','$rental_date','$return_date','$amount')";//insert data to rental
			$result2=$mysqli->query($q2);
			$maxrentid="SELECT MAX(rental_id) AS maxrentid FROM rental";
			$resu=mysqli_query($mysqli,$maxrentid);
			if(mysqli_num_rows($resu)>0){
				$row = mysqli_fetch_assoc($resu);
				$maxrent_id=$row['maxrentid'];
			}
			/*$selinv="SELECT inventory_id FROM rental WHERE rental_id='$maxrent_id'";
			$resinv=mysqli_query($mysqli,$selinv);
			if(mysqli_num_rows($resinv)>0){
				$row = mysqli_fetch_assoc($resinv);
				$thisinv_id=$row['inventory_id'];
			}*/
			$getrental_id=mysqli_query($mysqli, "SELECT rental_id FROM rental WHERE rental_id='$maxrent_id'");
			if(mysqli_num_rows($sel)>0){
				$row = mysqli_fetch_assoc($getrental_id);
				$rentid = $row['rental_id'];//rentid=rental_id
				$q3="INSERT INTO payment (rental_id,customer_id,total_pay)
					VALUES('$rentid','$user_id','$x')";
				$result1=$mysqli->query($q3);//execyte $q3
			}
			header('Location:inventory.php');
		
		
?>