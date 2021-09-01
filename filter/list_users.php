<?php
include('./../response.php');

if ( strcmp($_SERVER['REQUEST_METHOD'], 'GET') == 0) {

	/* The task: Expose functionality to list users and the ability to search them by workplace and title. 
	 * If I understand it corretly: For me this is very strange and it does not make sense
	 * That is why I will do the functionality to search by workplace (id of the hospital) OR title (the name of the hospital).
	 */
	if( isset($_GET['param']) && !empty($_GET['param'])) {
		$input_param        = trim($_GET['param']);
		$regular_expression = "/^[1-9]+[0-9]*$/";
		$array_ids          = array();

		if( preg_match($regular_expression, $input_param) === 0) {
			// echo "Not numbers only";
			$u = "%" . $input_param . "%";
			$get_hospital_ids_query = "SELECT `id`
			                             FROM `hospital`
									 	WHERE `name` LIKE ?";
			
			//echo "Result " . print_r($get_hospital_ids_query, true) . PHP_EOL;

			$db_request = $pdo->prepare($get_hospital_ids_query);
			$db_request->bindParam(1, $u, PDO::PARAM_STR);

			if( $db_request->execute() ){
				$result = $db_request->fetchAll(PDO::FETCH_CLASS);

				if( !empty($result) ) {
					foreach($result as $hospital) {
						$array_ids[] = $hospital->id;
					}
				}
				
			}
			
		} else {
			$array_ids[] = $input_param;
		}

		$str_ids = implode(", ", array_fill(0, count($array_ids), '?'));
		
		$select_query = "SELECT * 
	                       FROM `user` 
					      WHERE `type` =  1 
						    AND workplace_id IN ($str_ids) ";

		$db_request = $pdo->prepare($select_query);
		
		foreach ($array_ids as $k => $id) {
			$db_request->bindValue( ($k+1), $id, PDO::PARAM_INT);
		}

		if( $db_request->execute() ){
			$result = $db_request->fetchAll(PDO::FETCH_CLASS);

			$success       = true;
			$data['count'] = count($result);
			$data['users'] = $result;
			$msg           = "{$data['count']} users are taken from the database";
		} else {
			$msg = "There is an error while getting the list of users!";
		}

	} else {
		$msg = "Missing information for listing of users by id OR title!";
	}
	response_json($success, $data, $msg);
} else {
	response_json(false, array(), "Unknown method!");
}
