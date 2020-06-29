<?php

if (isset($_POST['contact'])) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM content WHERE alias = "contact" ;';
	$query = $db->prepare($stmnt);
	$query->execute();
	$count = $query->rowCount();
	if ($count > 0) {
		$dbData = [];
		foreach ($query as $data) {
			$dbData[] = ['phone' => $data['meta1'], 'address' => $data['meta2'], 'email' => $data['meta3'], 'open' => $data['meta4'], 'close' => $data['meta5'], 'embed' => $data['content']];
		}
		$arrObject = json_encode($dbData);
		echo $arrObject;
	}
}