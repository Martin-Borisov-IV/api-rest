<?php
header('Content-Type: application/json');
$success = false;
$data = array();
include('pdo.php');

function response_json($success, $data, $msg_error = NULL) {
	$array['success'] = $success;
	$array['message'] = $msg_error;
	$array['result']  = $data;
	
	echo json_encode($array);
}