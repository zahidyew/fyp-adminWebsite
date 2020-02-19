<?php
include_once './config/Database.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$quizId = $_GET['viewScore'];

$query = 'SELECT * FROM quizrecords 
            WHERE quizId = :quizId';

$stmt = $db->prepare($query);
$stmt->bindParam(':quizId', $quizId);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" type="text/css" href="./css/style.css">
   <title>Quiz Records</title>
</head>

<body>
   <h1>Quiz Records</h1>
   <table>
      <tr>
         <th>No.</th>
         <th>Name</th>
         <th>Mark</th>
         <th>Time</th>
         <th>Date</th>
      </tr>
      <?php
      // listing all the records in database
      $num = 1;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         echo '<tr>';
         echo '<td>' . $num . '</td>';
         echo '<td>' . $row['username'] .  '</a></td>';
         echo '<td>' . $row['mark'] . '</td>';
         echo '<td>' . $row['time'] . '</td>';
         echo '<td>' . $row['date'] . '</td>';
         echo '</tr>';
         $num++;
      }
      ?>
   </table>
</body>
<script>
   
</script>
</html>