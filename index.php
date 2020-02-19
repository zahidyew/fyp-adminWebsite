<?php
   session_start();
   include_once './config/Database.php';

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();
   $table = 'admin';

   // check if POST vars are set
   if (isset($_POST['uname']) && isset($_POST['password'])) {
      $username = $_POST['uname'];
      $password = $_POST['password'];

      $query = 'SELECT * FROM ' . $table .
         ' WHERE username = :name';

      $stmt = $db->prepare($query);
      $stmt->bindParam(':name', $username);
      $stmt->execute();
      $num = $stmt->rowCount();

      if ($num > 0) {
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         if (password_verify($password, $row['password'])) {
            $_SESSION['loggedIn'] = true;
            redirectTo('./homepage.php');
         } 
         else {
            // prompt them its incorrect
            echo '<script>alert("Incorrect password.")</script>';
         }
      } 
      else {
         echo '<script>alert("Username does not exists.")</script>';
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

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" type="text/css" href="./css/style.css">
   <title>Login</title>
</head>

<body>
   <div id="">
      <h1>Login</h1>

      <form action="./index.php" method="post">
         username: <input type="text" id="uname" name="uname" required><br>
         password: <input type="password" id="password" name="password" required><br>
         <button type="submit" id="login">Log in</button>
      </form>
   </div>
</body>

<script>

</script>

</html>