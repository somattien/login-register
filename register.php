<?php
  include 'core/init.php';
logged_in_redirect();
  include 'includes/overall/header.php';

//  DANG KY
if(empty($_POST) === false){
	$require_fields = array('username','password','password_again','first_name','email');
	foreach($_POST as $key=>$value){
		//echo $key;
		if(empty($value) && in_array($key, $require_fields) === true){
			$errors[] = 'Fields marked with an asterist are required (register.php)';
			break 1;
		}
	}
	
	if(empty($errors) === true){
		if(user_exists($_POST['username']) === true){
			$errors[] = 'Sorry, the username\'' . $_POST['username'] . '\' is already taken.';
		}
		if(preg_match("/\\s/", $_POST['username']) == true){// ham bao co space
			/*$regular_expression = preg_match("/\\s/", $_POST['username']);
			var_dump($regular_expression);*/
			$errors[] = 'Your username must not contain any spaces.';
		}
		if(strlen($_POST['password']) < 6 ){
			$errors[] ='Your password must be at least 6 characters.';
		}
		if($_POST['password'] !== $_POST['password_again']){
			$errors[] ='Your password do not match.';
		}
		//validate activate email
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[] ='A valid email address  is required';
		}
		if(email_exists($_POST['email']) === true){
			$errors[] ='Sorry, the email\'' . $_POST['email'] . '\' is already in use.';
		}
	}
}
//print_r($errors);
  ?>

<h1>Register (register.php)</h1>
<?php
if(isset($_GET['success']) && empty ($_GET['success'])){
	echo 'You\'ve been registered successfuly! Please check your email to activate your account.';
} else { // 01 bat dau
    
	if(empty($_POST) === false && empty($errors) === true){
		// register user
		$register_data = array(
			'username' 		=> $_POST['username'],
			'password' 		=> $_POST['password'],
			'first_name' 	=> $_POST['first_name'],
			'last_name' 	=> $_POST['last_name'],
			'email'			=> $_POST['email'],
            'email_code'	=> md5($_POST['username'] + microtime()),
		);
		//print_r ($register_data);
//        chay function dang ky
		register_user($register_data);
		//redirect
		header('location: register.php?success');
		exit();
        
	} else if (empty($errors) === false){
		// output errors
		echo output_errors($errors);
	}

?>
<form action="" method="post">
  <ul>
    <li> username*: <br>
      <input type="text" name="username">
    </li>
    <li> password*: <br>
      <input type="password" name="password">
    </li>
    <li> password again*: <br>
      <input type="password" name="password_again">
    </li>
    <li> first name*: <br>
      <input type="text" name="first_name">
    </li>
    <li> last name: <br>
      <input type="text" name="last_name">
    </li>
    <li> email*: <br>
      <input type="email" name="email">
    </li>
    <li>
      <input type="submit" value="Register">
    </li>
  </ul>
</form>
<?php
}//01 ket thuc
include 'includes/overall/footer.php';
?>
</body>
</html>