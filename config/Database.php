<?php
class Database
{
   // DB Params
   private $host = "localhost";
   private $db_name = "aquatic";
   private $username = "root";
   private $password = "";
   private $conn;

   // DB connect
   public function connect()
   {
      $this->conn = null;

      try {
         $this->conn = new PDO(
            'mysql:host=' . $this->host .
               ';dbname=' . $this->db_name .
               ';charset=utf8mb4',
            $this->username,
            $this->password,
            array(
               PDO::ATTR_EMULATE_PREPARES => false,
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            )
         );

         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
         echo 'Connection error: ' . $e->getMessage();
      }
      return $this->conn;
   }
}
