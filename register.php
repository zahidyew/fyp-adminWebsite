<?php
   include_once './config/Database.php';

   // Instantiate DB & connect
   $database = new Database();
   $db = $database->connect();
   $table = 'admin';

   // check if POST vars are set
   if (isset($_POST['uname']) && isset($_POST['password'])) {
      $username = $_POST['uname'];
      $password = $_POST['password'];
      $email = $_POST['email'];

      // TODO: add check for duplicate username. If exists in DB then inform, else proceed with insertion.

      // SQL query and execute
      $query = 'INSERT INTO ' . $table . ' SET 
                     username = :name, 
                     password = :pass, 
                     email = :email';

      $stmt = $db->prepare($query);

      //hash the password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $stmt->bindParam(':name', $username);
      $stmt->bindParam(':pass', $hashedPassword);
      $stmt->bindParam(':email', $email);

      if ($stmt->execute()) {
         //return true;
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
   <title>Register New Admin</title>
</head>

<body>
   <div id="">
      <h1>Register Admin</h1>

      <form action="./register.php" method="post">
         Username: <input type="text" id="uname" name="uname" required><br>
         Password: <input type="password" id="password" name="password" required><br>
         Email: <input type="text" id="email" name="email" required><br>
         <button type="submit" id="register">Register</button>
         <button type="reset" id="reset">Reset</button>
      </form>
   </div>
</body>

</html>