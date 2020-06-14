<?php

if (isset($_POST['email']) && isset($_POST['sig'])) {
	require './db.hndlr.php';
	// include_once './Mailer.php';
	$email = $_POST['email'];
	$signature = $_POST['sig'];
	$today = date('ymdHis');

	$stmnt = 'SELECT * FROM unverified_user WHERE BINARY email = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$email];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		foreach ($query as $data) {
			$e = $data['email'];
			$x = $data['expires'];
			if ($signature == md5($x . '_' . $e)) {
				if ($today <= $x) {
					if (AccountVerified($email)) {
						exit('true');
					} else {
						exit('!verified');
					}
				} else {
					exit('expired');
				}
			} else {
				exit('!signature');
			}
		}
	} else {
		echo CheckAccount($email);
	}
}

if (isset($_POST['evf_email'])) {
	require './db.hndlr.php';
	include_once './Mailer.php';

	$email = $_POST['evf_email'];
	$id = IDEmail($email);
	$expires = date('YmdHis', strtotime('+48 hours'));
	$signature = $email . '_' . $expires;

	$db->beginTransaction();
	$stmnt = 'SELECT * FROM unverified_user WHERE BINARY email = ? ;'; // check if email already exist
	$query = $db->prepare($stmnt);
	$param = [$email];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		$stmnt = 'UPDATE unverified_user SET expires = ? WHERE BINARY email = ? ;'; // update expiration
		$query = $db->prepare($stmnt);
		$param = [$expires, $email];
		$query->execute($param);
		$count = $query->rowCount();
		if ($count > 0) {
			if (VerificationEmail($email, $expires, $signature) === 'sent') {
				$db->commit();
				exit('sent');
			} else {
				$db->rollBack();
				exit('!sent');
			}
		} else {
			$db->rollBack();
			exit('err:update');
		}
	} else {
		$stmnt = 'INSERT INTO unverified_user (u_id, email, expires) VALUES (?, ?, ?) ;'; // create expiration
		$query = $db->prepare($stmnt);
		$param = [$id, $email, $expires];
		$query->execute($param);
		$count = $query->rowCount();
		if ($count > 0) {
			$db->commit();
			exit('true');
		} else {
			$db->rollBack();
			exit('err:insert');
		}
	}
}

function CheckAccount($email) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM user WHERE BINARY email = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$email];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		$db->beginTransaction();
		$stmnt = 'DELETE FROM user WHERE BINARY email = ? ;';
		$query = $db->prepare($stmnt);
		$param = [$email];
		$query->execute($param);
		$count = $query->rowCount();
		if ($count > 0) {
			$db->commit();
			return '!registered';
		} else {
			$db->rollBack();
			return 'err:checkacct';
		}
	} else {
		return '!registered';
	}
}

function AccountVerified($email) {
	require './db.hndlr.php';

	$db->beginTransaction();
	$stmnt = 'DELETE FROM unverified_user WHERE BINARY email = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$email];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		$stmnt = 'UPDATE user SET account_status = "1" WHERE BINARY email = ? ;';
		$query = $db->prepare($stmnt);
		$param = [$email];
		$query->execute($param);
		$count = $query->rowCount();
		if ($count > 0) {
			$db->commit();
			return true;
		} else {
			$db->rollBack();
			return false;
		}
	} else {
		$db->rollBack();
		return false;
	}
}

// $test = md5('suterusu.naito@gmail.com_20200402225740');
// echo $test;
// echo "<br>";
// echo "884d6e503ad4653a172ee343dc967f8a";
