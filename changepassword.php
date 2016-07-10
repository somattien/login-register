<?php
include 'core/init.php';
protect_page();

// CHANGE PASSWORD
if(empty($_POST) === false){
	$require_fields = array('current_password','password','password_again');
    
	foreach($_POST as $key=>$value){
		//echo $key;
		if(empty($value) && in_array($key, $require_fields) === true){
			$errors[] = 'Fields marked with an asterist are required (changepassword.php)';
			break 1;
		}
	}
    
    if(md5($_POST['current_password']) ===  $user_data[password]){
        
        if(trim($_POST['password']) !== trim($_POST['password_again'])){
			$errors[] ='Your new password do not match';
		} else if(strlen($_POST['password']) < 6 ){
            $errors[] ='Your password must be at least 6 characters.';
        }
        
    }else{
        $errors[] = 'your current password is incorrect';
    }

    
}
include 'includes/overall/header.php';
?>
  
<h1>Change password (changepassword.php)</h1>
<p>just a template.</p>


<?php

if(isset($_GET['success']) && empty ($_GET['success'])){
	echo 'Your password have been changed successfuly!!!!!!!!!!!';
    
} else{

if(empty($_POST) === false && empty($errors) === true){
//    post the form and no errors
    change_password($session_user_id, $_POST['password']);
    header ('location: changepassword.php?success');
    
    
}else if(empty($errors) === false){
//    out put errors
    echo output_errors($errors);
}

?>

<form action="" method="post">
  <ul>
    <li> current password*: <br>
      <input type="password" name="current_password">
    </li>
    <li> new password*: <br>
      <input type="password" name="password">
    </li>
    <li> new password again*: <br>
      <input type="password" name="password_again">
    </li>
    <li>
      <input type="submit" value="Change password">
    </li>
  </ul>
</form>




<?php
    }

    include 'includes/overall/footer.php'; ?>
</body>
</html>