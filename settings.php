<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

if(empty($_POST) === false){
    $require_fields = array('first_name','email');
	foreach($_POST as $key=>$value){
		//echo $key;
		if(empty($value) && in_array($key, $require_fields) === true){
			$errors[] = 'Fields marked with an asterist are required (register.php)';
			break 1;
		}
	}
    
    if(empty($errors) === true){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[] ='A valid email address  is required';
		} else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']){
            $errors[] ='Sorry, the email\'' . $_POST['email'] . '\' is already in use.';
        }
    }
    print_r($errors);
}
?>
<h1>Settings (settings.php)</h1>
<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	echo 'Your deatils have been updated';
} else{
    if(empty($_POST) === false && empty($errors) === true){
    //    update user details
        echo $allow_email;
        $update_data = array(
                'first_name' 	=> $_POST['first_name'],
                'last_name' 	=> $_POST['last_name'],
                'email'			=> $_POST['email'],
                'allow_email'	=> ($_POST['allow_email'] == 'on') ? 1 : 0
            );
            update_user($session_user_id, $update_data);
            header('location: settings.php?success');
            exit();
    } else if (empty($errors) === false){
        echo output_errors($errors);
    }
?>
<form action="" method="post">
  <ul>
    <li> First name*: <br>
      <input type="text" name="first_name" value="<?php echo $user_data['first_name'] ?>">
    </li>
    <li> last name: <br>
      <input type="text" name="last_name" value="<?php echo $user_data['last_name'] ?>">
    </li>
    <li> Email*: <br>
      <input type="text" name="email" value="<?php echo $user_data['email'] ?>">
    </li>
    <li> Allow email <br>
      <label><input type="checkbox" name="allow_email" <?php if($user_data['allow_email'] == 1){echo'checked';} ?> />Would you like to receive email from us?</label>
    </li>
    <li>
      <input type="submit" value="Update">
    </li>
  </ul>
</form>

<?php
    }
include 'includes/overall/footer.php';
?>
</body>
</html>
