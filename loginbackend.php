<?php require_once('connect.php');
	session_unset();
	session_start();
	if(isset($_POST['login'])) {
		$email = $_POST["email"];
		$passwd = $_POST["password"];
		$select = mysqli_query($mysqli, "SELECT * FROM user WHERE email='$email' AND password='$passwd'") or die('query faied');
        if(mysqli_num_rows($select)>0){
			$row = mysqli_fetch_assoc($select);
			$uid=$row['user_id'];
			$select_admin = mysqli_query($mysqli, "SELECT * FROM admin WHERE admin.user_id='$uid'") or die('query failed');
			if(mysqli_num_rows($select_admin)>0){
				$row = mysqli_fetch_assoc($select_admin);
				$_SESSION['admin_id']=$row['admin_id'];
			}
			$_SESSION['user_id']=$row['user_id'];
			header ('location:profile.php');
		}else{ echo ("<script LANGUAGE='JavaScript'>
            window.alert('Email or password is incorrect');
            window.location.href='login.php';
            </script>");
		}
	}
?>