<?php require_once('connect.php');
	session_start();
	$film_id=$_GET['film_id'];
	if(isset($film_id)){
		//echo "receive post";
		$title=$_POST['title'];
		$releasey=$_POST['year'];
		$genre=$_POST['genre'];
		$length=$_POST['length'];
		$rating=$_POST['rating'];
		$detail=$_POST['detail'];
		$rentalrate=$_POST['rentalrate'];
		$x=0;
		$user_check_query = "SELECT * FROM film WHERE title = '$title' ";
        $query = mysqli_query($mysqli, $user_check_query);
        $result = mysqli_fetch_assoc($query);
		if (empty($title)) {
			$x=1;
        }else	if (empty($releasey)) {
			$x=1;
        }else	if (empty($genre)) {
			$x=1;
        }else	if (empty($length)) {
			$x=1;
        }else	if (empty($rentalrate)) {
			$x=1;
        }elseif (empty($detail)) {
			$x=1;
		}
		if($x==1){
			echo ("<script LANGUAGE='JavaScript'>
					window.alert('Filled the form incorrectly');
					window.location.href='home.php';
					</script>");
		}
		//update
		if($x==0){
			$q1="UPDATE film SET inventory_id='1',title='$title'
			,release_year='$releasey',rental_duration='30',rental_rate='$rentalrate'
			,length='$length',rating='$rating',detail='$detail' WHERE film_id='$film_id'";
			$result=$mysqli->query($q1);
			$q3="SELECT film_id FROM film WHERE title='$title'";
			$selectfid = mysqli_query($mysqli,$q3);
			if(mysqli_num_rows($selectfid)>0){
				$row = mysqli_fetch_assoc($selectfid);
				$fid=$row['film_id'];
				$q2="UPDATE film_genre SET genre_name='$genre' WHERE film_id='$film_id'";
				$result=$mysqli->query($q2);
			}
			echo ("<script LANGUAGE='JavaScript'>
				window.location.href='film.php?title=$title';
                </script>");
			if(!$result){
				echo "INSERT failed. Error: ".$mysqli->error ;
				return false;
			}
		}
	}
?>