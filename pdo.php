<?php
$host        = 'localhost';
$port        = '3306';
$db_name     = 'api';
$user        = 'user';
$password    = '';

try {
	//Test the connection to the database
    //$pdo = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$db_name, $user, $password);
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=api;', 'root', '');
} catch(Exception $e) {
	//If the connection is not established, then inform the user
	response_json($success, $data, 'Failed to connect to the database!');
    exit();
}