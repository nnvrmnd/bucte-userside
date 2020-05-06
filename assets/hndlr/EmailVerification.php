<?php

if (isset($_POST['exp']) && isset($_POST['sig'])) {
   require './db.hndlr.php';
   include_once './Mailer.php';

   $passed_email = $_POST['email'];
   $passed_exp = $_POST['exp'];
   $passed_sig = $_POST['sig'];
   $re_sig = md5($passed_email . "_" . $passed_exp);
   $date_today = date('YmdHis');
   // $date_today = date('YmdHis', strtotime('+24 hours'));

   if ($passed_sig !== $re_sig) {
      exit("!signature");
   }

   $stmnt = "SELECT * FROM user WHERE BINARY email = ? AND account_status = '0' ;";
   $query = $db->prepare($stmnt);
   $param = [$passed_email];
   $query->execute($param);
   $count = $query->rowCount();
   if ($count > 0) {
      foreach ($query as $data) {
         $id = $data['u_id'];
         $stmnt = "SELECT * FROM unverified_user WHERE u_id = ? ;";
         $query = $db->prepare($stmnt);
         $param = [$id];
         $query->execute($param);
         $count = $query->rowCount();
         if ($count > 0) {
            foreach ($query as $data) {
               $signature = md5($data['email'] . "_" . $data['expires']);
               $expires = $data['expires'];
               switch (false) {
                  case $signature === $passed_sig:
                     exit('!signature1');
                     break;
                  case $date_today <= $expires:
                     exit('expired!');
                     break;

                  default:
                     echo VerifyAccount($id);
                     break;
               }
            }
         } else {
            exit("verification !exist");
         }
      }
   } else {
      exit("clear");
   }

}

if (isset($_POST['evf_email'])) {
   require './db.hndlr.php';
   include_once './Mailer.php';

   $email = $_POST['evf_email'];
   $id = IDEmail($email);
   $expires = date('YmdHis', strtotime('+48 hours'));
   $signature = $email . "_" . $expires;

   $db->beginTransaction();
   $stmnt = "SELECT * FROM unverified_user WHERE BINARY email = ? ;"; // check if email already exist
   $query = $db->prepare($stmnt);
   $param = [$email];
   $query->execute($param);
   $count = $query->rowCount();
   if ($count > 0) {
      $stmnt = "UPDATE unverified_user SET expires = ? WHERE BINARY email = ? ;"; // update expiration
      $query = $db->prepare($stmnt);
      $param = [$expires, $email];
      $query->execute($param);
      $count = $query->rowCount();
      if ($count > 0) {
         if (VerificationEmail($email, $expires, $signature) === "sent") {
            $db->commit();
            exit('sent');
         } else {
            $db->rollBack();
            exit('!sent');
         }
      } else {
         $db->rollBack();
         exit('err:update');
      }
   } else {
      $stmnt = "INSERT INTO unverified_user (u_id, email, expires) VALUES (?, ?, ?) ;"; // create expiration
      $query = $db->prepare($stmnt);
      $param = [$id, $email, $expires];
      $query->execute($param);
      $count = $query->rowCount();
      if ($count > 0) {
         $db->commit();
         exit('true');
      } else {
         $db->rollBack();
         exit('err:insert');
      }
   }
}

function IDEmail($email) {
   require './db.hndlr.php';
   $stmnt = "SELECT u_id FROM user WHERE BINARY email = ? ;";
   $query = $db->prepare($stmnt);
   $param = [$email];
   $query->execute($param);
   $count = $query->rowCount();
   if ($count > 0) {
      foreach ($query as $data) {
         return $data['u_id'];
      }
   }
}

function VerifyAccount($id) {
   require './db.hndlr.php';

   $db->beginTransaction();
   $stmnt = "DELETE FROM unverified_user WHERE u_id = ? ;";
   $query = $db->prepare($stmnt);
   $param = [$id];
   $query->execute($param);
   $count = $query->rowCount();
   if ($count > 0) {
      $stmnt = "UPDATE user SET account_status = '1' WHERE u_id = ? ;";
      $query = $db->prepare($stmnt);
      $param = [$id];
      $query->execute($param);
      $count = $query->rowCount();
      if ($count > 0) {
         $db->commit();
         return "verified!";
      } else {
         $db->rollBack();
      }
   } else {
      $db->rollBack();
      return "!verified";
   }

}

// $test = md5('suterusu.naito@gmail.com_20200402225740');
// echo $test;
// echo "<br>";
// echo "884d6e503ad4653a172ee343dc967f8a";