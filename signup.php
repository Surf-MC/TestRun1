<?php
require 'src/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (registerUser($email, $password)) {
        header("Location: login.html");
    } else {
        echo "Error registering user.";
    }
}
?>
