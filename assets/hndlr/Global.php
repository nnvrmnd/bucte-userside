<?php

if (isset($_POST['userrn'])) {
      require 'db.hndlr.php';

      $userrn = $_POST['userrn'];

      $stmnt = "SELECT * FROM user WHERE BINARY username = ? ;";
      $query = $db->prepare($stmnt);
      $param = [$userrn];
      $query->execute($param);
      $count = $query->rowCount();
      if ($count > 0) {
            $dbData = [];
            foreach ($query as $data) {
            $username = $data['username'];
            $given = $data['given_name'];
            $surname = $data['surname'];
            // $suffix = $data['name_suffix'];

            $dbData = ["username" => $username, "given" => $given, "surname" => $surname];
            }
            $arrObject = json_encode($dbData);
            echo $arrObject;
      } else {
            echo "INTRUDER";
      }
}

if (isset($_POST['iduserrn'])) {
      require 'db.hndlr.php';

      $userrn = $_POST['iduserrn'];

      $stmnt = "SELECT * FROM user WHERE BINARY username = ? ;";
      $query = $db->prepare($stmnt);
      $param = [$userrn];
      $query->execute($param);
      $count = $query->rowCount();
      if ($count > 0) {
            $dbData = [];
            foreach ($query as $data) {
                  $id = $data['u_id'];
                  echo $id;
            }
      } else {
            echo "err:fetch";
      }
}