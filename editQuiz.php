<?php
   include_once './config/Database.php';

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();

   // check if POST vars are set
   if (isset($_POST['quizName']) && isset($_POST['submit'])) {
      $quizId = $_POST['submit'];
      $quizName = $_POST['quizName'];
      $timeLimit = $_POST['timeLimit'];

      // SQL query and execute
      $query = 'UPDATE quiz SET 
                  name = :quizName, 
                  timeLimit = :timeLimit 
                  WHERE id = :quizId';

      $stmt = $db->prepare($query);
      $stmt->bindParam(':quizName', $quizName);
      $stmt->bindParam(':timeLimit', $timeLimit);
      $stmt->bindParam(':quizId', $quizId);

      if ($stmt->execute()) {
         redirectTo('./homepage.php');
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
