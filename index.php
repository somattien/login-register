  <?php
  include 'core/init.php';
  include 'includes/overall/header.php';
  ?>
  <h1>Home (index.php) toi phan 20</h1>
  <p>just a template.</p>

<?php
    if(has_access($session_user_id, 1) === true){
        echo 'Admin! AAAA';
    }else if(has_access($session_user_id, 2) === true){
        echo 'Moderator! BBBB';
    }
?>

<?php include 'includes/overall/footer.php'; ?>
</body>
</html>
