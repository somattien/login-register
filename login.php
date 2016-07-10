<!--nhan require POST-->
<?php
include 'core/init.php';
logged_in_redirect();

if (empty($_POST) === false){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) === true || empty($password) === true){ //bao loi rong~
		$errors[] = 'You need to enter a username and password';
		} else if(user_exists($username) === false){ //bao loi username khong ton` tai
			$errors[] = 'We can\'nt find that username. Have you registered?';
		} else if(user_active($username) === false){ //bao loi useranme chua kich hoat
			$errors[] = 'You have\'t activated your account';
		} else {
			
			if(strlen($password) > 32){
				$errors[]= "password name too long";
				}
			
			$login = login($username, $password);
			if($login === false){
				$errors[] = 'That username/password combination is incorrect';
				} else {
					//echo 'Ok!';
					// set the user session
					$_SESSION['user_id'] = $login;
					// redirect user to home
					header('location: index.php');
					exit();
				}
		}

	} else{
		$errors[] = 'No data received';
	}

include 'includes/overall/header.php';
//sau khi dang nhap se xuat hien noi dung
//echo output_errors($errors);

if (empty($errors) === false){
?>
 <h2>We tried to log you in, but...</h2>
<?php
	echo output_errors($errors);
	}
include 'includes/overall/footer.php';
?>