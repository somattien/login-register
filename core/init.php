<?php

session_start();
error_reporting(0); // ko xuat hien report connect database 0

// conection database
require 'database/connect.php';  /*khac voi include*/
require 'functions/general.php';
require 'functions/email.php';
require 'functions/users.php';

if(logged_in() === true){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email');  // chay function user_data();
	
	if(user_active($user_data['username']) === false){
		session_destroy();
		header('location: index.php');
		exit();
	}
}


$errors = array();
?>