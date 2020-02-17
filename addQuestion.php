<?php
   echo $_GET['id'];
   echo '<br>';
   echo $_GET['numOfQues'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" type="text/css" href="./css/style.css">
   <title>Add Questions</title>
</head>
<body>
   <h1>Add Questions</h1>
   <div class="questionForm">
      <form action="./addQuestion.php" method="POST">
         Question: <textarea name="question" cols="80" rows="2"></textarea>
      </form>
   </div>
</body>
</html>