<?php
   include_once './config/Database.php';

   header("Content-Type: application/json; charset=UTF-8");

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();
   $table = 'quiz';

   date_default_timezone_set("Singapore");
   $date = date("d/m/Y");
   $time = date("h:ia");

   // get the json string and decode it
   $json = file_get_contents('php://input');
   $data = json_decode($json);

   $query = 'INSERT INTO ' . $table . ' SET 
               name = :name,
               date = :date,
               time = :time,
               numOfQues = :numOfQues,
               timeLimit = :timeLimit';

   $stmt = $db->prepare($query);
   $stmt->bindParam(':name', $data->name);
   $stmt->bindParam(':date', $date);
   $stmt->bindParam(':time', $time);
   $stmt->bindParam(':numOfQues', $data->ques);
   $stmt->bindParam(':timeLimit', $data->time);

   // ************** uncomment these later. RN testing other parts and dont want to spam DB
   /* if ($stmt->execute()) {
      echo json_encode('Success');
   } else {
      echo json_encode("Error: %s.\n", $stmt->error);
   } */

   echo json_encode($data->time);
?>