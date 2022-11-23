<?php require_once('connect.php');
	if(isset($_POST['f_add'])){
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
        }else	if($result) { // Title already used or not
					if ($result['title'] === $title){
						$x=1;
					}
        }
		if($x==1){
			echo ("<script LANGUAGE='JavaScript'>
					window.alert('This Movie already exist or filled the form incorrectly');
					window.location.href='add_film.php';
					</script>");
		}
		if($x==0){
			$q1="INSERT INTO film (inventory_id,title,release_year,rental_duration,rental_rate,length,rating,detail)
			VALUES ('1','$title','$releasey','30','$rentalrate','$length','$rating','$detail')";
			$result=$mysqli->query($q1);
			$q3="SELECT film_id FROM film WHERE title='$title'";
			$selectfid = mysqli_query($mysqli,$q3);
			if(mysqli_num_rows($selectfid)>0){
				$row = mysqli_fetch_assoc($selectfid);
				$fid=$row['film_id'];
				$q2="INSERT INTO film_genre (film_id,genre_name)
				VALUES ('$fid','$genre')";
				$result=$mysqli->query($q2);
			}
			
			echo ("<script LANGUAGE='JavaScript'>
				window.location.href='home.php';
                </script>");
			if(!$result){
				echo "INSERT failed. Error: ".$mysqli->error ;
				return false;
			}
		}
		
	}
?>