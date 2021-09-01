<?php
include('./../response.php');

if ( strcmp($_SERVER['REQUEST_METHOD'], 'GET') == 0) {

	if( isset($_GET['order']) && !empty($_GET['order'])) {

		if( strcmp("desc", $_GET['order']) == 0 || strcmp("asc", $_GET['order']) == 0) {

			$select_query = "SELECT t.hospital_name,
			                        t.count_employees
							   FROM (SELECT h.name AS `hospital_name`, 
			                                COUNT(u.id) AS `count_employees`
	                                   FROM `hospital` AS h
							           JOIN `user` AS u ON u.workplace_id = h.id AND u.type = 1
							          GROUP BY h.name) AS t
						   ORDER BY count_employees " . strtoupper($_GET['order']) . " , hospital_name";
			/* when the count is the same, order by the name of the hospital */

			$db_request = $pdo->prepare($select_query);
			
			if( $db_request->execute() ){
				$result = $db_request->fetchAll(PDO::FETCH_CLASS);

				$success           = true;
				$data['hospitals'] = $result;
				$msg               = "Hospitals are order by their count of employees ({$_GET['order']})";
			} else {
				$msg = "There is an error while getting the list of users!";
			}

		} else {
			$msg = "Unknown type of ordering!";
		}
	} else {
		$msg = "Missing information for listing of hospitals!";
	}

	response_json($success, $data, $msg);
} else {
	response_json(false, array(), "Unknown method!");
}
