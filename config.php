<?php
$host = 'localhost';
$db = 'user_auth';
$user = 'your_db_username'; // Update with your DB username
$pass = 'your_db_password'; // Update with your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
