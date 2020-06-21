<?php

if (isset($_POST['getsurvey'])) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM assessment ORDER BY assmnt_id ;';
	$query = $db->prepare($stmnt);
	$query->execute();
	$count = $query->rowCount();
	if ($count > 0) {
		$dbData = [];
		foreach ($query as $data) {
			$assessment_id = $data['assmnt_id'];
			$question = $data['question'];
			$optionA = $data['optionA'];
			$optionB = $data['optionB'];
			$optionC = $data['optionC'];
			$optionD = $data['optionD'];

			$dbData[] = ['assessment_id' => $assessment_id, 'question' => $question, 'optionA' => $optionA, 'optionB' => $optionB, 'optionC' => $optionC, 'optionD' => $optionD];
		}
		$arrObject = json_encode($dbData);
		echo $arrObject;
	} else {
		echo 'err:fetch';
	}
}

if (isset($_POST['guest'])) {
	require './db.hndlr.php';

	$guest = Participant($_POST['guest']);
	$event = $_POST['event'];

	$stmnt = 'SELECT * FROM  assessment_result WHERE u_id = ? AND evnt_id = ? ;';
	$query = $db->prepare($stmnt);
	$param = [$guest, $event];
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		exit('done');
	} else {
		exit('not');
	}
}

if (isset($_POST['survey'])) {
	require './db.hndlr.php';

	$event = $_POST['survey'];
	$answers = json_decode($_POST['form'], true);
	$participant = Participant($_POST['ratee']);

	$param = [];
	$stmnt = 'INSERT INTO assessment_result (u_id, evnt_id, assmnt_id, answer) VALUES (?, ?, ?, ?)';

	for ($i = 0; $i < (count($answers) - 1); $i++) {
		$stmnt .= ', (?, ?, ?, ?)';
	}

	foreach ($answers as $data) {
		$item = $data['name'];
		$choice = $data['value'];

		$param[] = $participant;
		$param[] = $event;
		$param[] = $item;
		$param[] = $choice;
	}

	$db->beginTransaction();
	$query = $db->prepare($stmnt);
	$query->execute($param);
	$count = $query->rowCount();
	if ($count > 0) {
		$db->commit();
		echo 'true';
	} else {
		$db->rollBack();
		echo 'err:save';
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
