<?php require_once('connect.php'); 
	session_start();
	if(isset($_POST['signup'])) {
		$firstname = $_POST["fname"];
		$lastname = $_POST["lname"];
		$email = $_POST["email"];
		$passwd = $_POST["password"];
		$cpasswd = $_POST["password2"];
		$acctype = $_POST["acctype"];
		$errors = array();
		$x=0;
		$user_check_query = "SELECT * FROM user WHERE email = '$email' ";
        $query = mysqli_query($mysqli, $user_check_query);
        $result = mysqli_fetch_assoc($query);
		//errors case
		if (empty($email)) {
			$x=1;
		}
		elseif (empty($firstname)) {
			$x=1;
		}
		elseif (empty($lastname)) {
			$x=1;
		}
		elseif (empty($passwd)) {
			$x=1;
		}
		elseif (empty($cpasswd)) {
			$x=1;
		}
		elseif (empty($acctype)) {
			$x=1;
		}
		elseif (!$passwd==$cpasswd){
			$x=1;
		}
		elseif($result) { // Email already used or not
                if ($result['email'] === $email){
					$x=1;
                }
            }
		if($x==1){
			echo ("<script LANGUAGE='JavaScript'>
					window.alert('Please fill the form correctly');
					window.location.href='http://localhost/project326/signup.php';
					</script>");
		}
		//insert data
		else{
			$q="INSERT INTO user (f_name,l_name,email,password) 
			VALUES ('$firstname','$lastname','$email','$passwd')";
			$result=$mysqli->query($q);
			$sel="SELECT user_id FROM user WHERE email='$email'";
			if($sels=$mysqli->query($sel)){
				$row = mysqli_fetch_assoc($sels);
				$uid = $row['user_id'];
				if($acctype == 'customer'){
				$q1="INSERT INTO customer(customer_id,user_id) 
					VALUES('$uid','$uid')";
				}
				elseif($acctype == 'admin'){
				$q1="INSERT INTO admin(admin_id,user_id) 
					VALUES('$uid','$uid]')";
				}
				
				$res=$mysqli->query($q1);
				echo ("<script LANGUAGE='JavaScript'>
					window.location.href='http://localhost/project326/login.php';
               		</script>");
			}
			if(!$result){
				echo "INSERT failed. Error: ".$mysqli->error ;
				return false;
			}
		}
        
	}
?>