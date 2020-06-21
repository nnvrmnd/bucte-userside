<?php

/* Join event */
if (isset($_POST['participant']) && isset($_POST['event'])) {
	require './db.hndlr.php';

	$event = $_POST['event'];
	$participant = Participant($_POST['participant']);

	if (Joined($participant, $event) === 'not') {
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

/* Check if participated */
if (isset($_POST['ratee']) && isset($_POST['event'])) {
	require './db.hndlr.php';

	$ratee = Participant($_POST['ratee']);
	$event = $_POST['event'];

	if (Joined($ratee, $event) === 'joined') {
		exit('true');
	} else {
		exit('false');
	}
}

/* Get participant ID */
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

/* Check if participant of event */
function Joined($username, $event) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM event_participants WHERE u_id = ? AND evnt_id = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$username, $event];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		return 'joined';
	} else {
		return 'not';
	}
}
