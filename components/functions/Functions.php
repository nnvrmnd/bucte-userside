<?php

function SeshStart($where) {
	session_start();

	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'][0];
		$token = $_SESSION['user'][1];
		UserRN($user, $token, $where);
	} elseif (!isset($_SESSION['user']) && $where == 'restricted') {
		header('location: login.php');
	}
}

function UserRN($user, $token, $where) {
	require './assets/hndlr/db.hndlr.php';
	$stmnt = 'SELECT * FROM user WHERE BINARY (username = ? OR email = ?) ;';
	$query = $db->prepare($stmnt);
	$param = [$user, $user];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		foreach ($query as $data) {
			$db_token = $data['token'];
			if (password_verify($db_token, $token)) {
				if ($where == 'login') {
					header('location: /app/');
				}
			} else {
				unset($_SESSION['user']);
				if ($where == 'restricted') {
					header('location: /app/');
				}
			}
		}
	} else {
		unset($_SESSION['user']);
		if ($where != 'home') {
			header('location: login.php');
		}
	}
}
