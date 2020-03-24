<?php
   include_once './config/Database.php';

   header("Content-Type: application/json; charset=UTF-8");

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();

   // get the json string and decode it
   $json = file_get_contents('php://input');
   $data = json_decode($json);

   $query = 'INSERT INTO admin SET 
               username = :name,
               password = :pwd,
               email = :email';

   //hash the password
   $hashedPassword = password_hash($data->password, PASSWORD_DEFAULT);
   
   $stmt = $db->prepare($query);
   $stmt->bindParam(':name', $data->username);
   $stmt->bindParam(':pwd', $hashedPassword);
   $stmt->bindParam(':email', $data->email);

   if ($stmt->execute()) {
      $msg = "Success.";
      echo json_encode($msg);
   } else {
      $msg = "Error";
      echo json_encode($msg);
   }