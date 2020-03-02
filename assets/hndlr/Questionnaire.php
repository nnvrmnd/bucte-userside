<?php

/* Set timer */
if (isset($_POST['set_timer'])) {
    require 'db.hndlr.php';

    $reviewer = $_POST['set_timer'];

    $stmnt = "SELECT duration FROM reviewer WHERE rvwr_id = ? ;";
    $query = $db->prepare($stmnt);
    $param = [$reviewer];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        foreach ($query as $data) {
            echo $data['duration'];
        }
    } else {
        echo 'err:duration';
    }
}

/* Fetch reviewer */
if (isset($_POST['selected_reviewer'])) {
    require 'db.hndlr.php';

    $reviewer = $_POST['selected_reviewer'];

    $stmnt = "SELECT * FROM questionnaire WHERE rvwr_id = ? ORDER BY RAND()";
    $query = $db->prepare($stmnt);
    $param = [$reviewer];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        $dbData = [];
        foreach ($query as $data) {
            $question_id = $data['qstn_id'];
            $question = $data['question'];
            $optionA = $data['optionA'];
            $optionB = $data['optionB'];
            $optionC = $data['optionC'];
            $optionD = $data['optionD'];
            $answer = $data['answer'];

            $dbData[] = ['question_id' => $question_id, 'question' => $question, 'optionA' => $optionA, 'optionB' => $optionB, 'optionC' => $optionC, 'optionD' => $optionD, 'answer' => $answer];
        }
        $arrObject = json_encode($dbData);
        echo $arrObject;
    } else {
        echo 'err:fetch';
    }
}

if (isset($_POST['fetchitems']) && isset($_POST['reviewer'])) {
    require 'db.hndlr.php';

    $reviewer = $_POST['reviewer'];

    $stmnt = "SELECT * FROM questionnaire WHERE rvwr_id = ? ;";
    $query = $db->prepare($stmnt);
    $param = [$reviewer];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count <= 0) {
        echo "err:fetch";
        exit();
    } elseif ($count > 0) {
        $dbData = [];
        foreach ($query as $data) {
            $question_id = $data['qstn_id'];
            $question = $data['question'];
            $optionA = $data['optionA'];
            $optionB = $data['optionB'];
            $optionC = $data['optionC'];
            $optionD = $data['optionD'];
            $answer = $data['answer'];

            $dbData[] = ['question_id' => $question_id, 'question' => $question, 'optionA' => $optionA, 'optionB' => $optionB, 'optionC' => $optionC, 'optionD' => $optionD, 'answer' => $answer];
        }
        $arrObject = json_encode($dbData);
        echo $arrObject;
    }
}

/* New item */
if (isset($_POST['testee']) && isset($_POST['reviewer'])) {
    require 'db.hndlr.php';

    $testee = $_POST['testee'];
    $reviewer = $_POST['reviewer'];
    $answers = json_decode($_POST['answers'], true);

    $param = [];
    $stmnt = "INSERT INTO test_results (u_id, rvwr_id, qstn_id, answer) VALUES (?, ?, ?, ?)";

    for ($i=0; $i < (count($answers) - 1); $i++) {
        $stmnt .= ", (?, ?, ?, ?)";
    }

    foreach ($answers as $data) {
        $item = $data['item'];
        $choice = $data['answer'];

        $param[] = $testee;
        $param[] = $reviewer;
        $param[] = $item;
        $param[] = $choice;
    }

    $db->beginTransaction();
    $query = $db->prepare($stmnt);
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        $db->commit();
        echo "true";
    } else {
        $db->rollBack();
        echo "err:save";
    }

}
