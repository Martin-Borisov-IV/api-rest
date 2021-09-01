<?php
include('./../response.php');
include_once('./../common.php');

if ( strcmp($_SERVER['REQUEST_METHOD'], 'GET') == 0) {

	$input_id = isset($_GET['id']) ? $_GET['id'] : null;
	wrap_read_action('hospital', $input_id, 'hospitalid', $pdo);

} else if (strcmp($_SERVER['REQUEST_METHOD'], 'DELETE') == 0) {
	
	$input_id = isset($_GET['id']) ? $_GET['id'] : 0;
	wrap_delete_action("hospital", $input_id, 'id', $pdo);

} else if (strcmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
	if( !empty($_POST['name'])      && 
	    !empty($_POST['address']) && 
		!empty($_POST['phone'])) {

		$insert_query = "INSERT INTO `hospital` (`name`, 
					                 `address`, 
		                                         `phone`)
						 VALUES (:name, 
	                                                 :address, 
					                 :phone);";
		
		$db_request = $pdo->prepare($insert_query);
		$db_request->bindParam(':name',    $_POST['name']);
		$db_request->bindParam(':address', $_POST['address']);
		$db_request->bindParam(':phone',   $_POST['phone']);
	
		if( $db_request->execute() ){
			$success = true;
			$msg     = 'A new hospital has been inserted!';
		} else {
			$msg = "An error during the storing process (hospital)!";
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
		$allowed_fields_for_update  = array("name", "address", "phone");
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

		/* TODO check if a hospital with such id exists! */
		if( empty($unknown_keys)) {
			
			$update_query = "UPDATE hospital 
			                    SET ";
			foreach($known_keys as $key => $value) {
				$update_set_clause_elements[] = " `$key` = :$key ";
			}
			
			$update_query .= implode(",", $update_set_clause_elements);
			$update_query .= "WHERE `id` = :hospitalid";
			
			$db_request = $pdo->prepare($update_query);
			foreach($known_keys as $key => $value) {
				$db_request->bindValue(":" . $key, $value);
			}
			$db_request->bindParam(':hospitalid', $_GET['id']);
			
			if( $db_request->execute() ){
				$success = true;
				$msg     = "Hospital with id {$_GET['id']} has been updated!";
			} else {
				$msg = "There is an error while updating the hospital !";
			}

		} else {
			$msg = "Unknown fields to be updated: " . implode(", ", $unknown_keys);
		}
	} else {
		$msg = "Missing input data for update";
	}

	response_json($success, $data, $msg);

}
