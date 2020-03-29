<?php

if (isset($_POST['validate_username'])) {
    require './db.hndlr.php';

    $sent_username = $_POST['validate_username'];

    $stmnt = "SELECT * FROM user WHERE BINARY username = ? ;";
    $query = $db->prepare($stmnt);
    $param = [$sent_username];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        echo "not available";
        exit();
    } else {
        echo "available";
        exit();
    }
}

if (isset($_POST['validate_email'])) {
    require './db.hndlr.php';

    $sent_email = $_POST['validate_email'];

    $stmnt = "SELECT * FROM user WHERE BINARY email = ? ;";
    $query = $db->prepare($stmnt);
    $param = [$sent_email];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        echo "not available";
        exit();
    } else {
        echo "available";
        exit();
    }
}

if (isset($_POST['create_username']) && isset($_POST['create_email'])) {
    require './db.hndlr.php';

    $given = $_POST['create_given'];
    $surname = $_POST['create_surname'];
    $username = $_POST['create_username'];
    $email = $_POST['create_email'];
    $password = password_hash($_POST['create_password'], PASSWORD_DEFAULT);
    $seq_prefix = "CTE";
    $seq_len = strlen(Sequence());
    $seq_addone = intval(Sequence()) + 1;
    $seq_series = $seq_len - strlen($seq_addone);
    $seq_zeroes = "";
    for ($i = 0; $i < $seq_series; $i++) {
        $seq_zeroes .= "0";
    }
    $new_seq = $seq_prefix . $seq_zeroes . $seq_addone;

    $db->beginTransaction();
    $stmnt = "INSERT INTO user (u_id, given_name, surname, username, email, passkey) VALUES (?, ?, ?, ?, ?, ?) ;";
    $query = $db->prepare($stmnt);
    $param = [$new_seq, $given, $surname, $username, $email, $password];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        $db->commit();
        echo $new_seq;
        exit();
    } else {
        $db->rollBack();
        echo "err:save";
        exit();
    }
}

if (isset($_POST['unverified'])) {
    require './db.hndlr.php';
    include_once './Mailer.php';

    $id = $_POST['unverified'];
    $expires = date("YmdHis", strtotime('+48 hours'));
    $email = "";
    $username = "";
    $signature = "";
    $signaturemd5 = "";

    $stmnt = "SELECT * FROM user WHERE u_id = ? ;";
    $query = $db->prepare($stmnt);
    $param = [$id];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        foreach ($query as $data) {
            $email = $data['email'];
            $username = $data['username'];
            $signature = $email . "_" . $expires;
        }

        $db->beginTransaction();
        $stmnt = "INSERT INTO unverified_user (u_id, email, expires) VALUES (?, ?, ?) ;";
        $query = $db->prepare($stmnt);
        $param = [$id, $email, $expires];
        $query->execute($param);
        $count = $query->rowCount();
        if ($count > 0) {
            $db->commit();
            echo VerificationEmail($email, $expires, $signature);
            exit();
        } else {
            $db->rollBack();
            echo UnsaveUser($id);
            exit();
        }
    }
}

function Sequence()
{
    require './db.hndlr.php';
    $stmnt = "SELECT seq FROM user ORDER BY seq DESC LIMIT 1 ;";
    $query = $db->prepare($stmnt);
    $query->execute();
    $count = $query->rowCount();
    if ($count > 0) {
        foreach ($query as $seq) {
            $latest = $seq['seq'];
            return $latest;
        }
    }
}

function UnsaveUser($todelete) {
    require './db.hndlr.php';

    $db->beginTransaction();
    $stmnt = "DELETE FROM user WHERE u_id = ? ;";
    $query = $db->prepare($stmnt);
    $param = [$todelete];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        $db->commit();
        return "err:save";
    } else {
        $db->rollBack();
        return "err:undo";
    }
}