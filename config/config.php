<?php 

$host = "localhost";
$dbname = "taxify";  // Set the database name
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//   echo "Connect Successfully อิอิ";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>
