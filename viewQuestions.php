<?php
include_once './config/Database.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$id = $_GET['id'];
$num = 1;

$query = 'SELECT * FROM question 
                     WHERE quizId = :quizId';
$stmt = $db->prepare($query);
$stmt->bindParam(':quizId', $id);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" type="text/css" href="./css/style.css">
   <title>View Questions</title>
</head>

<body>
   <h1>View Questions</h1>
   <br>
   <form action="./quizScore.php" method="GET">
      <button type="submit" value="<?php echo $id ?>" name="viewScore" id="viewScore">View Score</button>
   </form>
   <?php
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo '<div class="quesBlock">';
         echo '<p class="quesLine">' . $num . '. ' . $row['ques'] . '</p>';
         echo '<p class="choices"> A. ' . $row['choiceA'] . '</p>';
         echo '<p class="choices"> B. ' . $row['choiceB'] . '</p>';
         echo '<p class="choices"> C. ' . $row['choiceC'] . '</p>';
         echo '<p class="choices"> D. ' . $row['choiceD'] . '</p>';
         echo '<p class="answer"> Answer: ' . $row['answer'] . '</p>';

         echo '<form action="./editQuesPage.php" method="GET">';
            echo '<button type="submit" value="'. $row['id'] .'" name="editQues" id="editQues">Edit</button>';
         echo '</form>';

         //echo '<td><a href="./editQues.php?QuesId=' . $row['id'] . '">Edit</a></td>';
      echo '</div><br>';
      $num++;
   }
   ?>
</body>
<!-- <script>
   const viewScoreBtn = document.getElementById("viewScore");

   viewScoreBtn.addEventListener("click", () => {
      window.location = "./quizScore.php";
   });
</script> -->

</html>