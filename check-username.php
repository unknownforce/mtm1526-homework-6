<?php

require_once 'includes/db.php';

$errors = array();

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($username)) {
		$errors['username'] = true;	
	}
	
	if (empty($errors)) {
		$sql = $db->prepare('
			SELECT username
			FROM form_users
			WHERE username = :username
			LIMIT 1
		');
		$sql->bindValue(':username', $username, PDO::PARAM_STR);
		$sql->execute();
		
		$results = $sql->fetch();
		
		if (empty($results)) {
			echo 'available';		
		} else {
			echo 'unavailable';
		}
	}
}