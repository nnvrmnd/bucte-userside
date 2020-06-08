<?php

/* Fetch for render */
if (isset($_POST['fetchresources'])) {
	require './db.hndlr.php';

	$stmnt = 'SELECT * FROM resource WHERE status = "present" ORDER BY uploaded_at ASC;';
	$query = $db->prepare($stmnt);
	$query->execute();
	$count = $query->rowCount();
	if ($count <= 0) {
		exit('err:fetch');
	} elseif ($count > 0) {
		$dbData = [];
		foreach ($query as $data) {
			$res_id = $data['res_id'];
			$author = $data['u_id'];
			$title = $data['title'];
			$description = $data['description'];
			$attachment = $data['attachment'];
			$restype = $data['res_type'];
			$format = $data['file_format'];
			$status = $data['status'];
			$uploaded_at = $data['uploaded_at'];

			$dbData[] = ['res_id' => $res_id, 'author' => $author, 'title' => $title, 'description' => $description, 'attachment' => $attachment, 'restype' => $restype, 'format' => $format, 'status' => $status, 'uploaded_at' => $uploaded_at];
		}
		$arrObject = json_encode($dbData);
		echo $arrObject;
	}
}