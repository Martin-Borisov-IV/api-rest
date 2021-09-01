<?php
include_once('./../response.php');
include_once('./../common.php');

if ( strcmp($_SERVER['REQUEST_METHOD'], 'GET') == 0) {

	$input_id = isset($_GET['id']) ? $_GET['id'] : null;
	wrap_read_action('user', $input_id, 'userid', $pdo);

} else if (strcmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {

	if( !empty($_POST['email'])      && 
	    !empty($_POST['first_name']) && 
		!empty($_POST['last_name'])  && 
	    (    isset($_POST['type']) 
		  && (      $_POST['type'] == 0 
		       || ( $_POST['type'] == 1 && isset($_POST['workplace_id']) && $_POST['workplace_id'] > 0) 
		     )   
		) 
	) {

		$insert_query = "INSERT INTO `user` (`email`, 
											 `first_name`, 
											 `last_name`, 
											 `type`, 
											 `workplace_id`)
									 VALUES (:email, 
									         :first_name, 
											 :last_name, 
											 :type, 
											 :workplace_id);";
		
		$db_request = $pdo->prepare($insert_query);
		$db_request->bindParam(':email',        $_POST['email']);
		$db_request->bindParam(':first_name',   $_POST['first_name']);
		$db_request->bindParam(':last_name',    $_POST['last_name']);
		$db_request->bindParam(':type',         $_POST['type']);
		$db_request->bindParam(':workplace_id', $_POST['workplace_id']);
	
		if( $db_request->execute() ){
			$success = true;
			$msg     = 'A new user has been inserted!';
		} else {
			$msg = "An error during the storing process (user)!";
		}
	} else {
		$msg = "Missing required input information!";
	}
	
	response_json($success, $data, $msg);

} else if (strcmp($_SERVER['REQUEST_METHOD'], 'PUT') == 0) {

	$input_post_data = urldecode(file_get_contents('php://input'));

	if (strpos($input_post_data, '=') !== false) {

		$pair_params                = array();
		$unknown_keys               = array();
		$known_keys                 = array();
		$update_set_clause_elements = array();
		$allowed_fields_for_update  = array("email", "first_name", "last_name");
        $input_post_data            = explode('&', $input_post_data);

		foreach($input_post_data as $pair) {
            $pair = explode('=', $pair);
            $pair_params[$pair[0]] = $pair[1];
        }
		
		foreach($pair_params as $inp_key => $inp_val) {
			if (in_array($inp_key, $allowed_fields_for_update) === false) {
				$unknown_keys[] = $inp_key;
			} else {
				$known_keys[$inp_key] = $inp_val;
			}
		}

		/* TODO check if a user with such id exists! */
		if( empty($unknown_keys)) {
			
			$update_query = "UPDATE user 
			                    SET ";
			foreach($known_keys as $key => $value) {
				$update_set_clause_elements[] = " `$key` = :$key ";

				//$db_request->bindParam(":$key", $value);
			}
			$update_query .= implode(",", $update_set_clause_elements);
			$update_query .= "WHERE `id` = :userid";
			
			$db_request = $pdo->prepare($update_query);
			foreach($known_keys as $key => $value) {
				$db_request->bindValue(":" . $key, $value);
			}
			$db_request->bindParam(':userid', $_GET['id']);
			
			if( $db_request->execute() ){
				$success = true;
				$msg     = "User with id {$_GET['id']} has been updated!";
			} else {
				$msg = "There is an error while updating the user !";
			}

		} else {
			$msg = "Unknown fields to be updated: " . implode(", ", $unknown_keys);
		}
	} else {
		$msg = "Missing input data for update";
	}

	response_json($success, $data, $msg);

} else if (strcmp($_SERVER['REQUEST_METHOD'], 'DELETE') == 0) {

	$input_id = isset($_GET['id']) ? $_GET['id'] : 0;
	wrap_delete_action("user", $input_id, 'id', $pdo);

}
