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

   if ($stmt->execute()) {
      // get the ID of the quiz so that we can link the quiz with the questions.
      $query2 = 'SELECT id FROM ' . $table . 
                  ' WHERE name = :name
                   AND date = :date
                   AND time = :time
                   AND numOfQues = :numOfQues
                   AND timeLimit = :timeLimit';

      $stmt2 = $db->prepare($query2);
      $stmt2->bindParam(':name', $data->name);
      $stmt2->bindParam(':date', $date);
      $stmt2->bindParam(':time', $time);
      $stmt2->bindParam(':numOfQues', $data->ques);
      $stmt2->bindParam(':timeLimit', $data->time);
      $stmt2->execute();

      $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
      $id = $row2['id'];

      echo json_encode($id);
   } else {
      echo json_encode("Error: %s.\n", $stmt->error);
   }
   //echo json_encode($data->name);
?>