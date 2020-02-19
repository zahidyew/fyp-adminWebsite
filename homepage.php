<?php
   session_start();
   include_once './config/Database.php';

   /* add this 3 lines and session_start to every page to prevent people simply 
   accessing page without logging in.*/
   // if loggedIn var is not set, then the admin has not logged in
   if (!isset($_SESSION['loggedIn'])) {
      header("Location: index.php");
   }

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();
   $table = 'quiz';

   $query = 'SELECT * FROM ' . $table;
   $stmt = $db->prepare($query);
   $stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" type="text/css" href="./css/style.css">
   <title>Homepage</title>
</head>

<body>
   <h1>Homepage</h1>
   <button type="button" id="addQuiz">Add Quiz</button>
   <button type="button" id="logout">Logout</button>
   <br><br>
   <table>
      <tr>
         <th>No.</th>
         <th>Name</th>
         <th>Date</th>
         <!-- <th>Time</th>
         <th>Number of Questions</th>
         <th>Time Limit</th> -->
      </tr>
      <?php
      // listing all the quizzes in database
      $num = 1;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         echo '<tr>';
         echo '<td>' . $num . '</td>';
         echo '<td><a href="./viewQuestions.php?id=' . $row['id'] . '">' . $row['name'] . '</a></td>';
         echo '<td>' . $row['date'] . '</td>';
         /* echo '<td>' . $row['time'] . '</td>';
               echo '<td>' . $row['numOfQues'] . '</td>';
               echo '<td>' . $row['timeLimit'] . '</td>'; */
         echo '</tr>';
         $num++;
      }
      ?>
   </table>
</body>

<script>
   const addQuizBtn = document.getElementById("addQuiz").addEventListener("click", () => {
      window.location = "./addQuiz.html";
   });;

   const logoutBtn = document.getElementById("logout").addEventListener("click", () => {
      window.location = "./logout.php";
   });;
</script>

</html>