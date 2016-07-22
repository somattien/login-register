<?php
include 'core/init.php';
protect_page();
admin_protect();
include 'includes/overall/header.php';
?>
<h1>Email all users (mail.php)</h1>

<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
//    echo 'Email has been sent';
	?>
	    <p>Email has been sent</p>
	<?php
} else{
    if (empty($_POST) === false){

        if(empty($_POST['subject']) === true){
            $errors[] = 'Subject is required';
        }

        if(empty($_POST['body']) === true){
            $errors[] = 'Body is required';
        }

        if(empty($errors) === false){
            echo output_errors($errors);
        } else{
            //send email
            //mail_users($_POST['subject'], $_POST['body']);
            header('location: mail.php?success');
            exit();
        }
    }
    ?>

    <form action="" method="post">
       <ul>
           <li>
               subject*:<br>
               <input type="text" name="subject">
           </li>
           <li>
               Body*:<br>
               <textarea name="body"></textarea>
           </li>
           <li>
               <input type="submit" value="Send">
           </li>
       </ul>

    </form>

<?php
    }
include 'includes/overall/footer.php';
?>
</body>
</html>
