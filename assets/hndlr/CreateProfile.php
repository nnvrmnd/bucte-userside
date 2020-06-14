<?php

/* Check username availability */
if (isset($_POST['id']) && isset($_POST['username'])) {
	require './db.hndlr.php';

	$id = $_POST['id'];
	$username = $_POST['username'];

	if ($id !== '0') {
		$stmnt = 'SELECT * FROM user WHERE BINARY username = ? AND u_id != ? ;';
		$param = [$username, $id];
	} else {
		$stmnt = 'SELECT * FROM user WHERE BINARY username = ? ;';
		$param = [$username];
	}

	$query = $db->prepare($stmnt);
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		exit('false');
	} else {
		exit('true');
	}
}

/* Check email availability */
if (isset($_POST['id']) && isset($_POST['email'])) {
	require './db.hndlr.php';

	$id = $_POST['id'];
	$email = $_POST['email'];

	if ($id !== '0') {
		$stmnt = 'SELECT * FROM user WHERE BINARY email = ? AND u_id != ? ;';
		$param = [$email, $id];
	} else {
		$stmnt = 'SELECT * FROM user WHERE BINARY email = ? ;';
		$param = [$email];
	}

	$query = $db->prepare($stmnt);
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		exit('false');
	} else {
		exit('true');
	}
}

/* Create account */
if (isset($_POST['create_username']) && isset($_POST['create_email'])) {
	require './db.hndlr.php';

	function sequence() {
		require './db.hndlr.php';
		$stmnt = 'SELECT seq FROM user ORDER BY seq DESC LIMIT 1 ;';
		$query = $db->prepare($stmnt);
		$query->execute();
		$count = $query->rowCount();
		if ($count > 0) {
			foreach ($query as $data) {
				$seq = $data['seq'];
				$seqlen = strlen($seq);
				$newseq = $seq + 1;
				return 'CTE' . str_pad($newseq, $seqlen, '0', STR_PAD_LEFT);
			}
		}
	}

	$given = $_POST['create_given'];
	$surname = $_POST['create_surname'];
	$username = $_POST['create_username'];
	$email = $_POST['create_email'];
	$password = password_hash($_POST['create_password'], PASSWORD_DEFAULT);
	$seq = sequence();

	$db->beginTransaction();
	$stmnt = 'INSERT INTO user (u_id, given_name, surname, username, email, passkey) VALUES (?, ?, ?, ?, ?, ?) ;';
	$query = $db->prepare($stmnt);
	$param = [$seq, $given, $surname, $username, $email, $password];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		$db->commit();
		exit($seq);
	} else {
		$db->rollBack();
		exit('err:save');
	}
}

if (isset($_POST['unverified'])) {
	require './db.hndlr.php';
	include_once './Mailer.php';

	$id = $_POST['unverified'];
	$expires = date('ymdHis', strtotime('+48 hours'));
	$email = '';
	$username = '';

	$stmnt = 'SELECT * FROM user WHERE u_id = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$id];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		foreach ($query as $data) {
			$email = $data['email'];
			$username = $data['username'];
		}

		$db->beginTransaction();
		$stmnt = 'INSERT INTO unverified_user (u_id, email, expires) VALUES (?, ?, ?) ;';
		$query = $db->prepare($stmnt);
		$param = [$id, $email, $expires];
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
		} else {
			$db->rollBack();
			echo UnsaveUser($id);
			exit();
		}
	}
}

function UnsaveUser($id) {
	require './db.hndlr.php';

	$db->beginTransaction();
	$stmnt = 'DELETE FROM user WHERE u_id = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$id];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		$db->commit();
		return 'err:save';
	} else {
		$db->rollBack();
		return 'err:undo';
	}
}
