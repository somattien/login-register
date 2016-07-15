<?php


//UPDATE SETTINGS
function update_user($update_data){
    global $session_user_id;
    $update = array();
	array_walk($update_data, 'array_sanitize');
    
    foreach($update_data as $field => $data){
        $update[] = ' ' . $field . ' = \'' . $data . '\'';
    }
    
    mysql_query("UPDATE users SET " . implode(',', $update) . " WHERE user_id = $session_user_id");
}



//ACTIVARE FROM EMAIL
function activate($email, $email_code){
    $email = mysql_real_escape_string($email);
    $email_code = mysql_real_escape_string($email_code);
    if(mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE email = '$email' AND email_code = '$email_code' AND active = 0"), 0) == 1){
//        query to update user active status
        mysql_query("UPDATE users SET active = 1 WHERE email = '$email'");
        return true;
    } else {
        return false;
    }
    
}

//CHANGE PASSWORD
function change_password($user_id, $password){
    $user_id = (int) $user_id;
    $password = md5 ($password);
    
    mysql_query("UPDATE users SET password = '$password' WHERE user_id = '$user_id'");
}

//DANG KY
		function register_user($register_data){
			array_walk($register_data, 'array_sanitize');
			$register_data['password'] = md5($register_data['password']);
			
			$fields = '' .  implode (', ', array_keys($register_data)) . '';
			$data = '\'' .  implode ('\', \'', $register_data) . '\'';
			mysql_query("INSERT INTO users ($fields) VALUES ($data)");    
            
            //email($to, $body) ----  SEND THE MAIL TO YOUR EMAIL
            email ($register_data['email'], 'http://localhost/login-register/activate.php?email=' . $register_data["email"] . '&email_code=' . $register_data["email_code"]);
		}

//DEM SO LUONG user dang ky da active
		function user_count(){
			return mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE active = 1"),0);
		}

// LAY DU LIEU cua user
		function user_data($user_id){
			$data = array();
			$user_id = (int)$user_id;
			
			$func_num_args = func_num_args();//Không cần một biến quy định nào, nó cứ thế mà lấy thôi. thuong duoc ket hop voi ham` func_get_args()			
			$func_get_args = func_get_args();//hàm dùng để lấy tất cả biến được truyền vào trong hàm thành một mảng.
			//echo $func_num_args;
			//print_r($func_get_args);
			if($func_num_args > 1){
				unset($func_get_args[0]); // xoa 1 phan tu trong array
				
				$fields ='' .  implode (', ', $func_get_args) . '';
				//echo "SELECT $fields FROM users WHERE user_id = $user_id";
				$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM users WHERE user_id = $user_id")); // associative array la mang ket hop ('ten' => gia tri)			
				return $data;
			}
		}
		
		function logged_in(){
			return(isset($_SESSION['user_id'])) ? true : false; // tra ve ket qua true hay false
		}
		function user_exists($username){
			$username = sanitize($username);
			return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username'"), 0) == 1) ? true : false;
		}
		
		function email_exists($email){
			$username = sanitize($email);
			return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE email = '$email'"), 0) == 1) ? true : false;
		}
		
		function user_active($username){
			$username = sanitize($username);
			return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username' AND active = 1"), 0) == 1) ? true : false;
		}
		
		function user_id_from_username($username){
			$username = sanitize($username);
			return mysql_result(mysql_query("SELECT user_id FROM users WHERE username = '$username'"), 0, 'user_id');// 1
			}
		
		function login($username, $password){
			$user_id = user_id_from_username($username);
	
			$username = sanitize($username);
			$password = md5($password);
			/*echo 'ten: '. $username . '<br><br>' ;
			echo 'password: ' . $password . '<br><br>' ;*/
			return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username' AND password = '$password'"), 0) == 1) ? $user_id : false; // tra ve ket qua 1 hay false
			

		}


		

?>