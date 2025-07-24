<?php
require 'src/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (loginUser($email, $password)) {
        header("Location: account.html");
    } else {
        echo "Invalid login credentials!";
    }
}
?>
