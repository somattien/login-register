<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';

if(isset($_GET['success']) && empty ($_GET['success'])){
	?>
	<h2>Thank, we have activated your account...</h2>
	<p>You're free to log in!</p>
	<?php
}else if (isset($_GET['email'], $_GET['email_code'])){
    $email = trim($_GET['email']);
    $email_code = trim($_GET['email_code']);
    
 
    
    if(email_exists($email) === false){
        $errors[] = 'Oops, something went wrong, and we couldn\'t find that email address';
    } else if(activate($email, $email_code) === false){
        $errors[] = 'We had problems your account';
    }
    
    if(empty($errors) === false){
        ?>
        <h2>Opps...</h2>
        <?php
        echo ouput_errors($errors);
    } else {
        header('location: activate.php?success');
        exit();
    }
    
    
} else{
    header('location: index.php');
    exit();
}

include 'includes/overall/footer.php';
?>
</body>
</html>
