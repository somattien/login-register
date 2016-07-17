<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';
?>
<h1>Recover (recover.php)</h1>
<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true){
    echo 'Thanks, we\'ve emailed you';
}else{
    $mode_allowed = array('username', 'password');
    if(isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {

        if(isset($_POST['email']) === true && empty($_POST['email']) === false){
           //echo 'chay thu'; 
            if(email_exists($_POST['email']) === true){
//                echo 'Ok';
                recover($_GET['mode'], $_POST['email']);
                header('location: recover.php?success');
                exit();
            } else {
                echo 'Oops, we couldn\'t find that email address ';
            }
        }
        ?>
        <form method="post" action="">
            <ul>
                <li>Please enter your email address<br>
                <input type="email" name="email">
                </li>
                <li>
                    <input type="submit" value="Recover">
                </li>
            </ul>
        </form>
        <?php
    }else{
        header('location: index.php');
        exit();
    }
?>
<?php
}
include 'includes/overall/footer.php';
?>
</body>
</html>