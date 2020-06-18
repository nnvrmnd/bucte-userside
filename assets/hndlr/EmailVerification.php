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

if (isset($_POST['unverified'])) {
	require './db.hndlr.php';
	include_once './Mailer.php';

	$email = $_POST['unverified'];
	$expires = date('ymdHis', strtotime('+48 hours'));

	$db->beginTransaction();
	$stmnt = 'UPDATE unverified_user SET expires = ? WHERE BINARY email = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$expires, $email];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		if (Mailer($email, $expires) === 'sent') {
			$db->commit();
			exit('sent');
		} else {
			$db->rollBack();
			exit('err:mailer');
		}
	}
}

function CheckAccount($email) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM user WHERE BINARY email = ? AND account_status = "0" ;';
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

// echo md5('200610033247_suterusu.naito@gmail.com');
