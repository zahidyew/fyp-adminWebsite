<?php
   include_once './config/Database.php';

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();
   $table = 'quiz';
   date_default_timezone_set("Singapore");

   if (isset($_POST['quizName'])) {
      $quizName = $_POST['quizName'];
      //$filename = $_POST
      $date = date("d/m/Y");
      $time = date("h:ia");
      $numOfQues = $_POST['numOfQues'];
      $timeLimit = $_POST['timeLimit'];

      $query = 'INSERT INTO ' . $table . ' SET 
                     name = :name,
                     date = :date,
                     time = :time,
                     numOfQues = :numOfQues,
                     timeLimit = :timeLimit';

      $stmt = $db->prepare($query);
      $stmt->bindParam(':name', $quizName);
      $stmt->bindParam(':date', $date);
      $stmt->bindParam(':time', $time);
      $stmt->bindParam(':numOfQues', $numOfQues);
      $stmt->bindParam(':timeLimit', $timeLimit);

      if ($stmt->execute()) {
         // redirect to Add Questions or show the Add Questions Form using JS.
         $query2 = "SELECT id FROM $table WHERE 
                     name = :name AND 
                     date = :date AND 
                     time = :time";

         $stmt2 = $db->prepare($query2);
         $stmt2->bindParam(':name', $quizName);
         $stmt2->bindParam(':date', $date);
         $stmt2->bindParam(':time', $time);
         $stmt2->execute();
         $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
         $id = $row2['id'];

         header("Location: ./addQuestion.php?id=$id&numOfQues=$numOfQues");
      } else {
         printf("Error: %s.\n", $stmt->error);
         //return false;
      }
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" type="text/css" href="./css/style.css">
   <title>Add Quiz</title>
</head>

<body>
   <h1>Add Quiz</h1>
   <div id="">
      <form action="./addQuiz.php" method="POST">
         Quiz Name: <input type="text" name="quizName" id="quizName" required><br>
         <!-- Logo: <input type="file" name="file" id="file"><br>
         Date: <input type="date" name="date" id="date"><br>
         Time: <input type="time" name="time" id="time"><br> -->
         Number of Questions: <input type="number" name="numOfQues" id="numOfQues" min="1" required><br>
         Time Limit: <input type="number" name="timeLimit" id="timeLimit" min="1" required><br>
         <button type="submit" name="submit" id="submit">Submit</button>
         <button type="reset" name="reset" id="reset">Reset</button>
      </form>
   </div>
</body>

</html>