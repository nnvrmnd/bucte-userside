<?php

/* Upcoming events */
if (isset($_POST['upcoming'])) {
	require './db.hndlr.php';

	$limit = $_POST['upcoming'];

	$stmnt = 'SELECT * FROM events ORDER BY created_at DESC ;';
	$query = $db->prepare($stmnt);
	$query->execute();
	$count = $query->rowCount();
	if ($count > 0) {
		$dbData = [];

		foreach ($query as $data) {
			$event_id = $data['evnt_id'];
			$title = $data['title'];
			$description = $data['description'];
			$start_date = $data['start_date'];
			$end_date = $data['end_date'];
			$image = $data['image'];

			$dbData[] = [
				'event_id' => $event_id,
				'title' => $title,
				'description' => $description,
				'start_date' => $start_date,
				'end_date' => $end_date,
				'image' => $image,
				'sort_date' => sortdate($start_date)
			];
		}

		echo json_encode($dbData);
	} else {
		exit('empty');
	}
}

function sortdate($date) {
	$sortdate = new DateTime($date);
	return $sortdate->format('Y-m-d');
}