<?php

if (isset($_POST['participant']) && isset($_POST['event'])) {
	require './db.hndlr.php';

	$event = $_POST['event'];
	$participant = Participant($_POST['participant']);

	if (Joined($participant) === true) {
		$db->beginTransaction();
		$stmnt = 'INSERT INTO event_participants (evnt_id, u_id) VALUES (?, ?) ;';
		$query = $db->prepare($stmnt);
		$param = [$event, $participant];
		$query->execute($param);
		$count = $query->rowCount();
		if ($count > 0) {
			$db->commit();
			exit('true');
		} else {
			$db->rollBack();
			exit('err:join');
		}
	} else {
		exit('joined');
	}
}

function Participant($username) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM user WHERE (username = ? OR email = ?)';
	$query = $db->prepare($stmnt);
	$param = [$username, $username];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		foreach ($query as $data) {
			return $data['u_id'];
		}
	}
}

function Joined($username) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM event_participants WHERE u_id = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$username];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		return 'joined';
	} else {
		return true;
	}
}
