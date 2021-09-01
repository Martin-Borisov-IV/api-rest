<?php

function wrap_read_action($table_name, $input_id, $input_bind, $pdo) {

	$select_query = "SELECT * 
	                   FROM `{$table_name}`";
	
	if( isset($input_id) && !empty($input_id) ){
		// Check for one particular user (using its id)
		$select_query .= "WHERE `id` = :" . $input_bind;

		$db_request = $pdo->prepare($select_query);
		$db_request->bindParam(':' . $input_bind, $input_id);
	} else {
		// Otherwise return all the users
		$db_request = $pdo->prepare($select_query);
	}

	if( $db_request->execute() ){
		$result = $db_request->fetchAll(PDO::FETCH_CLASS);
		//var_dump($resultats);
		
		$success       = true;
		$data['count'] = count($result);
		$data['users'] = $result;
		$msg           = "{$data['count']} {$table_name}s are taken from the database";
	} else {
		$msg = "There is an error while getting the {$table_name}s!";
	}

	response_json($success, $data, $msg);
}

function wrap_delete_action($table_name, $input_id, $input_bind, $pdo) {

	$data = array();

	if( isset($input_id) && !empty($input_id) && $input_id > 0 ){
		
		$db_request = $pdo->prepare("DELETE FROM `{$table_name}` WHERE `id` = :" . $input_bind);
		$db_request->bindParam(':' . $input_bind, $input_id);

		if( $db_request->execute() ){
			$success = true;
			$msg     = "The {$table_name} is deleted!";
		} else {
			$success = false;
			$msg     = "A problem during the deletion of a {$table_name}!";
		}

	} else {
		$success = false;
		$msg     = "Unknown {$table_name}'s id!";
	}

	response_json($success, $data, $msg);
}