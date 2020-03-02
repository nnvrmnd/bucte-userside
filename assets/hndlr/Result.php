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
if (isset($_POST['selected_reviewer']) && isset($_POST['testee'])) {
    require 'db.hndlr.php';

    $reviewer = $_POST['selected_reviewer'];
    $testee = $_POST['testee'];

    $stmnt = "SELECT q.*, r.answer AS chosen FROM questionnaire AS q, test_results AS r WHERE q.rvwr_id = ? AND r.u_id = ? AND r.qstn_id = q.qstn_id ;";
    $query = $db->prepare($stmnt);
    $param = [$reviewer, $testee];
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
            $chosen = $data['chosen'];

            $dbData[] = ['question_id' => $question_id, 'question' => $question, 'optionA' => $optionA, 'optionB' => $optionB, 'optionC' => $optionC, 'optionD' => $optionD, 'correct' => $answer, 'chosen' => $chosen];
        }
        $arrObject = json_encode($dbData);
        echo $arrObject;
    } else {
        echo 'err:fetch';
    }
}

/* Scores */
if (isset($_POST['result']) && isset($_POST['testee'])) {
    require 'db.hndlr.php';

    $reviewer = $_POST['result'];
    $testee = $_POST['testee'];

    $stmnt = "SELECT (SELECT COUNT(*) FROM questionnaire WHERE rvwr_id = ?) AS itms, (SELECT COUNT(*) FROM test_results WHERE rvwr_id = ? AND u_id = ?) AS ansd, (SELECT COUNT(*) FROM questionnaire AS q, test_results AS r WHERE q.rvwr_id = ? AND u_id = ? AND r.qstn_id = q.qstn_id AND r.answer LIKE q.answer) AS score ;";
    $query = $db->prepare($stmnt);
    $param = [$reviewer, $reviewer, $testee, $reviewer, $testee];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        $dbData = [];

        foreach ($query as $data) {
            $noitems = $data['itms'];
            $answered = $data['ansd'];
            $unanswered = $noitems - $answered;
            $score = $data['score'];

            $dbData[] = ['noitems' => $noitems, 'answered' => $answered, 'unanswered' => $unanswered, 'score' => $score];
        }
        $arrObject = json_encode($dbData);
        echo $arrObject;
    } else {
        echo 'err:fetch';
    }
}

/* If taken */
if (isset($_POST['iftaken']) && isset($_POST['testee'])) {
    require 'db.hndlr.php';

    $reviewer = $_POST['iftaken'];
    $testee = $_POST['testee'];

    $stmnt = "SELECT * FROM test_results WHERE rvwr_id = ? AND u_id = ? LIMIT 1; ;";
    $query = $db->prepare($stmnt);
    $param = [$reviewer, $testee];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        echo "taken";
    } else {
        echo '!taken';
    }
}

/* Retake test */
if (isset($_POST['retake']) && isset($_POST['testee'])) {
    require 'db.hndlr.php';

    $reviewer = $_POST['retake'];
    $testee = $_POST['testee'];

    $db->beginTransaction();
    $stmnt = "DELETE FROM test_results WHERE rvwr_id = ? AND u_id = ? ;";
    $query = $db->prepare($stmnt);
    $param = [$reviewer, $testee];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        $db->commit();
        echo "true";
    } else {
        $db->rollBack();
        echo "err:delete";
    }
}