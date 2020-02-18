<?php
   include_once './config/Database.php';

   header("Content-Type: application/json; charset=UTF-8");

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();
   $table = 'question';

   // get the json string and decode it
   $json = file_get_contents('php://input');
   $data = json_decode($json);

   // split the String into arrays of respective orders
   $questionArray = explode(";", $data->questions);
   $choiceA_array = explode(";", $data->choiceA);
   $choiceB_array = explode(";", $data->choiceB);
   $choiceC_array = explode(";", $data->choiceC);
   $choiceD_array = explode(";", $data->choiceD);
   $answersArray = explode(";", $data->answers);
   $numOfQues = sizeof($questionArray); 

   for($i = 0; $i < $numOfQues; $i++) {
      $query = 'INSERT INTO ' . $table . ' SET 
                  ques = :ques,
                  choiceA = :choiceA,
                  choiceB = :choiceB,
                  choiceC = :choiceC,
                  choiceD = :choiceD,
                  answer = :answer,
                  quizId = :quizId';

      $stmt = $db->prepare($query);
      $stmt->bindParam(':ques', $questionArray[$i]);
      $stmt->bindParam(':choiceA', $choiceA_array[$i]);
      $stmt->bindParam(':choiceB', $choiceB_array[$i]);
      $stmt->bindParam(':choiceC', $choiceC_array[$i]);
      $stmt->bindParam(':choiceD', $choiceD_array[$i]);
      $stmt->bindParam(':answer', $answersArray[$i]);
      $stmt->bindParam(':quizId', $data->quizId);

      if($stmt->execute()) {
         echo json_encode(200);
      }
      else {
         echo json_encode(500);
      }
   }

   
