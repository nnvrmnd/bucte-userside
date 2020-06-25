<?php

if (isset($_POST['welcome'])) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM content WHERE alias = "homepage" ;';
	$query = $db->prepare($stmnt);
	$query->execute();
	$count = $query->rowCount();
	if ($count > 0) {
		$dbData = [];
		foreach ($query as $data) {
			$dbData[] = ['title' => $data['title'], 'content' => $data['content']];
		}

		echo json_encode($dbData);
	} else {
		exit('empty');
	}
}

if (isset($_POST['image'])) {
	require './db.hndlr.php';

	$stmnt = 'SELECT meta1 FROM content WHERE alias = "homepage" ;';
	$query = $db->prepare($stmnt);
	$query->execute();
	$count = $query->rowCount();
	if ($count > 0) {
		foreach ($query as $data) {
			exit($data['meta1']);
		}
	} else {
		exit('empty');
	}
}