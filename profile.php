<?php
include 'core/init.php';
include 'includes/overall/header.php';

if(isset($_GET['username']) === true && empty($_GET['username']) === false) {
    $username = $_GET['username'];
    
    if(user_exists($username) === true){
    $user_id = user_id_from_username($username);
    $profile_data = user_data($user_id,'first_name','last_name','email');
        //echo $user_id;
        ?>
        <h1><?php echo $profile_data['first_name']; ?>'s Profile (profile.php)</h1>
        <p><?php echo $profile_data['email']; ?></p>
        <?php
    }else{
        echo 'Sorry, that user doesn\'t exist';
    }
}else{
    header('location: index.php');
    exit();
}

include 'includes/overall/footer.php';
?>
</body>
</html>