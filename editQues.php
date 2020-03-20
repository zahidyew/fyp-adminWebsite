<?php
   include_once './config/Database.php';

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();

   $postValues = explode(",", $_POST['submit']);
   $quesId = $postValues[0];
   $quizId = $postValues[1];

   //echo $quizId;

   // check if POST vars are set
   if (isset($_POST['question']) && isset($_POST['answer'])) {
      $question = $_POST['question'];
      $choice1 = $_POST['choice1'];
      $choice2 = $_POST['choice2'];
      $choice3 = $_POST['choice3'];
      $choice4 = $_POST['choice4'];
      $answer = $_POST['answer'];

      // SQL query and execute
      $query = 'UPDATE question SET 
                  ques = :ques, 
                  choiceA = :choiceA, 
                  choiceB = :choiceB,
                  choiceC = :choiceC,
                  choiceD = :choiceD,
                  answer = :answer
                  WHERE id = :id';

      $stmt = $db->prepare($query);
      $stmt->bindParam(':ques', $question);
      $stmt->bindParam(':choiceA', $choice1);
      $stmt->bindParam(':choiceB', $choice2);
      $stmt->bindParam(':choiceC', $choice3);
      $stmt->bindParam(':choiceD', $choice4);
      $stmt->bindParam(':answer', $answer);
      $stmt->bindParam(':id', $quesId);

      if ($stmt->execute()) {
         $query2 = 'SELECT name FROM quiz WHERE id = ' . $quizId; 
         $stmt2 = $db->prepare($query2);
         $stmt2->execute();
         $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

         redirectTo('./viewQuestions.php?id=' .$quizId. '&quiz=' .$row2['name']);
      } else {
         printf("Error: %s.\n", $stmt->error);
         //return false;
      }
   }

   function redirectTo($url)
   {
      ob_start();
      header('Location: ' . $url);
      ob_end_flush();
      die();
   }
?>