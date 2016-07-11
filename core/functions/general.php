<?php

function email($to, $subject, $body){
   mail($to, $subject, $body, 'From: somattien@gmail.com');
}

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


// ham` loai bo cac ky tu dac biet
function array_sanitize(&$item){
    $item = mysql_real_escape_string($item);
}
	
	
function sanitize($data){
    return mysql_real_escape_string($data);
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