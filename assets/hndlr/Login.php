<?php

if (isset($_POST['user']) && isset($_POST['pass'])) {
	require './db.hndlr.php';

	$username = $_POST['user'];
	$password = $_POST['pass'];

	$stmnt = 'SELECT * FROM user WHERE BINARY (username = ? OR email = ?) ;';
	$query = $db->prepare($stmnt);
	$param = [$username, $username];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		foreach ($query as $data) {
			$status = $data['account_status'];
			$usrnm = $data['username'];
			$email = $data['email'];
			$hash = $data['passkey'];
			$token = $usrnm . '' . date('mdYHis'); // set date to time 24
			if ($status != '0') {
				if (($username == $usrnm || $username == $email) && password_verify($password, $hash)) {
					if (SetToken($token, $usrnm) == 'true') {
						session_start();
						$_SESSION['user'] = [$usrnm, password_hash($token, PASSWORD_DEFAULT)];
						exit('true');
					}
				} else {
					exit('err:1');
				}
			} else {
				exit('unverified');
			}
		}
	} else {
		exit('err:0');
	}
}

if (isset($_POST['loginpage_user']) && isset($_POST['loginpage_pass'])) {
	require './db.hndlr.php';

	$username = $_POST['loginpage_user'];
	$password = $_POST['loginpage_pass'];

	$stmnt = 'SELECT * FROM user WHERE BINARY (username = ? OR email = ?) ;';
	$query = $db->prepare($stmnt);
	$param = [$username, $username];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		foreach ($query as $data) {
			$status = $data['account_status'];
			$usrnm = $data['username'];
			$email = $data['email'];
			$hash = $data['passkey'];
			$token = $usrnm . '' . date('mdYHis'); // set date to time 24
			if ($status != '0') {
				if (($username == $usrnm || $username == $email) && password_verify($password, $hash)) {
					if (SetToken($token, $usrnm) == 'true') {
						session_start();
						$_SESSION['user'] = [$usrnm, password_hash($token, PASSWORD_DEFAULT)];
						exit('true');
					}
				} else {
					exit('err:1');
				}
			} else {
				exit('unverified');
			}
		}
	} else {
		exit('err:0');
	}
}

if (isset($_POST['logout'])) {
	session_start();
	unset($_SESSION['user']);
	exit('true');
}

function SetToken($token, $who) {
	require './db.hndlr.php';

	$db->beginTransaction();
	$stmnt = 'UPDATE user SET token = ? WHERE username = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$token, $who];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		$db->commit();
		return 'true';
	} else {
		$db->rollBack();
		return 'err:fn';
	}
}
