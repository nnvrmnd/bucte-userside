<?php

if (isset($_POST['welcome'])) {
	require './db.hndlr.php';

	$stmnt = "SELECT * FROM content WHERE alias = 'homepage' ;";
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

	$stmnt = 'SELECT * FROM content_images WHERE image = "image-1" ;';
	$query = $db->prepare($stmnt);
	$query->execute();
	$count = $query->rowCount();
	if ($count > 0) {
		foreach ($query as $data) {
			exit($data['folder']);
		}
	} else {
		exit('empty');
	}
}