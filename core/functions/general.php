<?php

//function email($to, $subject, $body){
//   mail($to, $subject, $body, 'From: somattien@gmail.com');
//}

function logged_in_redirect(){
     if(logged_in() === true){
        header ('location: index.php');
        exit();
    }
}

function protect_page(){
    if(logged_in() === false){
        header ('location: protected.php');
        exit();
    }
}
//ADMIN
function admin_protect(){
    global $user_data;
    if(has_access($user_data['user_id'], 1) === false){
        header ('location: index.php');
        exit();
    }
}


// ham` loai bo cac ky tu dac biet
function array_sanitize(&$item){
    $item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}
	
	
function sanitize($data){
    return htmlentities(strip_tags(mysql_real_escape_string($data)));
}
	
function output_errors($errors){
    $output = array();
    foreach ($errors as $error){ // chuyen $errors la $error
        //echo $error .  ', ';
        $output[] ="<li>" . $error . "</li>" ;
    }
    return "<ul>" . implode(' ', $output) . "</ul>";  // chuyen &ouptut tu mang thanh` chuoi (nguoc voi explode)
}
?>
