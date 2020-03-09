<?php
   include_once './config/Database.php';

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();
   $id = $_GET['editQues'];

   $query = 'SELECT * FROM question 
                              WHERE id = :quesId';

   $stmt = $db->prepare($query);
   $stmt->bindParam(':quesId', $id);
   $stmt->execute();

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   $quesId = $row['id'];
   $quizId = $row['quizId'];
   $postValue = "$quesId,$quizId";
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" type="text/css" href="./css/style.css">
   <title>Edit Question</title>
</head>

<body>
   <h1>Edit Question</h1>
   <form action="./editQues.php" method="post">
      Question: <textarea name="question" class="question" cols="80" rows="2"><?php echo $row['ques'] ?></textarea><br>
      Choice 1: <input type="text" name="choice1" class="choice1" value="<?php echo $row['choiceA'] ?>"><br>
      Choice 2: <input type="text" name="choice2" class="choice2" value="<?php echo $row['choiceB'] ?>"><br>
      Choice 3: <input type="text" name="choice3" class="choice3" value="<?php echo $row['choiceC'] ?>"><br>
      Choice 4: <input type="text" name="choice4" class="choice4" value="<?php echo $row['choiceD'] ?>"><br>
      Answer: <input type="text" name="answer" class="answer" value="<?php echo $row['answer'] ?>"><br><br>
      <button type="submit" name="submit" value="<?php echo $postValue ?>">Submit</button>
   </form>
</body>

</html>