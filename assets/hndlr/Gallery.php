<?php

/* Fetch for render */
if (isset($_POST['fetchgallery'])) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM events ORDER BY start_date ASC;';
	$query = $db->prepare($stmnt);
	$query->execute();
	$count = $query->rowCount();
	if ($count <= 0) {
		exit('err:fetch');
	} elseif ($count > 0) {
		$dbData = [];
		foreach ($query as $data) {
			$event_id = $data['evnt_id'];
			$title = $data['title'];
			$image = $data['image'];
			$start = $data['start_date'];

			$dbData[] = ['event_id' => $event_id, 'title' => $title, 'image' => $image, 'start' => $start];
		}
		$arrObject = json_encode($dbData);
		echo $arrObject;
	}
}